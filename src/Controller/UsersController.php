<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\CSVForm;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // 認証を必要としないログインアクションを構成し、
        // 無限リダイレクトループの問題を防ぎます
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    public function login()
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // POST, GET を問わず、ユーザーがログインしている場合はリダイレクトします
        if ($result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect');
    
            //return $this->redirect($redirect);
            $this->Flash->success(__('successfully signed in.'));
            return $this->redirect(['action' => 'view', $this->request->getAttribute('identity')->id]);
        }
        // ユーザーが submit 後、認証失敗した場合は、エラーを表示します
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password.'));
        }
    }

    public function logout()
    {
        $this->Authorization->skipAuthorization();

        $result = $this->Authentication->getResult();
        // POST, GET を問わず、ユーザーがログインしている場合はリダイレクトします
        if ($result->isValid()) {
            $this->Authentication->logout();
            $this->Flash->success(__('Signed out.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->Users->find('all', [
            'contain' => [
                'UserDetails',
            ],
        ]) ?? [];
        $dtables=['user-index'];

        $this->set(compact('users','dtables'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();

        $user = $this->Users->get($id, [
            'contain' => ['UserDetails',
                'Scores',
                'UserHistories',
                'FollowUsers' => ['UserDetails'], 
                'FollowedUsers' => ['UserDetails'],
            ],
        ]);
        
        $this->loadModel('Scores');
        $this->loadComponent('Indicator');
        $this->loadComponent('Lamp');
        $this->loadComponent('Follow');
        $my_lamps = $user->user_detail->my_lamps_array;
        $lamp_counts = $this->Indicator->getLampCounts($my_lamps);
        $detail_table = $this->Indicator->getLampList($my_lamps) ?? [];
        $rec_table = $this->Indicator->getRecommendResults($my_lamps, $user->user_detail->rating, $tweet_top_info) ?? [];
        $bte_table = $this->Indicator->getBetterThamExpectedResults($my_lamps, $user->user_detail->rating, $tweet_top_info) ?? [];
        $dtables = ['user-view'];
        $checkbox['version'] = $this->Indicator->version_info;
        $checkbox['cur_lamp'] = $this->Indicator->lamp_info;
        $checkbox['tar_lamp'] = $this->Indicator->tar_lamp_info;
        $checkbox['color'] = $this->Indicator->color_info;
        $checkbox['lamp_class'] = $this->Lamp->lamp_class_info;
        $checkbox['lamp_short'] = $this->Lamp->lamp_short_info;

        $identity = $this->request->getAttribute('identity');
        $mypage = isset($identity) && ($identity->id === $user->id);
        $follow_flag = isset($identity) && $this->Follow->isfollow($identity->id, $user->id);
        $is_permitted = $user->private_level===0|| $mypage || $follow_flag;

        $follow_compare_table = $this->Indicator->getFollowingLampCounts($user);

        $this->set(compact('user', 'lamp_counts', 'detail_table', 'rec_table', 'bte_table', 'follow_compare_table', 'tweet_top_info', 'dtables', 'checkbox', 'mypage', 'follow_flag', 'is_permitted'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();

        $result = $this->Authentication->getResult();
        // POST, GET を問わず、ユーザーがログインしている場合はリダイレクトします
        if ($result->isValid()) {
            $redirect = $this->request->getQuery('redirect');
            $this->Flash->error(__('新規登録を行う前にログアウトしてください'));
            return $this->redirect(['action' => 'index']);
        }

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $request = $this->request->getData();
            if($request['password'] !== $request['retype_password']){
                $this->Flash->error(__('Re-entered password does not match.'));
                return $this->redirect(['action' => 'add']);
            }
            $user = $this->Users->patchEntity($user, $request);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                $this->Authentication->setIdentity($user);
                return $this->redirect(['action' => 'view', $user->id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['UserDetails','Scores'],
        ]);
        $identity = $this->request->getAttribute('identity');
        $result = $identity->canResult('edit', $user);
        if ($result->getStatus()) {
            $csvform = new CSVForm();
            if ($this->request->is(['patch', 'post', 'put'])) {
                //$this->loadComponent('OGP');
                $csv_data = $this->request->getData('upload-csv');
                $text_data = $this->request->getData('upload-text');
                if(isset($text_data)||isset($csv_data)){
                    $this->loadComponent('Indicator');
                    $this->loadComponent('Lamp');
                    if(isset($csv_data)){
                        $this->loadComponent('CSV');
                        $input_lines = $this->CSV->getLinesFromCsv($csv_data);
                    }
                    else{
                        $input_lines = explode(PHP_EOL, $text_data);
                    }
                    $new_lamps = $this->Lamp->getNewLampDict($user, $input_lines);
                    if(is_null($new_lamps)){
                        $this->Flash->error(__('Fial to read data. Please, try again.'));
                        return $this->redirect(['action' => 'edit', $user->id]);
                    }
                    $invalid = false;
                    $user_history = $this->Lamp->saveLamps($user, $new_lamps, $invalid);
                    if(is_null($user_history)){
                        $this->Flash->error(__('No changing. Please, check your play data.'));
                        return $this->redirect(['action' => 'edit', $user->id]);
                    }
                    $this->Indicator->setRating($user, $user_history);
                    $user = $this->Users->patchEntity($user, ['user_detail' => ['update_at' =>  Time::now()]]);
                    if($invalid)$this->Flash->warning(__('Contains inconsistent data.'));
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The rating has been saved.'));
                        return $this->redirect(['controller'=>'UserHistories', 'action' => 'view', $user_history->id]);
                    }
                    $this->Flash->error(__('Fial to calclate rating. Please, try again.'));
                }
                else{
                    $user = $this->Users->patchEntity($user, $this->request->getData());
                    $user->user_detail->dj_name = strtoupper($user->user_detail->dj_name);
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The user has been saved.'));
                        return $this->redirect(['action' => 'view', $user->id]);
                    }
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }
            $this->loadComponent('Indicator');
            $season = $this->Indicator->getSeason();
            $this->set(compact('user', 'csvform', 'season'));
        }
        else{
            $this->Flash->error($result->getReason());
            return $this->redirect(['action' => 'view', $user->id]);
        }
    }

    public function setting($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['UserDetails'],
        ]);
        $identity = $this->request->getAttribute('identity');
        $result = $identity->canResult('setting', $user);
        if ($result->getStatus()) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $post_data = $this->request->getData();
                if(isset($post_data['private_level'])){
                    $user = $this->Users->patchEntity($user, $this->request->getData());
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The user has been saved.'));
                        return $this->redirect(['action' => 'view', $user->id]);
                    }
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
                if(isset($post_data['old_password'])){
                    if($user->check($post_data['old_password'])){
                        if($this->Users->patchEntity($user, ['password' => $post_data['new_password']]) && $this->Users->save($user)){
                            $this->Flash->success(__('New password has been saved.'));
                            return $this->redirect(['action' => 'view', $user->id]);
                        }
                        else $this->Flash->error(__('Invalid new password.'));
                    }
                    else $this->Flash->error(__('Wrong password.'));
                }
            }
            $this->set(compact('user'));
        }
        else{
            $this->Flash->error($result->getReason());
            return $this->redirect(['action' => 'view', $user->id]);
        }
    }


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id, [
            'contain' => ['UserDetails'],
        ]);
        $identity = $this->request->getAttribute('identity');
        $result = $identity->canResult('delete', $user);
        if (!$result->getStatus()){
            $this->Flash->error($result->getReason());
            return $this->redirect(['action' => 'view', $user->id]);
        }
        else if (! $user->check($this->request->getdata('password'))){
            $this->Flash->error('パスワードが正しくありません');
            return $this->redirect(['action' => 'view', $user->id]);
        }
        else {
            if ($this->Users->delete($user)) {
                $this->Authentication->logout();
                $this->Flash->success(__('The user has been deleted.'));
                return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
            } else {
                $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'view', $user->id]);
        }
    }


    public function following($from = null, $to = null)
    {
        $user = $this->Users->get($from, [
            'contain' => [
                'UserDetails',
                'FollowUsers' => ['UserDetails'],
            ],
        ]);
        $identity = $this->request->getAttribute('identity');
        $result = $identity->canResult('setting', $user);
        if ($result->getStatus() && $from !== $to) {
            $this->loadComponent('Follow');
            $target = $this->Users->get($to);
            if($this->Follow->isFollow($from, $to)){
                $this->Follow->unFollow($from, $to);
                $this->Flash->success(__('Unfollowing.'));
                return $this->redirect(['action' => 'view', $to]);
            }
            else{
                if($target->private_level == 0){
                    $this->Follow->Follow($from, $to);
                    $this->Flash->success(__('Following.'));
                    return $this->redirect(['action' => 'view', $to]);
                }
                if ($this->request->is(['patch', 'post', 'put'])) {
                    $post_data = $this->request->getData();
                    if(isset($post_data['phrase']) && $this->Follow->canFollow($target, $post_data['phrase'])){
                        $this->Follow->Follow($from, $to);
                        $this->Flash->success(__('Following.'));
                        return $this->redirect(['action' => 'view', $to]);
                    }
                    $this->Flash->error(__('Invalid phrase'));
                }
            }
        }
        else{
            $this->Flash->error($result->getReason());
            return $this->redirect(['action' => 'view', $to]);
        }
    }

    public function recalclate($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['UserDetails'],
        ]);
        $identity = $this->request->getAttribute('identity');
        $result = $identity->canResult('recalclate', $user);
        if (!$result->getStatus()){
            $this->Flash->error($result->getReason());
            return $this->redirect(['action' => 'view', $user->id]);
        }
        else {
            $this->loadComponent('Indicator');
            if(($user->user_detail->season??0) == $this->Indicator->getSeason()){

                $this->Flash->success(__('No need to recalculate.'));
                return $this->redirect(['action' => 'view', $user->id]);
            }
            $UserHistories = TableRegistry::getTableLocator()->get('UserHistories');
            $user_history = $UserHistories->newEmptyEntity();
            $user_history->user_id = $user->id;
            if($this->Indicator->setRating($user, $user_history)){
                $user = $this->Users->patchEntity($user, ['user_detail' => ['update_at' =>  Time::now()]]);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The rating has been saved.'));
                    return $this->redirect(['controller'=>'UserHistories', 'action' => 'view', $user_history->id]);
                }
                $this->Flash->error(__('Fial to calclate rating. Please, try again.'));
                return $this->redirect(['action' => 'view', $user->id]);
            }
            $this->Flash->error(__('Unable to detect a 12 level lamp.'));
            return $this->redirect(['action' => 'view', $user->id]);
        }
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\CSVForm;
use Cake\ORM\TableRegistry;
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
            return $this->redirect(['action' => 'index']);
        }
        // ユーザーが submit 後、認証失敗した場合は、エラーを表示します
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
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
                'Scores', 
                'UserDetails',
                'UserLamps',
                'FollowUsers' => ['UserDetails'],
                'FollowedUsers' => ['UserDetails'],
            ],
        ]);
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
            'contain' => ['UserDetails','Scores'],
        ]);
        
        $this->loadModel('Scores');
        $this->loadComponent('Indicator');
        $this->loadComponent('Lamp');
        $my_lamps = $user->user_detail->my_lamps_array;
        $lamp_counts = $this->Indicator->getLampCounts($my_lamps);
        $detail_table = $this->Indicator->getLampList($my_lamps);
        $rec_table = $this->Indicator->getRecommendResults($my_lamps,$user->user_detail->rating);
        $bte_table = $this->Indicator->getBetterThamExpectedResults($my_lamps,$user->user_detail->rating);
        $dtables = ['user-view'];
        $checkbox['version'] = $this->Indicator->version_info;
        $checkbox['cur_lamp'] = $this->Indicator->lamp_info;
        $checkbox['tar_lamp'] = $this->Indicator->tar_lamp_info;
        $checkbox['color'] = $this->Indicator->color_info;
        $checkbox['lamp_class'] = $this->Lamp->lamp_class_info;
        $checkbox['lamp_short'] = $this->Lamp->lamp_short_info;

        $this->set(compact('user', 'lamp_counts', 'detail_table', 'rec_table', 'bte_table', 'dtables', 'checkbox'));

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $scores = $this->Users->Scores->find('list', ['limit' => 200]);
        $this->set(compact('user', 'scores'));
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
                    $this->Lamp->saveLamps($user, $new_lamps);
                    $this->set(compact('new_lamps'));
                    //$ghost = $this->Indicator->test($user);
                    //$this->set(compact('ghost'));
                    $rating = $this->Indicator->getRating($user);
                    $user = $this->Users->patchEntity($user, ['user_detail' => ['rating' => $rating]]);
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The rating has been saved.'));
                        return $this->redirect(['action' => 'view', $user->id]);
                    }
                    $this->Flash->error(__('Fial to calclate rating. Please, try again.'));
                }
                else{
                    $user = $this->Users->patchEntity($user, $this->request->getData());
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The user has been saved.'));
                        return $this->redirect(['action' => 'view', $user->id]);
                    }
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('user', 'csvform'));
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
                $user = $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'view', $user->id]);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
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
}

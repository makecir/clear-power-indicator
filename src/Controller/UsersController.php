<?php
declare(strict_types=1);

namespace App\Controller;

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
        $this->set(compact('user'));
        
        //loadmodel(score)
        $my_lamps=$user->user_detail->my_lamps;
        //$lamp_counts=$this->Score->getLampCounts($my_lamps);
        //$rec_table=$this->Score->getRec($my_lamps);
        //$bte_table=$this->Score->getBte($my_lamps);
        //  //getBte($my_lamps){$own_table=$this->Score->getOwn($my_lamps);return 50%cut($own_table);}
        
        
        $this->set(compact('my_lamps'));
        //test

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

                //user追加時に自動的にuser_detailを生成
                $userDetailsTable = TableRegistry::getTableLocator()->get('UserDetails');
                $user_detail = $userDetailsTable->newEmptyEntity();
                $user_detail->user_id = $user->id;
                if($userDetailsTable->save($user_detail)){
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Users->delete($user);
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
            'contain' => ['Scores', 'UserDetails'],
        ]);
        $identity = $this->request->getAttribute('identity');
        $result = $identity->canResult('edit', $user);
        if ($result->getStatus()) {
            if ($this->request->is(['patch', 'post', 'put'])) {
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
        else{
            $this->Flash->error($result->getReason());
            return $this->redirect(['action' => 'index']);
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
        // *TODO* 要本人確認

        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        // user削除時にdetail,follow,lampを消去

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

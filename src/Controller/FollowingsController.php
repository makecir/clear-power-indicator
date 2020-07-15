<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Followings Controller
 *
 * @property \App\Model\Table\FollowingsTable $Followings
 * @method \App\Model\Entity\Following[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FollowingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['FollowUsers', 'FollowedUsers'],
        ];
        $followings = $this->paginate($this->Followings);

        $this->set(compact('followings'));
    }

    /**
     * View method
     *
     * @param string|null $id Following id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $following = $this->Followings->get($id, [
            'contain' => ['FollowUsers', 'FollowedUsers'],
        ]);

        $this->set(compact('following'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $following = $this->Followings->newEmptyEntity();
        if ($this->request->is('post')) {
            $following = $this->Followings->patchEntity($following, $this->request->getData());
            if ($this->Followings->save($following)) {
                $this->Flash->success(__('The following has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The following could not be saved. Please, try again.'));
        }
        $followUsers = $this->Followings->FollowUsers->find('list', ['limit' => 200]);
        $followedUsers = $this->Followings->FollowedUsers->find('list', ['limit' => 200]);
        $this->set(compact('following', 'followUsers', 'followedUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Following id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $following = $this->Followings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $following = $this->Followings->patchEntity($following, $this->request->getData());
            if ($this->Followings->save($following)) {
                $this->Flash->success(__('The following has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The following could not be saved. Please, try again.'));
        }
        $followUsers = $this->Followings->FollowUsers->find('list', ['limit' => 200]);
        $followedUsers = $this->Followings->FollowedUsers->find('list', ['limit' => 200]);
        $this->set(compact('following', 'followUsers', 'followedUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Following id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $following = $this->Followings->get($id);
        if ($this->Followings->delete($following)) {
            $this->Flash->success(__('The following has been deleted.'));
        } else {
            $this->Flash->error(__('The following could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

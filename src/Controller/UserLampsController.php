<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UserLamps Controller
 *
 * @property \App\Model\Table\UserLampsTable $UserLamps
 * @method \App\Model\Entity\UserLamp[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserLampsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Scores'],
        ];
        $userLamps = $this->paginate($this->UserLamps);

        $this->set(compact('userLamps'));
    }

    /**
     * View method
     *
     * @param string|null $id User Lamp id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userLamp = $this->UserLamps->get($id, [
            'contain' => ['Users', 'Scores'],
        ]);

        $this->set(compact('userLamp'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userLamp = $this->UserLamps->newEmptyEntity();
        if ($this->request->is('post')) {
            $userLamp = $this->UserLamps->patchEntity($userLamp, $this->request->getData());
            if ($this->UserLamps->save($userLamp)) {
                $this->Flash->success(__('The user lamp has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user lamp could not be saved. Please, try again.'));
        }
        $users = $this->UserLamps->Users->find('list', ['limit' => 200]);
        $scores = $this->UserLamps->Scores->find('list', ['limit' => 200]);
        $this->set(compact('userLamp', 'users', 'scores'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Lamp id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userLamp = $this->UserLamps->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userLamp = $this->UserLamps->patchEntity($userLamp, $this->request->getData());
            if ($this->UserLamps->save($userLamp)) {
                $this->Flash->success(__('The user lamp has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user lamp could not be saved. Please, try again.'));
        }
        $users = $this->UserLamps->Users->find('list', ['limit' => 200]);
        $scores = $this->UserLamps->Scores->find('list', ['limit' => 200]);
        $this->set(compact('userLamp', 'users', 'scores'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Lamp id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userLamp = $this->UserLamps->get($id);
        if ($this->UserLamps->delete($userLamp)) {
            $this->Flash->success(__('The user lamp has been deleted.'));
        } else {
            $this->Flash->error(__('The user lamp could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

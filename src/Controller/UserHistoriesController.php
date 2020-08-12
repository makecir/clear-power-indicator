<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UserHistories Controller
 *
 * @property \App\Model\Table\UserHistoriesTable $UserHistories
 * @method \App\Model\Entity\UserHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserHistoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $userHistories = $this->paginate($this->UserHistories);

        $this->set(compact('userHistories'));
    }

    /**
     * View method
     *
     * @param string|null $id User History id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userHistory = $this->UserHistories->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('userHistory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userHistory = $this->UserHistories->newEmptyEntity();
        if ($this->request->is('post')) {
            $userHistory = $this->UserHistories->patchEntity($userHistory, $this->request->getData());
            if ($this->UserHistories->save($userHistory)) {
                $this->Flash->success(__('The user history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user history could not be saved. Please, try again.'));
        }
        $users = $this->UserHistories->Users->find('list', ['limit' => 200]);
        $this->set(compact('userHistory', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User History id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userHistory = $this->UserHistories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userHistory = $this->UserHistories->patchEntity($userHistory, $this->request->getData());
            if ($this->UserHistories->save($userHistory)) {
                $this->Flash->success(__('The user history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user history could not be saved. Please, try again.'));
        }
        $users = $this->UserHistories->Users->find('list', ['limit' => 200]);
        $this->set(compact('userHistory', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User History id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userHistory = $this->UserHistories->get($id);
        if ($this->UserHistories->delete($userHistory)) {
            $this->Flash->success(__('The user history has been deleted.'));
        } else {
            $this->Flash->error(__('The user history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

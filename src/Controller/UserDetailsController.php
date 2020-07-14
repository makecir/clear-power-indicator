<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UserDetails Controller
 *
 * @property \App\Model\Table\UserDetailsTable $UserDetails
 * @method \App\Model\Entity\UserDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserDetailsController extends AppController
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
        $userDetails = $this->paginate($this->UserDetails);
        
        $this->set(compact('userDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id User Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userDetail = $this->UserDetails->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('userDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userDetail = $this->UserDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $userDetail = $this->UserDetails->patchEntity($userDetail, $this->request->getData());
            if ($this->UserDetails->save($userDetail)) {
                $this->Flash->success(__('The user detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user detail could not be saved. Please, try again.'));
        }
        $iidxes = $this->UserDetails->Iidxes->find('list', ['limit' => 200]);
        $twitters = $this->UserDetails->Twitters->find('list', ['limit' => 200]);
        $this->set(compact('userDetail', 'iidxes', 'twitters'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userDetail = $this->UserDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userDetail = $this->UserDetails->patchEntity($userDetail, $this->request->getData());
            if ($this->UserDetails->save($userDetail)) {
                $this->Flash->success(__('The user detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user detail could not be saved. Please, try again.'));
        }
        $iidxes = $this->UserDetails->Iidxes->find('list', ['limit' => 200]);
        $twitters = $this->UserDetails->Twitters->find('list', ['limit' => 200]);
        $this->set(compact('userDetail'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userDetail = $this->UserDetails->get($id);
        if ($this->UserDetails->delete($userDetail)) {
            $this->Flash->success(__('The user detail has been deleted.'));
        } else {
            $this->Flash->error(__('The user detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

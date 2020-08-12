<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LampChanges Controller
 *
 * @property \App\Model\Table\LampChangesTable $LampChanges
 * @method \App\Model\Entity\LampChange[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LampChangesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['UserHistories', 'Scores'],
        ];
        $lampChanges = $this->paginate($this->LampChanges);

        $this->set(compact('lampChanges'));
    }

    /**
     * View method
     *
     * @param string|null $id Lamp Change id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lampChange = $this->LampChanges->get($id, [
            'contain' => ['UserHistories', 'Scores'],
        ]);

        $this->set(compact('lampChange'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lampChange = $this->LampChanges->newEmptyEntity();
        if ($this->request->is('post')) {
            $lampChange = $this->LampChanges->patchEntity($lampChange, $this->request->getData());
            if ($this->LampChanges->save($lampChange)) {
                $this->Flash->success(__('The lamp change has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lamp change could not be saved. Please, try again.'));
        }
        $userHistories = $this->LampChanges->UserHistories->find('list', ['limit' => 200]);
        $scores = $this->LampChanges->Scores->find('list', ['limit' => 200]);
        $this->set(compact('lampChange', 'userHistories', 'scores'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lamp Change id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lampChange = $this->LampChanges->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lampChange = $this->LampChanges->patchEntity($lampChange, $this->request->getData());
            if ($this->LampChanges->save($lampChange)) {
                $this->Flash->success(__('The lamp change has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lamp change could not be saved. Please, try again.'));
        }
        $userHistories = $this->LampChanges->UserHistories->find('list', ['limit' => 200]);
        $scores = $this->LampChanges->Scores->find('list', ['limit' => 200]);
        $this->set(compact('lampChange', 'userHistories', 'scores'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lamp Change id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lampChange = $this->LampChanges->get($id);
        if ($this->LampChanges->delete($lampChange)) {
            $this->Flash->success(__('The lamp change has been deleted.'));
        } else {
            $this->Flash->error(__('The lamp change could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

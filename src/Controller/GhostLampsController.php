<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * GhostLamps Controller
 *
 * @property \App\Model\Table\GhostLampsTable $GhostLamps
 * @method \App\Model\Entity\GhostLamp[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GhostLampsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ghosts', 'Scores'],
        ];
        $ghostLamps = $this->paginate($this->GhostLamps);

        $this->set(compact('ghostLamps'));
    }

    /**
     * View method
     *
     * @param string|null $id Ghost Lamp id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ghostLamp = $this->GhostLamps->get($id, [
            'contain' => ['Ghosts', 'Scores'],
        ]);

        $this->set(compact('ghostLamp'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ghostLamp = $this->GhostLamps->newEmptyEntity();
        if ($this->request->is('post')) {
            $ghostLamp = $this->GhostLamps->patchEntity($ghostLamp, $this->request->getData());
            if ($this->GhostLamps->save($ghostLamp)) {
                $this->Flash->success(__('The ghost lamp has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ghost lamp could not be saved. Please, try again.'));
        }
        $ghosts = $this->GhostLamps->Ghosts->find('list', ['limit' => 200]);
        $scores = $this->GhostLamps->Scores->find('list', ['limit' => 200]);
        $this->set(compact('ghostLamp', 'ghosts', 'scores'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ghost Lamp id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ghostLamp = $this->GhostLamps->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ghostLamp = $this->GhostLamps->patchEntity($ghostLamp, $this->request->getData());
            if ($this->GhostLamps->save($ghostLamp)) {
                $this->Flash->success(__('The ghost lamp has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ghost lamp could not be saved. Please, try again.'));
        }
        $ghosts = $this->GhostLamps->Ghosts->find('list', ['limit' => 200]);
        $scores = $this->GhostLamps->Scores->find('list', ['limit' => 200]);
        $this->set(compact('ghostLamp', 'ghosts', 'scores'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ghost Lamp id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ghostLamp = $this->GhostLamps->get($id);
        if ($this->GhostLamps->delete($ghostLamp)) {
            $this->Flash->success(__('The ghost lamp has been deleted.'));
        } else {
            $this->Flash->error(__('The ghost lamp could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Scores Controller
 *
 * @property \App\Model\Table\ScoresTable $Scores
 * @method \App\Model\Entity\Score[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ScoresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $scores = $this->paginate($this->Scores);

        $this->set(compact('scores'));
    }

    /**
     * View method
     *
     * @param string|null $id Score id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $score = $this->Scores->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('score'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $score = $this->Scores->newEmptyEntity();
        if ($this->request->is('post')) {
            $score = $this->Scores->patchEntity($score, $this->request->getData());
            if ($this->Scores->save($score)) {
                $this->Flash->success(__('The score has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The score could not be saved. Please, try again.'));
        }
        $users = $this->Scores->Users->find('list', ['limit' => 200]);
        $this->set(compact('score', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Score id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $score = $this->Scores->get($id, [
            'contain' => ['Users'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $score = $this->Scores->patchEntity($score, $this->request->getData());
            if ($this->Scores->save($score)) {
                $this->Flash->success(__('The score has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The score could not be saved. Please, try again.'));
        }
        $users = $this->Scores->Users->find('list', ['limit' => 200]);
        $this->set(compact('score', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Score id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $score = $this->Scores->get($id);
        if ($this->Scores->delete($score)) {
            $this->Flash->success(__('The score has been deleted.'));
        } else {
            $this->Flash->error(__('The score could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

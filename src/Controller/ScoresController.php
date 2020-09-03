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
            //'contain' => ['Users'],
        ]);
        $identity = $this->request->getAttribute('identity');
        if(isset($identity)){
            $this->loadModel('Users');
            $this->loadModel('UserLamps');
            $this->loadComponent('Indicator');
            $this->loadComponent('Lamp');
            $me = $this->Users->get($identity->id, [
                'contain' => [
                    'UserDetails',
                ],
            ]);
            $my_data = $this->UserLamps->get(['user_id'=>$me->id,'score_id'=>$score->id]);
            $display_info['cur_lamp'] = $this->Indicator->lamp_info;
            $display_info['color'] = $this->Indicator->color_info;
            $display_info['lamp_short'] = $this->Lamp->lamp_short_info;
            $this->set(compact('me', 'my_data', 'display_info'));
        }

        $this->set(compact('score'));
    }

}

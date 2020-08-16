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
     * View method
     *
     * @param string|null $id User History id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userHistory = $this->UserHistories->get($id, [
            'contain' => [
                'LampChanges'=>['Scores'],
                'Users'=>['UserDetails']
            ],
        ]);
        $this->loadComponent('Indicator');
        $this->loadComponent('Follow');
        $this->loadComponent('Lamp');

        $identity = $this->request->getAttribute('identity');
        $this->loadModel('Users');
        $user = $this->Users->get($userHistory->user_id);
        $mypage = isset($identity) && ($identity->id === $user->id);
        $follow_flag = isset($identity) && $this->Follow->isfollow($identity->id, $user->id);
        $is_permitted = $user->private_level===0|| $mypage || $follow_flag;

        $change_counts = $this->Lamp->getLampChangeCounts($userHistory);
        $changes_table = $this->Indicator->getLampChangeResults($userHistory, $top_change);
        $change_counts_label = $this->Lamp->lamp_short_info;
        $change_counts_color = $this->Indicator->color_info;
        $lamp_info = $this->Indicator->lamp_info;
        $dtables = ['user-history-view'];

        $this->set(compact('userHistory','mypage','is_permitted','change_counts','changes_table','top_change','change_counts_label','change_counts_color','lamp_info','dtables'));
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
        $this->loadModel('Users');
        $user = $this->Users->get($userHistory->user_id);
        $identity = $this->request->getAttribute('identity');
        $result = $identity->canResult('delete', $user);
        if (!$result->getStatus()){
            $this->Flash->error($result->getReason());
            return $this->redirect(['action' => 'view', $user->id]);
        }
        $this->loadComponent('Lamp');
        $this->Lamp->allClearLamps($user);
        $user = $this->Users->patchEntity($user, ['user_detail' => ['rating' => null, 'stnding' => null]]);
        $this->Users->save($user);
        if ($this->UserHistories->delete($userHistory)) {
            $this->Flash->success(__('The user history has been deleted.'));
        } else {
            $this->Flash->error(__('The user history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'Users', 'action' => 'view', $user->id]);
    }
}

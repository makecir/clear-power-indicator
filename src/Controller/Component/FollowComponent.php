<?php
namespace App\Controller\Component;
 
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class FollowComponent extends Component
{
    public function isFollow($from, $to){
        $Followings = TableRegistry::getTableLocator()->get('Followings');
        return $Followings->exists(['follow_user_id'=>intval($from), 'followed_user_id'=>intval($to)]);
    }
    public function canFollow(&$tar_user, $phrase){
        return $tar_user->follow_pass !== "denied" && $tar_user->follow_pass === $phrase;
    }
    public function Follow($from, $to){
        $Followings = TableRegistry::getTableLocator()->get('Followings');
        //$f = $Followings->newEntity();
        $f = $Followings->newEntity(['follow_user_id'=>intval($from), 'followed_user_id'=>intval($to)]);
        return $Followings->save($f);
    }
    public function unFollow($from, $to){
        $Followings = TableRegistry::getTableLocator()->get('Followings');
        $f = $Followings->get(['follow_user_id'=>intval($from), 'followed_user_id'=>intval($to)]);
        return $Followings->delete($f);
    }
}

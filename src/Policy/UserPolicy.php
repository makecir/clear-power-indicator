<?php
namespace App\Policy;

use App\Model\Entity\User;
use App\Model\Table\UsersTable;
use Authorization\IdentityInterface;
use Authorization\Policy\Result;
use Cake\ORM\TableRegistry;


class userPolicy{
    public function canEdit(IdentityInterface $cur_user, User $user){
        if ($cur_user->id == $user->id) {
            return new Result(true);
        }
        return new Result(false, __('Permission denied'));
    }
    public function canSetting(IdentityInterface $cur_user, User $user){
        if ($cur_user->id == $user->id) {
            return new Result(true);
        }
        return new Result(false, __('Permission denied'));
    }
    public function canDelete(IdentityInterface $cur_user, User $user){
        if ($cur_user->id == $user->id) {
            return new Result(true);
        }
        return new Result(false, __('Permission denied'));
    }
    public function canFollowing(IdentityInterface $cur_user, User $user){
        if ($cur_user->id == $user->id) {
            return new Result(true);
        }
        return new Result(false, __('Permission denied'));
    }
    public function canCompare(IdentityInterface $cur_user, User $user){
        if ($cur_user->id == $user->id) {
            return new Result(true);
        }
        return new Result(false, __('Permission denied'));
    }
    public function canRecalclate(IdentityInterface $cur_user, User $user){
        if ($cur_user->id == $user->id) {
            return new Result(true);
        }
        return new Result(false, __('Permission denied'));
    }
}
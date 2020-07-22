<?php
namespace App\Policy;

use App\Model\Entity\User;
use App\Model\Table\UsersTable;
use Authorization\IdentityInterface;
use Authorization\Policy\Result;


class userPolicy{
    public function canEdit(IdentityInterface $cur_user, User $user){
        if ($cur_user->id == $user->id) {
            return new Result(true);
        }
        return new Result(false, __('Permission denied'));
    }
}
<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Following Entity
 *
 * @property int $follow_user_id
 * @property int $followed_user_id
 * @property \Cake\I18n\FrozenTime $created_at
 *
 * @property \App\Model\Entity\FollowUser $follow_user
 * @property \App\Model\Entity\FollowedUser $followed_user
 */
class Following extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'created_at' => true,
        'follow_user_id' => true,
        'followed_user_id' => true,
    ];
}

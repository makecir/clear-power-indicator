<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserHistory Entity
 *
 * @property int $id
 * @property int $user_id
 * @property float $rating_cur
 * @property float $rating_diff
 * @property string $lamps_diff
 * @property \Cake\I18n\FrozenTime $created_at
 *
 * @property \App\Model\Entity\User $user
 */
class UserHistory extends Entity
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
        'user_id' => true,
        'rating_cur' => true,
        'rating_diff' => true,
        'created_at' => true,
        'user' => true,
        'lamp_changes' => true,
    ];
}

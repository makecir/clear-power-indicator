<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ConciseLog Entity
 *
 * @property int $id
 * @property int $type
 * @property int|null $user_id
 * @property int|null $additional_user_id
 * @property int|null $target_id
 * @property string|null $body
 * @property \Cake\I18n\FrozenTime $created_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\AdditionalUser $additional_user
 * @property \App\Model\Entity\Target $target
 */
class ConciseLog extends Entity
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
        'type' => true,
        'user_id' => true,
        'additional_user_id' => true,
        'target_id' => true,
        'body' => true,
        'created_at' => true,
        'user' => true,
        'additional_user' => true,
        'target' => true,
    ];
}

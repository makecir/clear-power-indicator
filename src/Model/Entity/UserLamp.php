<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserLamp Entity
 *
 * @property int $user_id
 * @property int $score_id
 * @property int $lamp
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Score $score
 */
class UserLamp extends Entity
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
        'lamp' => true,
        'miss_count' => true,
        // 'ex_score' => true,
        // 'dj_level' => true,
        'user' => true,
        'score' => true,
        'created_at' => true,
        'modified_at' => true,
    ];
}

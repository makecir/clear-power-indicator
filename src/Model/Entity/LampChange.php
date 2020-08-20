<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LampChange Entity
 *
 * @property int $id
 * @property int $user_history_id
 * @property int $score_id
 * @property int $before_lamp
 * @property int $after_lamp
 *
 * @property \App\Model\Entity\UserHistory $user_history
 * @property \App\Model\Entity\Score $score
 */
class LampChange extends Entity
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
        'user_history_id' => true,
        'score_id' => true,
        'before_lamp' => true,
        'after_lamp' => true,
        'user_history' => true,
        'score' => true,
    ];
}

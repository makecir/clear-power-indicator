<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GhostLamp Entity
 *
 * @property int $ghost_id
 * @property int $score_id
 * @property int $lamp
 *
 * @property \App\Model\Entity\Ghost $ghost
 * @property \App\Model\Entity\Score $score
 */
class GhostLamp extends Entity
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
        'ghost_id' => true,
        'score_id' => true,
        'lamp' => true,
        'score' => true,
    ];
}

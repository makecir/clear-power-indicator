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
        'standing_cur' => true,
        'standing_diff' => true,
        'is_season_change' => true,
        'created_at' => true,
        'user' => true,
        'lamp_changes' => true,
    ];

    protected function _getRatingCurInfo(){
        return $this->rating_cur?sprintf('%.2f',$this->rating_cur):'';
    }

    protected function _getRatingDiffInfo(){
        return $this->rating_cur?sprintf(($this->rating_diff >= 0.00 ? '+' : '' ).'%.2f',$this->rating_diff):'';
    }

    protected function _getStandingCurInfo(){
        return $this->standing_cur?sprintf('%.0f',$this->standing_cur):'';
    }

    protected function _getStandingDiffInfo(){
        return $this->standing_cur?($this->standing_diff<=0?'↑ ':'↓ ').abs($this->standing_diff):'';
    }

}

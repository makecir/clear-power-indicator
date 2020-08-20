<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Score Entity
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $version_num
 * @property int|null $level
 * @property int $difficulty
 * @property int|null $notes
 * @property int|null $predicted_easy_rank
 * @property int|null $predicted_clear_rank
 * @property int|null $predicted_hard_rank
 * @property int|null $predicted_exhard_rank
 * @property int|null $predicted_fc_rank
 * @property int|null $predicted_aaa_rank
 * @property int $is_deleted
 * @property int $is_rated
 * @property float|null $easy_intercept
 * @property float|null $easy_coefficient
 * @property float|null $clear_intercept
 * @property float|null $clear_coefficient
 * @property float|null $hard_intercept
 * @property float|null $hard_coefficient
 * @property float|null $exhard_intercept
 * @property float|null $exhard_coefficient
 * @property float|null $fc_intercept
 * @property float|null $fc_coefficient
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\User[] $users
 */
class Score extends Entity
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
        'title' => true,
        'version_num' => true,
        'level' => true,
        'difficulty' => true,
        'notes' => true,
        'predicted_easy_rank' => true,
        'predicted_clear_rank' => true,
        'predicted_hard_rank' => true,
        'predicted_exhard_rank' => true,
        'predicted_fc_rank' => true,
        'predicted_aaa_rank' => true,
        'is_deleted' => true,
        'is_rated' => true,
        'easy_intercept' => true,
        'easy_coefficient' => true,
        'clear_intercept' => true,
        'clear_coefficient' => true,
        'hard_intercept' => true,
        'hard_coefficient' => true,
        'exhard_intercept' => true,
        'exhard_coefficient' => true,
        'fc_intercept' => true,
        'fc_coefficient' => true,
        'created_at' => true,
        'modified_at' => true,
        'users' => true,
        'title_info' => true,
    ];

    protected function _getTitleInfo(){
        $suffix = "";
        if($this->difficulty >= 4) $suffix = "[L]";
        elseif($this->title == "gigadelic" || $this->title == "Innocent Walls"){
            if($this->difficulty == 2) $suffix = "[H]";
            if($this->difficulty >= 3) $suffix = "[A]";
        }
        return $this->title.$suffix;
    }


}

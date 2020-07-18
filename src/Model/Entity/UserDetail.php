<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserDetail Entity
 *
 * @property string $user_id
 * @property string|null $iidx_id
 * @property string|null $dj_name
 * @property int $class_sp
 * @property int $class_dp
 * @property int $arena_sp
 * @property int $arena_dp
 * @property string|null $bio
 * @property string|null $twitter_id
 * @property float|null $rating
 * @property \Cake\I18n\FrozenTime $update_at
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\Iidx $iidx
 * @property \App\Model\Entity\Twitter $twitter
 */
class UserDetail extends Entity
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
        'iidx_id' => true,
        'dj_name' => true,
        'class_sp' => true,
        'class_dp' => true,
        'arena_sp' => true,
        'arena_dp' => true,
        'bio' => true,
        'twitter_id' => true,
        'rating' => true,
        'update_at' => true,
        'created_at' => true,
        'modified_at' => true,
    ];

    public function getTable(){
        return TableRegistry::getTableLocator()->get('UserDetails');
    }

    function _getSpClassInfo(){
        $sp_class_info = [
            0 => "-",
            //11 => "七級",
            //12 => "六級",
            //13 => "五級",
            //14 => "四級",
            //15 => "三級",
            //16 => "二級",
            //17 => "一級",
            //18 => "初段",
            //19 => "二段",
            //20 => "三段",
            //21 => "四段",
            //22 => "五段",
            23 => "六段", 
            24 => "七段", 
            25 => "八段", 
            26 => "九段", 
            27 => "十段", 
            28 => "中伝", 
            29 => "皆伝"
        ];
        return $sp_class_info[$this->class_sp ?? 0];
    }

    function _getSpArenaInfo(){
        $sp_Arena_info = [
            0 => "-",
            //11 => "D5",
            //12 => "D4",
            //13 => "D3",
            //14 => "D2",
            //15 => "D1",
            //16 => "C5",
            //17 => "C4",
            //18 => "C3",
            //19 => "C2",
            //20 => "C1",
            21 => "B5",
            22 => "B4",
            23 => "B3", 
            24 => "B2", 
            25 => "B1", 
            26 => "A5", 
            27 => "A4", 
            28 => "A3", 
            29 => "A2",
            29 => "A1",
        ];
        return $sp_class_info[$this->class_sp ?? 0];
    }

}

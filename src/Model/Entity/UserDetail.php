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
}

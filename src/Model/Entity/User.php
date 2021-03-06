<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\UserDetail[] $user_detail
 */
class User extends Entity
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
        'username' => true,
        'password' => true,
        'email' => true,
        'is_admin' => true,
        'private_level' => true,
        'follow_pass' => true,
        'created_at' => true,
        'modified_at' => true,
        'user_details' => true,
        'scores' => true,
        'user_histories' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }

    public function check(string $password) : ?bool
    {
        return (new DefaultPasswordHasher())->check($password, $this->password);
    }

    protected function _getPrivateDict(){
        $private_dict = [
             0 => "パブリック",
            10 => "プライベート",
        ];
        return $private_dict;
    }

}

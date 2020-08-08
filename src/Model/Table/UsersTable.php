<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Users Model
 *
 * @property \App\Model\Table\UserDetailTable&\Cake\ORM\Association\HasMany $UserDetail
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasOne('UserDetails', [
            'foreignKey' => 'user_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->belongsToMany('Scores', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'score_id',
            'joinTable' => 'user_lamps',
        ]);
        
        $this->hasMany('UserLamps', [
            'foreignKey' => 'user_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        
        $this->belongsToMany('FollowUsers', [
            //'through' => 'Followings',
            'className' => 'Users',
            'foreignKey' => 'follow_user_id',
            'targetForeignKey' => 'followed_user_id',
            'propertyName' => 'following_users',
            'joinTable' => 'followings',
        ]);

        $this->belongsToMany('FollowedUsers', [
            //'through' => 'Followings',
            'className' => 'Users',
            'foreignKey' => 'followed_user_id',
            'targetForeignKey' => 'follow_user_id',
            'propertyName' => 'followed_users',
            'joinTable' => 'followings',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('username')
            ->lengthBetween('username', [4, 16], '4字以上16字以下の制限があります')
            //->maxLength('username', 16)
            ->requirePresence('username', 'create')
            ->notEmptyString('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ->add('username', 'usernameFormat', [
                'rule' => function ($value) {
                    return preg_match("/\A\w*\z/", $value)===1;
                },
                'message' => '使用できない文字が含まれています',
            ]);

        $validator
            ->scalar('password')
            //->maxLength('password', 256)
            ->lengthBetween('password', [6, 32], '6字以上32字以下の制限があります')
            ->requirePresence('password', 'create')
            ->notEmptyString('password')
            ->add('password', 'passwordFormat', [
                'rule' => function ($value) {
                    return preg_match("/\A\w*\z/", $value)===1;
                },
                'message' => '使用できない文字が含まれています',
            ]);

        $validator
            ->scalar('email')
            ->maxLength('email', 128)
            ->allowEmptyString('email')
            ->add('email', 'emailFormat', [
                'rule' => function ($value) {
                    return preg_match("/\A(([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+|)\z/", $value)===1;
                },
                'message' => 'emailアドレスとして認識できません',
            ]);;

        $validator
            ->scalar('is_admin')
            ->maxLength('is_admin', 16)
            ->notEmptyString('is_admin');

        $validator
            ->scalar('private_level')
            ->maxLength('private_level', 16)
            ->notEmptyString('private_level');

        $validator
            ->scalar('follow_pass')
            //->maxLength('follow_pass', 60)
            ->lengthBetween('follow_pass', [4, 32], '4字以上32字以下の制限があります')
            ->notEmptyString('follow_pass')
            ->add('follow_pass', 'followPassFormat', [
                'rule' => function ($value) {
                    return preg_match("/\A\w*\z/", $value)===1;
                },
                'message' => '使用できない文字が含まれています',
            ]);

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('modified_at')
            ->notEmptyDateTime('modified_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username']));
        //$rules->add($rules->isUnique(['email']));

        return $rules;
    }

    public function afterSave($event, $user, $options)
    {
        //user追加時に自動的にuser_detailを生成
        $userDetailsTable = TableRegistry::getTableLocator()->get('UserDetails');
        $user_detail = $userDetailsTable->newEmptyEntity();
        $user_detail->user_id = $user->id;
        return $userDetailsTable->save($user_detail);
    }

}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Followings Model
 *
 * @property \App\Model\Table\FollowUsersTable&\Cake\ORM\Association\BelongsTo $FollowUsers
 * @property \App\Model\Table\FollowedUsersTable&\Cake\ORM\Association\BelongsTo $FollowedUsers
 *
 * @method \App\Model\Entity\Following newEmptyEntity()
 * @method \App\Model\Entity\Following newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Following[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Following get($primaryKey, $options = [])
 * @method \App\Model\Entity\Following findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Following patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Following[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Following|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Following saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Following[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Following[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Following[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Following[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FollowingsTable extends Table
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

        $this->setTable('followings');
        $this->setDisplayField('follow_user_id');
        $this->setPrimaryKey(['follow_user_id', 'followed_user_id']);

        $this->belongsTo('FollowUsers', [
            'className' => 'Users',
            'foreignKey' => 'followed_user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('FollowedUsers', [
            'className' => 'Users',
            'foreignKey' => 'followed_user_id',
            'joinType' => 'INNER',
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
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

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
        $rules->add($rules->existsIn(['follow_user_id'], 'Following'));
        $rules->add($rules->existsIn(['followed_user_id'], 'Following'));

        return $rules;
    }
}

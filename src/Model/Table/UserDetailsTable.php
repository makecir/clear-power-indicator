<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserDetails Model
 *
 * @property \App\Model\Table\IidxesTable&\Cake\ORM\Association\BelongsTo $Iidxes
 * @property \App\Model\Table\TwittersTable&\Cake\ORM\Association\BelongsTo $Twitters
 *
 * @method \App\Model\Entity\UserDetail newEmptyEntity()
 * @method \App\Model\Entity\UserDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\UserDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\UserDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UserDetailsTable extends Table
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

        $this->setTable('user_details');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey('user_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->scalar('user_id')
            ->maxLength('user_id', 16)
            ->allowEmptyString('user_id', null, 'create');

        $validator
            ->scalar('iidx_id')
            ->maxLength('iidx_id', 9)
            ->allowEmptyString('iidx_id');

        $validator
            ->scalar('dj_name')
            ->maxLength('dj_name', 8)
            ->allowEmptyString('dj_name');

        $validator
            ->notEmptyString('grade_sp');

        $validator
            ->notEmptyString('grade_dp');

        $validator
            ->notEmptyString('arena_sp');

        $validator
            ->notEmptyString('arena_dp');

        $validator
            ->scalar('bio')
            ->maxLength('bio', 240)
            ->allowEmptyString('bio');

        $validator
            ->scalar('twitter_id')
            ->maxLength('twitter_id', 32)
            ->allowEmptyString('twitter_id');

        $validator
            ->numeric('rating')
            ->allowEmptyString('rating');

        $validator
            ->dateTime('update_at')
            ->notEmptyDateTime('update_at');

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
        // $rules->add($rules->existsIn(['iidx_id'], 'Iidxes'));
        // $rules->add($rules->existsIn(['twitter_id'], 'Twitters'));

        return $rules;
    }

    // 未使用
    public $grade_dict = [
        0 => "-",
        1 => "七級",
        2 => "六級",
        3 => "五級",
        4 => "四級",
        5 => "三級",
        6 => "二級",
        7 => "一級",
        8 => "初段",
        9 => "二段",
        10 => "三段",
        11 => "四段",
        12 => "五段",
        13 => "六段", 
        14 => "七段", 
        15 => "八段", 
        16 => "九段", 
        17 => "十段", 
        18 => "中伝", 
        19 => "皆伝"
    ];
}

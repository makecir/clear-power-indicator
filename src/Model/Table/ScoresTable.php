<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Scores Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Score newEmptyEntity()
 * @method \App\Model\Entity\Score newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Score[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Score get($primaryKey, $options = [])
 * @method \App\Model\Entity\Score findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Score patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Score[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Score|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Score saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Score[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Score[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Score[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Score[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ScoresTable extends Table
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

        $this->setTable('scores');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Users', [
            'foreignKey' => 'score_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'user_lamps',
        ]);

        $this->hasMany('UserLamps', [
            'foreignKey' => 'score_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->hasMany('GhostLamps', [
            'foreignKey' => 'score_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
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
            ->scalar('title')
            ->maxLength('title', 100)
            ->allowEmptyString('title');

        $validator
            ->integer('version_num')
            ->allowEmptyString('version_num');

        $validator
            ->integer('level')
            ->allowEmptyString('level');

        $validator
            ->integer('difficulty')
            ->requirePresence('difficulty', 'create')
            ->notEmptyString('difficulty');

        $validator
            ->integer('notes')
            ->allowEmptyString('notes');

        $validator
            ->integer('predicted_easy_rank')
            ->allowEmptyString('predicted_easy_rank');

        $validator
            ->integer('predicted_clear_rank')
            ->allowEmptyString('predicted_clear_rank');

        $validator
            ->integer('predicted_hard_rank')
            ->allowEmptyString('predicted_hard_rank');

        $validator
            ->integer('predicted_exhard_rank')
            ->allowEmptyString('predicted_exhard_rank');

        $validator
            ->integer('predicted_fc_rank')
            ->allowEmptyString('predicted_fc_rank');

        $validator
            ->integer('predicted_aaa_rank')
            ->allowEmptyString('predicted_aaa_rank');

        $validator
            ->notEmptyString('is_deleted');

        $validator
            ->notEmptyString('is_rated');

        $validator
            ->numeric('easy_intercept')
            ->allowEmptyString('easy_intercept');

        $validator
            ->numeric('easy_coefficient')
            ->allowEmptyString('easy_coefficient');

        $validator
            ->numeric('easy_cfactor')
            ->allowEmptyString('easy_cfactor');

        $validator
            ->numeric('clear_intercept')
            ->allowEmptyString('clear_intercept');

        $validator
            ->numeric('clear_coefficient')
            ->allowEmptyString('clear_coefficient');

        $validator
            ->numeric('clear_cfactor')
            ->allowEmptyString('clear_cfactor');

        $validator
            ->numeric('hard_intercept')
            ->allowEmptyString('hard_intercept');

        $validator
            ->numeric('hard_coefficient')
            ->allowEmptyString('hard_coefficient');

        $validator
            ->numeric('hard_cfactor')
            ->allowEmptyString('hard_cfactor');

        $validator
            ->numeric('exhard_intercept')
            ->allowEmptyString('exhard_intercept');

        $validator
            ->numeric('exhard_coefficient')
            ->allowEmptyString('exhard_coefficient');

        $validator
            ->numeric('exhard_cfactor')
            ->allowEmptyString('exhard_cfactor');

        $validator
            ->numeric('fc_intercept')
            ->allowEmptyString('fc_intercept');

        $validator
            ->numeric('fc_coefficient')
            ->allowEmptyString('fc_coefficient');

        $validator
            ->numeric('fc_cfactor')
            ->allowEmptyString('fc_cfactor');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('modified_at')
            ->notEmptyDateTime('modified_at');

        return $validator;
    }

    public function findAvailable(Query $query, array $options = [])
    {
        return $query->where(['is_deleted' => "0"]);
    }
    public function findRated(Query $query, array $options = [])
    {
        return $query->where(['is_deleted' => "0", 'is_rated' => "1"]);
    }
}

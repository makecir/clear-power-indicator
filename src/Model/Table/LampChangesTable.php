<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LampChanges Model
 *
 * @property \App\Model\Table\UserHistoriesTable&\Cake\ORM\Association\BelongsTo $UserHistories
 * @property \App\Model\Table\ScoresTable&\Cake\ORM\Association\BelongsTo $Scores
 *
 * @method \App\Model\Entity\LampChange newEmptyEntity()
 * @method \App\Model\Entity\LampChange newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LampChange[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LampChange get($primaryKey, $options = [])
 * @method \App\Model\Entity\LampChange findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LampChange patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LampChange[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LampChange|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LampChange saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LampChange[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LampChange[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LampChange[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LampChange[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LampChangesTable extends Table
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

        $this->setTable('lamp_changes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('UserHistories', [
            'foreignKey' => 'user_history_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Scores', [
            'foreignKey' => 'score_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('before_lamp')
            ->requirePresence('before_lamp', 'create')
            ->notEmptyString('before_lamp');

        $validator
            ->integer('after_lamp')
            ->requirePresence('after_lamp', 'create')
            ->notEmptyString('after_lamp');

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
        $rules->add($rules->existsIn(['user_history_id'], 'UserHistories'), ['errorField' => 'user_history_id']);
        $rules->add($rules->existsIn(['score_id'], 'Scores'), ['errorField' => 'score_id']);

        return $rules;
    }
}

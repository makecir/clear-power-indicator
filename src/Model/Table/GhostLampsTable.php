<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GhostLamps Model
 *
 * @property \App\Model\Table\GhostsTable&\Cake\ORM\Association\BelongsTo $Ghosts
 * @property \App\Model\Table\ScoresTable&\Cake\ORM\Association\BelongsTo $Scores
 *
 * @method \App\Model\Entity\GhostLamp newEmptyEntity()
 * @method \App\Model\Entity\GhostLamp newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\GhostLamp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GhostLamp get($primaryKey, $options = [])
 * @method \App\Model\Entity\GhostLamp findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\GhostLamp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GhostLamp[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\GhostLamp|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GhostLamp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GhostLamp[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\GhostLamp[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\GhostLamp[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\GhostLamp[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class GhostLampsTable extends Table
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

        $this->setTable('ghost_lamps');
        $this->setDisplayField('score_id');
        $this->setPrimaryKey(['ghost_id', 'score_id']);

        // $this->belongsTo('Ghosts', [
        //     'foreignKey' => 'ghost_id',
        //     'joinType' => 'INNER',
        // ]);
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
            ->integer('lamp')
            ->requirePresence('lamp', 'create')
            ->notEmptyString('lamp');

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
        //$rules->add($rules->existsIn(['ghost_id'], 'Ghosts'));
        $rules->add($rules->existsIn(['score_id'], 'Scores'));

        return $rules;
    }
    
    public function findScoredBy(Query $query, array $options = [])
    {
        return $query->find('list',[
            'keyField' => 'score_id',
            'valueField' => function ($entity) {
                //return ['user_id'=>$entity['user_id'],'lamp'=>$entity['lamp']];
                return $entity['ghost_id'];
            }
        ]);
    }
}

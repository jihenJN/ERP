<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Basepostes Model
 *
 * @method \App\Model\Entity\Baseposte newEmptyEntity()
 * @method \App\Model\Entity\Baseposte newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Baseposte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Baseposte get($primaryKey, $options = [])
 * @method \App\Model\Entity\Baseposte findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Baseposte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Baseposte[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Baseposte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Baseposte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Baseposte[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Baseposte[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Baseposte[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Baseposte[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BasepostesTable extends Table
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

        $this->setTable('basepostes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->belongsTo('Delegations', [
            'foreignKey' => 'id_deleg',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Localites', [
            'foreignKey' => 'id_loc',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Gouvernorats', [
            'foreignKey' => 'id_gouv',
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
            ->scalar('codepostale')
            ->maxLength('codepostale', 255)
            ->requirePresence('codepostale', 'create')
            ->notEmptyString('codepostale');

        $validator
            ->integer('id_gouv')
            ->requirePresence('id_gouv', 'create')
            ->notEmptyString('id_gouv');

        $validator
            ->integer('id_deleg')
            ->requirePresence('id_deleg', 'create')
            ->notEmptyString('id_deleg');

        $validator
            ->integer('id_loc')
            ->requirePresence('id_loc', 'create')
            ->notEmptyString('id_loc');

        return $validator;
    }
}

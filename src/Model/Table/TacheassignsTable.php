<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tacheassigns Model
 *
 * @method \App\Model\Entity\Tacheassign newEmptyEntity()
 * @method \App\Model\Entity\Tacheassign newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tacheassign[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tacheassign get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tacheassign findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tacheassign patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tacheassign[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tacheassign|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tacheassign saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tacheassign[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tacheassign[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tacheassign[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tacheassign[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TacheassignsTable extends Table
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

        $this->setTable('tacheassigns');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        $this->belongsTo('Projets', [
            'foreignKey' => 'projet_id',
        ]);
        
        $this->belongsTo('Personnels', [
            'foreignKey' => 'personnel_id',
        ]);
        
        $this->belongsTo('Taches', [
            'foreignKey' => 'tache_id',
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
            ->scalar('numero')
            ->maxLength('numero', 256)
            ->allowEmptyString('numero');

        $validator
            ->integer('projet_id')
            ->allowEmptyString('projet_id');

        $validator
            ->integer('tache_id')
            ->allowEmptyString('tache_id');

        $validator
            ->integer('commercial_id')
            ->allowEmptyString('commercial_id');

        $validator
            ->integer('personnel_id')
            ->allowEmptyString('personnel_id');

        $validator
            ->dateTime('datedebut')
            ->allowEmptyDateTime('datedebut');

        $validator
            ->integer('HH')
            ->allowEmptyString('HH');

        $validator
            ->integer('MM')
            ->allowEmptyString('MM');

        $validator
            ->scalar('note')
            ->allowEmptyString('note');

        return $validator;
    }
}

<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ligneremiseclients Model
 *
 * @property \App\Model\Table\RemiseclientsTable&\Cake\ORM\Association\BelongsTo $Remiseclients
 *
 * @method \App\Model\Entity\Ligneremiseclient newEmptyEntity()
 * @method \App\Model\Entity\Ligneremiseclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneremiseclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneremiseclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ligneremiseclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ligneremiseclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneremiseclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneremiseclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneremiseclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneremiseclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneremiseclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneremiseclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneremiseclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LigneremiseclientsTable extends Table
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

        $this->setTable('ligneremiseclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Remiseclients', [
            'foreignKey' => 'remiseclient_id',
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
            ->integer('remiseclient_id')
            ->notEmptyString('remiseclient_id');

        $validator
            ->numeric('min')
            ->requirePresence('min', 'create')
            ->notEmptyString('min');

        $validator
            ->numeric('max')
            ->requirePresence('max', 'create')
            ->notEmptyString('max');
        $validator
            ->numeric('remise')
            ->requirePresence('remise', 'create')
            ->notEmptyString('remise');

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
        $rules->add($rules->existsIn('remiseclient_id', 'Remiseclients'), ['errorField' => 'remiseclient_id']);

        return $rules;
    }
}

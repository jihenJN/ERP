<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignezonedelegations Model
 *
 * @property \App\Model\Table\ZonesTable&\Cake\ORM\Association\BelongsTo $Zones
 *
 * @method \App\Model\Entity\Lignezonedelegation newEmptyEntity()
 * @method \App\Model\Entity\Lignezonedelegation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignezonedelegation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignezonedelegation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignezonedelegation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignezonedelegation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignezonedelegation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignezonedelegation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignezonedelegation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignezonedelegation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignezonedelegation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignezonedelegation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignezonedelegation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignezonedelegationsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        $this->belongsTo('Gouvernorats', [
            'foreignKey' => 'gouvernorat_id',
        ]);


        $this->belongsTo('Delegations', [
            'foreignKey' => 'delegation_id',
        ]);
        parent::initialize($config);

      
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
            ->integer('zonedelegation_id')
            ->requirePresence('zonedelegation_id', 'create')
            ->notEmptyString('zonedelegation_id');

        $validator
            ->integer('delegation_id')
            ->requirePresence('delegation_id', 'create')
            ->notEmptyString('delegation_id');

        $validator
            ->integer('gouvernorat_id')
            ->requirePresence('gouvernorat_id', 'create')
            ->notEmptyString('gouvernorat_id');

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
        $rules->add($rules->existsIn('zone_id', 'Zones'), ['errorField' => 'zone_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Gouvpromoarticles Model
 *
 * @property \App\Model\Table\PromoarticlesTable&\Cake\ORM\Association\BelongsTo $Promoarticles
 * @property \App\Model\Table\DelegationsTable&\Cake\ORM\Association\BelongsTo $Delegations
 * @property \App\Model\Table\GouvernoratsTable&\Cake\ORM\Association\BelongsTo $Gouvernorats
 *
 * @method \App\Model\Entity\Gouvpromoarticle newEmptyEntity()
 * @method \App\Model\Entity\Gouvpromoarticle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Gouvpromoarticle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Gouvpromoarticle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Gouvpromoarticle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Gouvpromoarticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Gouvpromoarticle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Gouvpromoarticle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gouvpromoarticle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gouvpromoarticle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Gouvpromoarticle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Gouvpromoarticle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Gouvpromoarticle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class GouvpromoarticlesTable extends Table
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

        $this->setTable('gouvpromoarticles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Promoarticles', [
            'foreignKey' => 'promoarticle_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Delegations', [
            'foreignKey' => 'delegation_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Gouvernorats', [
            'foreignKey' => 'gouvernorat_id',
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
//        $validator
//            ->integer('promoarticle_id')
//            ->notEmptyString('promoarticle_id');
//
//        $validator
//            ->integer('delegation_id')
//            ->notEmptyString('delegation_id');
//
//        $validator
//            ->integer('gouvernorat_id')
//            ->notEmptyString('gouvernorat_id');
//
//        $validator
//            ->integer('toutgouv')
//            ->requirePresence('toutgouv', 'create')
//            ->notEmptyString('toutgouv');

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
        $rules->add($rules->existsIn('promoarticle_id', 'Promoarticles'), ['errorField' => 'promoarticle_id']);
        $rules->add($rules->existsIn('delegation_id', 'Delegations'), ['errorField' => 'delegation_id']);
        $rules->add($rules->existsIn('gouvernorat_id', 'Gouvernorats'), ['errorField' => 'gouvernorat_id']);

        return $rules;
    }
}

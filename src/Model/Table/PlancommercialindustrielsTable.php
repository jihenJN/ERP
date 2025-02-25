<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plancommercialindustriels Model
 *
 * @property \App\Model\Table\DepotsTable&\Cake\ORM\Association\BelongsTo $Depots
 *
 * @method \App\Model\Entity\Plancommercialindustriel newEmptyEntity()
 * @method \App\Model\Entity\Plancommercialindustriel newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Plancommercialindustriel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Plancommercialindustriel get($primaryKey, $options = [])
 * @method \App\Model\Entity\Plancommercialindustriel findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Plancommercialindustriel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Plancommercialindustriel[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Plancommercialindustriel|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Plancommercialindustriel saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Plancommercialindustriel[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Plancommercialindustriel[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Plancommercialindustriel[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Plancommercialindustriel[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlancommercialindustrielsTable extends Table
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

        $this->setTable('plancommercialindustriels');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Depots', [
            'foreignKey' => 'depot_id',
            
        ]);
        
        $this->belongsTo('Mois', [
            'foreignKey' => 'moisdu_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Mois', [
            'foreignKey' => 'moisau_id',
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
            ->scalar('numero')
            ->maxLength('numero', 11)
            ->allowEmptyString('numero');

        $validator
            ->dateTime('date')
            ->allowEmptyDateTime('date');

        $validator
            ->integer('moisdu_id')
            ->allowEmptyString('moisdu_id');

        $validator
            ->integer('moisau_id')
            ->allowEmptyString('moisau_id');

        $validator
            ->numeric('marge')
            ->allowEmptyString('marge');

        $validator
            ->integer('depot_id')
            ->allowEmptyString('depot_id');

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
        $rules->add($rules->existsIn('depot_id', 'Depots'), ['errorField' => 'depot_id']);

        return $rules;
    }
}

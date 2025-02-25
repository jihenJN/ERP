<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Listetypedemandes Model
 *
 * @property \App\Model\Table\TypedemandesTable&\Cake\ORM\Association\BelongsTo $Typedemandes
 * @property \App\Model\Table\DemandeclientsTable&\Cake\ORM\Association\BelongsTo $Demandeclients
 *
 * @method \App\Model\Entity\Listetypedemande newEmptyEntity()
 * @method \App\Model\Entity\Listetypedemande newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Listetypedemande[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Listetypedemande get($primaryKey, $options = [])
 * @method \App\Model\Entity\Listetypedemande findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Listetypedemande patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Listetypedemande[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Listetypedemande|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Listetypedemande saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Listetypedemande[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Listetypedemande[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Listetypedemande[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Listetypedemande[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ListetypedemandesTable extends Table
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

        $this->setTable('listetypedemandes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Typedemandes', [
            'foreignKey' => 'typedemande_id',
        ]);
        $this->belongsTo('Demandeclients', [
            'foreignKey' => 'demandeclient_id',
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
        // $validator
        //     ->integer('typedemande_id')
        //     ->allowEmptyString('typedemande_id');

        // $validator
        //     ->integer('demandeclient_id')
        //     ->allowEmptyString('demandeclient_id');

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
        $rules->add($rules->existsIn('typedemande_id', 'Typedemandes'), ['errorField' => 'typedemande_id']);
        $rules->add($rules->existsIn('demandeclient_id', 'Demandeclients'), ['errorField' => 'demandeclient_id']);

        return $rules;
    }
}

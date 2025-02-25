<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignereglementjours Model
 *
 * @method \App\Model\Entity\Lignereglementjour newEmptyEntity()
 * @method \App\Model\Entity\Lignereglementjour newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglementjour[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglementjour get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignereglementjour findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignereglementjour patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglementjour[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglementjour|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignereglementjour saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignereglementjour[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignereglementjour[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignereglementjour[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignereglementjour[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignereglementjoursTable extends Table
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

        $this->setTable('lignereglementjours');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('reglementjour_id')
            ->allowEmptyString('reglementjour_id');

        $validator
            ->integer('ticketcaissejour_id')
            ->allowEmptyString('ticketcaissejour_id');

        $validator
            ->numeric('montant')
            ->allowEmptyString('montant');

        return $validator;
    }
}

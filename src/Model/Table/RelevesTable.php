<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Releves Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\ExercicesTable&\Cake\ORM\Association\BelongsTo $Exercices
 *
 * @method \App\Model\Entity\Relef newEmptyEntity()
 * @method \App\Model\Entity\Relef newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Relef[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Relef get($primaryKey, $options = [])
 * @method \App\Model\Entity\Relef findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Relef patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Relef[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Relef|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Relef saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Relef[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Relef[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Relef[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Relef[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RelevesTable extends Table
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

        $this->setTable('releves');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
        ]);
        $this->belongsTo('Exercices', [
            'foreignKey' => 'exercice_id',
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
//            ->scalar('numclt')
//            ->maxLength('numclt', 255)
//            ->allowEmptyString('numclt');
//
//        $validator
//            ->integer('client_id')
//            ->allowEmptyString('client_id');
//
//        $validator
//            ->dateTime('date')
//            ->allowEmptyDateTime('date');
//
//        $validator
//            ->scalar('numero')
//            ->maxLength('numero', 50)
//            ->allowEmptyString('numero');
//
//        $validator
//            ->scalar('type')
//            ->allowEmptyString('type');
//
//        $validator
//            ->scalar('typeimp')
//            ->allowEmptyString('typeimp');
//
//        $validator
//            ->decimal('debit')
//            ->allowEmptyString('debit');
//
//        $validator
//            ->decimal('credit')
//            ->allowEmptyString('credit');
//
//        $validator
//            ->decimal('impaye')
//            ->allowEmptyString('impaye');
//
//        $validator
//            ->decimal('reglement')
//            ->allowEmptyString('reglement');
//
//        $validator
//            ->decimal('avoir')
//            ->allowEmptyString('avoir');
//
//        $validator
//            ->decimal('solde')
//            ->allowEmptyString('solde');
//
//        $validator
//            ->integer('exercice_id')
//            ->allowEmptyString('exercice_id');
//
//        $validator
//            ->scalar('typ')
//            ->maxLength('typ', 255)
//            ->allowEmptyString('typ');
//
//        $validator
//            ->integer('nbligneimp')
//            ->allowEmptyString('nbligneimp');

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
        $rules->add($rules->existsIn('client_id', 'Clients'), ['errorField' => 'client_id']);
        $rules->add($rules->existsIn('exercice_id', 'Exercices'), ['errorField' => 'exercice_id']);

        return $rules;
    }
}

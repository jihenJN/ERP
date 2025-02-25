<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientresponsables Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\Clientresponsable newEmptyEntity()
 * @method \App\Model\Entity\Clientresponsable newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Clientresponsable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clientresponsable get($primaryKey, $options = [])
 * @method \App\Model\Entity\Clientresponsable findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Clientresponsable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Clientresponsable[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clientresponsable|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientresponsable saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientresponsable[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientresponsable[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientresponsable[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientresponsable[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClientresponsablesTable extends Table
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

        $this->setTable('clientresponsables');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
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
//            ->scalar('name')
//            ->maxLength('name', 255)
//            ->allowEmptyString('name');
//
//        $validator
//            ->scalar('mail')
//            ->maxLength('mail', 255)
//            ->allowEmptyString('mail');
//
//        $validator
//            ->integer('tel')
//            ->allowEmptyString('tel');
//
//        $validator
//            ->scalar('poste')
//            ->maxLength('poste', 255)
//            ->allowEmptyString('poste');
//
//        $validator
//            ->integer('client_id')
//            ->allowEmptyString('client_id');

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

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Historiquecomptes Model
 *
 * @method \App\Model\Entity\Historiquecompte newEmptyEntity()
 * @method \App\Model\Entity\Historiquecompte newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Historiquecompte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Historiquecompte get($primaryKey, $options = [])
 * @method \App\Model\Entity\Historiquecompte findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Historiquecompte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Historiquecompte[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Historiquecompte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Historiquecompte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Historiquecompte[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Historiquecompte[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Historiquecompte[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Historiquecompte[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class HistoriquecomptesTable extends Table
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

        $this->setTable('historiquecomptes');
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
            ->dateTime('date')
            ->allowEmptyDateTime('date');

        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->allowEmptyString('type');

        $validator
            ->scalar('mode')
            ->maxLength('mode', 255)
            ->allowEmptyString('mode');

        $validator
            ->integer('indice')
            ->allowEmptyString('indice');

        $validator
            ->numeric('montant')
            ->allowEmptyString('montant');

        $validator
            ->numeric('credit')
            ->allowEmptyString('credit');

        $validator
            ->numeric('debit')
            ->allowEmptyString('debit');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 255)
            ->allowEmptyString('numero');

        return $validator;
    }
}

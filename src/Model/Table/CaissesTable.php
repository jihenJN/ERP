<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Caisses Model
 *
 * @method \App\Model\Entity\Caisse newEmptyEntity()
 * @method \App\Model\Entity\Caisse newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Caisse[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Caisse get($primaryKey, $options = [])
 * @method \App\Model\Entity\Caisse findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Caisse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Caisse[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Caisse|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Caisse saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Caisse[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Caisse[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Caisse[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Caisse[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CaissesTable extends Table
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

        $this->setTable('caisses');
        $this->setDisplayField('name');
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
        // $validator
        //     ->scalar('name')
        //     ->maxLength('name', 255)
        //     ->allowEmptyString('name');

        // $validator
        //     ->numeric('montant')
        //     ->allowEmptyString('montant');

        // $validator
        //     ->dateTime('date')
        //     ->allowEmptyDateTime('date');

        return $validator;
    }
}

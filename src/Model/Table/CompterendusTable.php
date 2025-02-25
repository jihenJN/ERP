<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Compterendus Model
 *
 * @method \App\Model\Entity\Compterendus newEmptyEntity()
 * @method \App\Model\Entity\Compterendus newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Compterendus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Compterendus get($primaryKey, $options = [])
 * @method \App\Model\Entity\Compterendus findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Compterendus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Compterendus[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Compterendus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Compterendus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Compterendus[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Compterendus[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Compterendus[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Compterendus[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CompterendusTable extends Table
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

        $this->setTable('compterendus');
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

        return $validator;
    }
}

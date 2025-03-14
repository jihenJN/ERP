<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Charges Model
 *
 * @method \App\Model\Entity\Charge newEmptyEntity()
 * @method \App\Model\Entity\Charge newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Charge[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Charge get($primaryKey, $options = [])
 * @method \App\Model\Entity\Charge findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Charge patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Charge[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Charge|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Charge saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Charge[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Charge[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Charge[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Charge[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ChargesTable extends Table
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

        $this->setTable('charges');
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
//        $validator
//            ->integer('id')
//            ->requirePresence('id', 'create')
//            ->notEmptyString('id');
//
//        $validator
//            ->scalar('name')
//            ->maxLength('name', 255)
//            ->requirePresence('name', 'create')
//            ->notEmptyString('name');

        return $validator;
    }
}

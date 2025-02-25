<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tachedesignations Model
 *
 * @method \App\Model\Entity\Tachedesignation newEmptyEntity()
 * @method \App\Model\Entity\Tachedesignation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tachedesignation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tachedesignation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tachedesignation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tachedesignation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tachedesignation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tachedesignation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tachedesignation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tachedesignation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tachedesignation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tachedesignation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tachedesignation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TachedesignationsTable extends Table
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

        $this->setTable('tachedesignations');
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
     
        return $validator;
    }
}

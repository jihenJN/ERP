<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Mois Model
 *
 * @method \App\Model\Entity\Mois newEmptyEntity()
 * @method \App\Model\Entity\Mois newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Mois[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mois get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mois findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Mois patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mois[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mois|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mois saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mois[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Mois[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Mois[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Mois[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MoisTable extends Table
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

        $this->setTable('mois');
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
        //     ->requirePresence('name', 'create')
        //     ->notEmptyString('name');

        return $validator;
    }
}

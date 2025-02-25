<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Gouvernorats Model
 *
 * @method \App\Model\Entity\Gouvernorat newEmptyEntity()
 * @method \App\Model\Entity\Gouvernorat newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Gouvernorat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Gouvernorat get($primaryKey, $options = [])
 * @method \App\Model\Entity\Gouvernorat findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Gouvernorat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Gouvernorat[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Gouvernorat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gouvernorat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gouvernorat[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Gouvernorat[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Gouvernorat[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Gouvernorat[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class GouvernoratsTable extends Table
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

        $this->setTable('gouvernorats');
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
            ->scalar('Code')
            ->maxLength('Code', 100)
            ->allowEmptyString('Code');

        $validator
            ->scalar('Description')
            ->maxLength('Description', 100)
            ->allowEmptyString('Description');

        $validator
            ->scalar('ISDefault')
            ->maxLength('ISDefault', 100)
            ->allowEmptyString('ISDefault');

        $validator
            ->scalar('UserAdd')
            ->maxLength('UserAdd', 100)
            ->allowEmptyString('UserAdd');

        $validator
            ->scalar('DateAdd')
            ->maxLength('DateAdd', 100)
            ->allowEmptyString('DateAdd');

        $validator
            ->scalar('UserUpdate')
            ->maxLength('UserUpdate', 100)
            ->allowEmptyString('UserUpdate');

        $validator
            ->scalar('DateUpdate')
            ->maxLength('DateUpdate', 100)
            ->allowEmptyString('DateUpdate');

        return $validator;
    }
}

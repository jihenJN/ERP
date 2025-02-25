<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Famillerotations Model
 *
 * @method \App\Model\Entity\Famillerotation newEmptyEntity()
 * @method \App\Model\Entity\Famillerotation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Famillerotation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Famillerotation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Famillerotation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Famillerotation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Famillerotation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Famillerotation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Famillerotation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Famillerotation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Famillerotation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Famillerotation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Famillerotation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FamillerotationsTable extends Table
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

        $this->setTable('famillerotations');
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
        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('code')
            ->maxLength('code', 50)
            ->requirePresence('code', 'create')
            ->notEmptyString('code');

        $validator
            ->numeric('txmin')
            ->requirePresence('txmin', 'create')
            ->notEmptyString('txmin');

        $validator
            ->numeric('txmax')
            ->requirePresence('txmax', 'create')
            ->notEmptyString('txmax');

        return $validator;
    }
}

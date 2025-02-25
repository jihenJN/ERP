<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Typedepenses Model
 *
 * @property \App\Model\Table\DepensesTable&\Cake\ORM\Association\HasMany $Depenses
 *
 * @method \App\Model\Entity\Typedepense newEmptyEntity()
 * @method \App\Model\Entity\Typedepense newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Typedepense[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Typedepense get($primaryKey, $options = [])
 * @method \App\Model\Entity\Typedepense findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Typedepense patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Typedepense[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Typedepense|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typedepense saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typedepense[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typedepense[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typedepense[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typedepense[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TypedepensesTable extends Table
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

        $this->setTable('typedepenses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Depenses', [
            'foreignKey' => 'typedepense_id',
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
        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->allowEmptyString('name');

        return $validator;
    }
}

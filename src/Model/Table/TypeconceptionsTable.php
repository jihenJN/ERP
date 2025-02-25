<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Typeconceptions Model
 *
 * @property \App\Model\Table\ProjetconceptionsTable&\Cake\ORM\Association\HasMany $Projetconceptions
 *
 * @method \App\Model\Entity\Typeconception newEmptyEntity()
 * @method \App\Model\Entity\Typeconception newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Typeconception[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Typeconception get($primaryKey, $options = [])
 * @method \App\Model\Entity\Typeconception findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Typeconception patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Typeconception[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Typeconception|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typeconception saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typeconception[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typeconception[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typeconception[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typeconception[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TypeconceptionsTable extends Table
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

        $this->setTable('typeconceptions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Projetconceptions', [
            'foreignKey' => 'typeconception_id',
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
      
        return $validator;
    }
}

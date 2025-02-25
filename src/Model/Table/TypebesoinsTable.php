<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Typebesoins Model
 *
 * @property \App\Model\Table\ListetypebesoinsTable&\Cake\ORM\Association\HasMany $Listetypebesoins
 *
 * @method \App\Model\Entity\Typebesoin newEmptyEntity()
 * @method \App\Model\Entity\Typebesoin newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Typebesoin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Typebesoin get($primaryKey, $options = [])
 * @method \App\Model\Entity\Typebesoin findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Typebesoin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Typebesoin[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Typebesoin|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typebesoin saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typebesoin[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typebesoin[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typebesoin[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typebesoin[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TypebesoinsTable extends Table
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

        $this->setTable('typebesoins');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Listetypebesoins', [
            'foreignKey' => 'typebesoin_id',
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
        // $validator
        //     ->scalar('name')
        //     ->maxLength('name', 255)
        //     ->allowEmptyString('name');

        return $validator;
    }
}

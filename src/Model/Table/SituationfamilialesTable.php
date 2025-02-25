<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Situationfamiliales Model
 *
 * @property \App\Model\Table\PersonnelsTable&\Cake\ORM\Association\HasMany $Personnels
 *
 * @method \App\Model\Entity\Situationfamiliale newEmptyEntity()
 * @method \App\Model\Entity\Situationfamiliale newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Situationfamiliale[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Situationfamiliale get($primaryKey, $options = [])
 * @method \App\Model\Entity\Situationfamiliale findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Situationfamiliale patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Situationfamiliale[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Situationfamiliale|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Situationfamiliale saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Situationfamiliale[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Situationfamiliale[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Situationfamiliale[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Situationfamiliale[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SituationfamilialesTable extends Table
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

        $this->setTable('situationfamiliales');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Personnels', [
            'foreignKey' => 'situationfamiliale_id',
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
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        return $validator;
    }
}

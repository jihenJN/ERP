<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Typecartecarburants Model
 *
 * @property \App\Model\Table\CartecarburantsTable&\Cake\ORM\Association\HasMany $Cartecarburants
 *
 * @method \App\Model\Entity\Typecartecarburant newEmptyEntity()
 * @method \App\Model\Entity\Typecartecarburant newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Typecartecarburant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Typecartecarburant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Typecartecarburant findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Typecartecarburant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Typecartecarburant[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Typecartecarburant|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typecartecarburant saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typecartecarburant[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typecartecarburant[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typecartecarburant[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typecartecarburant[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TypecartecarburantsTable extends Table
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

        $this->setTable('typecartecarburants');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Cartecarburants', [
            'foreignKey' => 'typecartecarburant_id',
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

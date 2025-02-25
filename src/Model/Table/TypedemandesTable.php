<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Typedemandes Model
 *
 * @property \App\Model\Table\DemandeclientsTable&\Cake\ORM\Association\HasMany $Demandeclients
 *
 * @method \App\Model\Entity\Typedemande newEmptyEntity()
 * @method \App\Model\Entity\Typedemande newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Typedemande[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Typedemande get($primaryKey, $options = [])
 * @method \App\Model\Entity\Typedemande findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Typedemande patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Typedemande[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Typedemande|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typedemande saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typedemande[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typedemande[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typedemande[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typedemande[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TypedemandesTable extends Table
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

        $this->setTable('typedemandes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Demandeclients', [
            'foreignKey' => 'typedemande_id',
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

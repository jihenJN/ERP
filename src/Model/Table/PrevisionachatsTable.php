<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Previsionachats Model
 *
 * @method \App\Model\Entity\Previsionachat newEmptyEntity()
 * @method \App\Model\Entity\Previsionachat newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Previsionachat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Previsionachat get($primaryKey, $options = [])
 * @method \App\Model\Entity\Previsionachat findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Previsionachat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Previsionachat[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Previsionachat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Previsionachat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Previsionachat[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Previsionachat[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Previsionachat[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Previsionachat[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PrevisionachatsTable extends Table
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

        $this->setTable('previsionachats');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // $this->belongsTo('Depots', [
        //     'foreignKey' => 'depot_id',
        //     'joinType' => 'INNER',
        // ]);
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

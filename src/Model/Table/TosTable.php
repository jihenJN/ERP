<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tos Model
 *
 * @property \App\Model\Table\PiecereglementsTable&\Cake\ORM\Association\HasMany $Piecereglements
 *
 * @method \App\Model\Entity\To newEmptyEntity()
 * @method \App\Model\Entity\To newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\To[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\To get($primaryKey, $options = [])
 * @method \App\Model\Entity\To findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\To patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\To[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\To|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\To saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\To[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\To[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\To[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\To[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TosTable extends Table
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

        $this->setTable('tos');
        $this->setDisplayField('name');

        $this->hasMany('Piecereglements', [
            'foreignKey' => 'to_id',
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
            ->integer('id')
            ->requirePresence('id', 'create')
            ->notEmptyString('id');

        $validator
            ->numeric('name')
            ->allowEmptyString('name');

        return $validator;
    }
}

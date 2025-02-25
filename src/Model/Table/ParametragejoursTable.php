<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parametragejours Model
 *
 * @method \App\Model\Entity\Parametragejour newEmptyEntity()
 * @method \App\Model\Entity\Parametragejour newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Parametragejour[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Parametragejour get($primaryKey, $options = [])
 * @method \App\Model\Entity\Parametragejour findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Parametragejour patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Parametragejour[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Parametragejour|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parametragejour saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parametragejour[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parametragejour[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parametragejour[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parametragejour[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ParametragejoursTable extends Table
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

        $this->setTable('parametragejours');
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
            ->integer('nbrejours')
            ->allowEmptyString('nbrejours');

        return $validator;
    }
}

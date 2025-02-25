<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Timbres Model
 *
 * @method \App\Model\Entity\Timbre newEmptyEntity()
 * @method \App\Model\Entity\Timbre newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Timbre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Timbre get($primaryKey, $options = [])
 * @method \App\Model\Entity\Timbre findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Timbre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Timbre[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Timbre|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timbre saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timbre[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Timbre[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Timbre[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Timbre[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TimbresTable extends Table
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

        $this->setTable('timbres');
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
            ->decimal('timbre')
            ->requirePresence('timbre', 'create')
            ->notEmptyString('timbre');

        return $validator;
    }
}

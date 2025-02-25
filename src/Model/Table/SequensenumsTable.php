<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sequensenums Model
 *
 * @method \App\Model\Entity\Sequensenum newEmptyEntity()
 * @method \App\Model\Entity\Sequensenum newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sequensenum[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sequensenum get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sequensenum findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sequensenum patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sequensenum[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sequensenum|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sequensenum saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sequensenum[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sequensenum[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sequensenum[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sequensenum[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SequensenumsTable extends Table
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

        $this->setTable('sequensenums');
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
            ->scalar('valeur')
            ->maxLength('valeur', 255)
            ->allowEmptyString('valeur');

        return $validator;
    }
}

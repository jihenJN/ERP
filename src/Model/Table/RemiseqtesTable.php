<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Remiseqtes Model
 *
 * @method \App\Model\Entity\Remiseqte newEmptyEntity()
 * @method \App\Model\Entity\Remiseqte newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Remiseqte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Remiseqte get($primaryKey, $options = [])
 * @method \App\Model\Entity\Remiseqte findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Remiseqte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Remiseqte[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Remiseqte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Remiseqte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Remiseqte[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Remiseqte[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Remiseqte[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Remiseqte[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RemiseqtesTable extends Table
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

        $this->setTable('remiseqtes');
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
            ->integer('pourcentage')
            ->requirePresence('pourcentage', 'create')
            ->notEmptyString('pourcentage');

        $validator
            ->scalar('code')
            ->maxLength('code', 255)
            ->requirePresence('code', 'create')
            ->notEmptyString('code');

        $validator
            ->decimal('qtemin')
            ->allowEmptyString('qtemin');

        $validator
            ->decimal('qtemax')
            ->allowEmptyString('qtemax');

        return $validator;
    }
}

<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Uaprincipals Model
 *
 * @property \App\Model\Table\UnitesTable&\Cake\ORM\Association\BelongsTo $Unites
 *
 * @method \App\Model\Entity\Uaprincipal newEmptyEntity()
 * @method \App\Model\Entity\Uaprincipal newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Uaprincipal[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Uaprincipal get($primaryKey, $options = [])
 * @method \App\Model\Entity\Uaprincipal findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Uaprincipal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Uaprincipal[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Uaprincipal|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Uaprincipal saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Uaprincipal[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Uaprincipal[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Uaprincipal[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Uaprincipal[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UaprincipalsTable extends Table
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

        $this->setTable('uaprincipals');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Unitearticles', [
            'foreignKey' => 'unitearticle_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
            'joinType' => 'INNER',
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
            ->integer('unitearticle_id')
            ->notEmptyString('unitearticle_id');
        $validator
            ->integer('article_id')
            ->notEmptyString('article_id');

        $validator
            ->numeric('Correspand')
            ->requirePresence('Correspand', 'create')
            ->notEmptyString('Correspand');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('unitearticle_id', 'Unitearticles'), ['errorField' => 'unitearticle_id']);

        return $rules;
    }
}

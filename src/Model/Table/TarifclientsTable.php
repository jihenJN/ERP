<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tarifclients Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\TarifsTable&\Cake\ORM\Association\BelongsTo $Tarifs
 *
 * @method \App\Model\Entity\Tarifclient newEmptyEntity()
 * @method \App\Model\Entity\Tarifclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tarifclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tarifclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tarifclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tarifclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tarifclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tarifclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tarifclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tarifclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tarifclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tarifclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tarifclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TarifclientsTable extends Table
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

        $this->setTable('tarifclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Tarifs', [
            'foreignKey' => 'tarif_id',
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
//        $validator
//            ->integer('article_id')
//            ->requirePresence('article_id', 'create')
//            ->notEmptyString('article_id');
//
//        $validator
//            ->integer('tarif_id')
//            ->requirePresence('tarif_id', 'create')
//            ->notEmptyString('tarif_id');
//
//        $validator
//            ->decimal('prix')
//            ->allowEmptyString('prix');
//
//        $validator
//            ->date('date')
//            ->notEmptyDate('date');

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
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);
        $rules->add($rules->existsIn('tarif_id', 'Tarifs'), ['errorField' => 'tarif_id']);

        return $rules;
    }
}

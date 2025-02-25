<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Natlignepromoarticles Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\PromoarticlesTable&\Cake\ORM\Association\BelongsTo $Promoarticles
 *
 * @method \App\Model\Entity\Natlignepromoarticle newEmptyEntity()
 * @method \App\Model\Entity\Natlignepromoarticle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Natlignepromoarticle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Natlignepromoarticle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Natlignepromoarticle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Natlignepromoarticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Natlignepromoarticle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Natlignepromoarticle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Natlignepromoarticle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Natlignepromoarticle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Natlignepromoarticle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Natlignepromoarticle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Natlignepromoarticle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class NatlignepromoarticlesTable extends Table
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

        $this->setTable('natlignepromoarticles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Promoarticles', [
            'foreignKey' => 'promoarticle_id',
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
            ->integer('article_id')
            ->notEmptyString('article_id');

        $validator
            ->numeric('qte')
            ->requirePresence('qte', 'create')
            ->notEmptyString('qte');

        $validator
            ->numeric('value')
            ->requirePresence('value', 'create')
            ->notEmptyString('value');

        $validator
            ->integer('promoarticle_id')
            ->notEmptyString('promoarticle_id');

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
        $rules->add($rules->existsIn('promoarticle_id', 'Promoarticles'), ['errorField' => 'promoarticle_id']);

        return $rules;
    }
}

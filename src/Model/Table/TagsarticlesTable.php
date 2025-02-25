<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tagsarticles Model
 *
 * @property \App\Model\Table\ListetagsTable&\Cake\ORM\Association\BelongsTo $Listetags
 *
 * @method \App\Model\Entity\Tagsarticle newEmptyEntity()
 * @method \App\Model\Entity\Tagsarticle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tagsarticle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tagsarticle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tagsarticle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tagsarticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tagsarticle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tagsarticle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tagsarticle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tagsarticle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tagsarticle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tagsarticle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tagsarticle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TagsarticlesTable extends Table
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

        $this->setTable('tagsarticles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Listetags', [
            'foreignKey' => 'listetag_id',
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
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
            ->allowEmptyString('article_id');

        $validator
            ->integer('listetag_id')
            ->allowEmptyString('listetag_id');

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
        $rules->add($rules->existsIn('listetag_id', 'Listetags'), ['errorField' => 'listetag_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ligneinventaires Model
 *
 * @property \App\Model\Table\InventairesTable&\Cake\ORM\Association\BelongsTo $Inventaires
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 *
 * @method \App\Model\Entity\Ligneinventaire newEmptyEntity()
 * @method \App\Model\Entity\Ligneinventaire newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneinventaire[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneinventaire get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ligneinventaire findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ligneinventaire patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneinventaire[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneinventaire|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneinventaire saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneinventaire[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneinventaire[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneinventaire[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneinventaire[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LigneinventairesTable extends Table
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

        $this->setTable('ligneinventaires');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Inventaires', [
            'foreignKey' => 'inventaire_id',
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
            ->integer('inventaire_id')
            ->allowEmptyString('inventaire_id');

        $validator
            ->integer('article_id')
            ->allowEmptyString('article_id');

        $validator
            ->numeric('qteTheorique')
            ->allowEmptyString('qteTheorique');

        $validator
            ->numeric('qteStock')
            ->allowEmptyString('qteStock');

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
        $rules->add($rules->existsIn('inventaire_id', 'Inventaires'), ['errorField' => 'inventaire_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}

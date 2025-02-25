<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ligneplancommercials Model
 *
 * @property \App\Model\Table\PlancommercialindustrielsTable&\Cake\ORM\Association\BelongsTo $Plancommercialindustriels
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 *
 * @method \App\Model\Entity\Ligneplancommercial newEmptyEntity()
 * @method \App\Model\Entity\Ligneplancommercial newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneplancommercial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneplancommercial get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ligneplancommercial findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ligneplancommercial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneplancommercial[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneplancommercial|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneplancommercial saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneplancommercial[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneplancommercial[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneplancommercial[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneplancommercial[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LigneplancommercialsTable extends Table
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

        $this->setTable('ligneplancommercials');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Plancommercialindustriels', [
            'foreignKey' => 'plancommercialindustriel_id',
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
            ->integer('plancommercialindustriel_id')
            ->allowEmptyString('plancommercialindustriel_id');

        $validator
            ->integer('article_id')
            ->allowEmptyString('article_id');

        $validator
            ->integer('qtedisp')
            ->allowEmptyString('qtedisp');

        $validator
            ->integer('qtenonliv')
            ->allowEmptyString('qtenonliv');

        $validator
            ->integer('qtetheo')
            ->allowEmptyString('qtetheo');

        $validator
            ->integer('stockminart')
            ->allowEmptyString('stockminart');

        $validator
            ->integer('qtevendu')
            ->allowEmptyString('qtevendu');

        $validator
            ->integer('qtelivper')
            ->allowEmptyString('qtelivper');

        $validator
            ->integer('besoin')
            ->allowEmptyString('besoin');

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
        $rules->add($rules->existsIn('plancommercialindustriel_id', 'Plancommercialindustriels'), ['errorField' => 'plancommercialindustriel_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}

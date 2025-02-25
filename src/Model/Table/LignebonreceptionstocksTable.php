<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignebonreceptionstocks Model
 *
 * @property \App\Model\Table\BonreceptionstocksTable&\Cake\ORM\Association\BelongsTo $Bonreceptionstocks
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 *
 * @method \App\Model\Entity\Lignebonreceptionstock newEmptyEntity()
 * @method \App\Model\Entity\Lignebonreceptionstock newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonreceptionstock[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonreceptionstock get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignebonreceptionstock findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignebonreceptionstock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonreceptionstock[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonreceptionstock|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebonreceptionstock saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebonreceptionstock[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonreceptionstock[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonreceptionstock[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonreceptionstock[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignebonreceptionstocksTable extends Table
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

        $this->setTable('lignebonreceptionstocks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Bonreceptionstocks', [
            'foreignKey' => 'bonreceptionstock_id',
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
            ->integer('bonreceptionstock_id')
            ->allowEmptyString('bonreceptionstock_id');

        $validator
            ->integer('article_id')
            ->allowEmptyString('article_id');

        $validator
            ->integer('qte')
            ->allowEmptyString('qte');

        $validator
            ->decimal('prix')
            ->allowEmptyString('prix');

        // $validator
        //     ->decimal('total')
        //     ->requirePresence('total', 'create')
        //     ->notEmptyString('total');

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
        $rules->add($rules->existsIn('bonreceptionstock_id', 'Bonreceptionstocks'), ['errorField' => 'bonreceptionstock_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}

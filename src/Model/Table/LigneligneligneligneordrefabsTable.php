<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ligneligneligneligneordrefabs Model
 *
 * @property \App\Model\Table\LigneligneligneordrefabsTable&\Cake\ORM\Association\BelongsTo $Ligneligneligneordrefabs
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 *
 * @method \App\Model\Entity\Ligneligneligneligneordrefab newEmptyEntity()
 * @method \App\Model\Entity\Ligneligneligneligneordrefab newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneligneligneligneordrefab[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneligneligneligneordrefab get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ligneligneligneligneordrefab findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ligneligneligneligneordrefab patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneligneligneligneordrefab[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneligneligneligneordrefab|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneligneligneligneordrefab saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneligneligneligneordrefab[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneligneligneligneordrefab[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneligneligneligneordrefab[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneligneligneligneordrefab[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LigneligneligneligneordrefabsTable extends Table
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

        $this->setTable('ligneligneligneligneordrefabs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Ligneligneligneordrefabs', [
            'foreignKey' => 'ligneligneligneordrefab_id',
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
//        $validator
//            ->integer('ligneligneligneordrefab_id')
//            ->allowEmptyString('ligneligneligneordrefab_id');
//
//        $validator
//            ->integer('article_id')
//            ->allowEmptyString('article_id');
//
//        $validator
//            ->integer('qte')
//            ->allowEmptyString('qte');

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
//        $rules->add($rules->existsIn('ligneligneligneordrefab_id', 'Ligneligneligneordrefabs'), ['errorField' => 'ligneligneligneordrefab_id']);
//        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}

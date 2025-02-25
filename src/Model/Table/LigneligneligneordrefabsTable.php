<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ligneligneligneordrefabs Model
 *
 * @property \App\Model\Table\LigneligneordrefabsTable&\Cake\ORM\Association\BelongsTo $Ligneligneordrefabs
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\LigneligneligneligneordrefabsTable&\Cake\ORM\Association\HasMany $Ligneligneligneligneordrefabs
 *
 * @method \App\Model\Entity\Ligneligneligneordrefab newEmptyEntity()
 * @method \App\Model\Entity\Ligneligneligneordrefab newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneligneligneordrefab[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneligneligneordrefab get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ligneligneligneordrefab findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ligneligneligneordrefab patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneligneligneordrefab[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneligneligneordrefab|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneligneligneordrefab saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneligneligneordrefab[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneligneligneordrefab[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneligneligneordrefab[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneligneligneordrefab[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LigneligneligneordrefabsTable extends Table
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

        $this->setTable('ligneligneligneordrefabs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Ligneligneordrefabs', [
            'foreignKey' => 'ligneligneordrefab_id',
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Ligneligneligneligneordrefabs', [
            'foreignKey' => 'ligneligneligneordrefab_id',
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
//            ->integer('ligneligneordrefab_id')
//            ->allowEmptyString('ligneligneordrefab_id');
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
//        $rules->add($rules->existsIn('ligneligneordrefab_id', 'Ligneligneordrefabs'), ['errorField' => 'ligneligneordrefab_id']);
//        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}

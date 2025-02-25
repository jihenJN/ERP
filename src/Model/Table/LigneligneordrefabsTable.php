<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ligneligneordrefabs Model
 *
 * @property \App\Model\Table\LigneordrefabricationsTable&\Cake\ORM\Association\BelongsTo $Ligneordrefabrications
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\LigneligneligneordrefabsTable&\Cake\ORM\Association\HasMany $Ligneligneligneordrefabs
 *
 * @method \App\Model\Entity\Ligneligneordrefab newEmptyEntity()
 * @method \App\Model\Entity\Ligneligneordrefab newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneligneordrefab[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneligneordrefab get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ligneligneordrefab findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ligneligneordrefab patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneligneordrefab[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneligneordrefab|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneligneordrefab saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneligneordrefab[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneligneordrefab[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneligneordrefab[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneligneordrefab[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LigneligneordrefabsTable extends Table
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

        $this->setTable('ligneligneordrefabs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Ligneordrefabrications', [
            'foreignKey' => 'ligneordrefabrications_id',
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Ligneligneligneordrefabs', [
            'foreignKey' => 'ligneligneordrefab_id',
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
//            ->integer('ligneordrefabrications_id')
//            ->allowEmptyString('ligneordrefabrications_id');
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
//        $rules->add($rules->existsIn('ligneordrefabrications_id', 'Ligneordrefabrications'), ['errorField' => 'ligneordrefabrications_id']);
//        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}

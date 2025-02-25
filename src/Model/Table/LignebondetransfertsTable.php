<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignebondetransferts Model
 *
 * @property \App\Model\Table\BondetransfertsTable&\Cake\ORM\Association\BelongsTo $Bondetransferts
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\BondechargementsTable&\Cake\ORM\Association\BelongsTo $Bondechargements
 *
 * @method \App\Model\Entity\Lignebondetransfert newEmptyEntity()
 * @method \App\Model\Entity\Lignebondetransfert newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebondetransfert[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebondetransfert get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignebondetransfert findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignebondetransfert patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebondetransfert[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebondetransfert|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebondetransfert saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebondetransfert[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebondetransfert[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebondetransfert[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebondetransfert[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignebondetransfertsTable extends Table
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

        $this->setTable('lignebondetransferts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Bondetransferts', [
            'foreignKey' => 'bondetransfert_id',
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
        ]);
        $this->belongsTo('Bondechargements', [
            'foreignKey' => 'bondechargement_id',
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
            ->integer('bondetransfert_id')
            ->allowEmptyString('bondetransfert_id');

        $validator
            ->integer('article_id')
            ->allowEmptyString('article_id');

        $validator
            ->integer('qte')
            ->allowEmptyString('qte');

        $validator
            ->integer('qteliv')
            ->allowEmptyString('qteliv');

        // $validator
        //     ->integer('bondechargement_id')
        //     ->requirePresence('bondechargement_id', 'create')
        //     ->notEmptyString('bondechargement_id');

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
        $rules->add($rules->existsIn('bondetransfert_id', 'Bondetransferts'), ['errorField' => 'bondetransfert_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);
        $rules->add($rules->existsIn('bondechargement_id', 'Bondechargements'), ['errorField' => 'bondechargement_id']);

        return $rules;
    }
}

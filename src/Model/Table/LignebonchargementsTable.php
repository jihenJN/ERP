<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignebonchargements Model
 *
 * @property \App\Model\Table\BondechargementsTable&\Cake\ORM\Association\BelongsTo $Bondechargements
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 *
 * @method \App\Model\Entity\Lignebonchargement newEmptyEntity()
 * @method \App\Model\Entity\Lignebonchargement newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonchargement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonchargement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignebonchargement findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignebonchargement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonchargement[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonchargement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebonchargement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebonchargement[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonchargement[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonchargement[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonchargement[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignebonchargementsTable extends Table
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

        $this->setTable('lignebonchargements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Bondechargements', [
            'foreignKey' => 'bondechargement_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
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
            ->integer('bondechargement_id')
            ->requirePresence('bondechargement_id', 'create')
            ->notEmptyString('bondechargement_id');

        $validator
            ->integer('article_id')
            ->requirePresence('article_id', 'create')
            ->notEmptyString('article_id');

        // $validator
        //     ->decimal('prix')
        //     ->requirePresence('prix', 'create')
        //     ->notEmptyString('prix');

        $validator
            ->integer('qte')
            ->requirePresence('qte', 'create')
            ->notEmptyString('qte');

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
        $rules->add($rules->existsIn('bondechargement_id', 'Bondechargements'), ['errorField' => 'bondechargement_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignebonderetoures Model
 *
 * @property \App\Model\Table\BonderetouresTable&\Cake\ORM\Association\BelongsTo $Bonderetoures
 *
 * @method \App\Model\Entity\Lignebonderetoure newEmptyEntity()
 * @method \App\Model\Entity\Lignebonderetoure newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonderetoure[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonderetoure get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignebonderetoure findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignebonderetoure patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonderetoure[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonderetoure|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebonderetoure saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebonderetoure[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonderetoure[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonderetoure[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonderetoure[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignebonderetouresTable extends Table
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

        $this->setTable('lignebonderetoures');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Bonderetoures', [
            'foreignKey' => 'bonderetoure_id',
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
            ->requirePresence('article_id', 'create')
            ->notEmptyString('article_id');

        $validator
            ->integer('qte')
            ->requirePresence('qte', 'create')
            ->notEmptyString('qte');

        $validator
            ->integer('qtestock')
            ->requirePresence('qtestock', 'create')
            ->notEmptyString('qtestock');

        $validator
            ->integer('bonderetoure_id')
            ->notEmptyString('bonderetoure_id');

        $validator
            ->integer('couleur_id')
            ->allowEmptyString('couleur_id');

        $validator
            ->integer('dimension_id')
            ->allowEmptyString('dimension_id');

        $validator
            ->integer('categorie_id')
            ->allowEmptyString('categorie_id');

        $validator
            ->integer('famille_id')
            ->allowEmptyString('famille_id');

        $validator
            ->integer('sousfamille1_id')
            ->allowEmptyString('sousfamille1_id');

        $validator
            ->integer('sousfamille2_id')
            ->allowEmptyString('sousfamille2_id');

        $validator
            ->integer('unite_id')
            ->allowEmptyString('unite_id');

        $validator
            ->integer('tva_id')
            ->allowEmptyString('tva_id');

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
        $rules->add($rules->existsIn('bonderetoure_id', 'Bonderetoures'), ['errorField' => 'bonderetoure_id']);

        return $rules;
    }
}

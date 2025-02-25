<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Listecompterendus Model
 *
 * @property \App\Model\Table\CompterendusTable&\Cake\ORM\Association\BelongsTo $Compterendus
 * @property \App\Model\Table\VisitesTable&\Cake\ORM\Association\BelongsTo $Visites
 *
 * @method \App\Model\Entity\Listecompterendus newEmptyEntity()
 * @method \App\Model\Entity\Listecompterendus newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Listecompterendus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Listecompterendus get($primaryKey, $options = [])
 * @method \App\Model\Entity\Listecompterendus findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Listecompterendus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Listecompterendus[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Listecompterendus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Listecompterendus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Listecompterendus[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Listecompterendus[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Listecompterendus[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Listecompterendus[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ListecompterendusTable extends Table
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

        $this->setTable('listecompterendus');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Compterendus', [
            'foreignKey' => 'compterendu_id',
        ]);
        $this->belongsTo('Visites', [
            'foreignKey' => 'visite_id',
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
        // $validator
        //     ->integer('compterendu_id')
        //     ->allowEmptyString('compterendu_id');

        // $validator
        //     ->integer('visite_id')
        //     ->allowEmptyString('visite_id');

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
        $rules->add($rules->existsIn('compterendu_id', 'Compterendus'), ['errorField' => 'compterendu_id']);
        $rules->add($rules->existsIn('visite_id', 'Visites'), ['errorField' => 'visite_id']);

        return $rules;
    }
}

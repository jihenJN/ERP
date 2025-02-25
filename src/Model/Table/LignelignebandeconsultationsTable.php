<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignelignebandeconsultations Model
 *
 * @property \App\Model\Table\DemandeoffredeprixesTable&\Cake\ORM\Association\BelongsTo $Demandeoffredeprixes
 * @property \App\Model\Table\FournisseursTable&\Cake\ORM\Association\BelongsTo $Fournisseurs
 *
 * @method \App\Model\Entity\Lignelignebandeconsultation newEmptyEntity()
 * @method \App\Model\Entity\Lignelignebandeconsultation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignelignebandeconsultation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignelignebandeconsultation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignelignebandeconsultation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignelignebandeconsultation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignelignebandeconsultation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignelignebandeconsultation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignelignebandeconsultation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignelignebandeconsultation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignelignebandeconsultation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignelignebandeconsultation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignelignebandeconsultation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignelignebandeconsultationsTable extends Table
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

        $this->setTable('lignelignebandeconsultations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Demandeoffredeprixes', [
            'foreignKey' => 'demandeoffredeprix_id',
        ]);
        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'fournisseur_id',
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
            ->integer('demandeoffredeprix_id')
            ->allowEmptyString('demandeoffredeprix_id');

        $validator
            ->integer('fournisseur_id')
            ->allowEmptyString('fournisseur_id');

        $validator
            ->scalar('nameF')
            ->maxLength('nameF', 255)
            ->allowEmptyString('nameF');

        $validator
            ->decimal('t')
            ->allowEmptyString('t');

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
        $rules->add($rules->existsIn('demandeoffredeprix_id', 'Demandeoffredeprixes'), ['errorField' => 'demandeoffredeprix_id']);
        $rules->add($rules->existsIn('fournisseur_id', 'Fournisseurs'), ['errorField' => 'fournisseur_id']);

        return $rules;
    }
}

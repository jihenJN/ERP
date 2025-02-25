<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ligneordrepaiements Model
 *
 * @property \App\Model\Table\ChequesTable&\Cake\ORM\Association\BelongsTo $Cheques
 * @property \App\Model\Table\ComptesTable&\Cake\ORM\Association\BelongsTo $Comptes
 * @property \App\Model\Table\SocietesTable&\Cake\ORM\Association\BelongsTo $Societes
 *
 * @method \App\Model\Entity\Ligneordrepaiement newEmptyEntity()
 * @method \App\Model\Entity\Ligneordrepaiement newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneordrepaiement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneordrepaiement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ligneordrepaiement findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ligneordrepaiement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneordrepaiement[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneordrepaiement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneordrepaiement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneordrepaiement[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneordrepaiement[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneordrepaiement[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneordrepaiement[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LigneordrepaiementsTable extends Table
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

        $this->setTable('ligneordrepaiements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Cheques', [
            'foreignKey' => 'cheque_id',
        ]);
        $this->belongsTo('Comptes', [
            'foreignKey' => 'compte_id',
        ]);
        $this->belongsTo('Societes', [
            'foreignKey' => 'societe_id',
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
            ->integer('paiement_id')
            ->allowEmptyString('paiement_id');

        $validator
            ->allowEmptyString('reglement_id');

        $validator
            ->integer('ordrepaiement_id')
            ->allowEmptyString('ordrepaiement_id');

        $validator
            ->decimal('montant')
            ->allowEmptyString('montant');

        $validator
            ->decimal('intericecredit')
            ->allowEmptyString('intericecredit');

        $validator
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->integer('carnetcheque_id')
            ->allowEmptyString('carnetcheque_id');

        $validator
            ->integer('cheque_id')
            ->allowEmptyString('cheque_id');

        $validator
            ->scalar('num')
            ->maxLength('num', 255)
            ->allowEmptyString('num');

        $validator
            ->date('echance')
            ->allowEmptyDate('echance');

        $validator
            ->integer('compte_id')
            ->allowEmptyString('compte_id');

        $validator
            ->decimal('montant_brut')
            ->allowEmptyString('montant_brut');

        $validator
            ->decimal('montant_net')
            ->allowEmptyString('montant_net');

        $validator
            ->integer('to_id')
            ->allowEmptyString('to_id');

        $validator
            ->integer('societe_id')
            ->allowEmptyString('societe_id');

        $validator
            ->scalar('situation')
            ->maxLength('situation', 255)
            ->allowEmptyString('situation');

        $validator
            ->scalar('numeroachat')
            ->maxLength('numeroachat', 255)
            ->allowEmptyString('numeroachat');

        $validator
            ->integer('importation_id')
            ->notEmptyString('importation_id');

        $validator
            ->decimal('montantdevise')
            ->allowEmptyString('montantdevise');

        $validator
            ->scalar('nbrmoins')
            ->maxLength('nbrmoins', 255)
            ->allowEmptyString('nbrmoins');

        $validator
            ->integer('etatpiecereglement_id')
            ->allowEmptyString('etatpiecereglement_id');

        $validator
            ->integer('traitecredit_id')
            ->allowEmptyString('traitecredit_id');

        $validator
            ->integer('reglefournisseur')
            ->allowEmptyString('reglefournisseur');

        $validator
            ->integer('credit')
            ->allowEmptyString('credit');

        $validator
            ->decimal('montantfrs')
            ->allowEmptyString('montantfrs');

        $validator
            ->integer('impaye_regler')
            ->allowEmptyString('impaye_regler');

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
        $rules->add($rules->existsIn('cheque_id', 'Cheques'), ['errorField' => 'cheque_id']);
        $rules->add($rules->existsIn('compte_id', 'Comptes'), ['errorField' => 'compte_id']);
        $rules->add($rules->existsIn('societe_id', 'Societes'), ['errorField' => 'societe_id']);

        return $rules;
    }
}

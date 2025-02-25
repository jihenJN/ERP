<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Piecereglementclients Model
 *
 * @property \App\Model\Table\ReglementclientsTable&\Cake\ORM\Association\BelongsTo $Reglementclients
 * @property \App\Model\Table\ComptesTable&\Cake\ORM\Association\BelongsTo $Comptes
 * @property \App\Model\Table\LignereglementclientsTable&\Cake\ORM\Association\HasMany $Lignereglementclients
 * @property \App\Model\Table\SituationpiecereglementclientsTable&\Cake\ORM\Association\HasMany $Situationpiecereglementclients
 *
 * @method \App\Model\Entity\Piecereglementclient newEmptyEntity()
 * @method \App\Model\Entity\Piecereglementclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Piecereglementclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Piecereglementclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Piecereglementclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Piecereglementclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Piecereglementclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Piecereglementclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Piecereglementclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Piecereglementclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Piecereglementclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Piecereglementclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Piecereglementclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PiecereglementclientsTable extends Table
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

        $this->setTable('piecereglementclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->belongsTo('Paiements', [
            'foreignKey' => 'paiement_id',
        ]);
        $this->belongsTo('Tos', [
            'foreignKey' => 'to_id',
        ]);



        $this->belongsTo('Banques', [
            'foreignKey' => 'banque_id',
        ]);
        $this->belongsTo('Comptes', [
            'foreignKey' => 'compte_id',
        ]);

        
        $this->belongsTo('Caisses', [
            'foreignKey' => 'caisse_id',
        ]);
        $this->belongsTo('Reglementclients', [
            'foreignKey' => 'reglementclient_id',
        ]);
      
        $this->belongsTo('Etats', [
            'foreignKey' => 'etat_id',
        ]);
        $this->hasMany('Lignereglementclients', [
            'foreignKey' => 'piecereglementclient_id',
        ]);
        $this->hasMany('Situationpiecereglementclients', [
            'foreignKey' => 'piecereglementclient_id',
        ]);
        $this->hasMany('Etatreglementclients', [
            'foreignKey' => 'piecereglementclient_id',
            'joinType' => 'LEFT', // Adjust if needed
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
        //     ->integer('paiement_id')
        //     ->allowEmptyString('paiement_id');

        // $validator
        //     ->allowEmptyString('reglementclient_id');

        // $validator
        //     ->decimal('montant')
        //     ->allowEmptyString('montant');

        // $validator
        //     ->scalar('num')
        //     ->maxLength('num', 255)
        //     ->allowEmptyString('num');

        // $validator
        //     ->date('echance')
        //     ->allowEmptyDate('echance');

        // $validator
        // ->integer('banque_id')
        // ->allowEmptyString('banque_id');

        // $validator
        //     ->decimal('montant_brut')
        //     ->allowEmptyString('montant_brut');

        // $validator
        //     ->decimal('montant_net')
        //     ->allowEmptyString('montant_net');

        // $validator
        //     ->integer('to_id')
        //     ->allowEmptyString('to_id');

        // $validator
        //     ->integer('compte_id')
        //     ->allowEmptyString('compte_id');

        // $validator
        //     ->scalar('situation')
        //     ->maxLength('situation', 255)
        //     ->allowEmptyString('situation');

        // $validator
        //     ->date('datesituation')
        //     ->allowEmptyDate('datesituation');

        // $validator
        //     ->integer('reglement')
        //     ->allowEmptyString('reglement');

        // $validator
        //     ->decimal('mantantregler')
        //     ->allowEmptyString('mantantregler');

        // $validator
        //     ->integer('emi')
        //     ->allowEmptyString('emi');

        // $validator
        //     ->integer('envoye')
        //     ->allowEmptyString('envoye');

        // $validator
        //     ->integer('valide')
        //     ->allowEmptyString('valide');

        // $validator
        //     ->numeric('valeur')
        //     ->allowEmptyString('valeur');

        // $validator
        //     ->integer('etat_id')
        //     ->allowEmptyString('etat_id');

        // $validator
        //     ->scalar('numeropieceintegre')
        //     ->maxLength('numeropieceintegre', 255)
        //     ->allowEmptyString('numeropieceintegre');

        // $validator
        //     ->scalar('prop')
        //     ->maxLength('prop', 255)
        //     ->allowEmptyString('prop');

        // $validator
        //     ->decimal('commission')
        //     ->allowEmptyString('commission');

        // $validator
        //     ->decimal('tvacommission')
        //     ->allowEmptyString('tvacommission');

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
        $rules->add($rules->existsIn('reglementclient_id', 'Reglementclients'), ['errorField' => 'reglementclient_id']);
        $rules->add($rules->existsIn('compte_id', 'Comptes'), ['errorField' => 'compte_id']);

        return $rules;
    }
}

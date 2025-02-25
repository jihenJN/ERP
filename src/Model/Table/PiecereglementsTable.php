<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Piecereglements Model
 *
 * @property \App\Model\Table\PaiementsTable&\Cake\ORM\Association\BelongsTo $Paiements
 * @property \App\Model\Table\ReglementsTable&\Cake\ORM\Association\BelongsTo $Reglements
 * @property \App\Model\Table\CarnetchequesTable&\Cake\ORM\Association\BelongsTo $Carnetcheques
 * @property \App\Model\Table\ChequesTable&\Cake\ORM\Association\BelongsTo $Cheques
 * @property \App\Model\Table\ComptesTable&\Cake\ORM\Association\BelongsTo $Comptes
 * @property \App\Model\Table\TosTable&\Cake\ORM\Association\BelongsTo $Tos
 * @property \App\Model\Table\SocietesTable&\Cake\ORM\Association\BelongsTo $Societes
 * @property \App\Model\Table\ImportationsTable&\Cake\ORM\Association\BelongsTo $Importations
 * @property \App\Model\Table\EtatpiecereglementsTable&\Cake\ORM\Association\BelongsTo $Etatpiecereglements
 * @property \App\Model\Table\TraitecreditsTable&\Cake\ORM\Association\BelongsTo $Traitecredits
 * @property \App\Model\Table\FournisseursTable&\Cake\ORM\Association\BelongsTo $Fournisseurs
 * @property \App\Model\Table\LignereglementsTable&\Cake\ORM\Association\HasMany $Lignereglements
 *
 * @method \App\Model\Entity\Piecereglement newEmptyEntity()
 * @method \App\Model\Entity\Piecereglement newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Piecereglement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Piecereglement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Piecereglement findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Piecereglement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Piecereglement[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Piecereglement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Piecereglement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Piecereglement[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Piecereglement[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Piecereglement[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Piecereglement[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PiecereglementsTable extends Table
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

        //        $this->setTable('piecereglements');
        //        $this->setDisplayField('id');
        //        $this->setPrimaryKey('id');
        //
        $this->belongsTo('Paiements', [
            'foreignKey' => 'paiement_id',
        ]);

        $this->belongsTo('Reglements', [
            'foreignKey' => 'reglement_id',
        ]);



        $this->belongsTo('Cheques', [
            'foreignKey' => 'cheque_id',
        ]);
        $this->belongsTo('Carnetcheques', [
            'foreignKey' => 'carnetcheque_id',
        ]);
        $this->belongsTo('Banques', [
            'foreignKey' => 'banque_id',
        ]);
        $this->belongsTo('Comptes', [
            'foreignKey' => 'compte_id',
        ]);


        
        $this->belongsTo('Etats', [
            'foreignKey' => 'etat_id',
        ]);



               $this->belongsTo('Tos', [
                   'foreignKey' => 'to_id',
               ]);
            //    $this->belongsTo('Societes', [
            //        'foreignKey' => 'societe_id',
            //    ]);
               $this->belongsTo('Importations', [
                   'foreignKey' => 'importation_id',
                //    'joinType' => 'INNER',
               ]);
               $this->belongsTo('Etatpiecereglements', [
                   'foreignKey' => 'etatpiecereglement_id',
               ]);
            //    $this->belongsTo('Traitecredits', [
            //        'foreignKey' => 'traitecredit_id',
            //    ]);
               $this->belongsTo('Fournisseurs', [
                   'foreignKey' => 'fournisseur_id',
                //    'joinType' => 'INNER',
               ]);
               $this->hasMany('Lignereglements', [
                   'foreignKey' => 'piecereglement_id',
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
        //        $rules->add($rules->existsIn('paiement_id', 'Paiements'), ['errorField' => 'paiement_id']);
        //        $rules->add($rules->existsIn('reglement_id', 'Reglements'), ['errorField' => 'reglement_id']);
        //        $rules->add($rules->existsIn('carnetcheque_id', 'Carnetcheques'), ['errorField' => 'carnetcheque_id']);
        //    //    $rules->add($rules->existsIn('cheque_id', 'Cheques'), ['errorField' => 'cheque_id']);
        //        $rules->add($rules->existsIn('compte_id', 'Comptes'), ['errorField' => 'compte_id']);
        //        $rules->add($rules->existsIn('to_id', 'Tos'), ['errorField' => 'to_id']);
        //        $rules->add($rules->existsIn('societe_id', 'Societes'), ['errorField' => 'societe_id']);
        //        $rules->add($rules->existsIn('importation_id', 'Importations'), ['errorField' => 'importation_id']);
        //        $rules->add($rules->existsIn('etatpiecereglement_id', 'Etatpiecereglements'), ['errorField' => 'etatpiecereglement_id']);
        //        $rules->add($rules->existsIn('traitecredit_id', 'Traitecredits'), ['errorField' => 'traitecredit_id']);
        //        $rules->add($rules->existsIn('fournisseur_id', 'Fournisseurs'), ['errorField' => 'fournisseur_id']);

        return $rules;
    }
}

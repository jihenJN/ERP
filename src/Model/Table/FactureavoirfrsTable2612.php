<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Factureavoirfrs Model
 *
 * @property \App\Model\Table\UtilisateursTable&\Cake\ORM\Association\BelongsTo $Utilisateurs
 * @property \App\Model\Table\LignefactureavoirfrsTable&\Cake\ORM\Association\HasMany $Lignefactureavoirfrs
 *
 * @method \App\Model\Entity\Factureavoirfr newEmptyEntity()
 * @method \App\Model\Entity\Factureavoirfr newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Factureavoirfr[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Factureavoirfr get($primaryKey, $options = [])
 * @method \App\Model\Entity\Factureavoirfr findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Factureavoirfr patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Factureavoirfr[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Factureavoirfr|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Factureavoirfr saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Factureavoirfr[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Factureavoirfr[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Factureavoirfr[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Factureavoirfr[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FactureavoirfrsTable extends Table
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

        $this->setTable('factureavoirfrs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Utilisateurs', [
            'foreignKey' => 'utilisateur_id',
        ]);
        $this->hasMany('Lignefactureavoirfrs', [
            'foreignKey' => 'factureavoirfr_id',
        ]);
        $this->belongsTo('Pointdeventes', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'factureavoirfr_id',
        ]);
        $this->belongsTo('Bonreceptionstocks', [
            'foreignKey' => 'bonreceptionstock_id',
        ]);
        // $this->belongsTo('Typefactures', [
        //     'foreignKey' => 'typefacture_id',
        // ]);
        $this->belongsTo('Exercices', [
            'foreignKey' => 'exercice_id',
        ]);
        $this->belongsTo('Factures', [
            'foreignKey' => 'facture_id',
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
            ->scalar('model')
            ->maxLength('model', 255)
            ->allowEmptyString('model');

        $validator
            ->integer('fournisseur_id')
            ->allowEmptyString('fournisseur_id');

        $validator
            ->integer('importation_id')
            ->allowEmptyString('importation_id');

        $validator
            ->integer('utilisateur_id')
            ->allowEmptyString('utilisateur_id');

        $validator
            ->decimal('timbre_id')
            ->allowEmptyString('timbre_id');

        $validator
            ->decimal('tauxtva')
            ->allowEmptyString('tauxtva');

        $validator
            ->decimal('tauxfodec')
            ->allowEmptyString('tauxfodec');

        $validator
            ->integer('facture_id')
            ->allowEmptyString('facture_id');

        $validator
            ->integer('bonreceptionstock_id')
            ->allowEmptyString('bonreceptionstock_id');

        $validator
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->decimal('remise')
            ->allowEmptyString('remise');

        $validator
            ->integer('tva_id')
            ->allowEmptyString('tva_id');

        $validator
            ->decimal('fodec')
            ->allowEmptyString('fodec');

        $validator
            ->decimal('totalht')
            ->allowEmptyString('totalht');

        $validator
            ->decimal('totalttc')
            ->allowEmptyString('totalttc');

        $validator
            ->decimal('fret')
            ->allowEmptyString('fret');

        $validator
            ->decimal('avoir')
            ->allowEmptyString('avoir');

        $validator
            ->decimal('mdinitial')
            ->allowEmptyString('mdinitial');

        $validator
            ->decimal('montantdevise')
            ->allowEmptyString('montantdevise');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 255)
            ->allowEmptyString('numero');

        $validator
            ->integer('numeroconca')
            ->allowEmptyString('numeroconca');

        $validator
            ->integer('typefacture_id')
            ->allowEmptyString('typefacture_id');

        $validator
            ->integer('etat')
            ->allowEmptyString('etat');

        $validator
            ->integer('pointdevente_id')
            ->allowEmptyString('pointdevente_id');

        $validator
            ->integer('exercice_id')
            ->allowEmptyString('exercice_id');

        $validator
            ->scalar('des')
            ->maxLength('des', 255)
            ->allowEmptyString('des');

        $validator
            ->scalar('numeropieceintegre')
            ->maxLength('numeropieceintegre', 255)
            ->allowEmptyString('numeropieceintegre');

        $validator
            ->scalar('numavoirfournisseur')
            ->maxLength('numavoirfournisseur', 255)
            ->allowEmptyString('numavoirfournisseur');

        $validator
            ->numeric('taux')
            ->allowEmptyString('taux');

        $validator
            ->integer('devise_id')
            ->allowEmptyString('devise_id');

        $validator
            ->integer('type')
            ->allowEmptyString('type');

        $validator
            ->integer('totalht1')
            ->allowEmptyString('totalht1');

        $validator
            ->integer('totaltva1')
            ->allowEmptyString('totaltva1');

        $validator
            ->integer('totalttc1')
            ->allowEmptyString('totalttc1');

        $validator
            ->integer('totalrem')
            ->allowEmptyString('totalrem');

        $validator
            ->integer('adressecl')
            ->allowEmptyString('adressecl');

        $validator
            ->integer('tva1')
            ->allowEmptyString('tva1');

        $validator
            ->integer('ttc1')
            ->allowEmptyString('ttc1');

        $validator
            ->integer('fodec1')
            ->allowEmptyString('fodec1');

        $validator
            ->integer('rem')
            ->allowEmptyString('rem');

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
        $rules->add($rules->existsIn('utilisateur_id', 'Utilisateurs'), ['errorField' => 'utilisateur_id']);

        return $rules;
    }
}

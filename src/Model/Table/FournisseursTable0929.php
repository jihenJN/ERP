<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fournisseurs Model
 *
 * @property \App\Model\Table\TypeutilisateursTable&\Cake\ORM\Association\BelongsTo $Typeutilisateurs
 * @property \App\Model\Table\TypelocalisationsTable&\Cake\ORM\Association\BelongsTo $Typelocalisations
 * @property \App\Model\Table\VillesTable&\Cake\ORM\Association\BelongsTo $Villes
 * @property \App\Model\Table\RegionsTable&\Cake\ORM\Association\BelongsTo $Regions
 * @property \App\Model\Table\PaysTable&\Cake\ORM\Association\BelongsTo $Pays
 * @property \App\Model\Table\PaiementsTable&\Cake\ORM\Association\BelongsTo $Paiements
 * @property \App\Model\Table\DevisesTable&\Cake\ORM\Association\BelongsTo $Devises
 * @property \App\Model\Table\AdresselivraisonfournisseursTable&\Cake\ORM\Association\HasMany $Adresselivraisonfournisseurs
 * @property \App\Model\Table\ArticlefournisseursTable&\Cake\ORM\Association\HasMany $Articlefournisseurs
 * @property \App\Model\Table\BandeconsultationsTable&\Cake\ORM\Association\HasMany $Bandeconsultations
 * @property \App\Model\Table\CommandesTable&\Cake\ORM\Association\HasMany $Commandes
 * @property \App\Model\Table\ExonerationsTable&\Cake\ORM\Association\HasMany $Exonerations
 * @property \App\Model\Table\FacturesTable&\Cake\ORM\Association\HasMany $Factures
 * @property \App\Model\Table\FournisseurbanquesTable&\Cake\ORM\Association\HasMany $Fournisseurbanques
 * @property \App\Model\Table\FournisseurresponsablesTable&\Cake\ORM\Association\HasMany $Fournisseurresponsables
 * @property \App\Model\Table\LignebandeconsultationsTable&\Cake\ORM\Association\HasMany $Lignebandeconsultations
 * @property \App\Model\Table\LignecommandesTable&\Cake\ORM\Association\HasMany $Lignecommandes
 * @property \App\Model\Table\LignedemandeoffredeprixesTable&\Cake\ORM\Association\HasMany $Lignedemandeoffredeprixes
 * @property \App\Model\Table\LignefacturesTable&\Cake\ORM\Association\HasMany $Lignefactures
 * @property \App\Model\Table\LignelignebandeconsultationsTable&\Cake\ORM\Association\HasMany $Lignelignebandeconsultations
 * @property \App\Model\Table\LignelivraisonsTable&\Cake\ORM\Association\HasMany $Lignelivraisons
 * @property \App\Model\Table\LivraisonsTable&\Cake\ORM\Association\HasMany $Livraisons
 * @property \App\Model\Table\LivraisonsancTable&\Cake\ORM\Association\HasMany $Livraisonsanc
 *
 * @method \App\Model\Entity\Fournisseur newEmptyEntity()
 * @method \App\Model\Entity\Fournisseur newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Fournisseur[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fournisseur get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fournisseur findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Fournisseur patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fournisseur[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fournisseur|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fournisseur saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fournisseur[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fournisseur[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fournisseur[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fournisseur[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FournisseursTable extends Table
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

        $this->setTable('fournisseurs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Typeutilisateurs', [
            'foreignKey' => 'typeutilisateur_id',
        ]);
        $this->belongsTo('Typelocalisations', [
            'foreignKey' => 'typelocalisation_id',
        ]);
         $this->belongsTo('Fournisseurresponsables', [
            'foreignKey' => 'fournisseur_id',
        ]);
        
            $this->belongsTo('Exonerations', [
            'foreignKey' => 'exoneration_id',
        ]);
            
              $this->hasMany('Typeexons', [
            'foreignKey' => 'typeexons_id',
        ]);
            
        
        
        $this->belongsTo('Villes', [
            'foreignKey' => 'ville_id',
        ]);
        $this->belongsTo('Regions', [
            'foreignKey' => 'region_id',
        ]);
        $this->belongsTo('Pays', [
            'foreignKey' => 'pay_id',
        ]);
        $this->belongsTo('Paiements', [
            'foreignKey' => 'paiement_id',
        ]);
        $this->belongsTo('Devises', [
            'foreignKey' => 'devise_id',
        ]);
        $this->hasMany('Adresselivraisonfournisseurs', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->hasMany('Articlefournisseurs', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->hasMany('Bandeconsultations', [
            'foreignKey' => 'fournisseur_id',
        ]);
       
        $this->hasMany('Exonerations', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->hasMany('Factures', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->hasMany('Fournisseurbanques', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->hasMany('Fournisseurresponsables', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->hasMany('Lignebandeconsultations', [
            'foreignKey' => 'fournisseur_id',
        ]);
    
        $this->hasMany('Lignedemandeoffredeprixes', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->hasMany('Lignefactures', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->hasMany('Lignelignebandeconsultations', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->hasMany('Lignelivraisons', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->hasMany('Livraisons', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->hasMany('Livraisonsanc', [
            'foreignKey' => 'fournisseur_id',
        ]);
          $this->hasMany('Fournisseurresponsable', [
            'foreignKey' => 'fournisseur_id',
        ]);
           $this->hasMany('Exoneration', [
            'foreignKey' => 'fournisseur_id',
        ]);
           $this->hasMany('Typeexon', [
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('typeutilisateur_id')
            ->allowEmptyString('typeutilisateur_id');

        $validator
            ->integer('typelocalisation_id')
            ->allowEmptyString('typelocalisation_id');

        $validator
            ->scalar('compte_comptable')
            ->maxLength('compte_comptable', 255)
            ->requirePresence('compte_comptable', 'create')
            ->notEmptyString('compte_comptable');

        $validator
            ->integer('ville_id')
            ->allowEmptyString('ville_id');

        $validator
            ->scalar('codepostal')
            ->maxLength('codepostal', 255)
            ->allowEmptyString('codepostal');

        $validator
            ->integer('region_id')
            ->allowEmptyString('region_id');

        $validator
            ->integer('pay_id')
            ->allowEmptyString('pay_id');

        $validator
            ->scalar('activite')
            ->maxLength('activite', 255)
            ->allowEmptyString('activite');

        $validator
            ->scalar('secteur')
            ->maxLength('secteur', 255)
            ->allowEmptyString('secteur');

        $validator
            ->integer('tel')
            ->allowEmptyString('tel');

        $validator
            ->integer('fax')
            ->allowEmptyString('fax');

        $validator
            ->scalar('mail')
            ->maxLength('mail', 255)
            ->allowEmptyString('mail');

        $validator
            ->scalar('site')
            ->maxLength('site', 255)
            ->allowEmptyString('site');

        $validator
            ->integer('paiement_id')
            ->allowEmptyString('paiement_id');

        $validator
            ->integer('devise_id')
            ->allowEmptyString('devise_id');

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
        $rules->add($rules->existsIn('typeutilisateur_id', 'Typeutilisateurs'), ['errorField' => 'typeutilisateur_id']);
        $rules->add($rules->existsIn('typelocalisation_id', 'Typelocalisations'), ['errorField' => 'typelocalisation_id']);
        $rules->add($rules->existsIn('ville_id', 'Villes'), ['errorField' => 'ville_id']);
        $rules->add($rules->existsIn('region_id', 'Regions'), ['errorField' => 'region_id']);
        $rules->add($rules->existsIn('pay_id', 'Pays'), ['errorField' => 'pay_id']);
        $rules->add($rules->existsIn('paiement_id', 'Paiements'), ['errorField' => 'paiement_id']);
        $rules->add($rules->existsIn('devise_id', 'Devises'), ['errorField' => 'devise_id']);

        return $rules;
    }
}

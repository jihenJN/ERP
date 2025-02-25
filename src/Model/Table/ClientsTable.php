<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clients Model
 *
 * @property \App\Model\Table\CommercialsTable&\Cake\ORM\Association\BelongsTo $Commercials
 * @property \App\Model\Table\GouvernoratsTable&\Cake\ORM\Association\BelongsTo $Gouvernorats
 * @property \App\Model\Table\PaysTable&\Cake\ORM\Association\BelongsTo $Pays
 * @property \App\Model\Table\TypeutilisateursTable&\Cake\ORM\Association\BelongsTo $Typeutilisateurs
 * @property \App\Model\Table\TypeexonerationsTable&\Cake\ORM\Association\BelongsTo $Typeexonerations
 * @property \App\Model\Table\PaiementsTable&\Cake\ORM\Association\BelongsTo $Paiements
 * @property \App\Model\Table\TypeclientsTable&\Cake\ORM\Association\BelongsTo $Typeclients
 * @property \App\Model\Table\PointdeventesTable&\Cake\ORM\Association\BelongsTo $Pointdeventes
 * @property \App\Model\Table\AdresselivraisonclientsTable&\Cake\ORM\Association\HasMany $Adresselivraisonclients
 * @property \App\Model\Table\ArticleClientTable&\Cake\ORM\Association\HasMany $ArticleClient
 * @property \App\Model\Table\BondereservationsTable&\Cake\ORM\Association\HasMany $Bondereservations
 * @property \App\Model\Table\BonlivraisonsTable&\Cake\ORM\Association\HasMany $Bonlivraisons
 * @property \App\Model\Table\ClientarticlesTable&\Cake\ORM\Association\HasMany $Clientarticles
 * @property \App\Model\Table\ClientbanquesTable&\Cake\ORM\Association\HasMany $Clientbanques
 * @property \App\Model\Table\ClientexonerationsTable&\Cake\ORM\Association\HasMany $Clientexonerations
 * @property \App\Model\Table\ClientfourchettesTable&\Cake\ORM\Association\HasMany $Clientfourchettes
 * @property \App\Model\Table\ClientresponsablesTable&\Cake\ORM\Association\HasMany $Clientresponsables
 * @property \App\Model\Table\CommandeclientsTable&\Cake\ORM\Association\HasMany $Commandeclients
 * @property \App\Model\Table\FactureclientsTable&\Cake\ORM\Association\HasMany $Factureclients
 * @property \App\Model\Table\FourchettesTable&\Cake\ORM\Association\HasMany $Fourchettes
 *
 * @method \App\Model\Entity\Client newEmptyEntity()
 * @method \App\Model\Entity\Client newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Client[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Client get($primaryKey, $options = [])
 * @method \App\Model\Entity\Client findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Client patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Client[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Client|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClientsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('clients');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Commercials', [
            'foreignKey' => 'commercial_id',
        ]);
        $this->belongsTo('Gouvernorats', [
            'foreignKey' => 'gouvernorat_id',
           
        ]);
        $this->belongsTo('Typeutilisateurs', [
            'foreignKey' => 'typeutilisateur_id',
        ]);
//        $this->belongsTo('Typeexonerations', [
//            'foreignKey' => 'typeexoneration_id',
//        ]);
        $this->belongsTo('Paiements', [
            'foreignKey' => 'paiement_id',
        ]);
        $this->belongsTo('Typeclients', [
            'foreignKey' => 'typeclient_id',
        ]);
        $this->belongsTo('Pointdeventes', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Adresselivraisonclients', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('ArticleClient', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('Bondereservations', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('Bonlivraisons', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('Clientarticles', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('Clientbanques', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('Clientexonerations', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('Clientfourchettes', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('Clientresponsables', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('Commandeclients', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('Factureclients', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('Fourchettes', [
            'foreignKey' => 'client_id',
        ]);

        $this->belongsTo('Localites', [
            'foreignKey' => 'localite_id',
        ]);
        $this->belongsTo('Pays', [
            'foreignKey' => 'pay_id',
        ]);

        $this->belongsTo('Types', [
            'foreignKey' => 'type_id',
        ]);
        $this->belongsTo('Delegations', [
            'foreignKey' => 'delegation_id',
        ]);
    }




  







    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator {







        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker {
        $rules->add($rules->existsIn('commercial_id', 'Commercials'), ['errorField' => 'commercial_id']);
        $rules->add($rules->existsIn('gouvernorat_id', 'Gouvernorats'), ['errorField' => 'gouvernorat_id']);
        $rules->add($rules->existsIn('typeutilisateur_id', 'Typeutilisateurs'), ['errorField' => 'typeutilisateur_id']);
       // $rules->add($rules->existsIn('typeexoneration_id', 'Typeexonerations'), ['errorField' => 'typeexoneration_id']);
        $rules->add($rules->existsIn('paiement_id', 'Paiements'), ['errorField' => 'paiement_id']);
        $rules->add($rules->existsIn('typeclient_id', 'Typeclients'), ['errorField' => 'typeclient_id']);
        $rules->add($rules->existsIn('pointdevente_id', 'Pointdeventes'), ['errorField' => 'pointdevente_id']);

        return $rules;
    }

}

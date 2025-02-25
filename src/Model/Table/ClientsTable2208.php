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
 * @property \App\Model\Table\TypeutilisateursTable&\Cake\ORM\Association\BelongsTo $Typeutilisateurs
 * @property \App\Model\Table\VillesTable&\Cake\ORM\Association\BelongsTo $Villes
 * @property \App\Model\Table\RegionsTable&\Cake\ORM\Association\BelongsTo $Regions
 * @property \App\Model\Table\PaysTable&\Cake\ORM\Association\BelongsTo $Pays
 * @property \App\Model\Table\ActivitesTable&\Cake\ORM\Association\BelongsTo $Activites
 * @property \App\Model\Table\PaiementsTable&\Cake\ORM\Association\BelongsTo $Paiements
 * @property \App\Model\Table\AdresselivraisonclientsTable&\Cake\ORM\Association\HasMany $Adresselivraisonclients
 * @property \App\Model\Table\BondereservationsTable&\Cake\ORM\Association\HasMany $Bondereservations
 * @property \App\Model\Table\BonlivraisonsTable&\Cake\ORM\Association\HasMany $Bonlivraisons
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
class ClientsTable extends Table
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

        $this->setTable('clients');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Typeutilisateurs', [
            'foreignKey' => 'typeutilisateur_id',
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
        $this->belongsTo('Activites', [
            'foreignKey' => 'activite_id',
        ]);
        $this->belongsTo('Paiements', [
            'foreignKey' => 'paiement_id',
        ]);
        $this->hasMany('Adresselivraisonclients', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('Bondereservations', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('Bonlivraisons', [
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
            ->allowEmptyString('name');

        $validator
            ->scalar('comptecomptable')
            ->maxLength('comptecomptable', 255)
            ->allowEmptyString('comptecomptable');

        $validator
            ->integer('typeutilisateur_id')
            ->allowEmptyString('typeutilisateur_id');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 255)
            ->allowEmptyString('tel');

        $validator
            ->integer('CIN')
            ->allowEmptyString('CIN');

        $validator
            ->date('datenaissance')
            ->allowEmptyDate('datenaissance');

        $validator
            ->scalar('adresse')
            ->maxLength('adresse', 255)
            ->allowEmptyString('adresse');

        $validator
            ->scalar('matriculefiscale')
            ->maxLength('matriculefiscale', 255)
            ->allowEmptyString('matriculefiscale');

        $validator
            ->scalar('passeport')
            ->maxLength('passeport', 255)
            ->allowEmptyString('passeport');

        $validator
            ->scalar('cartesejour')
            ->maxLength('cartesejour', 255)
            ->allowEmptyString('cartesejour');

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
            ->integer('activite_id')
            ->allowEmptyString('activite_id');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 255)
            ->allowEmptyString('fax');

        $validator
            ->scalar('mail')
            ->maxLength('mail', 255)
            ->allowEmptyString('mail');

        $validator
            ->scalar('numregistre')
            ->maxLength('numregistre', 255)
            ->allowEmptyString('numregistre');

        $validator
            ->decimal('plafonttheorique')
            ->allowEmptyString('plafonttheorique');

        $validator
            ->integer('box')
            ->allowEmptyString('box');

        $validator
            ->integer('paiement_id')
            ->allowEmptyString('paiement_id');

        $validator
            ->integer('exoneration')
            ->allowEmptyString('exoneration');

        $validator
            ->scalar('typeR')
            ->maxLength('typeR', 255)
            ->allowEmptyString('typeR');

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
        $rules->add($rules->existsIn('ville_id', 'Villes'), ['errorField' => 'ville_id']);
        $rules->add($rules->existsIn('region_id', 'Regions'), ['errorField' => 'region_id']);
        $rules->add($rules->existsIn('pay_id', 'Pays'), ['errorField' => 'pay_id']);
        $rules->add($rules->existsIn('activite_id', 'Activites'), ['errorField' => 'activite_id']);
        $rules->add($rules->existsIn('paiement_id', 'Paiements'), ['errorField' => 'paiement_id']);

        return $rules;
    }
}

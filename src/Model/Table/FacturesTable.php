<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Factures Model
 *
 * @property \App\Model\Table\LivraisonsTable&\Cake\ORM\Association\BelongsTo $Livraisons
 * @property \App\Model\Table\FournisseursTable&\Cake\ORM\Association\BelongsTo $Fournisseurs
 * @property \App\Model\Table\PointdeventesTable&\Cake\ORM\Association\BelongsTo $Pointdeventes
 * @property \App\Model\Table\DepotsTable&\Cake\ORM\Association\BelongsTo $Depots
 *  * @property \App\Model\Table\DevicesTable&\Cake\ORM\Association\BelongsTo $Devices

 * @property \App\Model\Table\CartecarburantsTable&\Cake\ORM\Association\BelongsTo $Cartecarburants
 * @property \App\Model\Table\MaterieltransportsTable&\Cake\ORM\Association\BelongsTo $Materieltransports
 * @property \App\Model\Table\AdresselivraisonfournisseursTable&\Cake\ORM\Association\BelongsTo $Adresselivraisonfournisseurs
 * @property \App\Model\Table\LignefacturesTable&\Cake\ORM\Association\HasMany $Lignefactures
 * @property \App\Model\Table\LivraisonsTable&\Cake\ORM\Association\HasMany $Livraisons
 *
 * @method \App\Model\Entity\Facture newEmptyEntity()
 * @method \App\Model\Entity\Facture newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Facture[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Facture get($primaryKey, $options = [])
 * @method \App\Model\Entity\Facture findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Facture patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Facture[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Facture|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Facture saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Facture[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Facture[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Facture[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Facture[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FacturesTable extends Table
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

        $this->setTable('factures');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // $this->belongsTo('Livraisons', [
        //     'foreignKey' => 'livraison_id',
        // ]);
        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'fournisseur_id',
        ]);

        // $this->belongsTo('Pointdeventes', [
        //     'foreignKey' => 'pointdevente_id',
        // ]);

        $this->belongsTo('Depots', [
            'foreignKey' => 'depot_id',
        ]);

        $this->belongsTo('Paiements', [
            'foreignKey' => 'paiement_id',
        ]);
        $this->belongsTo('Machines', [
            'foreignKey' => 'machine_id',
        ]);

        $this->belongsTo('Services', [
            'foreignKey' => 'service_id',
        ]);

        

        $this->belongsTo('Devises', [
            'foreignKey' => 'devise_id',
        ]);

        $this->belongsTo('Typefactures', [
            'foreignKey' => 'typefacture_id',
        ]);

        $this->belongsTo('Dossierimportations', [
            'foreignKey' => 'dossierimportation_id',
        ]);



        $this->belongsTo('Cartecarburants', [
            'foreignKey' => 'cartecarburant_id',
        ]);
        $this->belongsTo('Materieltransports', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->belongsTo('Adresselivraisonfournisseurs', [
            'foreignKey' => 'adresselivraisonfournisseur_id',
        ]);
        $this->hasMany('Lignefactures', [
            'foreignKey' => 'facture_id',
        ]);
        $this->hasMany('Livraisons', [
            'foreignKey' => 'facture_id',
        ]);
          $this->hasMany('Personnels', [
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
        // $validator
        //     ->integer('livraison_id')
        //     ->allowEmptyString('livraison_id');

        // $validator
        //     ->scalar('numero')
        //     ->maxLength('numero', 255)
        //     ->allowEmptyString('numero');

        // $validator
        //     ->dateTime('date')
        //     ->allowEmptyDateTime('date');

        // $validator
        //     ->integer('fournisseur_id')
        //     ->allowEmptyString('fournisseur_id');

        // $validator
        //     ->integer('pointdevente_id')
        //     ->allowEmptyString('pointdevente_id');

        // $validator
        //     ->integer('depot_id')
        //     ->allowEmptyString('depot_id');

        // $validator
        //     ->integer('cartecarburant_id')
        //     ->allowEmptyString('cartecarburant_id');

        // $validator
        //     ->integer('materieltransport_id')
        //     ->allowEmptyString('materieltransport_id');


        //     $validator
        //     ->integer('device_id')
        //     ->allowEmptyString('device_id');

        // $validator
        //     ->integer('chauffeur')
        //     ->allowEmptyString('chauffeur');

        // $validator
        //     ->integer('convoyeur')
        //     ->allowEmptyString('convoyeur');

        // $validator
        //     ->integer('valide')
        //     ->notEmptyString('valide');

        // $validator
        //     ->decimal('remise')
        //     ->allowEmptyString('remise');

        // $validator
        //     ->decimal('tva')
        //     ->allowEmptyString('tva');

        // $validator
        //     ->decimal('fodec')
        //     ->allowEmptyString('fodec');

        // $validator
        //     ->decimal('ttc')
        //     ->allowEmptyString('ttc');

        // $validator
        //     ->decimal('punht')
        //     ->allowEmptyString('punht');

        // $validator
        //     ->integer('adresselivraisonfournisseur_id')
        //     ->allowEmptyString('adresselivraisonfournisseur_id');

        // $validator
        //     ->integer('kilometragedepart')
        //     ->allowEmptyString('kilometragedepart');

        // $validator
        //     ->integer('kilometragearrive')
        //     ->allowEmptyString('kilometragearrive');

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
        // $rules->add($rules->existsIn('livraison_id', 'Livraisons'), ['errorField' => 'livraison_id']);
        $rules->add($rules->existsIn('fournisseur_id', 'Fournisseurs'), ['errorField' => 'fournisseur_id']);
       // $rules->add($rules->existsIn('pointdevente_id', 'Pointdeventes'), ['errorField' => 'pointdevente_id']);
        $rules->add($rules->existsIn('depot_id', 'Depots'), ['errorField' => 'depot_id']);
        $rules->add($rules->existsIn('cartecarburant_id', 'Cartecarburants'), ['errorField' => 'cartecarburant_id']);
        $rules->add($rules->existsIn('materieltransport_id', 'Materieltransports'), ['errorField' => 'materieltransport_id']);
        $rules->add($rules->existsIn('adresselivraisonfournisseur_id', 'Adresselivraisonfournisseurs'), ['errorField' => 'adresselivraisonfournisseur_id']);

        return $rules;
    }
}

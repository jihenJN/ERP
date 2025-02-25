<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Factureavoirs Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\TypefacturesTable&\Cake\ORM\Association\BelongsTo $Typefactures
 * @property \App\Model\Table\LignefactureavoirsTable&\Cake\ORM\Association\HasMany $Lignefactureavoirs
 *
 * @method \App\Model\Entity\Factureavoir newEmptyEntity()
 * @method \App\Model\Entity\Factureavoir newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Factureavoir[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Factureavoir get($primaryKey, $options = [])
 * @method \App\Model\Entity\Factureavoir findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Factureavoir patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Factureavoir[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Factureavoir|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Factureavoir saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Factureavoir[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Factureavoir[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Factureavoir[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Factureavoir[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FactureavoirsTable extends Table
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

        $this->setTable('factureavoirs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
        ]);
        $this->belongsTo('Depots', [
            'foreignKey' => 'depot_id',
        ]);
        $this->belongsTo('Commercials', [
            'foreignKey' => 'commercial_id',
        ]);
        $this->belongsTo('Typefactures', [
            'foreignKey' => 'typefacture_id',
        ]);
        $this->belongsTo('Factureclients', [
            'foreignKey' => 'factureclient_id',
        ]);
        $this->belongsTo('Timbres', [
            'foreignKey' => 'timbre_id',
         
        ]);
        $this->hasMany('Lignefactureavoirs', [
            'foreignKey' => 'factureavoir_id',
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
        //     ->integer('client_id')
        //     ->allowEmptyString('client_id');

        // $validator
        //     ->integer('utilisateur_id')
        //     ->allowEmptyString('utilisateur_id');

        // $validator
        //     ->integer('factureclient_id')
        //     ->allowEmptyString('factureclient_id');

        // $validator
        //     ->dateTime('date')
        //     ->allowEmptyDateTime('date');

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
        //     ->decimal('tauxtva')
        //     ->allowEmptyString('tauxtva');

        // $validator
        //     ->decimal('tauxfodec')
        //     ->allowEmptyString('tauxfodec');

        // $validator
        //     ->decimal('totalht')
        //     ->allowEmptyString('totalht');

        // $validator
        //     ->decimal('totalttc')
        //     ->allowEmptyString('totalttc');

        // $validator
        //     ->decimal('totalttc_anc')
        //     ->allowEmptyString('totalttc_anc');

        // $validator
        //     ->decimal('montant_regle')
        //     ->notEmptyString('montant_regle');

        // $validator
        //     ->scalar('numero')
        //     ->maxLength('numero', 255)
        //     ->allowEmptyString('numero');

        // $validator
        //     ->scalar('numeroconca')
        //     ->maxLength('numeroconca', 250)
        //     ->allowEmptyString('numeroconca');

        // $validator
        //     ->integer('typefacture_id')
        //     ->allowEmptyString('typefacture_id');

        // $validator
        //     ->integer('etat')
        //     ->allowEmptyString('etat');

        // $validator
        //     ->integer('pointdevente_id')
        //     ->allowEmptyString('pointdevente_id');

        // $validator
        //     ->integer('exercice_id')
        //     ->allowEmptyString('exercice_id');

        // $validator
        //     ->scalar('des')
        //     ->maxLength('des', 255)
        //     ->allowEmptyString('des');

        // $validator
        //     ->scalar('source')
        //     ->maxLength('source', 255)
        //     ->allowEmptyString('source');

        // $validator
        //     ->decimal('timbre_id')
        //     ->allowEmptyString('timbre_id');

        // $validator
        //     ->scalar('name')
        //     ->maxLength('name', 255)
        //     ->allowEmptyString('name');

        // $validator
        //     ->scalar('adressclient')
        //     ->maxLength('adressclient', 500)
        //     ->allowEmptyString('adressclient');

        // $validator
        //     ->scalar('matriculefiscaleclient')
        //     ->maxLength('matriculefiscaleclient', 500)
        //     ->allowEmptyString('matriculefiscaleclient');

        // $validator
        //     ->scalar('telclient')
        //     ->maxLength('telclient', 500)
        //     ->allowEmptyString('telclient');

        // $validator
        //     ->integer('typeclient_id')
        //     ->allowEmptyString('typeclient_id');

        // $validator
        //     ->scalar('numeropieceintegre')
        //     ->maxLength('numeropieceintegre', 255)
        //     ->allowEmptyString('numeropieceintegre');

        // $validator
        //     ->integer('depot_id')
        //     ->allowEmptyString('depot_id');

        // $validator
        //     ->integer('ttc1')
        //     ->allowEmptyString('ttc1');

        // $validator
        //     ->integer('tva1')
        //     ->allowEmptyString('tva1');

        // $validator
        //     ->integer('fodec1')
        //     ->allowEmptyString('fodec1');

        // $validator
        //     ->integer('rem')
        //     ->allowEmptyString('rem');

        // $validator
        //     ->integer('totalht1')
        //     ->allowEmptyString('totalht1');

        // $validator
        //     ->integer('totaltva1')
        //     ->allowEmptyString('totaltva1');

        // $validator
        //     ->integer('totalttc1')
        //     ->allowEmptyString('totalttc1');

        // $validator
        //     ->integer('totalrem')
        //     ->allowEmptyString('totalrem');

        // $validator
        //     ->integer('adressecl')
        //     ->allowEmptyString('adressecl');

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
        $rules->add($rules->existsIn('client_id', 'Clients'), ['errorField' => 'client_id']);
        $rules->add($rules->existsIn('typefacture_id', 'Typefactures'), ['errorField' => 'typefacture_id']);

        return $rules;
    }
}

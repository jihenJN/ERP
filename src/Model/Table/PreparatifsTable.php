<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Preparatifs Model
 *
 * @property \App\Model\Table\BonlivraisonsTable&\Cake\ORM\Association\BelongsTo $Bonlivraisons
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\PointdeventesTable&\Cake\ORM\Association\BelongsTo $Pointdeventes
 * @property \App\Model\Table\DepotsTable&\Cake\ORM\Association\BelongsTo $Depots
 * @property \App\Model\Table\MaterieltransportsTable&\Cake\ORM\Association\BelongsTo $Materieltransports
 * @property \App\Model\Table\CartecarburantsTable&\Cake\ORM\Association\BelongsTo $Cartecarburants
 * @property \App\Model\Table\ChauffeursTable&\Cake\ORM\Association\BelongsTo $Chauffeurs
 * @property \App\Model\Table\ConvoyeursTable&\Cake\ORM\Association\BelongsTo $Convoyeurs
 * @property \App\Model\Table\FactureclientsTable&\Cake\ORM\Association\BelongsTo $Factureclients
 * @property \App\Model\Table\AdresselivraisonclientsTable&\Cake\ORM\Association\BelongsTo $Adresselivraisonclients
 * @property \App\Model\Table\CommandesTable&\Cake\ORM\Association\BelongsTo $Commandes
 *
 * @method \App\Model\Entity\Preparatif newEmptyEntity()
 * @method \App\Model\Entity\Preparatif newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Preparatif[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Preparatif get($primaryKey, $options = [])
 * @method \App\Model\Entity\Preparatif findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Preparatif patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Preparatif[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Preparatif|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Preparatif saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Preparatif[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Preparatif[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Preparatif[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Preparatif[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PreparatifsTable extends Table
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

        $this->setTable('preparatifs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Bonlivraisons', [
            'foreignKey' => 'bonlivraison_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Pointdeventes', [
            'foreignKey' => 'pointdevente_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Depots', [
            'foreignKey' => 'depot_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Materieltransports', [
            'foreignKey' => 'materieltransport_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cartecarburants', [
            'foreignKey' => 'cartecarburant_id',
            'joinType' => 'INNER',
        ]);
        
      
        $this->belongsTo('Factureclients', [
            'foreignKey' => 'factureclient_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Adresselivraisonclients', [
            'foreignKey' => 'adresselivraisonclient_id',
        ]);
        $this->belongsTo('Commandes', [
            'foreignKey' => 'commande_id',
            'joinType' => 'INNER',
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
            ->integer('bonlivraison_id')
            ->requirePresence('bonlivraison_id', 'create')
            ->notEmptyString('bonlivraison_id');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 50)
            ->requirePresence('numero', 'create')
            ->notEmptyString('numero');

        $validator
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmptyDateTime('date');

        $validator
            ->integer('client_id')
            ->requirePresence('client_id', 'create')
            ->notEmptyString('client_id');

        $validator
            ->integer('pointdevente_id')
            ->requirePresence('pointdevente_id', 'create')
            ->notEmptyString('pointdevente_id');

        $validator
            ->integer('depot_id')
            ->requirePresence('depot_id', 'create')
            ->notEmptyString('depot_id');

        $validator
            ->integer('materieltransport_id')
            ->requirePresence('materieltransport_id', 'create')
            ->notEmptyString('materieltransport_id');

        $validator
            ->integer('cartecarburant_id')
            ->requirePresence('cartecarburant_id', 'create')
            ->notEmptyString('cartecarburant_id');

    
        $validator
            ->decimal('totalht')
            ->requirePresence('totalht', 'create')
            ->notEmptyString('totalht');

        $validator
            ->decimal('totalttc')
            ->requirePresence('totalttc', 'create')
            ->notEmptyString('totalttc');

        $validator
            ->decimal('totalfodec')
            ->requirePresence('totalfodec', 'create')
            ->notEmptyString('totalfodec');

        $validator
            ->decimal('totalremise')
            ->requirePresence('totalremise', 'create')
            ->notEmptyString('totalremise');

        $validator
            ->decimal('totaltva')
            ->requirePresence('totaltva', 'create')
            ->notEmptyString('totaltva');

        $validator
            ->integer('factureclient_id')
            ->requirePresence('factureclient_id', 'create')
            ->notEmptyString('factureclient_id');

        $validator
            ->numeric('kilometragedepart')
            ->allowEmptyString('kilometragedepart');

        $validator
            ->numeric('kilometragearrive')
            ->allowEmptyString('kilometragearrive');

        $validator
            ->integer('adresselivraisonclient_id')
            ->allowEmptyString('adresselivraisonclient_id');

        $validator
            ->scalar('payementcomptant')
            ->maxLength('payementcomptant', 255)
            ->allowEmptyString('payementcomptant');

        $validator
            ->integer('poste')
            ->requirePresence('poste', 'create')
            ->notEmptyString('poste');

        $validator
            ->decimal('tpe')
            ->requirePresence('tpe', 'create')
            ->notEmptyString('tpe');

        $validator
            ->scalar('escompte')
            ->maxLength('escompte', 11)
            ->requirePresence('escompte', 'create')
            ->notEmptyString('escompte');

        $validator
            ->integer('commande_id')
            ->requirePresence('commande_id', 'create')
            ->notEmptyString('commande_id');

        $validator
            ->numeric('poidstotal')
            ->requirePresence('poidstotal', 'create')
            ->notEmptyString('poidstotal');

        $validator
            ->numeric('nbcartons')
            ->requirePresence('nbcartons', 'create')
            ->notEmptyString('nbcartons');

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
        $rules->add($rules->existsIn('bonlivraison_id', 'Bonlivraisons'), ['errorField' => 'bonlivraison_id']);
        $rules->add($rules->existsIn('client_id', 'Clients'), ['errorField' => 'client_id']);
        $rules->add($rules->existsIn('pointdevente_id', 'Pointdeventes'), ['errorField' => 'pointdevente_id']);
        $rules->add($rules->existsIn('depot_id', 'Depots'), ['errorField' => 'depot_id']);
        $rules->add($rules->existsIn('materieltransport_id', 'Materieltransports'), ['errorField' => 'materieltransport_id']);
        $rules->add($rules->existsIn('cartecarburant_id', 'Cartecarburants'), ['errorField' => 'cartecarburant_id']);
        $rules->add($rules->existsIn('factureclient_id', 'Factureclients'), ['errorField' => 'factureclient_id']);
        $rules->add($rules->existsIn('adresselivraisonclient_id', 'Adresselivraisonclients'), ['errorField' => 'adresselivraisonclient_id']);
        $rules->add($rules->existsIn('commande_id', 'Commandes'), ['errorField' => 'commande_id']);

        return $rules;
    }
}
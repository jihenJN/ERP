<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Commandeclients Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\PointdeventesTable&\Cake\ORM\Association\BelongsTo $Pointdeventes
 * @property \App\Model\Table\DepotsTable&\Cake\ORM\Association\BelongsTo $Depots
 * @property \App\Model\Table\CartecarburantsTable&\Cake\ORM\Association\BelongsTo $Cartecarburants
 * @property \App\Model\Table\MaterieltransportsTable&\Cake\ORM\Association\BelongsTo $Materieltransports
 * @property \App\Model\Table\BonlivraisonsTable&\Cake\ORM\Association\BelongsTo $Bonlivraisons
 * @property \App\Model\Table\BondereservationsTable&\Cake\ORM\Association\HasMany $Bondereservations
 * @property \App\Model\Table\LignebonlivraisonsTable&\Cake\ORM\Association\HasMany $Lignebonlivraisons
 * @property \App\Model\Table\LignecommandeclientsTable&\Cake\ORM\Association\HasMany $Lignecommandeclients
 *
 * @method \App\Model\Entity\Commandeclient newEmptyEntity()
 * @method \App\Model\Entity\Commandeclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Commandeclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Commandeclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Commandeclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Commandeclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Commandeclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Commandeclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commandeclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commandeclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commandeclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commandeclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commandeclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CommandeclientsTable extends Table
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

        $this->setTable('commandeclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

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
        $this->belongsTo('Cartecarburants', [
            'foreignKey' => 'cartecarburant_id',
        ]);
        $this->belongsTo('Materieltransports', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->belongsTo('Bonlivraisons', [
            'foreignKey' => 'bonlivraison_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Bondereservations', [
            'foreignKey' => 'commandeclient_id',
        ]);
        $this->hasMany('Lignebonlivraisons', [
            'foreignKey' => 'commandeclient_id',
        ]);
        $this->hasMany('Lignecommandeclients', [
            'foreignKey' => 'commandeclient_id',
        ]);
		 $this->hasMany('Notes', [
            'foreignKey' => 'commandeclient_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    // public function validationDefault(Validator $validator): Validator
    // {
    //     $validator
    //         ->scalar('code')
    //         ->maxLength('code', 11)
    //         ->requirePresence('code', 'create')
    //         ->notEmptyString('code');

    //     $validator
    //         ->integer('client_id')
    //         ->requirePresence('client_id', 'create')
    //         ->notEmptyString('client_id');

    //     $validator
    //         ->dateTime('date')
    //         ->requirePresence('date', 'create')
    //         ->notEmptyDateTime('date');

    //     $validator
    //         ->dateTime('datedecreation')
    //         ->requirePresence('datedecreation', 'create')
    //         ->notEmptyDateTime('datedecreation');

    //     $validator
    //         ->scalar('commentaire')
    //         ->requirePresence('commentaire', 'create')
    //         ->notEmptyString('commentaire');

    //     $validator
    //         ->integer('pointdevente_id')
    //         ->requirePresence('pointdevente_id', 'create')
    //         ->notEmptyString('pointdevente_id');

    //     $validator
    //         ->integer('depot_id')
    //         ->requirePresence('depot_id', 'create')
    //         ->notEmptyString('depot_id');

    //     $validator
    //         ->decimal('totalht')
    //         ->requirePresence('totalht', 'create')
    //         ->notEmptyString('totalht');

    //     $validator
    //         ->decimal('totalttc')
    //         ->requirePresence('totalttc', 'create')
    //         ->notEmptyString('totalttc');

    //     $validator
    //         ->decimal('totalremise')
    //         ->requirePresence('totalremise', 'create')
    //         ->notEmptyString('totalremise');

    //     $validator
    //         ->decimal('totaltva')
    //         ->requirePresence('totaltva', 'create')
    //         ->notEmptyString('totaltva');

    //     $validator
    //         ->decimal('totalfodec')
    //         ->requirePresence('totalfodec', 'create')
    //         ->notEmptyString('totalfodec');

    //     $validator
    //         ->integer('cartecarburant_id')
    //         ->allowEmptyString('cartecarburant_id');

    //     $validator
    //         ->integer('materieltransport_id')
    //         ->allowEmptyString('materieltransport_id');

    //     $validator
    //         ->integer('bonlivraison_id')
    //         ->requirePresence('bonlivraison_id', 'create')
    //         ->notEmptyString('bonlivraison_id');

    //     $validator
    //         ->integer('etatliv')
    //         ->notEmptyString('etatliv');

    //     return $validator;
    // }

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
        $rules->add($rules->existsIn('pointdevente_id', 'Pointdeventes'), ['errorField' => 'pointdevente_id']);
        $rules->add($rules->existsIn('depot_id', 'Depots'), ['errorField' => 'depot_id']);
        $rules->add($rules->existsIn('cartecarburant_id', 'Cartecarburants'), ['errorField' => 'cartecarburant_id']);
        $rules->add($rules->existsIn('materieltransport_id', 'Materieltransports'), ['errorField' => 'materieltransport_id']);
        $rules->add($rules->existsIn('bonlivraison_id', 'Bonlivraisons'), ['errorField' => 'bonlivraison_id']);

        return $rules;
    }
}

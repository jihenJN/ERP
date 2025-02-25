<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bondetransferts Model
 *
 * @property \App\Model\Table\PointdeventesTable&\Cake\ORM\Association\BelongsTo $Pointdeventes
 * @property \App\Model\Table\CartecarburantsTable&\Cake\ORM\Association\BelongsTo $Cartecarburants
 * @property \App\Model\Table\MaterieltransportsTable&\Cake\ORM\Association\BelongsTo $Materieltransports
 * @property \App\Model\Table\BonreceptionstocksTable&\Cake\ORM\Association\BelongsTo $Bonreceptionstocks
 * @property \App\Model\Table\BondechargementsTable&\Cake\ORM\Association\HasMany $Bondechargements
 * @property \App\Model\Table\LignebondetransfertsTable&\Cake\ORM\Association\HasMany $Lignebondetransferts
 *
 * @method \App\Model\Entity\Bondetransfert newEmptyEntity()
 * @method \App\Model\Entity\Bondetransfert newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Bondetransfert[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bondetransfert get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bondetransfert findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Bondetransfert patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bondetransfert[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bondetransfert|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bondetransfert saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bondetransfert[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bondetransfert[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bondetransfert[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bondetransfert[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BondetransfertsTable extends Table
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

        $this->setTable('bondetransferts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Pointdeventes', [
            'foreignKey' => 'pointdevente_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Pointdeventes', [
            'foreignKey' => 'pointdeventeentree_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Pointdeventes', [
            'foreignKey' => 'pointdeventesortie_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cartecarburants', [
            'foreignKey' => 'cartecarburant_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Depots', [
            'foreignKey' => 'depotarrive_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Depots', [
            'foreignKey' => 'depotsortie_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Personnels', [
            'foreignKey' => 'chauffeur_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Personnels', [
            'foreignKey' => 'conffaieur_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Materieltransports', [
            'foreignKey' => 'materieltransport_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Bonreceptionstocks', [
            'foreignKey' => 'bonreceptionstock_id',
        ]);
        $this->hasMany('Bondechargements', [
            'foreignKey' => 'bondetransfert_id',
        ]);
        $this->hasMany('Lignebondetransferts', [
            'foreignKey' => 'bondetransfert_id',
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
        //     ->scalar('numero')
        //     ->maxLength('numero', 255)
        //     ->requirePresence('numero', 'create')
        //     ->notEmptyString('numero');

        // $validator
        //     ->dateTime('date')
        //     ->requirePresence('date', 'create')
        //     ->notEmptyDateTime('date');

        // $validator
        //     ->integer('pointdevente_id')
        //     ->requirePresence('pointdevente_id', 'create');
        //    // ->notEmptyString('pointdevente_id');

        // $validator
        //     ->integer('cartecarburant_id')
        //     ->requirePresence('cartecarburant_id', 'create')
        //     ->notEmptyString('cartecarburant_id');

        // $validator
        //     ->integer('materieltransport_id')
        //     ->requirePresence('materieltransport_id', 'create')
        //     ->notEmptyString('materieltransport_id');

        // $validator
        //     ->integer('bonreceptionstock_id')
        //     ->allowEmptyString('bonreceptionstock_id');

        // $validator
        //     ->numeric('kilometragedepart')
        //     ->requirePresence('kilometragedepart', 'create')
        //     ->notEmptyString('kilometragedepart');

        // $validator
        //     ->numeric('kilometragearrive')
        //     ->requirePresence('kilometragearrive', 'create')
        //     ->notEmptyString('kilometragearrive');

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
        $rules->add($rules->existsIn('pointdevente_id', 'Pointdeventes'), ['errorField' => 'pointdevente_id']);
        $rules->add($rules->existsIn('cartecarburant_id', 'Cartecarburants'), ['errorField' => 'cartecarburant_id']);
        $rules->add($rules->existsIn('materieltransport_id', 'Materieltransports'), ['errorField' => 'materieltransport_id']);
        $rules->add($rules->existsIn('bonreceptionstock_id', 'Bonreceptionstocks'), ['errorField' => 'bonreceptionstock_id']);

        return $rules;
    }
}

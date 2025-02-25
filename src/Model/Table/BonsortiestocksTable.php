<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BonSortieStocks Model
 *
 * @property \App\Model\Table\PointdeventesTable&\Cake\ORM\Association\BelongsTo $Pointdeventes
 * @property \App\Model\Table\DepotsTable&\Cake\ORM\Association\BelongsTo $Depots
 * @property \App\Model\Table\MaterieltransportsTable&\Cake\ORM\Association\BelongsTo $Materieltransports
 * @property \App\Model\Table\CartecarburantsTable&\Cake\ORM\Association\BelongsTo $Cartecarburants
 * @property \App\Model\Table\LignebonsortiestocksTable&\Cake\ORM\Association\HasMany $Lignebonsortiestocks
 *
 * @method \App\Model\Entity\BonSortieStock newEmptyEntity()
 * @method \App\Model\Entity\BonSortieStock newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BonSortieStock[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BonSortieStock get($primaryKey, $options = [])
 * @method \App\Model\Entity\BonSortieStock findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BonSortieStock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BonSortieStock[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BonSortieStock|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BonSortieStock saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BonSortieStock[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BonSortieStock[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BonSortieStock[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BonSortieStock[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BonSortieStocksTable extends Table
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

        $this->setTable('bonsortiestocks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Pointdeventes', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->belongsTo('Depots', [
            'foreignKey' => 'depot_id',
        ]);
        $this->belongsTo('Typesorties', [
            'foreignKey' => 'typesortie_id',
        ]);
        $this->belongsTo('Materieltransports', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->belongsTo('Cartecarburants', [
            'foreignKey' => 'cartecarburant_id',
        ]);
        $this->belongsTo('Personnels', [
            'foreignKey' => 'conffaieur_id',
        ]);
        $this->belongsTo('Personnels', [
            'foreignKey' => 'chauffeur_id',
        ]);
        $this->hasMany('Lignebonsortiestocks', [
            'foreignKey' => 'bonsortiestock_id',
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
    //     $validator
    //         ->scalar('numero')
    //         ->maxLength('numero', 50)
    //         ->requirePresence('numero', 'create')
    //         ->notEmptyString('numero');

    //     $validator
    //         ->dateTime('date')
    //         ->allowEmptyDateTime('date');

    //     $validator
    //         ->integer('pointdevente_id')
    //         ->allowEmptyString('pointdevente_id');

    //     $validator
    //         ->integer('depot_id')
    //         ->allowEmptyString('depot_id');

        // $validator
        //     ->integer('materieltransport_id')
        //     ->allowEmptyString('materieltransport_id');

        // $validator
        //     ->integer('cartecarburant_id')
        //     ->allowEmptyString('cartecarburant_id');

        // $validator
        //     ->integer('conffaieur_id')
        //     ->allowEmptyString('conffaieur_id');

        // $validator
        //     ->integer('chauffeur_id')
        //     ->allowEmptyString('chauffeur_id');

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
        $rules->add($rules->existsIn('depot_id', 'Depots'), ['errorField' => 'depot_id']);
        $rules->add($rules->existsIn('materieltransport_id', 'Materieltransports'), ['errorField' => 'materieltransport_id']);
        $rules->add($rules->existsIn('cartecarburant_id', 'Cartecarburants'), ['errorField' => 'cartecarburant_id']);
        $rules->add($rules->existsIn('conffaieur_id', 'Personnels'), ['errorField' => 'conffaieur_id']);
        $rules->add($rules->existsIn('chauffeur_id', 'Personnels'), ['errorField' => 'chauffeur_id']);

        return $rules;
    }
}

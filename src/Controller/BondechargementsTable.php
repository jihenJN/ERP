<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bondechargements Model
 *
 * @property \App\Model\Table\PointdeventesTable&\Cake\ORM\Association\BelongsTo $Pointdeventes
 * @property \App\Model\Table\DepotsTable&\Cake\ORM\Association\BelongsTo $Depots
 * @property \App\Model\Table\BondetransfertsTable&\Cake\ORM\Association\BelongsTo $Bondetransferts
 * @property \App\Model\Table\LignebonchargementsTable&\Cake\ORM\Association\HasMany $Lignebonchargements
 * @property \App\Model\Table\LignebondetransfertsTable&\Cake\ORM\Association\HasMany $Lignebondetransferts
 *
 * @method \App\Model\Entity\Bondechargement newEmptyEntity()
 * @method \App\Model\Entity\Bondechargement newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Bondechargement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bondechargement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bondechargement findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Bondechargement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bondechargement[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bondechargement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bondechargement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bondechargement[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bondechargement[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bondechargement[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bondechargement[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BondechargementsTable extends Table
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

        $this->setTable('bondechargements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Pointdeventes', [
            'foreignKey' => 'pointdevente_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Depots', [
            'foreignKey' => 'depot_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Bondetransferts', [
            'foreignKey' => 'bondetransfert_id',
        ]);
        $this->hasMany('Lignebonchargements', [
            'foreignKey' => 'bondechargement_id',
        ]);
        $this->hasMany('Lignebondetransferts', [
            'foreignKey' => 'bondechargement_id',
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
            ->scalar('numero')
            ->maxLength('numero', 255)
            ->requirePresence('numero', 'create')
            ->notEmptyString('numero');

        $validator
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmptyDateTime('date');

        $validator
            ->integer('pointdevente_id')
            ->requirePresence('pointdevente_id', 'create')
            ->notEmptyString('pointdevente_id');

        $validator
            ->integer('depot_id')
            ->requirePresence('depot_id', 'create')
            ->notEmptyString('depot_id');

        $validator
            ->integer('bondetransfert_id')
            ->allowEmptyString('bondetransfert_id');

        $validator
            ->integer('etatliv')
            ->allowEmptyString('etatliv');

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
        $rules->add($rules->existsIn('bondetransfert_id', 'Bondetransferts'), ['errorField' => 'bondetransfert_id']);

        return $rules;
    }
}

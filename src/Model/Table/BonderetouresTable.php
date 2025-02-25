<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bonderetoures Model
 *
 * @property \App\Model\Table\LignebonderetouresTable&\Cake\ORM\Association\HasMany $Lignebonderetoures
 *
 * @method \App\Model\Entity\Bonderetoure newEmptyEntity()
 * @method \App\Model\Entity\Bonderetoure newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Bonderetoure[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bonderetoure get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bonderetoure findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Bonderetoure patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bonderetoure[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bonderetoure|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bonderetoure saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bonderetoure[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bonderetoure[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bonderetoure[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bonderetoure[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BonderetouresTable extends Table
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

        $this->setTable('bonderetoures');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Lignebonderetoures', [
            'foreignKey' => 'bonderetoure_id',
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
            ->dateTime('date')
            ->allowEmptyDateTime('date');

        $validator
            ->integer('pointdevente_id')
            ->allowEmptyString('pointdevente_id');

        $validator
            ->integer('depot_id')
            ->allowEmptyString('depot_id');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 255)
            ->allowEmptyString('numero');

        $validator
            ->integer('materieltransport_id')
            ->allowEmptyString('materieltransport_id');

        $validator
            ->integer('cartecarburant_id')
            ->allowEmptyString('cartecarburant_id');

        $validator
            ->integer('conffaieur_id')
            ->allowEmptyString('conffaieur_id');

        $validator
            ->integer('chauffeur_id')
            ->allowEmptyString('chauffeur_id');

        $validator
            ->integer('kilometragedepart')
            ->allowEmptyString('kilometragedepart');

        $validator
            ->integer('kilometragearrive')
            ->allowEmptyString('kilometragearrive');

        $validator
            ->integer('poste')
            ->allowEmptyString('poste');

        $validator
            ->scalar('marque')
            ->maxLength('marque', 255)
            ->allowEmptyString('marque');

        $validator
            ->scalar('serie')
            ->maxLength('serie', 255)
            ->allowEmptyString('serie');

        $validator
            ->scalar('cin')
            ->maxLength('cin', 255)
            ->allowEmptyString('cin');

        $validator
            ->scalar('chauffeur')
            ->maxLength('chauffeur', 255)
            ->allowEmptyString('chauffeur');

        $validator
            ->integer('fournisseur_id')
            ->allowEmptyString('fournisseur_id');

        return $validator;
    }
}

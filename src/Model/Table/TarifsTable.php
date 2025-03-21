<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tarifs Model
 *
 * @property \App\Model\Table\TypeclientsTable&\Cake\ORM\Association\BelongsTo $Typeclients
 *
 * @method \App\Model\Entity\Tarif newEmptyEntity()
 * @method \App\Model\Entity\Tarif newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tarif[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tarif get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tarif findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tarif patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tarif[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tarif|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tarif saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tarif[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tarif[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tarif[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tarif[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TarifsTable extends Table
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

        $this->setTable('tarifs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Typeclients', [
            'foreignKey' => 'typeclient_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Familles', [
            'foreignKey' => 'famille_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Tarifclients', [
            'foreignKey' => 'tarif_id',
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
        $rules->add($rules->existsIn('typeclient_id', 'Typeclients'), ['errorField' => 'typeclient_id']);
        // $rules->add($rules->existsIn('famille_id', 'Familles'), ['errorField' => 'famille_id']);
        return $rules;
    }
}

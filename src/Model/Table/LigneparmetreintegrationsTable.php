<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ligneparmetreintegrations Model
 *
 * @property \App\Model\Table\NaturesTable&\Cake\ORM\Association\BelongsTo $Natures
 *
 * @method \App\Model\Entity\Ligneparmetreintegration newEmptyEntity()
 * @method \App\Model\Entity\Ligneparmetreintegration newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneparmetreintegration[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneparmetreintegration get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ligneparmetreintegration findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ligneparmetreintegration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneparmetreintegration[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneparmetreintegration|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneparmetreintegration saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneparmetreintegration[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneparmetreintegration[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneparmetreintegration[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneparmetreintegration[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LigneparmetreintegrationsTable extends Table
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

        $this->setTable('ligneparmetreintegrations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Natures', [
            'foreignKey' => 'nature_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Champs', [
            'foreignKey' => 'champ_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Ligneplans', [
            'foreignKey' => 'ligneplan_id',
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
            ->scalar('libelle')
            ->maxLength('libelle', 250)
            ->requirePresence('libelle', 'create')
            ->notEmptyString('libelle');
        
        $validator
            ->integer('ligneplan_id')
            ->requirePresence('ligneplan_id', 'create')
            ->notEmptyString('ligneplan_id');
        $validator
            ->integer('nature_id')
            ->requirePresence('nature_id', 'create')
            ->notEmptyString('nature_id');

        $validator
            ->integer('typeexon_id')
            ->requirePresence('typeexon_id', 'create')
            ->notEmptyString('typeexon_id');
        $validator
            ->integer('champ_id')
            ->requirePresence('champ_id', 'create')
            ->notEmptyString('champ_id');
        // $validator
        //     ->integer('auto')
        //     ->requirePresence('auto', 'create')
        //     ->notEmptyString('auto');

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
       // $rules->add($rules->existsIn('nature_id', 'Natures'), ['errorField' => 'nature_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bureaupostes Model
 *
 * @property \App\Model\Table\GouvernoratsTable&\Cake\ORM\Association\BelongsTo $Gouvernorats
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\HasMany $Clients
 *
 * @method \App\Model\Entity\Bureauposte newEmptyEntity()
 * @method \App\Model\Entity\Bureauposte newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Bureauposte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bureauposte get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bureauposte findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Bureauposte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bureauposte[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bureauposte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bureauposte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bureauposte[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bureauposte[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bureauposte[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bureauposte[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BureaupostesTable extends Table
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

        $this->setTable('bureaupostes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Gouvernorats', [
            'foreignKey' => 'gouvernorat_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Clients', [
            'foreignKey' => 'bureauposte_id',
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
            ->integer('gouvernorat_id')
            ->requirePresence('gouvernorat_id', 'create')
            ->notEmptyString('gouvernorat_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('codepostal')
            ->maxLength('codepostal', 255)
            ->requirePresence('codepostal', 'create')
            ->notEmptyString('codepostal');

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
        $rules->add($rules->existsIn('gouvernorat_id', 'Gouvernorats'), ['errorField' => 'gouvernorat_id']);

        return $rules;
    }
}

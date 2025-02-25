<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parmetreintegrations Model
 *
 * @property \App\Model\Table\JournalsTable&\Cake\ORM\Association\BelongsTo $Journals
 *
 * @method \App\Model\Entity\Parmetreintegration newEmptyEntity()
 * @method \App\Model\Entity\Parmetreintegration newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Parmetreintegration[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Parmetreintegration get($primaryKey, $options = [])
 * @method \App\Model\Entity\Parmetreintegration findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Parmetreintegration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Parmetreintegration[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Parmetreintegration|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parmetreintegration saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parmetreintegration[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parmetreintegration[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parmetreintegration[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parmetreintegration[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ParmetreintegrationsTable extends Table
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

        $this->setTable('parmetreintegrations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Journals', [
            'foreignKey' => 'journal_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Integrations', [
            'foreignKey' => 'integration_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('Ligneparmetreintegrations', [
            'foreignKey' => 'parmetreintegration_id',
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
            ->integer('journal_id')
            ->requirePresence('journal_id', 'create')
            ->notEmptyString('journal_id');

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
        $rules->add($rules->existsIn('journal_id', 'Journals'), ['errorField' => 'journal_id']);

        return $rules;
    }
}

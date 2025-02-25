<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Gouvernoratcommercials Model
 *
 * @property \App\Model\Table\CommercialsTable&\Cake\ORM\Association\BelongsTo $Commercials
 * @property \App\Model\Table\GouvernoratsTable&\Cake\ORM\Association\BelongsTo $Gouvernorats
 *
 * @method \App\Model\Entity\Gouvernoratcommercial newEmptyEntity()
 * @method \App\Model\Entity\Gouvernoratcommercial newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Gouvernoratcommercial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Gouvernoratcommercial get($primaryKey, $options = [])
 * @method \App\Model\Entity\Gouvernoratcommercial findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Gouvernoratcommercial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Gouvernoratcommercial[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Gouvernoratcommercial|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gouvernoratcommercial saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gouvernoratcommercial[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Gouvernoratcommercial[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Gouvernoratcommercial[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Gouvernoratcommercial[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class GouvernoratcommercialsTable extends Table
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

        $this->setTable('gouvernoratcommercials');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Commercials', [
            'foreignKey' => 'commercial_id',
        ]);
        $this->belongsTo('Gouvernorats', [
            'foreignKey' => 'gouvernorat_id',
        ]);
        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
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
            ->integer('commercial_id')
            ->allowEmptyString('commercial_id');

        $validator
            ->integer('gouvernorat_id')
            ->allowEmptyString('gouvernorat_id');
        
            $validator
            ->integer('client_id')
            ->allowEmptyString('client_id');

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
        $rules->add($rules->existsIn('commercial_id', 'Commercials'), ['errorField' => 'commercial_id']);
        $rules->add($rules->existsIn('gouvernorat_id', 'Gouvernorats'), ['errorField' => 'gouvernorat_id']);

        return $rules;
    }
}

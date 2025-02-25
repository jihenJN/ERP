<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Listetypebesoins Model
 *
 * @property \App\Model\Table\TypebesoinsTable&\Cake\ORM\Association\BelongsTo $Typebesoins
 *
 * @method \App\Model\Entity\Listetypebesoin newEmptyEntity()
 * @method \App\Model\Entity\Listetypebesoin newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Listetypebesoin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Listetypebesoin get($primaryKey, $options = [])
 * @method \App\Model\Entity\Listetypebesoin findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Listetypebesoin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Listetypebesoin[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Listetypebesoin|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Listetypebesoin saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Listetypebesoin[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Listetypebesoin[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Listetypebesoin[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Listetypebesoin[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ListetypebesoinsTable extends Table
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

        $this->setTable('listetypebesoins');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Typebesoins', [
            'foreignKey' => 'typebesoin_id',
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
        //     ->integer('typebesoin_id')
        //     ->allowEmptyString('typebesoin_id');

        // $validator
        //     ->integer('visite_id')
        //     ->allowEmptyString('visite_id');

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
        $rules->add($rules->existsIn('typebesoin_id', 'Typebesoins'), ['errorField' => 'typebesoin_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientgspromoarticles Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\GspromoarticlesTable&\Cake\ORM\Association\BelongsTo $Gspromoarticles
 *
 * @method \App\Model\Entity\Clientgspromoarticle newEmptyEntity()
 * @method \App\Model\Entity\Clientgspromoarticle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Clientgspromoarticle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clientgspromoarticle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Clientgspromoarticle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Clientgspromoarticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Clientgspromoarticle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clientgspromoarticle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientgspromoarticle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientgspromoarticle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientgspromoarticle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientgspromoarticle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientgspromoarticle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClientgspromoarticlesTable extends Table
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

        $this->setTable('clientgspromoarticles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Gspromoarticles', [
            'foreignKey' => 'gspromoarticle_id',
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
            ->integer('client_id')
            ->notEmptyString('client_id');

        $validator
            ->integer('gspromoarticle_id')
            ->notEmptyString('gspromoarticle_id');

        $validator
            ->integer('checkk')
            ->allowEmptyString('checkk');

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
        $rules->add($rules->existsIn('client_id', 'Clients'), ['errorField' => 'client_id']);
        $rules->add($rules->existsIn('gspromoarticle_id', 'Gspromoarticles'), ['errorField' => 'gspromoarticle_id']);

        return $rules;
    }
}

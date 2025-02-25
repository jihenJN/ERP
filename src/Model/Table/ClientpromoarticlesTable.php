<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientpromoarticles Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\PromoarticlesTable&\Cake\ORM\Association\BelongsTo $Promoarticles
 *
 * @method \App\Model\Entity\Clientpromoarticle newEmptyEntity()
 * @method \App\Model\Entity\Clientpromoarticle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Clientpromoarticle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clientpromoarticle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Clientpromoarticle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Clientpromoarticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Clientpromoarticle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clientpromoarticle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientpromoarticle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientpromoarticle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientpromoarticle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientpromoarticle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientpromoarticle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClientpromoarticlesTable extends Table
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

        $this->setTable('clientpromoarticles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Promoarticles', [
            'foreignKey' => 'promoarticle_id',
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
            ->integer('promoarticle_id')
            ->notEmptyString('promoarticle_id');

        $validator
            ->integer('checkk')
            ->requirePresence('checkk', 'create')
            ->notEmptyString('checkk');

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
        $rules->add($rules->existsIn('promoarticle_id', 'Promoarticles'), ['errorField' => 'promoarticle_id']);

        return $rules;
    }
}

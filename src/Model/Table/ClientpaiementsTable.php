<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientpaiements Model
 *
 * 
 *
 * @method \App\Model\Entity\Clientpaiement newEmptyEntity()
 * @method \App\Model\Entity\Clientpaiement newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Clientpaiement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clientpaiement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Clientpaiement findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Clientpaiement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Clientpaiement[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clientpaiement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientpaiement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientpaiement[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientpaiement[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientpaiement[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientpaiement[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClientpaiementsTable extends Table
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

        $this->setTable('clientpaiements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // $this->belongsTo('cli', [
        //     'foreignKey' => 'zone_id',
        //     'joinType' => 'INNER',
        // ]);
        
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
    // public function buildRules(RulesChecker $rules): RulesChecker
    // {
    //     $rules->add($rules->existsIn('zone_id', 'Zones'), ['errorField' => 'zone_id']);

    //     return $rules;
    // }
}

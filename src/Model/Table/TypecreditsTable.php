<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Typecredits Model
 *
 * @method \App\Model\Entity\Typecredit newEmptyEntity()
 * @method \App\Model\Entity\Typecredit newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Typecredit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Typecredit get($primaryKey, $options = [])
 * @method \App\Model\Entity\Typecredit findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Typecredit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Typecredit[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Typecredit|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typecredit saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typecredit[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typecredit[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typecredit[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typecredit[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TypecreditsTable extends Table
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
      
        $this->setTable('typecredits');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Frequences', [
            'foreignKey' => 'frequence_id',
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
        //     ->scalar('name')
        //     ->maxLength('name', 255)
        //     ->allowEmptyString('name');

        // $validator
        //     ->numeric('montant')
        //     ->allowEmptyString('montant');

        // $validator
        //     ->numeric('mesuel')
        //     ->allowEmptyString('mesuel');

        // $validator
        //     ->numeric('annuel')
        //     ->allowEmptyString('annuel');

        // $validator
        //     ->numeric('sertype')
        //     ->allowEmptyString('sertype');

        // $validator
        //     ->numeric('tuestrie')
        //     ->allowEmptyString('tuestrie');

        // $validator
        //     ->numeric('montantcredit')
        //     ->allowEmptyString('montantcredit');

        // $validator
        //     ->numeric('taux')
        //     ->allowEmptyString('taux');

        // $validator
        //     ->numeric('montantremb')
        //     ->allowEmptyString('montantremb');
        // $validator
        //     ->numeric('frequence_id')
        //     ->allowEmptyString('frequence_id');
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
        $rules->add($rules->existsIn('frequence_id', 'Frequences'), ['errorField' => 'frequence_id']);

        return $rules;
    }
}

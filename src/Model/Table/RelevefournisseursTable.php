<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Relevefournisseurs Model
 *
 * @method \App\Model\Entity\Relevefournisseur newEmptyEntity()
 * @method \App\Model\Entity\Relevefournisseur newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Relevefournisseur[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Relevefournisseur get($primaryKey, $options = [])
 * @method \App\Model\Entity\Relevefournisseur findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Relevefournisseur patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Relevefournisseur[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Relevefournisseur|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Relevefournisseur saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Relevefournisseur[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Relevefournisseur[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Relevefournisseur[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Relevefournisseur[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RelevefournisseursTable extends Table
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

        $this->setTable('relevefournisseurs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'fournisseur_id',
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
        //     ->scalar('numclt')
        //     ->maxLength('numclt', 255)
        //     ->allowEmptyString('numclt');

        // $validator
        //     ->integer('fournisseur_id')
        //     ->allowEmptyString('fournisseur_id');

        // $validator
        //     ->dateTime('date')
        //     ->allowEmptyDateTime('date');

        // $validator
        //     ->scalar('numero')
        //     ->maxLength('numero', 50)
        //     ->allowEmptyString('numero');

        // $validator
        //     ->scalar('type')
        //     ->allowEmptyString('type');

        // $validator
        //     ->scalar('typeimp')
        //     ->allowEmptyString('typeimp');

        // $validator
        //     ->decimal('debit')
        //     ->allowEmptyString('debit');

        // $validator
        //     ->decimal('credit')
        //     ->allowEmptyString('credit');

        // $validator
        //     ->decimal('impaye')
        //     ->allowEmptyString('impaye');

        // $validator
        //     ->decimal('reglement')
        //     ->allowEmptyString('reglement');

        // $validator
        //     ->decimal('avoir')
        //     ->allowEmptyString('avoir');

        // $validator
        //     ->decimal('solde')
        //     ->allowEmptyString('solde');

        // $validator
        //     ->integer('exercice_id')
        //     ->allowEmptyString('exercice_id');

        // $validator
        //     ->scalar('typ')
        //     ->maxLength('typ', 255)
        //     ->allowEmptyString('typ');

        // $validator
        //     ->integer('nbligneimp')
        //     ->allowEmptyString('nbligneimp');

        return $validator;
    }
}

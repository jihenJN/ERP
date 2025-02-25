<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Depenses Model
 *
 * @property \App\Model\Table\PaiementsTable&\Cake\ORM\Association\BelongsTo $Paiements
 * @property \App\Model\Table\TypedepensesTable&\Cake\ORM\Association\BelongsTo $Typedepenses
 * @property \App\Model\Table\CaissesTable&\Cake\ORM\Association\BelongsTo $Caisses
 *
 * @method \App\Model\Entity\Depense newEmptyEntity()
 * @method \App\Model\Entity\Depense newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Depense[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Depense get($primaryKey, $options = [])
 * @method \App\Model\Entity\Depense findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Depense patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Depense[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Depense|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Depense saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Depense[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Depense[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Depense[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Depense[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DepensesTable extends Table
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

        $this->setTable('depenses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Paiements', [
            'foreignKey' => 'paiement_id',
        ]);
        $this->belongsTo('Typedepenses', [
            'foreignKey' => 'typedepense_id',
        ]);
        $this->belongsTo('Caisses', [
            'foreignKey' => 'caisse_id',
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
            ->scalar('date')
            ->maxLength('date', 255)
            ->allowEmptyString('date');

        $validator
            ->numeric('montant')
            ->allowEmptyString('montant');

        $validator
            ->scalar('observation')
            ->allowEmptyString('observation');

        $validator
            ->integer('paiement_id')
            ->allowEmptyString('paiement_id');

        $validator
            ->integer('typedepense_id')
            ->allowEmptyString('typedepense_id');

        $validator
            ->integer('caisse_id')
            ->allowEmptyString('caisse_id');

        $validator
            ->numeric('solde')
            ->allowEmptyString('solde');

        $validator
            ->integer('numero')
            ->allowEmptyString('numero');

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
        $rules->add($rules->existsIn('paiement_id', 'Paiements'), ['errorField' => 'paiement_id']);
        $rules->add($rules->existsIn('typedepense_id', 'Typedepenses'), ['errorField' => 'typedepense_id']);
        $rules->add($rules->existsIn('caisse_id', 'Caisses'), ['errorField' => 'caisse_id']);

        return $rules;
    }
}

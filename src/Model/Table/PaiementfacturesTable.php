<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Paiementfactures Model
 *
 * @property \App\Model\Table\FacturesTable&\Cake\ORM\Association\BelongsTo $Factures
 * @property \App\Model\Table\PaiementsTable&\Cake\ORM\Association\BelongsTo $Paiements
 *
 * @method \App\Model\Entity\Paiementfacture newEmptyEntity()
 * @method \App\Model\Entity\Paiementfacture newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Paiementfacture[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Paiementfacture get($primaryKey, $options = [])
 * @method \App\Model\Entity\Paiementfacture findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Paiementfacture patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Paiementfacture[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Paiementfacture|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Paiementfacture saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Paiementfacture[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Paiementfacture[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Paiementfacture[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Paiementfacture[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PaiementfacturesTable extends Table
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

        $this->setTable('paiementfactures');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Factures', [
            'foreignKey' => 'facture_id',
        ]);
        $this->belongsTo('Paiements', [
            'foreignKey' => 'paiement_id',
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
            ->integer('facture_id')
            ->allowEmptyString('facture_id');

        $validator
            ->integer('paiement_id')
            ->allowEmptyString('paiement_id');

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
        $rules->add($rules->existsIn('facture_id', 'Factures'), ['errorField' => 'facture_id']);
        $rules->add($rules->existsIn('paiement_id', 'Paiements'), ['errorField' => 'paiement_id']);

        return $rules;
    }
}

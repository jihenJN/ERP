<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignefactureavoirfrs Model
 *
 * @property \App\Model\Table\FactureavoirfrsTable&\Cake\ORM\Association\BelongsTo $Factureavoirfrs
 *
 * @method \App\Model\Entity\Lignefactureavoirfr newEmptyEntity()
 * @method \App\Model\Entity\Lignefactureavoirfr newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignefactureavoirfr[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignefactureavoirfr get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignefactureavoirfr findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignefactureavoirfr patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignefactureavoirfr[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignefactureavoirfr|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignefactureavoirfr saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignefactureavoirfr[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignefactureavoirfr[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignefactureavoirfr[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignefactureavoirfr[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignefactureavoirfrsTable extends Table
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

        $this->setTable('lignefactureavoirfrs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Factureavoirfrs', [
            'foreignKey' => 'factureavoirfr_id',
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
            ->integer('factureavoirfr_id')
            ->allowEmptyString('factureavoirfr_id');

        $validator
            ->integer('lignefacture_id')
            ->allowEmptyString('lignefacture_id');

        $validator
            ->integer('lignebonreceptionstock_id')
            ->allowEmptyString('lignebonreceptionstock_id');

        $validator
            ->integer('depot_id')
            ->allowEmptyString('depot_id');

        $validator
            ->integer('article_id')
            ->allowEmptyString('article_id');

        $validator
            ->numeric('quantite')
            ->allowEmptyString('quantite');

        $validator
            ->decimal('prix')
            ->allowEmptyString('prix');

        $validator
            ->decimal('prixnet')
            ->allowEmptyString('prixnet');

        $validator
            ->decimal('prixhtva')
            ->allowEmptyString('prixhtva');

        $validator
            ->decimal('puttc')
            ->allowEmptyString('puttc');

        $validator
            ->decimal('totalhtans')
            ->allowEmptyString('totalhtans');

        $validator
            ->integer('remise')
            ->allowEmptyString('remise');

        $validator
            ->integer('fodec')
            ->allowEmptyString('fodec');

        $validator
            ->integer('tva_id')
            ->allowEmptyString('tva_id');

        $validator
            ->decimal('totalht')
            ->allowEmptyString('totalht');

        $validator
            ->decimal('totalttc')
            ->allowEmptyString('totalttc');

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
        $rules->add($rules->existsIn('factureavoirfr_id', 'Factureavoirfrs'), ['errorField' => 'factureavoirfr_id']);

        return $rules;
    }
}

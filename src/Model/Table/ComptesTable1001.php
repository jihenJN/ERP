<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Comptes Model
 *
 * @method \App\Model\Entity\Compte newEmptyEntity()
 * @method \App\Model\Entity\Compte newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Compte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Compte get($primaryKey, $options = [])
 * @method \App\Model\Entity\Compte findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Compte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Compte[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Compte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Compte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Compte[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Compte[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Compte[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Compte[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ComptesTable extends Table
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

        $this->setTable('comptes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Ligneordrepaiements', [
            'foreignKey' => 'compte_id',
        ]);
        $this->hasMany('Piecereglementclients', [
            'foreignKey' => 'compte_id',
        ]);
        $this->hasMany('Situationpiecereglementclients', [
            'foreignKey' => 'compte_id',
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
            ->scalar('rib')
            ->maxLength('rib', 255)
            ->allowEmptyString('rib');

        $validator
            ->integer('banque_id')
            ->allowEmptyString('banque_id');

        $validator
            ->scalar('code')
            ->maxLength('code', 255)
            ->allowEmptyString('code');

        $validator
            ->integer('typecompte_id')
            ->allowEmptyString('typecompte_id');

        $validator
            ->integer('categoriecompte_id')
            ->allowEmptyString('categoriecompte_id');

        $validator
            ->decimal('solde')
            ->allowEmptyString('solde');

        $validator
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->decimal('chiraat')
            ->allowEmptyString('chiraat');

        $validator
            ->decimal('notponctuelle')
            ->allowEmptyString('notponctuelle');

        $validator
            ->decimal('fc')
            ->allowEmptyString('fc');

        $validator
            ->decimal('findestock')
            ->allowEmptyString('findestock');

        $validator
            ->decimal('escompte')
            ->allowEmptyString('escompte');

        $validator
            ->decimal('esp')
            ->allowEmptyString('esp');

        $validator
            ->integer('nbjrcheque')
            ->allowEmptyString('nbjrcheque');

        $validator
            ->integer('nbjrtraite')
            ->allowEmptyString('nbjrtraite');

        $validator
            ->numeric('limitemontantcheque')
            ->allowEmptyString('limitemontantcheque');

        $validator
            ->numeric('limitemontanttraite')
            ->allowEmptyString('limitemontanttraite');

        $validator
            ->numeric('tauscheque')
            ->allowEmptyString('tauscheque');

        $validator
            ->numeric('taustraite')
            ->allowEmptyString('taustraite');

        $validator
            ->numeric('tausdepacementcheque')
            ->allowEmptyString('tausdepacementcheque');

        $validator
            ->numeric('tausdepacementtraite')
            ->allowEmptyString('tausdepacementtraite');

        $validator
            ->scalar('comptecomptable')
            ->maxLength('comptecomptable', 255)
            ->allowEmptyString('comptecomptable');

        $validator
            ->integer('journal_id')
            ->allowEmptyString('journal_id');

        $validator
            ->scalar('journal_idcheque')
            ->maxLength('journal_idcheque', 255)
            ->allowEmptyString('journal_idcheque');

        $validator
            ->scalar('journal_idtraite')
            ->maxLength('journal_idtraite', 255)
            ->allowEmptyString('journal_idtraite');

        $validator
            ->scalar('journal_idlcfd')
            ->maxLength('journal_idlcfd', 255)
            ->allowEmptyString('journal_idlcfd');

        $validator
            ->scalar('banque')
            ->maxLength('banque', 255)
            ->allowEmptyString('banque');

        return $validator;
    }
}

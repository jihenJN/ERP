<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignecomptes Model
 *
 * @property \App\Model\Table\TypecreditsTable&\Cake\ORM\Association\BelongsTo $Typecredits
 * @property \App\Model\Table\ComptesTable&\Cake\ORM\Association\BelongsTo $Comptes
 *
 * @method \App\Model\Entity\Lignecompte newEmptyEntity()
 * @method \App\Model\Entity\Lignecompte newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignecompte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignecompte get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignecompte findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignecompte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignecompte[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignecompte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignecompte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignecompte[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignecompte[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignecompte[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignecompte[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignecomptesTable extends Table
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

        $this->setTable('lignecomptes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Typecredits', [
            'foreignKey' => 'typecredit_id',
        ]);
        $this->belongsTo('Comptes', [
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
            ->integer('typecredit_id')
            ->allowEmptyString('typecredit_id');

        $validator
            ->integer('compte_id')
            ->allowEmptyString('compte_id');

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
        $rules->add($rules->existsIn('typecredit_id', 'Typecredits'), ['errorField' => 'typecredit_id']);
        $rules->add($rules->existsIn('compte_id', 'Comptes'), ['errorField' => 'compte_id']);

        return $rules;
    }
}

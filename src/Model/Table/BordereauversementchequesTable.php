<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Piecereglementclients Model
 *
 * @property \App\Model\Table\ComptesTable&\Cake\ORM\Association\BelongsTo $Comptes
 *
 * @method \App\Model\Entity\Bordereauversementcheque newEmptyEntity()
 * @method \App\Model\Entity\Bordereauversementcheque newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Bordereauversementcheque[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bordereauversementcheque get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bordereauversementcheque findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Bordereauversementcheque patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bordereauversementcheque[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bordereauversementcheque|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bordereauversementcheque saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bordereauversementcheque[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bordereauversementcheque[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bordereauversementcheque[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bordereauversementcheque[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BordereauversementchequesTable extends Table
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

        $this->setTable('bordereauversementcheques');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
        //$rules->add($rules->existsIn('reglementclient_id', 'Reglementclients'), ['errorField' => 'reglementclient_id']);
        $rules->add($rules->existsIn('compte_id', 'Comptes'), ['errorField' => 'compte_id']);

        return $rules;
    }
}

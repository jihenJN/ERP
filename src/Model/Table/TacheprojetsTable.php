<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tacheprojets Model
 *
 * @property \App\Model\Table\TachedesignationsTable&\Cake\ORM\Association\BelongsTo $Tachedesignations
 * @property \App\Model\Table\PersonnelsTable&\Cake\ORM\Association\BelongsTo $Personnels
 *
 * @method \App\Model\Entity\Tacheprojet newEmptyEntity()
 * @method \App\Model\Entity\Tacheprojet newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tacheprojet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tacheprojet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tacheprojet findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tacheprojet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tacheprojet[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tacheprojet|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tacheprojet saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tacheprojet[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tacheprojet[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tacheprojet[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tacheprojet[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TacheprojetsTable extends Table
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

        $this->setTable('tacheprojets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Tachedesignations', [
            'foreignKey' => 'tachedesignation_id',
        ]);
        $this->belongsTo('Personnels', [
            'foreignKey' => 'personnel_id',
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

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignecriteres Model
 *
 * @property \App\Model\Table\CriteresTable&\Cake\ORM\Association\BelongsTo $Criteres
 *
 * @method \App\Model\Entity\Lignecritere newEmptyEntity()
 * @method \App\Model\Entity\Lignecritere newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignecritere[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignecritere get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignecritere findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignecritere patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignecritere[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignecritere|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignecritere saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignecritere[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignecritere[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignecritere[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignecritere[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignecriteresTable extends Table
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

        $this->setTable('lignecriteres');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Criteres', [
            'foreignKey' => 'critere_id',
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

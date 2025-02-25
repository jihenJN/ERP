<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projetproductions Model
 *
 * @property \App\Model\Table\ProjetsTable&\Cake\ORM\Association\BelongsTo $Projets
 * @property \App\Model\Table\ParametrageproductionsTable&\Cake\ORM\Association\BelongsTo $Parametrageproductions
 *
 * @method \App\Model\Entity\Projetproduction newEmptyEntity()
 * @method \App\Model\Entity\Projetproduction newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Projetproduction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Projetproduction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Projetproduction findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Projetproduction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Projetproduction[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Projetproduction|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Projetproduction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Projetproduction[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Projetproduction[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Projetproduction[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Projetproduction[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjetproductionsTable extends Table
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

        $this->setTable('projetproductions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Projets', [
            'foreignKey' => 'projet_id',
        ]);
        $this->belongsTo('Parametrageproductions', [
            'foreignKey' => 'parametrageproduction_id',
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

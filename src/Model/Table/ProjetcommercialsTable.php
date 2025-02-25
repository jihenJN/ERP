<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projetcommercials Model
 *
 * @property \App\Model\Table\ProjetsTable&\Cake\ORM\Association\BelongsTo $Projets
 *
 * @method \App\Model\Entity\Projetcommercial newEmptyEntity()
 * @method \App\Model\Entity\Projetcommercial newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Projetcommercial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Projetcommercial get($primaryKey, $options = [])
 * @method \App\Model\Entity\Projetcommercial findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Projetcommercial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Projetcommercial[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Projetcommercial|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Projetcommercial saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Projetcommercial[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Projetcommercial[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Projetcommercial[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Projetcommercial[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjetcommercialsTable extends Table
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

        $this->setTable('projetcommercials');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Projets', [
            'foreignKey' => 'projet_id',
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

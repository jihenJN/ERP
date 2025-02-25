<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projetconceptions Model
 *
 * @property \App\Model\Table\PersonnelsTable&\Cake\ORM\Association\BelongsTo $Personnels
 * @property \App\Model\Table\ProjetsTable&\Cake\ORM\Association\BelongsTo $Projets
 * @property \App\Model\Table\TypeconceptionsTable&\Cake\ORM\Association\BelongsTo $Typeconceptions
 *
 * @method \App\Model\Entity\Projetconception newEmptyEntity()
 * @method \App\Model\Entity\Projetconception newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Projetconception[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Projetconception get($primaryKey, $options = [])
 * @method \App\Model\Entity\Projetconception findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Projetconception patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Projetconception[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Projetconception|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Projetconception saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Projetconception[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Projetconception[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Projetconception[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Projetconception[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjetconceptionsTable extends Table
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

        $this->setTable('projetconceptions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Personnels', [
            'foreignKey' => 'personnel_id',
        ]);
        $this->belongsTo('Projets', [
            'foreignKey' => 'projet_id',
        ]);
        $this->belongsTo('Typeconceptions', [
            'foreignKey' => 'typeconception_id',
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

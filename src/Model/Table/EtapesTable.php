<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Etapes Model
 *
 * @property \App\Model\Table\PersonnelsTable&\Cake\ORM\Association\BelongsTo $Personnels
 * @property \App\Model\Table\MachinesTable&\Cake\ORM\Association\BelongsTo $Machines
 *
 * @method \App\Model\Entity\Etape newEmptyEntity()
 * @method \App\Model\Entity\Etape newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Etape[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Etape get($primaryKey, $options = [])
 * @method \App\Model\Entity\Etape findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Etape patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Etape[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Etape|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Etape saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Etape[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etape[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etape[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etape[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EtapesTable extends Table
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

        $this->setTable('etapes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Personnels', [
            'foreignKey' => 'personnel_id',
        ]);
        $this->belongsTo('Machines', [
            'foreignKey' => 'machine_id',
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
            ->integer('personnel_id')
            ->allowEmptyString('personnel_id');

        $validator
            ->integer('machine_id')
            ->allowEmptyString('machine_id');

        $validator
            ->integer('rang')
            ->allowEmptyString('rang');

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
        $rules->add($rules->existsIn('personnel_id', 'Personnels'), ['errorField' => 'personnel_id']);
        $rules->add($rules->existsIn('machine_id', 'Machines'), ['errorField' => 'machine_id']);

        return $rules;
    }
}

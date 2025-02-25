<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Besionachats Model
 *
 * @method \App\Model\Entity\Besionachat newEmptyEntity()
 * @method \App\Model\Entity\Besionachat newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Besionachat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Besionachat get($primaryKey, $options = [])
 * @method \App\Model\Entity\Besionachat findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Besionachat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Besionachat[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Besionachat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Besionachat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Besionachat[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Besionachat[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Besionachat[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Besionachat[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BesionachatsTable extends Table
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

        $this->setTable('besionachats');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Lignebesionachats', [
            'foreignKey' => 'besionachat_id',
        ]);
        $this->belongsTo('Personnels', [
            'foreignKey' => 'personnel_id',
        ]);

        $this->belongsTo('Demandeoffredeprixes', [
            'foreignKey' => 'demandeoffredeprixe_id',
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
            ->scalar('numero')
            ->maxLength('numero', 225)
            ->allowEmptyString('numero');

        $validator
            ->dateTime('date')
            ->allowEmptyDateTime('date');

        $validator
            ->integer('personnel_id')
            ->allowEmptyString('personnel_id');

        $validator
            ->scalar('remarque')
            ->maxLength('remarque', 225)
            ->allowEmptyString('remarque');

        return $validator;
    }
}
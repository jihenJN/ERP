<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tracemisejours Model
 *
 * @method \App\Model\Entity\Tracemisejour newEmptyEntity()
 * @method \App\Model\Entity\Tracemisejour newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tracemisejour[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tracemisejour get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tracemisejour findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tracemisejour patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tracemisejour[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tracemisejour|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tracemisejour saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tracemisejour[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tracemisejour[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tracemisejour[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tracemisejour[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TracemisejoursTable extends Table
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

        $this->setTable('tracemisejours');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Utilisateurs', [
            'foreignKey' => 'utilisateur_id',
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
            ->scalar('model')
            ->maxLength('model', 255)
            ->allowEmptyString('model');

        $validator
            ->scalar('id_piece')
            ->maxLength('id_piece', 255)
            ->allowEmptyString('id_piece');

        $validator
            ->scalar('operation')
            ->maxLength('operation', 255)
            ->allowEmptyString('operation');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 255)
            ->allowEmptyString('numero');

        $validator
            ->integer('user_id')
            ->allowEmptyString('user_id');
            $validator
            ->integer('utilisateur_id')
            ->allowEmptyString('utilisateur_id');

        $validator
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->scalar('heure')
            ->maxLength('heure', 255)
            ->allowEmptyString('heure');

        $validator
            ->scalar('poste')
            ->maxLength('poste', 255)
            ->allowEmptyString('poste');

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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('utilisateur_id', 'Utilisateurs'), ['errorField' => 'utilisateur_id']);

        return $rules;
    }
}

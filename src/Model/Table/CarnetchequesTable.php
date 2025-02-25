<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Carnetcheques Model
 *
 * @property \App\Model\Table\ComptesTable&\Cake\ORM\Association\BelongsTo $Comptes
 * @property \App\Model\Table\PiecereglementsTable&\Cake\ORM\Association\HasMany $Piecereglements
 *
 * @method \App\Model\Entity\Carnetcheque newEmptyEntity()
 * @method \App\Model\Entity\Carnetcheque newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Carnetcheque[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Carnetcheque get($primaryKey, $options = [])
 * @method \App\Model\Entity\Carnetcheque findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Carnetcheque patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Carnetcheque[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Carnetcheque|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Carnetcheque saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Carnetcheque[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Carnetcheque[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Carnetcheque[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Carnetcheque[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CarnetchequesTable extends Table
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

        $this->setTable('carnetcheques');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Comptes', [
            'foreignKey' => 'compte_id',
        ]);
        $this->belongsTo('Banques', [
            'foreignKey' => 'banque_id',
        ]);
        $this->hasMany('Piecereglements', [
            'foreignKey' => 'carnetcheque_id',
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
        // $validator
        //     ->scalar('numero')
        //     ->maxLength('numero', 255)
        //     ->allowEmptyString('numero');

        // $validator
        //     ->integer('compte_id')
        //     ->allowEmptyString('compte_id');

        // $validator
        //     ->scalar('debut')
        //     ->maxLength('debut', 255)
        //     ->allowEmptyString('debut');

        // $validator
        //     ->integer('nombre')
        //     ->allowEmptyString('nombre');

        // $validator
        //     ->integer('taille')
        //     ->allowEmptyString('taille');

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
        $rules->add($rules->existsIn('compte_id', 'Comptes'), ['errorField' => 'compte_id']);

        return $rules;
    }
}

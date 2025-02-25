<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Remiseclients Model
 *
 * @property \App\Model\Table\TypeclientsTable&\Cake\ORM\Association\BelongsTo $Typeclients
 * @property \App\Model\Table\LigneremiseclientsTable&\Cake\ORM\Association\HasMany $Ligneremiseclients
 *
 * @method \App\Model\Entity\Remiseclient newEmptyEntity()
 * @method \App\Model\Entity\Remiseclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Remiseclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Remiseclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Remiseclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Remiseclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Remiseclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Remiseclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Remiseclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Remiseclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Remiseclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Remiseclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Remiseclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RemiseclientsTable extends Table
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

        $this->setTable('remiseclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Typeclients', [
            'foreignKey' => 'typeclient_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Ligneremiseclients', [
            'foreignKey' => 'remiseclient_id',
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
            ->integer('typeclient_id')
            ->notEmptyString('typeclient_id');

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
        $rules->add($rules->existsIn('typeclient_id', 'Typeclients'), ['errorField' => 'typeclient_id']);

        return $rules;
    }
}

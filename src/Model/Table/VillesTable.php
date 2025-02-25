<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Villes Model
 *
 * @property \App\Model\Table\PaysTable&\Cake\ORM\Association\BelongsTo $Pays
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\HasMany $Clients
 * @property \App\Model\Table\FournisseursTable&\Cake\ORM\Association\HasMany $Fournisseurs
 * @property \App\Model\Table\PointdeventesTable&\Cake\ORM\Association\HasMany $Pointdeventes
 * @property \App\Model\Table\RegionsTable&\Cake\ORM\Association\HasMany $Regions
 *
 * @method \App\Model\Entity\Ville newEmptyEntity()
 * @method \App\Model\Entity\Ville newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ville[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ville get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ville findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ville patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ville[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ville|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ville saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ville[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ville[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ville[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ville[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class VillesTable extends Table
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

        $this->setTable('villes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Pays', [
            'foreignKey' => 'pay_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Clients', [
            'foreignKey' => 'ville_id',
        ]);
        $this->hasMany('Fournisseurs', [
            'foreignKey' => 'ville_id',
        ]);
        $this->hasMany('Pointdeventes', [
            'foreignKey' => 'ville_id',
        ]);
        $this->hasMany('Regions', [
            'foreignKey' => 'ville_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('pay_id')
            ->requirePresence('pay_id', 'create')
            ->notEmptyString('pay_id');

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
        $rules->add($rules->existsIn('pay_id', 'Pays'), ['errorField' => 'pay_id']);

        return $rules;
    }
}

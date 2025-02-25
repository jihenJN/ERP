<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Promoarticles Model
 *
 * @property \App\Model\Table\TypeclientsTable&\Cake\ORM\Association\BelongsTo $Typeclients
 * @property \App\Model\Table\ClientpromoarticlesTable&\Cake\ORM\Association\HasMany $Clientpromoarticles
 * @property \App\Model\Table\GouvpromoarticlesTable&\Cake\ORM\Association\HasMany $Gouvpromoarticles
 * @property \App\Model\Table\LignepromoarticlesTable&\Cake\ORM\Association\HasMany $Lignepromoarticles
 *
 * @method \App\Model\Entity\Promoarticle newEmptyEntity()
 * @method \App\Model\Entity\Promoarticle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Promoarticle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Promoarticle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Promoarticle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Promoarticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Promoarticle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Promoarticle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Promoarticle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Promoarticle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Promoarticle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Promoarticle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Promoarticle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PromoarticlesTable extends Table
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

        $this->setTable('promoarticles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Typeclients', [
            'foreignKey' => 'typeclient_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Clientpromoarticles', [
            'foreignKey' => 'promoarticle_id',
        ]);
        $this->hasMany('Gouvpromoarticles', [
            'foreignKey' => 'promoarticle_id',
        ]);
        $this->hasMany('Lignepromoarticles', [
            'foreignKey' => 'promoarticle_id',
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

        $validator
            ->integer('gouv')
            ->allowEmptyString('gouv');

        $validator
            ->integer('type')
            ->allowEmptyString('type');

        $validator
            ->date('datedebut')
            ->requirePresence('datedebut', 'create')
            ->notEmptyDate('datedebut');

        $validator
            ->date('datefin')
            ->requirePresence('datefin', 'create')
            ->notEmptyDate('datefin');

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

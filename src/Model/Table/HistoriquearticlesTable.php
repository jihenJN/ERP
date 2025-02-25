<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Historiquearticles Model
 *
 * @method \App\Model\Entity\Historiquearticle newEmptyEntity()
 * @method \App\Model\Entity\Historiquearticle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Historiquearticle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Historiquearticle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Historiquearticle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Historiquearticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Historiquearticle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Historiquearticle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Historiquearticle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Historiquearticle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Historiquearticle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Historiquearticle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Historiquearticle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class HistoriquearticlesTable extends Table
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

        $this->setTable('historiquearticles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('client')
            ->maxLength('client', 255)
            ->allowEmptyString('client');

        $validator
            ->scalar('fournisseur')
            ->maxLength('fournisseur', 300)
            ->allowEmptyString('fournisseur');

        $validator
            ->scalar('utilisateur')
            ->maxLength('utilisateur', 255)
            ->allowEmptyString('utilisateur');

        $validator
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->allowEmptyString('type');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 255)
            ->allowEmptyString('numero');

        $validator
            ->scalar('article')
            ->maxLength('article', 255)
            ->allowEmptyString('article');

        $validator
            ->numeric('qte')
            ->allowEmptyString('qte');

        $validator
            ->decimal('pu')
            ->allowEmptyString('pu');

        $validator
            ->decimal('ptot')
            ->allowEmptyString('ptot');

        $validator
            ->numeric('remise')
            ->allowEmptyString('remise');

        $validator
            ->numeric('tva')
            ->allowEmptyString('tva');

        $validator
            ->scalar('mode')
            ->maxLength('mode', 255)
            ->allowEmptyString('mode');

        $validator
            ->integer('indice')
            ->allowEmptyString('indice');

        $validator
            ->scalar('depot')
            ->maxLength('depot', 255)
            ->allowEmptyString('depot');

        $validator
            ->integer('personnel_id')
            ->allowEmptyString('personnel_id');

        return $validator;
    }
}

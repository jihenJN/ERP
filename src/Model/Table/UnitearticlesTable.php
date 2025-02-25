<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Unitearticles Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\HasMany $Articles
 *
 * @method \App\Model\Entity\Unitearticle newEmptyEntity()
 * @method \App\Model\Entity\Unitearticle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Unitearticle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Unitearticle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Unitearticle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Unitearticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Unitearticle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Unitearticle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Unitearticle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Unitearticle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Unitearticle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Unitearticle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Unitearticle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UnitearticlesTable extends Table
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

        $this->setTable('unitearticles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Articles', [
            'foreignKey' => 'unitearticle_id',
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
            ->maxLength('name', 12)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}

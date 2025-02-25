<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Natures Model
 *
 * @property \App\Model\Table\LigneparmetreintegrationsTable&\Cake\ORM\Association\HasMany $Ligneparmetreintegrations
 *
 * @method \App\Model\Entity\Nature newEmptyEntity()
 * @method \App\Model\Entity\Nature newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Nature[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Nature get($primaryKey, $options = [])
 * @method \App\Model\Entity\Nature findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Nature patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Nature[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Nature|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Nature saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Nature[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Nature[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Nature[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Nature[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class NaturesTable extends Table
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

        $this->setTable('natures');
        $this->setDisplayField('name');

        $this->hasMany('Ligneparmetreintegrations', [
            'foreignKey' => 'nature_id',
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
            ->integer('id')
            ->requirePresence('id', 'create')
            ->notEmptyString('id');

        $validator
            ->scalar('name')
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}

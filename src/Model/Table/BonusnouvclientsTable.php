<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bonusnouvclients Model
 *
 * @method \App\Model\Entity\Bonusnouvclient newEmptyEntity()
 * @method \App\Model\Entity\Bonusnouvclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Bonusnouvclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bonusnouvclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bonusnouvclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Bonusnouvclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bonusnouvclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bonusnouvclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bonusnouvclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bonusnouvclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bonusnouvclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bonusnouvclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bonusnouvclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BonusnouvclientsTable extends Table
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

        $this->setTable('bonusnouvclients');
        $this->setDisplayField('name');
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->numeric('valeur')
            ->requirePresence('valeur', 'create')
            ->notEmptyString('valeur');

        return $validator;
    }
}

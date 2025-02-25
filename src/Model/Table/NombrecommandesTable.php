<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Nombrecommandes Model
 *
 * @method \App\Model\Entity\Nombrecommande newEmptyEntity()
 * @method \App\Model\Entity\Nombrecommande newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Nombrecommande[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Nombrecommande get($primaryKey, $options = [])
 * @method \App\Model\Entity\Nombrecommande findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Nombrecommande patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Nombrecommande[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Nombrecommande|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Nombrecommande saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Nombrecommande[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Nombrecommande[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Nombrecommande[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Nombrecommande[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class NombrecommandesTable extends Table
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

        $this->setTable('nombrecommandes');
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
            ->integer('nombrecommande')
            ->requirePresence('nombrecommande', 'create')
            ->notEmptyString('nombrecommande');

        return $validator;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Accesrecherches Model
 *
 * @method \App\Model\Entity\Accesrecherche newEmptyEntity()
 * @method \App\Model\Entity\Accesrecherche newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Accesrecherche[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Accesrecherche get($primaryKey, $options = [])
 * @method \App\Model\Entity\Accesrecherche findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Accesrecherche patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Accesrecherche[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Accesrecherche|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Accesrecherche saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Accesrecherche[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Accesrecherche[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Accesrecherche[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Accesrecherche[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AccesrecherchesTable extends Table
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

        $this->setTable('accesrecherches');
        $this->setDisplayField('interface');
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
       

        return $validator;
    }
}

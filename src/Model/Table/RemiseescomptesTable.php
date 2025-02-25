<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Remiseescomptes Model
 *
 * @method \App\Model\Entity\Remiseescompte newEmptyEntity()
 * @method \App\Model\Entity\Remiseescompte newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Remiseescompte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Remiseescompte get($primaryKey, $options = [])
 * @method \App\Model\Entity\Remiseescompte findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Remiseescompte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Remiseescompte[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Remiseescompte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Remiseescompte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Remiseescompte[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Remiseescompte[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Remiseescompte[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Remiseescompte[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RemiseescomptesTable extends Table
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

        $this->setTable('remiseescomptes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Typeclients', [
            'foreignKey' => 'typeclient_id',
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
            ->allowEmptyString('typeclient_id');

        return $validator;
    }
}

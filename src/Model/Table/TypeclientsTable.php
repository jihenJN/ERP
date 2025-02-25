<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Typeclients Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\HasMany $Clients
 * @property \App\Model\Table\ClientsancTable&\Cake\ORM\Association\HasMany $Clientsanc
 *
 * @method \App\Model\Entity\Typeclient newEmptyEntity()
 * @method \App\Model\Entity\Typeclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Typeclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Typeclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Typeclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Typeclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Typeclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Typeclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typeclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typeclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typeclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typeclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typeclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TypeclientsTable extends Table
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

        $this->setTable('typeclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Clients', [
            'foreignKey' => 'typeclient_id',
        ]);
        $this->hasMany('Clientsanc', [
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
            ->scalar('type')
            ->maxLength('type', 255)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        return $validator;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Banques Model
 *
 * @property \App\Model\Table\ClientbanquesTable&\Cake\ORM\Association\HasMany $Clientbanques
 * @property \App\Model\Table\FournisseurbanquesTable&\Cake\ORM\Association\HasMany $Fournisseurbanques
 *
 * @method \App\Model\Entity\Banque newEmptyEntity()
 * @method \App\Model\Entity\Banque newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Banque[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Banque get($primaryKey, $options = [])
 * @method \App\Model\Entity\Banque findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Banque patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Banque[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Banque|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Banque saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Banque[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Banque[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Banque[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Banque[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BanquesTable extends Table
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

        $this->setTable('banques');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Clientbanques', [
            'foreignKey' => 'banque_id',
        ]);
        $this->hasMany('Fournisseurbanques', [
            'foreignKey' => 'banque_id',
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

        return $validator;
    }
}

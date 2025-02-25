<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Typeexons Model
 *
 * @property \App\Model\Table\ClientexonerationsTable&\Cake\ORM\Association\HasMany $Clientexonerations
 * @property \App\Model\Table\ExonerationsTable&\Cake\ORM\Association\HasMany $Exonerations
 *
 * @method \App\Model\Entity\Typeexon newEmptyEntity()
 * @method \App\Model\Entity\Typeexon newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Typeexon[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Typeexon get($primaryKey, $options = [])
 * @method \App\Model\Entity\Typeexon findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Typeexon patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Typeexon[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Typeexon|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typeexon saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typeexon[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typeexon[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typeexon[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typeexon[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TypeexonsTable extends Table
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

        $this->setTable('typeexons');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Clientexonerations', [
            'foreignKey' => 'typeexon_id',
        ]);
        $this->hasMany('Exonerations', [
            'foreignKey' => 'typeexon_id',
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

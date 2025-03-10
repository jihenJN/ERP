<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Commercials Model
 *
 * @property \App\Model\Table\CommandesTable&\Cake\ORM\Association\HasMany $Commandes
 *
 * @method \App\Model\Entity\Commercial newEmptyEntity()
 * @method \App\Model\Entity\Commercial newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Commercial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Commercial get($primaryKey, $options = [])
 * @method \App\Model\Entity\Commercial findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Commercial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Commercial[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Commercial|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commercial saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commercial[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commercial[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commercial[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commercial[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CommercialsTable extends Table
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

        $this->setTable('commercials');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        
         
        $this->hasMany('Visites', [
            'foreignKey' => 'commercial_id',  
            'dependent' => true,  // Si un commercial est supprimé, les Visites associées sont supprimées aussi
        ]);

    

        $this->hasMany('Demandeclients', [
            'foreignKey' =>'commercial_id',  
            'dependent' => true,  
        ]);
        
        
        $this->hasMany('Commandes', [
            'foreignKey' => 'commercial_id',
        ]);
        $this->belongsTo('Gouvernorats', [
            'foreignKey' => 'gouvernorat_id',
        ]);
        
        $this->belongsTo('Categories', [
            'foreignKey' => 'categorie_id',
           

            
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

        $validator
            ->scalar('login')
            ->maxLength('login', 255)
            ->requirePresence('login', 'create')
            ->notEmptyString('login');

        $validator
            ->scalar('mp')
            ->maxLength('mp', 255)
            ->requirePresence('mp', 'create')
            ->notEmptyString('mp');
        $validator
            ->integer('gouvernorat_id')
            ->allowEmptyString('gouvernorat_id');
        
        $validator
            ->integer('categorie_id')
            ->requirePresence('categorie_id', 'create')
            ->notEmptyString('categorie_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['login']), ['errorField' => 'login']);
        $rules->add($rules->existsIn('gouvernorat_id', 'Gouvernorats'), ['errorField' => 'gouvernorat_id']);
        $rules->add($rules->existsIn('categorie_id', 'Categories'), ['errorField' => 'categorie_id']);

        return $rules;
    }
}

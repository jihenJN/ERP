<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Typecontacts Model
 *
 * @method \App\Model\Entity\Typecontact newEmptyEntity()
 * @method \App\Model\Entity\Typecontact newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Typecontact[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Typecontact get($primaryKey, $options = [])
 * @method \App\Model\Entity\Typecontact findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Typecontact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Typecontact[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Typecontact|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typecontact saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typecontact[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typecontact[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typecontact[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typecontact[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TypecontactsTable extends Table
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

        $this->setTable('typecontacts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
       
        $this->hasMany('Visites', [
            'foreignKey' => 'type_contact_id',  
            'dependent' => true,  // Si un Typecontact est supprimé, les Visites associées sont supprimées aussi
        ]);

        $this->hasMany('Demandeclients', [
            'foreignKey' => 'type_contact_id',  
            'dependent' => true,  
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
            ->scalar('libelle')
            ->maxLength('libelle', 255)
            ->requirePresence('libelle', 'create')
            ->notEmptyString('libelle');

        return $validator;
    }
}

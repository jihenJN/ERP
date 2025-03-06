<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Demandeclients Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\Typecontacts&\Cake\ORM\Association\BelongsTo $Typecontacts
 * @property \App\Model\Table\Commercials&\Cake\ORM\Association\BelongsTo $Commercials
 * @property \App\Model\Table\TypedemandesTable&\Cake\ORM\Association\BelongsTo $Typedemandes
 * @property \App\Model\Table\LignedemandeclientsTable&\Cake\ORM\Association\HasMany $Lignedemandeclients
 *
 * @method \App\Model\Entity\Demandeclient newEmptyEntity()
 * @method \App\Model\Entity\Demandeclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Demandeclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Demandeclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Demandeclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Demandeclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Demandeclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Demandeclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Demandeclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Demandeclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Demandeclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Demandeclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Demandeclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DemandeclientsTable extends Table
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

        $this->setTable('demandeclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
        ]);
        $this->belongsTo('Typedemandes', [
            'foreignKey' => 'typedemande_id',
        ]);
        $this->hasMany('Lignedemandeclients', [
            'foreignKey' => 'demandeclient_id',
        ]);

        $this->belongsTo('Typecontacts', [
            'foreignKey' => 'type_contact_id',
         
        ]);
        
        $this->belongsTo('Commercials', [
            'foreignKey' => 'commercial_id',
         
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
        $rules->add($rules->existsIn('client_id', 'Clients'), ['errorField' => 'client_id']);
        $rules->add($rules->existsIn('typedemande_id', 'Typedemandes'), ['errorField' => 'typedemande_id']);
        $rules->add($rules->existsIn('type_contact_id', 'Typecontacts'), ['errorField' => 'type_contact_id']);
        $rules->add($rules->existsIn('commercial_id', 'Commercials'), ['errorField' => 'commercial_id']);

        return $rules;
    }
}

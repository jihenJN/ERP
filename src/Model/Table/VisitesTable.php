<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Visites Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\DemandeclientsTable&\Cake\ORM\Association\BelongsTo $Demandeclients
 * @property \App\Model\Table\TypecontactsTable&\Cake\ORM\Association\BelongsTo $Typecontacts
 * @property \App\Model\Table\ListecompterendusTable&\Cake\ORM\Association\HasMany $Listecompterendus
 * @property \App\Model\Table\ListetypebesoinsTable&\Cake\ORM\Association\HasMany $Listetypebesoins
 *
 * @method \App\Model\Entity\Visite newEmptyEntity()
 * @method \App\Model\Entity\Visite newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Visite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Visite get($primaryKey, $options = [])
 * @method \App\Model\Entity\Visite findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Visite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Visite[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Visite|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Visite saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class VisitesTable extends Table
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

        $this->setTable('visites');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
        ]);
        $this->belongsTo('Demandeclients', [
            'foreignKey' => 'demandeclient_id',
        ]);
        $this->belongsTo('Typecontacts', [
            'foreignKey' => 'type_contact_id',
        ]);
        $this->belongsTo('Commercials', [
            'foreignKey' => 'commercial_id',
        ]);
        $this->hasMany('Listecompterendus', [
            'foreignKey' => 'visite_id',
        ]);
        $this->hasMany('Listetypebesoins', [
            'foreignKey' => 'visite_id',
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
      

        return $rules;
    }
}

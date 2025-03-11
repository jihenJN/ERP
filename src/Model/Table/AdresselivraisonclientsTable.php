<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Adresselivraisonclients Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\BonlivraisonsTable&\Cake\ORM\Association\HasMany $Bonlivraisons
 * @property \App\Model\Table\FactureclientsTable&\Cake\ORM\Association\HasMany $Factureclients
 *
 * @method \App\Model\Entity\Adresselivraisonclient newEmptyEntity()
 * @method \App\Model\Entity\Adresselivraisonclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Adresselivraisonclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Adresselivraisonclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Adresselivraisonclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Adresselivraisonclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Adresselivraisonclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Adresselivraisonclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Adresselivraisonclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Adresselivraisonclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Adresselivraisonclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Adresselivraisonclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Adresselivraisonclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AdresselivraisonclientsTable extends Table
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

        $this->setTable('adresselivraisonclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
         //   'joinType' => 'INNER',
        ]);
        $this->hasMany('Bonlivraisons', [
            'foreignKey' => 'adresselivraisonclient_id',
        ]);
        $this->hasMany('Factureclients', [
            'foreignKey' => 'adresselivraisonclient_id',
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

        return $rules;
    }
}

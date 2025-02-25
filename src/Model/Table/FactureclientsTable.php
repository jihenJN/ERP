<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Factureclients Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\PointdeventesTable&\Cake\ORM\Association\BelongsTo $Pointdeventes
 * @property \App\Model\Table\DepotsTable&\Cake\ORM\Association\BelongsTo $Depots
 * @property \App\Model\Table\MaterieltransportsTable&\Cake\ORM\Association\BelongsTo $Materieltransports
 * @property \App\Model\Table\CartecarburantsTable&\Cake\ORM\Association\BelongsTo $Cartecarburants
 * @property \App\Model\Table\ChauffeursTable&\Cake\ORM\Association\BelongsTo $Chauffeurs
 * @property \App\Model\Table\ConvoyeursTable&\Cake\ORM\Association\BelongsTo $Convoyeurs
 * @property \App\Model\Table\AdresselivraisonclientsTable&\Cake\ORM\Association\BelongsTo $Adresselivraisonclients
 * @property \App\Model\Table\BonlivraisonsTable&\Cake\ORM\Association\HasMany $Bonlivraisons
 * @property \App\Model\Table\LignefactureclientsTable&\Cake\ORM\Association\HasMany $Lignefactureclients
 * @property \App\Model\Table\LignereglementclientsTable&\Cake\ORM\Association\HasMany $Lignereglementclients
 *
 * @method \App\Model\Entity\Factureclient newEmptyEntity()
 * @method \App\Model\Entity\Factureclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Factureclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Factureclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Factureclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Factureclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Factureclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Factureclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Factureclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Factureclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Factureclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Factureclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Factureclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FactureclientsTable extends Table
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

        $this->setTable('factureclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
        ]);
        $this->belongsTo('Pointdeventes', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->belongsTo('Depots', [
            'foreignKey' => 'depot_id',
        ]);
        $this->belongsTo('Materieltransports', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
         
        ]);
        $this->belongsTo('Cartecarburants', [
            'foreignKey' => 'cartecarburant_id',
        ]);
     
        $this->belongsTo('Adresselivraisonclients', [
            'foreignKey' => 'adresselivraisonclient_id',
        ]);
        $this->hasMany('Bonlivraisons', [
            'foreignKey' => 'factureclient_id',
        ]);
        $this->hasMany('Lignefactureclients', [
            'foreignKey' => 'factureclient_id',
        ]);
        $this->hasMany('Lignereglementclients', [
            'foreignKey' => 'factureclient_id',
        ]);


        $this->belongsTo('Timbres', [
            'foreignKey' => 'timbre_id',
         
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

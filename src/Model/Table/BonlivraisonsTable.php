<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bonlivraisons Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\PointdeventesTable&\Cake\ORM\Association\BelongsTo $Pointdeventes
 * @property \App\Model\Table\DepotsTable&\Cake\ORM\Association\BelongsTo $Depots
 * @property \App\Model\Table\MaterieltransportsTable&\Cake\ORM\Association\BelongsTo $Materieltransports
 * @property \App\Model\Table\CartecarburantsTable&\Cake\ORM\Association\BelongsTo $Cartecarburants
 * @property \App\Model\Table\FactureclientsTable&\Cake\ORM\Association\BelongsTo $Factureclients
 * @property \App\Model\Table\AdresselivraisonclientsTable&\Cake\ORM\Association\BelongsTo $Adresselivraisonclients
 * @property \App\Model\Table\CommandeclientsTable&\Cake\ORM\Association\HasMany $Commandeclients
 * @property \App\Model\Table\LignebonlivraisonsTable&\Cake\ORM\Association\HasMany $Lignebonlivraisons
 *
 * @method \App\Model\Entity\Bonlivraison newEmptyEntity()
 * @method \App\Model\Entity\Bonlivraison newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Bonlivraison[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bonlivraison get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bonlivraison findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Bonlivraison patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bonlivraison[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bonlivraison|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bonlivraison saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bonlivraison[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bonlivraison[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bonlivraison[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bonlivraison[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BonlivraisonsTable extends Table
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

        $this->setTable('bonlivraisons');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            
        ]);
        
        
         $this->belongsTo('Commercials', [
            'foreignKey' => 'commercial_id',
         
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
         
        ]);

        $this->belongsTo('Bonreceptionstocks', [
            'foreignKey' => 'bonreceptionstock_id',
          
        ]);
      
      
        
        $this->belongsTo('Pointdeventes', [
            'foreignKey' => 'pointdevente_id',
           
        ]);
        $this->belongsTo('Depots', [
            'foreignKey' => 'depot_id',
           
        ]);
        $this->belongsTo('Preparatifs', [
            'foreignKey' => 'preparatif_id',
           
        ]);
        $this->belongsTo('Materieltransports', [
            'foreignKey' => 'materieltransport_id',
           
        ]);
        $this->belongsTo('Cartecarburants', [
            'foreignKey' => 'cartecarburant_id',
           
        ]);
      
        $this->belongsTo('Commandes', [
            'foreignKey' => 'commande_id',
           
        ]);
      
        $this->belongsTo('Factureclients', [
            'foreignKey' => 'factureclient_id',
           
        ]);
        $this->belongsTo('Adresselivraisonclients', [
            'foreignKey' => 'adresselivraisonclient_id',
        ]);



        $this->belongsTo('Personnels', [
            'foreignKey' => 'personnel_id',
        ]);
        $this->belongsTo('Typetransports', [
            'foreignKey' => 'typetransport_id',
        ]);

        $this->belongsTo('Transporteurs', [
            'foreignKey' => 'transporteur_id',
        ]);
    



        $this->belongsTo('Timbres', [
            'foreignKey' => 'timbre_id',
         
        ]);
        $this->hasMany('Commandeclients', [
            'foreignKey' => 'bonlivraison_id',
        ]);
        $this->hasMany('Lignebonlivraisons', [
            'foreignKey' => 'bonlivraison_id',
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

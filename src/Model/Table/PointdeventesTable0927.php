<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pointdeventes Model
 *
 * @property \App\Model\Table\VillesTable&\Cake\ORM\Association\BelongsTo $Villes
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\HasMany $Articles
 * @property \App\Model\Table\BondechargementsTable&\Cake\ORM\Association\HasMany $Bondechargements
 * @property \App\Model\Table\BondereservationsTable&\Cake\ORM\Association\HasMany $Bondereservations
 * @property \App\Model\Table\BondetransfertsTable&\Cake\ORM\Association\HasMany $Bondetransferts
 * @property \App\Model\Table\BonlivraisonsTable&\Cake\ORM\Association\HasMany $Bonlivraisons
 * @property \App\Model\Table\BonreceptionstocksTable&\Cake\ORM\Association\HasMany $Bonreceptionstocks
 * @property \App\Model\Table\BonsortiestocksTable&\Cake\ORM\Association\HasMany $Bonsortiestocks
 * @property \App\Model\Table\CommandeclientsTable&\Cake\ORM\Association\HasMany $Commandeclients
 * @property \App\Model\Table\CommandesTable&\Cake\ORM\Association\HasMany $Commandes
 * @property \App\Model\Table\DepotsTable&\Cake\ORM\Association\HasMany $Depots
 * @property \App\Model\Table\FactureclientsTable&\Cake\ORM\Association\HasMany $Factureclients
 * @property \App\Model\Table\FacturesTable&\Cake\ORM\Association\HasMany $Factures
 * @property \App\Model\Table\LivraisonsTable&\Cake\ORM\Association\HasMany $Livraisons
 * @property \App\Model\Table\LivraisonsancTable&\Cake\ORM\Association\HasMany $Livraisonsanc
 * @property \App\Model\Table\PersonnelsTable&\Cake\ORM\Association\HasMany $Personnels
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 * @property \App\Model\Table\UtilisateursTable&\Cake\ORM\Association\HasMany $Utilisateurs
 *
 * @method \App\Model\Entity\Pointdevente newEmptyEntity()
 * @method \App\Model\Entity\Pointdevente newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Pointdevente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pointdevente get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pointdevente findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Pointdevente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pointdevente[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pointdevente|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pointdevente saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pointdevente[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pointdevente[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pointdevente[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pointdevente[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PointdeventesTable extends Table
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

        $this->setTable('pointdeventes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Villes', [
            'foreignKey' => 'ville_id',
        ]);
        $this->hasMany('Articles', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Bondechargements', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Bondereservations', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Bondetransferts', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Bonlivraisons', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Bonreceptionstocks', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Bonsortiestocks', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Commandeclients', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Commandes', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Depots', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Factureclients', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Factures', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Livraisons', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Livraisonsanc', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Personnels', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->hasMany('Utilisateurs', [
            'foreignKey' => 'pointdevente_id',
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
            ->scalar('code')
            ->maxLength('code', 255)
            ->allowEmptyString('code');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->allowEmptyString('name');

        $validator
            ->scalar('adresse')
            ->maxLength('adresse', 300)
            ->allowEmptyString('adresse');

        $validator
            ->integer('ville_id')
            ->allowEmptyString('ville_id');

        $validator
            ->scalar('matriclefiscale')
            ->maxLength('matriclefiscale', 255)
            ->allowEmptyString('matriclefiscale');

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
        $rules->add($rules->existsIn('ville_id', 'Villes'), ['errorField' => 'ville_id']);

        return $rules;
    }
}

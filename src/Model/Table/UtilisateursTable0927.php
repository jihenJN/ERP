<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Utilisateurs Model
 *
 * @property \App\Model\Table\PersonnelsTable&\Cake\ORM\Association\BelongsTo $Personnels
 * @property \App\Model\Table\PointdeventesTable&\Cake\ORM\Association\BelongsTo $Pointdeventes
 * @property \App\Model\Table\DepotsTable&\Cake\ORM\Association\BelongsTo $Depots
 * @property \App\Model\Table\TracemisejoursTable&\Cake\ORM\Association\HasMany $Tracemisejours
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 * @property \App\Model\Table\UtilisateurmenusTable&\Cake\ORM\Association\HasMany $Utilisateurmenus
 *
 * @method \App\Model\Entity\Utilisateur newEmptyEntity()
 * @method \App\Model\Entity\Utilisateur newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Utilisateur[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Utilisateur get($primaryKey, $options = [])
 * @method \App\Model\Entity\Utilisateur findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Utilisateur patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Utilisateur[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Utilisateur|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Utilisateur saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Utilisateur[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Utilisateur[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Utilisateur[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Utilisateur[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UtilisateursTable extends Table
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

        $this->setTable('utilisateurs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Personnels', [
            'foreignKey' => 'personnel_id',
        ]);
        $this->belongsTo('Pointdeventes', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->belongsTo('Depots', [
            'foreignKey' => 'depot_id',
        ]);
        $this->hasMany('Tracemisejours', [
            'foreignKey' => 'utilisateur_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'utilisateur_id',
        ]);
        $this->hasMany('Utilisateurmenus', [
            'foreignKey' => 'utilisateur_id',
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
            ->integer('personnel_id')
            ->allowEmptyString('personnel_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('login')
            ->maxLength('login', 255)
            ->allowEmptyString('login');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->allowEmptyString('password');

        $validator
            ->integer('pointdevente_id')
            ->allowEmptyString('pointdevente_id');

        $validator
            ->integer('depot_id')
            ->allowEmptyString('depot_id');

        $validator
            ->integer('stocknegatif')
            ->allowEmptyString('stocknegatif');

        $validator
            ->integer('notifdevis')
            ->allowEmptyString('notifdevis');

        $validator
            ->integer('notifcaisse')
            ->allowEmptyString('notifcaisse');

        $validator
            ->integer('notifbsstock')
            ->allowEmptyString('notifbsstock');

        $validator
            ->integer('notifaffaire')
            ->allowEmptyString('notifaffaire');

        $validator
            ->integer('notifvisite')
            ->allowEmptyString('notifvisite');

        $validator
            ->integer('modifpmp')
            ->allowEmptyString('modifpmp');

        $validator
            ->integer('notifartdevis')
            ->allowEmptyString('notifartdevis');

        $validator
            ->integer('imp_val_inventaire')
            ->allowEmptyString('imp_val_inventaire');

        $validator
            ->integer('imp_val_bonecart')
            ->allowEmptyString('imp_val_bonecart');

        $validator
            ->integer('trans_vers_prod')
            ->allowEmptyString('trans_vers_prod');

        $validator
            ->integer('factureclient')
            ->allowEmptyString('factureclient');

        $validator
            ->integer('notifcommandeclient')
            ->allowEmptyString('notifcommandeclient');

        $validator
            ->integer('MajNumero')
            ->allowEmptyString('MajNumero');

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
        $rules->add($rules->existsIn('personnel_id', 'Personnels'), ['errorField' => 'personnel_id']);
        $rules->add($rules->existsIn('pointdevente_id', 'Pointdeventes'), ['errorField' => 'pointdevente_id']);
        $rules->add($rules->existsIn('depot_id', 'Depots'), ['errorField' => 'depot_id']);

        return $rules;
    }
}

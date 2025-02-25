<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reglementclients Model
 *
 * @property \App\Model\Table\UtilisateursTable&\Cake\ORM\Association\BelongsTo $Utilisateurs
 * @property \App\Model\Table\LignereglementclientsTable&\Cake\ORM\Association\HasMany $Lignereglementclients
 * @property \App\Model\Table\PiecereglementclientsTable&\Cake\ORM\Association\HasMany $Piecereglementclients
 *
 * @method \App\Model\Entity\Reglementclient newEmptyEntity()
 * @method \App\Model\Entity\Reglementclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Reglementclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reglementclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reglementclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Reglementclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reglementclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reglementclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reglementclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reglementclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reglementclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reglementclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reglementclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ReglementclientsTable extends Table
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

        $this->setTable('reglementclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Utilisateurs', [
            'foreignKey' => 'utilisateur_id',
        ]);
        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'propertyName' => 'client'
        ]);
        $this->belongsTo('Importations', [
            'foreignKey' => 'importation_id',
        ]);
        $this->belongsTo('Exercices', [
            'foreignKey' => 'exercice_id',
        ]);
        $this->belongsTo('Devises', [
            'foreignKey' => 'devise_id',
        ]);
        $this->hasMany('Lignereglementclients', [
            'foreignKey' => 'reglementclient_id',
        ]);
        $this->hasMany('Piecereglementclients', [
            'foreignKey' => 'reglementclient_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
         
        ]);
        $this->hasMany('Bonlivraisons', [
            'foreignKey' => 'bonlivraison_id',
        ]);
        $this->belongsTo('Retenus', [
            'foreignKey' => 'retenu_id',
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
        $rules->add($rules->existsIn('utilisateur_id', 'Utilisateurs'), ['errorField' => 'utilisateur_id']);

        return $rules;
    }
}

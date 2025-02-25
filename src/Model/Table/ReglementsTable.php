<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reglements Model
 *
 * @property \App\Model\Table\FournisseursTable&\Cake\ORM\Association\BelongsTo $Fournisseurs
 * @property \App\Model\Table\ImportationsTable&\Cake\ORM\Association\BelongsTo $Importations
 * @property \App\Model\Table\UtilisateursTable&\Cake\ORM\Association\BelongsTo $Utilisateurs
 * @property \App\Model\Table\ExercicesTable&\Cake\ORM\Association\BelongsTo $Exercices
 * @property \App\Model\Table\DevisesTable&\Cake\ORM\Association\BelongsTo $Devises
 * @property \App\Model\Table\LignereglementsTable&\Cake\ORM\Association\HasMany $Lignereglements
 * @property \App\Model\Table\PiecereglementsTable&\Cake\ORM\Association\HasMany $Piecereglements
 *
 * @method \App\Model\Entity\Reglement newEmptyEntity()
 * @method \App\Model\Entity\Reglement newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Reglement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reglement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reglement findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Reglement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reglement[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reglement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reglement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reglement[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reglement[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reglement[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reglement[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ReglementsTable extends Table
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

        $this->setTable('reglements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->belongsTo('Importations', [
            'foreignKey' => 'importation_id',
        ]);
        $this->belongsTo('Utilisateurs', [
            'foreignKey' => 'utilisateur_id',
        ]);
        $this->belongsTo('Exercices', [
            'foreignKey' => 'exercice_id',
        ]);
        $this->belongsTo('Devises', [
            'foreignKey' => 'devise_id',
        ]);
        $this->hasMany('Lignereglements', [
            'foreignKey' => 'reglement_id',
        ]);
        $this->hasMany('Piecereglements', [
            'foreignKey' => 'reglement_id',
        ]);
          $this->hasMany('Pointdeventes', [
            'foreignKey' => 'pointdevente_id',
        ]);
           $this->hasMany('Livraisons', [
            'foreignKey' => 'livraison_id',
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
        $rules->add($rules->existsIn('fournisseur_id', 'Fournisseurs'), ['errorField' => 'fournisseur_id']);
        $rules->add($rules->existsIn('importation_id', 'Importations'), ['errorField' => 'importation_id']);
        $rules->add($rules->existsIn('utilisateur_id', 'Utilisateurs'), ['errorField' => 'utilisateur_id']);
        $rules->add($rules->existsIn('exercice_id', 'Exercices'), ['errorField' => 'exercice_id']);
        $rules->add($rules->existsIn('devise_id', 'Devises'), ['errorField' => 'devise_id']);

        return $rules;
    }
}

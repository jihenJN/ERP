<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Importations Model
 *
 * @property \App\Model\Table\FournisseursTable&\Cake\ORM\Association\BelongsTo $Fournisseurs
 * @property \App\Model\Table\DevisesTable&\Cake\ORM\Association\BelongsTo $Devises
 * @property \App\Model\Table\SituationsTable&\Cake\ORM\Association\BelongsTo $Situations
 * @property \App\Model\Table\PiecereglementsTable&\Cake\ORM\Association\HasMany $Piecereglements
 * @property \App\Model\Table\ReglementsTable&\Cake\ORM\Association\HasMany $Reglements
 *
 * @method \App\Model\Entity\Importation newEmptyEntity()
 * @method \App\Model\Entity\Importation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Importation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Importation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Importation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Importation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Importation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Importation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Importation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Importation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Importation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Importation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Importation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ImportationsTable extends Table
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

        $this->setTable('importations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->belongsTo('Devises', [
            'foreignKey' => 'devise_id',
        ]);
        $this->belongsTo('Situations', [
            'foreignKey' => 'situation_id',
        ]);
        $this->hasMany('Piecereglements', [
            'foreignKey' => 'importation_id',
        ]);
        $this->hasMany('Reglements', [
            'foreignKey' => 'importation_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 255)
            ->allowEmptyString('numero');

        $validator
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->date('dateliv')
            ->allowEmptyDate('dateliv');

        $validator
            ->integer('fournisseur_id')
            ->allowEmptyString('fournisseur_id');

        $validator
            ->integer('devise_id')
            ->allowEmptyString('devise_id');

        $validator
            ->decimal('montantachat')
            ->allowEmptyString('montantachat');

        $validator
            ->numeric('tauxderechenge')
            ->allowEmptyString('tauxderechenge');

        $validator
            ->decimal('prixachat')
            ->allowEmptyString('prixachat');

        $validator
            ->decimal('avis')
            ->allowEmptyString('avis');

        $validator
            ->decimal('transitaire')
            ->allowEmptyString('transitaire');

        $validator
            ->decimal('ddttva')
            ->allowEmptyString('ddttva');

        $validator
            ->decimal('assurence')
            ->allowEmptyString('assurence');

        $validator
            ->decimal('divers')
            ->allowEmptyString('divers');

        $validator
            ->decimal('fraisfinancie')
            ->allowEmptyString('fraisfinancie');

        $validator
            ->decimal('magasinage')
            ->allowEmptyString('magasinage');

        $validator
            ->integer('fournisseuravis')
            ->allowEmptyString('fournisseuravis');

        $validator
            ->integer('fournisseurtransitaire')
            ->allowEmptyString('fournisseurtransitaire');

        $validator
            ->integer('fournisseurddttva')
            ->allowEmptyString('fournisseurddttva');

        $validator
            ->integer('fournisseurassurence')
            ->allowEmptyString('fournisseurassurence');

        $validator
            ->integer('fournisseurdivers')
            ->allowEmptyString('fournisseurdivers');

        $validator
            ->integer('fournisseurfraisfinancie')
            ->allowEmptyString('fournisseurfraisfinancie');

        $validator
            ->integer('fournisseurmagasinage')
            ->allowEmptyString('fournisseurmagasinage');

        $validator
            ->numeric('totale')
            ->allowEmptyString('totale');

        $validator
            ->numeric('coefficien')
            ->allowEmptyString('coefficien');

        $validator
            ->numeric('coeff')
            ->allowEmptyString('coeff');

        $validator
            ->integer('etat')
            ->notEmptyString('etat');

        $validator
            ->integer('situation_id')
            ->allowEmptyString('situation_id');

        $validator
            ->numeric('Coefficientchoisi')
            ->allowEmptyString('Coefficientchoisi');

        $validator
            ->integer('regler')
            ->allowEmptyString('regler');

        $validator
            ->integer('facturer')
            ->allowEmptyString('facturer');

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
        $rules->add($rules->existsIn('devise_id', 'Devises'), ['errorField' => 'devise_id']);
        $rules->add($rules->existsIn('situation_id', 'Situations'), ['errorField' => 'situation_id']);

        return $rules;
    }
}

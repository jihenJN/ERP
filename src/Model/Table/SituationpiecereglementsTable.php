<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Situationpiecereglements Model
 *
 * @property \App\Model\Table\EtatpiecereglementsTable&\Cake\ORM\Association\BelongsTo $Etatpiecereglements
 * @property \App\Model\Table\PiecereglementsTable&\Cake\ORM\Association\BelongsTo $Piecereglements
 * @property \App\Model\Table\UtilisateursTable&\Cake\ORM\Association\BelongsTo $Utilisateurs
 *
 * @method \App\Model\Entity\Situationpiecereglement newEmptyEntity()
 * @method \App\Model\Entity\Situationpiecereglement newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Situationpiecereglement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Situationpiecereglement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Situationpiecereglement findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Situationpiecereglement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Situationpiecereglement[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Situationpiecereglement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Situationpiecereglement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Situationpiecereglement[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Situationpiecereglement[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Situationpiecereglement[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Situationpiecereglement[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SituationpiecereglementsTable extends Table
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

        $this->setTable('situationpiecereglements');

        $this->belongsTo('Etatpiecereglements', [
            'foreignKey' => 'etatpiecereglement_id',
        ]);
        $this->belongsTo('Piecereglements', [
            'foreignKey' => 'piecereglement_id',
        ]);
        $this->belongsTo('Utilisateurs', [
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
        // $validator
        //     ->requirePresence('id', 'create')
        //     ->notEmptyString('id');

        // $validator
        //     ->date('date')
        //     ->allowEmptyDate('date');

        // $validator
        //     ->decimal('agio')
        //     ->allowEmptyString('agio');

        // $validator
        //     ->allowEmptyString('etatpiecereglement_id');

        // $validator
        //     ->allowEmptyString('piecereglement_id');

        // $validator
        //     ->scalar('situation')
        //     ->maxLength('situation', 255)
        //     ->allowEmptyString('situation');

        // $validator
        //     ->integer('utilisateur_id')
        //     ->allowEmptyString('utilisateur_id');

        // $validator
        //     ->date('datemodification')
        //     ->allowEmptyDate('datemodification');

        // $validator
        //     ->integer('nbrjour')
        //     ->allowEmptyString('nbrjour');

        // $validator
        //     ->integer('nbrmoins')
        //     ->allowEmptyString('nbrmoins');

        // $validator
        //     ->decimal('montant')
        //     ->allowEmptyString('montant');

        // $validator
        //     ->scalar('numeropieceintegre')
        //     ->maxLength('numeropieceintegre', 255)
        //     ->allowEmptyString('numeropieceintegre');

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
        $rules->add($rules->existsIn('etatpiecereglement_id', 'Etatpiecereglements'), ['errorField' => 'etatpiecereglement_id']);
        $rules->add($rules->existsIn('piecereglement_id', 'Piecereglements'), ['errorField' => 'piecereglement_id']);
        $rules->add($rules->existsIn('utilisateur_id', 'Utilisateurs'), ['errorField' => 'utilisateur_id']);

        return $rules;
    }
}

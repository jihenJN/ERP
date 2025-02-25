<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Etatpiecereglements Model
 *
 * @property \App\Model\Table\EtatsTable&\Cake\ORM\Association\BelongsTo $Etats
 * @property \App\Model\Table\PiecereglementachatsTable&\Cake\ORM\Association\BelongsTo $Piecereglementachats
 * @property \App\Model\Table\ReglementachatsTable&\Cake\ORM\Association\BelongsTo $Reglementachats
 *
 * @method \App\Model\Entity\Etatpiecereglement newEmptyEntity()
 * @method \App\Model\Entity\Etatpiecereglement newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Etatpiecereglement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Etatpiecereglement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Etatpiecereglement findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Etatpiecereglement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Etatpiecereglement[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Etatpiecereglement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Etatpiecereglement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Etatpiecereglement[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etatpiecereglement[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etatpiecereglement[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etatpiecereglement[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EtatpiecereglementsTable extends Table
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

        $this->setTable('etatpiecereglements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // $this->belongsTo('Etats', [
        //     'foreignKey' => 'etat_id',
        // ]);
        $this->belongsTo('Piecereglements', [
            'foreignKey' => 'piecereglement_id',
        ]);
        // $this->belongsTo('Reglementachats', [
        //     'foreignKey' => 'reglementachat_id',
        // ]);
        $this->belongsTo('Comptes', [
            'foreignKey' => 'compte_id',
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
        // $rules->add($rules->existsIn('etat_id', 'Etats'), ['errorField' => 'etat_id']);
        // $rules->add($rules->existsIn('piecereglementachat_id', 'Piecereglementachats'), ['errorField' => 'piecereglementachat_id']);
        // $rules->add($rules->existsIn('reglementachat_id', 'Reglementachats'), ['errorField' => 'reglementachat_id']);
        // $rules->add($rules->existsIn('compte_id', 'Comptes'), ['errorField' => 'compte_id']);

        return $rules;
    }
}

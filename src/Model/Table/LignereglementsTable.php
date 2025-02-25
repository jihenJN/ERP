<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignereglements Model
 *
 * @property \App\Model\Table\ReglementsTable&\Cake\ORM\Association\BelongsTo $Reglements
 * @property \App\Model\Table\FacturesTable&\Cake\ORM\Association\BelongsTo $Factures
 * @property \App\Model\Table\PiecereglementsTable&\Cake\ORM\Association\BelongsTo $Piecereglements
 *
 * @method \App\Model\Entity\Lignereglement newEmptyEntity()
 * @method \App\Model\Entity\Lignereglement newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignereglement findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignereglement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglement[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignereglement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignereglement[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignereglement[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignereglement[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignereglement[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignereglementsTable extends Table
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

        $this->setTable('lignereglements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Reglements', [
            'foreignKey' => 'reglement_id',
        ]);
        $this->belongsTo('Factures', [
            'foreignKey' => 'facture_id',
        ]);
        $this->belongsTo('Piecereglements', [
            'foreignKey' => 'piecereglement_id',
        ]);
         $this->belongsTo('Livraisons', [
            'foreignKey' => 'livraison_id',
        ]);
        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'fourisseur_id',
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
        //     ->allowEmptyString('reglement_id');

        // $validator
        //     ->decimal('Montant')
        //     ->allowEmptyString('Montant');

        // $validator
        //     ->allowEmptyString('facture_id');

        // $validator
        //     ->numeric('tauxchange')
        //     ->allowEmptyString('tauxchange');

        // $validator
        //     ->allowEmptyString('piecereglement_id');

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
        $rules->add($rules->existsIn('reglement_id', 'Reglements'), ['errorField' => 'reglement_id']);
        $rules->add($rules->existsIn('facture_id', 'Factures'), ['errorField' => 'facture_id']);
        $rules->add($rules->existsIn('piecereglement_id', 'Piecereglements'), ['errorField' => 'piecereglement_id']);

        return $rules;
    }
}

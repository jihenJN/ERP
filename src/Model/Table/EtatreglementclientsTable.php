<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Etatreglementclients Model
 *
 * @property \App\Model\Table\ReglementclientsTable&\Cake\ORM\Association\BelongsTo $Reglementclients
 * @property \App\Model\Table\PiecereglementclientsTable&\Cake\ORM\Association\BelongsTo $Piecereglementclients
 * @property \App\Model\Table\EtatsTable&\Cake\ORM\Association\BelongsTo $Etats
 *
 * @method \App\Model\Entity\Etatreglementclient newEmptyEntity()
 * @method \App\Model\Entity\Etatreglementclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Etatreglementclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Etatreglementclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Etatreglementclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Etatreglementclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Etatreglementclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Etatreglementclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Etatreglementclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Etatreglementclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etatreglementclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etatreglementclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etatreglementclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EtatreglementclientsTable extends Table
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

        $this->setTable('etatreglementclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Reglementclients', [
            'foreignKey' => 'reglementclient_id',
        ]);
        $this->belongsTo('Piecereglementclients', [
            'foreignKey' => 'piecereglementclient_id',
        ]);
        $this->belongsTo('Etats', [
            'foreignKey' => 'etat_id',
        ]);
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
        // $validator
        //     ->integer('reglementclient_id')
        //     ->allowEmptyString('reglementclient_id');

        // $validator
        //     ->integer('piecereglementclient_id')
        //     ->allowEmptyString('piecereglementclient_id');

        // $validator
        //     ->date('date')
        //     ->allowEmptyDate('date');

        // $validator
        //     ->integer('etat_id')
        //     ->allowEmptyString('etat_id');

        // $validator
        //     ->integer('compte_id')
        //     ->allowEmptyString('compte_id');

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
        // $rules->add($rules->existsIn('reglementclient_id', 'Reglementclients'), ['errorField' => 'reglementclient_id']);
        // $rules->add($rules->existsIn('piecereglementclient_id', 'Piecereglementclients'), ['errorField' => 'piecereglementclient_id']);
        // $rules->add($rules->existsIn('etat_id', 'Etats'), ['errorField' => 'etat_id']);
        // $rules->add($rules->existsIn('compte_id', 'Comptes'), ['errorField' => 'compte_id']);

        return $rules;
    }
}

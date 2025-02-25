<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignereglementclients Model
 *
 * @property \App\Model\Table\ReglementclientsTable&\Cake\ORM\Association\BelongsTo $Reglementclients
 * @property \App\Model\Table\PiecereglementclientsTable&\Cake\ORM\Association\BelongsTo $Piecereglementclients
 *
 * @method \App\Model\Entity\Lignereglementclient newEmptyEntity()
 * @method \App\Model\Entity\Lignereglementclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglementclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglementclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignereglementclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignereglementclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglementclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglementclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignereglementclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignereglementclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignereglementclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignereglementclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignereglementclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignereglementclientsTable extends Table
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

        $this->setTable('lignereglementclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Reglementclients', [
            'foreignKey' => 'reglementclient_id',
        ]);
        $this->belongsTo('Factureclients', [
            'foreignKey' => 'factureclient_id',
        ]);
        $this->belongsTo('Bonlivraisons', [
            'foreignKey' => 'bonlivraison_id',
        ]);
        $this->belongsTo('Piecereglementclients', [
            'foreignKey' => 'piecereglementclient_id',
        ]);
        $this->belongsTo('Commandes', [
            'foreignKey' => 'commande_id',
        ]);
        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
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
        //     ->allowEmptyString('reglementclient_id');

        // $validator
        //     ->decimal('Montant')
        //     ->allowEmptyString('Montant');

        // $validator
        //     ->allowEmptyString('factureclient_id');
        // $validator
        //     ->allowEmptyString('bonlivraison_id');
        // $validator
        //     ->allowEmptyString('piecereglementclient_id');

        // $validator
        //     ->decimal('remise')
        //     ->allowEmptyString('remise');

        // $validator
        //     ->scalar('SR_BL')
        //     ->maxLength('SR_BL', 255)
        //     ->allowEmptyString('SR_BL');

        // $validator
        //     ->scalar('NB_BL')
        //     ->maxLength('NB_BL', 255)
        //     ->allowEmptyString('NB_BL');

        // $validator
        //     ->integer('affectation_id')
        //     ->allowEmptyString('affectation_id');

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
        $rules->add($rules->existsIn('reglementclient_id', 'Reglementclients'), ['errorField' => 'reglementclient_id']);
        $rules->add($rules->existsIn('piecereglementclient_id', 'Piecereglementclients'), ['errorField' => 'piecereglementclient_id']);

        return $rules;
    }
}

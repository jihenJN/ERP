<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Historiquecommandes Model
 *
 * @property \App\Model\Table\CommandesTable&\Cake\ORM\Association\BelongsTo $Commandes
 *
 * @method \App\Model\Entity\Historiquecommande newEmptyEntity()
 * @method \App\Model\Entity\Historiquecommande newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Historiquecommande[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Historiquecommande get($primaryKey, $options = [])
 * @method \App\Model\Entity\Historiquecommande findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Historiquecommande patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Historiquecommande[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Historiquecommande|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Historiquecommande saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Historiquecommande[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Historiquecommande[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Historiquecommande[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Historiquecommande[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class HistoriquecommandesTable extends Table
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

        $this->setTable('historiquecommandes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Commandes', [
            'foreignKey' => 'commande_id',
            'joinType' => 'INNER',
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
            ->integer('commande_id')
            ->requirePresence('commande_id', 'create')
            ->notEmptyString('commande_id');

        $validator
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmptyDateTime('date');

        // $validator
        //     ->integer('num_tab')
        //     ->requirePresence('num_tab', 'create')
        //     ->notEmptyString('num_tab');

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
        $rules->add($rules->existsIn('commande_id', 'Commandes'), ['errorField' => 'commande_id']);

        return $rules;
    }
}

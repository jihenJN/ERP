<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dossierimportations Model
 *
 * @method \App\Model\Entity\Dossierimportation newEmptyEntity()
 * @method \App\Model\Entity\Dossierimportation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Dossierimportation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Dossierimportation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Dossierimportation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Dossierimportation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Dossierimportation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Dossierimportation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dossierimportation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dossierimportation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Dossierimportation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Dossierimportation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Dossierimportation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DossierimportationsTable extends Table
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

        $this->setTable('dossierimportations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'fournisseur_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Banques', [
            'foreignKey' => 'banque_id',
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
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 255)
            ->requirePresence('numero', 'create')
            ->notEmptyString('numero');

        $validator
            ->integer('etat')
            ->allowEmptyString('etat');

        // $validator
        //     ->integer('methodecalcule_id')
        //     ->requirePresence('methodecalcule_id', 'create')
        //     ->notEmptyString('methodecalcule_id');

        $validator
            ->integer('fournisseur_id')
            ->allowEmptyString('fournisseur_id');

        $validator
            ->integer('banque_id')
            ->allowEmptyString('banque_id');

        return $validator;
    }
}

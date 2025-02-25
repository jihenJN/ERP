<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Etattraiteexcels Model
 *
 * @method \App\Model\Entity\Etattraiteexcel newEmptyEntity()
 * @method \App\Model\Entity\Etattraiteexcel newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Etattraiteexcel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Etattraiteexcel get($primaryKey, $options = [])
 * @method \App\Model\Entity\Etattraiteexcel findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Etattraiteexcel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Etattraiteexcel[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Etattraiteexcel|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Etattraiteexcel saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Etattraiteexcel[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etattraiteexcel[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etattraiteexcel[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etattraiteexcel[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EtattraiteexcelsTable extends Table
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

        $this->setTable('etattraiteexcels');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('fournisseur_name')
            ->maxLength('fournisseur_name', 61)
            ->allowEmptyString('fournisseur_name');

        $validator
            ->scalar('numpiece')
            ->maxLength('numpiece', 255)
            ->allowEmptyString('numpiece');

        $validator
            ->date('echeance')
            ->allowEmptyDate('echeance');

        $validator
            ->numeric('montant')
            ->allowEmptyString('montant');

        return $validator;
    }
}

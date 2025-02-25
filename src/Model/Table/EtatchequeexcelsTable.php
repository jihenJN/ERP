<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Etatchequeexcels Model
 *
 * @method \App\Model\Entity\Etatchequeexcel newEmptyEntity()
 * @method \App\Model\Entity\Etatchequeexcel newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Etatchequeexcel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Etatchequeexcel get($primaryKey, $options = [])
 * @method \App\Model\Entity\Etatchequeexcel findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Etatchequeexcel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Etatchequeexcel[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Etatchequeexcel|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Etatchequeexcel saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Etatchequeexcel[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etatchequeexcel[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etatchequeexcel[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Etatchequeexcel[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EtatchequeexcelsTable extends Table
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

        $this->setTable('etatchequeexcels');
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
            ->maxLength('fournisseur_name', 255)
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

        $validator
            ->scalar('compte_numero')
            ->maxLength('compte_numero', 255)
            ->allowEmptyString('compte_numero');

        return $validator;
    }
}

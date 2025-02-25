<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Exercices Model
 *
 * @property \App\Model\Table\InventairesTable&\Cake\ORM\Association\HasMany $Inventaires
 *
 * @method \App\Model\Entity\Exercice newEmptyEntity()
 * @method \App\Model\Entity\Exercice newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Exercice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Exercice get($primaryKey, $options = [])
 * @method \App\Model\Entity\Exercice findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Exercice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Exercice[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Exercice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Exercice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Exercice[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Exercice[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Exercice[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Exercice[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ExercicesTable extends Table
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

        $this->setTable('exercices');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Inventaires', [
            'foreignKey' => 'exercice_id',
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
            ->integer('name')
            ->allowEmptyString('name');

        return $validator;
    }
}

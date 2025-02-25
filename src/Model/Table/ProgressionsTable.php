<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Progressions Model
 *
 * @property \App\Model\Table\TachesTable&\Cake\ORM\Association\HasMany $Taches
 *
 * @method \App\Model\Entity\Progression newEmptyEntity()
 * @method \App\Model\Entity\Progression newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Progression[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Progression get($primaryKey, $options = [])
 * @method \App\Model\Entity\Progression findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Progression patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Progression[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Progression|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Progression saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Progression[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Progression[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Progression[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Progression[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProgressionsTable extends Table
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

        $this->setTable('progressions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Taches', [
            'foreignKey' => 'progression_id',
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
            ->scalar('valeur')
            ->maxLength('valeur', 50)
            ->allowEmptyString('valeur');

        return $validator;
    }
}

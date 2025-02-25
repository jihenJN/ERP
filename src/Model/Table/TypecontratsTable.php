<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Typecontrats Model
 *
 * @property \App\Model\Table\PersonnelsTable&\Cake\ORM\Association\HasMany $Personnels
 *
 * @method \App\Model\Entity\Typecontrat newEmptyEntity()
 * @method \App\Model\Entity\Typecontrat newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Typecontrat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Typecontrat get($primaryKey, $options = [])
 * @method \App\Model\Entity\Typecontrat findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Typecontrat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Typecontrat[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Typecontrat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typecontrat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Typecontrat[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typecontrat[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typecontrat[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Typecontrat[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TypecontratsTable extends Table
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

        $this->setTable('typecontrats');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Personnels', [
            'foreignKey' => 'typecontrat_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        return $validator;
    }
}

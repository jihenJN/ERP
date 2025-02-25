<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tagcategories Model
 *
 * @method \App\Model\Entity\Tagcategory newEmptyEntity()
 * @method \App\Model\Entity\Tagcategory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tagcategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tagcategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tagcategory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tagcategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tagcategory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tagcategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tagcategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tagcategory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tagcategory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tagcategory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tagcategory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TagcategoriesTable extends Table
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

        $this->setTable('tagcategories');
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
            ->scalar('reference')
            ->maxLength('reference', 200)
            ->allowEmptyString('reference');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('couleur')
            ->maxLength('couleur', 200)
            ->allowEmptyString('couleur');

        return $validator;
    }
}

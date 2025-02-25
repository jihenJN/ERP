<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tvas Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\HasMany $Articles
 *
 * @method \App\Model\Entity\Tva newEmptyEntity()
 * @method \App\Model\Entity\Tva newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tva[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tva get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tva findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tva patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tva[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tva|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tva saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tva[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tva[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tva[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tva[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TvasTable extends Table
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

        $this->setTable('tvas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Articles', [
            'foreignKey' => 'tva_id',
        ]);
        $this->hasMany('Articlesanc', [
            'foreignKey' => 'tva_id',
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
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('valeur')
            ->maxLength('valeur', 50)
            ->requirePresence('valeur', 'create')
            ->notEmptyString('valeur');

        return $validator;
    }
}

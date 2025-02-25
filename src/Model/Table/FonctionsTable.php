<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fonctions Model
 *
 * @property \App\Model\Table\PersonnelsTable&\Cake\ORM\Association\HasMany $Personnels
 *
 * @method \App\Model\Entity\Fonction newEmptyEntity()
 * @method \App\Model\Entity\Fonction newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Fonction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fonction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fonction findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Fonction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fonction[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fonction|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fonction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fonction[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fonction[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fonction[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fonction[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FonctionsTable extends Table
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

        $this->setTable('fonctions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Personnels', [
            'foreignKey' => 'fonction_id',
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

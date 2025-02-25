<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sousfamille1s Model
 *
 * @property \App\Model\Table\FamillesTable&\Cake\ORM\Association\BelongsTo $Familles
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\HasMany $Articles
 * @property \App\Model\Table\Sousfamille2sTable&\Cake\ORM\Association\HasMany $Sousfamille2s
 *
 * @method \App\Model\Entity\Sousfamille1 newEmptyEntity()
 * @method \App\Model\Entity\Sousfamille1 newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sousfamille1[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sousfamille1 get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sousfamille1 findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sousfamille1 patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sousfamille1[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sousfamille1|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sousfamille1 saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sousfamille1[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sousfamille1[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sousfamille1[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sousfamille1[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class Sousfamille1sTable extends Table
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

        $this->setTable('sousfamille1s');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Familles', [
            'foreignKey' => 'famille_id',
        ]);
        $this->hasMany('Articles', [
            'foreignKey' => 'sousfamille1_id',
        ]);
        $this->hasMany('Sousfamille2s', [
            'foreignKey' => 'sousfamille1_id',
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
            ->integer('famille_id')
            ->allowEmptyString('famille_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

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
        $rules->add($rules->existsIn('famille_id', 'Familles'), ['errorField' => 'famille_id']);

        return $rules;
    }
}

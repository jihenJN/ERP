<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sousfamille2s Model
 *
 * @property \App\Model\Table\Sousfamille1sTable&\Cake\ORM\Association\BelongsTo $Sousfamille1s
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\HasMany $Articles
 * @property \App\Model\Table\Sousfamille3sTable&\Cake\ORM\Association\HasMany $Sousfamille3s
 *
 * @method \App\Model\Entity\Sousfamille2 newEmptyEntity()
 * @method \App\Model\Entity\Sousfamille2 newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sousfamille2[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sousfamille2 get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sousfamille2 findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sousfamille2 patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sousfamille2[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sousfamille2|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sousfamille2 saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sousfamille2[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sousfamille2[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sousfamille2[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sousfamille2[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class Sousfamille2sTable extends Table
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

        $this->setTable('sousfamille2s');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Sousfamille1s', [
            'foreignKey' => 'sousfamille1_id',
        ]);
        $this->hasMany('Articles', [
            'foreignKey' => 'sousfamille2_id',
        ]);
        $this->hasMany('Sousfamille3s', [
            'foreignKey' => 'sousfamille2_id',
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
            ->integer('sousfamille1_id')
            ->allowEmptyString('sousfamille1_id');

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
        $rules->add($rules->existsIn('sousfamille1_id', 'Sousfamille1s'), ['errorField' => 'sousfamille1_id']);

        return $rules;
    }
}

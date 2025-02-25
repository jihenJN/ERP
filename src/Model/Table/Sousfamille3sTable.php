<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sousfamille3s Model
 *
 * @property \App\Model\Table\Sousfamille2sTable&\Cake\ORM\Association\BelongsTo $Sousfamille2s
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\HasMany $Articles
 *
 * @method \App\Model\Entity\Sousfamille3 newEmptyEntity()
 * @method \App\Model\Entity\Sousfamille3 newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sousfamille3[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sousfamille3 get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sousfamille3 findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sousfamille3 patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sousfamille3[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sousfamille3|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sousfamille3 saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sousfamille3[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sousfamille3[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sousfamille3[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sousfamille3[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class Sousfamille3sTable extends Table
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

        $this->setTable('sousfamille3s');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Sousfamille2s', [
            'foreignKey' => 'sousfamille2_id',
        ]);
        $this->hasMany('Articles', [
            'foreignKey' => 'sousfamille3_id',
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
            ->integer('sousfamille2_id')
            ->allowEmptyString('sousfamille2_id');

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
        $rules->add($rules->existsIn('sousfamille2_id', 'Sousfamille2s'), ['errorField' => 'sousfamille2_id']);

        return $rules;
    }
}

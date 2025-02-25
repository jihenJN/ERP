<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Objectifrepresentants Model
 *
 * @property \App\Model\Table\MoisTable&\Cake\ORM\Association\BelongsTo $Mois
 * @property \App\Model\Table\CommercialsTable&\Cake\ORM\Association\BelongsTo $Commercials
 *
 * @method \App\Model\Entity\Objectifrepresentant newEmptyEntity()
 * @method \App\Model\Entity\Objectifrepresentant newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Objectifrepresentant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Objectifrepresentant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Objectifrepresentant findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Objectifrepresentant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Objectifrepresentant[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Objectifrepresentant|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Objectifrepresentant saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Objectifrepresentant[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Objectifrepresentant[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Objectifrepresentant[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Objectifrepresentant[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ObjectifrepresentantsTable extends Table
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

        $this->setTable('objectifrepresentants');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Mois', [
            'foreignKey' => 'moi_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Commercials', [
            'foreignKey' => 'commercial_id',
            'joinType' => 'INNER',
        ]);



        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
            'joinType' => 'INNER',
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
        $rules->add($rules->existsIn('moi_id', 'Mois'), ['errorField' => 'moi_id']);
        $rules->add($rules->existsIn('commercial_id', 'Commercials'), ['errorField' => 'commercial_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bonusmaluscommercials Model
 *
 * @property \App\Model\Table\CommercialsTable&\Cake\ORM\Association\BelongsTo $Commercials
 * @property \App\Model\Table\LignebonusmalusTable&\Cake\ORM\Association\HasMany $Lignebonusmalus
 *
 * @method \App\Model\Entity\Bonusmaluscommercial newEmptyEntity()
 * @method \App\Model\Entity\Bonusmaluscommercial newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Bonusmaluscommercial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bonusmaluscommercial get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bonusmaluscommercial findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Bonusmaluscommercial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bonusmaluscommercial[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bonusmaluscommercial|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bonusmaluscommercial saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bonusmaluscommercial[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bonusmaluscommercial[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bonusmaluscommercial[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bonusmaluscommercial[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BonusmaluscommercialsTable extends Table
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

        $this->setTable('bonusmaluscommercials');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Commercials', [
            'foreignKey' => 'commercial_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Lignebonusmalus', [
            'foreignKey' => 'bonusmaluscommercial_id',
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
            ->date('datedebut')
            ->requirePresence('datedebut', 'create')
            ->notEmptyDate('datedebut');

        $validator
            ->date('datefin')
            ->requirePresence('datefin', 'create')
            ->notEmptyDate('datefin');

        $validator
            ->integer('commercial_id')
            ->requirePresence('commercial_id', 'create')
            ->notEmptyString('commercial_id');

        $validator
            ->numeric('total')
            ->requirePresence('total', 'create')
            ->notEmptyString('total');

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
        $rules->add($rules->existsIn('commercial_id', 'Commercials'), ['errorField' => 'commercial_id']);

        return $rules;
    }
}

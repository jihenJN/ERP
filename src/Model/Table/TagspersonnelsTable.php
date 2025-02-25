<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tagspersonnels Model
 *
 * @property \App\Model\Table\PersonnelsTable&\Cake\ORM\Association\BelongsTo $Personnels
 * @property \App\Model\Table\ListetagsTable&\Cake\ORM\Association\BelongsTo $Listetags
 *
 * @method \App\Model\Entity\Tagspersonnel newEmptyEntity()
 * @method \App\Model\Entity\Tagspersonnel newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tagspersonnel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tagspersonnel get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tagspersonnel findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tagspersonnel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tagspersonnel[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tagspersonnel|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tagspersonnel saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tagspersonnel[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tagspersonnel[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tagspersonnel[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tagspersonnel[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TagspersonnelsTable extends Table
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

        $this->setTable('tagspersonnels');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Personnels', [
            'foreignKey' => 'personnel_id',
        ]);
        $this->belongsTo('Listetags', [
            'foreignKey' => 'listetag_id',
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
            ->integer('personnel_id')
            ->allowEmptyString('personnel_id');

        $validator
            ->integer('listetag_id')
            ->allowEmptyString('listetag_id');

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
        $rules->add($rules->existsIn('personnel_id', 'Personnels'), ['errorField' => 'personnel_id']);
        $rules->add($rules->existsIn('listetag_id', 'Listetags'), ['errorField' => 'listetag_id']);

        return $rules;
    }
}

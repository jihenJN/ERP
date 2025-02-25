<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignebonusmalus Model
 *
 * @property \App\Model\Table\MoisTable&\Cake\ORM\Association\BelongsTo $Mois
 * @property \App\Model\Table\BonusmaluscommercialsTable&\Cake\ORM\Association\BelongsTo $Bonusmaluscommercials
 *
 * @method \App\Model\Entity\Lignebonusmalus newEmptyEntity()
 * @method \App\Model\Entity\Lignebonusmalus newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonusmalus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonusmalus get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignebonusmalus findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignebonusmalus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonusmalus[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonusmalus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebonusmalus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebonusmalus[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonusmalus[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonusmalus[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonusmalus[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignebonusmalusTable extends Table
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

        $this->setTable('lignebonusmalus');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Mois', [
            'foreignKey' => 'moi_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Bonusmaluscommercials', [
            'foreignKey' => 'bonusmaluscommercial_id',
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
        $rules->add($rules->existsIn('bonusmaluscommercial_id', 'Bonusmaluscommercials'), ['errorField' => 'bonusmaluscommercial_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}

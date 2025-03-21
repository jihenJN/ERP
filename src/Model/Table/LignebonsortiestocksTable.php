<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignebonsortiestocks Model
 *
 * @property \App\Model\Table\BonsortiestocksTable&\Cake\ORM\Association\BelongsTo $Bonsortiestocks
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 *
 * @method \App\Model\Entity\Lignebonsortiestock newEmptyEntity()
 * @method \App\Model\Entity\Lignebonsortiestock newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonsortiestock[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonsortiestock get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignebonsortiestock findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignebonsortiestock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonsortiestock[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebonsortiestock|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebonsortiestock saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebonsortiestock[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonsortiestock[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonsortiestock[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebonsortiestock[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignebonsortiestocksTable extends Table
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

        $this->setTable('lignebonsortiestocks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Bonsortiestocks', [
            'foreignKey' => 'bonsortiestock_id',
          
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
            
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
        $rules->add($rules->existsIn('bonsortiestock_id', 'Bonsortiestocks'), ['errorField' => 'bonsortiestock_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}

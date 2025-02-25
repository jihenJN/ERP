<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignecommandeclients Model
 *
 * @property \App\Model\Table\CommandeclientsTable&\Cake\ORM\Association\BelongsTo $Commandeclients
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 *
 * @method \App\Model\Entity\Lignecommandeclient newEmptyEntity()
 * @method \App\Model\Entity\Lignecommandeclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignecommandeclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignecommandeclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignecommandeclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignecommandeclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignecommandeclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignecommandeclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignecommandeclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignecommandeclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignecommandeclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignecommandeclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignecommandeclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignecommandeclientsTable extends Table
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

        $this->setTable('lignecommandeclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Commandeclients', [
            'foreignKey' => 'commandeclient_id',
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
        $validator
            ->integer('commandeclient_id')
            ->allowEmptyString('commandeclient_id');

        $validator
            ->integer('article_id')
            ->allowEmptyString('article_id');

        
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
        $rules->add($rules->existsIn('commandeclient_id', 'Commandeclients'), ['errorField' => 'commandeclient_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}

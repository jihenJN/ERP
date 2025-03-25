<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignedevis Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\DevisTable&\Cake\ORM\Association\BelongsTo $Devis
 *
 * @method \App\Model\Entity\Lignedevi newEmptyEntity()
 * @method \App\Model\Entity\Lignedevi newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignedevi[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignedevi get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignedevi findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignedevi patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignedevi[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignedevi|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignedevi saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignedevi[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignedevi[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignedevi[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignedevi[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignedevisTable extends Table
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

        $this->setTable('lignedevis');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Devis', [
            'foreignKey' => 'devis_id',
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
        $validator
            ->decimal('prix')
            ->requirePresence('prix', 'create')
            ->notEmptyString('prix');

        $validator
            ->numeric('remise')
            ->notEmptyString('remise');

        $validator
            ->decimal('ht')
            ->requirePresence('ht', 'create')
            ->notEmptyString('ht');

        $validator
            ->integer('article_id')
            ->notEmptyString('article_id');

        $validator
            ->integer('devis_id')
            ->notEmptyString('devis_id');

        $validator
            ->numeric('qte')
            ->notEmptyString('qte');

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
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);
        $rules->add($rules->existsIn('devis_id', 'Devis'), ['errorField' => 'devis_id']);

        return $rules;
    }
}

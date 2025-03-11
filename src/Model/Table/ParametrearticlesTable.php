<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parametrearticles Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\CriteresTable&\Cake\ORM\Association\BelongsTo $Criteres
 * @property \App\Model\Table\LignecriteresTable&\Cake\ORM\Association\BelongsTo $Lignecriteres
 *
 * @method \App\Model\Entity\Parametrearticle newEmptyEntity()
 * @method \App\Model\Entity\Parametrearticle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Parametrearticle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Parametrearticle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Parametrearticle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Parametrearticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Parametrearticle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Parametrearticle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parametrearticle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parametrearticle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parametrearticle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parametrearticle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parametrearticle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ParametrearticlesTable extends Table
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

        $this->setTable('parametrearticles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
        ]);
        $this->belongsTo('Criteres', [
            'foreignKey' => 'critere_id',
        ]);
        $this->belongsTo('Lignecriteres', [
            'foreignKey' => 'lignecritere_id',
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
       

        return $rules;
    }
}

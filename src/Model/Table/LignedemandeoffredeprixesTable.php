<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignedemandeoffredeprixes Model
 *
 * @property \App\Model\Table\DemandeoffredeprixesTable&\Cake\ORM\Association\BelongsTo $Demandeoffredeprixes
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\FournisseursTable&\Cake\ORM\Association\BelongsTo $Fournisseurs
 * @property \App\Model\Table\LignebandeconsultationsTable&\Cake\ORM\Association\HasMany $Lignebandeconsultations
 *
 * @method \App\Model\Entity\Lignedemandeoffredeprix newEmptyEntity()
 * @method \App\Model\Entity\Lignedemandeoffredeprix newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignedemandeoffredeprix[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignedemandeoffredeprix get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignedemandeoffredeprix findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignedemandeoffredeprix patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignedemandeoffredeprix[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignedemandeoffredeprix|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignedemandeoffredeprix saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignedemandeoffredeprix[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignedemandeoffredeprix[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignedemandeoffredeprix[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignedemandeoffredeprix[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignedemandeoffredeprixesTable extends Table
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

        $this->setTable('lignedemandeoffredeprixes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Demandeoffredeprixes', [
            'foreignKey' => 'demandeoffredeprix_id',
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
        ]);
        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->hasMany('Lignebandeconsultations', [
            'foreignKey' => 'lignedemandeoffredeprix_id',
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
        $rules->add($rules->existsIn('demandeoffredeprix_id', 'Demandeoffredeprixes'), ['errorField' => 'demandeoffredeprix_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);
        $rules->add($rules->existsIn('fournisseur_id', 'Fournisseurs'), ['errorField' => 'fournisseur_id']);

        return $rules;
    }
}

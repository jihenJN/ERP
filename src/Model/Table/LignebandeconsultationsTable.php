<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignebandeconsultations Model
 *
 * @property \App\Model\Table\DemandeoffredeprixesTable&\Cake\ORM\Association\BelongsTo $Demandeoffredeprixes
 * @property \App\Model\Table\BandeconsultationsTable&\Cake\ORM\Association\BelongsTo $Bandeconsultations
 * @property \App\Model\Table\LignedemandeoffredeprixesTable&\Cake\ORM\Association\BelongsTo $Lignedemandeoffredeprixes
 * @property \App\Model\Table\FournisseursTable&\Cake\ORM\Association\BelongsTo $Fournisseurs
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 *
 * @method \App\Model\Entity\Lignebandeconsultation newEmptyEntity()
 * @method \App\Model\Entity\Lignebandeconsultation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebandeconsultation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebandeconsultation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignebandeconsultation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignebandeconsultation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebandeconsultation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebandeconsultation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebandeconsultation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebandeconsultation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebandeconsultation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebandeconsultation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebandeconsultation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignebandeconsultationsTable extends Table
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

        $this->setTable('lignebandeconsultations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Demandeoffredeprixes', [
            'foreignKey' => 'demandeoffredeprix_id',
        ]);
        $this->belongsTo('Bandeconsultations', [
            'foreignKey' => 'bandeconsultation_id',
        ]);
        $this->belongsTo('Lignedemandeoffredeprixes', [
            'foreignKey' => 'lignedemandeoffredeprix_id',
        ]);
        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'fournisseur_id',
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
            ->integer('demandeoffredeprix_id')
            ->allowEmptyString('demandeoffredeprix_id');

        $validator
            ->integer('bandeconsultation_id')
            ->allowEmptyString('bandeconsultation_id');

        $validator
            ->integer('lignedemandeoffredeprix_id')
            ->allowEmptyString('lignedemandeoffredeprix_id');

        $validator
            ->integer('fournisseur_id')
            ->allowEmptyString('fournisseur_id');

        $validator
            ->scalar('nameF')
            ->maxLength('nameF', 255)
            ->allowEmptyString('nameF');

        $validator
            ->scalar('codefrs')
            ->maxLength('codefrs', 255)
            ->allowEmptyString('codefrs');

        $validator
            ->integer('article_id')
            ->allowEmptyString('article_id');

        $validator
            ->scalar('designiationA')
            ->maxLength('designiationA', 255)
            ->allowEmptyString('designiationA');

        $validator
            ->integer('qte')
            ->allowEmptyString('qte');

        $validator
            ->decimal('prix')
            ->allowEmptyString('prix');

        $validator
            ->decimal('ht')
            ->allowEmptyString('ht');

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
        $rules->add($rules->existsIn('bandeconsultation_id', 'Bandeconsultations'), ['errorField' => 'bandeconsultation_id']);
        $rules->add($rules->existsIn('lignedemandeoffredeprix_id', 'Lignedemandeoffredeprixes'), ['errorField' => 'lignedemandeoffredeprix_id']);
        $rules->add($rules->existsIn('fournisseur_id', 'Fournisseurs'), ['errorField' => 'fournisseur_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}

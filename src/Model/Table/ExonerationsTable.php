<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Exonerations Model
 *
 * @property \App\Model\Table\TypeexonsTable&\Cake\ORM\Association\BelongsTo $Typeexons
 * @property \App\Model\Table\FournisseursTable&\Cake\ORM\Association\BelongsTo $Fournisseurs
 *
 * @method \App\Model\Entity\Exoneration newEmptyEntity()
 * @method \App\Model\Entity\Exoneration newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Exoneration[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Exoneration get($primaryKey, $options = [])
 * @method \App\Model\Entity\Exoneration findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Exoneration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Exoneration[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Exoneration|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Exoneration saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Exoneration[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Exoneration[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Exoneration[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Exoneration[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ExonerationsTable extends Table
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

        $this->setTable('exonerations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Typeexons', [
            'foreignKey' => 'typeexon_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'fournisseur_id',
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
            ->integer('typeexon_id')
            ->requirePresence('typeexon_id', 'create')
            ->notEmptyString('typeexon_id');

        $validator
            ->integer('num_att_taxes')
            ->requirePresence('num_att_taxes', 'create')
            ->notEmptyString('num_att_taxes');

        $validator
            ->date('date_debut')
            ->requirePresence('date_debut', 'create')
            ->notEmptyDate('date_debut');

        $validator
            ->date('date_fin')
            ->requirePresence('date_fin', 'create')
            ->notEmptyDate('date_fin');
            /* $validator
            ->date('document')
            ->requirePresence('document', 'create'); */
           // ->notEmptyString('document');

         $validator
        ->allowEmptyFile('document')
        ->add( 'document', [
        'mimeType' => [
            'rule' => [ 'mimeType', [ 'document/pdf', 'document/docx' ] ],
            'message' => 'Please upload only pdf and docx.',
        ],
        'fileSize' => [
            'rule' => [ 'fileSize', '<=', '10MB' ],
            'message' => 'Image file size must be less than 10MB.',
        ]]); 
    

        $validator
            ->integer('fournisseur_id')
            ->requirePresence('fournisseur_id', 'create')
            ->notEmptyString('fournisseur_id');

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
        $rules->add($rules->existsIn('typeexon_id', 'Typeexons'), ['errorField' => 'typeexon_id']);
        $rules->add($rules->existsIn('fournisseur_id', 'Fournisseurs'), ['errorField' => 'fournisseur_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fournisseurbanques Model
 *
 * @property \App\Model\Table\BanquesTable&\Cake\ORM\Association\BelongsTo $Banques
 * @property \App\Model\Table\FournisseursTable&\Cake\ORM\Association\BelongsTo $Fournisseurs
 *
 * @method \App\Model\Entity\Fournisseurbanque newEmptyEntity()
 * @method \App\Model\Entity\Fournisseurbanque newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Fournisseurbanque[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fournisseurbanque get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fournisseurbanque findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Fournisseurbanque patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fournisseurbanque[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fournisseurbanque|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fournisseurbanque saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fournisseurbanque[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fournisseurbanque[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fournisseurbanque[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fournisseurbanque[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FournisseurbanquesTable extends Table
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

        $this->setTable('fournisseurbanques');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Banques', [
            'foreignKey' => 'banque_id',
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
            ->integer('banque_id')
            ->allowEmptyString('banque_id');

        $validator
            ->scalar('agence')
            ->maxLength('agence', 255)
            ->requirePresence('agence', 'create')
            ->notEmptyString('agence');

        $validator
            ->scalar('code_banque')
            ->maxLength('code_banque', 255)
            ->requirePresence('code_banque', 'create')
            ->notEmptyString('code_banque');

        $validator
            ->scalar('swift')
            ->maxLength('swift', 255)
            ->allowEmptyString('swift');

        $validator
            ->scalar('compte')
            ->maxLength('compte', 255)
            ->requirePresence('compte', 'create')
            ->notEmptyString('compte');

        $validator
            ->scalar('rib')
            ->maxLength('rib', 255)
            ->requirePresence('rib', 'create')
            ->notEmptyString('rib');

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
        $rules->add($rules->existsIn('banque_id', 'Banques'), ['errorField' => 'banque_id']);
        $rules->add($rules->existsIn('fournisseur_id', 'Fournisseurs'), ['errorField' => 'fournisseur_id']);

        return $rules;
    }
}

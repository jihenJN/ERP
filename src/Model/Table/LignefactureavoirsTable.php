<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignefactureavoirs Model
 *
 * @property \App\Model\Table\FactureavoirsTable&\Cake\ORM\Association\BelongsTo $Factureavoirs
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\Lignefactureavoir newEmptyEntity()
 * @method \App\Model\Entity\Lignefactureavoir newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignefactureavoir[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignefactureavoir get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignefactureavoir findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignefactureavoir patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignefactureavoir[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignefactureavoir|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignefactureavoir saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignefactureavoir[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignefactureavoir[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignefactureavoir[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignefactureavoir[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignefactureavoirsTable extends Table
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

        $this->setTable('lignefactureavoirs');

        $this->belongsTo('Factureavoirs', [
            'foreignKey' => 'factureavoir_id',
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'categorie_id',
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
        // $validator
        //     ->requirePresence('id', 'create')
        //     ->notEmptyString('id');

        // $validator
        //     ->integer('factureavoir_id')
        //     ->allowEmptyString('factureavoir_id');

        // $validator
        //     ->integer('lignefactureclient_id')
        //     ->allowEmptyString('lignefactureclient_id');

        // $validator
        //     ->integer('depot_id')
        //     ->allowEmptyString('depot_id');

        // $validator
        //     ->integer('article_id')
        //     ->allowEmptyString('article_id');

        // $validator
        //     ->numeric('quantite')
        //     ->allowEmptyString('quantite');

        // $validator
        //     ->decimal('prix')
        //     ->allowEmptyString('prix');

        // $validator
        //     ->decimal('prixnet')
        //     ->allowEmptyString('prixnet');

        // $validator
        //     ->decimal('puttc')
        //     ->allowEmptyString('puttc');

        // $validator
        //     ->decimal('totalhtans')
        //     ->allowEmptyString('totalhtans');

        // $validator
        //     ->integer('remise')
        //     ->allowEmptyString('remise');

        // $validator
        //     ->integer('fodec')
        //     ->allowEmptyString('fodec');

        // $validator
        //     ->integer('tva_id')
        //     ->allowEmptyString('tva_id');

        // $validator
        //     ->decimal('totalht')
        //     ->allowEmptyString('totalht');

        // $validator
        //     ->decimal('totalttc')
        //     ->allowEmptyString('totalttc');

        // $validator
        //     ->decimal('pmp')
        //     ->allowEmptyString('pmp');

        // $validator
        //     ->integer('qte')
        //     ->allowEmptyString('qte');

        // $validator
        //     ->integer('valide')
        //     ->allowEmptyString('valide');

        // $validator
        //     ->integer('couleur_id')
        //     ->allowEmptyString('couleur_id');

        // $validator
        //     ->integer('dimension_id')
        //     ->allowEmptyString('dimension_id');

        // $validator
        //     ->integer('categorie_id')
        //     ->allowEmptyString('categorie_id');

        // $validator
        //     ->integer('famille_id')
        //     ->allowEmptyString('famille_id');

        // $validator
        //     ->integer('sousfamille1_id')
        //     ->allowEmptyString('sousfamille1_id');

        // $validator
        //     ->integer('sousfamille2_id')
        //     ->allowEmptyString('sousfamille2_id');

        // $validator
        //     ->integer('unite_id')
        //     ->allowEmptyString('unite_id');

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
        $rules->add($rules->existsIn('factureavoir_id', 'Factureavoirs'), ['errorField' => 'factureavoir_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);
        $rules->add($rules->existsIn('categorie_id', 'Categories'), ['errorField' => 'categorie_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articles Model
 *
 * @property \App\Model\Table\PointdeventesTable&\Cake\ORM\Association\BelongsTo $Pointdeventes
 * @property \App\Model\Table\FamillesTable&\Cake\ORM\Association\BelongsTo $Familles
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\Sousfamille1sTable&\Cake\ORM\Association\BelongsTo $Sousfamille1s
 * @property \App\Model\Table\Sousfamille2sTable&\Cake\ORM\Association\BelongsTo $Sousfamille2s
 * @property \App\Model\Table\Sousfamille3sTable&\Cake\ORM\Association\BelongsTo $Sousfamille3s
 * @property \App\Model\Table\UnitesTable&\Cake\ORM\Association\BelongsTo $Unites
 * @property \App\Model\Table\ArticlefournisseursTable&\Cake\ORM\Association\HasMany $Articlefournisseurs
 * @property \App\Model\Table\ArticleunitesTable&\Cake\ORM\Association\HasMany $Articleunites
 * @property \App\Model\Table\BandeconsultationsTable&\Cake\ORM\Association\HasMany $Bandeconsultations
 * @property \App\Model\Table\FourchettesTable&\Cake\ORM\Association\HasMany $Fourchettes
 * @property \App\Model\Table\LignebandeconsultationsTable&\Cake\ORM\Association\HasMany $Lignebandeconsultations
 * @property \App\Model\Table\LignebonchargementsTable&\Cake\ORM\Association\HasMany $Lignebonchargements
 * @property \App\Model\Table\LignebondereservationsTable&\Cake\ORM\Association\HasMany $Lignebondereservations
 * @property \App\Model\Table\LignebondetransfertsTable&\Cake\ORM\Association\HasMany $Lignebondetransferts
 * @property \App\Model\Table\LignebonlivraisonsTable&\Cake\ORM\Association\HasMany $Lignebonlivraisons
 * @property \App\Model\Table\LignebonreceptionstocksTable&\Cake\ORM\Association\HasMany $Lignebonreceptionstocks
 * @property \App\Model\Table\LignebonsortiestocksTable&\Cake\ORM\Association\HasMany $Lignebonsortiestocks
 * @property \App\Model\Table\LignecommandeclientsTable&\Cake\ORM\Association\HasMany $Lignecommandeclients
 * @property \App\Model\Table\LignecommandesTable&\Cake\ORM\Association\HasMany $Lignecommandes
 * @property \App\Model\Table\LignedemandeoffredeprixesTable&\Cake\ORM\Association\HasMany $Lignedemandeoffredeprixes
 * @property \App\Model\Table\LignefactureclientsTable&\Cake\ORM\Association\HasMany $Lignefactureclients
 * @property \App\Model\Table\LignefacturesTable&\Cake\ORM\Association\HasMany $Lignefactures
 * @property \App\Model\Table\LigneinventairesTable&\Cake\ORM\Association\HasMany $Ligneinventaires
 * @property \App\Model\Table\LignelivraisonsTable&\Cake\ORM\Association\HasMany $Lignelivraisons
 *
 * @method \App\Model\Entity\Article newEmptyEntity()
 * @method \App\Model\Entity\Article newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Article[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Article get($primaryKey, $options = [])
 * @method \App\Model\Entity\Article findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Article[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Article|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ArticlesTable extends Table
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

        $this->setTable('articles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Pointdeventes', [
            'foreignKey' => 'pointdevente_id',
        ]);
        $this->belongsTo('Familles', [
            'foreignKey' => 'famille_id',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'categorie_id',
        ]);
        $this->belongsTo('Sousfamille1s', [
            'foreignKey' => 'sousfamille1_id',
        ]);
        $this->belongsTo('Sousfamille2s', [
            'foreignKey' => 'sousfamille2_id',
        ]);
        $this->belongsTo('Sousfamille3s', [
            'foreignKey' => 'sousfamille3_id',
        ]);
        $this->belongsTo('Unites', [
            'foreignKey' => 'unite_id',
        ]);
        $this->hasMany('Articlefournisseurs', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Articleunites', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Bandeconsultations', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Fourchettes', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignebandeconsultations', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignebonchargements', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignebondereservations', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignebondetransferts', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignebonlivraisons', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignebonreceptionstocks', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignebonsortiestocks', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignecommandeclients', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignecommandes', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignedemandeoffredeprixes', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignefactureclients', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignefactures', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Ligneinventaires', [
            'foreignKey' => 'article_id',
        ]);
        $this->hasMany('Lignelivraisons', [
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
            ->integer('pointdevente_id')
            ->allowEmptyString('pointdevente_id');

        $validator
            ->integer('famille_id')
            ->allowEmptyString('famille_id');

        $validator
            ->integer('categorie_id')
            ->allowEmptyString('categorie_id');

        $validator
            ->integer('sousfamille1_id')
            ->allowEmptyString('sousfamille1_id');

        $validator
            ->integer('sousfamille2_id')
            ->allowEmptyString('sousfamille2_id');

        $validator
            ->integer('sousfamille3_id')
            ->allowEmptyString('sousfamille3_id');

        $validator
            ->scalar('codefrs')
            ->maxLength('codefrs', 255)
            ->allowEmptyString('codefrs');

        $validator
            ->scalar('reference')
            ->maxLength('reference', 255)
            ->allowEmptyString('reference');

        $validator
            ->scalar('designiation')
            ->maxLength('designiation', 255)
            ->allowEmptyString('designiation');

        $validator
            ->integer('dimension')
            ->allowEmptyString('dimension');

        $validator
            ->scalar('etat')
            ->maxLength('etat', 255)
            ->allowEmptyString('etat');

        $validator
            ->integer('unite_id')
            ->allowEmptyString('unite_id');

        $validator
            ->scalar('codeabarre')
            ->maxLength('codeabarre', 255)
            ->allowEmptyString('codeabarre');

        $validator
            ->numeric('durevie')
            ->notEmptyString('durevie');

        $validator
            ->decimal('puht')
            ->allowEmptyString('puht');

        $validator
            ->numeric('fodec')
            ->allowEmptyString('fodec');

        $validator
            ->numeric('tva')
            ->allowEmptyString('tva');

        $validator
            ->decimal('ttc')
            ->allowEmptyString('ttc');

        $validator
            ->decimal('prixachat')
            ->allowEmptyString('prixachat');

        $validator
            ->decimal('prixafodec')
            ->allowEmptyString('prixafodec');

        $validator
            ->scalar('commantaire')
            ->maxLength('commantaire', 255)
            ->allowEmptyString('commantaire');

        $validator
            ->integer('poste')
            ->allowEmptyString('poste');

        $validator
            ->decimal('colisage')
            ->allowEmptyString('colisage');

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
        $rules->add($rules->existsIn('pointdevente_id', 'Pointdeventes'), ['errorField' => 'pointdevente_id']);
        $rules->add($rules->existsIn('famille_id', 'Familles'), ['errorField' => 'famille_id']);
        $rules->add($rules->existsIn('categorie_id', 'Categories'), ['errorField' => 'categorie_id']);
        $rules->add($rules->existsIn('sousfamille1_id', 'Sousfamille1s'), ['errorField' => 'sousfamille1_id']);
        $rules->add($rules->existsIn('sousfamille2_id', 'Sousfamille2s'), ['errorField' => 'sousfamille2_id']);
        $rules->add($rules->existsIn('sousfamille3_id', 'Sousfamille3s'), ['errorField' => 'sousfamille3_id']);
        $rules->add($rules->existsIn('unite_id', 'Unites'), ['errorField' => 'unite_id']);

        return $rules;
    }
}

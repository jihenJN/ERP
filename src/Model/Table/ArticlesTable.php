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
 * @property \App\Model\Table\FamillesTable&\Cake\ORM\Association\BelongsTo $Familles
 * @property \App\Model\Table\Sousfamille1sTable&\Cake\ORM\Association\BelongsTo $Sousfamille1s
 * @property \App\Model\Table\TvasTable&\Cake\ORM\Association\BelongsTo $Tvas
 * @property \App\Model\Table\TypearticlesTable&\Cake\ORM\Association\BelongsTo $Typearticles
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
class ArticlesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('articles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Familles', [
            'foreignKey' => 'famille_id',
        ]);
        $this->belongsTo('Sousfamille1s', [
            'foreignKey' => 'sousfamille1_id',
        ]);
        $this->belongsTo('Marques', [
            'foreignKey' => 'marque_id',
        ]);
        $this->belongsTo('Tvas', [
            'foreignKey' => 'tva_id',
        ]);
        $this->belongsTo('Unites', [
            'foreignKey' => 'unite_id',
        ]);

        $this->belongsTo('Typearticles', [
            'foreignKey' => 'typearticle_id',
        ]);
        $this->hasMany('ArticleClient', [
            'foreignKey' => 'article_id',
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
        $this->hasMany('Certificats', [
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
        $this->hasMany('Lignebonderetoures', [
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
        $this->hasMany('Lignecommandefournisseurs', [
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
    public function validationDefault(Validator $validator): Validator {

 $validator
        ->allowEmptyFile('image_file')
        ->add( 'image_file', [
        'mimeType' => [
            'rule' => [ 'mimeType', [ 'image/jpg', 'image/png', 'image/jpeg' ] ],
            'message' => 'Please upload only jpg and png.',
        ],
        'fileSize' => [
            'rule' => [ 'fileSize', '<=', '1MB' ],
            'message' => 'Image file size must be less than 1MB.',
        ]]);

        return $validator;
       
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker {

        return $rules;
    }

    public $virtualFields = array(
        'nom' => 'CONCAT(Articles.Dsignation, " ", Articles.Code)');

}

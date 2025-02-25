<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Familles Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\HasMany $Articles
 * @property \App\Model\Table\ArticlesoldTable&\Cake\ORM\Association\HasMany $Articlesold
 * @property \App\Model\Table\Sousfamille1sTable&\Cake\ORM\Association\HasMany $Sousfamille1s
 * @property \App\Model\Table\Sousfamille1soldTable&\Cake\ORM\Association\HasMany $Sousfamille1sold
 *
 * @method \App\Model\Entity\Famille newEmptyEntity()
 * @method \App\Model\Entity\Famille newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Famille[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Famille get($primaryKey, $options = [])
 * @method \App\Model\Entity\Famille findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Famille patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Famille[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Famille|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Famille saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Famille[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Famille[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Famille[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Famille[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FamillesTable extends Table
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

        $this->setTable('familles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Articles', [
            'foreignKey' => 'famille_id',
        ]);
        $this->hasMany('Articlesold', [
            'foreignKey' => 'famille_id',
        ]);
        $this->hasMany('Sousfamille1s', [
            'foreignKey' => 'famille_id',
        ]);
        $this->belongsTo('Marques', [
            'foreignKey' => 'marque_id',
        ]);
        $this->hasMany('Sousfamille1sold', [
            'foreignKey' => 'famille_id',
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
        //     ->scalar('Nom')
        //     ->maxLength('Nom', 100)
        //     ->allowEmptyString('Nom');

        // $validator
        //     ->integer('etat')
        //     ->allowEmptyString('etat');
        //     $validator
        //     ->integer('vente')
        //     ->allowEmptyString('etat');

        return $validator;
    }
}

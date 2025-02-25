<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Liens Model
 *
 * @property \App\Model\Table\UtilisateurmenusTable&\Cake\ORM\Association\BelongsTo $Utilisateurmenus
 *
 * @method \App\Model\Entity\Lien newEmptyEntity()
 * @method \App\Model\Entity\Lien newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lien[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lien get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lien findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lien patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lien[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lien|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lien saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lien[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lien[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lien[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lien[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LiensTable extends Table
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

        $this->setTable('liens');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Utilisateurmenus', [
            'foreignKey' => 'utilisateurmenu_id',
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
            ->integer('utilisateurmenu_id')
            ->allowEmptyString('utilisateurmenu_id');

        $validator
            ->scalar('lien')
            ->maxLength('lien', 255)
            ->allowEmptyString('lien');

        $validator
            ->scalar('ajout')
            ->maxLength('ajout', 255)
            ->allowEmptyString('ajout');

        $validator
            ->scalar('modif')
            ->maxLength('modif', 255)
            ->allowEmptyString('modif');

        $validator
            ->scalar('supp')
            ->maxLength('supp', 255)
            ->allowEmptyString('supp');

        $validator
            ->scalar('imprimer')
            ->maxLength('imprimer', 255)
            ->allowEmptyString('imprimer');

        $validator
            ->integer('valide')
            ->allowEmptyString('valide');

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
        $rules->add($rules->existsIn('utilisateurmenu_id', 'Utilisateurmenus'), ['errorField' => 'utilisateurmenu_id']);

        return $rules;
    }
}

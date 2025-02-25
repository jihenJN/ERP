<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ligneprojetfournisseurs Model
 *
 * @property \App\Model\Table\FournisseursTable&\Cake\ORM\Association\BelongsTo $Fournisseurs
 * @property \App\Model\Table\ProjetsTable&\Cake\ORM\Association\BelongsTo $Projets
 *
 * @method \App\Model\Entity\Ligneprojetfournisseur newEmptyEntity()
 * @method \App\Model\Entity\Ligneprojetfournisseur newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneprojetfournisseur[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneprojetfournisseur get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ligneprojetfournisseur findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ligneprojetfournisseur patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneprojetfournisseur[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneprojetfournisseur|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneprojetfournisseur saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneprojetfournisseur[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneprojetfournisseur[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneprojetfournisseur[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneprojetfournisseur[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LigneprojetfournisseursTable extends Table
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

        $this->setTable('ligneprojetfournisseurs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'fournisseur_id',
        ]);
        $this->belongsTo('Projets', [
            'foreignKey' => 'projet_id',
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
            ->integer('fournisseur_id')
            ->allowEmptyString('fournisseur_id');

        $validator
            ->integer('projet_id')
            ->allowEmptyString('projet_id');

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
        $rules->add($rules->existsIn('fournisseur_id', 'Fournisseurs'), ['errorField' => 'fournisseur_id']);
        $rules->add($rules->existsIn('projet_id', 'Projets'), ['errorField' => 'projet_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignedemandeclients Model
 *
 * @property \App\Model\Table\DemandeclientsTable&\Cake\ORM\Association\BelongsTo $Demandeclients
 * @property \App\Model\Table\FamillesTable&\Cake\ORM\Association\BelongsTo $Familles
 * @property \App\Model\Table\Sousfamille1sTable&\Cake\ORM\Association\BelongsTo $Sousfamille1s
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\UnitesTable&\Cake\ORM\Association\BelongsTo $Unites
 *
 * @method \App\Model\Entity\Lignedemandeclient newEmptyEntity()
 * @method \App\Model\Entity\Lignedemandeclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignedemandeclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignedemandeclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignedemandeclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignedemandeclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignedemandeclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignedemandeclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignedemandeclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignedemandeclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignedemandeclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignedemandeclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignedemandeclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignedemandeclientsTable extends Table
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

        $this->setTable('lignedemandeclients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Demandeclients', [
            'foreignKey' => 'demandeclient_id',
        ]);
        $this->belongsTo('Familles', [
            'foreignKey' => 'famille_id',
        ]);
        $this->belongsTo('Sousfamille1s', [
            'foreignKey' => 'sousfamille1_id',
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
        ]);
        $this->belongsTo('Unites', [
            'foreignKey' => 'unite_id',
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
        $rules->add($rules->existsIn('demandeclient_id', 'Demandeclients'), ['errorField' => 'demandeclient_id']);
        $rules->add($rules->existsIn('famille_id', 'Familles'), ['errorField' => 'famille_id']);
        $rules->add($rules->existsIn('sousfamille1_id', 'Sousfamille1s'), ['errorField' => 'sousfamille1_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);
        $rules->add($rules->existsIn('unite_id', 'Unites'), ['errorField' => 'unite_id']);

        return $rules;
    }
}

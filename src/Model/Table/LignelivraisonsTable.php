<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignelivraisons Model
 *
 * @property \App\Model\Table\LivraisonsTable&\Cake\ORM\Association\BelongsTo $Livraisons
 * @property \App\Model\Table\CommandesTable&\Cake\ORM\Association\BelongsTo $Commandes
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 *
 * @method \App\Model\Entity\Lignelivraison newEmptyEntity()
 * @method \App\Model\Entity\Lignelivraison newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignelivraison[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignelivraison get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignelivraison findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignelivraison patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignelivraison[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignelivraison|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignelivraison saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignelivraison[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignelivraison[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignelivraison[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignelivraison[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignelivraisonsTable extends Table
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

        $this->setTable('lignelivraisons');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Livraisons', [
            'foreignKey' => 'livraison_id',
        ]);
        $this->belongsTo('Commandes', [
            'foreignKey' => 'commande_id',
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
        $rules->add($rules->existsIn('livraison_id', 'Livraisons'), ['errorField' => 'livraison_id']);
        $rules->add($rules->existsIn('commande_id', 'Commandes'), ['errorField' => 'commande_id']);
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}

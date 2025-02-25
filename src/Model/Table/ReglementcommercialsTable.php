<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reglementcommercials Model
 *
 * @property \App\Model\Table\CommercialsTable&\Cake\ORM\Association\BelongsTo $Commercials
 * @property \App\Model\Table\PaiementsTable&\Cake\ORM\Association\BelongsTo $Paiements
 * @property \App\Model\Table\LignereglementcommercialsTable&\Cake\ORM\Association\HasMany $Lignereglementcommercials
 * @property \App\Model\Table\LignereglementcommercialssTable&\Cake\ORM\Association\HasMany $Lignereglementcommercialss
 *
 * @method \App\Model\Entity\Reglementcommercial newEmptyEntity()
 * @method \App\Model\Entity\Reglementcommercial newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Reglementcommercial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reglementcommercial get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reglementcommercial findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Reglementcommercial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reglementcommercial[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reglementcommercial|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reglementcommercial saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reglementcommercial[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reglementcommercial[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reglementcommercial[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reglementcommercial[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ReglementcommercialsTable extends Table
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

        $this->setTable('reglementcommercials');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Commercials', [
            'foreignKey' => 'commercial_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Paiements', [
            'foreignKey' => 'paiement_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Banques', [
            'foreignKey' => 'banque_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Lignereglementcommercials', [
            'foreignKey' => 'reglementcommercial_id',
        ]);
        $this->hasMany('Lignereglementcommercialss', [
            'foreignKey' => 'reglementcommercial_id',
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
        $rules->add($rules->existsIn('commercial_id', 'Commercials'), ['errorField' => 'commercial_id']);
        $rules->add($rules->existsIn('paiement_id', 'Paiements'), ['errorField' => 'paiement_id']);
        $rules->add($rules->existsIn('banque_id', 'Banques'), ['errorField' => 'banque_id']);

        return $rules;
    }
}

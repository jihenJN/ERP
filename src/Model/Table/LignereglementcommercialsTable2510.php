<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignereglementcommercials Model
 *
 * @property \App\Model\Table\LivraisonsTable&\Cake\ORM\Association\BelongsTo $Livraisons
 * @property \App\Model\Table\ReglementcommercialsTable&\Cake\ORM\Association\BelongsTo $Reglementcommercials
 *
 * @method \App\Model\Entity\Lignereglementcommercial newEmptyEntity()
 * @method \App\Model\Entity\Lignereglementcommercial newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglementcommercial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglementcommercial get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignereglementcommercial findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignereglementcommercial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglementcommercial[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignereglementcommercial|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignereglementcommercial saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignereglementcommercial[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignereglementcommercial[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignereglementcommercial[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignereglementcommercial[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignereglementcommercialsTable extends Table
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

        $this->setTable('lignereglementcommercials');

        $this->belongsTo('Lignebonlivraisons', [
            'foreignKey' => 'lignebonlivraison_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Reglementcommercials', [
            'foreignKey' => 'reglementcommercial_id',
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
       $rules->add($rules->existsIn('lignebonlivraison_id', 'Lignebonlivraisons'), ['errorField' => 'lignebonlivraison_id']);
        $rules->add($rules->existsIn('reglementcommercial_id', 'Reglementcommercials'), ['errorField' => 'reglementcommercial_id']);

        return $rules;
    }
}

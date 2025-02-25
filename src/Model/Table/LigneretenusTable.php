<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ligneretenus Model
 *
 * @property \App\Model\Table\RetenusTable&\Cake\ORM\Association\BelongsTo $Retenus
 * @property \App\Model\Table\FactureclientsTable&\Cake\ORM\Association\BelongsTo $Factureclients
 * @property \App\Model\Table\TosTable&\Cake\ORM\Association\BelongsTo $Tos
 *
 * @method \App\Model\Entity\Ligneretenus newEmptyEntity()
 * @method \App\Model\Entity\Ligneretenus newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneretenus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ligneretenus get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ligneretenus findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ligneretenus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneretenus[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ligneretenus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneretenus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ligneretenus[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneretenus[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneretenus[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ligneretenus[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LigneretenusTable extends Table
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

        $this->setTable('ligneretenus');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Retenus', [
            'foreignKey' => 'retenu_id',
        ]);
        $this->belongsTo('Factureclients', [
            'foreignKey' => 'factureclient_id',
        ]);
        $this->belongsTo('Tos', [
            'foreignKey' => 'to_id',
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
        $rules->add($rules->existsIn('retenu_id', 'Retenus'), ['errorField' => 'retenu_id']);
        $rules->add($rules->existsIn('factureclient_id', 'Factureclients'), ['errorField' => 'factureclient_id']);
        $rules->add($rules->existsIn('to_id', 'Tos'), ['errorField' => 'to_id']);

        return $rules;
    }
}

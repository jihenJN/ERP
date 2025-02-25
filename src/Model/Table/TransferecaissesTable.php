<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Transferecaisses Model
 *
 * @property \App\Model\Table\CaissesTable&\Cake\ORM\Association\BelongsTo $Caisses
 *
 * @method \App\Model\Entity\Transferecaiss newEmptyEntity()
 * @method \App\Model\Entity\Transferecaiss newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Transferecaiss[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Transferecaiss get($primaryKey, $options = [])
 * @method \App\Model\Entity\Transferecaiss findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Transferecaiss patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Transferecaiss[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Transferecaiss|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transferecaiss saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transferecaiss[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Transferecaiss[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Transferecaiss[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Transferecaiss[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TransferecaissesTable extends Table
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

        $this->setTable('transferecaisses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Caisses', [
            'foreignKey' => 'caisse_id',
        ]);
        $this->belongsTo('Commandefournisseurs', [
            'foreignKey' => 'commandefournisseur_id',
        ]);
        $this->belongsTo('Livraisons', [
            'foreignKey' => 'livraison_id',
        ]);
        $this->belongsTo('Comptes', [
            'foreignKey' => 'compte_id',
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
        $rules->add($rules->existsIn('caisse_id', 'Caisses'), ['errorField' => 'caisse_id']);

        return $rules;
    }
}

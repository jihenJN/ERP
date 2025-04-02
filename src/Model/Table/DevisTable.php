<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Devis Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\Devi newEmptyEntity()
 * @method \App\Model\Entity\Devi newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Devi[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Devi get($primaryKey, $options = [])
 * @method \App\Model\Entity\Devi findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Devi patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Devi[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Devi|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Devi saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Devi[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Devi[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Devi[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Devi[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DevisTable extends Table
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

        $this->setTable('devis');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
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
        $validator
            ->scalar('numero')
            ->maxLength('numero', 255)
            ->requirePresence('numero', 'create')
            ->notEmptyString('numero')
            ->add('numero', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->dateTime('date')
            ->notEmptyDateTime('date');

        $validator
            ->integer('client_id')
            ->notEmptyString('client_id');

        $validator
            ->numeric('total_remise')
            ->notEmptyString('total_remise');

        $validator
            ->numeric('total_ht')
            ->notEmptyString('total_ht');

        $validator
            ->numeric('total_brute')
            ->requirePresence('total_brute', 'create')
            ->notEmptyString('total_brute');

        $validator
            ->numeric('total_tva')
            ->requirePresence('total_tva', 'create')
            ->notEmptyString('total_tva');

        $validator
            ->numeric('total_ttc')
            ->requirePresence('total_ttc', 'create')
            ->notEmptyString('total_ttc');

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
        $rules->add($rules->isUnique(['numero']), ['errorField' => 'numero']);
        $rules->add($rules->existsIn('client_id', 'Clients'), ['errorField' => 'client_id']);

        return $rules;
    }

    public function getNextNumero()
    {
        $num = $this->find()
            ->select(["num" => 'MAX(Devis.numero)'])
            ->first();

        $n = $num->num ?? 0; // Handle null case
        $in = intval($n) + 1;
        return str_pad("$in", 5, "0", STR_PAD_LEFT);
    }
}

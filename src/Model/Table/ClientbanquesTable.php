<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientbanques Model
 *
 * @property \App\Model\Table\BanquesTable&\Cake\ORM\Association\BelongsTo $Banques
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\Clientbanque newEmptyEntity()
 * @method \App\Model\Entity\Clientbanque newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Clientbanque[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clientbanque get($primaryKey, $options = [])
 * @method \App\Model\Entity\Clientbanque findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Clientbanque patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Clientbanque[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clientbanque|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientbanque saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientbanque[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientbanque[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientbanque[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientbanque[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClientbanquesTable extends Table
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

        $this->setTable('clientbanques');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Banques', [
            'foreignKey' => 'banque_id',
        ]);
        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
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
            ->integer('banque_id')
            ->allowEmptyString('banque_id');

        $validator
            ->scalar('agence')
            ->maxLength('agence', 255)
            ->allowEmptyString('agence');

        $validator
            ->scalar('code_banque')
            ->maxLength('code_banque', 255)
            ->allowEmptyString('code_banque');

        $validator
            ->scalar('swift')
            ->maxLength('swift', 255)
            ->allowEmptyString('swift');

        $validator
            ->scalar('compte')
            ->maxLength('compte', 255)
            ->allowEmptyString('compte');

        $validator
            ->scalar('rib')
            ->maxLength('rib', 255)
            ->allowEmptyString('rib');

        $validator
            ->scalar('document')
            ->maxLength('document', 255)
            ->allowEmptyString('document');

        $validator
            ->integer('client_id')
            ->allowEmptyString('client_id');

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
        $rules->add($rules->existsIn('banque_id', 'Banques'), ['errorField' => 'banque_id']);
        $rules->add($rules->existsIn('client_id', 'Clients'), ['errorField' => 'client_id']);

        return $rules;
    }
}

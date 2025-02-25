<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Visites Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\DemandeclientsTable&\Cake\ORM\Association\BelongsTo $Demandeclients
 *
 * @method \App\Model\Entity\Visite newEmptyEntity()
 * @method \App\Model\Entity\Visite newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Visite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Visite get($primaryKey, $options = [])
 * @method \App\Model\Entity\Visite findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Visite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Visite[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Visite|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Visite saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class VisitesTable extends Table
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

        $this->setTable('visites');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
        ]);
        $this->belongsTo('Demandeclients', [
            'foreignKey' => 'demandeclient_id',
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
        // $validator
        //     ->integer('client_id')
        //     ->allowEmptyString('client_id');

        // $validator
        //     ->integer('demandeclient_id')
        //     ->allowEmptyString('demandeclient_id');

        // $validator
        //     ->dateTime('datecontact')
        //     ->allowEmptyDateTime('datecontact');

        // $validator
        //     ->dateTime('dateplanifie')
        //     ->allowEmptyDateTime('dateplanifie');

        // $validator
        //     ->scalar('trdemande')
        //     ->maxLength('trdemande', 255)
        //     ->allowEmptyString('trdemande');

        // $validator
        //     ->scalar('description')
        //     ->maxLength('description', 255)
        //     ->allowEmptyString('description');

        // $validator
        //     ->scalar('piece')
        //     ->maxLength('piece', 255)
        //     ->allowEmptyString('piece');

        // $validator
        //     ->scalar('schema')
        //     ->maxLength('schema', 255)
        //     ->allowEmptyString('schema');

        // $validator
        //     ->dateTime('datecptrendu')
        //     ->allowEmptyDateTime('datecptrendu');

        // $validator
        //     ->scalar('visiteur')
        //     ->maxLength('visiteur', 255)
        //     ->allowEmptyString('visiteur');

        // $validator
        //     ->scalar('responsable')
        //     ->maxLength('responsable', 255)
        //     ->allowEmptyString('responsable');

        // $validator
        //     ->integer('tel')
        //     ->allowEmptyString('tel');

        // $validator
        //     ->scalar('adresse')
        //     ->maxLength('adresse', 255)
        //     ->allowEmptyString('adresse');
        // $validator
        // ->allowEmptyFile('piece')
        // ->add('piece', [
        //     'mimeType' => [
        //         'rule' => ['mimeType', ['image/jpg', 'image/png', 'image/jpeg', 'application/pdf']],
        //         'message' => 'Please upload only jpg, png, or pdf.',
        //     ],
        //     'fileSize' => [
        //         'rule' => ['fileSize', '<=', '4MB'],
        //         'message' => 'Image file size must be less than 4MB.',
        //     ]
        // ]);
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
        $rules->add($rules->existsIn('client_id', 'Clients'), ['errorField' => 'client_id']);
        $rules->add($rules->existsIn('demandeclient_id', 'Demandeclients'), ['errorField' => 'demandeclient_id']);

        return $rules;
    }
}

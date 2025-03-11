<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientdocuments Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\Clientdocument newEmptyEntity()
 * @method \App\Model\Entity\Clientdocument newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Clientdocument[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clientdocument get($primaryKey, $options = [])
 * @method \App\Model\Entity\Clientdocument findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Clientdocument patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Clientdocument[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clientdocument|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientdocument saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientdocument[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientdocument[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientdocument[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientdocument[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClientdocumentsTable extends Table
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

        $this->setTable('clientdocuments');
        $this->setDisplayField('name');

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
       
        // $validator
        //     ->integer('client_id')
        //     ->allowEmptyString('client_id');

        // $validator
        //     ->scalar('name')
        //     ->maxLength('name', 255)
        //     ->allowEmptyString('name');
        $validator
            ->allowEmptyFile('fichier')
            ->add('fichier', [
                'mimeType' => [
                    'rule' => ['mimeType', ['logo/jpg', 'logo/png', 'logo/jpeg','logo/pdf']],
                    'message' => 'Please upload only jpg ,png and pdf.',
                ],
                'fileSize' => [
                    'rule' => ['fileSize', '<=', '4MB'],
                    'message' => 'Image file size must be less than 4MB.',
                ]
            ]);

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

        return $rules;
    }
}

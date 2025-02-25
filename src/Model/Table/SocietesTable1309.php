<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Societes Model
 *
 * @method \App\Model\Entity\Societe newEmptyEntity()
 * @method \App\Model\Entity\Societe newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Societe[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Societe get($primaryKey, $options = [])
 * @method \App\Model\Entity\Societe findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Societe patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Societe[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Societe|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Societe saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Societe[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Societe[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Societe[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Societe[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SocietesTable extends Table
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

        $this->setTable('societes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->allowEmptyFile('logo')
            ->add('logo', [
                'mimeType' => [
                    'rule' => ['mimeType', ['logo/jpg', 'logo/png', 'logo/jpeg']],
                    'message' => 'Please upload only jpg and png.',
                ],
                'fileSize' => [
                    'rule' => ['fileSize', '<=', '4MB'],
                    'message' => 'Image file size must be less than 1MB.',
                ]
            ]);
        $validator
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->allowEmptyString('nom');

        $validator
            ->scalar('capital')
            ->maxLength('capital', 255)
            ->allowEmptyString('capital');

        $validator
            ->scalar('adresse')
            ->maxLength('adresse', 255)
            ->allowEmptyString('adresse');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 255)
            ->allowEmptyString('tel');

        $validator
            ->scalar('mail')
            ->maxLength('mail', 255)
            ->allowEmptyString('mail');

        $validator
            ->scalar('site')
            ->maxLength('site', 255)
            ->allowEmptyString('site');

        $validator
            ->scalar('rc')
            ->maxLength('rc', 255)
            ->allowEmptyString('rc');

        $validator
            ->scalar('codetva')
            ->maxLength('codetva', 255)
            ->allowEmptyString('codetva');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 255)
            ->allowEmptyString('fax');

        $validator
            ->scalar('rib')
            ->maxLength('rib', 255)
            ->allowEmptyString('rib');

        $validator
            ->scalar('logo')
            ->maxLength('logo', 255)
            ->allowEmptyString('logo');

        $validator
            ->scalar('codepostale')
            ->maxLength('codepostale', 255)
            ->allowEmptyString('codepostale');

        return $validator;
    }
}

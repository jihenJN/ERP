<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Visiteurs Model
 *
 * @method \App\Model\Entity\Visiteur newEmptyEntity()
 * @method \App\Model\Entity\Visiteur newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Visiteur[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Visiteur get($primaryKey, $options = [])
 * @method \App\Model\Entity\Visiteur findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Visiteur patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Visiteur[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Visiteur|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Visiteur saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Visiteur[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Visiteur[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Visiteur[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Visiteur[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class VisiteursTable extends Table
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

        $this->setTable('visiteurs');
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
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->requirePresence('nom', 'create')
            ->notEmptyString('nom');

        $validator
            ->scalar('telephone')
            ->maxLength('telephone', 255)
            ->requirePresence('telephone', 'create')
            ->notEmptyString('telephone');

        return $validator;
    }
}

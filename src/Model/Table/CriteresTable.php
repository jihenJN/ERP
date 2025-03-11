<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Criteres Model
 *
 * @property \App\Model\Table\LignecriteresTable&\Cake\ORM\Association\HasMany $Lignecriteres
 *
 * @method \App\Model\Entity\Critere newEmptyEntity()
 * @method \App\Model\Entity\Critere newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Critere[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Critere get($primaryKey, $options = [])
 * @method \App\Model\Entity\Critere findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Critere patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Critere[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Critere|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Critere saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Critere[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Critere[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Critere[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Critere[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CriteresTable extends Table
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

        $this->setTable('criteres');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Lignecriteres', [
            'foreignKey' => 'critere_id',
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
}

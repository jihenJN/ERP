<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Gspromoarticles Model
 *
 * @property \App\Model\Table\ClientgspromoarticlesTable&\Cake\ORM\Association\HasMany $Clientgspromoarticles
 * @property \App\Model\Table\LignegspromoarticlesTable&\Cake\ORM\Association\HasMany $Lignegspromoarticles
 *
 * @method \App\Model\Entity\Gspromoarticle newEmptyEntity()
 * @method \App\Model\Entity\Gspromoarticle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Gspromoarticle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Gspromoarticle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Gspromoarticle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Gspromoarticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Gspromoarticle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Gspromoarticle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gspromoarticle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gspromoarticle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Gspromoarticle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Gspromoarticle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Gspromoarticle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class GspromoarticlesTable extends Table
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

        $this->setTable('gspromoarticles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Clientgspromoarticles', [
            'foreignKey' => 'gspromoarticle_id',
        ]);
        $this->hasMany('Lignegspromoarticles', [
            'foreignKey' => 'gspromoarticle_id',
        ]);
        // $this->hasMany('Typeclients', [
        //     'foreignKey' => 'typeclient_id',
        // ]);
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
            ->date('datedebut')
            ->requirePresence('datedebut', 'create')
            ->notEmptyDate('datedebut');

        $validator
            ->date('datefin')
            ->requirePresence('datefin', 'create')
            ->notEmptyDate('datefin');

        return $validator;
    }
}

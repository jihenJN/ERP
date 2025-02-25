<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pdfs Model
 *
 * @method \App\Model\Entity\Pdf newEmptyEntity()
 * @method \App\Model\Entity\Pdf newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Pdf[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pdf get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pdf findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Pdf patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pdf[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pdf|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pdf saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pdf[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pdf[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pdf[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pdf[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PdfsTable extends Table
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

        $this->setTable('pdfs');
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
            ->scalar('fichier')
            ->maxLength('fichier', 255)
            ->requirePresence('fichier', 'create')
            ->notEmptyString('fichier');

        $validator
            ->integer('projet_id')
            ->requirePresence('projet_id', 'create')
            ->notEmptyString('projet_id');

        return $validator;
    }
}

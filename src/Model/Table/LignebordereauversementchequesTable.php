<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lignebordereauversementcheques Model
 *
 * @method \App\Model\Entity\Lignebordereauversementcheque newEmptyEntity()
 * @method \App\Model\Entity\Lignebordereauversementcheque newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebordereauversementcheque[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lignebordereauversementcheque get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lignebordereauversementcheque findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lignebordereauversementcheque patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebordereauversementcheque[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lignebordereauversementcheque|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebordereauversementcheque saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lignebordereauversementcheque[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebordereauversementcheque[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebordereauversementcheque[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lignebordereauversementcheque[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LignebordereauversementchequesTable extends Table
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

        $this->setTable('lignebordereauversementcheques');
        $this->setDisplayField('name');
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
        
        return $validator;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Unites Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\HasMany $Articles
 * @property \App\Model\Table\ArticleunitesTable&\Cake\ORM\Association\HasMany $Articleunites
 *
 * @method \App\Model\Entity\Unite newEmptyEntity()
 * @method \App\Model\Entity\Unite newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Unite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Unite get($primaryKey, $options = [])
 * @method \App\Model\Entity\Unite findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Unite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Unite[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Unite|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Unite saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Unite[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Unite[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Unite[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Unite[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MethodeexpeditionsTable extends Table
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

        $this->setTable('methodeexpeditions');
        $this->setDisplayField('methode');
        $this->setPrimaryKey('id');

        
    }

   
}

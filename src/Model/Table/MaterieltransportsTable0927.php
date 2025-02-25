<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Materieltransports Model
 *
 * @property \App\Model\Table\BondetransfertsTable&\Cake\ORM\Association\HasMany $Bondetransferts
 * @property \App\Model\Table\BonlivraisonsTable&\Cake\ORM\Association\HasMany $Bonlivraisons
 * @property \App\Model\Table\BonreceptionstocksTable&\Cake\ORM\Association\HasMany $Bonreceptionstocks
 * @property \App\Model\Table\BonsortiestocksTable&\Cake\ORM\Association\HasMany $Bonsortiestocks
 * @property \App\Model\Table\CommandeclientsTable&\Cake\ORM\Association\HasMany $Commandeclients
 * @property \App\Model\Table\CommandesTable&\Cake\ORM\Association\HasMany $Commandes
 * @property \App\Model\Table\FactureclientsTable&\Cake\ORM\Association\HasMany $Factureclients
 * @property \App\Model\Table\FacturesTable&\Cake\ORM\Association\HasMany $Factures
 * @property \App\Model\Table\LivraisonsTable&\Cake\ORM\Association\HasMany $Livraisons
 * @property \App\Model\Table\LivraisonsancTable&\Cake\ORM\Association\HasMany $Livraisonsanc
 *
 * @method \App\Model\Entity\Materieltransport newEmptyEntity()
 * @method \App\Model\Entity\Materieltransport newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Materieltransport[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Materieltransport get($primaryKey, $options = [])
 * @method \App\Model\Entity\Materieltransport findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Materieltransport patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Materieltransport[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Materieltransport|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Materieltransport saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Materieltransport[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Materieltransport[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Materieltransport[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Materieltransport[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MaterieltransportsTable extends Table
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

        $this->setTable('materieltransports');
        $this->setDisplayField('designation');
        $this->setPrimaryKey('id');

        $this->hasMany('Bondetransferts', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->hasMany('Bonlivraisons', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->hasMany('Bonreceptionstocks', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->hasMany('Bonsortiestocks', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->hasMany('Commandeclients', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->hasMany('Commandes', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->hasMany('Factureclients', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->hasMany('Factures', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->hasMany('Livraisons', [
            'foreignKey' => 'materieltransport_id',
        ]);
        $this->hasMany('Livraisonsanc', [
            'foreignKey' => 'materieltransport_id',
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
            ->scalar('code')
            ->maxLength('code', 255)
            ->allowEmptyString('code');

        $validator
            ->scalar('matricule')
            ->maxLength('matricule', 255)
            ->allowEmptyString('matricule');

        $validator
            ->scalar('designation')
            ->maxLength('designation', 255)
            ->allowEmptyString('designation');

        $validator
            ->numeric('kilometragedepart')
            ->allowEmptyString('kilometragedepart');

        $validator
            ->numeric('kilometragearrive')
            ->allowEmptyString('kilometragearrive');

        return $validator;
    }
}

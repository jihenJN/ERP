<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Demandeoffredeprixes Model
 *
 * @property \App\Model\Table\BandeconsultationsTable&\Cake\ORM\Association\HasMany $Bandeconsultations
 * @property \App\Model\Table\CommandesTable&\Cake\ORM\Association\HasMany $Commandes
 * @property \App\Model\Table\LignebandeconsultationsTable&\Cake\ORM\Association\HasMany $Lignebandeconsultations
 * @property \App\Model\Table\LignedemandeoffredeprixesTable&\Cake\ORM\Association\HasMany $Lignedemandeoffredeprixes
 * @property \App\Model\Table\LignelignebandeconsultationsTable&\Cake\ORM\Association\HasMany $Lignelignebandeconsultations
 *
 * @method \App\Model\Entity\Demandeoffredeprix newEmptyEntity()
 * @method \App\Model\Entity\Demandeoffredeprix newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Demandeoffredeprix[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Demandeoffredeprix get($primaryKey, $options = [])
 * @method \App\Model\Entity\Demandeoffredeprix findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Demandeoffredeprix patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Demandeoffredeprix[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Demandeoffredeprix|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Demandeoffredeprix saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Demandeoffredeprix[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Demandeoffredeprix[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Demandeoffredeprix[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Demandeoffredeprix[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DemandeoffredeprixesTable extends Table
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

        $this->setTable('demandeoffredeprixes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        
         $this->hasMany('Fournisseurs', [
            'foreignKey' => 'demandeoffredeprix_id',
        ]);

        $this->hasMany('Besionachats', [
            'foreignKey' => 'demandeoffredeprixe_id',
        ]);
        
        $this->hasMany('Bandeconsultations', [
            'foreignKey' => 'demandeoffredeprix_id',
        ]);
        $this->hasMany('Commandefournisseurs', [
            'foreignKey' => 'demandeoffredeprix_id',
        ]);
        $this->hasMany('Lignebandeconsultations', [
            'foreignKey' => 'demandeoffredeprix_id',
        ]);
        $this->hasMany('Lignedemandeoffredeprixes', [
            'foreignKey' => 'demandeoffredeprix_id',
        ]);
        $this->hasMany('Lignelignebandeconsultations', [
            'foreignKey' => 'demandeoffredeprix_id',
        ]);
         $this->hasMany('Articles', [
            'foreignKey' => 'demandeoffredeprix_id',
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
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->scalar('numero')
            ->allowEmptyString('numero');

        $validator
            ->integer('consultation')
            ->notEmptyString('consultation');

        $validator
            ->integer('commande')
            ->notEmptyString('commande');

        return $validator;
    }
}

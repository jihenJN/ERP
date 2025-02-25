<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cartecarburants Model
 *
 * @property \App\Model\Table\TypecartecarburantsTable&\Cake\ORM\Association\BelongsTo $Typecartecarburants
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
 * @method \App\Model\Entity\Cartecarburant newEmptyEntity()
 * @method \App\Model\Entity\Cartecarburant newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Cartecarburant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cartecarburant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cartecarburant findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Cartecarburant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cartecarburant[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cartecarburant|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cartecarburant saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cartecarburant[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cartecarburant[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cartecarburant[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cartecarburant[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CartecarburantsTable extends Table
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

        $this->setTable('cartecarburants');
        $this->setDisplayField('num');
        $this->setPrimaryKey('id');

        $this->belongsTo('Typecartecarburants', [
            'foreignKey' => 'typecartecarburant_id',
        ]);
        $this->hasMany('Bondetransferts', [
            'foreignKey' => 'cartecarburant_id',
        ]);
        $this->hasMany('Bonlivraisons', [
            'foreignKey' => 'cartecarburant_id',
        ]);
        $this->hasMany('Bonreceptionstocks', [
            'foreignKey' => 'cartecarburant_id',
        ]);
        $this->hasMany('Bonsortiestocks', [
            'foreignKey' => 'cartecarburant_id',
        ]);
        $this->hasMany('Commandeclients', [
            'foreignKey' => 'cartecarburant_id',
        ]);
        $this->hasMany('Commandes', [
            'foreignKey' => 'cartecarburant_id',
        ]);
        $this->hasMany('Factureclients', [
            'foreignKey' => 'cartecarburant_id',
        ]);
        $this->hasMany('Factures', [
            'foreignKey' => 'cartecarburant_id',
        ]);
        $this->hasMany('Livraisons', [
            'foreignKey' => 'cartecarburant_id',
        ]);
        $this->hasMany('Livraisonsanc', [
            'foreignKey' => 'cartecarburant_id',
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
            ->scalar('num')
            ->maxLength('num', 255)
            ->allowEmptyString('num');

        $validator
            ->scalar('motdepasse')
            ->maxLength('motdepasse', 255)
            ->allowEmptyString('motdepasse');

        $validator
            ->scalar('typekiosque')
            ->maxLength('typekiosque', 255)
            ->allowEmptyString('typekiosque');

        $validator
            ->integer('typecartecarburant_id')
            ->allowEmptyString('typecartecarburant_id');

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
        $rules->add($rules->existsIn('typecartecarburant_id', 'Typecartecarburants'), ['errorField' => 'typecartecarburant_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Relevercommercials Model
 *
 * @property \App\Model\Table\CommercialsTable&\Cake\ORM\Association\BelongsTo $Commercials
 * @property \App\Model\Table\BonlivraisonsTable&\Cake\ORM\Association\BelongsTo $Bonlivraisons
 * @property \App\Model\Table\LignebonlivraisonsTable&\Cake\ORM\Association\BelongsTo $Lignebonlivraisons
 * @property \App\Model\Table\BonusmaluscommercialsTable&\Cake\ORM\Association\BelongsTo $Bonusmaluscommercials
 * @property \App\Model\Table\LignebonusmalusTable&\Cake\ORM\Association\BelongsTo $Lignebonusmalus
 * @property \App\Model\Table\ReglementsTable&\Cake\ORM\Association\BelongsTo $Reglements
 * @property \App\Model\Table\LignereglementsTable&\Cake\ORM\Association\BelongsTo $Lignereglements
 *
 * @method \App\Model\Entity\Relevercommercial newEmptyEntity()
 * @method \App\Model\Entity\Relevercommercial newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Relevercommercial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Relevercommercial get($primaryKey, $options = [])
 * @method \App\Model\Entity\Relevercommercial findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Relevercommercial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Relevercommercial[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Relevercommercial|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Relevercommercial saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Relevercommercial[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Relevercommercial[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Relevercommercial[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Relevercommercial[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RelevercommercialsTable extends Table
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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
       

        return $rules;
    }
}

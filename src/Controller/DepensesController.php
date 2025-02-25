<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;

/**
 * Depenses Controller
 *
 * @property \App\Model\Table\DepensesTable $Depenses
 * @method \App\Model\Entity\Depense[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DepensesController extends AppController
{


    public function imprimstb($id = null)
    {
        // $this->viewBuilder()->setLayout('');

        // $pieces = $this->Piecereglements->get($id);
        $depense = $this->fetchTable('Depenses')->find()->where('Depenses.id=' . $id)->first();
        $fournisseur = [];
        if ($depense->fournisseur_id != null) {
            $fournisseur = $this->fetchTable('Fournisseurs')->find()->where('Fournisseurs.id=' . $depense->fournisseur_id)->first();
        }

        $this->set(compact('pieces', 'depense', 'fournisseur'));
    }

    public function imprimtr($id = null)
    {

        $depense = $this->fetchTable('Depenses')->find()->where('Depenses.id=' . $id)->first();
        $banque = [];
     
        if ($depense->compte_id != null) {
            $compte = $this->fetchTable('Comptes')->find()->where('Comptes.id=' . $depense->compte_id)->first();
        }

        if ($compte->banque_id != null) {
            $banque = $this->fetchTable('Banques')->find()->where('Banques.id=' . $compte->banque_id)->first();
        }
        $societe = $this->fetchTable('Societes')->find()->where('Societes.id=1')->first();

        $fournisseur = [];
        if ($depense->fournisseur_id != null) {
            $fournisseur = $this->fetchTable('Fournisseurs')->find()->where('Fournisseurs.id=' . $depense->fournisseur_id)->first();
        }

        $this->set(compact('depense','fournisseur', 'societe', 'banque', 'compte'));
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Paiements', 'Typedepenses', 'Caisses'],
        ];

        $caisse_id = $this->request->getQuery('caisse_id');
     
        if ($caisse_id) {
         //   $cond1 = "Articles.Code like %'" . $Code . "' ";
             $cond1 = 'Depenses.caisse_id ='. $caisse_id;
        }

        $query = $this->Depenses->find('all')->where([$cond1])->order(['Depenses.id' =>'DESC']);

       
        $depenses = $this->paginate($query);
      

        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find()->where('Users.id=' . $user_id)->first();

        $usercaisses = $this->fetchTable('Usercaisses')->find()->where('Usercaisses.user_id=' . $user_id)->toArray();


        $caisseIds = [];
        foreach ($usercaisses as $usercaisse) {
            $caisseIds[] = $usercaisse['caisse_id'];
        }

        // Convert the array to a comma-separated string for use in the IN clause
        $caisseIdsString = implode(',', $caisseIds);

        $caisses = $this->Depenses->Caisses->find('list')
        ->where(['Caisses.id IN ('. $caisseIdsString.')']);

        $countcaisses = $this->fetchTable('Caisses')->find()->count();
        $countusercaisses = $this->fetchTable('Usercaisses')->find()->where('Usercaisses.user_id=' . $user_id)->count();

        $this->set(compact('depenses', 'caisses', 'usercaisses','countcaisses','countusercaisses'));
    }

    /**
     * View method
     *
     * @param string|null $id Depense id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $depense = $this->Depenses->get($id, [
            'contain' => ['Paiements', 'Typedepenses', 'Caisses'],
        ]);

        $currentDate = FrozenTime::now()->setTimezone('Africa/Tunis')->toDateTimeString();
        $connection = ConnectionManager::get('default');
        $current_solde = $connection->execute("SELECT calculsolde(?,?) as current_solde", [$depense->caisse_id, $currentDate])->fetchAll('assoc');
        // debug($current_solde);

        $typedepenses = $this->fetchTable('Typedepenses')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $caisses = $this->Depenses->Caisses->find('list')->all();
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list')->all();
        $comptes = $this->fetchTable('Comptes')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {
                if ($art->banque_id != null) {
                    $bnq = $this->fetchTable('Banques')->find()
                        ->select(['name'])
                        ->where(['id' => $art->banque_id])
                        ->first();
                } else {
                    $bnq = '';
                }

                return $bnq->name . ' - ' . $art->rib;
            }
        ]);


        if ($depense->type==1 || $depense->type==3 || $depense->type==0){
            $paiements = $this->Depenses->Paiements->find('list')->where('Paiements.id=1');

        } else 
        if ($depense->type==2){
            $paiements = $this->Depenses->Paiements->find('list')->where('Paiements.id in (2,3,4)');

        }

        $soldecourant = $current_solde[0]['current_solde'];
        if ($depense->fournisseur_id!=null){
            $commandefournisseurs = $this->fetchTable('Commandefournisseurs')
            ->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])
            ->where('Commandefournisseurs.fournisseur_id='.$depense->fournisseur_id);
            }

        $this->set(compact('fournisseurs', 'depense', 'paiements', 'typedepenses', 'caisses', 'soldecourant','comptes','commandefournisseurs'));

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $num = $this->Depenses->find()->select(["num" => 'MAX(Depenses.numero)'])->first();
        $n = $num->num;
        $in = intval($n) + 1;
        $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);
        $depense = $this->Depenses->newEmptyEntity();
        if ($this->request->is('post')) {

            $num = $this->Depenses->find()->select(["num" => 'MAX(Depenses.numero)'])->first();
            $n = $num->num;
            $in = intval($n) + 1;
            $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);
            $depense = $this->Depenses->patchEntity($depense, $this->request->getData());
            $depense->numero=$mm;
            if ($this->Depenses->save($depense)) {
                $dep_id = ($this->Depenses->save($depense)->id);
                         
                $this->misejour("Depenses", "add", $dep_id);

                return $this->redirect(['action' => 'index']);
            }
        }


        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list')->all();
        $paiements = $this->Depenses->Paiements->find('list')->where('Paiements.id=1');

        $typedepenses = $this->fetchTable('Typedepenses')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $caisses = $this->Depenses->Caisses->find('list')->all();
        $comptes = $this->fetchTable('Comptes')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {
                if ($art->banque_id != null) {
                    $bnq = $this->fetchTable('Banques')->find()
                        ->select(['name'])
                        ->where(['id' => $art->banque_id])
                        ->first();
                } else {
                    $bnq = '';
                }

                return $bnq->name . ' - ' . $art->rib;
            }
        ]);

        $this->set(compact('comptes','fournisseurs', 'depense', 'paiements', 'typedepenses', 'caisses', 'mm'));
    }

    public function getsolde21062024()
    {
        $id = $this->request->getQuery('caisse_id');
        $currentDate = FrozenTime::now()->setTimezone('Africa/Tunis')->toDateTimeString();
        $connection = ConnectionManager::get('default');
        $current_solde = $connection->execute("SELECT calculsolde(?,?) as current_solde", [$id, $currentDate])->fetchAll('assoc');

        // debug($current_solde);

        echo json_encode(array("montant" => $current_solde[0]['current_solde']));
        exit;
    }
    public function getsolde()
    {
        $id = $this->request->getQuery('caisse_id');
        $currentDate = FrozenTime::now()->setTimezone('Africa/Tunis')->toDateTimeString();
        $connection = ConnectionManager::get('default');
        $current_solde = $connection->execute("SELECT calculsolde(?,?) as current_solde", [$id, $currentDate])->fetchAll('assoc');

        // debug($current_solde);

        echo json_encode(array("montant" => $current_solde[0]['current_solde']));
        exit;
    }

    /**
     * Edit method
     *
     * @param string|null $id Depense id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $depense = $this->Depenses->get($id, [
            'contain' => [],
        ]);

        $currentDate = FrozenTime::now()->setTimezone('Africa/Tunis')->toDateTimeString();
        $connection = ConnectionManager::get('default');
        $current_solde = $connection->execute("SELECT calculsolde(?,?) as current_solde", [$depense->caisse_id, $currentDate])->fetchAll('assoc');
        //  debug($current_solde);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $depense = $this->Depenses->patchEntity($depense, $this->request->getData());




            // debug($depense->toArray());
            if ($this->Depenses->save($depense)) {
                $dep_id = ($this->Depenses->save($depense)->id);
                         
                $this->misejour("Depenses", "edit", $dep_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $typedepenses = $this->fetchTable('Typedepenses')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $caisses = $this->Depenses->Caisses->find('list')->all();
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list')->all();
        $comptes = $this->fetchTable('Comptes')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {
                if ($art->banque_id != null) {
                    $bnq = $this->fetchTable('Banques')->find()
                        ->select(['name'])
                        ->where(['id' => $art->banque_id])
                        ->first();
                } else {
                    $bnq = '';
                }

                return $bnq->name . ' - ' . $art->rib;
            }
        ]);


        if ($depense->type==1 || $depense->type==3 || $depense->type==0){
            $paiements = $this->Depenses->Paiements->find('list')->where('Paiements.id=1');

        } else 
        if ($depense->type==2){
            $paiements = $this->Depenses->Paiements->find('list')->where('Paiements.id in (2,3,4)');

        }
        if ($depense->fournisseur_id!=null){
        $commandefournisseurs = $this->fetchTable('Commandefournisseurs')
        ->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])
        ->where('Commandefournisseurs.fournisseur_id='.$depense->fournisseur_id);
        }

        $soldecourant = $current_solde[0]['current_solde'];
        $this->set(compact('fournisseurs', 'depense', 'paiements', 'typedepenses', 'caisses', 'soldecourant','comptes','commandefournisseurs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Depense id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $depense = $this->Depenses->get($id);
        if ($this->Depenses->delete($depense)) {
            $dep_id = ($this->Depenses->save($depense)->id);
                         
            $this->misejour("Depenses", "delete", $dep_id);
        }

        return $this->redirect(['action' => 'index']);
    }

    
    public function getbc($id = null)
    {
        
        $id = $this->request->getQuery('id');

         //debug($id);
        //die;

        $query = $this->fetchTable('Commandefournisseurs')->find();
        $query->where(['fournisseur_id' => $id]);
       
      
       $select = "

        <label class='control-label' for='bc'>Commande</label>
        <select name='commandefournisseur_id' id='commandefournisseur_id' class='form-control'>
					<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
            $select =  $select . "	<option value ='" . $q['id'] . "'";
            $select =  $select . " >" . $q['numero'] . "</option>";
        }
        $select = $select . "</select>  ";
 
        echo json_encode(array('select' => $select));
        exit;

    }
}

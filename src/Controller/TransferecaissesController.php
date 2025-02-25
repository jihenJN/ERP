<?php

declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;

use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
/**
 * Transferecaisses Controller
 *
 * @property \App\Model\Table\TransferecaissesTable $Transferecaisses
 * @method \App\Model\Entity\Transferecaiss[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransferecaissesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Caisses','Commandefournisseurs','Livraisons','Comptes'],
            'order'=> ['id' => 'DESC']
        ];
        $transferecaisses = $this->paginate($this->Transferecaisses);
    

        $user_id = $this->request->getAttribute('identity')->id;
        $user=$this->fetchTable('Users')->find()->where('Users.id='.$user_id)->first();
        $validationtransfert=$user->validationtransfert;

       
            $usercaisses = $this->fetchTable('Usercaisses')->find()->where('Usercaisses.user_id=' . $user_id)->toArray();
         


            $caisseIds = [];
            foreach ($usercaisses as $usercaisse) {
                $caisseIds[] = $usercaisse['caisse_id'];
            }
    
            // Convert the array to a comma-separated string for use in the IN clause
            $caisseIdsString = implode(',', $caisseIds);

            $caisses = $this->Transferecaisses->Caisses->find('list')
            ->where(['Caisses.id IN ('. $caisseIdsString.')']);
    
    

        $this->set(compact('usercaisses','transferecaisses', 'caisses','validationtransfert'));
    }

    /**
     * View method
     *
     * @param string|null $id Transferecaiss id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transferecaiss = $this->Transferecaisses->get($id, [
            'contain' => ['Caisses'],
        ]);
        $caisses = $this->fetchtable('Caisses')->find('list')->all();
        $commandefournisseurs = $this->fetchTable('Commandefournisseurs')->find('list', [
            'keyField' => 'id',
            'valueField' => 'numero'
        ]);
        $livraisons = $this->fetchTable('Livraisons')->find('list', [
            'keyField' => 'id',
            'valueField' => 'numero'
        ]);

        $connection = ConnectionManager::get('default');
        $currentDate = FrozenTime::now()->setTimezone('Africa/Tunis')->toDateTimeString();

        $current_solde = $connection->execute("SELECT calculsolde(?,?) as current_solde", [$transferecaiss->caisse_id,$currentDate])->fetchAll('assoc');
        $soldecourant=$current_solde[0]['current_solde'];
        $paiements = $this->fetchTable('Paiements')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        $comptes = $this->fetchTable('Comptes')->find('list', [
            'keyField' => 'id',
            'valueField' => 'numero'
        ]);

        $this->set(compact('livraisons','comptes', 'commandefournisseurs', 'transferecaiss', 'caisses','soldecourant','paiements'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $num = $this->Transferecaisses->find()->select([
            "num" =>
            'MAX(Transferecaisses.numero)'
        ])->first();

        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        // debug($n);
        $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);
        // debug($mm);
        $transferecaiss = $this->Transferecaisses->newEmptyEntity();
        if ($this->request->is('post')) {
            $transferecaiss = $this->Transferecaisses->patchEntity($transferecaiss, $this->request->getData());

            if ($this->Transferecaisses->save($transferecaiss)) {

                return $this->redirect(['action' => 'index']);
            }
        }
        $caisses = $this->Transferecaisses->Caisses->find('list')->all();
        $commandefournisseurs = $this->fetchTable('Commandefournisseurs')->find('list', [
            'keyField' => 'id',
            'valueField' => 'numero'
        ]);
        $livraisons = $this->fetchTable('Livraisons')->find('list', [
            'keyField' => 'id',
            'valueField' => 'numero'
        ]);
        $paiements = $this->fetchTable('Paiements')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        $connection = ConnectionManager::get('default');
        $currentDate = FrozenTime::now()->setTimezone('Africa/Tunis')->toDateTimeString();
        //debug($currentDate);

        $current_solde = $connection->execute("SELECT calculsolde(?,?) as current_solde", [5,$currentDate])->fetchAll('assoc');
        $soldecourant=$current_solde[0]['current_solde'];
       // debug($soldecourant);
        $comptes = $this->fetchTable('Comptes')->find('list', [
            'keyField' => 'id',
            'valueField' => 'numero'
        ]);
        $this->set(compact('livraisons','comptes','soldecourant', 'commandefournisseurs', 'transferecaiss', 'caisses', 'mm','paiements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Transferecaiss id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transferecaiss = $this->Transferecaisses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transferecaiss = $this->Transferecaisses->patchEntity($transferecaiss, $this->request->getData());
            if ($this->Transferecaisses->save($transferecaiss)) {

                return $this->redirect(['action' => 'index']);
            }
        }

        $caisses = $this->Transferecaisses->Caisses->find('list')->all();
        $commandefournisseurs = $this->fetchTable('Commandefournisseurs')->find('list', [
            'keyField' => 'id',
            'valueField' => 'numero'
        ]);
        $livraisons = $this->fetchTable('Livraisons')->find('list', [
            'keyField' => 'id',
            'valueField' => 'numero'
        ]);


        $connection = ConnectionManager::get('default');
        $currentDate = FrozenTime::now()->setTimezone('Africa/Tunis')->toDateTimeString();

        $current_solde = $connection->execute("SELECT calculsolde(?,?) as current_solde", [$transferecaiss->caisse_id,$currentDate])->fetchAll('assoc');
        $soldecourant=$current_solde[0]['current_solde'];

        $paiements = $this->fetchTable('Paiements')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        $comptes = $this->fetchTable('Comptes')->find('list', [
            'keyField' => 'id',
            'valueField' => 'numero'
        ]);
        $this->set(compact('commandefournisseurs','comptes', 'livraisons', 'transferecaiss', 'caisses','soldecourant','paiements'));
    }

    public function validation($id = null)
    {
        $transferecaiss = $this->Transferecaisses->get($id, [
            'contain' => [],
        ]);
        // $this->request->allowMethod(['post', 'patch','put']);
    

            $currentDateTime = FrozenTime::now();
            $user_id = $this->request->getAttribute('identity')->id;


            $data['valide']=1;
            $data['user_id']=$user_id;
            $data['datevalidation']=$currentDateTime;


            $transferecaiss = $this->Transferecaisses->patchEntity($transferecaiss, $data);
            if ($this->Transferecaisses->save($transferecaiss)) {
               

            }
           
        

       return $this->redirect(['action' => 'index']);

        // $this->set(compact('transferecaiss'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Transferecaiss id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transferecaiss = $this->Transferecaisses->get($id);
        if ($this->Transferecaisses->delete($transferecaiss)) {
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

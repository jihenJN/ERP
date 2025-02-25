<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Accueils Controller
 *
 * @property \App\Model\Table\AccueilsTable $Accueils
 * @method \App\Model\Entity\Accueil[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccueilsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index2404()
    {
        $accueils = $this->paginate($this->Accueils);

        $this->set(compact('accueils'));
    }

    public function etatjournal()
    {
        error_reporting(E_ERROR | E_PARSE);
    
        $this->loadModel('Factureclients');
        $this->loadModel('Clients');
    
        // Dates
        $date1 = date("Y-m-d", strtotime('last day of December last year'));
        // debug($date1);
        $date2 = date("Y-m-d");  // Date d'aujourd'hui
        // debug($date2);   
        // Conditions
        $cond1 = $date2 ? 'Factureclients.date <= "' . $date2 . ' 23:59:59"' : '';
        $cond2 = $date1 ? 'Factureclients.date >= "' . $date1 . ' 00:00:00"' : '';
    
        // Clients
        $clientss = $this->Clients->find('list', [
            'keyField' => 'id',
            'valueField' => 'Raison_Sociale'
        ]);
    
        // Fetch Factureclients
        $factureclients = $this->fetchTable('Factureclients')->find('all', [
            'contain' => ['Clients'],
        ])
        ->where([$cond1, $cond2]);
      //    debug($factureclients->toArray());
        // Timbre
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" => 'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
    
        $this->set(compact('clientss', 'timbre', 'factureclients', 'date1', 'date2'));
    }
    
    function etatnonsolde()
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Clients');

        $mois = $this->fetchTable('Mois')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $clients = $this->fetchTable('Clients')->find('all')->where(['Clients.id !=12']);
        // debug($clients);
        $moiss = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'num']);

        $this->set(compact("clients","mois","moiss"));



    }
    public function index()
    {
        $accueils = $this->paginate($this->Accueils);
        $cha = "TRUE";
        $clients = $this->fetchTable('Clients')->find('all')->where(["Clients.etat" => $cha]);
        $clientss = $this->fetchTable('Clients')->find('all')->where(["Clients.etat" => $cha]); //->where([$conds]);
        $gouvernoratss = $this->fetchTable('Gouvernorats')->find('all'); //->where([$conds]);
        $zoness = $this->fetchTable('Zones')->find('all'); //->where([$conds]);
        $nb_articule = $this->fetchTable('Articles')->find('all')->count();
        $nb_client = $this->fetchTable('Clients')->find('all')->count();
        $nb_fournisseur = $this->fetchTable('Fournisseurs')->find('all')->count();
        $nb_factachat = $this->fetchTable('Factures')->find('all')->count();
        $nb_fact = $this->fetchTable('Factureclients')->find('all')->count();
        $fournisseurss = $this->fetchTable('Fournisseurs')->find('all'); //->where(["Clients.etat" => $cha]);//->where([$conds]);
        // debug($fournisseurss);
       $this-> etatnonsolde();
        $this->set(compact('nb_fact', 'accueils', 'fournisseurss', 'clientss', 'nb_factachat', 'nb_fournisseur', 'gouvernoratss', 'zoness', 'nb_articule', 'nb_client'));
    }

    /**
     * View method
     *
     * @param string|null $id Accueil id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accueil = $this->Accueils->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('accueil'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accueil = $this->Accueils->newEmptyEntity();
        if ($this->request->is('post')) {
            $accueil = $this->Accueils->patchEntity($accueil, $this->request->getData());
            if ($this->Accueils->save($accueil)) {
                $this->Flash->success(__('The {0} has been saved.', 'Accueil'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Accueil'));
        }
        $this->set(compact('accueil'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Accueil id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accueil = $this->Accueils->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accueil = $this->Accueils->patchEntity($accueil, $this->request->getData());
            if ($this->Accueils->save($accueil)) {
                $this->Flash->success(__('The {0} has been saved.', 'Accueil'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Accueil'));
        }
        $this->set(compact('accueil'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Accueil id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accueil = $this->Accueils->get($id);
        if ($this->Accueils->delete($accueil)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Accueil'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Accueil'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

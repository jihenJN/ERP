<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $Gouvernoratoptions = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'Description']);

        $Code_Socit = $this->request->getQuery('Code_Socit');
        $Code = $this->request->getQuery('Code');
        $Raison_Sociale = $this->request->getQuery('Raison_Sociale');
        $Matricule_Fiscale = $this->request->getQuery('Matricule_Fiscale');
        $Gouvernorat_id = $this->request->getQuery('Gouvernorat_id');
        $Autorisation_Livraison = $this->request->getQuery('Autorisation_Livraison');


        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        if ($Code_Socit) {
           // $cond1 = 'Clients.Code_Socit="' . $Code_Socit . '"';
              $cond1 = 'Clients.Code_Socit like'  ."'%" . $Code_Socit ."%'"  ;
        }
        if ($Code) {
           // $cond2 = 'Clients.Code="' . $Code . '"';
            $cond2 = 'Clients.Code like'  ."'%" . $Code ."%'"  ;
        }
        if ($Raison_Sociale) {
            //$cond3 = 'Clients.Raison_Sociale="' . $Raison_Sociale . '"';
            $cond3 = 'Clients.Raison_Sociale like'  ."'%" . $Raison_Sociale ."%'"  ;
        }
        if ($Matricule_Fiscale) {
           // $cond4 = 'Clients.Matricule_Fiscale="' . $Matricule_Fiscale . '"';
            $cond4 = 'Clients.Matricule_Fiscale like'  ."'%" . $Matricule_Fiscale ."%'"  ;
        }
        if ($Gouvernorat_id) {
            $cond5 = 'Clients.gouvernorat_id ="' . $Gouvernorat_id . '"';
        }
        if ($Autorisation_Livraison) {
            $cond6 = 'Clients.Autorisation_Livraison ="' . $Autorisation_Livraison . '"';
        }
        $query = $this->Clients->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6]);
        $this->paginate = [
            'contain' => ['Commercials', 'Gouvernorats'],'order'=>['left(Clients.Code,1),cast(right(Clients.Code,length(Clients.Code)-1) as Unsigned)']
        ];












        $clients = $this->paginate($query);


        $this->set(compact('clients', 'Gouvernoratoptions'));
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => ['Commercials', 'Gouvernorats', 'Adresselivraisonclients', 'Bondereservations', 'Bonlivraisons', 'Clientbanques', 'Clientexonerations', 'Clientfourchettes', 'Clientresponsables', 'Commandeclients', 'Factureclients', 'Fourchettes'],
        ]);

        $this->set(compact('client'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
  public function add()
    {
        $client = $this->Clients->newEmptyEntity();
        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        $gouvernorats = $this->Clients->Gouvernorats->find('list',  ['keyfield' => 'id', 'valueField' => 'Description'])->all();

        $this->set(compact('client', 'commercials', 'gouvernorats'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //debug($this->request->getData());
        $client = $this->Clients->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                // debug($this->request->getData());

                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        $gouvernorats = $this->Clients->Gouvernorats->find('list',  ['keyfield' => 'id', 'valueField' => 'Description'])->all();
        $this->set(compact('client', 'commercials', 'gouvernorats'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('The client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function clientcommercial()
    {

        $clientCom = $this->Clients->newEmptyEntity();
                if ($this->request->is('post')) {

           // $client = $this->Clients->patchEntity($client, $this->request->getData(), ['associated' => ['Adresselivraisonclients' => ['validate' => false]]]);
          $commercial=$this->request->getData('commercial_id');
          //  debug($this->request->getData()['data']);die;

            if (isset($this->request->getData()['data']) && (!empty($this->request->getData()['data']))) {
             //  debug('hh');
				foreach ($this->request->getData()['data']['lignec'] as $i => $c) {
                    //debug($c['checkclient']);
                   
					if ( isset($c['checkclient']) && (!empty ($c['checkclient'])) && $c['checkclient'] == 1) {
                        $client = $this->Clients->get($c['client_id'], [
                            'contain' => [],
                        ]);
                        //debug($client);
    
                        $client->commercial_id = $commercial;
    
                        $this->Clients->save($client);
                        

                
                        
					}
				} //die; 
			}






        }
      //  $clients = $this->Clients->find('list', ['limit' => 200]);
     

        //Configure::write('debug',2); 
        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        $gouvernorats = $this->Clients->Gouvernorats->find('list',  ['keyfield' => 'id', 'valueField' => 'Description'])->all();
        $this->set(compact('commercials', 'gouvernorats','clientCom'));
    }

 public function clientgouv()
    {
        $id = $this->request->getQuery('idfam');
 // debug($id);





  $dealIdStr = implode(", ", $id);

        $clients = $this->Clients->find('all',['keyfield' => 'id','valueField' =>'nameF'])
            ->where(['Clients.gouvernorat_id  in (' . $dealIdStr . ')'])->order(['left(Clients.Code,1),cast(right(Clients.Code,length(Clients.Code)-1) as Unsigned)']);
          
          
         $this->layout = '';
       
        $this->set(compact('clients'));

    }


//    public function clientgouv()
//    {
//        $id = $this->request->getQuery('idfam');
// // debug($id);
//
//
//
//
//
//  $dealIdStr = implode(", ", $id);
//
//        $clients = $this->Clients->find('all',['keyfield' => 'id','valueField' =>'nameF'])
//            ->where(['Clients.gouvernorat_id  in (' . $dealIdStr . ')']);
//          
//          
//         $this->layout = '';
//       
//        $this->set(compact('clients'));
//
//    }
}

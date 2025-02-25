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
            $cond1 = 'Clients.Code_Socit like'  . "'%" . $Code_Socit . "%'";
        }
        if ($Code) {
            // $cond2 = 'Clients.Code="' . $Code . '"';
            $cond2 = 'Clients.Code like'  . "'%" . $Code . "%'";
        }
        if ($Raison_Sociale) {
            //$cond3 = 'Clients.Raison_Sociale="' . $Raison_Sociale . '"';
            $cond3 = 'Clients.Raison_Sociale like'  . "'%" . $Raison_Sociale . "%'";
        }
        if ($Matricule_Fiscale) {
            // $cond4 = 'Clients.Matricule_Fiscale="' . $Matricule_Fiscale . '"';
            $cond4 = 'Clients.Matricule_Fiscale like'  . "'%" . $Matricule_Fiscale . "%'";
        }
        if ($Gouvernorat_id) {
            $cond5 = 'Clients.gouvernorat_id ="' . $Gouvernorat_id . '"';
        }
        if ($Autorisation_Livraison) {
            $cond6 = 'Clients.Autorisation_Livraison ="' . $Autorisation_Livraison . '"';
        }
        $query = $this->Clients->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6]);
        $this->paginate = [
            'contain' => ['Commercials', 'Gouvernorats'], 'order' => ['left(Clients.Code,1),cast(right(Clients.Code,length(Clients.Code)-1) as Unsigned)','id'=>'ASC']
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
        $adressees = $this->fetchTable('Adresselivraisonclients')->find('all', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(["Adresselivraisonclients.client_id =  '" . $id . "' "]);
        $responsable = $this->fetchTable('Clientresponsables')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientresponsables.client_id =  '" . $id . "' "]);
        $banquess = $this->fetchTable('Clientbanques')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientbanques.client_id = " . $id . ""]);
        //  debug($banquess);

        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list',  ['keyfield' => 'id', 'valueField' => 'name'])->all();

        $banques = $this->fetchTable('Banques')->find('list',  ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeexonerations = $this->fetchTable('Typeexonerations')->find('list',  ['keyfield' => 'id', 'valueField' => 'type'])->all();

        $paiements = $this->fetchTable('Paiements')->find('list',  ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeclients = $this->fetchTable('Typeclients')->find('list',  ['keyfield' => 'id', 'valueField' => 'type'])->all();


        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        $gouvernorats = $this->Clients->Gouvernorats->find('list',  ['keyfield' => 'id', 'valueField' => 'Description'])->all();
        $this->set(compact('pointdeventes', 'typeclients', 'client', 'commercials', 'gouvernorats', 'typeexonerations', 'paiements', 'adressees', 'responsable', 'banquess', 'banques'));
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
            //debug($this->request->getData());
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $this->misejour("Clients", "add", $client->id);
                //  debug($client);
                $id = $client->id;
                // debug($id);

                /////////////////////////////
                if (isset($this->request->getData('data')['banque']) && (!empty($this->request->getData('data')['banque']))) {
                    foreach ($this->request->getData('data')['banque'] as $i => $b) {
                        //debug($adresseliv);
                        //die;

                        if ($b['supbanque'] != 1) {


                            $clientbanque = $this->fetchTable('Clientbanques')->newEmptyEntity();
                            $datee['banque_id'] = $b['banque_id'];
                            $datee['agence'] = $b['agence'];
                            $datee['code_banque'] = $b['code_banque'];
                            $datee['swift'] = $b['swift'];
                            $datee['compte'] = $b['compte'];
                            $datee['rib'] = $b['rib'];
                            $datee['document'] = $b['document'];
                            $datee['client_id'] = $id;
                            $clientbanque = $this->fetchTable('Clientbanques')->patchEntity($clientbanque, $datee);


                            $this->fetchTable('Clientbanques')->save($clientbanque);
                        }
                    }
                }



                if (isset($this->request->getData('data')['adresse']) && (!empty($this->request->getData('data')['adresse']))) {
                    foreach ($this->request->getData('data')['adresse'] as $i => $b) {
                        //debug($adresseliv);
                        //die;

                        if ($b['supadresse'] != 1) {


                            $adresseliv = $this->fetchTable('Adresselivraisonclients')->newEmptyEntity();
                            $data['adresse'] = $b['adresse'];
                            $data['client_id'] = $id;

                            $adresseliv = $this->fetchTable('Adresselivraisonclients')->patchEntity($adresseliv, $data);


                            $this->fetchTable('Adresselivraisonclients')->save($adresseliv);
                        }
                    }
                }


                if (isset($this->request->getData('data')['responsable']) && (!empty($this->request->getData('data')['responsable']))) {
                    foreach ($this->request->getData('data')['responsable'] as $i => $b) {
                        //debug($adresseliv);
                        //die;

                        if ($b['supresponsable'] != 1) {


                            $clientresponsable = $this->fetchTable('Clientresponsables')->newEmptyEntity();
                            $dataa['name'] = $b['name'];
                            $dataa['mail'] = $b['mail'];
                            $dataa['tel'] = $b['tel'];
                            $dataa['poste'] = $b['poste'];
                            $dataa['client_id'] = $client->id;

                            $clientresponsable = $this->fetchTable('Clientresponsables')->patchEntity($clientresponsable, $dataa);


                            $this->fetchTable('Clientresponsables')->save($clientresponsable);
                        }
                    }
                }

























                //$this->Flash->success(__('The client has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        $gouvernorats = $this->Clients->Gouvernorats->find('list',  ['keyfield' => 'id', 'valueField' => 'Description'])->all();
        $banques = $this->fetchTable('Banques')->find('list',  ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $paiements = $this->fetchTable('Paiements')->find('list',  ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeexonerations = $this->fetchTable('Typeexonerations')->find('list',  ['keyfield' => 'id', 'valueField' => 'type'])->all();
        $typeclients = $this->fetchTable('Typeclients')->find('list',  ['keyfield' => 'id', 'valueField' => 'type'])->all();
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list',  ['keyfield' => 'id', 'valueField' => 'name'])->all();






        $this->set(compact('client', 'commercials', 'gouvernorats', 'typeexonerations', 'banques', 'paiements', 'typeclients', 'pointdeventes'));
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
         //    debug($this->request->getData());
            if ($this->Clients->save($client)) {
                $this->misejour("Clients", "edit", $id);
               

                if (isset($this->request->getData('data')['adresse']) && (!empty($this->request->getData('data')['adresse']))) {
                    foreach ($this->request->getData('data')['adresse'] as $i => $b) {


                        if ($b['supadresse'] != 1) {


                            $adresseliv = $this->fetchTable('Adresselivraisonclients')->newEmptyEntity();
                            $data['adresse'] = $b['adresse'];
                            $data['client_id'] = $id;

                            //debug($dat);
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->newEmptyEntity();
                            };
                            $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->patchEntity($adresselivraisonclient, $data);
                            //debug($lignecommandeclient);

                            $this->fetchTable('Adresselivraisonclients')->save($adresselivraisonclient);
                        } else if ($b['supadresse'] == 1 && !empty($b['id'])) {
                            $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Adresselivraisonclients')->delete($adresselivraisonclient);
                        }
                    }
                }





                if (isset($this->request->getData('data')['banque']) && (!empty($this->request->getData('data')['banque']))) {
                    foreach ($this->request->getData('data')['banque'] as $i => $b) {


                        if ($b['supbanque'] != 1) {


                            $datee['banque_id'] = $b['banque_id'];
                            $datee['agence'] = $b['agence'];
                            $datee['code_banque'] = $b['code_banque'];
                            $datee['swift'] = $b['swift'];
                            $datee['compte'] = $b['compte'];
                            $datee['rib'] = $b['rib'];
                            $datee['document'] = $b['document'];
                            $datee['client_id'] = $id;


                            //debug($dat);
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientbanque = $this->fetchTable('Clientbanques')->newEmptyEntity();
                            };
                            $clientbanque = $this->fetchTable('Clientbanques')->patchEntity($clientbanque, $datee);
                            //debug($lignecommandeclient);

                            $this->fetchTable('Clientbanques')->save($clientbanque);
                        } else if ($b['supbanque'] == 1 && !empty($b['id'])) {
                            $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientbanques')->delete($clientbanque);
                        }
                    }
                }






                if (isset($this->request->getData('data')['responsable']) && (!empty($this->request->getData('data')['responsable']))) {
                    foreach ($this->request->getData('data')['responsable'] as $i => $b) {
                        //debug($b);


                        if ($b['supresponsable'] != 1) {








                            $dataa['name'] = $b['name'];
                            $dataa['mail'] = $b['mail'];
                            $dataa['tel'] = $b['tel'];
                            $dataa['poste'] = $b['poste'];
                            $dataa['client_id'] = $client->id;









                            //debug($dat);
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $clientresponsable = $this->fetchTable('Clientresponsables')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientresponsable = $this->fetchTable('Clientresponsables')->newEmptyEntity();
                            };
                            $clientresponsable = $this->fetchTable('Clientresponsables')->patchEntity($clientresponsable, $dataa);
                            //debug($lignecommandeclient);


                            $this->fetchTable('Clientresponsables')->save($clientresponsable);
                        } else if ($b['supresponsable'] == 1 && !empty($b['id'])) {
                            $clientresponsable = $this->fetchTable('Clientresponsables')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientresponsables')->delete($clientresponsable);
                        }
                    }
                }




















                //$this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //   $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }





        $adressees = $this->fetchTable('Adresselivraisonclients')->find('all', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(["Adresselivraisonclients.client_id =  '" . $id . "' "]);
        $responsable = $this->fetchTable('Clientresponsables')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientresponsables.client_id =  '" . $id . "' "]);
        $banquess = $this->fetchTable('Clientbanques')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientbanques.client_id = " . $id . ""]);
        //  debug($banquess);

        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list',  ['keyfield' => 'id', 'valueField' => 'name'])->all();

        $banques = $this->fetchTable('Banques')->find('list',  ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeexonerations = $this->fetchTable('Typeexonerations')->find('list',  ['keyfield' => 'id', 'valueField' => 'type'])->all();

        $paiements = $this->fetchTable('Paiements')->find('list',  ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeclients = $this->fetchTable('Typeclients')->find('list',  ['keyfield' => 'id', 'valueField' => 'type'])->all();


        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        $gouvernorats = $this->Clients->Gouvernorats->find('list',  ['keyfield' => 'id', 'valueField' => 'Description'])->all();
        $this->set(compact('pointdeventes', 'typeclients', 'client', 'commercials', 'gouvernorats', 'typeexonerations', 'paiements', 'adressees', 'responsable', 'banquess', 'banques'));
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


        $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->find('all', [])
            ->where(['client_id' => $id]);



        $clientbanques = $this->fetchTable('Clientbanques')->find('all', [])
            ->where(['client_id' => $id]);

        $clientresponsables = $this->fetchTable('Clientresponsables')->find('all', [])
            ->where(['client_id' => $id]);



        $this->loadModel('Clientbanques');
        $this->loadModel('Adresselivraisonclients');
        $this->loadModel('Clientresponsables');

        foreach ($clientbanques as $b) {
            $this->Clientbanques->delete($b);
        }



        foreach ($clientresponsables as $client) {

            $this->Clientresponsables->delete($client);
        }

        foreach ($adresselivraisonclient as $adresse) {
            $this->Adresselivraisonclients->delete($adresse);
        }






        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->misejour("Clients", "delete", $id);

         



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
            $commercial = $this->request->getData('commercial_id');
            //  debug($this->request->getData()['data']);die;

            if (isset($this->request->getData()['data']) && (!empty($this->request->getData()['data']))) {
                //  debug('hh');
                foreach ($this->request->getData()['data']['lignec'] as $i => $c) {
                    //debug($c['checkclient']);

                    if (isset($c['checkclient']) && (!empty($c['checkclient'])) && $c['checkclient'] == 1) {
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
        $this->set(compact('commercials', 'gouvernorats', 'clientCom'));
    }

    public function clientgouv()
    {
        $id = $this->request->getQuery('idfam');
        // debug($id);





        $dealIdStr = implode(", ", $id);

        $clients = $this->Clients->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
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

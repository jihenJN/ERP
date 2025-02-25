<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Commandeclients Controller
 *
 * @property \App\Model\Table\CommandeclientsTable $Commandeclients
 * @method \App\Model\Entity\Commandeclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommandeclientsController extends AppController
{
    /**
     * 
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function imprimeview($id = null)
    {
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Lignecommandeclients','Clients'],
        ]);
        $clients =  $this->Commandeclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Commandeclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
       $this->loadModel('Lignecommandeclients');
        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('articles');
        $articles = $this->articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $commandeclients = $this->Commandeclients->find();
        $this->set(compact('lignecommandeclients','commandeclients', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    
    }


    public function imprimerrecherche($id = null)
    {
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $this->loadModel('Personnels');

        $clientsoptions = $this->Commandeclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Commandeclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $Cartecarburantsoptions = $this->Commandeclients->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);
        $materieltransportsoptions = $this->Commandeclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'code']);

        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $historiquede = $this->request->getQuery('historiquede');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $client_id = $this->request->getQuery('client_id');
        $au = $this->request->getQuery('au');
        $depot_id = $this->request->getQuery('depot_id');

        if ($historiquede) {
            // $cond2 = "Commandeclients.date like  '%" . $historiquede . "%' ";
        }
        if ($pointdevente_id) {
            $cond3 = "Commandeclients.pointdevente_id like  '%" . $pointdevente_id . "%' ";
        }
        if ($client_id) {
            $cond4 = "Commandeclients.client_id like  '%" . $client_id . "%' ";
        }
        if ($depot_id) {
            $cond5 = "Commandeclients.depot_id like  '%" . $depot_id . "%' ";
        }
        if ($au) {
            // $cond6 = "Commandeclients.date like  '%" . $au . "%' ";
        }



        $query = $this->Commandeclients->find('all')->where([$cond2, $cond3, $cond4, $cond5, $cond6]);


        $this->paginate = [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', /*'Chauffeurs', 'Convoyeurs', *//*'Bonlivraisons', 'Bondereservations', 'Lignebonlivraisons', 'Lignecommandeclients'*/],
        ];
        $commandeclients = $this->paginate($query);
        $clients =  $this->Commandeclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $depots = $this->Commandeclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //  $commandeclients = $this->Commandeclients->find();


        $this->set(compact('clients', 'commandeclients', 'pointdeventes', 'clientsoptions', 'depotsoptions', 'Cartecarburantsoptions', 'materieltransportsoptions', 'chauffeurs', 'convoyeurs'));
    }





    public function index()
    {
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $this->loadModel('Personnels');

        $clientsoptions = $this->Commandeclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Commandeclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $Cartecarburantsoptions = $this->Commandeclients->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);
        $materieltransportsoptions = $this->Commandeclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'code']);

        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $historiquede = $this->request->getQuery('historiquede');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $client_id = $this->request->getQuery('client_id');
        $au = $this->request->getQuery('au');
        $depot_id = $this->request->getQuery('depot_id');

        if ($historiquede) {
            // $cond2 = "Commandeclients.date like  '%" . $historiquede . "%' ";
        }
        if ($pointdevente_id) {
            $cond3 = "Commandeclients.pointdevente_id like  '%" . $pointdevente_id . "%' ";
        }
        if ($client_id) {
            $cond4 = "Commandeclients.client_id like  '%" . $client_id . "%' ";
        }
        if ($depot_id) {
            $cond5 = "Commandeclients.depot_id like  '%" . $depot_id . "%' ";
        }
        if ($au) {
            // $cond6 = "Commandeclients.date like  '%" . $au . "%' ";
        }



        $query = $this->Commandeclients->find('all')->where([$cond2, $cond3, $cond4, $cond5, $cond6]);


        $this->paginate = [
            'contain' => ['Clients', 'Pointdeventes', 'Depots'],
        ];
        $commandeclients = $this->paginate($query);
        $clients =  $this->Commandeclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $depots = $this->Commandeclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //  $commandeclients = $this->Commandeclients->find();


        $this->set(compact('clients', 'commandeclients', 'pointdeventes', 'clientsoptions', 'depotsoptions', 'Cartecarburantsoptions', 'materieltransportsoptions', 'chauffeurs', 'convoyeurs', 'pointdevente_id', 'client_id', 'depot_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Commandeclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {





        $this->loadModel('Personnels');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Lignecommandeclients'],
        ]);
        //debug($commandeclient);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commandeclient = $this->Commandeclients->patchEntity($commandeclient, $this->request->getData(), ['associated' => ['Lignecommandeclients' => ['validate' => false]]]);
            if ($this->Commandeclients->save($commandeclient)) {
                if (isset($this->request->getData('data')['lignecommandeclients']) && (!empty($this->request->getData('data')['lignecommandeclients']))) {
                    foreach ($this->request->getData('data')['lignecommandeclients'] as $i => $res) {
                        // debug($res);
                        //  die;

                        if ($res['sup0'] != 1) {
                            $dat['article_id'] = $res['article_id'];
                            $dat['qtestock'] = $res['qtestock'];
                            $dat['qte'] = $res['qte'];
                            $dat['prixht'] = $res['prixht'];
                            $dat['remise'] = $res['remise'];
                            $dat['punht'] = $res['punht'];
                            $dat['tva'] = $res['tva'];
                            $dat['fodec'] = $res['fodec'];
                            $dat['ttc'] = $res['ttc'];

                            $dat['commandeclient_id'] = $id;
                            //debug($dat);
                            if (isset($res['id']) && (!empty($res['id']))) {

                                $lignecommandeclient = $this->fetchTable('lignecommandeclients')->get($res['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $lignecommandeclient = $this->fetchTable('lignecommandeclients')->newEmptyEntity();
                            };
                            $lignecommandeclient = $this->fetchTable('lignecommandeclients')->patchEntity($lignecommandeclient, $dat);
                            //debug($lignecommandeclient);

                            if ($this->fetchTable('lignecommandeclients')->save($lignecommandeclient)) {
                                // debug($lignecommandeclient);
                                $this->Flash->success("lignecommandeclients has been edited successfully");
                            } else {
                                $this->Flash->error("Failed to edit");
                            }
                        }

                        $this->set(compact("lignecommandeclient"));
                    }
                }

                $this->Flash->success(__('The {0} has been saved.', 'Commandeclient'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commandeclient'));

            //        debug($this->request->getData('data')['lignecommandeclients']);
            // die;


        }
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Commandeclients->Clients->find('list', ['limit' => 200]);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandeclients');
        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('articles');
        $articles = $this->articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $this->set(compact('lignecommandeclients', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $commandeclient = $this->Commandeclients->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());

            $commandeclient = $this->Commandeclients->patchEntity($commandeclient, $this->request->getData());
            //debug($commandeclient);

            if ($this->Commandeclients->save($commandeclient)) {
                $commandeclient_id = $commandeclient->id;
                //debug($this->request->getData('data')['tabligne2']);
                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                    $this->loadModel('lignecommandeclients');
                    //debug(($this->request->getData('data')));


                    foreach ($this->request->getData('data')['tabligne3'] as $i => $commande) {
                        if ($commande['sup'] != 1) {

                            // debug($commande);
                            $data['article_id'] = $commande['article_id'];
                            $data['commandeclient_id'] = $commandeclient_id;
                            $data['qte'] = $commande['qte'];
                            $data['prixht'] = $commande['prixht'];
                            $data['remise'] = $commande['remise'];
                            $data['punht'] = $commande['punht'];
                            $data['tva'] = $commande['tva'];
                            $data['fodec'] = $commande['fodec'];
                            $data['ttc'] = $commande['ttc'];

                            //debug($data);


                            $lignecommandeclient = $this->fetchTable('lignecommandeclients')->newEmptyEntity();

                            $lignecommandeclient = $this->lignecommandeclients->patchEntity($lignecommandeclient, $data);

                            if ($this->lignecommandeclients->save($lignecommandeclient)) {

                                $this->Flash->success("lignecommandeclients has been created successfully");
                            } else {


                                $this->Flash->error("Failed to create lignecommandeclients");
                            }
                        }

                        $this->set(compact("lignecommandeclient"));
                    }
                }




                $this->Flash->success(__('The {0} has been saved.', 'Commandeclient'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commandeclient'));
        }
        // $this->loadModel('Lignecommandeclients');
        $this->loadModel('Personnels');


        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);



        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);


        $clients = $this->Commandeclients->Clients->find('list', ['limit' => 200]);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);

        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $this->loadModel('articles');

        $articles = $this->articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $numeroobj = $this->Personnels->find()->select(["numerox" =>
        'MAX(Personnels.code)'])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 6, "0", STR_PAD_LEFT);
            //debug($code);die;

        } else {
            $code = "000001";
        }



        $this->set(compact('code', 'articles', 'commandeclient', 'chauffeurs', 'convoyeurs', 'clients', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports',  'bonlivraisons', 'numero'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Commandeclient id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Personnels');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Lignecommandeclients'],
        ]);
        //debug($commandeclient);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commandeclient = $this->Commandeclients->patchEntity($commandeclient, $this->request->getData(), ['associated' => ['Lignecommandeclients' => ['validate' => false]]]);
            if ($this->Commandeclients->save($commandeclient)) {
                if (isset($this->request->getData('data')['lignecommandeclients']) && (!empty($this->request->getData('data')['lignecommandeclients']))) {
                    foreach ($this->request->getData('data')['lignecommandeclients'] as $i => $res) {
                        // debug($res);
                        //  die;

                        if ($res['sup0'] != 1) {
                            $dat['article_id'] = $res['article_id'];
                            $dat['qtestock'] = $res['qtestock'];
                            $dat['qte'] = $res['qte'];
                            $dat['prixht'] = $res['prixht'];
                            $dat['remise'] = $res['remise'];
                            $dat['punht'] = $res['punht'];
                            $dat['tva'] = $res['tva'];
                            $dat['fodec'] = $res['fodec'];
                            $dat['ttc'] = $res['ttc'];

                            $dat['commandeclient_id'] = $id;
                            //debug($dat);
                            if (isset($res['id']) && (!empty($res['id']))) {

                                $lignecommandeclient = $this->fetchTable('lignecommandeclients')->get($res['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $lignecommandeclient = $this->fetchTable('lignecommandeclients')->newEmptyEntity();
                            };
                            $lignecommandeclient = $this->fetchTable('lignecommandeclients')->patchEntity($lignecommandeclient, $dat);
                            //debug($lignecommandeclient);

                            if ($this->fetchTable('lignecommandeclients')->save($lignecommandeclient)) {
                                // debug($lignecommandeclient);
                                $this->Flash->success("lignecommandeclients has been edited successfully");
                            } else {
                                $this->Flash->error("Failed to edit");
                            }
                        }

                        $this->set(compact("lignecommandeclient"));
                    }
                }

                $this->Flash->success(__('The {0} has been saved.', 'Commandeclient'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commandeclient'));

            //        debug($this->request->getData('data')['lignecommandeclients']);
            // die;


        }
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Commandeclients->Clients->find('list', ['limit' => 200]);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandeclients');
        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('articles');
        $articles = $this->articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $this->set(compact('lignecommandeclients', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Commandeclient id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commandeclient = $this->Commandeclients->get($id);
        if ($this->Commandeclients->delete($commandeclient)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Commandeclient'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Commandeclient'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

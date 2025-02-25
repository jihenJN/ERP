<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Adresselivraisonclient;
use App\Model\Entity\Banque;
use App\Model\Entity\Clientbanque;
use App\Model\Entity\Clientresponsable;
use App\Model\Table\AdresselivraisonclientsTable;
use App\Model\Table\BanquesTable;
use PhpParser\Node\Stmt\Else_;

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
        $cin = $this->request->getQuery('cin');
        $compteComptable = $this->request->getQuery('comptecomptable');
        $passeport = $this->request->getQuery('passeport');
        $typeutilisateur_id = $this->request->getQuery('typeutilisateur_id');
        $cartesejour = $this->request->getQuery('cartesejour');

        $paiement = $this->request->getQuery('paiement_id');
        $matriculefiscale = $this->request->getQuery('Matriculefiscale');
        $name = $this->request->getQuery('name');
        $typeutilisateursoptions = $this->Clients->Typeutilisateurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $paiementsoptions = $this->Clients->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        /*
        if ($cin && $passeport && $compteComptable && $cartesejour && $matriculefiscale && $name && $typeutilisateur_id && $paiement) {
            $query = $this->Clients->find('all')->where(['Or' => ['cin like' => '%' . $cin . '%', 'passeport like' => '%' . $passeport . '%', 'compteComptable like' => '%' . $compteComptable . '%', 'matriculefiscale like' => '%' . $matriculefiscale . '%', 'clients.name like' => '%' . $name . '%', ' clients.typeutilisateur_id like' => '%' . $typeutilisateur_id . '%', ' clients.paiement_id like' => '%' . $paiement . '%']]);
            //debug($query);

        } else {
            $query = $this->Clients;
        }
        $this->paginate = [
            'contain' => ['Typeutilisateurs', 'Villes', 'Regions', 'Pays', 'Activites', 'Paiements'],
        ];
        $clients = $this->paginate($query);
        //debug($clients);

        $this->set(compact('clients', 'typeutilisateursoptions', 'paiementsoptions'));

*/


        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        //if($nom ){
        //$query=$this->Fournisseurs->find('all')->where(['Or'=>['nom like'=>'%'.$nom.'%']]);
        //debug($query);
        //}else{
        //$query=$this->Fournisseurs;}
        if ($name) {
            $cond1 = 'Clients.name="' . $name . '"';
        }
        if ($typeutilisateur_id) {
            $cond3 = 'Clients.Typeutilisateur_id="' . $typeutilisateur_id . '"';
        }
        if ($cin) {
            $cond4 = 'Clients.cin="' . $cin . '"';
        }
        if ($compteComptable) {
            $cond2 = 'Clients.comptecomptable="' . $compteComptable . '"';
        }
        if ($paiement) {
            $cond5 = 'Clients.paiement_id="' . $paiement . '"';
        }
        if ($cartesejour) {
            $cond6 = 'Clients.cartesejour="' . $cartesejour . '"';
        }

        if ($matriculefiscale) {
            $cond6 = 'Clients.matriculefiscale="' . $matriculefiscale . '"';
        }
        if ($passeport) {
            $cond7 = 'Clients.passeport="' . $passeport . '"';
        }

        $query = $this->Clients->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7]);
        $this->paginate = [
            'contain' => ['Typeutilisateurs', 'Villes', 'Regions', 'Pays', 'Activites', 'Paiements'],
        ];
        // debug($query);
        $clients = $this->paginate($query);
        //debug($clients);
        $this->set(compact('cin', 'typeutilisateur_id', 'compteComptable', 'paiement', 'cartesejour', 'matriculefiscale', 'clients', 'typeutilisateursoptions', 'passeport', 'paiementsoptions', 'name'));
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
            'contain' => ['Clientfourchettes', 'Fourchettes', 'Clientfourchettes', 'Typeutilisateurs', 'Villes', 'Regions', 'Pays', 'Activites', 'Paiements', 'Adresselivraisonclients', 'Bondereservations', 'Bonlivraisons', 'Clientbanques', 'Clientexonerations', 'Clientfourchettes', 'Clientresponsables', 'Commandeclients', 'Factureclients', 'Fourchettes'],
        ]);
        $this->paginate = [
            'contain' => [''],
        ];











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

            $client = $this->Clients->patchEntity($client, $this->request->getData(), ['associated' => ['Adresselivraisonclients' => ['validate' => false]]]);
            //debug($this->request->getData());
            //debug(($this->request->getData('typeR')));

            if ($this->Clients->save($client)) {
                $client_id = $client->id;

                if (isset($this->request->getData('data')['adresselivraisonclients']) && (!empty($this->request->getData('data')['adresselivraisonclients']))) {
                    $this->loadModel('adresselivraisonclients');
                    foreach ($this->request->getData('data')['adresselivraisonclients'] as $i => $adresseliv) {
                        if ($adresseliv['sup'] != 1) {
                            $data['adresse'] = $adresseliv['adresse'];
                            $data['client_id'] = $client_id;

                            $adresselivraisonclient = $this->fetchTable('adresselivraisonclients')->newEmptyEntity();

                            $adresselivraisonclient = $this->adresselivraisonclients->patchEntity($adresselivraisonclient, $data);

                            if ($this->adresselivraisonclients->save($adresselivraisonclient)) {

                                $this->Flash->success("adresselivraisonclient has been created successfully");
                            } else {


                                $this->Flash->error("Failed to create adresselivraisonclient");
                            }
                        }

                        $this->set(compact("adresselivraisonclient"));
                    }
                }

                if (isset($this->request->getData('data')['clientresponsables']) && (!empty($this->request->getData('data')['clientresponsables']))) {
                    $this->loadModel('clientresponsables');
                    //  debug(($this->request->getData('data')));


                    foreach ($this->request->getData('data')['clientresponsables'] as $i => $responsable) {
                        if ($responsable['sup0'] != 1) {
                            $data['name'] = $responsable['name'];
                            $data['mail'] = $responsable['mail'];
                            $data['tel'] = $responsable['tel'];
                            $data['poste'] = $responsable['poste'];

                            $data['client_id'] = $client_id;
                            //debug($data);


                            $clientresponsable = $this->fetchTable('clientresponsables')->newEmptyEntity();
                            // debug($adresselivraisonclient);
                            //$this->adresselivraisonclient->create();
                            //$this->adresselivraisonclient->save($data);
                            $clientresponsable = $this->clientresponsables->patchEntity($clientresponsable, $data);

                            if ($this->clientresponsables->save($clientresponsable)) {

                                $this->Flash->success("clientresponsable has been created successfully");
                            } else {


                                $this->Flash->error("Failed to create clientresponsable");
                            }
                        }

                        $this->set(compact("clientresponsable"));
                    }
                }

                if (isset($this->request->getData('data')['clientbanques']) && (!empty($this->request->getData('data')['clientbanques']))) {
                    $this->loadModel('clientbanques');
                    // debug(($this->request->getData('data')));


                    foreach ($this->request->getData('data')['clientbanques'] as $i => $banque) {
                        if ($banque['sup1'] != 1) {
                            $data['banque_id'] = $banque['banque_id'];
                            $data['client_id'] = $client_id;
                            $data['compte'] = $banque['compte'];
                            $data['rib'] = $banque['rib'];
                            $data['document'] = $banque['document'];
                        }
                        //debug($data);


                        $clientbanque = $this->fetchTable('clientbanques')->newEmptyEntity();
                        //debug($clientresponsable);
                        //$this->adresselivraisonclient->create();
                        //$this->adresselivraisonclient->save($data);
                        $clientbanque = $this->clientbanques->patchEntity($clientbanque, $data);
                        //debug($clientresponsable);
                        if ($this->clientbanques->save($clientbanque)) {

                            $this->Flash->success("clientbanque has been created successfully");
                        } else {


                            $this->Flash->error("Failed to create cclientbanque");
                        }


                        $this->set(compact("clientbanque"));
                    }
                }



                if (isset($this->request->getData('data')['tabligne2']) && (!empty($this->request->getData('data')['tabligne2']))) {
                    $this->loadModel('clientexonerations');
                    // debug(($this->request->getData('data')));


                    foreach ($this->request->getData('data')['tabligne2'] as $i => $exon) {

                        if ($exon['sup2'] != 1) {
                            $datee['typeexon_id'] = $exon['typeexon_id'];
                            $datee['date_debut'] = $exon['date_debut'];
                            $datee['num_att_taxes'] = $exon['num_att_taxes'];
                            $datee['date_fin'] = $exon['date_fin'];
                            $datee['document'] = $exon['document'];

                            $datee['client_id'] = $client_id;
                            //debug($datee);
                            //debug($data);
                        }

                        $clientexoneration = $this->fetchTable('clientexonerations')->newEmptyEntity();
                        //debug($clientexoneration);
                        //$this->adresselivraisonclient->create();
                        //$this->adresselivraisonclient->save($data);
                        $clientexoneration = $this->clientexonerations->patchEntity($clientexoneration, $datee);
                        // debug($clientexoneration);
                        if ($this->clientexonerations->save($clientexoneration)) {

                            $this->Flash->success("clientexoneration has been created successfully");
                        } else {


                            $this->Flash->error("Failed to create clientexoneration");
                        }


                        $this->set(compact("clientexoneration"));
                    }
                }




                if ($this->request->getData('typeR') == 'pourcentage') {
                    if (isset($this->request->getData('data')['fourchettes']) && (!empty($this->request->getData('data')['fourchettes']))) {
                        $this->loadModel('fourchettes');
                        //debug(($this->request->getData('data')));


                        foreach ($this->request->getData('data')['fourchettes'] as $i => $fouchette) {
                            if ($fouchette['sup5'] != 1) {
                                $dataa['article_id'] = $fouchette['article_id'];
                                $dataa['client_id'] = $client_id;
                                $dataa['fourche_id'] = $fouchette['fourche_id'];
                                $dataa['valeur'] = $fouchette['valeur'];

                                // debug($dataa);
                            }
                            $fourchette = $this->fetchTable('fourchettes')->newEmptyEntity();
                            //debug($clientresponsable);
                            //$this->adresselivraisonclient->create();
                            //$this->adresselivraisonclient->save($data);
                            $fourchette = $this->fourchettes->patchEntity($fourchette, $dataa);
                            //debug($fourchette);
                            if ($this->fourchettes->save($fourchette)) {

                                $this->Flash->success("fourchette has been created successfully");
                            } else {


                                $this->Flash->error("Failed to create fourchette");
                            }


                            $this->set(compact("fourchette"));
                        }
                    }
                }
                if (
                    $this->request->getData('typeR') == 'objectif'
                ) {



                    if (isset($this->request->getData('data')['fourchehts']) && (!empty($this->request->getData('data')['fourchehts']))) {
                        $this->loadModel('clientfourchettes');
                        //debug(($this->request->getData('data')));


                        $f = $this->request->getData('data')['fourchehts'];

                        $daataa['horst'] = $f['ht'];
                        $daataa['client_id'] = $client_id;
                        $daataa['valeur'] = $f['valeur'];

                        // debug($dataa);

                        $clientfourchette = $this->fetchTable('clientfourchettes')->newEmptyEntity();
                        //debug($clientresponsable);
                        //$this->adresselivraisonclient->create();
                        //$this->adresselivraisonclient->save($data);
                        $clientfourchette = $this->clientfourchettes->patchEntity($clientfourchette, $daataa);
                        //debug($fourchette);
                        if ($this->clientfourchettes->save($clientfourchette)) {

                            $this->Flash->success("clientfourchettes has been created successfully");
                        } else {


                            $this->Flash->error("Failed to create clientfourchettes");
                        }


                        $this->set(compact("clientfourchette"));
                    }
                }











                /*
                    if ($this->fetchTable('adresselivraisonclients')->save($data)) {
                        //debug($adresselivraisonclient);
                        $this->Flash->success(__('The {0} has been saved.', 'adresselivraisonclient'));
                    }*//* else {
                    debug($this->request->getData('data')['adresselivraisonclients']);
                    die;
                }
*/

                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The client could not be saved. Please, try again.'));
            }
        }
        //$adresses = $this->Clients->adresselivraisonclients->find('list', ['limit' => 200]);

        $typeutilisateurs = $this->Clients->Typeutilisateurs->find('list', ['limit' => 200])->all();
        $villes = $this->Clients->Villes->find('list', ['limit' => 200])->all();
        $regions = $this->Clients->Regions->find('list', ['limit' => 200])->all();
        $pays = $this->Clients->Pays->find('list', ['limit' => 200])->all();
        $activites = $this->Clients->Activites->find('list', ['limit' => 200])->all();
        $paiements = $this->Clients->Paiements->find('list', ['limit' => 200])->all();
        $typer = array(
            'objectif' => 'objectif',
            'pourcentage' => 'pourcentage'

        );
        $exo = array(
            '0' => 'exonorÃ©',
            '1' => 'non exonorÃ©'


        );
        $this->loadModel('banques');

        $banques = $this->banques->find('list');
        $this->loadModel('typeexons');
        $typeexons = $this->typeexons->find('list');
        $this->loadModel('articles');

        $articles = $this->articles->find('list');
        $this->loadModel('fourches');

        $fourches = $this->fourches->find('list');


        // $pays=$this->Clients->villes->pays->find('list',array('fields'=>array('pay.id','pay.nom')));
        //$villes=$this->Clients->villes->find('list',array('fields'=>array('State.id','State.stateName')));
        //$paiement_id= $this->Clients->Paiements->find('list', ['limit' => 200]);
        //(pay)$countries=$this->Address->City->State->Country->find('list',array('fields'=>array('Country.id','Country.countryName')));

        $this->set(compact(
            // 'adresselivraisonclient',
            'client',
            'typeutilisateurs',
            'villes',
            'regions',
            'pays',
            'activites',
            'paiements',
            'typer',
            'banques',
            'exo',
            'typeexons',
            'articles',
            'fourches'

        ));
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
        $client = $this->Clients->get($id, [
            'contain' => ['Adresselivraisonclients', 'Clientresponsables', 'Clientbanques', 'Clientexonerations'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData());

            $client = $this->Clients->patchEntity($client, $this->request->getData(), ['associated' => ['Adresselivraisonclients' => ['validate' => false]]]);

            if ($this->Clients->save($client)) {
                //$client_id = $client->id;

                if (isset($this->request->getData('data')['adresselivraisonclients']) && (!empty($this->request->getData('data')['adresselivraisonclients']))) {

                    // debug($this->request->getData('data')['adresselivraisonclients']);

                    foreach ($this->request->getData('data')['adresselivraisonclients'] as $i => $adresseliv) {
                        //debug($adresseliv);
                        //die;

                        if ($adresseliv['sup'] != 1) {
                            $data['adresse'] = $adresseliv['adresse'];
                            $data['client_id'] = $id;

                            //
                            //debug($adresseliv['id']);
                            if (isset($adresseliv['id']) && (!empty($adresseliv['id']))) {

                                $adresselivraisonclient = $this->fetchTable('adresselivraisonclients')->get($adresseliv['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $adresselivraisonclient = $this->fetchTable('adresselivraisonclients')->newEmptyEntity();
                            };


                            //debug($adresselivraisonclient);

                            $adresselivraisonclient = $this->fetchTable('adresselivraisonclients')->patchEntity($adresselivraisonclient, $data);
                            // debug($adresselivraisonclient);

                            if ($this->fetchTable('adresselivraisonclients')->save($adresselivraisonclient)) {
                                // debug($adresselivraisonclient);
                                $this->Flash->success("adresselivraisonclient has been òodified successfully");
                            } else {


                                $this->Flash->error("Failed to midify adresselivraisonclient");
                            }
                        }

                        $this->set(compact("adresselivraisonclient"));
                    }
                }



                if (isset($this->request->getData('data')['clientresponsables']) && (!empty($this->request->getData('data')['clientresponsables']))) {
                    //debug($this->request->getData('data')['clientresponsables']);
                    foreach ($this->request->getData('data')['clientresponsables'] as $i => $res) {
                        //debug($res);
                        // die;

                        if ($res['sup0'] != 1) {
                            $dat['name'] = $res['name'];
                            $dat['tel'] = $res['tel'];
                            $dat['mail'] = $res['mail'];
                            $dat['poste'] = $res['poste'];

                            $dat['client_id'] = $id;
                            //debug($dat);
                            if (isset($res['id']) && (!empty($res['id']))) {

                                $clientresponsable = $this->fetchTable('clientresponsables')->get($res['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientresponsable = $this->fetchTable('clientresponsables')->newEmptyEntity();
                            };



                            $clientresponsable = $this->fetchTable('clientresponsables')->patchEntity($clientresponsable, $dat);
                            //debug($clientresponsable);

                            if ($this->fetchTable('clientresponsables')->save($clientresponsable)) {
                                // debug($clientresponsable);
                                $this->Flash->success("clientresponsable has been òodified successfully");
                            } else {


                                $this->Flash->error("Failed to midify clientresponsable");
                            }
                        }

                        $this->set(compact("clientresponsable"));
                    }
                }



                if (isset($this->request->getData('data')['clientbanques']) && (!empty($this->request->getData('data')['clientbanques']))) {
                    //debug($this->request->getData('data')['clientbanques']);
                    foreach ($this->request->getData('data')['clientbanques'] as $i => $banque) {
                        //debug($res);
                        // die;

                        if ($banque['sup1'] != 1) {
                            $datee['bnaque_id'] = $banque['banque_id'];
                            $datee['compte'] = $banque['compte'];
                            $datee['rib'] = $banque['rib'];
                            $datee['document'] = $banque['document'];

                            $datee['client_id'] = $id;
                            //debug($dat);
                            if (isset($banque['id']) && (!empty($banque['id']))) {

                                $clientbanque = $this->fetchTable('clientbanques')->get($banque['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientbanque = $this->fetchTable('clientbanques')->newEmptyEntity();
                            };



                            $clientbanque = $this->fetchTable('clientbanques')->patchEntity($clientbanque, $datee);
                            //debug($clientresponsable);

                            if ($this->fetchTable('clientbanques')->save($clientbanque)) {
                                // debug($clientresponsable);
                                $this->Flash->success("clientbanque has been modified successfully");
                            } else {


                                $this->Flash->error("Failed to modify clientbanque");
                            }
                        }

                        $this->set(compact("clientbanque"));
                    }
                }






                if (isset($this->request->getData('data')['tabligne2']) && (!empty($this->request->getData('data')['tabligne2']))) {
                    //debug($this->request->getData('data')['tabligne2']);
                    foreach ($this->request->getData('data')['tabligne2'] as $i => $exon) {
                        //debug($exon);
                        // die;
                        // $this->loadModel('clientexonerations');


                        if ($exon['sup2'] != 1) {
                            $dateee['typeexon_id'] = $exon['typeexon_id'];
                            $dateee['date_debut'] = $exon['date_debut'];
                            $dateee['date_fin'] = $exon['date_fin'];
                            $dateee['num_att_taxes'] = $exon['num_att_taxes'];
                            $dateee['document'] = $exon['document'];

                            $dateee['client_id'] = $id;
                            //debug($dateee);
                            if (isset($exon['id']) && (!empty($exon['id']))) {

                                $clientexoneration = $this->fetchTable('clientexonerations')->get($exon['id'], [
                                    'contain' => []
                                ]);
                                //debug($clientexoneration);
                            } else {

                                $clientexoneration = $this->fetchTable('clientexonerations')->newEmptyEntity();
                                //debug($clientexoneration);
                            };


                            //debug($clientexoneration);
                            $clientexoneration = $this->fetchTable('clientexonerations')->patchEntity($clientexoneration, $dateee);
                            //debug($clientexoneration);

                            if ($this->fetchTable('clientexonerations')->save($clientexoneration)) {
                                //debug($clientexoneration);
                                $this->Flash->success("clientexoneration has been modified successfully");
                            } else {


                                $this->Flash->error("Failed to modify clientexonerations");
                            }
                        }

                        $this->set(compact("clientexoneration"));
                    }
                }




                if (isset($this->request->getData('data')['fourchettes']) && (!empty($this->request->getData('data')['fourchettes']))) {
                    //debug($this->request->getData('data')['clientresponsables']);
                    foreach ($this->request->getData('data')['fourchettes'] as $i => $fou) {
                        //debug($fou);
                        // die;

                        if ($fou['sup5'] != 1) {
                            $datt['article_id'] = $fou['article_id'];
                            $datt['fourche_id'] = $fou['fourche_id'];
                            $datt['valeur'] = $fou['valeur'];

                            $datt['client_id'] = $id;
                            //debug($datt);
                            if (isset($fou['id']) && (!empty($fou['id']))) {

                                $fourchette = $this->fetchTable('fourchettes')->get($fou['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $fourchette = $this->fetchTable('fourchettes')->newEmptyEntity();
                            };



                            $fourchette = $this->fetchTable('fourchettes')->patchEntity($fourchette, $datt);
                            //debug($clientresponsable);

                            if ($this->fetchTable('fourchettes')->save($fourchette)) {
                                // debug($clientresponsable);
                                $this->Flash->success("fourchette has been òodified successfully");
                            } else {


                                $this->Flash->error("Failed to midify fourchette");
                            }
                        }

                        $this->set(compact("fourchette"));
                    }
                }


                /*

                if (isset($this->request->getData('data')['fourchehts']) && (!empty($this->request->getData('data')['fourchehts']))) {
                    //debug($this->request->getData('data')['clientresponsables']);
                    foreach ($this->request->getData('data')['fourchehts'] as $i => $fourcheht) {
                        //debug($res);
                        // die;

                        if ($fou['sup5'] != 1) {
                            $daatt['ht'] = $fourcheht['ht'];
                            $daatt['valeur'] = $fourcheht['valeur'];

                            $daatt['client_id'] = $id;
                            //debug($dat);
                            if (isset($fourcheht['id']) && (!empty($fourcheht['id']))) {

                                $fourchette = $this->fetchTable('fourchettes')->get($fourcheht['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $fourchette = $this->fetchTable('fourchettes')->newEmptyEntity();
                            };



                            $fourchette = $this->fetchTable('fourchettes')->patchEntity($fourchette, $datt);
                            //debug($clientresponsable);

                            if ($this->fetchTable('fourchettes')->save($fourchette)) {
                                // debug($clientresponsable);
                                $this->Flash->success("fourchette has been òodified successfully");
                            } else {


                                $this->Flash->error("Failed to midify fourchette");
                            }
                        }

                        $this->set(compact("fourchette"));
                    }
                }
*/
            }
            $this->Flash->success("client has been modified successfully");
        }





        $typeutilisateurs = $this->Clients->Typeutilisateurs->find('list', ['limit' => 200])->all();
        $villes = $this->Clients->Villes->find('list', ['limit' => 200])->all();
        $regions = $this->Clients->Regions->find('list', ['limit' => 200])->all();
        $pays = $this->Clients->Pays->find('list', ['limit' => 200])->all();
        $activites = $this->Clients->Activites->find('list', ['limit' => 200])->all();
        $paiements = $this->Clients->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'typepaiement_id']);
        //$categories = $this->Articles->Categories->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        //$adressees = $this->Adresselivraisonclient->find('all',array('conditions'=>array('Adresselivraisonclient.client_id'=>$id)));
        $this->loadModel('Adresselivraisonclients');
        $this->loadModel('Clientresponsables');
        $this->loadModel('Clientbanques');
        $this->loadModel('clientexonerations');
        $this->loadModel('fourchettes');

        $this->loadModel('banques');

        $banquesoptions = $this->banques->find('list');
        $this->loadModel('typeexons');
        $typeexons = $this->typeexons->find('list');
        $this->loadModel('articles');

        $articles = $this->articles->find('list');
        $this->loadModel('fourches');

        $fourches = $this->fourches->find('list');

        //debug($banquesoptions);
        $adressees = $this->Adresselivraisonclients->find('all', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Adresselivraisonclients.client_id like  '%" . $id . "%' "]);
        $responsable = $this->Clientresponsables->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientresponsables.client_id like  '%" . $id . "%' "]);
        $banques = $this->Clientbanques->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientbanques.client_id like  '%" . $id . "%' "]);
        $exonerations = $this->clientexonerations->find('all')->where(["clientexonerations.client_id like  '%" . $id . "%' "]);
        $fourchettes = $this->fourchettes->find('all')->where(["fourchettes.client_id like  '%" . $id . "%' "]);

        // $adressees = $this->paginate($adressees);
        // debug($adressees);
        // die;
        $this->set(compact('fourches', 'articles', 'fourchettes', 'typeexons', 'exonerations', 'banquesoptions', 'banques', 'responsable', 'adressees', 'client', 'typeutilisateurs', 'villes', 'regions', 'pays', 'activites', 'paiements'));
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





    public function imprimerrecherche()
    {
        /*
        $cond0 = '';
        $cond1 = '';
        $cond2 = '';
        $cond4 = '';
        $cond5 = '';
        $name = $this->request->getQuery('name');

        $compteComptable = $this->request->getQuery('comptecomptable');
        $typeutilisateur_id = $this->request->getQuery('typeutilisateur_id');
        $paiement = $this->request->getQuery('paiement_id');

        if ($name) {
            $cond0 = "Clients.name like  '%" . $name . "%' ";
        }
        if ($compteComptable) {
            $cond1 = "Clients.comptecomptable  like  '%" . $compteComptable . "%' ";
        }
        if ($typeutilisateur_id) {
            $cond2 = "Clients.typeutilisateur_id  like  '%" . $typeutilisateur_id . "%' ";
        }


        if ($paiement) {
            $cond4 = "Clients.paiement_id   like  '%" . $paiement . "%' ";
        }
        $query = $this->Clients->find('all')->where([$cond0, $cond1, $cond2,  $cond4]);

        $this->paginate = [
            'contain' => ['Typeutilisateurs', 'Villes', 'Regions', 'Pays', 'Activites', 'Paiements'],
        ];


        $clientsss = $this->paginate($query);
        debug($clientsss);
        $this->set(compact('clientsss'));*/

        $cin = $this->request->getQuery('cin');
        $compteComptable = $this->request->getQuery('comptecomptable');
        $passeport = $this->request->getQuery('passeport');
        $typeutilisateur_id = $this->request->getQuery('typeutilisateur_id');
        $cartesejour = $this->request->getQuery('cartesejour');
        $paiement = $this->request->getQuery('paiement_id');
        $matriculefiscale = $this->request->getQuery('Matriculefiscale');
        $name = $this->request->getQuery('name');


        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        //if($nom ){
        //$query=$this->Fournisseurs->find('all')->where(['Or'=>['nom like'=>'%'.$nom.'%']]);
        //debug($query);
        //}else{
        //$query=$this->Fournisseurs;}
        if ($name) {
            $cond1 = 'Clients.name="' . $name . '"';
        }
        if ($typeutilisateur_id) {
            $cond3 = 'Clients.Typeutilisateur_id="' . $typeutilisateur_id . '"';
        }
        if ($cin) {
            $cond4 = 'Clients.cin="' . $cin . '"';
        }
        if ($compteComptable) {
            $cond2 = 'Clients.comptecomptable="' . $compteComptable . '"';
        }
        if ($paiement) {
            $cond5 = 'Clients.paiement_id="' . $paiement . '"';
        }
        if ($cartesejour) {
            $cond6 = 'Clients.cartesejour="' . $cartesejour . '"';
        }
        if ($matriculefiscale) {
            $cond6 = 'Clients.matriculefiscale="' . $matriculefiscale . '"';
        }
        if ($passeport) {
            $cond7 = 'Clients.passeport="' . $passeport . '"';
        }
        //debug($name);

        $query = $this->Clients->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7]);
        $this->paginate = [
            'contain' => ['Typeutilisateurs', 'Villes', 'Regions', 'Pays', 'Activites', 'Paiements'],
        ];
        //debug($query);
        $clientsss = $this->paginate($query);
        //debug($clientsss);
        $this->set(compact('clientsss'));
    }
}

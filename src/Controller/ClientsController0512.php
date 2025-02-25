<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function view($id = null) {
        $this->loadModel('Clientarticles');
        //debug($this->request->getData());
        $client = $this->Clients->get($id, [
            'contain' => [],
        ]);
        // debug($this->request->getData());
        if ($this->request->is(['patch', 'post', 'put'])) {


            //debug($this->request->getData('client_id'));
//            $c = $this->Clients->get($this->request->getData('client_id'), [
//                'contain' => [],
//            ]);
//            
//            
//            
//            $c->etat = 'TRUE';
//            $this->Clients->save($c);
//
//
            // debug($this->request->getData());
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($client->nouveau_client == 'TRUE') {
                $client->client_id = 0;
                $client->nouveau_client == 'TRUE';
            }



            if ($this->Clients->save($client)) {
                //debug($client);die;
                $this->misejour("Clients", "edit", $id);
                if (isset($this->request->getData('data')['prixarticle']) && (!empty($this->request->getData('data')['prixarticle']))) {
                    foreach ($this->request->getData('data')['prixarticle'] as $j => $p) {

                        //die;

                        if ($p['supprix'] != 1) {


                            $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
                            $data['article_id'] = $p['article_id'];
                            $data['prix'] = $p['prix'];
                            $data['client_id'] = $id;

                            // debug($data);
                            //    debug($p);
                            if (isset($p['id']) && (!empty($p['id']))) {

                                $clientarticle = $this->fetchTable('Clientarticles')->get($p['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
                            };
                            $clientarticle = $this->fetchTable('Clientarticles')->patchEntity($clientarticle, $data);
                            $this->fetchTable('Clientarticles')->save($clientarticle);
                        } else if ($p['supprix'] == 1 && !empty($p['id'])) {

                            $clientarticle = $this->fetchTable('Clientarticles')->get($p['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientarticles')->delete($clientarticle);
                        }
                    }
                }







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
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientbanque = $this->fetchTable('Clientbanques')->newEmptyEntity();
                            };

                            $datee['banque_id'] = $b['banque_id'];
                            $datee['agence'] = $b['agence'];
                            $datee['code_banque'] = $b['code_banque'];
                            $datee['swift'] = $b['swift'];
                            $datee['compte'] = $b['compte'];
                            $datee['rib'] = $b['rib'];
                            $datee['client_id'] = $id;
                            $document = $b['documen'];
                            $name = $document->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($name)) {
                                $document->moveTo($targetPath);
                                $clientbanque->document = $name;
                            }


                            //debug($dat);

                            $clientbanque = $this->fetchTable('Clientbanques')->patchEntity($clientbanque, $datee);


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
                        // debug($b['tel']);


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



                            $this->fetchTable('Clientresponsables')->save($clientresponsable);
//                            debug($clientresponsable);die;
                        } else if ($b['supresponsable'] == 1 && !empty($b['id'])) {
                            $clientresponsable = $this->fetchTable('Clientresponsables')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientresponsables')->delete($clientresponsable);
                        }
                    }
                }


                


                if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {
                    foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
                        //debug($exon);
                        $this->loadModel('Clientexonerations');



                        if ($exon['sup2'] != 1) {
                            if (isset($exon['id']) && (!empty($exon['id']))) {
                                //debug("old");
                                $exonerations = $this->fetchTable('Clientexonerations')->get($exon['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                //debug("new");
                                $exonerations = $this->fetchTable('Clientexonerations')->newEmptyEntity();
                            };
                            $data2['typeexon_id'] = $exon['typeexon_id'];
                            $data2['num_att_taxes'] = $exon['num_att_taxes'];
                            $data2['date_debut'] = $exon['date_debut'];
                            $data2['date_fin'] = $exon['date_fin'];
                            $data2['client_id'] = $id;
                            //debug($data2);die;

                            $document = $exon['documenttt'];
                            //  debug($document);

                            $name = $document->getClientFilename();
                            //debug($name);

                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($name)) {
                                $document->moveTo($targetPath);
                                $exonerations->document = $name;
                            }
                            // debug($data2);

                            $exonerations = $this->fetchTable('Clientexonerations')->patchEntity($exonerations, $data2);

                            $this->fetchTable('Clientexonerations')->save($exonerations);
                        } else if ($exon['sup2'] == 1 && !empty($exon['id'])) {
                            $exonerations = $this->fetchTable('Clientexonerations')->get($exon['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientexonerations')->delete($exonerations);
                        }
                    }
                }
                $this->set(compact('exonerations'));

                //$this->Flash->success(__('The client has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            //   $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }



        $this->loadModel('Tarifs');
        $this->loadModel('Articles');
        $this->loadModel('Clientexonerations');
        $this->loadModel('Articles');
        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
        $dett = '0';
        foreach ($fam as $f) {
            //debug($f); //die;
            $dett = $dett . ',' . $f->id;
        }
        // $dett=implode(',',$fam);
        //debug($dett); //die;
        if ($dett != '') {
            $cond100 = 'Articles.famille_id in (' . $dett . ')';
        }

        //$articless = $this->Tarifs->Articles->find('all')->where([$cond100]);
        $articless = $this->Tarifs->Articles->find('all')->where(["Articles.vente=1"]);


        //$ar = array();
        // $i=0;
        /* foreach ($articles as $ar) {

          $ar = $articles;
          } */
        //debug($ar);
        $typeexonerations[1] = 'exonore';
        $typeexonerations[2] = 'non exonore';
        $adressees = $this->fetchTable('Adresselivraisonclients')->find('all', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(["Adresselivraisonclients.client_id =  '" . $id . "' "]);
        $responsable = $this->fetchTable('Clientresponsables')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientresponsables.client_id =  '" . $id . "' "]);
        $banquess = $this->fetchTable('Clientbanques')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientbanques.client_id = " . $id . ""]);
        $exoclients = $this->fetchTable('Clientexonerations')->find('all', ['keyfield' => 'id'])->where(["Clientexonerations.client_id = " . $id . ""]);
        ;
        $gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $this->loadModel('Basepostes');
        $this->loadModel('Delegations');
        $this->loadModel('Localites');

        $del = $this->Basepostes->find()->select(["id_deleg" => '(Basepostes.id_deleg)'])->where(['id_gouv  ="' . $client['gouvernorat_id'] . '"']);
        $i = 0;
        $tab = array();
        foreach ($del as $i => $tab) {
            $tab = $del;
        }
        //debug($tab);
//        $deleg=$this->Delegations->find()->select(['Delegations.name'])
//                ->where(['Delegations.id  in (' . $tab . ')']);
        if ($tab != array()) {
            $deleg = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                    ->where(['Delegations.id  in (' . $tab . ')']);
        } else {
            $deleg = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
            ;
        }



        // debug($deleg) ;    

        $loc = $this->Basepostes->find()->select(["id_loc" => '(Basepostes.id_loc)'])->where(['id_deleg  ="' . $client['delegation_id'] . '"']);
        $j = 0;
        $tab1 = array();
        foreach ($loc as $j => $tab1) {
            $tab1 = $loc;
        }
        if ($tab1 != array()) {
            $localite = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                    ->where(['Localites.id  in (' . $tab1 . ')']);
        } else {
            $localite = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        }


        $clientdoc = $this->fetchTable('Clientdocuments')->find('all')
        ->where(["Clientdocuments.client_id = " . $id . ""]);





        $exoner = $this->Clientexonerations->find('all')->where(["Clientexonerations.client_id = " . $id . ""]);
        $this->loadModel('Clientarticles');
        $clientarticles = $this->Clientarticles->find('all')->where(["Clientarticles.client_id = " . $id . ""]);
        //debug($clientarticles);
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        //$gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();

        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        //$typeexonerations = $this->fetchTable('Typeexonerations')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();

        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
        $this->loadModel('Typeexons');

        $type = $this->fetchTable('Typeexons')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $cli = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        // ->where(["Clients.etat " => 'TRUE'])
        // ->where(['Clients.nouveau_client="FALSE"']);

        $bureaupostes = $this->fetchTable('Bureaupostes')->find('list', ['valueField' => 'codepostal'])->where(["Bureaupostes.gouvernorat_id = " . $client->gouvernorat_id . ""])
        ;
        // debug($bureaupostes);
        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        $this->set(compact(  'clientdoc'  , 'articless', 'bureaupostes', 'cli', 'ar', 'localite', 'deleg', 'gouvernorats', 'type', 'tab', 'articles', 'clientarticles', 'exoner', 'gouvernorats', 'pointdeventes', 'typeclients', 'client', 'commercials', 'gouvernorats', 'typeexonerations', 'paiements', 'adressees', 'responsable', 'banquess', 'banques'));
    }

    public function index() {
        $Gouvernoratoptions = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($Gouvernoratoptions);
        $Code_Socit = $this->request->getQuery('Code_Socit');
        $Code = $this->request->getQuery('Code');
        $Raison_Sociale = $this->request->getQuery('Raison_Sociale');
        $Matricule_Fiscale = $this->request->getQuery('Matricule_Fiscale');
        $Gouvernorat_id = $this->request->getQuery('Gouvernorat_id');
        $Autorisation_Livraison = $this->request->getQuery('Autorisation_Livraison');
        $etat_id = $this->request->getQuery('etat_id');
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond88 = '';

        if ($Code_Socit) {
            // $cond1 = 'Clients.Code_Socit="' . $Code_Socit . '"';
            $cond1 = 'Clients.Code_Socit like' . "'%" . $Code_Socit . "%'";
        }
        if ($Code) {
            // $cond2 = 'Clients.Code="' . $Code . '"';
            $cond2 = 'Clients.Code like' . "'%" . $Code . "%'";
        }
        if ($Raison_Sociale) {
            //$cond3 = 'Clients.Raison_Sociale="' . $Raison_Sociale . '"';
            $cond3 = 'Clients.Raison_Sociale like' . "'%" . $Raison_Sociale . "%'";
        }
        if ($Matricule_Fiscale) {
            // $cond4 = 'Clients.Matricule_Fiscale="' . $Matricule_Fiscale . '"';
            $cond4 = 'Clients.Matricule_Fiscale like' . "'%" . $Matricule_Fiscale . "%'";
        }
        if ($Gouvernorat_id) {
            $cond5 = 'Clients.gouvernorat_id ="' . $Gouvernorat_id . '"';
        }
        if ($Autorisation_Livraison) {
            $cond6 = 'Clients.Autorisation_Livraison ="' . $Autorisation_Livraison . '"';
        }
        if ($etat_id) {
            $cond88 = 'Clients.etat ="' . $etat_id . '"';
            //debug($cond88);die;
        }
        $query = $this->Clients->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond88]);
        //   debug($query);die;
        $this->paginate = [
            'contain' => ['Commercials', 'Gouvernorats'], 'order' => ['left(Clients.Code,1),cast(right(Clients.Code,length(Clients.Code)-1) as Unsigned)', 'id' => 'ASC']
        ];
        $clients = $this->paginate($query);
        $etats['FALSE'] = 'Non actif';
        $etats['TRUE'] = 'Actif';


        $this->set(compact('etats', 'clients', 'Gouvernoratoptions'));
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
//    public function view($id = null) {
//        $this->loadModel('Clientarticles');
//        //debug($this->request->getData());
//        $client = $this->Clients->get($id, [
//            'contain' => [],
//        ]);
//
//        if ($this->request->is(['patch', 'post', 'put'])) {
//
//            $client = $this->Clients->patchEntity($client, $this->request->getData());
//
//            if ($this->Clients->save($client)) {
//                //debug($this->request->getData());die;
//                $this->misejour("Clients", "edit", $id);
//
//                if (isset($this->request->getData('data')['prixarticle']) && (!empty($this->request->getData('data')['prixarticle']))) {
//                    foreach ($this->request->getData('data')['prixarticle'] as $j => $p) {
//
//                        //die;
//
//                        if ($p['supprix'] != 1) {
//
//
//                            $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
//                            $data['article_id'] = $p['article_id'];
//                            $data['prix'] = $p['prix'];
//                            $data['client_id'] = $id;
//
//                            // debug($data);
//                            //    debug($p);
//                            if (isset($p['id']) && (!empty($p['id']))) {
//
//                                $clientarticle = $this->fetchTable('Clientarticles')->get($p['id'], [
//                                    'contain' => []
//                                ]);
//                            } else {
//                                $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
//                            };
//                            $clientarticle = $this->fetchTable('Clientarticles')->patchEntity($clientarticle, $data);
//                            $this->fetchTable('Clientarticles')->save($clientarticle);
//                        } else if ($p['supprix'] == 1 && !empty($p['id'])) {
//
//                            $clientarticle = $this->fetchTable('Clientarticles')->get($p['id'], [
//                                'contain' => []
//                            ]);
//                            $this->fetchTable('Clientarticles')->delete($clientarticle);
//                        }
//                    }
//                }
//
//
//
//
//
//
//
//                if (isset($this->request->getData('data')['adresse']) && (!empty($this->request->getData('data')['adresse']))) {
//                    foreach ($this->request->getData('data')['adresse'] as $i => $b) {
//
//
//                        if ($b['supadresse'] != 1) {
//
//
//                            $adresseliv = $this->fetchTable('Adresselivraisonclients')->newEmptyEntity();
//                            $data['adresse'] = $b['adresse'];
//                            $data['client_id'] = $id;
//
//                            //debug($dat);
//                            if (isset($b['id']) && (!empty($b['id']))) {
//
//                                $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->get($b['id'], [
//                                    'contain' => []
//                                ]);
//                            } else {
//                                $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->newEmptyEntity();
//                            };
//                            $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->patchEntity($adresselivraisonclient, $data);
//
//
//                            $this->fetchTable('Adresselivraisonclients')->save($adresselivraisonclient);
//                        } else if ($b['supadresse'] == 1 && !empty($b['id'])) {
//                            $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->get($b['id'], [
//                                'contain' => []
//                            ]);
//                            $this->fetchTable('Adresselivraisonclients')->delete($adresselivraisonclient);
//                        }
//                    }
//                }
//
//
//
//
//
//                if (isset($this->request->getData('data')['banque']) && (!empty($this->request->getData('data')['banque']))) {
//                    foreach ($this->request->getData('data')['banque'] as $i => $b) {
//                        // debug($b);die;
//
//                        if ($b['supbanque'] != 1) {
//
//
//                            $datee['banque_id'] = $b['banque_id'];
//                            $datee['agence'] = $b['agence'];
//                            $datee['code_banque'] = $b['code_banque'];
//                            $datee['swift'] = $b['swift'];
//                            $datee['compte'] = $b['compte'];
//                            $datee['rib'] = $b['rib'];
//                            $datee['client_id'] = $id;
//                            $document = $b['documen'];
//                            $name = $document->getClientFilename();
//                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
//                            if (!empty($name)) {
//                                $document->moveTo($targetPath);
//                                $clientbanque->document = $name;
//                            }
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//                            //debug($dat);
//                            if (isset($b['id']) && (!empty($b['id']))) {
//
//                                $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
//                                    'contain' => []
//                                ]);
//                            } else {
//                                $clientbanque = $this->fetchTable('Clientbanques')->newEmptyEntity();
//                            };
//                            $clientbanque = $this->fetchTable('Clientbanques')->patchEntity($clientbanque, $datee);
//
//
//                            $this->fetchTable('Clientbanques')->save($clientbanque);
//                        } else if ($b['supbanque'] == 1 && !empty($b['id'])) {
//                            $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
//                                'contain' => []
//                            ]);
//                            $this->fetchTable('Clientbanques')->delete($clientbanque);
//                        }
//                    }
//                }
//
//
//
//
//
//
//                if (isset($this->request->getData('data')['responsable']) && (!empty($this->request->getData('data')['responsable']))) {
//                    foreach ($this->request->getData('data')['responsable'] as $i => $b) {
//                        //debug($b);
//
//
//                        if ($b['supresponsable'] != 1) {
//
//
//
//
//
//
//
//
//                            $dataa['name'] = $b['name'];
//                            $dataa['mail'] = $b['mail'];
//                            $dataa['tel'] = $b['tel'];
//                            $dataa['poste'] = $b['poste'];
//                            $dataa['client_id'] = $client->id;
//
//                            //debug($dat);
//                            if (isset($b['id']) && (!empty($b['id']))) {
//
//                                $clientresponsable = $this->fetchTable('Clientresponsables')->get($b['id'], [
//                                    'contain' => []
//                                ]);
//                            } else {
//                                $clientresponsable = $this->fetchTable('Clientresponsables')->newEmptyEntity();
//                            };
//                            $clientresponsable = $this->fetchTable('Clientresponsables')->patchEntity($clientresponsable, $dataa);
//
//
//
//                            $this->fetchTable('Clientresponsables')->save($clientresponsable);
//                        } else if ($b['supresponsable'] == 1 && !empty($b['id'])) {
//                            $clientresponsable = $this->fetchTable('Clientresponsables')->get($b['id'], [
//                                'contain' => []
//                            ]);
//                            $this->fetchTable('Clientresponsables')->delete($clientresponsable);
//                        }
//                    }
//                }
//
//
//                if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {
//
//                    foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
//                        //debug($exon);
//                        $this->loadModel('Clientexonerations');
//                        if ($exon['sup2'] != 1) {
//                            $data2['typeexon_id'] = $exon['typeexon_id'];
//                            $data2['num_att_taxes'] = $exon['num_att_taxes'];
//                            $data2['date_debut'] = $exon['date_debut'];
//                            $data2['date_fin'] = $exon['date_fin'];
//                            $data2['client_id'] = $id;
//                            //debug($data2);die;
//
//                            $document = $exon['documenttt'];
//
//                            $name = $document->getClientFilename();
//
//                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
//                            if (!empty($name)) {
//                                $document->moveTo($targetPath);
//                                $exonerations->document = $name;
//                            }
//                            // debug($data2);
//                            if (isset($exon['id']) && (!empty($exon['id']))) {
//
//                                $exonerations = $this->fetchTable('Clientexonerations')->get($exon['id'], [
//                                    'contain' => []
//                                ]);
//                            } else {
//
//                                $exonerations = $this->fetchTable('Clientexonerations')->newEmptyEntity();
//                            };
//                            $exonerations = $this->fetchTable('Clientexonerations')->patchEntity($exonerations, $data2);
//                            //debug($exonerations);
//                            $this->fetchTable('Clientexonerations')->save($exonerations);
//                            //debug($exonerations);
//                        } else if ($exon['sup2'] == 1 && !empty($exon['id'])) {
//                            $exonerations = $this->fetchTable('Clientexonerations')->get($exon['id'], [
//                                'contain' => []
//                            ]);
//                            $this->fetchTable('Clientexonerations')->delete($exonerations);
//                        }
//                    }
//                }
//                $this->set(compact("exonerations"));
//
//                //$this->Flash->success(__('The client has been saved.'));
//                return $this->redirect(['action' => 'index']);
//            }
//
//            //   $this->Flash->error(__('The client could not be saved. Please, try again.'));
//        }
//
//
//
//        $this->loadModel('Tarifs');
//        $this->loadModel('Articles');
//        $this->loadModel('Clientexonerations');
//        $this->loadModel('Articles');
//        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
//        $dett = '0';
//        foreach ($fam as $f) {
//            //debug($f); //die;
//            $dett = $dett . ',' . $f->id;
//        }
//        // $dett=implode(',',$fam);
//        //debug($dett); //die;
//        if ($dett != '') {
//            $cond100 = 'Articles.famille_id in (' . $dett . ')';
//        }
//
//        $articles = $this->Tarifs->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])->where([$cond100]);
//
//
//
//        $ar = array();
//        // $i=0;
//        foreach ($articles as $ar) {
//
//            $ar = $articles;
//        }
//        $cli = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
//              //  ->where(['Clients.nouveau_client="FALSE"']);
//        $typeexonerations[1] = 'exonore';
//        $typeexonerations[2] = 'non exonore';
//        $adressees = $this->fetchTable('Adresselivraisonclients')->find('all', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(["Adresselivraisonclients.client_id =  '" . $id . "' "]);
//        $responsable = $this->fetchTable('Clientresponsables')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientresponsables.client_id =  '" . $id . "' "]);
//        $banquess = $this->fetchTable('Clientbanques')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientbanques.client_id = " . $id . ""]);
//        $exoclients = $this->fetchTable('Clientexonerations')->find('all', ['keyfield' => 'id'])->where(["Clientexonerations.client_id = " . $id . ""]);
//        ;
//        $gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
//        $this->loadModel('Basepostes');
//        $this->loadModel('Delegations');
//        $this->loadModel('Localites');
//
//        $del = $this->Basepostes->find()->select(["id_deleg" => '(Basepostes.id_deleg)'])->where(['id_gouv  ="' . $client['gouvernorat_id'] . '"']);
//        $i = 0;
//        $tab = array();
//        foreach ($del as $i => $tab) {
//            $tab = $del;
//        }
//        //debug($tab);
////        $deleg=$this->Delegations->find()->select(['Delegations.name'])
////                ->where(['Delegations.id  in (' . $tab . ')']);
//        if ($tab != array()) {
//            $deleg = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
//                    ->where(['Delegations.id  in (' . $tab . ')']);
//        } else {
//            $deleg = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
//            ;
//        }
//
//
//
//        // debug($deleg) ;    
//
//        $loc = $this->Basepostes->find()->select(["id_loc" => '(Basepostes.id_loc)'])->where(['id_deleg  ="' . $client['delegation_id'] . '"']);
//        $j = 0;
//        $tab1 = array();
//        foreach ($loc as $j => $tab1) {
//            $tab1 = $loc;
//        }
//        if ($tab1 != array()) {
//            $localite = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
//                    ->where(['Localites.id  in (' . $tab1 . ')']);
//        } else {
//            $localite = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
//        }
//
//
//
//
//
//
//        $exoner = $this->Clientexonerations->find('all')->where(["Clientexonerations.client_id = " . $id . ""]);
//        $this->loadModel('Clientarticles');
//        $clientarticles = $this->Clientarticles->find('all')->where(["Clientarticles.client_id = " . $id . ""]);
//        //debug($clientarticles);
//        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
//        //$gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
//
//        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
////        $typeexonerations = $this->fetchTable('Typeexonerations')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
//
//        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
//        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
//        $this->loadModel('Typeexons');
//
//        $type = $this->fetchTable('Typeexons')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
//
//        $bureaupostes = $this->fetchTable('Bureaupostes')->find('list', ['valueField' => 'codepostal'])->where(["Bureaupostes.gouvernorat_id = " . $client->gouvernorat_id . ""])
//        ;
//        // debug($bureaupostes);
//        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
//        $this->set(compact('bureaupostes', 'cli', 'ar', 'localite', 'deleg', 'gouvernorats', 'type', 'tab', 'articles', 'clientarticles', 'exoner', 'gouvernorats', 'pointdeventes', 'typeclients', 'client', 'commercials', 'gouvernorats', 'typeexonerations', 'paiements', 'adressees', 'responsable', 'banquess', 'banques'));
//    }
//    public function view($id = null) {
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        $client = $this->Clients->get($id, [
//            'contain' => ['Commercials', 'Gouvernorats', 'Adresselivraisonclients', 'Bondereservations', 'Bonlivraisons', 'Clientbanques', 'Clientexonerations', 'Clientfourchettes', 'Clientresponsables', 'Commandeclients', 'Factureclients', 'Fourchettes'],
//        ]);
//        $adressees = $this->fetchTable('Adresselivraisonclients')->find('all', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(["Adresselivraisonclients.client_id =  '" . $id . "' "]);
//        $responsable = $this->fetchTable('Clientresponsables')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientresponsables.client_id =  '" . $id . "' "]);
//        $banquess = $this->fetchTable('Clientbanques')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientbanques.client_id = " . $id . ""]);
//        //  debug($banquess);
//
//        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
//
//        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
//        $typeexonerations = $this->fetchTable('Typeexonerations')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
//
//        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
//        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
//
//
//        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
//        $gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'Description'])->all();
//        $this->set(compact('pointdeventes', 'typeclients', 'client', 'commercials', 'gouvernorats', 'typeexonerations', 'paiements', 'adressees', 'responsable', 'banquess', 'banques'));
//    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
                $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'clients') {
                $societe = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        //  $clients = $this->Clients->find()->last(); debug($clients);die;
        $this->loadModel('Typeexons');
        $this->loadModel('Delegations');
        $this->loadModel('Localites');
        $client = $this->Clients->newEmptyEntity();
        if ($this->request->is('post')) {
            //  debug($this->request->getData());
            //die;
//            $c = $this->Clients->get($this->request->getData('client_id'));
//            $c->etat = 'TRUE';
//            $this->Clients->save($c);
//debug($this->request->getData('data')['banque']);
            // debug($this->request->getData('data')['lignes']);die;
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            //debug($this->request->getData('data')['lignes']);die;
            if ($this->Clients->save($client)) {

                // debug($client);
                $this->misejour("Clients", "add", $client->id);
                $id = $client->id;
                if ($id < 10000) {
                    $id = '0' . $id;
                }

                $client->compte_comptable = '411' . $id;
                $this->Clients->save($client);
                //  debug($client);

                if (isset($this->request->getData('data')['prixarticle']) && (!empty($this->request->getData('data')['prixarticle']))) {
                    foreach ($this->request->getData('data')['prixarticle'] as $j => $p) {
                        // debug($p['prix']);die;
                        //die;

                        if ($p['supprix'] != 1) {
                            $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();

                            //debug($clientarticle);
                            $data['article_id'] = $p['article'];
                            $data['prix'] = $p['prix'];
                            $data['client_id'] = $id;
                            $clientarticle = $this->fetchTable('Clientarticles')->patchEntity($clientarticle, $data);

                            $this->fetchTable('Clientarticles')->save($clientarticle);
//                            debiug($clientarticle);
                            //die;
                        }
                    }
                }





                if (isset($this->request->getData('data')['banque']) && (!empty($this->request->getData('data')['banque']))) {
                    foreach ($this->request->getData('data')['banque'] as $i => $b) {
                        //  debug($b);
                        //die;
                        if ($b['supbanque'] != 1) {
                            $clientbanque = $this->fetchTable('Clientbanques')->newEmptyEntity();
                            $datee['banque_id'] = $b['banque_id'];
                            $datee['agence'] = $b['agence'];
                            $datee['code_banque'] = $b['code_banque'];
                            $datee['swift'] = $b['swift'];
                            $datee['compte'] = $b['compte'];
                            $datee['rib'] = $b['rib'];
                            $datee['client_id'] = $id;
                            $document = $b['documen'];
                            //   debug($document);
                            $namedoc = $document->getClientFilename();
                            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
                              mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775); */
                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . $namedoc;
//                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($namedoc)) {
                                $document->moveTo($targetPath);
                                $clientbanque->document = $namedoc;
                            }
                            // debug($namedoc);








                            $clientbanque = $this->fetchTable('Clientbanques')->patchEntity($clientbanque, $datee);


                            $this->fetchTable('Clientbanques')->save($clientbanque);
                            //debug($clientbanque);die;
                        }
                    }
                }



                if (isset($this->request->getData('data')['adresse']) && (!empty($this->request->getData('data')['adresse']))) {
                    foreach ($this->request->getData('data')['adresse'] as $i => $b) {


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
                        //  debug($b);


                        if ($b['supresponsable'] != 1) {


                            $clientresponsable = $this->fetchTable('Clientresponsables')->newEmptyEntity();
                            $dataa['name'] = $b['name'];
                            $dataa['mail'] = $b['mail'];
                            $dataa['tel'] = $b['télèphone'];
                            $dataa['poste'] = $b['poste'];
                            $dataa['client_id'] = $id;
                            $clientresponsable = $this->fetchTable('Clientresponsables')->patchEntity($clientresponsable, $dataa);
                            // debug($clientresponsable);die;

                            $this->fetchTable('Clientresponsables')->save($clientresponsable);
                        }
                    }
                }

                if (isset($this->request->getData('data')['document']) && (!empty($this->request->getData('data')['document']))) {
                    foreach ($this->request->getData('data')['document'] as $i => $doc) {
                         // debug($doc);
                        if ($doc['suprdoc'] != 1) {

                            $docclients = $this->fetchTable('Clientdocuments')->newEmptyEntity();
                            $dataa['name'] = $doc['name'];
                            $dataa['client_id'] = $id;
                            $document = $doc['fichier'];

                            $namedoc = $document->getClientFilename();
                            //debug($namedoc) ; 
                             $targetPath = WWW_ROOT . 'img' . DS . 'logo' . $namedoc;
                           
                            if (!empty($namedoc)) {
                                $document->moveTo($targetPath);
                                //debug($document) ; 
                                $docclients->fichier = $namedoc;
                              //  debug($docclients->fichier);
                            }


                            $docclients = $this->fetchTable('Clientdocuments')->patchEntity($docclients, $dataa);
                            //

                            $this->fetchTable('Clientdocuments')->save($docclients);
                          //  debug($docclients);
                        }
                    }
                }







                if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {
                    $this->loadModel('Clientexonerations');
                    // debug($this->request->getData('data')['lignes']);die;
                    foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
                        // debug($exon); die;
                        if ($exon['sup2'] != 1) {
                            $data2['typeexon_id'] = $exon['typeexon_id'];
                            $data2['num_att_taxes'] = $exon['num_att_taxes'];
                            $data2['date_debut'] = $exon['date_debut'];
                            $data2['date_fin'] = $exon['date_fin'];
                            $data2['client_id'] = $id;
                            $exonerations = $this->fetchTable('Clientexonerations')->newEmptyEntity();
                            $documenttt = $exon['documenttt'];
                            //   debug($document);
                            $namedoc = $documenttt->getClientFilename();
                            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
                              mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775); */
                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . $namedoc;
//                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($namedoc)) {
                                $documenttt->moveTo($targetPath);
                                $exonerations->document = $namedoc;
                            }
                            $exonerations = $this->Clientexonerations->patchEntity($exonerations, $data2);
                            // debug($exonerations);

                            $this->Clientexonerations->save($exonerations);
                            //  debug($exonerations);die;
                            $this->set(compact("exonerations"));
                            //   debug($exonerations);die;
                        }
                    }
                }


                return $this->redirect(['action' => 'index']);
            }
        }
        $this->loadModel('Tarifs');
        $this->loadModel('Articles');
        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        $gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();

        $delegations = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        //debug($clien);
        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente = 1 "]);
        //debug($fam);
        $dett = '0';
        foreach ($fam as $f) {
            //debug($f); //die;
            $dett = $dett . ',' . $f->id;
        }
        // $dett=implode(',',$fam);
        //debug($dett); //die;
        if ($dett != '') {


            $cond100 = 'Articles.famille_id in (' . $dett . ')';
        }
        //  $articles = $this->Tarifs->Articles->find('all')->where([$cond100]);
        $articles = $this->Tarifs->Articles->find('all')->where(['Articles.vente=1']);

        $ar = array();
        // $i=0;
        foreach ($articles as $ar) {
            $ar = $articles;
        }

        // debug($ar);die;
//        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
//        $tab = array();
//
//        foreach ($articles as $tab) {
//            $tab = $articles;
//        }
//debug($tab);
        $typeexonerations[1] = 'exonore';
        $typeexonerations[2] = 'non exonore';

        $localites = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        //  $typeexonerations = $this->fetchTable('Typeexonerations')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $type = $this->fetchTable('Typeexons')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $cli = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //  ->where(['Clients.nouveau_client="FALSE"'])
        //  ->where(["Clients.etat " => 'TRUE']);

        $bureaupostes = $this->fetchTable('Bureaupostes')->find('list', ['keyfield' => 'id', 'valueField' => 'codepostal'])->all();
        $this->set(compact('client', 'cli', 'ar', 'articles', 'type', 'delegations', 'localites', 'commercials', 'gouvernorats', 'typeexonerations', 'banques', 'paiements', 'typeclients', 'pointdeventes', 'bureaupostes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
                       $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'clients') {
                $societe = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Clientarticles');
        //debug($this->request->getData());
        $client = $this->Clients->get($id, [
            'contain' => ['Gouvernorats', 'Delegations', 'Localites'],
        ]);
        // debug($this->request->getData());
        if ($this->request->is(['patch', 'post', 'put'])) {


            //debug($this->request->getData('client_id'));
//            $c = $this->Clients->get($this->request->getData('client_id'), [
//                'contain' => [],
//            ]);
//            
//            
//            
//            $c->etat = 'TRUE';
//            $this->Clients->save($c);
//
//
            // debug($this->request->getData());
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($client->nouveau_client == 'TRUE') {
                $client->client_id = 0;
                $client->nouveau_client == 'TRUE';
            }



            if ($this->Clients->save($client)) {
                //debug($client);die;
                $this->misejour("Clients", "edit", $id);
                if (isset($this->request->getData('data')['prixarticle']) && (!empty($this->request->getData('data')['prixarticle']))) {
                    foreach ($this->request->getData('data')['prixarticle'] as $j => $p) {

                        //die;

                        if ($p['supprix'] != 1) {


                            $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
                            $data['article_id'] = $p['article_id'];
                            $data['prix'] = $p['prix'];
                            $data['client_id'] = $id;

                            // debug($data);
                            //    debug($p);
                            if (isset($p['id']) && (!empty($p['id']))) {

                                $clientarticle = $this->fetchTable('Clientarticles')->get($p['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
                            };
                            $clientarticle = $this->fetchTable('Clientarticles')->patchEntity($clientarticle, $data);
                            $this->fetchTable('Clientarticles')->save($clientarticle);
                        } else if ($p['supprix'] == 1 && !empty($p['id'])) {

                            $clientarticle = $this->fetchTable('Clientarticles')->get($p['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientarticles')->delete($clientarticle);
                        }
                    }
                }







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
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientbanque = $this->fetchTable('Clientbanques')->newEmptyEntity();
                            };

                            $datee['banque_id'] = $b['banque_id'];
                            $datee['agence'] = $b['agence'];
                            $datee['code_banque'] = $b['code_banque'];
                            $datee['swift'] = $b['swift'];
                            $datee['compte'] = $b['compte'];
                            $datee['rib'] = $b['rib'];
                            $datee['client_id'] = $id;
                            $document = $b['documen'];
                            $name = $document->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($name)) {
                                $document->moveTo($targetPath);
                                $clientbanque->document = $name;
                            }

                            //debug($dat);

                            $clientbanque = $this->fetchTable('Clientbanques')->patchEntity($clientbanque, $datee);


                            $this->fetchTable('Clientbanques')->save($clientbanque);
                        } else if ($b['supbanque'] == 1 && !empty($b['id'])) {
                            $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientbanques')->delete($clientbanque);
                        }
                    }
                }


                if (isset($this->request->getData('data')['document']) && (!empty($this->request->getData('data')['document']))) {
                    foreach ($this->request->getData('data')['document'] as $i => $b) {
                        if ($b['supbanque'] != 1) {
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientbanque = $this->fetchTable('Clientbanques')->newEmptyEntity();
                            };

                            $datee['banque_id'] = $b['banque_id'];
                            $datee['agence'] = $b['agence'];
                            $datee['code_banque'] = $b['code_banque'];
                            $datee['swift'] = $b['swift'];
                            $datee['compte'] = $b['compte'];
                            $datee['rib'] = $b['rib'];
                            $datee['client_id'] = $id;
                            $document = $b['documen'];
                            $name = $document->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($name)) {
                                $document->moveTo($targetPath);
                                $clientbanque->document = $name;
                            }

                            //debug($dat);

                            $clientbanque = $this->fetchTable('Clientbanques')->patchEntity($clientbanque, $datee);


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
                        // debug($b['tel']);


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



                            $this->fetchTable('Clientresponsables')->save($clientresponsable);
//                            debug($clientresponsable);die;
                        } else if ($b['supresponsable'] == 1 && !empty($b['id'])) {
                            $clientresponsable = $this->fetchTable('Clientresponsables')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientresponsables')->delete($clientresponsable);
                        }
                    }
                }


                if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {
                    foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
                        //debug($exon);
                        $this->loadModel('Clientexonerations');



                        if ($exon['sup2'] != 1) {
                            if (isset($exon['id']) && (!empty($exon['id']))) {
                                //debug("old");
                                $exonerations = $this->fetchTable('Clientexonerations')->get($exon['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                //debug("new");
                                $exonerations = $this->fetchTable('Clientexonerations')->newEmptyEntity();
                            };
                            $data2['typeexon_id'] = $exon['typeexon_id'];
                            $data2['num_att_taxes'] = $exon['num_att_taxes'];
                            $data2['date_debut'] = $exon['date_debut'];
                            $data2['date_fin'] = $exon['date_fin'];
                            $data2['client_id'] = $id;
                            //debug($data2);die;

                            $document = $exon['documenttt'];
                            //  debug($document);

                            $name = $document->getClientFilename();
                            //debug($name);

                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($name)) {
                                $document->moveTo($targetPath);
                                $exonerations->document = $name;
                            }
                            // debug($data2);

                            $exonerations = $this->fetchTable('Clientexonerations')->patchEntity($exonerations, $data2);

                            $this->fetchTable('Clientexonerations')->save($exonerations);
                        } else if ($exon['sup2'] == 1 && !empty($exon['id'])) {
                            $exonerations = $this->fetchTable('Clientexonerations')->get($exon['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientexonerations')->delete($exonerations);
                        }
                    }
                }
                $this->set(compact('exonerations'));

                //$this->Flash->success(__('The client has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            //   $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }



        $this->loadModel('Tarifs');
        $this->loadModel('Articles');
        $this->loadModel('Clientexonerations');
        $this->loadModel('Articles');
        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
        $dett = '0';
        foreach ($fam as $f) {
            //debug($f); //die;
            $dett = $dett . ',' . $f->id;
        }
        // $dett=implode(',',$fam);
        //debug($dett); //die;
        if ($dett != '') {
            $cond100 = 'Articles.famille_id in (' . $dett . ')';
        }

        //$articless = $this->Tarifs->Articles->find('all')->where([$cond100]);
        $articless = $this->Tarifs->Articles->find('all')->where(["Articles.vente=1"]);


        //$ar = array();
        // $i=0;
        /* foreach ($articles as $ar) {

          $ar = $articles;
          } */
        //debug($ar);
        $typeexonerations[1] = 'exonore';
        $typeexonerations[2] = 'non exonore';
        $adressees = $this->fetchTable('Adresselivraisonclients')->find('all', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(["Adresselivraisonclients.client_id =  '" . $id . "' "]);
        $responsable = $this->fetchTable('Clientresponsables')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientresponsables.client_id =  '" . $id . "' "]);
        $banquess = $this->fetchTable('Clientbanques')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientbanques.client_id = " . $id . ""]);
        $exoclients = $this->fetchTable('Clientexonerations')->find('all', ['keyfield' => 'id'])->where(["Clientexonerations.client_id = " . $id . ""]);
        ;
        $gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $this->loadModel('Basepostes');
        $this->loadModel('Delegations');
        $this->loadModel('Localites');

        $del = $this->Basepostes->find()->select(["id_deleg" => '(Basepostes.id_deleg)'])->where(['id_gouv  ="' . $client['gouvernorat_id'] . '"']);
        $i = 0;
        $tab = array();
        foreach ($del as $i => $tab) {
            $tab = $del;
        }
        //debug($tab);
//        $deleg=$this->Delegations->find()->select(['Delegations.name'])
//                ->where(['Delegations.id  in (' . $tab . ')']);
        if ($tab != array()) {
            $deleg = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                    ->where(['Delegations.id  in (' . $tab . ')']);
        } else {
            $deleg = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
            ;
        }



        // debug($deleg) ;    

        $loc = $this->Basepostes->find()->select(["id_loc" => '(Basepostes.id_loc)'])->where(['id_deleg  ="' . $client['delegation_id'] . '"']);
        $j = 0;
        $tab1 = array();
        foreach ($loc as $j => $tab1) {
            $tab1 = $loc;
        }
        if ($tab1 != array()) {
            $localite = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                    ->where(['Localites.id  in (' . $tab1 . ')']);
        } else {
            $localite = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        }


        $clientdoc = $this->fetchTable('Clientdocuments')->find('all')
        ->where(["Clientdocuments.client_id = " . $id . ""]);





        $exoner = $this->Clientexonerations->find('all')->where(["Clientexonerations.client_id = " . $id . ""]);
        $this->loadModel('Clientarticles');
        $clientarticles = $this->Clientarticles->find('all')->where(["Clientarticles.client_id = " . $id . ""]);
        //debug($clientarticles);
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        //$gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();

        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        //$typeexonerations = $this->fetchTable('Typeexonerations')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();

        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
        $this->loadModel('Typeexons');

        $type = $this->fetchTable('Typeexons')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $cli = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        // ->where(["Clients.etat " => 'TRUE'])
        // ->where(['Clients.nouveau_client="FALSE"']);

        $bureaupostes = $this->fetchTable('Bureaupostes')->find('list', ['valueField' => 'codepostal'])->where(["Bureaupostes.gouvernorat_id = " . $client->gouvernorat_id . ""])
        ;
        // debug($bureaupostes);
        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        $this->set(compact('clientdoc','articless', 'bureaupostes', 'cli', 'ar', 'localite', 'deleg', 'gouvernorats', 'type', 'tab', 'articles', 'clientarticles', 'exoner', 'gouvernorats', 'pointdeventes', 'typeclients', 'client', 'commercials', 'gouvernorats', 'typeexonerations', 'paiements', 'adressees', 'responsable', 'banquess', 'banques'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
                              $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'clients') {
                $societe = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
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

            //   $this->Flash->success(__('The client has been deleted.'));
        } else {
            //  $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function clientcommercial() {

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
        $gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $this->set(compact('commercials', 'gouvernorats', 'clientCom'));
    }

    public function clientgouv() {
        $id = $this->request->getQuery('idfam');
        // debug($id);





        $dealIdStr = implode(", ", $id);

        $clients = $this->Clients->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
                        ->where(['Clients.gouvernorat_id  in (' . $dealIdStr . ')'])->order(['left(Clients.Code,1),cast(right(Clients.Code,length(Clients.Code)-1) as Unsigned)']);
        $this->layout = '';

        $this->set(compact('clients'));
    }

    public function getbureaupostegouvs($id = null) {
        $this->loadModel('Basepostes');
        $this->loadModel('Delegations');
        $id = $this->request->getQuery('idgouv');
        $ligne = $this->fetchTable('Gouvernorats')->get($id, [
            'contain' => [],
        ]);

        $del = $this->Basepostes->find()->select(["id_deleg" => '(Basepostes.id_deleg)'])->where(['id_gouv  ="' . $id . '"']);
        //debug($del);

        $i = 0;
        $tab = array();
        foreach ($del as $i => $tab) {
            $tab = $del;
        }
        $deleg = $this->Delegations->find()//->select(["namedeleg" => '(Delegations.name)'])
                ->where(['Delegations.id  in (' . $tab . ')']);

        $query = $this->fetchTable('Gouvernorats')->find();
        $query->where(['Gouvernorats.id  ="' . $id . '"']);
        //debug($query);
        foreach ($query as $qr) {
            //   debug($qr);
            $code = $qr['codepostale'];
            $name = $qr['name'];
            $c = $qr['code'];
        }
//debug($c);






        // debug($c);die;
//  $queryyy = $this->Clients->find()->select(["code" =>
//                    'MAX(Clients.Code)']) ->first();
        $queryyy = $this->fetchTable('Clients')->find()->select(["code" => '(Clients.Code)'])->where(['Clients.Code like' . "'" . $c . "%'"]);
    //   debug($queryyy);
        $i = 0;
        $res = array();
        foreach ($queryyy as $i => $q) {
            $res[$i] = intval(substr($q['code'], 1, 9));
        }
      
        if (!empty($res)){
      $p = max($res); //debug($p);
        if (!empty($p)) {
            $f = $c .($p+ 1);
        } }else {
            $f = $c."001";
        }
//debug($f);


//            $t=$p+1;
//            $cc = str_pad("$t", 4, '0', STR_PAD_LEFT);
//            $f= str_pad("$cc", 5,$c, STR_PAD_LEFT); 





        $select = "

        <label class='control-label' for=''>Delegation</label>
        <select name='delegation_id' id='deleg' class='form-control select2 ' Onchange='delegation(this.value)'  >
		<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($deleg as $q) {
            //  debug($q); die;
            $select = $select . "	<option value ='" . $q->id . "'";
            $select = $select . " >" . $q->name . "</option>";
        }
        $select = $select . "</select> </div> </div> ";

        echo json_encode(array("query" => $code, "queryyy" => $f, "queryy" => $c, "select" => $select, "name" => $name, "success" => true));
        die;
    }

    public function getclientscmd($id = null) {
        $this->loadModel('Commandes');
        $id = $this->request->getQuery('idclient');
        $commandeclients = $this->fetchTable('Commandes')->find('all')->where(['Commandes.client_id=' . $id])->count();
        // debug($commandeclients);
        echo json_encode(array("query" => $commandeclients, "success" => true));
        die;
    }

    public function getbureaupostedelegs($id = null) {
        $this->loadModel('Localites');
        $this->loadModel('Basepostes');
        $id = $this->request->getQuery('iddeleg');
        $ligne = $this->fetchTable('Delegations')->get($id, [
            'contain' => [],
        ]);

        //$del=$this->fetchTable('Base_postes')->find()->where(['gouvernorats.id  ="' .$id.'"']);


        $query = $this->fetchTable('Delegations')->find();
        $query->where(['Delegations.id  ="' . $id . '"']);
        foreach ($query as $qr) {
            //     debug($qr)
            $code = $qr['codepostale'];
            $name = $qr['name'];
        }
        // debug($name);



        $loc = $this->Basepostes->find()->select(["id_loc" => '(Basepostes.id_loc)'])->where(['id_deleg  ="' . $id . '"']);
        $j = 0;
        $tab1 = array();
        foreach ($loc as $j => $tab1) {
            $tab1 = $loc;
        }

        $localite = $this->Localites->find()//->select(["namedeleg" => '(Delegations.name)'])
                ->where(['Localites.id  in (' . $tab1 . ')']);
        //debug($localite);





        $select = "
        <label class='control-label' for='sousfamille1-id'>Localite</label>
        <select name='localite_id'  class='form-control select2' Onchange='localite(this.value)'>
					<option value=''  selected='selected'>Veuillez choisir</option>";
        foreach ($localite as $q) {
            //  debug($q); die;
            $select = $select . "	<option value ='" . $q->id . "'";
            $select = $select . " >" . $q->name . "</option>";
        }
        $select = $select . "</select>  ";
        echo json_encode(array("name" => $name, "query" => $code, "select" => $select, "success" => true));

//        echo json_encode(array('select' => $select));
        //echo json_encode(array('select' => $select, 'ligne' => $ligne));
        die;
        //  $this->set(compact('query'));
    }

    public function getbureaupostelocs($id = null) {
        $this->loadModel('Basepostes');
        $id = $this->request->getQuery('idloc');

        $query = $this->fetchTable('Basepostes')->find();
        $query->where(['id_loc="' . $id . '"']);

        $q = $this->fetchTable('Localites')->find();
        $q->where(['id="' . $id . '"']);

        foreach ($q as $a) {
            //  debug($a);
            $name = $a['name'];
        }



        foreach ($query as $qr) {
            $code = $qr['codepostale'];
            //$name=$qr['name'];
        }

        //  debug($code);die;
        echo json_encode(array("name" => $name, "query" => $code, "success" => true));

        die;
        //  $this->set(compact('query'));
    }

}

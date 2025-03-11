<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Fournisseurs Controller
 *
 * @property \App\Model\Table\FournisseursTable $Fournisseurs
 * @method \App\Model\Entity\Fournisseur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FournisseursController extends AppController
{

    /**
     * Index method

     * @return \Cake\Http\Response|null|void Renders view
     */
    //public function index()/*
    /*
      $cin=$this->request->getQuery('cin');
      $compteComptable=$this->request->getQuery('comptecomptable');
      $passeport=$this->request->getQuery('passeport');
      $typeutilisateur_id=$this->request->getQuery('typeutilisateur_id');
      $cartesejour=$this->request->getQuery('cartesejour');
      $paiement=$this->request->getQuery('paiement_id');
      $matriculefiscale=$this->request->getQuery('Matriculefiscale');
      $name=$this->request->getQuery('name');
      $typeutilisateursoptions = $this->Clients->Typeutilisateurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
      $paiementsoptions = $this->Clients->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
      if($cin && $passeport && $compteComptable && $cartesejour && $matriculefiscale && $name && $typeutilisateur_id && $paiement ){
      $query=$this->Clients->find('all')->where(['Or'=>['cin like'=>'%'.$cin.'%','passeport like'=>'%'.$passeport.'%','compteComptable like'=>'%'.$compteComptable.'%','matriculefiscale like'=>'%'.$matriculefiscale.'%','clients.name like'=>'%'.$name.'%',' clients.typeutilisateur_id like'=>'%'.$typeutilisateur_id.'%',' clients.paiement_id like'=>'%'.$paiement.'%']]);
      //debug($query);
      }else{
      $query=$this->Clients;}



      $this->paginate = [
      'contain' => ['Typeutilisateurs', 'Villes', 'Regions', 'Pays', 'Activites', 'Paiements'],
      ];
      $clients = $this->paginate($query);
      //debug($clients);
      $this->set(compact('clients','typeutilisateursoptions','paiementsoptions')); */
    // }

    public function getfourcmd($id = null)
    {
        $this->loadModel('Commandes');
        $id = $this->request->getQuery('fournisseurid');
        $fournisseurs = 0;
        $fournisseurs += $this->fetchTable('Commandefournisseurs')->find()->where(['Commandefournisseurs.fournisseur_id' => $id])->count();
        $fournisseurs += $this->fetchTable('Livraisons')->find()->where(['Livraisons.fournisseur_id' => $id])->count();
        $fournisseurs += $this->fetchTable('Factures')->find()->where(['Factures.fournisseur_id' => $id])->count();
        $fournisseurs += $this->fetchTable('Lignereglements')->find()->where(['Lignereglements.fournisseur_id' => $id])->count();
        $fournisseurs += $this->fetchTable('Factureavoirfrs')->find()->where(['Factureavoirfrs.fournisseur_id' => $id])->count();
        $fournisseurs += $this->fetchTable('Adresselivraisonfournisseurs')->find()->where(['Adresselivraisonfournisseurs.fournisseur_id' => $id])->count();
        // $articlefournisseurs = $this->fetchTable('Articlefournisseurs')->find()->where(['Articlefournisseurs.fournisseur_id' => $id])->count();
        // Check if there are any related records
        $fournisseurs = $this->fetchTable('Fournisseurresponsables')->find()->where(['Fournisseurresponsables.fournisseur_id' => $id])->count();
        $fournisseurs = $this->fetchTable('Fournisseurbanques')->find()->where(['Fournisseurbanques.fournisseur_id' => $id])->count();

        echo json_encode(['fournisseurs' => $fournisseurs]);
        die;
    }


    public function getfournisseurcmd($id = null)
    {
        $this->loadModel('Commandes');
        $id = $this->request->getQuery('idfournisseur');

        // Count associated records for the client
        $commandeCount = $this->fetchTable('Commandefournisseurs')->find()->where(['Commandefournisseurs.fournisseur_id' => $id])->count();
        $bonlivraisonCount = $this->fetchTable('Livraisons')->find()->where(['Livraisons.fournisseur_id' => $id])->count();
        $factureCount = $this->fetchTable('Factures')->find()->where(['Factures.fournisseur_id' => $id])->count();
        $reglementCount = $this->fetchTable('Lignereglements')->find()->where(['Lignereglements.fournisseur_id' => $id])->count();
        $avoirCount = $this->fetchTable('Factureavoirfrs')->find()->where(['Factureavoirfrs.fournisseur_id' => $id])->count();
        $adresseCount = $this->fetchTable('Adresselivraisonfournisseurs')->find()->where(['Adresselivraisonfournisseurs.fournisseur_id' => $id])->count();
        // $articlefournisseurs = $this->fetchTable('Articlefournisseurs')->find()->where(['Articlefournisseurs.fournisseur_id' => $id])->count();
        // Check if there are any related records
        $fournisseurresponsables = $this->fetchTable('Fournisseurresponsables')->find()->where(['Fournisseurresponsables.fournisseur_id' => $id])->count();
        $fournisseurbanques = $this->fetchTable('Fournisseurbanques')->find()->where(['Fournisseurbanques.fournisseur_id' => $id])->count();


        $hasDependencies = $commandeCount + $bonlivraisonCount + $factureCount + $reglementCount  + $avoirCount + $adresseCount + $fournisseurresponsables + $fournisseurbanques > 0;

        echo json_encode([
            "hasDependencies" => $hasDependencies,
            "success" => true
        ]);
        die;
    }

    public function print()
    {
        //debug('rrr');die;
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond0 = '';

        if ($this->request->getQuery('name') != '') {
            //debug('rrr');die;
            $name = $this->request->getQuery('name');
            //debug($name);die();


            $cond0 = "Fournisseurs.name like  '%" . $name . "%' ";
        }
        //debug($cond0);die;
        if ($this->request->getQuery('compte_comptable') != '') {
            $compte_comptable = $this->request->getQuery('compte_comptable');

            $cond1 = "Fournisseurs.compte_comptable  like  '%" . $compte_comptable . "%' ";
        }

        if ($this->request->getQuery('Typelocalisation_id') != '') {
            $typelocalisation_id = $this->request->getQuery('typelocalisation_id');

            $cond3 = "Fournisseurs.typelocalisation_id  like  '%" . $typelocalisation_id . "%' ";
        }

        if ($this->request->getQuery('Paiement_id') != '') {
            $paiement_id = $this->request->query('paiement_id');

            $cond4 = "Fournisseurs.paiement_id   like  '%" . $paiement_id . "%' ";
        }

        $query = $this->Fournisseurs->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond0]);
        $this->paginate = [
            'contain' => ['Typeutilisateurs', 'Typelocalisations',  'Paiements', 'Devises'],
        ];
        $fournisseurs = $this->paginate($query);

        $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $paiements = $this->Fournisseurs->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('fournisseurs', 'typeutilisateurs', 'typelocalisations', 'paiements'));
    }
    public function veriffournisseursup()
    {
        $id = $this->request->getQuery('id');

        // Initialize the total count
        $totalArticles = 0;

        // Sum counts from different tables

        $totalArticles += $this->fetchTable('Exonerations')->find('all')->where(['Exonerations.fournisseur_id' => $id])->count();

        $totalArticles += $this->fetchTable('Fournisseurresponsables')->find('all')->where(['Fournisseurresponsables.fournisseur_id' => $id])->count();

        $totalArticles += $this->fetchTable('Fournisseurbanques')->find('all')->where(['Fournisseurbanques.fournisseur_id' => $id])->count();

        $totalArticles += $this->fetchTable('Adresselivraisonfournisseurs')->find('all')->where(['Adresselivraisonfournisseurs.fournisseur_id' => $id])->count();

        $totalArticles += $this->fetchTable('Commandefournisseurs')->find('all')->where(['Commandefournisseurs.fournisseur_id' => $id])->count();
        $totalArticles += $this->fetchTable('Factures')->find('all')->where(['Factures.fournisseur_id' => $id])->count();
        $totalArticles += $this->fetchTable('Lignedemandeoffredeprixes')->find('all')->where(['Lignedemandeoffredeprixes.fournisseur_id' => $id])->count();
        $totalArticles += $this->fetchTable('Reglements')->find('all')->where(['Reglements.fournisseur_id' => $id])->count();
        $totalArticles += $this->fetchTable('Livraisons')->find('all')->where(['Livraisons.fournisseur_id' => $id])->count();

        // Return JSON response
        echo json_encode(['Fournisseurs' => $totalArticles]);
        die;
    }
    public function index()
    {


        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $name = $this->request->getQuery('name');
        $compte_comptable = $this->request->getQuery('compte_comptable');
        $typeutilisateur_id = $this->request->getQuery('typeutilisateur_id');

        $typelocalisation_id = $this->request->getQuery('typelocalisation_id');
        $paiement_id = $this->request->getQuery('paiement_id');
        //if($nom ){
        //$query=$this->Fournisseurs->find('all')->where(['Or'=>['nom like'=>'%'.$nom.'%']]);
        //debug($query);
        //}else{
        //$query=$this->Fournisseurs;}

        if ($name) {
            $cond1 = "Fournisseurs.name like  '%" . $name . "%' ";
        }
        if ($typeutilisateur_id) {
            $cond3 = "Fournisseurs.typeutilisateur_id  like  '%" . $typeutilisateur_id . "%' ";
        }


        if ($typelocalisation_id) {
            $cond4 = "Fournisseurs.typelocalisation_id  like  '%" . $typelocalisation_id . "%' ";
        }


        if ($compte_comptable) {
            $cond2 = "Fournisseurs.compte_comptable  like  '%" . $compte_comptable . "%' ";
        }
        if ($paiement_id) {
            $cond5 = "Fournisseurs.paiement_id   like  '%" . $paiement_id . "%' ";
        }





        $query = $this->Fournisseurs->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5])->order(["Fournisseurs.id" => 'desc']);
        $this->paginate = [
            'contain' => ['Typeutilisateurs', 'Typelocalisations',  'Paiements', 'Devises'],
        ];
        $fournisseurs = $this->paginate($query);
        $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $paiements = $this->Fournisseurs->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('fournisseurs', 'name', 'compte_comptable', 'typeutilisateur_id', 'paiement_id', 'compte_comptable', 'typelocalisation_id', 'typeutilisateurs', 'typelocalisations', 'paiements'));
    }

    public function imprimeview($id = null)
    {
        $fournisseur = $this->Fournisseurs->get($id, [
            'contain' => ['Fournisseurresponsables', 'Fournisseurbanques', 'Typelocalisations',  'Paiements', 'Devises', 'Adresselivraisonfournisseurs', 'Articlefournisseurs', 'Bandeconsultations', 'Exonerations', 'Factures', 'Fournisseurbanques', 'Fournisseurresponsables', 'Lignebandeconsultations', 'Lignedemandeoffredeprixes', 'Lignefactures', 'Lignelignebandeconsultations', 'Lignelivraisons', 'Livraisons', 'Livraisonsanc'],
        ]);
        $this->set(compact('fournisseur'));

        $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list', ['limit' => 200]);
        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['limit' => 200]);
        //  $villes = $this->Fournisseurs->Villes->find('list', ['limit' => 200]);
        //$regions = $this->Fournisseurs->Regions->find('list', ['limit' => 200]);
        //$pays = $this->Fournisseurs->Pays->find('list', ['limit' => 200]);
        $paiements = $this->Fournisseurs->Paiements->find('list', ['limit' => 200]);
        $devises = $this->Fournisseurs->Devises->find('list', ['limit' => 200]);
        $this->set(compact('fournisseur', 'typeutilisateurs', 'typelocalisations',  'paiements', 'devises'));
    }

    /**
     * View method
     *
     * @param string|null $id Fournisseur id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exonerations = array();
        $exonerations[0] = 'exonoré';
        $exonerations[1] = 'non exonoré';
        $this->set(compact('exonerations'));

        $fournisseur = $this->Fournisseurs->get($id, [
            'contain' => ['Fournisseurresponsables', 'Fournisseurbanques', 'Typelocalisations',  'Paiements', 'Devises', 'Adresselivraisonfournisseurs', 'Articlefournisseurs', 'Bandeconsultations', 'Exonerations', 'Factures', 'Fournisseurbanques', 'Fournisseurresponsables', 'Lignebandeconsultations', 'Lignedemandeoffredeprixes', 'Lignefactures', 'Lignelignebandeconsultations', 'Livraisons', 'Livraisonsanc'],
        ]);
        $this->set(compact('fournisseur'));

        $this->loadModel('Banques');

        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list', ['limit' => 200]);
        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['limit' => 200]);
        //  $villes = $this->Fournisseurs->Villes->find('list', ['limit' => 200]);
        //$regions = $this->Fournisseurs->Regions->find('list', ['limit' => 200]);
        //$pays = $this->Fournisseurs->Pays->find('list', ['limit' => 200]);
        $paiements = $this->Fournisseurs->Paiements->find('list', ['limit' => 200]);
        $devises = $this->Fournisseurs->Devises->find('list', ['limit' => 200]);
        $typeexonerations = $this->Fournisseurs->Typeexons->find('list', ['limit' => 200]);
        $this->set(compact('typeexonerations', 'banques', 'fournisseur', 'typeutilisateurs', 'typelocalisations',  'paiements', 'devises'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        //   debug($liendd);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'fournisseurs') {
                $fournisseur = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }



        $exonerations = array();
        $exonerations[0] = 'exonoré';
        $exonerations[1] = 'non exonoré';
        $this->set(compact('exonerations'));
        $codeobj = $this->Fournisseurs->find()->select(["number" =>
        'MAX(Fournisseurs.code)'])->first();
        $num = $codeobj->number;
        if ($num != null) {
            $n = $num;
            $lastnum = $n;
            $numo = intval($lastnum) + 1;
            $nn = (string)$numo;
            $numero = str_pad($nn, 5, "0", STR_PAD_LEFT);
        } else {
            $numero = "00001";
            //debug($numero);die;
        }
        //$this->loadModel('Exoneration');
        $fournisseur = $this->Fournisseurs->newEmptyEntity();
        //debug($fournisseur);die;
        if ($this->request->is('post')) {
            //  debug($this->request->getData());die;

            $fournisseur = $this->Fournisseurs->patchEntity($fournisseur, $this->request->getData());
            // debug($fournisseur);die;
            if ($this->Fournisseurs->save($fournisseur)) {
                $fournisseur_id = $fournisseur->id;
                $fournisseur_id = ($this->Fournisseurs->save($fournisseur)->id);
                $this->misejour("Fournisseurs", "add", $fournisseur_id);



                if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    $this->loadModel('Fournisseurresponsables');
                    //debug($this->request->getData('data')['ligne']);die;
                    foreach ($this->request->getData('data')['ligne'] as $i => $responsable) {
                        if ($responsable['sup1'] != 1) {
                            $dataa['name'] = $responsable['name'];
                            $dataa['mail'] = $responsable['mail'];
                            $dataa['tel'] = $responsable['tel'];
                            $dataa['poste'] = $responsable['poste'];
                            $dataa['fournisseur_id'] = $fournisseur_id;
                            //debug($dataa);die;
                            $fournisseurresponsables = $this->fetchTable('Fournisseurresponsables')->newEmptyEntity();
                            // debug($fournisseurresponsables);die;
                            $fournisseurresponsables = $this->Fournisseurresponsables->patchEntity($fournisseurresponsables, $dataa);
                            //                          debug($fournisseurresponsables);die;
                            if ($this->Fournisseurresponsables->save($fournisseurresponsables)) {
                                //                              debug('rrr');
                                //   $this->Flash->success("fournisseurresponsables has been created successfully");
                            } else {
                                //$this->Flash->error("Failed to create fournisseurresponsables");
                            }
                        }
                        $this->set(compact("fournisseurresponsables"));
                    }
                }


                if (isset($this->request->getData('data')['lignead']) && (!empty($this->request->getData('data')['lignead']))) {
                    $this->loadModel('Adresselivraisonfournisseurs');
                    //debug($this->request->getData('data')['ligne']);die;
                    foreach ($this->request->getData('data')['lignead'] as $i => $add) {
                        if ($responsable['sup1'] != 1) {
                            $dataaa['adresse'] = $add['adresse'];

                            $dataaa['fournisseur_id'] = $fournisseur_id;
                            //debug($dataa);die;
                            $adresselivraisonfournisseurs = $this->fetchTable('Adresselivraisonfournisseurs')->newEmptyEntity();
                            // debug($fournisseurresponsables);die;
                            $adresselivraisonfournisseurs = $this->Adresselivraisonfournisseurs->patchEntity($adresselivraisonfournisseurs, $dataaa);
                            //                          debug($fournisseurresponsables);die;
                            if ($this->Adresselivraisonfournisseurs->save($adresselivraisonfournisseurs)) {
                                //                              debug('rrr');
                                //   $this->Flash->success("fournisseurresponsables has been created successfully");
                            } else {
                                //$this->Flash->error("Failed to create fournisseurresponsables");
                            }
                        }
                        $this->set(compact("fournisseurresponsables"));
                    }
                }

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    $this->loadModel('Fournisseurbanques');

                    foreach ($this->request->getData('data')['ligner'] as $i => $banque) {
                        if ($banque['sup4'] != 1) {
                            $data1['banque_id'] = $banque['banque_id'];
                            $data1['agence'] = $banque['agence'];
                            $data1['code_banque'] = $banque['code_banque'];
                            $data1['swift'] = $banque['swift'];
                            $data1['compte'] = $banque['compte'];
                            $data1['rib'] = $banque['rib'];
                            ///$data1['documenttt'] = $banque['document'];
                            $data1['fournisseur_id'] = $fournisseur_id;
                            //debug($data1);
                            $fb = $this->fetchTable('Fournisseurbanques')->newEmptyEntity(); //fetchtable pour creer une ligne vide avant de la remplir
                            $document = $banque['documenttt'];
                            //debug($image);die;
                            if (!empty($document)) {
                                $name = $document->getClientFilename();
                                /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
                                   mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775);*/
                                // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
                                $targetPath = WWW_ROOT . 'img'  . DS . $name;
                                if (!empty($name)) {
                                    $document->moveTo($targetPath);
                                    $fb->document = $name;
                                }
                            }
                            $fb = $this->Fournisseurbanques->patchEntity($fb, $data1);

                            if ($this->Fournisseurbanques->save($fb)) {

                                //  $this->Flash->success("fournisseurbanques has been created successfully");
                            } else {
                                // $this->Flash->error("Failed to create fournisseurbanques");
                            }
                        }
                        $this->set(compact("fb"));
                    }
                }
                //debug($this->request->getData('data')['lignes']);die;
                if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {
                    $this->loadModel('Exonerations');
                    foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
                        // debug($exon);
                        if ($exon['sup2'] != 1) {
                            $data2['typeexon_id'] = $exon['typeexon_id'];
                            $data2['num_att_taxes'] = $exon['num_att_taxes'];
                            $data2['date_debut'] = $exon['date_debut'];
                            $data2['date_fin'] = $exon['date_fin'];
                            //$data2['documentt'] = $exon['document'];
                            $data2['fournisseur_id'] = $fournisseur_id;
                            $exonerations = $this->fetchTable('Exonerations')->newEmptyEntity();
                            $document = $exon['documentt'];
                            //debug($image);die;
                            if (!empty($document)) {
                                $name = $document->getClientFilename();
                                /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
                                   mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775);*/
                                // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
                                $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                                if (!empty($name)) {
                                    $document->moveTo($targetPath);
                                    $exonerations->document = $name;
                                }
                            }
                            $exonerations = $this->Exonerations->patchEntity($exonerations, $data2);
                            //////




                            if ($this->Exonerations->save($exonerations)) {
                                //    $this->Flash->success("exonerations has been created successfully");
                            }
                        } else {
                            //$this->Flash->error("Failed to create exonerations");
                        }

                        $this->set(compact("exonerations"));
                    }
                }

                //  $this->Flash->success(__('The fournisseur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                //$this->Flash->error(__('The fournisseur could not be saved. Please, try again.'));
            }
        }
        $fr = $this->fetchTable('Fournisseurs')->query('select fournisseurs.id as tt from fournisseurs as f  where f.id=3');
        //debug($fr);die;
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $typeexonerations = $this->fetchTable('Typeexons')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // debug( $typeexonerations->toarray());
        $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list', ['limit' => 200]);
        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['limit' => 200]);
        //        $villes = $this->Fournisseurs->Villes->find('list', ['limit' => 200]);
        //    $regions = $this->Fournisseurs->Regions->find('list', ['limit' => 200]);
        $pays = $this->Fournisseurs->Pays->find('list', ['limit' => 200]);
        $paiements = $this->Fournisseurs->Paiements->find('list', ['limit' => 200]);
        $devises = $this->Fournisseurs->Devises->find('list', ['limit' => 200]);
        $this->set(compact('banques', 'fournisseur', 'typeexonerations', 'typeutilisateurs', 'typelocalisations', 'paiements', 'devises', 'pays', 'numero'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fournisseur id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    //   public function view($id = null)
    //    {
    //        $bondereservation = $this->Bondereservations->get($id, [
    //            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Commandeclients', 'Lignebondereservations'],
    //        ]);
    //        $bondereservation_id = $bondereservation->id;
    //        $this->loadModel('Lignebondereservations');
    //        $this->loadModel('Articles');
    //        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
    //        $lignebondereservations = $this->Lignebondereservations->find('all', ['keyfield' => 'id', 'valueField' => 'id'])->where(["lignebondereservations.bondereservation_id like  '%" . $bondereservation_id . "%' "]);
    //        $lignebondereservations = $this->paginate($lignebondereservations);
    //        //debug($lignebondereservations);
    //        //debug($lignebondereservations);
    //        /* if (isset($lignebondereservations) && (!empty($lignebondereservations))) {
    //            //debug($lignebondereservations);
    //            //debug($this->request->getData('data')['tabligne2']);
    //            //$this->loadModel('lignebondereservations');
    //            // debug(($this->request->getData('data')));
    //            foreach ($lignebondereservations as $i => $reservation) {
    //                //debug($lignebondereservations);
    //                debug($$reservation);
    //                if ($reservation['sup'] != 1) {
    //                    // debug($reservation);
    //                    $data['quantite'] = $reservation['quantite'];
    //                    $data['bondereservation_id'] = $bondereservation_id;
    //                    $data['article_id'] = $reservation['article_id'];
    //                    //debug($data);
    //                    $lignebondereservation = $this->fetchTable('lignebondereservations')->newEmptyEntity();
    //                    //debug($lignebondereservation);
    //                    //$this->adresselivraisonclient->create();
    //                    //$this->adresselivraisonclient->save($data);
    //                    $lignebondereservation = $this->lignebondereservations->patchEntity($lignebondereservation, $data);
    //                    //debug($lignebondereservation);
    //                    if ($this->lignebondereservations->save($lignebondereservation)) {
    //                        $this->Flash->success("lignebondereservations has been created successfully");
    //                    } else {
    //                        $this->Flash->error("Failed to create lignebondereservations");
    //                    }
    //                }
    //                $this->set(compact("lignebondereservation"));
    //            }
    //        }*/
    //        //debug($lignebondereservations);
    //        //debug($articles);
    //        //$this->set(compact('artreserver', 'articles', 'exercices', 'utilisateurs'));
    //        $this->set(compact('bondereservation', 'lignebondereservations', 'articles'));
    //    } 
    //  





    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        //   debug($liendd);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'fournisseurs') {
                $fournisseur = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->loadModel('Exonerations');
        $exonerations = array();
        $exonerations[0] = 'exonoré';
        $exonerations[1] = 'non exonoré';
        $this->set(compact('exonerations'));
        $fournisseur = $this->Fournisseurs->get($id, [
            'contain' => ['Adresselivraisonfournisseurs', 'Exonerations', 'Fournisseurbanques', 'Fournisseurresponsables', 'Pays', 'Gouvernorats', 'Delegations', 'Localites']
        ]);

        // debug($fournisseur); die ;
        if ($this->request->is(['patch', 'post', 'put'])) {

            $fournisseur = $this->Fournisseurs->patchEntity($fournisseur, $this->request->getData());
            /// $this->request->getData();
            // debug($this->request->getData());//die;
            if ($this->Fournisseurs->save($fournisseur)) {
                // debug($this->request->getData());//die;
                $fournisseur_id = $fournisseur->id;
                $fournisseur_id = ($this->Fournisseurs->save($fournisseur)->id);
                $this->misejour("Fournisseurs", "edit", $fournisseur_id);
                if (isset($this->request->getData('data')['lignead']) && (!empty($this->request->getData('data')['lignead']))) {
                    foreach ($this->request->getData('data')['lignead'] as $i => $adresseliv) {
                        //debug($adresseliv);
                        $this->loadModel('Adresselivraisonfournisseurs');
                        if ($adresseliv['sup'] != 1) {
                            $data['adresse'] = $adresseliv['adresse'];
                            $data['fournisseur_id'] = $id;
                            if (isset($adresseliv['id']) && (!empty($adresseliv['id']))) {
                                $adresselivraisonfournisseur = $this->fetchTable('Adresselivraisonfournisseurs')->get($adresseliv['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $adresselivraisonfournisseur = $this->fetchTable('Adresselivraisonfournisseurs')->newEmptyEntity();
                                $adresselivraisonfournisseur = $this->fetchTable('Adresselivraisonfournisseurs')->patchEntity($adresselivraisonfournisseur, $data);
                            };
                            if ($this->fetchTable('Adresselivraisonfournisseurs')->save($adresselivraisonfournisseur)) {
                            } else {


                                //$this->Flash->error("Failed to midify adresselivraisonfournisseurs");
                            }
                        } else {
                            if (!empty($adresseliv['id']))
                                $adresselivraisonfournisseur = $this->fetchTable('Adresselivraisonfournisseurs')->get($adresseliv['id']);
                            $this->fetchTable('Adresselivraisonfournisseurs')->delete($adresselivraisonfournisseur);
                        }
                    }
                }
                //  $this->set(compact("adresselivraisonfournisseur"));

                if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    //debug($this->request->getData('data')['clientresponsables']);
                    $this->loadModel('Fournisseurresponsables');
                    foreach ($this->request->getData('data')['ligne'] as $i => $res) {
                        //debug($res);
                        // die;
                        if ($res['sup1'] != 1) {
                            $dat['name'] = $res['aaa'];
                            $dat['tel'] = $res['tel'];
                            $dat['mail'] = $res['mail'];
                            $dat['poste'] = $res['poste'];
                            $dat['fournisseur_id'] = $id;
                            //debug($dat);
                            if (isset($res['id']) && (!empty($res['id']))) {
                                $fournisseurresponsables = $this->fetchTable('Fournisseurresponsables')->get($res['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $fournisseurresponsables = $this->fetchTable('Fournisseurresponsables')->newEmptyEntity();
                            };

                            $fournisseurresponsables = $this->fetchTable('Fournisseurresponsables')->patchEntity($fournisseurresponsables, $dat);
                            //debug($fournisseurresponsables);
                            if ($this->fetchTable('Fournisseurresponsables')->save($fournisseurresponsables)) {
                                // debug($clientresponsable);
                                //    $this->Flash->success("Fournisseurresponsables has been òodified successfully");
                            } else {
                                //$this->Flash->error("Failed to midify clientresponsable");
                            }
                        } else {
                            //S  $this->request->allowMethod(['post', 'delete']);
                            if (!empty($res['id']))
                                $fournisseurresponsables = $this->fetchTable('Fournisseurresponsables')->get($res['id']);
                            $this->fetchTable('Fournisseurresponsables')->delete($fournisseurresponsables);
                        }
                    }
                }
                //  $this->set(compact("fournisseurresponsables"));
                //     if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {
                //         $this->loadModel('Exonerations');
                //         foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
                //             //	debug($exon);
                //             $exonerations = $this->fetchTable('Exonerations')->newEmptyEntity();
                //             if ($exon['sup2'] != 1) {
                //                 $data2['typeexon_id'] = $exon['typeexon_id'];
                //                 $data2['num_att_taxes'] = $exon['num_att_taxes'];
                //                 $data2['date_debut'] = $exon['date_debut'];
                //                 $data2['date_fin'] = $exon['date_fin'];
                //                 $data2['document'] = $exon['document'];
                //                 $data2['fournisseur_id'] = $fournisseur_id;
                //                 // if (isset($exon['id']) && ($exon['id']!='')) {
                //                 $ligneExonerations = $this->Exonerations->find()->where(["fournisseur_id =" . $fournisseur_id])->all();
                //                 foreach ($ligneExonerations as $item) {
                //                     $this->Exonerations->delete($item);
                //                 }//}

                //                 $exonerations = $this->Exonerations->patchEntity($exonerations, $data2);

                //                 if ($this->Exonerations->save($exonerations)) {
                //                     // debug($exonerations);die;
                //                     //$this->Flash->success("exonerations has been created successfully");
                //                 }
                //             } else {
                //                 //$this->Flash->error("Failed to create exonerations");
                //             }


                //         }
                //         $this->set(compact("exonerations"));
                // 	foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
                //                            //debug($exon);//die;
                // //	debug($exon);
                // 		if($exon['sup2']!=1){
                // 		$exon['typeexon_id'] = $exon['typeexon_id'];
                // 		$exon['num_att_taxes'] = $exon['num_att_taxes'];
                // 		$exon['date_debut'] = $exon['date_debut'];
                // 		$exon['date_fin'] = $exon['date_fin'];
                // 		$exon['document'] = $exon['document'];
                //         $exon['fournisseur_id'] = $fournisseur_id;
                //         if (isset($exon['id']) && ($exon['id']!='')) {
                //             $ligneExonerations = $this->Exonerations->find()->where(["fournisseur_id" => $id])->all();
                //             foreach ($ligneExonerations as $item) {
                //                 $this->Exonerations->delete($item);
                //             }
                //         }
                //         if (isset($exon['id']) && ($exon['id']!='')) {
                //                            //debug('aaaaa')   ;
                //             $exonerations = $this->fetchTable('Exonerations')->get($exon['id'], [
                //                         'contain' => []
                //                     ]);
                //         } else {                             
                //             $exonerations = $this->fetchTable('Exonerations')->newEmptyEntity();
                //             }                  
                //             $exonerations=$this->fetchTable('Exonerations')->patchEntity($exonerations ,$exon);    
                //              if ($this->fetchTable('Exonerations')->save( $exonerations)) {
                //                        //  debug($exonerations)   ;die;
                //                     // debug($clientresponsable);
                //                    // $this->Flash->success("Exonerations has been òodified successfully");
                //             } else {
                //                     //$this->Flash->error("Failed to midify Exonerations");
                //                 }    
                //              }else {
                //                 //S  $this->request->allowMethod(['post', 'delete']);
                //                 if(!empty($res['id']))
                //                 $exonerations = $this->fetchTable('Exonerations')->get($exon['id']);
                //                 $this->fetchTable('Exonerations')->delete($exonerations);
                //             }

                //         }
                //     }
                //     $this->set(compact("exonerations"));

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $banque) {
                        //debug($banque);//die;
                        $this->loadModel('Fournisseurbanques');
                        if ($banque['sup4'] != 1) {
                            $datee['banque_id'] = $banque['banque_id'];
                            $datee['agence'] = $banque['agence'];
                            $datee['code_banque'] = $banque['code_banque'];
                            $datee['swift'] = $banque['swift'];
                            $datee['compte'] = $banque['compte'];
                            $datee['rib'] = $banque['rib'];

                            $datee['fournisseur_id'] = $id;
                            //debug($banque['banque_id']);die;
                            // debug($datee);//die;
                            if (isset($banque['id']) && (!empty($banque['id']))) {
                                //debug($banque['id']);die();
                                $fournisseurbanques = $this->fetchTable('Fournisseurbanques')->get($banque['id'], [
                                    'contain' => []
                                ]);
                                //debug('rrr');
                            } else {
                                ////debug('uuu');
                                $fournisseurbanques = $this->fetchTable('Fournisseurbanques')->newEmptyEntity();
                            };
                            //debug($datee);die();


                            $document = $banque['documenttt'];
                            //  $document = $this->request->getData('document');
                            //debug($doc);//die;
                            if (!empty($document)) {
                                $name = $document->getClientFilename();
                                /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
                                   mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775);*/
                                // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
                                $targetPath = WWW_ROOT . 'img'  . DS . $name;
                                // debug($name);die;
                                if (!empty($name)) {
                                    $document->moveTo($targetPath);
                                    $fournisseurbanques->document  = $name;
                                }
                            }
                            $fournisseurbanques = $this->fetchTable('Fournisseurbanques')->patchEntity($fournisseurbanques, $datee);

                            if ($this->fetchTable('Fournisseurbanques')->save($fournisseurbanques)) {

                                //$this->Flash->success("Fournisseurbanques has been òodified successfully");
                            } else {
                                //$this->Flash->error("Failed to midify fournisseurbanques");
                            }
                        } else {
                            //S  $this->request->allowMethod(['post', 'delete']);
                            if (!empty($banque['id']))

                                $fournisseurbanques = $this->fetchTable('Fournisseurbanques')->get($banque['id']);
                            $this->fetchTable('Fournisseurbanques')->delete($fournisseurbanques);
                        }
                    }
                }
                $this->set(compact("fournisseurbanques"));
                // debug($this->request->getData('data')['lignes']);
                if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {

                    foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
                        //debug($exon);
                        $this->loadModel('Exonerations');
                        if ($exon['sup2'] != 1) {
                            $data2['typeexon_id'] = $exon['typeexon_id'];
                            $data2['num_att_taxes'] = $exon['num_att_taxes'];
                            $data2['date_debut'] = $exon['date_debut'];
                            $data2['date_fin'] = $exon['date_fin'];
                            //$data2['documentt'] = $exon['document'];

                            $data2['fournisseur_id'] = $fournisseur_id;
                            //debug($data2);//die;
                            if (isset($exon['id']) && (!empty($exon['id']))) {
                                $exonerations = $this->fetchTable('Exonerations')->get($exon['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $exonerations = $this->fetchTable('Exonerations')->newEmptyEntity();
                            };
                            $document = $exon['documentt'];
                            // $document = $this->request->getData($data2['documentt'] );
                            //debug($image);die;
                            if (!empty($document)) {

                                $name = $document->getClientFilename();
                                /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
                               mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775);*/
                                // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
                                $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                                if (!empty($name)) {
                                    $document->moveTo($targetPath);
                                    $exonerations->document = $name;
                                }
                            }
                            $exonerations = $this->fetchTable('Exonerations')->patchEntity($exonerations, $data2);

                            if ($this->fetchTable('Exonerations')->save($exonerations)) {
                            } else {


                                //$this->Flash->error("Failed to midify adresselivraisonfournisseurs");
                            }
                        } else {
                            if (!empty($exon['id']))
                                $exonerations = $this->fetchTable('Exonerations')->get($exon['id']);
                            $this->fetchTable('Exonerations')->delete($exonerations);
                        }
                    }
                }
                $this->set(compact("exonerations"));
                // $this->Flash->success(__('The {0} has been saved.', 'Fournisseur'));
                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fournisseur'));
        }
        $this->loadModel('Adresselivraisonfournisseurs');
        $this->loadModel('Fournisseurresponsables');
        $this->loadModel('Fournisseurbanques');
        $this->loadModel('Typeexons');
        $adressees = $this->Adresselivraisonfournisseurs->find('all', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(["Adresselivraisonfournisseurs.fournisseur_id like  '%" . $id . "%' "]);
        $responsable = $this->Fournisseurresponsables->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Fournisseurresponsables.fournisseur_id like  '%" . $id . "%' "]);
        $banquess = $this->Fournisseurbanques->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Fournisseurbanques.fournisseur_id = " . $id . ""]);
        $ban = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $exoner = $this->Exonerations->find('all')->where(["Exonerations.fournisseur_id = " . $id . ""]);
        $typeexonerations = $this->Fournisseurs->Typeexons->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list', ['limit' => 200]);
        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['limit' => 200]);
        //    $villes = $this->Fournisseurs->Villes->find('list', ['limit' => 200]);
        // $regions = $this->Fournisseurs->Regions->find('list', ['limit' => 200]);
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $delegations = $this->fetchTable('Delegations')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $localites = $this->fetchTable('Localites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $paiements = $this->Fournisseurs->Paiements->find('list', ['limit' => 200]);
        $devises = $this->Fournisseurs->Devises->find('list', ['limit' => 200]);
        $this->set(compact('delegations', 'localites', 'gouvernorats', 'pays', 'banquess', 'typeexonerations', 'fournisseur', 'exoner', 'ban', 'responsable', 'typeutilisateurs', 'typelocalisations', 'adressees',  'paiements', 'devises'));
    }

    //    public function edit($id = null)
    //    {  
    //          
    //        $fournisseur = $this->Fournisseurs->get($id, [
    //            'contain' => ['Typeutilisateurs', 'Fournisseurresponsables','Fournisseurbanques','Typelocalisations', 'Villes', 'Regions', 'Pays', 'Paiements', 'Devises', 'Adresselivraisonfournisseurs', 'Articlefournisseurs', 'Bandeconsultations', 'Commandes', 'Exonerations', 'Factures', 'Fournisseurbanques', 'Fournisseurresponsables', 'Lignebandeconsultations', 'Lignecommandes', 'Lignedemandeoffredeprixes', 'Lignefactures', 'Lignelignebandeconsultations', 'Lignelivraisons', 'Livraisons', 'Livraisonsanc']
    //        ]);
    //        
    //     
    //                
    //        if ($this->request->is(['patch', 'post', 'put'])) {
    //            
    //if ($this->Fournisseurs->save($fournisseur)) {
    //    
    //
    //                   
    //                 
    ////debug($this->request->data['lignes']);die;
    //
    //        } 
    //             //debug($this->request->getData());die;
    //            $fournisseur = $this->Fournisseurs->patchEntity($fournisseur, $this->request->getData());
    //            if ($this->Fournisseurs->save($fournisseur)) {
    //                $this->Flash->success(__('The {0} has been saved.', 'Fournisseur'));
    //
    //                return $this->redirect(['action' => 'index']);
    //            }
    //            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fournisseur'));
    //        }
    //        $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list', ['limit' => 200]);
    //        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['limit' => 200]);
    //        $villes = $this->Fournisseurs->Villes->find('list', ['limit' => 200]);
    //        $regions = $this->Fournisseurs->Regions->find('list', ['limit' => 200]);
    //        $pays = $this->Fournisseurs->Pays->find('list', ['limit' => 200]);
    //        $paiements = $this->Fournisseurs->Paiements->find('list', ['limit' => 200]);
    //        $devises = $this->Fournisseurs->Devises->find('list', ['limit' => 200]);
    //        $this->set(compact('fournisseur', 'typeutilisateurs', 'typelocalisations', 'villes', 'regions', 'pays', 'paiements', 'devises'));
    //    }

    public function getdevise($id = null)
    {

        $id = $this->request->getQuery('id');

        //debug($id);
        //die;
        if ($id == 1) {
            $query = $this->fetchTable('Devises')->find();
            $query->where(['id' => 4]);

            $select = "

        <label class='control-label' for='devise-id'>Devise</label>
        <select name='devise_id' id='devise_id' class='form-control select2'   >
				";
            foreach ($query as $q) {
                $select =  $select . "	<option value ='" . $q['id'] . "'";
                $select =  $select . " >" . $q['name'] . "</option>";
            }
            $select = $select . "</select> </div> </div> ";
        } else {
            $query = $this->fetchTable('Devises')->find();

            $select = "

        <label class='control-label' for='devise-id'>Devise</label>
        <select name='devise_id' id='devise_id' class='form-control select2'   >
					<option value=''  selected='selected' disabled>Veuillez choisir !!</option>";
            foreach ($query as $q) {
                $select =  $select . "	<option value ='" . $q['id'] . "'";
                $select =  $select . " >" . $q['name'] . "</option>";
            }
            $select = $select . "</select> </div> </div> ";
        }
        // 



        echo json_encode(array('select' => $select));
        exit;
    }

    /**
     * Delete method
     *
     * @param string|null $id Fournisseur id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        //   debug($liendd);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'fournisseurs') {
                $fournisseur = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }







        //   $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('Fournisseurbanques');
        //          $lignedemande=$this->Fournisseurbanques->find('all', [])
        //                ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);
        //           foreach ($lignedemande as $c) {
        //                $this->Demandeoffredeprixes->Lignedemandeoffredeprixes->delete($c);
        //            }
        // $this->Fournisseurbanques->deleteAll(['Fournisseurbanques.fournisseur_id ='.$id]);
        $fournisseurbanque = $this->Fournisseurbanques->find('all', [])->where(['Fournisseurbanques.fournisseur_id =' . $id]);
        foreach ($fournisseurbanque as $c) {
            $this->Fournisseurbanques->delete($c);
        }
        $this->loadModel('Fournisseurresponsables');
        $fournisseurresponsable = $this->Fournisseurresponsables->find('all', [])->where(['Fournisseurresponsables.fournisseur_id =' . $id]);
        foreach ($fournisseurresponsable as $c) {
            $this->Fournisseurresponsables->delete($c);
        }
        $this->loadModel('Adresselivraisonfournisseurs');
        $adresselivraisonfournisseur = $this->Adresselivraisonfournisseurs->find('all', [])->where(['Adresselivraisonfournisseurs.fournisseur_id =' . $id]);
        foreach ($adresselivraisonfournisseur as $c) {
            $this->Adresselivraisonfournisseurs->delete($c);
        }
        $this->loadModel('Exonerations');
        $exoneration = $this->Exonerations->find('all', [])->where(['Exonerations.fournisseur_id =' . $id]);
        foreach ($exoneration as $c) {
            $this->Exonerations->delete($c);
        }
        $fournisseur = $this->Fournisseurs->get($id);
        if ($this->Fournisseurs->delete($fournisseur)) {
            $fournisseur_id = ($this->Fournisseurs->save($fournisseur)->id);
            $this->misejour("Fournisseurs", "delete", $fournisseur_id);
            //  $this->Flash->success(__('The {0} has been deleted.', 'Fournisseur'));
        } else {
            // $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Fournisseur'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;


use Cake\I18n\FrozenDate;

/**
 * Demandeoffredeprixes Controller
 *
 * @property \App\Model\Table\DemandeoffredeprixesTable $Demandeoffredeprixes
 * @method \App\Model\Entity\Demandeoffredeprix[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DemandeoffredeprixesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view   
     */
    public function imprimeview02052024($id = null)
    {
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, []);
        $this->loadModel('Lignelignebandeconsultations');
        $frs = $this->Lignelignebandeconsultations->find('all')->where(["demandeoffredeprix_id=" . $id . ""])
            ->group(["nomfr" => '(Lignelignebandeconsultations.nameF)']);
        $j = 0;
        $tab[] = array();
        foreach ($frs as $j => $tab)
            $nb = $this->Lignelignebandeconsultations->find('all')
                ->where(["demandeoffredeprix_id=" . $id . ""])
                ->group(["nomfr" => '(Lignelignebandeconsultations.nameF)'])
                ->order(["Lignelignebandeconsultation.t"])
                ->count('*');

        //debug($nb);


        $this->loadModel('Lignebandeconsultations');
        $lignebande = $this->Lignebandeconsultations->find('all')->where(["demandeoffredeprix_id=" . $id . ""])
            ->group(["nomart" => '(Lignebandeconsultations.designiationA)']);



        //debug($bandeconsultation); 
        $i = 0;
        $tab1[] = array();
        foreach ($lignebande as $i => $tab1)
            $this->set(compact('demandeoffredeprix', 'frs', 'tab', 'lignebande', 'tab1'));
    }

    public function index($typeof = null)
    {
        $cond2 = '';
        $cond1 = '';
        $cond3 = '';
        $numero = $this->request->getQuery('numero');
        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        if ($numero) {
            $cond1 = "Demandeoffredeprixes.numero  like'%" . $numero . "%'";
        }
        if ($datedebut) {
            $cond2 = "Demandeoffredeprixes.date >='" . $datedebut . "'";
        }

        if ($datefin) {
            $cond3 = "Demandeoffredeprixes.date <='" . $datefin . "'";
        }

        $condtype = "Demandeoffredeprixes.typeoffredeprix=" . $typeof;


        $query = $this->Demandeoffredeprixes->find('all')->order(['Demandeoffredeprixes.id' => 'DESC'])->where([$condtype, $cond1, $cond2, $cond3]);
            // ->order(['Demandeoffredeprixes.id' => 'DESC']);
        $recherches = $this->paginate($query);
        // $demandeoffredeprixes = $this->paginate($this->Demandeoffredeprixes);
        $this->set(compact('typeof', 'demandeoffredeprixes', 'numero', 'datefin', 'datedebut', 'recherches', 'numero', 'datedebut', 'datefin'));
        //debug($recherches);die();
    }

    /**
     * View method
     *
     * @param string|null $id Demandeoffredeprix id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.


     * 
     * @param string|null $id
     * 
     * 
     */
    public function view($typeof = null, $id = null)
    {

        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $this->loadModel('Lignedemandeoffredeprixes');
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Bandeconsultations', 'Lignebandeconsultations', 'Lignedemandeoffredeprixes', 'Lignelignebandeconsultations'],
        ]);

        $articles = $this->Demandeoffredeprixes->Articles->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($article) {
                return $article->Code . ' (' . $article->Dsignation . ')';
            }
        ])->where(['Articles.famille_id = 2']); // ->where(["Articles.vente =0" ])
        // ;

        $fournisseurs = $this->Demandeoffredeprixes->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
        $ligneas = $this->Lignedemandeoffredeprixes->find('all')
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);

        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('ligneas', 'lignefs', 'demandeoffredeprix', 'articles', 'fournisseurs', 'typeof','machines','services'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($typeof = null)
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_parametrage' . $abrv);
        // //   debug($liendd);
        // $dmd = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'demandeoffredeprixes') {
        //         $dmd = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($dmd <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }





        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $this->loadModel('Lignedemandeoffredeprixes');

        $yearf = date('Y');
        $currentYear = date('y');
        $num = $this->Demandeoffredeprixes->find()->select([
            "num" =>
            'MAX(Demandeoffredeprixes.numero)'
        ])->where('YEAR(Demandeoffredeprixes.date)=' . $yearf)->first();

        $n = $num->num;

        if ($n) {
            $lastFourDigits = substr($n, -4);
            $in = intval($lastFourDigits) + 1;
        } else {
            $in = '0001';
        }

        $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
        $b = "DF{$currentYear}00{$mm}";

        $this->set(compact('b'));
        // $num = $this->Demandeoffredeprixes->find()->select([
        //     "numdepot" =>
        //     'MAX(Demandeoffredeprixes.numero)'
        // ])->first();
        // $numero = $num->numdepot;
        // //  DOF00001
        // $n = 0;
        // $n = $numero;
        // if (!empty($n)) {
        //     $ff = intval(substr($n, 3, 7)) + 1;
        //     $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
        //     $c = str_pad("$z", 6, 'F', STR_PAD_LEFT);
        //     $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
        //     $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
        // } else {
        //     $n = "00001";
        //     $c = str_pad("$n", 6, 'F', STR_PAD_LEFT);
        //     $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
        //     $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
        // }
        // $this->set(compact('b'));
        $demandeoffredeprix = $this->Demandeoffredeprixes->newEmptyEntity();
        if ($this->request->is('post')) {
            // $num = $this->Demandeoffredeprixes->find()->select([
            //     "numdepot" =>
            //     'MAX(Demandeoffredeprixes.numero)'
            // ])->first();
            // $numero = $num->numdepot;
            // //  DOF00001
            // $n = 0;
            // $n = $numero;
            // if (!empty($n)) {
            //     $ff = intval(substr($n, 3, 7)) + 1;
            //     $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            //     $c = str_pad("$z", 6, 'F', STR_PAD_LEFT);
            //     $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
            //     $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
            // } else {
            //     $n = "00001";
            //     $c = str_pad("$n", 6, 'F', STR_PAD_LEFT);
            //     $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
            //     $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
            // }
            // $this->set(compact('b'));

            //            debug( $this->request->getData());

            $inputDate = $this->request->getData('date');

            $yearf = date('Y', strtotime($inputDate));

            $currentYear = date('y', strtotime($inputDate));
            $num = $this->Demandeoffredeprixes->find()->select([
                "num" =>
                'MAX(Demandeoffredeprixes.numero)'
            ])->where('YEAR(Demandeoffredeprixes.date)=' . $yearf)->first();

            $n = $num->num;

            if ($n) {
                $lastFourDigits = substr($n, -4);
                $in = intval($lastFourDigits) + 1;
            } else {
                $in = '0001';
            }

            $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
            $b = "DF{$currentYear}00{$mm}";
            $demandeoffredeprix = $this->Demandeoffredeprixes->patchEntity($demandeoffredeprix, $this->request->getData());

            $demandeoffredeprix->typeoffredeprix = $typeof;
            if ($this->Demandeoffredeprixes->save($demandeoffredeprix)) {
                $demandeoffredeprix_id = ($this->Demandeoffredeprixes->save($demandeoffredeprix)->id);
                $this->misejour("Demandeoffredeprixes", "add", $demandeoffredeprix_id);



                $id = $demandeoffredeprix->id;
                debug($this->request->getData('data'));

                if (isset($this->request->getData('data')['Ofsfligne']) && (!empty($this->request->getData('data')['Ofsfligne']))) {
                  
                    foreach ($this->request->getData('data')['Ofsfligne'] as $j => $fourni) {
                        
                        if ($fourni['sup'] != 1  && (!empty($fourni['fournisseur_id']))) {
                           
                            debug($fourni);

                            if ($fourni['fournisseur_id']) {
                                $fr = $this->Fournisseurs->find()->select(["nomfour" => '(Fournisseurs.name)'])->where(["Fournisseurs.id" => $fourni['fournisseur_id']])->first();
                                $frr = $fr->nomfour;
                                $fourni['nameF'] = $frr;
                            } else {
                                $fourni['nameF'] = $fourni['fournisseur_idd'];
                            }
                            
                            if (isset($fourni['Phaseofsf']) && (!empty($fourni['Phaseofsf']))) {
                                 
                                $this->loadModel('Articles');
                                foreach ($fourni['Phaseofsf'] as $i => $art) {
                                    
                                 debug( $art);
                                 
                                    if ( $art['supp2'] != 1  && (!empty( $art['art_id'])) ) {
                                       
                                        if ( $art['art_id']) {

                                            $ar = $this->Articles->find()->select(["nomarticle" => '(Articles.Dsignation)'])->where(["Articles.id" => $art['art_id']])->first();
                                            $arr = $ar->nomarticle;
                                            $art['designiationA'] = $arr;
                                        } else {
                                            $art['designiationA'] = $art['designiationA'];
                                        }
                                        $data['demandeoffredeprix_id'] = $id;
                                        $data['article_id'] = $art['art_id'];
                                        $data['designiationA'] = $art['designiationA'];
                                        $data['qte'] = $art['qte'];
                                        $data['fournisseur_id'] = $fourni['fournisseur_id'];
                                        $data['nameF'] = $fourni['nameF'];

                                        $demandeoffre = $this->fetchTable('Lignedemandeoffredeprixes')->newEmptyEntity();
                                        $demandeoffre = $this->Lignedemandeoffredeprixes->patchEntity($demandeoffre, $data);
                                        if ($this->Lignedemandeoffredeprixes->save($demandeoffre)) {
                                        }
                                    }
                                }
                            }
                        }
                    }
                    return $this->redirect(['action' => 'index/' . $typeof]);
                } else {
                }
            }
        }


        $fournisseurs = $this->Demandeoffredeprixes->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => function ($article) {
            return $article->Code . ' (' . $article->Dsignation . ')';
        }]) ;  //->where(['Articles.famille_id = 2']);
        $this->set(compact('demandeoffredeprix', 'fournisseurs','typeof', 'articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Demandeoffredeprix id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($typeof = null, $id = null)
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_parametrage' . $abrv);
        // //   debug($liendd);
        // $dmd = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'demandeoffredeprixes') {
        //         $dmd = $liens['modif'];
        //     }
        // }
        // // debug($societe);die;
        // if (($dmd <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        $this->loadModel('Fournisseurs');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Lignedemandeoffredeprixes']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $demandeoffredeprix = $this->Demandeoffredeprixes->patchEntity($demandeoffredeprix, $this->request->getData());
            if ($this->Demandeoffredeprixes->save($demandeoffredeprix)) {
                $dmd_id = ($this->Demandeoffredeprixes->save($demandeoffredeprix)->id);
                $this->misejour("Demandeoffredeprixes", "edit", $dmd_id);

                $demande_id = $demandeoffredeprix->id;
                $lignedemande = $this->Lignedemandeoffredeprixes->find('all', [])
                    ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);
                foreach ($lignedemande as $c) {
                    $this->Demandeoffredeprixes->Lignedemandeoffredeprixes->delete($c);
                }

                if (isset($this->request->getData('data')['lignef']) && (!empty($this->request->getData('data')['lignef']))) {
                    foreach ($this->request->getData('data')['lignef'] as $j => $fourni) {
                        //                       debug($fourni);
                        if ($fourni['sup1'] != 1) {
                            if ($fourni['fournisseur_id']) {
                                $fr = $this->Fournisseurs->find()->select(["nomfour" => '(Fournisseurs.name)'])->where(["Fournisseurs.id" => $fourni['fournisseur_id']])->first();
                                $frr = $fr->nomfour;
                                $fourni['nameF'] = $frr;
                            } else {
                                $fourni['nameF'] = $fourni['nameF'];
                            }
                            if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
                                $this->loadModel('Articles');
                                foreach ($this->request->getData('data')['lignea'] as $i => $art) {
                                    // debug($art);
                                    if ($art['sup0'] != 1) {
                                        if ($art['article_id']) {
                                            $ar = $this->Articles->find()->select(["nomarticle" => '(Articles.Dsignation)'])->where(["Articles.id" => $art['article_id']])->first();
                                            $arr = $ar->nomarticle;
                                            $art['designiationA'] = $arr;
                                        } else {
                                            $art['designiationA'] = $art['designiationA'];
                                        }

                                        $data['demandeoffredeprix_id'] = $id;
                                        $data['article_id'] = $art['article_id'];
                                        $data['designiationA'] = $art['designiationA'];
                                        $data['qte'] = $art['qte'];
                                        $data['fournisseur_id'] = $fourni['fournisseur_id'];
                                        $data['nameF'] = $fourni['nameF'];

                                        $demandeoffre = $this->fetchTable('Lignedemandeoffredeprixes')->newEmptyEntity();
                                        $demandeoffre = $this->Lignedemandeoffredeprixes->patchEntity($demandeoffre, $data);
                                        if ($this->Lignedemandeoffredeprixes->save($demandeoffre)) {
                                        }

                                        //                             
                                    }
                                }
                            }
                        }
                    }
                    return $this->redirect(['action' => 'index/' . $typeof]);
                }
                return $this->redirect(['action' => 'index/' . $typeof]);
            }
        }
        $articles = $this->Demandeoffredeprixes->Articles->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($article) {
                return $article->Code . ' (' . $article->Dsignation . ')';
            }
        ]); 
       // debug($articles->toarray());
        //->where(['Articles.famille_id = 2']); // ->where(["Articles.vente =0" ])
        // ;
        $articless = $this->fetchTable('Articles')->find('all', [
            'keyfield' => 'id',
            'valueField' => function ($article) {
                return $article->Code . ' (' . $article->Dsignation . ')';
            }
        ]);
       // debug($articless->toarray()) ;
        $fournisseurs = $this->Demandeoffredeprixes->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
        $ligneas = $this->Lignedemandeoffredeprixes->find('all')
            ->group(["article_id" => '(Lignedemandeoffredeprixes.article_id)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);

        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('ligneas', 'lignefs','articless', 'demandeoffredeprix', 'articles', 'fournisseurs', 'typeof', 'services', 'machines'));
    }



    public function adddemande($tab, $type)
    {
        $this->loadModel('Fournisseurs');
        $this->loadModel('Lignebesionachats');
        $this->loadModel('Articles');
        $demandeoffredeprix = $this->Demandeoffredeprixes->newEmptyEntity();

        $tab = explode(',', $tab);
        $tab = array_map('intval', $tab);

        $besoins = $this->fetchTable('Besionachats')
            ->find('all')
            ->where(['Besionachats.id IN' => $tab])
            ->toArray();

        $listbesoins = $this->fetchTable('Besionachats')
            ->find('all')
            ->where(['Besionachats.id IN' => $tab]);

        $firstbesoins = $this->fetchTable('Besionachats')
            ->find('all')
            ->where(['Besionachats.id IN' => $tab])->first();

        //debug($besoin);
        $yearf = date('Y');
        $currentYear = date('y');
        $num = $this->Demandeoffredeprixes->find()->select([
            "num" =>
            'MAX(Demandeoffredeprixes.numero)'
        ])->where('YEAR(Demandeoffredeprixes.date)=' . $yearf)->first();

        $n = $num->num;

        if ($n) {
            $lastFourDigits = substr($n, -4);
            $in = intval($lastFourDigits) + 1;
        } else {
            $in = '0001';
        }

        $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
        $b = "DF{$currentYear}00{$mm}";

        $this->set(compact('b'));
        if ($this->request->is('post')) {
            //  debug($this->request->getData());die;
            $inputDate = $this->request->getData('date');

            $yearf = date('Y', strtotime($inputDate));

            $currentYear = date('y', strtotime($inputDate));
            $num = $this->Demandeoffredeprixes->find()->select([
                "num" =>
                'MAX(Demandeoffredeprixes.numero)'
            ])->where('YEAR(Demandeoffredeprixes.date)=' . $yearf)->first();

            $n = $num->num;

            if ($n) {
                $lastFourDigits = substr($n, -4);
                $in = intval($lastFourDigits) + 1;
            } else {
                $in = '0001';
            }

            $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
            $b = "DF{$currentYear}00{$mm}";
            // debug($b);




            $dataa['numero'] = $b;
            $dataa['date'] = $this->request->getData('date');
            $dataa['typeoffredeprix'] = $type;
            $dataa['service_id'] = $this->request->getData('service_id');
            $dataa['machine_id'] = $this->request->getData('machine_id');
            $dataa['observation'] = $this->request->getData('observation');

            $demandeoffredeprix = $this->Demandeoffredeprixes->patchEntity($demandeoffredeprix, $dataa);

            if ($this->Demandeoffredeprixes->save($demandeoffredeprix)) {
                $dmd_id = ($this->Demandeoffredeprixes->save($demandeoffredeprix)->id);
                $this->misejour("Demandeoffredeprixes", "add", $dmd_id);
                $id = $demandeoffredeprix->id;


                foreach ($listbesoins as $lb) {
                    $lb->demandeoffredeprixe_id = $id;
                    $this->fetchTable('Besionachats')->save($lb);
                }



                if (isset($this->request->getData('data')['lignef']) && (!empty($this->request->getData('data')['lignef']))) {
                    foreach ($this->request->getData('data')['lignef'] as $j => $fourni) {
                        if ($fourni['sup1'] != 1) {
                            //                           debug($fourni);
                            if ($fourni['fournisseur_id']) {
                                $fr = $this->Fournisseurs->find()->select(["nomfour" => '(Fournisseurs.name)'])->where(["Fournisseurs.id" => $fourni['fournisseur_id']])->first();
                                $frr = $fr->nomfour;
                                $fourni['nameF'] = $frr;
                            } else {
                                $fourni['nameF'] = $fourni['fournisseur_idd'];
                            }

                            if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                                $this->loadModel('Articles');
                                foreach ($this->request->getData('data')['ligner'] as $i => $art) {

                                    if ($art['sup0'] != 1) {

                                        $data['demandeoffredeprix_id'] = $id;
                                        $data['article_id'] = $art['article_id'];
                                        $data['designiationA'] = $art['designiationA'];
                                        $data['qte'] = $art['qte'];
                                        $data['fournisseur_id'] = $fourni['fournisseur_id'];
                                        $data['nameF'] = $fourni['nameF'];

                                        $demandeoffre = $this->fetchTable('Lignedemandeoffredeprixes')->newEmptyEntity();
                                        $demandeoffre = $this->fetchTable('Lignedemandeoffredeprixes')->patchEntity($demandeoffre, $data);
                                        if ($this->fetchTable('Lignedemandeoffredeprixes')->save($demandeoffre)) {
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                }
                return $this->redirect(['action' => 'index/' . $type]);
            }
        }

        $lignes = $this->fetchTable('Lignebesionachats')
            ->find('all', [
                'contain' => ['Articles'],
            ])
            ->select([
                'article_id',
                'desginationA',
                'total_qte' => $this->fetchTable('Lignebesionachats')->query()->func()->sum('qte'),
            ])
            ->where(['besionachat_id IN' => $tab])
            ->group(['article_id', 'desginationA'])
            ->toArray();



        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']); //->where(['Articles.famille_id = 2']);
        ///debug($articles->toarray());
        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('demandeoffredeprix', 'besoins', 'lignes',  'articles', 'fournisseurs', 'services', 'machines', 'firstbesoins'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Demandeoffredeprix id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($typeof = null, $id = null)
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_parametrage' . $abrv);
        // //   debug($liendd);
        // $dmd = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'demandeoffredeprixes') {
        //         $dmd = $liens['supp'];
        //     }
        // }
        // // debug($societe);die;
        // if (($dmd <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->request->allowMethod(['post', 'delete']);
        $demande = $this->Demandeoffredeprixes->get($id);
        $lignedemande = $this->Lignedemandeoffredeprixes->find('all')
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
        foreach ($lignedemande as $c) {
            $this->Demandeoffredeprixes->Lignedemandeoffredeprixes->delete($c);
        }


        $bandeconsultations = $this->fetchTable('Bandeconsultations')->find('all')
            ->where(["Bandeconsultations.demandeoffredeprix_id  ='" . $id . "'"]);
        foreach ($bandeconsultations as $bandeconsultation) {
            $lignebandeconsultations = $this->fetchTable('Lignebandeconsultations')->find()
                ->where(['bandeconsultation_id' => $bandeconsultation->id]);

            foreach ($lignebandeconsultations as $lignebandeconsultation) {
                $this->fetchTable('Lignebandeconsultations')->delete($lignebandeconsultation);
            }

            $this->fetchTable('Bandeconsultations')->delete($bandeconsultation);
        }

        $ligneligne = $this->fetchTable('Lignelignebandeconsultations')->find('all')
            ->where(["Lignelignebandeconsultations.demandeoffredeprix_id  ='" . $id . "'"]);
        foreach ($ligneligne as $lil) {
            $this->fetchTable('Lignelignebandeconsultations')->delete($lil);
        }


        if ($this->Demandeoffredeprixes->delete($demande)) {

            $listbesoins = $this->fetchTable('Besionachats')
                ->find('all')
                ->where(['Besionachats.demandeoffredeprixe_id ' => $id]);

            foreach ($listbesoins as $lb) {
                $lb->demandeoffredeprixe_id = 0;
                $this->fetchTable('Besionachats')->save($lb);
            }
            $dmd_id = ($this->Demandeoffredeprixes->save($demande)->id);
            $this->misejour("Demandeoffredeprixes", "delete", $dmd_id);
        }


        return $this->redirect(['action' => 'index/' . $typeof]);
    }
    public function imprimeview($id = null)
    {
        $this->loadModel('Lignelignebandeconsultations');
        $fr = $this->fetchTable('Lignelignebandeconsultations')->find('list')->where(["demandeoffredeprix_id=" . $id . ""])
        ->group(["nomfr" => '(Lignelignebandeconsultations.nameF)']);

        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, []);
        $this->loadModel('Lignebandeconsultations');
        $frs = $this->fetchTable('Lignebandeconsultations')->find('all')->where(["demandeoffredeprix_id=" . $id . ""])
        ->group(["nomfr" => '(Lignebandeconsultations.nameF)'])->contain('Articles');
        

      /// debug($frs->toarray());             
        $this->set(compact('demandeoffredeprix','fr', 'frs'));
    }
    public function imprimerr($id = null)
    {
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, []);
        $this->loadModel('Lignedemandeoffredeprixes');
        $frs = $this->fetchTable('Lignedemandeoffredeprixes')->find('all')->where(["demandeoffredeprix_id=" . $id . ""]);
           // ->group(["nomfr" => '(Lignedemandeoffredeprixes.nameF)']);
       // debug($frs->toArray());
        // $j = 0;
        // $tab[] = array();
        // foreach ($frs as $j => $tab)
        //     $nb = $this->fetchTable('Lignedemandeoffredeprixes')->find('all')
        //         ->where(["demandeoffredeprix_id=" . $id . ""])
        //         ->group(["nomfr" => '(Lignedemandeoffredeprixes.nameF)'])
        //         ->order(["Lignedemandeoffredeprixes.t"])
        //         ->count('*');

        //debug($nb);


        $this->loadModel('Lignebandeconsultations');
        // $lignebande = $this->Lignebandeconsultations->find('all')->where(["demandeoffredeprix_id=" . $id . ""])
        //     ->group(["nomart" => '(Lignebandeconsultations.designiationA)']);

            
            $lignebande = $this->fetchTable('Lignedemandeoffredeprixes')->find('all')->where(["demandeoffredeprix_id=" . $id . ""])->contain('Articles');
        //debug($lignebande->toarray()); 
        $i = 0;
        $tab1[] = array();
        foreach ($lignebande as $i => $tab1)
            $this->set(compact('demandeoffredeprix', 'frs', 'lignebande', 'tab1'));
    }

    public function imprimerrecherche()
    {

        $cond2 = '';
        $cond1 = '';
        $cond3 = '';
        $numero = $this->request->getQuery('numero');
        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');

        if ($numero) {
            $cond1 = "Demandeoffredeprixes.numero  ='" . $numero . "'";
        }

        if ($datedebut) {
            $cond2 = "Demandeoffredeprixes.date ='" . $datedebut . "'";
        }

        if ($datefin) {
            $cond3 = "Demandeoffredeprixes.date ='" . $datefin . "'";
        }



        //echo $cond1.'-'. $cond2.$cond3;

        $query = $this->Demandeoffredeprixes->find('all')->where([$cond1, $cond2, $cond3]);
        $recherches = $this->paginate($query);

        $demandeoffredeprixes = $this->paginate($this->Demandeoffredeprixes);

        $this->set(compact('demandeoffredeprixes', 'recherches'));
        //debug($recherches);die(); 
    }

    public function bandeconsultation($typeof = null, $id = null)
    {
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        if (!$this->Demandeoffredeprixes->exists($id)) {
            throw new NotFoundException(__('Invalid demandeoffredeprix'));
        }
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Lignedemandeoffredeprixes']
        ]);
        if ($this->request->is('post') || $this->request->is('put')) {
            $data['demandeoffredeprix_id'] = $this->request->getData()['id'];
            if (isset($this->request->getData('data')['fligne']) && (!empty($this->request->getData('data')['fligne']))) {
                foreach ($this->request->getData('data')['fligne'] as $j => $fourni) {
                    //debug($fourni['fournisseur_id']);die;
                    $data['fournisseur_id'] = $fourni['fournisseur_id'];
                    $data['nameF'] = $fourni['nameF'];
                    $data['t'] = $fourni['t'];
                    if (isset($this->request->getData('data')['fligne'][$j]['aligne']) && (!empty($this->request->getData('data')['fligne'][$j]['aligne']))) {
                        foreach ($this->request->getData('data')['fligne'][$j]['aligne'] as $i => $art) {
                            $data['article_id'] = $art['article_id'];
                            $data['designiationA'] = $art['designiationA'];
                            $data['qte'] = $art['qte'];
                            $data['prix'] = $art['prix'];
                            $data['tva'] = $art['tva'];
                            $data['fodec'] = $art['fodec'];
                            $data['remise'] = $art['remise'];
                            $data['totalprix'] = $art['total'];
                            $data['ht'] = $art['total'];
                            $data['lignedemandeoffredeprix_id'] = $art['ligne_id'];
                            $data['codefrs'] = $art['codefrs'];
                            $bande = $this->fetchTable('Bandeconsultations')->newEmptyEntity();
                            $bande = $this->Bandeconsultations->patchEntity($bande, $data);
                            if ($this->Bandeconsultations->save($bande)) {
                                $bande_id = ($this->Bandeconsultations->save($bande)->id);
                                $this->misejour("Bandeconsultations", "add", $bande_id);

                                //$this->Flash->success("Bandeconsultation offre de prix has been created successfully");
                            } else {
                                //$this->Flash->error("Failed to create Bandeconsultation offre de prix");
                            }
                            $this->set(compact("bande"));
                            $data['bandeconsultation_id'] = $bande->id;
                            //debug( $data['bandeconsultation_id']);die;
                            $lignebande = $this->fetchTable('Lignebandeconsultations')->newEmptyEntity();
                            $lignebande = $this->Lignebandeconsultations->patchEntity($lignebande, $data);
                            if ($this->Lignebandeconsultations->save($lignebande)) {

                                //debug($id);die;
                                //    $this->loadModel('Demandeoffredeprixes');
                                //  //  debug($id);die;
                                //            $dmd = $this->Demandeoffredeprixes->find('all')
                                //                    ->where(["Demandeoffredeprixes.id='" .$id. "'"])->update()
                                //                    ->set(['consultation' => '1'])
                                //                    ->execute
                                //                            $this->Demandeoffredeprixes->id = $id;
                                // $articlesTable = TableRegistry::getTableLocator()->get('Demandeoffredeprixes'); 
                                $article = $this->Demandeoffredeprixes->get($id);
                                $article->consultation = '1';
                                $this->Demandeoffredeprixes->save($article);
                                $demande_id = ($this->Demandeoffredeprixes->save($article)->id);
                                $this->misejour("Demandeoffredeprixes", "update", $demande_id);




                                //            $dmd = $this->Demandeoffredeprixes->find('all')
                                //                    ->where(["Demandeoffredeprixes.id='" . $id . "'"])->update()
                                //                    ->set(['consultation' => '1'])
                                //                    ->execute();
                                //$this->Flash->success("Lignebandeconsultations offre de prix has been created successfully");
                            } else {
                                // $this->Flash->error("Failed to create Lignebandeconsultations offre de prix");
                            }
                            $this->set(compact("lignebande"));
                        }
                    }
                    //$data['lignebandeconsultation_id']=$lignebande->id;

                    $ligneligne = $this->fetchTable('Lignelignebandeconsultations')->newEmptyEntity();
                    $ligneligne = $this->Lignelignebandeconsultations->patchEntity($ligneligne, $data);
                    if ($this->Lignelignebandeconsultations->save($ligneligne)) {
                    } else {
                        // $this->Flash->error("Failed to create Lignelignebandeconsultation offre de prix");
                    }
                    $this->set(compact("ligneligne"));
                }
            }



            $this->redirect(array('action' => 'etatcomparatif', $typeof, $id));
        } else {
            //$options = array('conditions' => array('Demandeoffredeprixes.' . $this->Demandeoffredeprixes->primaryKey => $id));
            //$this->request->getData = $this->Demandeoffredeprixes->find('first', $options);
        }


        $ligneas = $this->Lignedemandeoffredeprixes->find('all')
            ->group(["article_id" => '(Lignedemandeoffredeprixes.article_id)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);

        // debug($ligneas);die;	




        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
        //debug($lignefs);die();		



        $fournisseurs = $this->Fournisseurs->find('list');
        $demandes = $this->Demandeoffredeprixes->find()
            ->select(["dm" => '(Demandeoffredeprixes.id)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        //debug($demandes);die;


        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']); //->where('Articles.famille_id=2');
        //		$fournisseurs=$this->Fournisseur->find('list');
        $this->set(compact('articles', 'demandes', 'fournisseurs', 'ligneas', 'lignefs', 'demandeoffredeprix', 'typeof'));
    }

    //etat comparatif pour passer une commande c'est pourquoi le numero sera le numero de la commande                       

    public function etatcomparatif($typeof = null, $id = null)
    {

        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Articlefournisseurs');


        $firstdemande = $this->Demandeoffredeprixes->find()
            ->where(["Demandeoffredeprixes.id  ='" . $id . "'"])->first();
        $demandes = $this->Demandeoffredeprixes->find()
            ->select(["dm" => '(Demandeoffredeprixes.id)'])
            ->where(["Demandeoffredeprixes.id  ='" . $id . "'"])->first();
        // debug($demandes);die;



        $date = $this->Demandeoffredeprixes->find()
            ->select(["date" => '(Demandeoffredeprixes.date)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        //debug($date);die;

        $commande = $this->Commandefournisseurs->newEmptyEntity();
        $yearf = date('Y');
        $currentYear = date('y');
        $num = $this->Commandefournisseurs->find()->select(["num" =>
        'MAX(Commandefournisseurs.numero)'])->where('YEAR(Commandefournisseurs.date)=' . $yearf)->first();

        $n = $num->num;

        if ($n) {
            $lastFourDigits = substr($n, -4);
            $in = intval($lastFourDigits) + 1;
        } else {
            $in = '0001';
        }

        $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
        $b = "BC{$currentYear}00{$mm}";

        if ($this->request->is('post') || $this->request->is('put')) {

            $commande = $this->Commandefournisseurs->patchEntity($commande, $this->request->getData());

            if (isset($this->request->getData('data')['fligne']) && (!empty($this->request->getData('data')['fligne']))) {
                foreach ($this->request->getData('data')['fligne'] as $j => $fourni) {
                    //debug($fourni);
                    $yearf = date('Y');
                    $currentYear = date('y');
                    $num = $this->Commandefournisseurs->find()->select(["num" =>
                    'MAX(Commandefournisseurs.numero)'])->where('YEAR(Commandefournisseurs.date)=' . $yearf)->first();

                    $n = $num->num;

                    if ($n) {
                        $lastFourDigits = substr($n, -4);
                        $in = intval($lastFourDigits) + 1;
                    } else {
                        $in = '0001';
                    }

                    $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
                    $b = "BC{$currentYear}00{$mm}";

                    if (!empty($fourni['check'])) {
                        if ($fourni['check'] == 1) {
                            $data['numero'] = $b;
                            $data['t'] = $fourni['t'];
                            $data['name'] = $fourni['nameF'];
                            $data['date'] = FrozenDate::now();

                            if (!$fourni['id']) {
                                //debug("pas d'id");
                                $dat = $this->fetchTable('Fournisseurs')->newEmptyEntity();
                                $dat['name'] = $fourni['nameF'];
                                if ($this->Fournisseurs->save($dat)) {
                                    $fournisseur_id = ($this->Fournisseurs->save($dat)->id);
                                    $this->misejour("Fournisseurs", "add", $fournisseur_id);

                                    $fournisseur_id = $dat->id;
                                    $data['fournisseur_id'] = $fournisseur_id;
                                    // $dataligne['fournisseur_id'] =$fournisseur_id;
                                }
                            } else {
                                $data['fournisseur_id'] = $fourni['id'];
                                //$dataligne['fournisseur_id'] = $fourni['id'];
                            }
                            $data['demandeoffredeprix_id'] = $id;
                            $data['service_id'] = $firstdemande->service_id;
                            $data['machine_id'] = $firstdemande->machine_id;

                            $comd = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();
                            $comd = $this->Commandefournisseurs->patchEntity($comd, $data);
                            $comd->typecommande = $typeof;
                            //debug($data); 
                            if ($this->Commandefournisseurs->save($comd)) {
                                $comd_id = ($this->Commandefournisseurs->save($comd)->id);
                                $this->misejour("Commandefournisseurs", "add", $comd_id);

                                $comd_id = $comd['id'];
                                //debug($comd);
                                if (isset($this->request->getData('data')['fligne'][$j]['aligne']) && (!empty($this->request->getData('data')['fligne'][$j]['aligne']))) {

                                    foreach ($this->request->getData('data')['fligne'][$j]['aligne'] as $i => $art) {
                                        $dataligne = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();

                                        $lbc = $this->Lignebandeconsultations->find()->where(["Lignebandeconsultations.id =  '" . $art['ligne_id'] . "' "])->first();
                                        $data['designiation'] = $art['designiationA'];
                                        if (!$art['id']) {
                                            $datta = $this->fetchTable('Articles')->newEmptyEntity();
                                            $datta['Dsignation'] = $art['designiationA'];
                                            $datta['typearticle_id'] = 2;
                                            //                                            debug($datta);



                                            if ($this->fetchTable('Articles')->save($datta)) {
                                                $article_id = $datta['id'];
                                                $data['article_id'] = $article_id;
                                                $dataligne['article_id'] = $article_id;
                                            }
                                        } else {
                                            $data['article_id'] = $art['id'];
                                            $dataligne['article_id'] = $art['id'];
                                        }
                                        $data['code'] = $lbc['codefrs'];
                                        $data['prix'] = $art['prix'];
                                        $artfr = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
                                        $artfr = $this->Articlefournisseurs->patchEntity($artfr, $data);
                                        if ($this->Articlefournisseurs->save($artfr)) {
                                            $artfrs_id = ($this->Articlefournisseurs->save($artfr)->id);
                                            $this->misejour("Articlefournisseurs", "add", $artfrs_id);
                                        } else {
                                            $this->Flash->error("Failed to create Articlefournisseurs offre de prix");
                                        }


                                        $dataligne['codefrs'] = $lbc['codefrs'];
                                        $dataligne['qte'] = $art['qte'];
                                        $dataligne['prix'] = $art['prix'];
                                        $dataligne['remise'] = $art['remise'];
                                        $dataligne['tva'] = $art['tva'];
                                        $dataligne['fodec'] = $art['fodec'];



                                        $dataligne['ht'] = $art['ht'];
                                        $dataligne['commandefournisseur_id'] = $comd_id;
                                        //   debug($dataligne);
                                        if ($this->Lignecommandefournisseurs->save($dataligne)) {


                                            $article = $this->Demandeoffredeprixes->get($id);
                                            $article->commande = '1';
                                            //                                                debug($article);

                                            $this->Demandeoffredeprixes->save($article);
                                            $dmd_id = ($this->Demandeoffredeprixes->save($article)->id);
                                            $this->misejour("Demandeoffredeprixes", "update", $dmd_id);
                                        }
                                    }
                                }

                                //debug($comd_id);
                                // $this->Flash->success("Commande has been created successfully");
                            }
                        }
                    }
                }
            }







            if (isset($this->request->getData('data')['lignefourn']) && (!empty($this->request->getData('data')['lignefourn']))) {
                foreach ($this->request->getData('data')['lignefourn'] as $j => $fourniss) {
                    $datx = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();



                    $yearf = date('Y');
                    $currentYear = date('y');
                    $num = $this->Commandefournisseurs->find()->select(["num" =>
                    'MAX(Commandefournisseurs.numero)'])->where('YEAR(Commandefournisseurs.date)=' . $yearf)->first();

                    $n = $num->num;

                    if ($n) {
                        $lastFourDigits = substr($n, -4);
                        $in = intval($lastFourDigits) + 1;
                    } else {
                        $in = '0001';
                    }

                    $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
                    $b = "BC{$currentYear}00{$mm}";


                    if (!empty($fourniss['c'])) {
                        if ($fourniss['c'] == 1) {
                            $data['numero'] = $b;

                            $data['name'] = $fourniss['nameF'];
                            $data['date'] = FrozenDate::now();
                            if (!$fourniss['id']) {
                                $data = $this->fetchTable('Fournisseurs')->newEmptyEntity();
                                $data['name'] = $fourniss['nameF'];
                                if ($this->Fournisseurs->save($data)) {
                                    $frs_id = ($this->Fournisseurs->save($data)->id);
                                    $this->misejour("Fournisseurs", "add", $frs_id);

                                    $fournisseur_id = $data->id;
                                    $data['fournisseur_id'] = $fournisseur_id;
                                    $datx['fournisseur_id'] = $fournisseur_id;
                                    $dattt['fournisseur_id'] = $fournisseur_id;
                                }
                            } else {
                                $data['fournisseur_id'] = $fourniss['id'];
                                $datx['fournisseur_id'] = $fourniss['id'];
                                $dattt['fournisseur_id'] = $fourniss['id'];
                            }


                            $datx['numero'] = $b;
                            $datx['date'] = FrozenDate::now();
                            $datx['demandeoffredeprix_id'] = $id;
                            $datx['typecommande'] = $typeof;
                            $datx['service_id'] = $firstdemande->service_id;
                            $datx['machine_id'] = $firstdemande->machine_id;

                            if ($this->Commandefournisseurs->save($datx)) {
                                $cmd_id = ($this->Commandefournisseurs->save($datx)->id);
                                $this->misejour("Commandefournisseurs", "add", $cmd_id);

                                $comd_id = $datx['id'];


                                if (isset($this->request->getData('data')['lignefourn'][$j]['ligneart']) && (!empty($this->request->getData('data')['lignefourn'][$j]['ligneart']))) {
                                    foreach ($this->request->getData('data')['lignefourn'][$j]['ligneart'] as $i => $arti) {
                                        // debug($arti);
                                        $datz = $this->fetchTable('Articles')->newEmptyEntity();
                                        $dattt = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();
                                        if ($arti['check2']) {
                                            $data['date'] = $this->request->getData('date');
                                            $lbc = $this->Lignebandeconsultations->find()->where(["Lignebandeconsultations.id = '" . $arti['ligne_id'] . "' "])->first();
                                            $data['designiation'] = $arti['designiationA'];
                                            if (!$arti['article_id']) {

                                                $datz['Dsignation'] = $arti['designiationA'];
                                                $datz['typearticle_id'] = 2;
                                                // debug($datz);
                                                if ($this->Articles->save($datz)) {
                                                    $article_id = ($this->Articles->save($datz)->id);
                                                    $this->misejour("Articles", "add", $article_id);
                                                    $data['article_id'] = $datz['id'];
                                                    $data['article_id'] = $datz['id'];
                                                    $dattt['article_id'] = $datz['id'];
                                                }
                                            } else {
                                                $data['article_id'] = $arti['article_id'];
                                                $dattt['article_id'] = $arti['article_id'];
                                            }
                                            $data['code'] = $lbc['codefrs'];
                                            $data['prix'] = $arti['prix'];


                                            //  $artfr = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
                                            // $artfr = $this->Articlefournisseurs->patchEntity($artfr, $data);

                                            //                                            if ($this->Articlefournisseurs->save($artfr)) {
                                            //                                                 
                                            //                                            } 
                                            //                                            else {
                                            //                                              
                                            //                                            }
                                            $dattt['codefrs'] = $lbc['codefrs'];
                                            $dattt['qte'] = $arti['qte'];
                                            $dattt['prix'] = $arti['prix'];
                                            $dattt['tva'] = $arti['tva'];
                                            $dattt['fodec'] = $arti['fodec'];
                                            $dattt['remise'] = $arti['remise'];

                                            $dattt['ht'] = $arti['ht'];
                                            $dattt['commandefournisseur_id'] = $comd_id;
                                            // debug($dattt);
                                            // $data['numero'] = $this->request->getData('mm');


                                            if ($this->Lignecommandefournisseurs->save($dattt)) {

                                                $article = $this->Demandeoffredeprixes->get($id);
                                                $article->commande = '1';
                                                //debug($article);
                                                $this->Demandeoffredeprixes->save($article);
                                                $dmd_id = ($this->Demandeoffredeprixes->save($article)->id);
                                                $this->misejour("Demandeoffredeprixes", "update", $dmd_id);
                                            } else {
                                                $this->Flash->error("Failed to create Lignecommandefournisseurs offre de prix");
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $this->redirect(array('controller' => 'commandefournisseurs', 'action' => 'index', $typeof));
        }




        //            $this->Demandeoffredeprixes->id = $id;
        //            $dmd = $this->Demandeoffredeprixes->find('all')
        //                    ->where(["Demandeoffredeprixes.id = '" . $id . "'"]);
        //
        //            $dmd->update()
        //                    ->set(['commande' => '1'])
        //                    ->execute();


        $fournisseurs = $this->Lignelignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["namef" => '(Lignelignebandeconsultations.nameF)'])
            ->where(["Lignelignebandeconsultations.demandeoffredeprix_id  ='" . $id . "'"]);
        //        debug($fournisseurs);


        $articles = $this->Bandeconsultations->find('all')
            ->group(["article_id" => '(Bandeconsultations.article_id)'])
            ->where(["Bandeconsultations.demandeoffredeprix_id = '" . $id . "'"]);
        //  debug($articles);
        $tab = array();
        $tab1 = array();
        foreach ($fournisseurs as $frs) {
            //debug($frs); 
            $idfrs = $frs['fournisseur_id'];
            $namefrs = addslashes($frs['nameF']);
            //echo($namefrs);die;

            foreach ($articles as $art) {
                //debug($art);die;
                $idart = $art['article_id'];
                $iddemande = $art['demandeoffredeprix_id'];
                $artdes = $art['designiationA'];

                $donnes = $this->Lignebandeconsultations->find()
                    ->where(["Lignebandeconsultations.nameF = '" . $namefrs . "'"])
                    ->where(["Lignebandeconsultations.demandeoffredeprix_id  = '" . $iddemande . "'"])
                    ->where(["Lignebandeconsultations.article_id = '" . $idart . "'"]);
                //debug($donnes);die;


                $pr = $this->Lignebandeconsultations->find('all')
                    ->select(["ht" => '(Lignebandeconsultations.ht)'])
                    ->where(["Lignebandeconsultations.demandeoffredeprix_id = '" . $iddemande . "'"])
                    ->where(["Lignebandeconsultations.article_id = '" . $idart . "'"])
                    ->order(["Lignebandeconsultations.ht"]);

                //debug($pr);die;        

                $tab[$idfrs][$idart] = $donnes;
                $tab1[$idfrs][$idart] = $pr;
                // debug($tab1);
            }
        }







        $lignefs = $this->Lignelignebandeconsultations->find('all')
            ->group(["nomfour" => '(Lignelignebandeconsultations.nameF)'])
            ->where(["Lignelignebandeconsultations.demandeoffredeprix_id = '" . $id . "'"])
            ->order(["Lignelignebandeconsultations.t"]);
        $d = array();

        $o = 0;

        foreach ($lignefs as $o => $lf) {
            $ligneas = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
                //->select(["nameF"=>'(Lignebandeconsultations.designiationA)'])
                ->group(["article_id" => '(Lignebandeconsultations.article_id)'])
                ->where(["Lignebandeconsultations.demandeoffredeprix_id ='" . $id . "'"])
                ->where(["Lignebandeconsultations.nameF  ='" . addslashes($lf['nameF']) . "'"]);
            //            debug($ligneas);
            //$ta[$o]=$lf;
            $n = 0;
            // $d=array();

            foreach ($ligneas as $n => $la) {
                $d[$o][$n] = $la;
                //debug($d);
            }
        }
        //debug( $ta);
        //         debug( $d);

        $selectarticles = $this->Demandeoffredeprixes->Articles->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($article) {
                return $article->Code . ' (' . $article->Dsignation . ')';
            }
        ]); //->where(['Articles.famille_id = 2']); // ->where(["Articles.vente =0" ])

        $this->set(compact('b', 'selectarticles', 'tab', 'tab1', 'fournisseurs', 'd', 'demandes', 'c', 'articles', 'commande', 'date', 'lignefs', 'ligneas', 'typeof'));
    }



    public function imprimer($id)
    {

        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Lignedemandeoffredeprixes');

        if (!$this->Demandeoffredeprix->exists($id)) {
            throw new NotFoundException(__('Invalid demandeoffredeprix'));
        }
        $ligneas = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignedemandeoffredeprixes.designiationA)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);

        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);

        //$nb=$this->Lignedemandeoffredeprixes->find('count',array('conditions' => array('Lignedemandeoffredeprix.demandeoffredeprix_id'=>$id),'group' => array('Lignedemandeoffredeprix.nameF')));
        $demandeoffredeprix = $this->Demandeoffredeprixes->find()
            ->where(["Demandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"])
            ->first();

        $this->set(compact('nb', 'articles', 'fournisseurs', 'ligneas', 'lignefs', 'demandeoffredeprix'));
    }
}

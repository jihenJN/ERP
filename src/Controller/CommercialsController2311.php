<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;

/**
 * Commercials Controller
 *
 * @property \App\Model\Table\CommercialsTable $Commercials
 * @method \App\Model\Entity\Commercial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommercialsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $commercials = $this->paginate($this->Commercials);

        $this->set(compact('commercials'));
    }

    /**
     * View method
     *
     * @param string|null $id Commercial id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $commercial = $this->Commercials->get($id, [
            'contain' => ['Commandes'],
        ]);
        $this->loadModel('Gouvernoratcommercials');
        $commercial = $this->Commercials->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Objectifrepresentants');
        $this->loadModel('Mois');
        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Tarifs');
        $this->loadModel('Articles');
        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
        //echo(json_encode($fam)) ; die ;

        $dett = '0';
        foreach ($fam as $f) {

            $dett = $dett . ',' . $f->id;
        }

        if ($dett != '') {
            $cond100 = 'Articles.famille_id in (' . $dett . ')';
        }

        $articles = $this->Tarifs->Articles->find('all')->where([$cond100]);
        foreach ($articles as $art) {
            foreach ($mois as $moi) {
                $objectifrepresentants = $this->fetchTable('Objectifrepresentants')->find('all', [])
                        ->where(["Objectifrepresentants.commercial_id = " . $id . "", "Objectifrepresentants.article_id = " . $art->id . "", "Objectifrepresentants.moi_id = " . $moi->id . "",]);
                if (!empty($objectifrepresentants)) {
                    foreach ($objectifrepresentants as $i) {

                        $tab[$art->id][$moi->id] = $i->objectif;
                    }
                } else
                    $tab[$art->id][$moi->id] = 0;
            }
        }


        $this->loadModel('Gouvernoratcommercials');
        $gouv = $this->Gouvernoratcommercials->find('all', array('conditions' => array("Gouvernoratcommercials.commercial_id =" . $id), 'fields' => array('Gouvernoratcommercials.gouvernorat_id')));

        $gg = [];
        foreach ($gouv as $i => $g) {

            array_push($gg, $g['gouvernorat_id']);
        }
        $gouvernorats = $this->Commercials->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $categories = $this->Commercials->Categories->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('tab', 'mois', 'articles', 'commercial', 'gg', 'gouvernorats', 'categories'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {

        $this->loadModel('Mois');
        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Tarifs');
        $this->loadModel('Articles');
      
        $articles = $this->fetchTable('Articles')->find('all')->where(['Articles.vente  = 1 ']);


        $commercial = $this->Commercials->newEmptyEntity();

        if ($this->request->is('post')) {
            $this->loadModel('Gouvernoratcommercials');



            $commercial = $this->Commercials->patchEntity($commercial, $this->request->getData());
            if ($this->Commercials->save($commercial)) {
                //  debug($this->request->getData()) ; die ;
                $commercial_id = $commercial->id;
                //debug($commercial_id) ; die ;
                if (isset($this->request->getData('data')['objectifrep']) && (!empty($this->request->getData('data')['objectifrep']))) {
                    //  debug($this->request->getData()) ; die ;
                    foreach ($this->request->getData('data')['objectifrep'] as $i => $c) {
                        $this->loadModel('Objectifrepresentants');

                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->newEmptyEntity();
                        $dataobj['commercial_id'] = $commercial_id;
                        $dataobj['objectif'] = $c['objectif'];
                        $dataobj['article_id'] = $c['article'];
                        $dataobj['moi_id'] = $c['mois'];
                        if (!empty($c['objectif'])) {
                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                            $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                        }
                    }
                }


                if (isset($this->request->getData()['gouvernorats_id']) && (!empty($this->request->getData()['gouvernorats_id']))) {


                    foreach ($this->request->getData()['gouvernorats_id'] as $i => $per) {
                        $data = $this->fetchTable('Gouvernoratcommercials')->newEmptyEntity();
                        $data['commercial_id'] = $commercial_id;
                        $data['gouvernorat_id'] = $per;
                        $this->fetchTable('Gouvernoratcommercials')->save($data);
                        //  debug($data);die;
                        //$this->Commercials->execute("INSERT INTO `gouvernoratcommercials` (`id`, `commercial_id`, `gouvernorat_id`) VALUES (NULL, NULL, NULL)");
                    }
                }

                //  $this->Flash->success(__('The {0} has been saved.', 'Commercial'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commercial'));
        }



        $gouvernorats = $this->Commercials->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $categories = $this->Commercials->Categories->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('articles', 'commercial', 'gouvernorats', 'categories', 'mois'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Commercial id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->loadModel('Gouvernoratcommercials');
        $commercial = $this->Commercials->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Objectifrepresentants');
        $this->loadModel('Mois');
        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Tarifs');
        $this->loadModel('Articles');
        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
        //echo(json_encode($fam)) ; die ;

        $dett = '0';
        foreach ($fam as $f) {

            $dett = $dett . ',' . $f->id;
        }

        if ($dett != '') {
            $cond100 = 'Articles.famille_id in (' . $dett . ')';
            $cond101 = 'Articles.sousfamille1_id is not null';
        }

        $articles = $this->Tarifs->Articles->find('all')->where([$cond100, $cond101]);
        foreach ($articles as $art) {
            foreach ($mois as $moi) {
                $objectifrepresentants = $this->fetchTable('Objectifrepresentants')->find('all', [])
                        ->where(["Objectifrepresentants.commercial_id = " . $id . "", "Objectifrepresentants.article_id = " . $art->id . "", "Objectifrepresentants.moi_id = " . $moi->id . "",]);
                if (!empty($objectifrepresentants)) {
                    foreach ($objectifrepresentants as $i) {
                        //      debug($i) ;

                        $tab[$art->id][$moi->id] = $i->objectif;
                        $tabb[$art->id][$moi->id] = $i->id;
                    }
                } else
                    $tab[$art->id][$moi->id] = 0;
            }
        }


        if ($this->request->is(['patch', 'post', 'put'])) {
            $commercial = $this->Commercials->patchEntity($commercial, $this->request->getData());
            if ($this->Commercials->save($commercial)) {
                $commercial_id = $commercial->id;

                if (isset($this->request->getData('data')['objectifrep']) && (!empty($this->request->getData('data')['objectifrep']))) {
                    //   debug($this->request->getData()) ; die ;
                    foreach ($this->request->getData('data')['objectifrep'] as $i => $c) {

                        $dataobj['objectif'] = $c['objectif'];
                        $dataobj['commercial_id'] = $commercial_id;
                        $dataobj['moi_id'] = $c['mois'];
                        $dataobj['article_id'] = $c['article'];
                        $dataobj['id'] = $c['objectif_id'];
                        if (isset($c['objectif_id']) && (!empty($c['objectif_id']))) {
                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->get($c['objectif_id'], [
                                'contain' => []
                            ]);
                        } else {
                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->newEmptyEntity();
                        }

                        if (!empty($c['objectif'])) {
                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                        }

                        $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                    }
                }


                $gouvcom = $this->Gouvernoratcommercials->find('all', array('conditions' => array("Gouvernoratcommercials.commercial_id =" . $id)));
                foreach ($gouvcom as $com) {
                    $this->Gouvernoratcommercials->delete($com);
                }
                if (isset($this->request->getData()['gouvernorats_id']) && (!empty($this->request->getData()['gouvernorats_id']))) {


                    foreach ($this->request->getData()['gouvernorats_id'] as $i => $per) {
                        $data = $this->fetchTable('Gouvernoratcommercials')->newEmptyEntity();
                        $data['commercial_id'] = $commercial_id;
                        $data['gouvernorat_id'] = $per;
                        // debug($data);die;
                        $this->Gouvernoratcommercials->save($data);
                    }
                }

                //  $this->Flash->success(__('The {0} has been saved.', 'Commercial'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commercial'));
        }
        $gouv = $this->Gouvernoratcommercials->find('all', array('conditions' => array("Gouvernoratcommercials.commercial_id =" . $id), 'fields' => array('Gouvernoratcommercials.gouvernorat_id')));

        $gg = [];
        foreach ($gouv as $i => $g) {

            array_push($gg, $g['gouvernorat_id']);
        }

        // debug($gg);
        $gouvernorats = $this->Commercials->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $categories = $this->Commercials->Categories->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('tabb', 'categories', 'tab', 'gg', 'commercial', 'gouvernorats', 'gouv', 'mois', 'articles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Commercial id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->loadModel('Gouvernoratcommercials');
        $this->request->allowMethod(['post', 'delete']);
        $commercial = $this->Commercials->get($id);
        $gouvernoratcommercials = $this->Gouvernoratcommercials->find('all', [])
                ->where(['commercial_id' => $id]);
        foreach ($gouvernoratcommercials as $c) {

            $this->Gouvernoratcommercials->delete($c);
        }
        if ($this->Commercials->delete($commercial)) {
            // $this->Flash->success(__('The {0} has been deleted.', 'Commercial'));
        } else {
            // $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Commercial'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function bonusmaluscommercial($id = null) {
        $commercial = $this->Commercials->newEmptyEntity();
        $commercials = $this->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $num = $this->fetchTable('Bonusmaluscommercials')->find()->select(["num" =>
                    'MAX(Bonusmaluscommercials.numero)'])->first();
        //debug($num);

        $n = $num->num;
        $int = intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $numero = str_pad("$in", 5, "0", STR_PAD_LEFT);

        $bonusmaluscommercial = $this->fetchTable('Bonusmaluscommercials')->newEmptyEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $num = $this->fetchTable('Bonusmaluscommercials')->find()->select(["num" =>
                        'MAX(Bonusmaluscommercials.numero)'])->first();
            //debug($num);

            $n = $num->num;
            $int = intval($n);
            $in = intval($n) + 1;
            //debug($in);
            $numero = str_pad("$in", 5, "0", STR_PAD_LEFT);

            $bonusmaluscommercial = $this->fetchTable('Bonusmaluscommercials')->patchEntity($bonusmaluscommercial, $this->request->getData());

            $bonusmaluscommercial->dateoperation = FrozenTime::now()->addHours(1);
            //  $time =
            //  debug($time);die;





            if ($this->fetchTable('Bonusmaluscommercials')->save($bonusmaluscommercial)) {
                if (isset($this->request->getData()['data']['bonusmalus']) && (!empty($this->request->getData()['data']['bonusmalus']))) {


                    foreach ($this->request->getData()['data']['bonusmalus'] as $i) {
                        //debug($i);die;
                        foreach ($i as $ligne) {
                            //   debug($ligne);die;


                            $lignebonusmalus = $this->fetchTable('Lignebonusmalus')->newEmptyEntity();
                            //  debug($lignebonusmalus);
                            $data['moi_id'] = $ligne['mois'];
                            $data['qtelivre'] = $ligne['qteliv'];
                            $data['objectif'] = $ligne['objectif'];
                            $data['bonusmaluscommercial_id'] = $bonusmaluscommercial->id;
                            $data['article_id'] = $ligne['article_id'];
                            $data['montant'] = $ligne['mon'];
                            $data['paye'] = 0;
                            $data['ecart'] = $ligne['ecart'];
                            // debug($data);die;

                            $lignebonusmalus = $this->fetchTable('Lignebonusmalus')->patchEntity($lignebonusmalus, $data);

                            $this->fetchTable('Lignebonusmalus')->save($lignebonusmalus);

                            // debug($lignebonusmalus);
                        }
                    }
                }
                return $this->redirect(['controller' => 'bonusmaluscommercials', 'action' => 'index']);
            }





            // debug($date1);
        }

        if ($id != null) {
            $datedeb = $this->fetchTable('Bonusmaluscommercials')->find()->select(["datefin" =>
                        'MAX(Bonusmaluscommercials.datefin)'])
                    ->where(['commercial_id' => $id])
                    ->first();

            //   debug($datedeb->datefin);
            //  debug($datedeb->datefin);

            if ($datedeb->datefin != null) {
                $time = new FrozenTime($datedeb->datefin);

                $m = $time->i18nFormat('Y-MM-d');


                $aujourdhui = date("Y-m-d");
                // debug($m);




                $date1 = date("Y-m-d", strtotime($m . '+ 1 days'));
                // debug($date1);
            } else {
                $date1 = "";
            }
        } else
            $date1 = "";


        $this->set(compact('commercials', 'commercial', 'date1', 'id', 'numero'));
    }

    public function getcommercial($commercial_id = null) {
        //  debug('gg');

        $idcommercial = $this->request->getQuery('idcommercial');



        $commercial = $this->Commercials->get($idcommercial, [
            'contain' => ['Categories']
        ]);
        $datedebut = $this->request->getQuery('datedebut');

        $datefin = $this->request->getQuery('datefin');


        $cond1 = "Bonlivraisons.date <= '" . $datefin . " 23:59:59' ";
        $cond2 = "Bonlivraisons.date >= '" . $datedebut . " 00:00:00' ";
        $cond3 = "Bonlivraisons.commercial_id = '" . $idcommercial . "' ";
        $bonlivraisons = $this->fetchTable('Bonlivraisons')->find('all')
                ->where([$cond3, $cond1, $cond2]);




        $finbonliv = $this->fetchTable('Bonlivraisons')->find()->select(["datemax" =>
                    'MAX(Bonlivraisons.date)'])->where([$cond3, $cond1, $cond2])->first();














        $date = date_parse($datedebut);
        $moisdebut = $date['month'];




        // debug($finbonliv->datemax);
        // debug($moisdebut);
        // debug($finbonliv);
        $datee = date_parse($finbonliv->datemax);

        $moisfin = $datee['month'];
        //debug($moisfin);



        $cond11 = "Objectifrepresentants.moi_id <= '" . $moisfin . "' ";
        $cond22 = "Objectifrepresentants.moi_id >= '" . $moisdebut . "' ";
        $cond33 = "Objectifrepresentants.commercial_id = '" . $idcommercial . "' ";



        $objectifrepresentants = $this->fetchTable('Objectifrepresentants')->find('all', [
                    'contain' => ['Mois', 'Articles']
                ])
                ->where([$cond11, $cond22, $cond33]);
        //debug($objectifrepresentants);




        $condmois1 = "Mois.id <= '" . $moisfin . "' ";
        $condmois2 = "Mois.id >= '" . $moisdebut . "' ";



        $mois = $this->fetchTable('Mois')->find('all')
                ->where([$condmois1, $condmois2]);



        $resultat = $this->fetchTable('Lignebonlivraisons')->find('all', [
                    'contain' => ['Articles', 'Bonlivraisons']
                ])->where([$cond3, $cond1, $cond2])->group(['Lignebonlivraisons.article_id'])
                ->select(["qte" => "SUM(Lignebonlivraisons.quantiteliv)", "Lignebonlivraisons.article_id", "Bonlivraisons.date"]);
        // debug($resultat)
        foreach ($resultat as $re) {
            // debug($re);




            $time = new FrozenTime($re->bonlivraison->date);
            $m = intval($time->i18nFormat('MM'));
            //   debug($time);
            foreach ($objectifrepresentants as $obj) {
                // debug($obj);


                if ($obj->article_id == $re->article_id && $m == $obj->moi_id) {


                    // debug($obj->article);



                    $ecart = $re->qte - $obj->objectif;
                    //debug($ecart);
                    $nbpoint = $obj->article->nbpoint;
                    //  debug($nbpoint);
                    $valeurcat = $commercial->category->valeur;
                    // debug($valeurcat);
                    // debug($commercial->category->valeur);
                    // debug($obj->article->nbpoint);


                    $famillerotations = $this->fetchTable('Famillerotations')->find()->select([
                                "txmin" => '(Famillerotations.txmin)',
                                "txmaj" => '(Famillerotations.txmax)'
                            ])
                            ->where(['id' => $obj->article->famillerotation_id])
                            ->first();






                    $txmin = $famillerotations->txmin;

                    $txmaj = $famillerotations->txmaj;

                    $mon = 0;


                    if ($ecart > 0) {
                        $montant = $ecart * $nbpoint * $valeurcat * ($txmaj / 100);
                        $mon += $montant;
                    } else {
                        //                                echo $ecart.'<br>';
                        //                                echo $nbpoint.'<br>';
                        //                                echo $valeurcat.'<br>';
                        //                                echo $txmin.'<br>';
                        $montant = $ecart * $nbpoint * $valeurcat * ($txmin / 100);
                        $mon += $montant;
                    }


                    $tab[$obj->article->Dsignation][$m] = [
                        'qteliv' => $re->qte,
                        'objectif' => $obj->objectif,
                        'ecart' => $re->qte - $obj->objectif,
                        'ecart' => $re->qte - $obj->objectif,
                        'mon' => number_format($mon, 3),
                        'article_id' => $obj->article_id,
                        'mois' => $obj->moi_id,
                    ];
                    //  debug($tab);
                    //debug($obj->moi_id);
                    //  debug($m);
                    /*  if($m == $obj->moi_id){
                      $tab[$ligne->article_id][$m] =  [
                      'qteliv' => $qte,
                      'objectif' => $obj->objectif

                      ];

                      } */
                    // echo $qte;
                    // $tab[$ligne->article_id][$obj->moi_id] = [$qte];
                }
            }
            // debug($time->i18nFormat('MM'));
        }




       // debug($tab);
        //debug($bonlivraison);
        // $i=$bonlivraison->id ;


        /* $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all')
          ->where(["Lignebonlivraisons.bonlivraison_id =" . $bonlivraison->id]);
          // debug($lignebonlivraisons); */



        // debug($objectifrepresentants);
        // debug($date1);






        $this->layout = '';


        //debug($datefin);
        // echo (json_encode(array('date' => $date1)));


        $this->set(compact('objectifrepresentants', 'tab', 'mois'));
        // die;
    }

}

<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function indexrelever() {
        $this->loadModel('Relevercommercials');

        $this->loadModel('Commercials');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Reglementcommercials');
        $this->loadModel('Bonusmaluscommercials');
        $this->loadModel('Lignebonlivraisons');
        $this->loadModel('Lignereglementcommercials');
        $this->loadModel('Lignebonusmalus');
        $commercial_id = $this->request->getQuery('commercial_id');
        $Date_debut = $this->request->getQuery('Date_debut');
        $Date_fin = $this->request->getQuery('Date_fin');
        // debug($this->request->getQuery());
        // die;
        if ($this->request->getQuery()) {
            $this->Relevercommercials->deleteAll(array());
            $cond1 = '';
            $cond2 = '';
            $cond3 = '';
            $cond4 = '';
            $cond5 = '';
            $cond6 = '';
            $cond7 = '';
            $cond8 = '';
            $cond9 = '';
            $regs = array();
            $regs['0'] = 'Regl�';
            $regs['1'] = 'Non regl�';
            $Date_debut = '';
            //debug($this->request->getQuery());die;
            if ($this->request->getQuery()['Date_debut'] == "") {
                $this->request->getQuery()['Date_debut'] = '2015-01-01  00:00:00';
            }
            if ($this->request->getQuery()['Date_fin'] == "") {
                $this->request->getQuery()['Date_fin'] = date('d/m/Y H:i:s');
            }
            if ($this->request->getQuery()['Date_debut'] != '') {
                $cond1 = 'Bonlivraisons.date>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
                $cond2 = 'Reglementcommercials.date>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
                $cond3 = 'Bonusmaluscommercials.dateoperation>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
            }
            if ($this->request->getQuery()['Date_fin'] != '') {
                $cond4 = 'Bonlivraisons.date<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
                $cond5 = 'Reglementcommercials.date<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
                $cond6 = 'Bonusmaluscommercials.dateoperation<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
            }
            if ($this->request->getQuery()['commercial_id']) {
                $commercial_id = $this->request->getQuery()['commercial_id'];
                $cond7 = 'Bonlivraisons.commercial_id=' . $commercial_id;
                $cond8 = 'Reglementcommercials.commercial_id=' . $commercial_id;
                $cond9 = 'Bonusmaluscommercials.commercial_id=' . $commercial_id;
            }
            $reglementcommercials = $this->Reglementcommercials->find('all')->where([$cond2, $cond5, $cond8]);
            $i = -1;
            $connection = ConnectionManager::get('default');


            $soldes = $connection->execute("select soldecommercial(" . $commercial_id . ",'" . $this->request->getQuery()['Date_debut'] . " 23:59:59' ) as v")->fetchAll('assoc');

            $solde = $soldes[0]['v'];

            foreach ($reglementcommercials as $com) {
                $i++;
                $Lignereglementcommercials = $this->Lignereglementcommercials->find('all')->where(['Lignereglementcommercials.reglementcommercial_id=' . $com['id']]);
                $this->loadModel('Paiements');
                $paiements = $this->Paiements->get($com['paiement_id'], [
                    'contain' => []
                ]);
                // debug($paiements);die;
                $dat[$i]['type'] = "Reglement Commercials";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['date'];
                $dat[$i]['paiements'] = $paiements['name'];
                // debug($com);
                $mnt = 0;
                $j = -1;
                foreach ($Lignereglementcommercials as $ligne) {
                    $j++;
                    $dat[$i]['ligne'][$j]['lignelivraison_id'] = $ligne['lignelivraison_id'];
                    $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                    $dat[$i]['ligne'][$j]['typ'] = "1";
                    $mnt += $ligne['montant'];
                    $dat[$i]['ligne'][$j]['montant'] = "1";
                }
                $dat[$i]['credit'] = 0;
                $dat[$i]['debit'] = $mnt;
            }
            $bonlivraisons = $this->Bonlivraisons->find('all')->where([$cond1, $cond4, $cond7]);

            foreach ($bonlivraisons as $com) {
                $i++;
                $Lignebonlivraisons = $this->Lignebonlivraisons->find('all')->where(['Lignebonlivraisons.bonlivraison_id=' . $com['id']]);
                // $clients = $this->fetchTable('Clients')->find('list', [
                //     'keyField' => 'id',
                //     'valueField' => 'Contact'
                // ]);
                $this->loadModel('Clients');
                $clients = $this->Clients->get($com['client_id'], [
                    'contain' => []
                ]);
                //  debug($clients);die;
                $dat[$i]['type'] = "Bon Livraisons";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['date'];
                $dat[$i]['clients'] = $clients['Raison_Sociale'];
                $mnt = 0;
                $j = -1;
                foreach ($Lignebonlivraisons as $ligne) {
                    $j++;
                    $this->loadModel('Articles');
                    // $articles = $this->Articles->get($ligne['article_id'], [
                    //     'contain' => []
                    // ]);
                    // $dat[$i]['ligne'][$j]['articles'] = $ligne['Dsignation'];
                    $dat[$i]['ligne'][$j]['montantcommissions'] = $ligne['montantcommission'];
                    $dat[$i]['ligne'][$j]['typ'] = "2";
                    $mnt += $ligne['montantcommission'];
                    $dat[$i]['ligne'][$j]['montantcommission'] = "2";
                }
                $dat[$i]['debit'] = 0;
                $dat[$i]['credit'] = $mnt;
            }
            $bonusmaluscommercials = $this->Bonusmaluscommercials->find('all')->where([$cond3, $cond6, $cond9]);
            foreach ($bonusmaluscommercials as $com) {
                $i++;
                $Lignebonusmalus = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id=' . $com['id'], 'Lignebonusmalus.montant>0']);
                $dat[$i]['type'] = "Bonus";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['dateoperation'];
                $j = -1;
                $mnt = 0;
                foreach ($Lignebonusmalus as $j => $ligne) {
                    $j++;
                    $this->loadModel('Articles');
                    $articles = $this->Articles->get($ligne['article_id'], [
                        'contain' => []
                    ]);
                    //debug($articles);die;

                    $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                    $dat[$i]['ligne'][$j]['objectif'] = $ligne['objectif'];
                    $dat[$i]['ligne'][$j]['qtelivre'] = $ligne['qtelivre'];
                    $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                    $dat[$i]['ligne'][$j]['typ'] = "1";
                    $mnt += $ligne['montant'];
                    $dat[$i]['ligne'][$j]['montant'] = "1";
                    // debug($dataa);die;
                }
                $dat[$i]['debit'] = $mnt;
                $dat[$i]['credit'] = 0;
            }
            foreach ($bonusmaluscommercials as $com) {
                $i++;
                $Lignebonusmaluss = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id=' . $com['id'], 'Lignebonusmalus.montant<0']);
                $dat[$i]['type'] = "Malus";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['dateoperation'];
                $j = -1;
                $mnt = 0;
                foreach ($Lignebonusmaluss as $ligne) {
                    $j++;
                    $this->loadModel('Articles');
                    $articles = $this->Articles->get($ligne['article_id'], [
                        'contain' => []
                    ]);
                    $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                    $dat[$i]['ligne'][$j]['objectif'] = $ligne['objectif'];
                    $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                    $dat[$i]['ligne'][$j]['typ'] = "2";
                    $mnt += $ligne['montant'];
                    $dat[$i]['ligne'][$j]['montant'] = "1";
                }
                $dat[$i]['credit'] = $mnt;
                $dat[$i]['debit'] = 0;
            }
            //    debug($dat) ; die ;
        }
        // $rel = $this->Relevercommercials->find('all')->order(['Relevercommercials.date,Relevercommercials.typ' => 'desc']);
        $this->loadModel('Commercials');
        $this->loadModel('Articles');
        $this->loadModel('Paiements');
        $commercials = $this->Commercials->find('list', ['limit' => 200]);
        $this->set(compact('solde', 'dat', 'commercials'));
    }

    public function index() {

        $cond1 = '';
        $cond2 = '';
        $cond3 = '';


        $Code = $this->request->getQuery('Code');
        $Dsignation = $this->request->getQuery('Dsignation');
        // debug($Dsignation);
        $famille_id = $this->request->getQuery('famille_id');
        //  debug($famille_id);




        if ($Code) {
            $cond1 = "Articles.Code like  '%" . $Code . "%' ";
        }
        if ($Dsignation) {
            $cond2 = "Articles.Dsignation  like  '%" . $Dsignation . "%' ";
        }


        if ($famille_id) {
            $cond3 = "Articles.famille_id  =  '" . $famille_id . "' ";

            /// $cond3 = "Articles.famille_id '%" . $famille_id . "%' ";
        }

        $query = $this->Articles->find('all')->where([$cond1, $cond2, $cond3]);
        //debug($query);

        $this->paginate = [
            'contain' => ['Familles', 'Tvas'], 'order' => ['id' => 'ASC']
        ];

        $articles = $this->paginate($query);

        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);

        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'Taux']);


        $this->set(compact('articles', 'familles', 'tvas'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $article = $this->Articles->get($id, [
            'contain' => ['Familles', 'Sousfamille1s', 'Tvas', 'Articlefournisseurs', 'Articleunites', 'Bandeconsultations', 'Fourchettes', 'Lignebandeconsultations', 'Lignebonchargements', 'Lignebondereservations', 'Lignebondetransferts', 'Lignebonlivraisons', 'Lignebonreceptionstocks', 'Lignebonsortiestocks', 'Lignecommandeclients', 'Lignecommandes', 'Lignedemandeoffredeprixes', 'Lignefactureclients', 'Lignefactures', 'Ligneinventaires', 'Lignelivraisons'],
        ]);
        $tpes = $this->fetchTable('Tpes')->find()->select(["tpes" =>
                    'MAX(Tpes.valeur)'])->first();
        $tpe = $tpes->tpes;


        $fodecs = $this->fetchTable('Fodecs')->find()->select(["fodecs" =>
                    'MAX(Fodecs.valeur)'])->first();
        $fodec = $fodecs->fodecs;

        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
                    'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;
        $codeart = substr($article->codeabarre, -4);

        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
                    'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;







        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);



        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille1s.famille_id = " . $article->famille_id . ""]);

        $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille2s.Sousfamille1_id = " . $article->sousfamille1_id . ""]);

        $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $val = $codepays . ' ' . $codeproducteur;

        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($val);


        $seuil = $this->fetchTable('Seuilmois')->find('all', [])
                ->where(["Seuilmois.article_id = " . $id . ""]);

        $unitearticles = $this->fetchTable('Unitearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);



        $mois = $this->fetchTable('Mois')->find('all');
        $commercials = $this->fetchTable('Commercials')->find('all');





        foreach ($commercials as $com) {
            foreach ($mois as $moi) {

                $objectifrepresentants = $this->fetchTable('Objectifrepresentants')->find('all', [])
                        ->where(["Objectifrepresentants.article_id = " . $id . "", "Objectifrepresentants.commercial_id = " . $com->id . "", "Objectifrepresentants.moi_id = " . $moi->id . "",]);
                //debug($objectifrepresentants);
                if (!empty($objectifrepresentants)) {


                    foreach ($objectifrepresentants as $i) {
                        //    debug($i);

                        $tab[$com->id][$moi->id] = $i->objectif;
                        //   $tab[1][2] = 81;
                        //$tab[1][1] = 8;
                        // $tab[1][2] = 81;
                    }
                } else
                    $tab[$com->id][$moi->id] = 0;
            }
        }



        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $this->set(compact('tab', 'commercials', 'mois', 'unitearticles', 'sousfamille2s', 'unites', 'tpe', 'seuil', 'codeart', 'article', 'familles', 'sousfamille1s', 'typearticles', 'codepays', 'codeproducteur', 'val', 'tvas', 'fodec'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {



        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
                    'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;


        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
                    'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;





        $fodecs = $this->fetchTable('Fodecs')->find()->select(["fodecs" =>
                    'MAX(Fodecs.valeur)'])->first();
        $fodec = $fodecs->fodecs;



        $tpes = $this->fetchTable('Tpes')->find()->select(["tpes" =>
                    'MAX(Tpes.valeur)'])->first();
        $tpe = $tpes->tpes;


        /*
          $session = $this->request->getSession();
          $abrv = $session->read('abrvv');
          $liendd = $session->read('lien_parametrage' . $abrv);

          //   debug($liendd);
          $article = 0;
          foreach ($liendd as $k => $liens) {
          //  debug($liens);
          if (@$liens['lien'] == 'articles') {
          $societe = $liens['ajout'];
          }
          }
          // debug($societe);die;
          if (($article <> 1)) {
          $this->redirect(array('controller' => 'users', 'action' => 'login'));
          }
         */



        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());
            $codearticle = $this->request->getData('codearticle');
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $codefinale = $codepays . $codeproducteur . $codearticle;

            // debug($codefinale);
            $article->codeabarre = $codefinale;







            $image = $this->request->getData('image_file');
            //  debug($image);die;
            $name = $image->getClientFilename();
            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
              mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775); */

            // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;

            if (!empty($name)) {
                $image->moveTo($targetPath);
                $article->image = $name;
            }








            if ($this->Articles->save($article)) {
                $this->misejour("Articles", "add", $article->id);
                // debug($article);






                if (isset($this->request->getData('data')['seuil']) && (!empty($this->request->getData('data')['seuil']))) {
                    foreach ($this->request->getData('data')['seuil'] as $i => $b) {
                        //debug($adresseliv);
                        //die;
                        //  if($b['minimum'] != '' &&  $b['maximum'] != '' && $b['alert'] != '' ) {




                        $seuil = $this->fetchTable('Seuilmois')->newEmptyEntity();
                        $data['moi_id'] = $i;
                        $data['min'] = $b['minimum'];
                        $data['max'] = $b['maximum'];
                        $data['alert'] = $b['alert'];
                        $data['article_id'] = $article->id;

                        $seuil = $this->fetchTable('Seuilmois')->patchEntity($seuil, $data);


                        $this->fetchTable('Seuilmois')->save($seuil);
                        // }
                        //debug($seuil);
                    }
                }





                if (isset($this->request->getData('data')['objectifrep']) && (!empty($this->request->getData('data')['objectifrep']))) {
                    foreach ($this->request->getData('data')['objectifrep'] as $i => $c) {
                        //debug($adresseliv);
                        //die;
                        if ($c['objectif'] != '') {




                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->newEmptyEntity();
                            // $data['mois'] = $i;
                            $dataobj['objectif'] = $c['objectif'];

                            $dataobj['commercial_id'] = $c['commercial'];
                            $dataobj['moi_id'] = $c['mois'];
                            $dataobj['article_id'] = $article->id;

                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);


                            $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                            //debug($seuil);
                        }
                    }
                }





















                return $this->redirect(['action' => 'index']);
            }
        }
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);

        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $unitearticles = $this->fetchTable('Unitearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $val = $codepays . ' ' . $codeproducteur;
        //debug($val);



        $mois = $this->fetchTable('Mois')->find('all');
        $commercials = $this->fetchTable('Commercials')->find('all');





        $famillerotations = $this->fetchTable('Famillerotations')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $this->set(compact('famillerotations', 'commercials', 'mois', 'unitearticles', 'tpe', 'unites', 'article', 'familles', 'sousfamille1s', 'typearticles', 'codepays', 'codeproducteur', 'val', 'tvas', 'fodec'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {


        $tpes = $this->fetchTable('Tpes')->find()->select(["tpes" =>
                    'MAX(Tpes.valeur)'])->first();
        $tpe = $tpes->tpes;



        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
                    'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;


        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
                    'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;





        $fodecs = $this->fetchTable('Fodecs')->find()->select(["fodecs" =>
                    'MAX(Fodecs.valeur)'])->first();
        $fodec = $fodecs->fodecs;
        $article = $this->Articles->get($id, [
            'contain' => ['Tvas'],
        ]);



        $codeart = substr($article->codeabarre, -4);
        // debug($article->codeabarre);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());
            //  die;
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            // debug($article);
            $codearticle = $this->request->getData('codearticle');
            // debug($codearticle);



            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $codefinale = $codepays . $codeproducteur . $codearticle;

            //  debug($codefinale);
            $article->codeabarre = $codefinale;

            $image = $this->request->getData('image_file');
            //  debug($image);die;
            $name = $image->getClientFilename();
            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
              mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775); */

            // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;

            if (!empty($name)) {
                $image->moveTo($targetPath);
                $article->image = $name;
            }
            //$article->image=$name;
            // if ($article_id=($this->Articles->save($article)->id)){
            if ($this->Articles->save($article)) {
                //    debug($article);
                $this->misejour("Articles", "edit", $id);





                $seuilss = $this->fetchTable('Seuilmois')->find('all', [])
                        ->where(["Seuilmois.article_id = " . $id . ""]);

                foreach ($seuilss as $ss) {
                    $this->fetchTable('Seuilmois')->delete($ss);
                }



                if (isset($this->request->getData('data')['seuil']) && (!empty($this->request->getData('data')['seuil']))) {
                    foreach ($this->request->getData('data')['seuil'] as $i => $b) {
                        //debug($adresseliv);
                        //die;

                        $seuil = $this->fetchTable('Seuilmois')->newEmptyEntity();
                        $data['moi_id'] = $i;
                        $data['min'] = $b['minimum'];
                        $data['max'] = $b['maximum'];
                        $data['alert'] = $b['alert'];
                        $data['article_id'] = $article->id;

                        $seuil = $this->fetchTable('Seuilmois')->patchEntity($seuil, $data);


                        $this->fetchTable('Seuilmois')->save($seuil);
                        //debug($seuil);
                    }
                }



                $objectifrepresentantss = $this->fetchTable('Objectifrepresentants')->find('all', [])
                        ->where(["Objectifrepresentants.article_id = " . $id . ""]);
                //      debug($objectifrepresentantss);die;



                foreach ($objectifrepresentantss as $obj) {
                    $this->fetchTable('Objectifrepresentants')->delete($obj);
                }





                if (isset($this->request->getData('data')['objectifrep']) && (!empty($this->request->getData('data')['objectifrep']))) {
                    foreach ($this->request->getData('data')['objectifrep'] as $i => $c) {
                        //  debug($c);
                        //die;
                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->newEmptyEntity();
                        // $data['mois'] = $i;
                        $dataobj['objectif'] = $c['objectif'];
                        $dataobj['commercial_id'] = $c['commercial'];
                        $dataobj['moi_id'] = $c['mois'];
                        $dataobj['article_id'] = $article->id;
                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                        $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                        //debug($seuil);
                    }
                }
                //  $this->Flash->success(__('Modification effectuée'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('Veuillez réessayer!!!'));
        }
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);



        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille1s.famille_id = " . $article->famille_id . ""]);

        $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille2s.Sousfamille1_id = " . $article->sousfamille1_id . ""]);

        $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $val = $codepays . ' ' . $codeproducteur;

        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($val);


        $seuil = $this->fetchTable('Seuilmois')->find('all', ['contain' => ['Mois']])
                ->where(["Seuilmois.article_id = " . $id . ""]);








        $unitearticles = $this->fetchTable('Unitearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $mois = $this->fetchTable('Mois')->find('all');
        $commercials = $this->fetchTable('Commercials')->find('all');





        foreach ($commercials as $com) {
            foreach ($mois as $moi) {

                $objectifrepresentants = $this->fetchTable('Objectifrepresentants')->find('all', [])
                        ->where(["Objectifrepresentants.article_id = " . $id . "", "Objectifrepresentants.commercial_id = " . $com->id . "", "Objectifrepresentants.moi_id = " . $moi->id . "",]);
                //debug($objectifrepresentants);
                if (!empty($objectifrepresentants)) {


                    foreach ($objectifrepresentants as $i) {
                        //    debug($i);

                        $tab[$com->id][$moi->id] = $i->objectif;
                        //   $tab[1][2] = 81;
                        //$tab[1][1] = 8;
                        // $tab[1][2] = 81;
                    }
                } else
                    $tab[$com->id][$moi->id] = 0;
            }
        }


        //ebug($tab);






        $famillerotations = $this->fetchTable('Famillerotations')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        //  foreach($mois as $m){debug($m);}
        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $this->set(compact('famillerotations', 'tab', 'objectifrepresentants', 'commercials', 'mois', 'unitearticles', 'sousfamille2s', 'unites', 'tpe', 'seuil', 'codeart', 'article', 'familles', 'sousfamille1s', 'typearticles', 'codepays', 'codeproducteur', 'val', 'tvas', 'fodec'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {



        /*  $session = $this->request->getSession();
          $abrv = $session->read('abrvv');
          $liendd = $session->read('lien_parametrage' . $abrv);

          //   debug($liendd);
          $article = 0;
          foreach ($liendd as $k => $liens) {
          //  debug($liens);
          if (@$liens['lien'] == 'articles') {
          $societe = $liens['supp'];
          }
          }
          // debug($societe);die;
          if (($article <> 1)) {
          $this->redirect(array('controller' => 'users', 'action' => 'login'));
          }
         */

        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->misejour("Articles", "delete", $id);
        } else {
            
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getsousfamille1($id = null) {
        $id = $this->request->getQuery('idfam');

        // debug($id);
        // die;
        // var_dump( $t['article_id']);
        // $prix = $ligne->prix->achat;
        //$this->set(compact('prix'));


        $select1 = "

        <label class='control-label' for='sousfamille1-id'>Sousfamille1</label>
        <select name='sousfamille1_id' id='divsous' class='form-control select2' onchange='getsousfamille2(this.value)'   >
					<option value=''  selected='selected' disabled>Veuillez choisir</option> </select> </div> </div> ";
        $query = $this->fetchTable('Sousfamille1s')->find();
        $query->where(['famille_id' => $id]);
        // debug($query);
        $select = "

        <label class='control-label' for='sousfamille1-id'>Sousfamille1</label>
        <select name='sousfamille1_id' id='sous' class='form-control select2' onchange='getsousfamille2(this.value)'   >
					<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
            //  debug($q); 
            $select = $select . "	<option value ='" . $q['id'] . "'";
            $select = $select . " >" . $q['name'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select = $select . "</select> </div> </div> ";

        echo json_encode(array('select' => $select, 'select1' => $select1));
        die;
        //$this->set(compact('query'));





        /* foreach ($query as $q) { 
          json_encode($q);
          debug($q);
          }
         */
    }

    public function getquantite() {

        $articleid = $_GET['idarticle'];
        // $depotid = $_GET['idadepot'];
        //$date = date("Y-m-d H:i:s");
        // $connection = ConnectionManager::get('default');
        //$inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
        //debug($inventaires);
        // $qtestock = $inventaires[0]['v'];
        $qtestock = 0;





        $ligne = $this->fetchTable('Articles')->get($articleid, [
            'contain' => ['Tvas'],
        ]);
        // debug($ligne);




        echo json_encode(array("qtestockx" => $qtestock, "ligne" => $ligne, "success" => true));
        //echo (json_encode($ligne));
        die;
    }

    public function getvaleurtva() {
        if ($this->request->is('ajax')) {
            $articleid = $_GET['idfam'];







            $ligne = $this->fetchTable('Tvas')->get($articleid);

            $val = $ligne['valeur'];



            echo json_encode(array("valeur" => $val, "ligne" => $ligne, "success" => true));
            //echo (json_encode($ligne));
            exit;
        }
    }

    public function getsousf($id = null) {
        $id = $this->request->getQuery('idfam');

        // debug($id);
        // die;
        // var_dump( $t['article_id']);
        // $prix = $ligne->prix->achat;
        //$this->set(compact('prix'));




        $query = $this->fetchTable('Sousfamille2s')->find();
        $query->where(['sousfamille1_id' => $id]);
        // debug($query);
        $select = "

        <label class='control-label' for='sousfamille1-id'>Sous sous famille  </label>
        <select name='sousfamille2_id' id='divsoussous' class='form-control select2 '>
					<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
            //  debug($q); 
            $select = $select . "	<option value ='" . $q['id'] . "'";
            $select = $select . " >" . $q['name'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select = $select . "</select> </div> </div> ";

        echo json_encode(array('select' => $select));
        die;
        //$this->set(compact('query'));





        /* foreach ($query as $q) { 
          json_encode($q);
          debug($q);
          }
         */
    }

    public function verifcodearticle() {
        $id = $this->request->getQuery('idfam');
        $idarticle = $this->request->getQuery('idarticle');
       // debug($idarticle);




        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
                    'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;


        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
                    'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;


        $query = $this->fetchTable('Articles')->find();
        if ($idarticle != null) {
            $query->where(['codeabarre' => $codepays . $codeproducteur . $id])->where(['id !=' => $idarticle]);
        }
        else{
              $query->where(['codeabarre' => $codepays . $codeproducteur . $id]);
        }








        echo json_encode(array("codeexistant" => $query, "success" => true));
        //echo (json_encode($ligne));
        die;
    }

    
    
    
    
    
}

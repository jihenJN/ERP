<?php

declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;

/**
 * Stockdepots Controller
 *
 * @property \App\Model\Table\StockdepotsTable $Stockdepots
 * @method \App\Model\Entity\Stockdepot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StockdepotsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignecommandes');
        $this->loadModel('Familles');
        $date1 = date("Y-m-d");
        $articleid = "";
        $depotid = "";
        $cond3 = " 1=1";
        $cond4 = " 1=1";
        $cond5 = " 1=1";
        $cond6 = " 1=1";

        if ($this->request->getQuery()) {

            //debug($this->request->getQuery()) ;
            if ($this->request->getQuery()['famille_id'] != '') {

                $famille_id = $this->request->getQuery()['famille_id'];
                $condfam = 'Articles.famille_id =' . $famille_id;
                // debug($famille_id);


            }

            if ($this->request->getQuery()['depot_id'] != '') {

                $depotid = $this->request->getQuery()['depot_id'];

                $conddep = 'Commandes.depot_id =' . $depotid;
            }


            if ($this->request->getQuery()['article_id'] != '') {

                $articleid = $this->request->getQuery()['article_id'];
                $condart0 = 'Articles.id =' . $articleid;
                $condart = 'Lignecommandes.depot_id =' . $articleid;
            }

            $df = date('Y-m-d H:i:s');
            $connection = ConnectionManager::get('default');
            $artfac = $connection->execute('SELECT distinct(l.article_id)  as a FROM  lignefactureclients l,factureclients d where d.depot_id=' . $depotid . ' ;')->fetchAll('assoc');
            $artavoir = $connection->execute('SELECT distinct(l.article_id)  as a FROM  lignefactureavoirs l,factureavoirs d where d.depot_id=' . $depotid . ' ;')->fetchAll('assoc');
            $artliv = $connection->execute('SELECT distinct(l.article_id)  as a FROM  lignebonlivraisons l,bonlivraisons d where d.depot_id=' . $depotid . ' ;')->fetchAll('assoc');


            $page = 1;
            $art = 0;

            if ($artavoir != null || $artliv != null || $artfac != null) {


                $tab = array_merge($artfac, $artavoir, $artliv);
            }
            //debug($tab);
            $list = '0';
            foreach ($tab as $i) {

                //debug($i['a']);

                $list = $list . ',' . $i['a'];
            }
            $cond00 = 'Articles.id  in (' . $list . ')';
            // $condart1 = 'Articles.famille_id = 1';

            // $stockdepots = $this->fetchTable('Articles')->find('all', [
            //     'contain' => [],
            // ])->where([$cond3, $cond4, $cond5, $cond6, $cond00,$  $condfam ,$condart0 ]);

            // $stockdepots = $this->fetchTable('Articles')->find('all', [
            //     'contain' => [],
            // ])->where([$condfam]);


            $stockdepots = $this->fetchTable('Articles')->find('all', [
                'contain' => [],
            ])->where([$condfam, $condart0]);
        }



        $articles = $this->Articles->find('all');
        $familles = $this->Familles->find('all');
        $depots = $this->Depots->find('list');


        $this->set(compact('stockdepots', 'stockdepotsa', 'articles', 'depots', 'depotid', 'articleid', 'familles', 'famille_id'));
    }


    public function indexpardepot27122024()
    {

        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignecommandes');
        $this->loadModel('Familles');

        $date1 = date("Y-m-d");
        $articleid = "";
        $depotid = "";
        $stockdepots = array();
        $cond3 = "";
        $cond5 = "";
        $cond61 = "";
        if ($this->request->getQuery()) {

            if ($this->request->getQuery()['famille_id'] != '') {

                $famille_id = $this->request->getQuery()['famille_id'];
                $condfam = 'Articles.famille_id =' . $famille_id;
            }



            if ($this->request->getQuery()['article_id'] != '') {
                $articleid = $this->request->getQuery()['article_id'];

                //$cond1 = 'Stockdepots.article_id = ' . $articleid;
                $cond1 = 'Articles.id =' . $articleid;
                $cond2 = 'Lignecommandes.article_id =' . $articleid;
                $condgroup = "";
            }
            if ($this->request->getQuery()['depot_id'] != '') {

                $depotid = $this->request->getQuery()['depot_id'];

                $cond3 = ' Stockdepots.depot_id= ' . $depotid;
                // $cond4 = 'Commandes.depot_id =' . $depotid;
                $conddepot = 'Depots.id =' . $depotid;
                $depotalls = $this->Depots->find('all', array('conditions' => array($conddepot), 'recursive' => -1));
                //  debug($depotalls);
            } else {
                $depotalls = $this->Depots->find('all', array('recursive' => -1));
            }
            //$condart = 'Articles.famille_id = 1';

            // $articless = $this->fetchTable('Articles')->find()
            //     ->select(['Familles.nom'])
            //     ->leftJoinWith('Familles')
            //     ->where([@$cond5, @$cond61, @$cond1, @$condfam])
            //     ->toArray();
                // debug($articless);die;

             $articless = $this->Articles->find('all', array('conditions' => array(@$cond5, @$cond61 ,@$cond1,@$condfam)));

            // debug($articless);

        }

        $articles = $this->Articles->find('all');
        $depots = $this->Depots->find('list');
        $familles = $this->Familles->find('all');

        $this->set(compact('articles', 'depotalls', 'articless', 'fournisseurid', 'famille_id', 'fournisseurs', 'familles', 'type', 'typeqtes', 'date1', 'cond4c', 'cond4f', 'cond3c', 'cond3f', 'cond1c', 'cond1f', 'depotid', 'articleid', 'clientid', 'articles', 'depots', 'stockdepots'));
    }

    public function indexpardepot()
    { 

        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignecommandes');
        $this->loadModel('Familles');
        $this->loadModel('Sousfamille1s');

        $time = new FrozenTime('now', 'Africa/Tunis');
       // $date1 = date("Y-m-d");
       $datedebut = $time->startOfYear()->i18nFormat('yyyy-MM-dd 00:00:00');
       $datefin = $time->i18nFormat('yyyy-MM-dd 23:59:59');

        //$date1 =   '0-01-' . date("Y") . ''  . date("h:m:s");
        // var_dump($date1);
         //debug($date1);
        $articleid = "";
        $depotid = "";
        $sousfamille_id ="";
        $stockdepots = array();
        $cond3 = "";
        $cond5 = "";
        $cond61 = "";
        $condsoufam="";
        $condmarq="";
        $condmm ="";
        if ($this->request->getQuery()) {

            if ($this->request->getQuery()['famille_id'] != '') {

                $famille_id = $this->request->getQuery()['famille_id'];
                $condfam = 'Familles.id =' . $famille_id;
                // debug($condfam);
            }
            if ($this->request->getQuery()['marque_id'] != '') {

                $marque_id = $this->request->getQuery()['marque_id'];
                $condmarq = 'Marques.id =' . $marque_id;
                //  debug($condmarq);
            }
            if ($this->request->getQuery()['famille_id'] != '') {

                $sousfamille_id = $this->request->getQuery()['sousfamille1_id'];
                $condsoufam = 'AND Articles.sousfamille1_id =' . $sousfamille_id;
               
            }

            if ($this->request->getQuery()['datedebut'] != '') {

                $datedebut = $this->request->getQuery()['datedebut'];
            
            }
            if ($this->request->getQuery()['datefin'] != '') {

                $datefin = $this->request->getQuery()['datefin'];
          
            }
            if ($this->request->getQuery()['article_id'] != '') {
                $articleid = $this->request->getQuery()['article_id'];

          
                $cond1 = 'articles.id =' . $articleid;
                $condmm = "articles.id = $articleid";
                // debug($cond1);
                $cond2 = 'Lignecommandes.article_id =' . $articleid;
                $condgroup = "";
            }
            if ($this->request->getQuery()['depot_id'] != '') {

                $depotid = $this->request->getQuery()['depot_id'];

                $cond3 = ' Stockdepots.depot_id= ' . $depotid;
                // $cond4 = 'Commandes.depot_id =' . $depotid;
                $conddepot = 'Depots.id =' . $depotid;
                $depotalls = $this->Depots->find('all', array('conditions' => array($conddepot), 'recursive' => -1));
                //  debug($depotalls);
            } else {
                $depotalls = $this->Depots->find('all', array('recursive' => -1));
            }
     

             $articless = $this->Articles->find('all', array('conditions' => array(@$cond5, @$cond61 ,@$cond1,@$condfam,$condsoufam,'Articles.famille_id IS NOT NULL')))->contain(['Familles','Sousfamille1s','Unites']);

             $familless = $this->Familles->find('all')->where([$condfam]);
             $marquess = $this->fetchTable('Marques')->find('all')->where([$condmarq]);
        //  debug($marquess);
 
        }
        // $marquess = $this->fetchTable('Marques')->find('all');
        $articles = $this->Articles->find('all')->contain(['Unites','Familles','Sousfamille1s']); //->where(['Articles.famille_id IS NOT NULL']);
        //->where(['Articles.famille_id !=NULL']);
        $depots = $this->Depots->find('list');
        $familles = $this->Familles->find('all');
        $sousfamille1s = $this->Sousfamille1s->find('all');
        $marques = $this->fetchTable('Marques')->find('all');
        $depotid = 6;


        $this->set(compact('articles','depotid','condmm','marquess','sousfamille1s','marque_id','marques','cond1','familless', 'depotalls', 'articless','datefin','datedebut', 'fournisseurid', 'famille_id', 'fournisseurs', 'familles', 'type', 'typeqtes', 'date1', 'cond4c', 'cond4f', 'cond3c', 'cond3f', 'cond1c', 'cond1f', 'depotid', 'articleid', 'clientid', 'articles', 'depots', 'stockdepots'));
    }
    public function indexdetailstock()
    { 

        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignecommandes');
        $this->loadModel('Familles');
        $this->loadModel('Sousfamille1s');

        $time = new FrozenTime('now', 'Africa/Tunis');
       // $date1 = date("Y-m-d");
       $datedebut = $time->startOfYear()->i18nFormat('yyyy-MM-dd 00:00:00');
       $datefin = $time->i18nFormat('yyyy-MM-dd 23:59:59');

        //$date1 =   '0-01-' . date("Y") . ''  . date("h:m:s");
        // var_dump($date1);
         //debug($date1);
        $articleid = "";
        $depotid = "";
        $sousfamille_id ="";
        $stockdepots = array();
        $cond3 = "";
        $cond5 = "";
        $cond61 = "";
        $condsoufam="";
        $condmarq="";
        if ($this->request->getQuery()) {

            if ($this->request->getQuery()['famille_id'] != '') {

                $famille_id = $this->request->getQuery()['famille_id'];
                $condfam = 'Familles.id =' . $famille_id;
                // debug($condfam);
            }
            if ($this->request->getQuery()['marque_id'] != '') {

                $marque_id = $this->request->getQuery()['marque_id'];
                $condmarq = 'Marques.id =' . $marque_id;
                //  debug($condmarq);
            }
            if ($this->request->getQuery()['famille_id'] != '') {

                $sousfamille_id = $this->request->getQuery()['sousfamille1_id'];
                $condsoufam = 'AND Articles.sousfamille1_id =' . $sousfamille_id;
               
            }

            if ($this->request->getQuery()['datedebut'] != '') {

                $datedebut = $this->request->getQuery()['datedebut'];
            
            }
            if ($this->request->getQuery()['datefin'] != '') {

                $datefin = $this->request->getQuery()['datefin'];
          
            }
            if ($this->request->getQuery()['article_id'] != '') {
                $articleid = $this->request->getQuery()['article_id'];

          
                $cond1 = 'articles.id =' . $articleid;
                // debug($cond1);
                $cond2 = 'Lignecommandes.article_id =' . $articleid;
                $condgroup = "";
            }
            if ($this->request->getQuery()['depot_id'] != '') {

                $depotid = $this->request->getQuery()['depot_id'];

                $cond3 = ' Stockdepots.depot_id= ' . $depotid;
                // $cond4 = 'Commandes.depot_id =' . $depotid;
                $conddepot = 'Depots.id =' . $depotid;
                $depotalls = $this->Depots->find('all', array('conditions' => array($conddepot), 'recursive' => -1));
                //  debug($depotalls);
            } else {
                $depotalls = $this->Depots->find('all', array('recursive' => -1));
            }
     

             $articless = $this->Articles->find('all', array('conditions' => array(@$cond5, @$cond61 ,@$cond1,@$condfam,$condsoufam,'Articles.famille_id IS NOT NULL')))->contain(['Familles','Sousfamille1s','Unites']);

             $familless = $this->Familles->find('all')->where([$condfam]);
             $marquess = $this->fetchTable('Marques')->find('all')->where([$condmarq]);
        //  debug($marquess);
 
        }
        // $marquess = $this->fetchTable('Marques')->find('all');
        $articles = $this->Articles->find('all')->contain(['Unites','Familles','Sousfamille1s']); //->where(['Articles.famille_id IS NOT NULL']);
        //->where(['Articles.famille_id !=NULL']);
        $depots = $this->Depots->find('list');
        $familles = $this->Familles->find('all');
        $sousfamille1s = $this->Sousfamille1s->find('all');
        $marques = $this->fetchTable('Marques')->find('all');

        $this->set(compact('articles','marquess','sousfamille1s','marque_id','marques','cond1','familless', 'depotalls', 'articless','datefin','datedebut', 'fournisseurid', 'famille_id', 'fournisseurs', 'familles', 'type', 'typeqtes', 'date1', 'cond4c', 'cond4f', 'cond3c', 'cond3f', 'cond1c', 'cond1f', 'depotid', 'articleid', 'clientid', 'articles', 'depots', 'stockdepots'));
    }
    public function indexdetailstockParFetS23122024()
    {

        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignecommandes');
        $this->loadModel('Familles');
        $this->loadModel('Sousfamille1s');

        $time = new FrozenTime('now', 'Africa/Tunis');
       // $date1 = date("Y-m-d");
       $date1 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');

        //$date1 =   '0-01-' . date("Y") . ''  . date("h:m:s");
        // var_dump($date1);
         //debug($date1);
         $time = new FrozenTime('now', 'Africa/Tunis');
         $date2 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');
        $articleid = "";
        $depotid = "";
        $sousfamille_id ="";
        $stockdepots = array();
        $cond3 = "";
        $cond5 = "";
        $cond61 = "";
        $condsoufam="";
        if ($this->request->getQuery()) {

            if ($this->request->getQuery()['famille_id'] != '') {

                $famille_id = $this->request->getQuery()['famille_id'];
                $condfam = 'Familles.id =' . $famille_id;
                // debug($condfam);
            }
            if ($this->request->getQuery()['famille_id'] != '') {

                $sousfamille_id = $this->request->getQuery()['sousfamille1_id'];
                $condsoufam = 'AND Articles.sousfamille1_id =' . $sousfamille_id;
               
            }

            if ($this->request->getQuery()['datedebut'] != '') {

                $datedebut = $this->request->getQuery()['datedebut'];
            
            }
            if ($this->request->getQuery()['datefin'] != '') {

                $datefin = $this->request->getQuery()['datefin'];
          
            }
            if ($this->request->getQuery()['article_id'] != '') {
                $articleid = $this->request->getQuery()['article_id'];

          
                $cond1 = 'articles.id =' . $articleid;
                // debug($cond1);
                $cond2 = 'Lignecommandes.article_id =' . $articleid;
                $condgroup = "";
            }
            if ($this->request->getQuery()['depot_id'] != '') {

                $depotid = $this->request->getQuery()['depot_id'];

                $cond3 = ' Stockdepots.depot_id= ' . $depotid;
                // $cond4 = 'Commandes.depot_id =' . $depotid;
                $conddepot = 'Depots.id =' . $depotid;
                $depotalls = $this->Depots->find('all', array('conditions' => array($conddepot), 'recursive' => -1));
                //  debug($depotalls);
            } else {
                $depotalls = $this->Depots->find('all', array('recursive' => -1));
            }
     

             $articless = $this->Articles->find('all', array('conditions' => array(@$cond5, @$cond61 ,@$cond1,@$condfam,$condsoufam,'Articles.famille_id IS NOT NULL')))->contain(['Familles','Sousfamille1s','Unites']);

             $familless = $this->Familles->find('all')->where([$condfam]);

        }

        $articles = $this->Articles->find('all')->contain(['Unites','Familles','Sousfamille1s']); //->where(['Articles.famille_id IS NOT NULL']);
        //->where(['Articles.famille_id !=NULL']);
        $depots = $this->Depots->find('list');
        $familles = $this->Familles->find('all');
        $sousfamille1s = $this->Sousfamille1s->find('all');

        $this->set(compact('articles','sousfamille1s','cond1','familless', 'depotalls', 'articless','datefin','datedebut', 'fournisseurid', 'famille_id', 'fournisseurs', 'familles', 'type', 'typeqtes', 'date1', 'cond4c', 'cond4f', 'cond3c', 'cond3f', 'cond1c', 'cond1f', 'depotid', 'articleid', 'clientid', 'articles', 'depots', 'stockdepots'));
    }
    public function indexdetailstock12122024()
    {

        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignecommandes');
        $this->loadModel('Familles');
        $time = new FrozenTime('now', 'Africa/Tunis');
       // $date1 = date("Y-m-d");
       $date1 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');

        //$date1 =   '0-01-' . date("Y") . ''  . date("h:m:s");
        // var_dump($date1);
         //debug($date1);
         $time = new FrozenTime('now', 'Africa/Tunis');
         $date2 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');
        $articleid = "";
        $depotid = "";
        $stockdepots = array();
        $cond3 = "";
        $cond5 = "";
        $cond61 = "";
        if ($this->request->getQuery()) {

            if ($this->request->getQuery()['famille_id'] != '') {

                $famille_id = $this->request->getQuery()['famille_id'];
                $condfam = 'Articles.famille_id =' . $famille_id;
            }

            if ($this->request->getQuery()['datedebut'] != '') {

                $datedebut = $this->request->getQuery()['datedebut'];
               // $condfam = 'Articles.famille_id =' . $famille_id;
            }
            if ($this->request->getQuery()['datefin'] != '') {

                $datefin = $this->request->getQuery()['datefin'];
               // $condfam = 'Articles.famille_id =' . $famille_id;
            }
            if ($this->request->getQuery()['article_id'] != '') {
                $articleid = $this->request->getQuery()['article_id'];

                //$cond1 = 'Stockdepots.article_id = ' . $articleid;
                $cond1 = 'Articles.id =' . $articleid;
                $cond2 = 'Lignecommandes.article_id =' . $articleid;
                $condgroup = "";
            }
            if ($this->request->getQuery()['depot_id'] != '') {

                $depotid = $this->request->getQuery()['depot_id'];

                $cond3 = ' Stockdepots.depot_id= ' . $depotid;
                // $cond4 = 'Commandes.depot_id =' . $depotid;
                $conddepot = 'Depots.id =' . $depotid;
                $depotalls = $this->Depots->find('all', array('conditions' => array($conddepot), 'recursive' => -1));
                //  debug($depotalls);
            } else {
                $depotalls = $this->Depots->find('all', array('recursive' => -1));
            }
            //$condart = 'Articles.famille_id = 1';

            // $articless = $this->fetchTable('Articles')->find()
            //     ->select(['Familles.nom'])
            //     ->leftJoinWith('Familles')
            //     ->where([@$cond5, @$cond61, @$cond1, @$condfam])
            //     ->toArray();
                // debug($articless);die;

             $articless = $this->Articles->find('all', array('conditions' => array(@$cond5, @$cond61 ,@$cond1,@$condfam)));

            // debug($articless);

        }

        $articles = $this->Articles->find('all')->contain('Unites');
        $depots = $this->Depots->find('list');
        $familles = $this->Familles->find('all');

        $this->set(compact('articles', 'depotalls', 'articless','datefin','datedebut', 'fournisseurid', 'famille_id', 'fournisseurs', 'familles', 'type', 'typeqtes', 'date1', 'cond4c', 'cond4f', 'cond3c', 'cond3f', 'cond1c', 'cond1f', 'depotid', 'articleid', 'clientid', 'articles', 'depots', 'stockdepots'));
    }
    public function impdepdetails()
    { 

        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignecommandes');
        $this->loadModel('Familles');
        $this->loadModel('Sousfamille1s');

        $time = new FrozenTime('now', 'Africa/Tunis');
       // $date1 = date("Y-m-d");
       $datedebut = $time->startOfYear()->i18nFormat('yyyy-MM-dd 00:00:00');
       $datefin = $time->i18nFormat('yyyy-MM-dd 23:59:59');
        $articleid = "";
        $depotid = "";
        $sousfamille_id ="";
        $stockdepots = array();
        $cond3 = "";
        $cond5 = "";
        $cond61 = "";
        $condsoufam="";
        $condmarq="";
        if ($this->request->getQuery()) {

            if ($this->request->getQuery()['famille_id'] != '') {

                $famille_id = $this->request->getQuery()['famille_id'];
                $condfam = 'Familles.id =' . $famille_id;
                // debug($condfam);
            }
            if ($this->request->getQuery()['marque_id'] != '') {

                $marque_id = $this->request->getQuery()['marque_id'];
                $condmarq = 'Marques.id =' . $marque_id;
                // debug($condmarq);
            }
            if ($this->request->getQuery()['famille_id'] != '') {

                $sousfamille_id = $this->request->getQuery()['sousfamille1_id'];
                $condsoufam = 'AND Articles.sousfamille1_id =' . $sousfamille_id;
               
            }

            if ($this->request->getQuery()['datedebut'] != '') {

                $datedebut = $this->request->getQuery()['datedebut'];
            
            }
            if ($this->request->getQuery()['datefin'] != '') {

                $datefin = $this->request->getQuery()['datefin'];
          
            }
            if ($this->request->getQuery()['article_id'] != '') {
                $articleid = $this->request->getQuery()['article_id'];

          
                $cond1 = 'articles.id =' . $articleid;
                // debug($cond1);
                $cond2 = 'Lignecommandes.article_id =' . $articleid;
                $condgroup = "";
            }
            if ($this->request->getQuery()['depot_id'] != '') {

                $depotid = $this->request->getQuery()['depot_id'];

                $cond3 = ' Stockdepots.depot_id= ' . $depotid;
                // $cond4 = 'Commandes.depot_id =' . $depotid;
                $conddepot = 'Depots.id =' . $depotid;
                $depotalls = $this->Depots->find('all', array('conditions' => array($conddepot), 'recursive' => -1));
                //  debug($depotalls);
            } else {
                $depotalls = $this->Depots->find('all', array('recursive' => -1));
            }
     

             $articless = $this->Articles->find('all', array('conditions' => array(@$cond5, @$cond61 ,@$cond1,@$condfam,$condsoufam,'Articles.famille_id IS NOT NULL')))->contain(['Familles','Sousfamille1s','Unites']);

             $familless = $this->Familles->find('all')->where([$condfam]);
             $marquess = $this->fetchTable('Marques')->find('all')->where([$condmarq]);
        // debug($marquess);
 
        }
        // $marquess = $this->fetchTable('Marques')->find('all');
        $articles = $this->Articles->find('all')->contain(['Unites','Familles','Sousfamille1s']); //->where(['Articles.famille_id IS NOT NULL']);
        //->where(['Articles.famille_id !=NULL']);
        $depots = $this->Depots->find('list');
        $familles = $this->Familles->find('all');
        $sousfamille1s = $this->Sousfamille1s->find('all');
        $marques = $this->fetchTable('Marques')->find('list');

        $this->set(compact('articles','marquess','sousfamille1s','marque_id','marques','cond1','familless', 'depotalls', 'articless','datefin','datedebut', 'fournisseurid', 'famille_id', 'fournisseurs', 'familles', 'type', 'typeqtes', 'date1', 'cond4c', 'cond4f', 'cond3c', 'cond3f', 'cond1c', 'cond1f', 'depotid', 'articleid', 'clientid', 'articles', 'depots', 'stockdepots'));
    }
    public function impdepdetailsParFetS23122024()
    {

        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignecommandes');
        $this->loadModel('Familles');
        $this->loadModel('Sousfamille1s');

        $time = new FrozenTime('now', 'Africa/Tunis');
       // $date1 = date("Y-m-d");
       $date1 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');

        //$date1 =   '0-01-' . date("Y") . ''  . date("h:m:s");
        // var_dump($date1);
         //debug($date1);
         $time = new FrozenTime('now', 'Africa/Tunis');
         $date2 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');
        $articleid = "";
        $depotid = "";
        $sousfamille_id ="";
        $stockdepots = array();
        $cond3 = "";
        $cond5 = "";
        $cond61 = "";
        $condsoufam="";
        if ($this->request->getQuery()) {

            if ($this->request->getQuery()['famille_id'] != '') {

                $famille_id = $this->request->getQuery()['famille_id'];
                $condfam = 'Familles.id =' . $famille_id;
                // debug($condfam);
            }
            if ($this->request->getQuery()['famille_id'] != '') {

                $sousfamille_id = $this->request->getQuery()['sousfamille1_id'];
                $condsoufam = 'AND Articles.sousfamille1_id =' . $sousfamille_id;
               
            }

            if ($this->request->getQuery()['datedebut'] != '') {

                $datedebut = $this->request->getQuery()['datedebut'];
            
            }
            if ($this->request->getQuery()['datefin'] != '') {

                $datefin = $this->request->getQuery()['datefin'];
          
            }
            if ($this->request->getQuery()['article_id'] != '') {
                $articleid = $this->request->getQuery()['article_id'];

          
                $cond1 = 'articles.id =' . $articleid;
                // debug($cond1);
                $cond2 = 'Lignecommandes.article_id =' . $articleid;
                $condgroup = "";
            }
            if ($this->request->getQuery()['depot_id'] != '') {

                $depotid = $this->request->getQuery()['depot_id'];

                $cond3 = ' Stockdepots.depot_id= ' . $depotid;
                // $cond4 = 'Commandes.depot_id =' . $depotid;
                $conddepot = 'Depots.id =' . $depotid;
                $depotalls = $this->Depots->find('all', array('conditions' => array($conddepot), 'recursive' => -1));
                //  debug($depotalls);
            } else {
                $depotalls = $this->Depots->find('all', array('recursive' => -1));
            }
     

             $articless = $this->Articles->find('all', array('conditions' => array(@$cond5, @$cond61 ,@$cond1,@$condfam,$condsoufam,'Articles.famille_id IS NOT NULL')))->contain(['Familles','Sousfamille1s','Unites']);

             $familless = $this->Familles->find('all')->where([$condfam]);

        }

        $articles = $this->Articles->find('all')->contain(['Unites','Familles','Sousfamille1s']); //->where(['Articles.famille_id IS NOT NULL']);
        //->where(['Articles.famille_id !=NULL']);
        $depots = $this->Depots->find('list');
        $familles = $this->Familles->find('all');
        $sousfamille1s = $this->Sousfamille1s->find('all');

        $this->set(compact('articles','sousfamille1s','cond1','familless', 'depotalls', 'articless','datefin','datedebut', 'fournisseurid', 'famille_id', 'fournisseurs', 'familles', 'type', 'typeqtes', 'date1', 'cond4c', 'cond4f', 'cond3c', 'cond3f', 'cond1c', 'cond1f', 'depotid', 'articleid', 'clientid', 'articles', 'depots', 'stockdepots'));
    }
    public function impdepdetails12122024()
    {

        
        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignecommandes');
        $this->loadModel('Familles');
        $time = new FrozenTime('now', 'Africa/Tunis');
       // $date1 = date("Y-m-d");
       $date1 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');

        //$date1 =   '0-01-' . date("Y") . ''  . date("h:m:s");
        // var_dump($date1);
         //debug($date1);
         $time = new FrozenTime('now', 'Africa/Tunis');
         $date2 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');
        $articleid = "";
        $depotid = "";
        $stockdepots = array();
        $cond3 = "";
        $cond5 = "";
        $cond61 = "";
        if ($this->request->getQuery()) {

            if ($this->request->getQuery()['famille_id'] != '') {

                $famille_id = $this->request->getQuery()['famille_id'];
                $condfam = 'Articles.famille_id =' . $famille_id;
            }

            if ($this->request->getQuery()['datedebut'] != '') {

                $datedebut = $this->request->getQuery()['datedebut'];
               // $condfam = 'Articles.famille_id =' . $famille_id;
            }
            if ($this->request->getQuery()['datefin'] != '') {

                $datefin = $this->request->getQuery()['datefin'];
               // $condfam = 'Articles.famille_id =' . $famille_id;
            }
            if ($this->request->getQuery()['article_id'] != '') {
                $articleid = $this->request->getQuery()['article_id'];

                //$cond1 = 'Stockdepots.article_id = ' . $articleid;
                $cond1 = 'Articles.id =' . $articleid;
                $cond2 = 'Lignecommandes.article_id =' . $articleid;
                $condgroup = "";
            }
            if ($this->request->getQuery()['depot_id'] != '') {

                $depotid = $this->request->getQuery()['depot_id'];

                $cond3 = ' Stockdepots.depot_id= ' . $depotid;
                // $cond4 = 'Commandes.depot_id =' . $depotid;
                $conddepot = 'Depots.id =' . $depotid;
                $depotalls = $this->Depots->find('all', array('conditions' => array($conddepot), 'recursive' => -1));
                //  debug($depotalls);
            } else {
                $depotalls = $this->Depots->find('all', array('recursive' => -1));
            }
            //$condart = 'Articles.famille_id = 1';

            // $articless = $this->fetchTable('Articles')->find()
            //     ->select(['Familles.nom'])
            //     ->leftJoinWith('Familles')
            //     ->where([@$cond5, @$cond61, @$cond1, @$condfam])
            //     ->toArray();
                // debug($articless);die;

             $articless = $this->Articles->find('all', array('conditions' => array(@$cond5, @$cond61 ,@$cond1,@$condfam)));

            // debug($articless);

        }

        $articles = $this->Articles->find('all')->contain('Unites');
        $depots = $this->Depots->find('list');
        $familles = $this->Familles->find('all');

        $this->set(compact('articles', 'depotalls', 'articless','datefin','datedebut', 'fournisseurid', 'famille_id', 'fournisseurs', 'familles', 'type', 'typeqtes', 'date1', 'cond4c', 'cond4f', 'cond3c', 'cond3f', 'cond1c', 'cond1f', 'depotid', 'articleid', 'clientid', 'articles', 'depots', 'stockdepots'));
    }
    public function impdep()
    { 

        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignecommandes');
        $this->loadModel('Familles');
        $this->loadModel('Sousfamille1s');

        $time = new FrozenTime('now', 'Africa/Tunis');
       // $date1 = date("Y-m-d");
       $datedebut = $time->startOfYear()->i18nFormat('yyyy-MM-dd 00:00:00');
       $datefin = $time->i18nFormat('yyyy-MM-dd 23:59:59');

        //$date1 =   '0-01-' . date("Y") . ''  . date("h:m:s");
        // var_dump($date1);
         //debug($date1);
        $articleid = "";
        $depotid = "";
        $sousfamille_id ="";
        $stockdepots = array();
        $cond3 = "";
        $cond5 = "";
        $cond61 = "";
        $condsoufam="";
        $condmarq="";
        $condmm ="";
        if ($this->request->getQuery()) {

            if ($this->request->getQuery()['famille_id'] != '') {

                $famille_id = $this->request->getQuery()['famille_id'];
                $condfam = 'Familles.id =' . $famille_id;
                // debug($condfam);
            }
            if ($this->request->getQuery()['marque_id'] != '') {

                $marque_id = $this->request->getQuery()['marque_id'];
                $condmarq = 'Marques.id =' . $marque_id;
                //  debug($condmarq);
            }
            if ($this->request->getQuery()['famille_id'] != '') {

                $sousfamille_id = $this->request->getQuery()['sousfamille1_id'];
                $condsoufam = 'AND Articles.sousfamille1_id =' . $sousfamille_id;
               
            }

            if ($this->request->getQuery()['datedebut'] != '') {

                $datedebut = $this->request->getQuery()['datedebut'];
            
            }
            if ($this->request->getQuery()['datefin'] != '') {

                $datefin = $this->request->getQuery()['datefin'];
          
            }
            if ($this->request->getQuery()['article_id'] != '') {
                $articleid = $this->request->getQuery()['article_id'];

          
                $cond1 = 'articles.id =' . $articleid;
                $condmm = "articles.id = $articleid";
                // debug($cond1);
                $cond2 = 'Lignecommandes.article_id =' . $articleid;
                $condgroup = "";
            }
            if ($this->request->getQuery()['depot_id'] != '') {

                $depotid = $this->request->getQuery()['depot_id'];

                $cond3 = ' Stockdepots.depot_id= ' . $depotid;
                // $cond4 = 'Commandes.depot_id =' . $depotid;
                $conddepot = 'Depots.id =' . $depotid;
                $depotalls = $this->Depots->find('all', array('conditions' => array($conddepot), 'recursive' => -1));
                //  debug($depotalls);
            } else {
                $depotalls = $this->Depots->find('all', array('recursive' => -1));
            }
     

             $articless = $this->Articles->find('all', array('conditions' => array(@$cond5, @$cond61 ,@$cond1,@$condfam,$condsoufam,'Articles.famille_id IS NOT NULL')))->contain(['Familles','Sousfamille1s','Unites']);

             $familless = $this->Familles->find('all')->where([$condfam]);
             $marquess = $this->fetchTable('Marques')->find('all')->where([$condmarq]);
        //  debug($marquess);
 
        }
        // $marquess = $this->fetchTable('Marques')->find('all');
        $articles = $this->Articles->find('all')->contain(['Unites','Familles','Sousfamille1s']); //->where(['Articles.famille_id IS NOT NULL']);
        //->where(['Articles.famille_id !=NULL']);
        $depots = $this->Depots->find('list');
        $familles = $this->Familles->find('all');
        $sousfamille1s = $this->Sousfamille1s->find('all');
        $marques = $this->fetchTable('Marques')->find('all');
        $depotid = 6;


        $this->set(compact('articles','depotid','condmm','marquess','sousfamille1s','marque_id','marques','cond1','familless', 'depotalls', 'articless','datefin','datedebut', 'fournisseurid', 'famille_id', 'fournisseurs', 'familles', 'type', 'typeqtes', 'date1', 'cond4c', 'cond4f', 'cond3c', 'cond3f', 'cond1c', 'cond1f', 'depotid', 'articleid', 'clientid', 'articles', 'depots', 'stockdepots'));
    }
    public function imp()
    {
        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignecommandes');
        $date1 = date("Y-m-d");
        $articleid = "";
        $depotid = "";
        $cond3 = " 1=1";
        $cond4 = " 1=1";
        $cond5 = " 1=1";
        $cond6 = " 1=1";

        if ($this->request->getQuery()) {

            //debug($this->request->getQuery()) ;
            if ($this->request->getQuery()['famille_id'] != '') {

                $famille_id = $this->request->getQuery()['famille_id'];
                $condfam = 'Articles.famille_id =' . $famille_id;
                //// debug($famille_id);


            }

            if ($this->request->getQuery()['depot_id'] != '') {

                $depotid = $this->request->getQuery()['depot_id'];

                $conddep = 'Commandes.depot_id =' . $depotid;
            }


            if ($this->request->getQuery()['article_id'] != '') {

                $articleid = $this->request->getQuery()['article_id'];
                $condart0 = 'Articles.id =' . $articleid;
                $condart = 'Lignecommandes.depot_id =' . $articleid;
            }

            $df = date('Y-m-d H:i:s');
            $connection = ConnectionManager::get('default');
            $artfac = $connection->execute('SELECT distinct(l.article_id)  as a FROM  lignefactureclients l,factureclients d where d.depot_id=' . $depotid . ' ;')->fetchAll('assoc');
            $artavoir = $connection->execute('SELECT distinct(l.article_id)  as a FROM  lignefactureavoirs l,factureavoirs d where d.depot_id=' . $depotid . ' ;')->fetchAll('assoc');
            $artliv = $connection->execute('SELECT distinct(l.article_id)  as a FROM  lignebonlivraisons l,bonlivraisons d where d.depot_id=' . $depotid . ' ;')->fetchAll('assoc');


            $page = 1;
            $art = 0;

            if ($artavoir != null || $artliv != null || $artfac != null) {


                $tab = array_merge($artfac, $artavoir, $artliv);
            }
            //debug($tab);
            $list = '0';
            foreach ($tab as $i) {

                //debug($i['a']);

                $list = $list . ',' . $i['a'];
            }
            $cond00 = 'Articles.id  in (' . $list . ')';
            $art = 0;

            if ($artavoir != null || $artliv != null || $artfac != null) {


                $tab = array_merge($artfac, $artavoir, $artliv);
            }
            ///debug($tab);
            $list = '0';
            foreach ($tab as $i) {

                //debug($i['a']);

                $list = $list . ',' . $i['a'];
            }
            $cond00 = 'Articles.id  in (' . $list . ')';
            $condart1 = 'Articles.famille_id = 1';


            $stockdepots = $this->fetchTable('Articles')->find('all', [
                'contain' => [],
            ])->where([$condfam, $condart0]);
        }


        $articles = $this->Articles->find('all');
        $depots = $this->Depots->find('all');


        $this->set(compact('stockdepots', 'stockdepotsa', 'articles', 'depots', 'depotid', 'articleid', 'famille_id'));
    }

    public function impdep2703()
    {
        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignecommandes');
        $date1 = date("Y-m-d");
        $articleid = "";
        $depotid = "";
        $stockdepots = array();
        $cond3 = "";
        $cond5 = "";
        $cond61 = "";
        if ($this->request->getQuery()) {

            if ($this->request->getQuery()['famille_id'] != '') {

                $famille_id = $this->request->getQuery()['famille_id'];
                $condfam = 'Articles.famille_id =' . $famille_id;
            }



            if ($this->request->getQuery()['article_id'] != '') {
                $articleid = $this->request->getQuery()['article_id'];

                //$cond1 = 'Stockdepots.article_id = ' . $articleid;
                $cond1 = 'Articles.id =' . $articleid;
                $cond2 = 'Lignecommandes.article_id =' . $articleid;
                $condgroup = "";
            }
            if ($this->request->getQuery()['depot_id'] != '') {

                $depotid = $this->request->getQuery()['depot_id'];

                $cond3 = ' Stockdepots.depot_id= ' . $depotid;
                // $cond4 = 'Commandes.depot_id =' . $depotid;
                $conddepot = 'Depots.id =' . $depotid;
                $depotalls = $this->Depots->find('all', array('conditions' => array($conddepot), 'recursive' => -1));
                //  debug($depotalls);
            } else {
                $depotalls = $this->Depots->find('all', array('recursive' => -1));
            }
            //$condart = 'Articles.famille_id = 1';


            $articless = $this->Articles->find('all', array('conditions' => array(@$cond5, @$cond61, @$cond1, @$condfam)));

            // debug($articless);

        }

        $articles = $this->Articles->find('all');
        $depots = $this->Depots->find('all');


        //debug($articless);



        $this->set(compact('articles', 'depotalls', 'articless', 'fournisseurid', 'famille_id', 'fournisseurs', 'familles', 'type', 'typeqtes', 'date1', 'cond4c', 'cond4f', 'cond3c', 'cond3f', 'cond1c', 'cond1f', 'depotid', 'articleid', 'clientid', 'articles', 'depots', 'stockdepots'));
    }



    /**
     * View method
     *
     * @param string|null $id Stockdepot id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockdepot = $this->Stockdepots->get($id, [
            'contain' => ['Articles'],
        ]);

        $this->set(compact('stockdepot'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stockdepot = $this->Stockdepots->newEmptyEntity();
        if ($this->request->is('post')) {
            $stockdepot = $this->Stockdepots->patchEntity($stockdepot, $this->request->getData());
            if ($this->Stockdepots->save($stockdepot)) {
                ////  $this->Flash->success(__('The {0} has been saved.', 'Stockdepot'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Stockdepot'));
        }
        $articles = $this->Stockdepots->Articles->find('list', ['limit' => 200]);
        $this->set(compact('stockdepot', 'articles'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Stockdepot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stockdepot = $this->Stockdepots->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockdepot = $this->Stockdepots->patchEntity($stockdepot, $this->request->getData());
            if ($this->Stockdepots->save($stockdepot)) {
                ///  $this->Flash->success(__('The {0} has been saved.', 'Stockdepot'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Stockdepot'));
        }
        $articles = $this->Stockdepots->Articles->find('list', ['limit' => 200]);
        $this->set(compact('stockdepot', 'articles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Stockdepot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stockdepot = $this->Stockdepots->get($id);
        if ($this->Stockdepots->delete($stockdepot)) {
            ///$this->Flash->success(__('The {0} has been deleted.', 'Stockdepot'));
        } else {
            /// $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Stockdepot'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;


/**
 * Inventaires Controller
 *
 * @property \App\Model\Table\InventairesTable $Inventaires
 * @method \App\Model\Entity\Inventaire[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InventairesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($type = null)
    {
        error_reporting(E_ERROR | E_PARSE);

        $cond1 = '';
        $cond2 = '';
        $cond3 = '';

        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        $depot_id = $this->request->getQuery('depot_id');


        if ($datedebut != '') {
            $cond1 = 'Date(Inventaires.date) >= ' . "'" . $datedebut . "'";
        }
        if ($datefin != '') {
            $cond2 = 'Date(Inventaires.date) <= ' . "'" . $datefin . "'";
        }
        if ($depot_id) {
            $cond3 = "Inventaires.depot_id  =  '" . $depot_id . "' ";
        }

        $condtype = "Inventaires.typeinventaire=" . $type;


        $this->paginate = [
            'contain' => ['Depots'],
        ];
        $query = $this->Inventaires->find('all')->where([$cond1, $cond2, $cond3, $condtype])->order(['Inventaires.id' => 'DESC']);

        //debug($query);



        $inventaires = $this->paginate($query);


        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // debug($depots->toarray());
        $this->set(compact('inventaires', 'depots', 'type'));
    }

    /**
     * View method
     *
     * @param string|null $id Inventaire id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inventaire = $this->Inventaires->get($id, [
            'contain' => ['Depots', 'Ligneinventaires', 'Pointdeventes'],
        ]);

        $type = $inventaire->typeinventaire;


        ////debug($site);


        $depots = $this->Inventaires->Depots->find('list', ['limit' => 200]);
        $depots = $this->Inventaires->Depots->find('list', ['limit' => 200]);
        $pointdeventes = $this->Inventaires->Pointdeventes->find('list', ['limit' => 200]);

        //$articles= $this->fetchTable('Articles')->find('list',['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $articles = $this->fetchTable('Articles')->find('all');

        $lignes = $this->fetchTable('Ligneinventaires')->find()->where('Ligneinventaires.inventaire_id=' . $id);

        $this->set(compact('inventaire', 'depots', 'lignes', 'articles', 'type', 'pointdeventes'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($type = null)
    {

        error_reporting(E_ERROR | E_PARSE);


        $inventaire = $this->Inventaires->newEmptyEntity();
        // $now =  new FrozenTime('now', 'Africa/Tunis');
        // $date=$now->i18nFormat('yyyy-MM-dd HH:mm:ss');
        // // dd($date);
        // $article = $this->fetchTable('Articles')->find('all');

        // $connection = ConnectionManager::get('default');


        // $inventairespf = $connection->execute("select stockbassemseuil(" . $article->id . ",'" . $date . "','0'," . $inventaire->depot_id . " ) as v")->fetchAll('assoc');

        if ($this->request->is('post')) {
            /*             echo '<pre>' ;
              var_dump($this->request->getData()) ;
              die ;
                                  echo '</pre>' ; */
            $numeroobj = $this->Inventaires->find()->select(["numerox" =>
            'MAX(Inventaires.numero)'])->first();
            $numero = $numeroobj->numerox;
            if ($numero != null) {
                // debug($numero);

                $n = $numero;

                $lastnum = $n;
                $nume = intval($lastnum) + 1;
                $nn = (string)$nume;

                $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
                // debug($code);die;

            } else {
                $code = "00001";
            }



            $inventaire = $this->Inventaires->patchEntity($inventaire, $this->request->getData());
            //debug($inventaire);
            if ($this->Inventaires->save($inventaire)) {


                $inventaire->typeinventaire = $type;

                $inventaire->numero = $code;



                // debug($inventaire);


                $inv_id = ($this->Inventaires->save($inventaire)->id);

                $this->misejour("Inventaires", "add", $inv_id);

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {

                    $this->loadModel('Ligneinventaires');

                    foreach ($this->request->getData('data')['ligner'] as $i => $li) {
                        if ($li['sup'] != 1 && (!empty($li['article_id']))) {
                            //debug($dep['sup1']);
                            $data1['inventaire_id'] = $inventaire->id;
                            $data1['article_id'] = $li['article_id'];
                            $data1['qteStock'] = $li['qteStock'];
                            $data1['qteTheorique'] = $li['qteTheorique'];


                            //debug($data1);die();
                            $ligneinv = $this->fetchTable('Ligneinventaires')->newEmptyEntity(); //fetchtable pour creer une ligne vide avant de la remplir

                            $ligneinv = $this->Ligneinventaires->patchEntity($ligneinv, $data1);
                            //debug($ligneinv);die ;

                            if ($this->Ligneinventaires->save($ligneinv)) {

                                // $this->Flash->success("Articlematierepremieres has been created successfully");
                            } else {
                                // $this->Flash->error("Articlematierepremieres");
                            }

                            $this->set(compact("ligneinv"));
                        }
                    }
                }
                //   $this->Flash->success(__('The {0} has been saved.', 'Inventaire'));

                return $this->redirect(['action' => 'index/' . $type]);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Inventaire'));
        }

        $numeroobj = $this->Inventaires->find()->select(["numerox" =>
        'MAX(Inventaires.numero)'])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
            // debug($code);die;

        } else {
            $code = "00001";
        }

        $depots = $this->Inventaires->Depots->find('list', ['limit' => 200]);
        $articles = $this->fetchTable('Articles')->find('all');
        $poindeventes = $this->Inventaires->Pointdeventes->find('list', ['limit' => 200]);


        $now =  new FrozenTime('now', 'Africa/Tunis');
        $this->set(compact('inventaire', 'depots', 'articles', 'now', 'code', 'type', 'poindeventes'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Inventaire id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inventaire = $this->Inventaires->get($id, [
            'contain' => []
        ]);
        $type = $inventaire->typeinventaire;
        ///
        //debug($type);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inventaire = $this->Inventaires->patchEntity($inventaire, $this->request->getData());
            if ($this->Inventaires->save($inventaire)) {
                $inv_id = ($this->Inventaires->save($inventaire)->id);

                $this->misejour("Inventaires", "edit", $inv_id);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $li) {


                        $this->loadModel('Ligneinventaires');
                        if ($li['sup'] != 1  && (!empty($li['article_id']))) {

                            $data1['inventaire_id'] = $inventaire->id;
                            $data1['article_id'] = $li['article_id'];
                            $data1['qteStock'] = $li['qteStock'];



                            //debug($data1);die;
                            if (isset($li['id']) && (!empty($li['id']))) {

                                $ligneinv = $this->fetchTable('Ligneinventaires')->get($li['id'], [
                                    'contain' => []
                                ]);

                                //debug('rrr');

                            } else {
                                //debug('uuu');
                                $ligneinv  = $this->fetchTable('Ligneinventaires')->newEmptyEntity();
                            };
                            $ligneinv = $this->fetchTable('Ligneinventaires')->patchEntity($ligneinv, $data1);




                            if ($this->fetchTable('Ligneinventaires')->save($ligneinv)) {
                                // $this->Flash->success("Fournisseurbanques has been modified successfully");
                            } else {
                                // $this->Flash->error("Failed to modify fournisseurbanques");
                            }
                        } else {
                            if (!empty($li['id'])) {


                                // $this->request->allowMethod(['post', 'delete']);
                                $ligneinv = $this->fetchTable('Ligneinventaires')->get($li['id']);
                                $this->fetchTable('Ligneinventaires')->delete($ligneinv);
                            }
                        }
                    }
                }


                // $this->Flash->success(__('The {0} has been saved.', 'Inventaire'));

                return $this->redirect(['action' => 'index/' . $type]);
            }
            // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Inventaire'));
        }
        $this->loadModel('Ligneinventaires');
        $depots = $this->Inventaires->Depots->find('list', ['limit' => 200]);
        $pointdeventes = $this->Inventaires->Pointdeventes->find('list', ['limit' => 200]);

        $articles = $this->fetchTable('Articles')->find('all');
        $lignes = $this->fetchTable('Ligneinventaires')->find()->where('Ligneinventaires.inventaire_id=' . $id);
        $this->set(compact('inventaire', 'depots', 'lignes', 'articles', 'type', 'pointdeventes'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Inventaire id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //    $this->request->allowMethod(['post', 'delete']);
        $this->loadModel("Ligneinventaires");
        $lignes = $this->Ligneinventaires->find('all')->where(['Ligneinventaires.inventaire_id =' . $id]);
        foreach ($lignes as $li) {
            $this->Ligneinventaires->delete($li);
        }
        $inventaire = $this->Inventaires->get($id);
        $type = $inventaire->typeinventaire;

        if ($this->Inventaires->delete($inventaire)) {
            $inv_id = ($this->Inventaires->save($inventaire)->id);

            $this->misejour("Inventaires", "delete", $inv_id);
            //$this->Flash->success(__('The {0} has been deleted.', 'Inventaire'));
        } else {
            //$this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Inventaire'));
        }

        return $this->redirect(['action' => 'index/' . $type]);
    }
    public function valider($id = null)
    {
        $inventaire = $this->Inventaires->get($id);
        $type = $inventaire->typeinventaire;
        $inventaire->valide = 1;
        $this->Inventaires->save($inventaire);

        return $this->redirect(['action' => 'index/' . $type]);
    }


    public function indexp()
    {


        // $cond1='';
        // $cond2='';
        // $cond3='';
        $connection = ConnectionManager::get('default');
        $mois_debut = $this->request->getQuery('mois_debut');
        $mois_fin = $this->request->getQuery('mois_fin');
        $article_id = $this->request->getQuery('article_id');
        $famillemp_id = $this->request->getQuery('famillemp_id');
        $articlepf_id = $this->request->getQuery('articlepf_id');
        $S_famille_id = $this->request->getQuery('sousfamille1_id');
        $Ss_famille_id = $this->request->getQuery('sousfamille2_id');


        $query = '';
        $cond = '1=1';
        $condd = '1=1';
        $condmp = '1=1';
        if ($article_id != null) {
            $cond .= ' and (fichearticles.article_id1=' . $article_id . '
            or fichearticles.article_id2=' . $article_id . '
            or fichearticles.article_id3=' . $article_id . ')';
            $condmp .= ' and (fichearticles.article_id1=' . $article_id . '
            or fichearticles.article_id2=' . $article_id . '
            or fichearticles.article_id3=' . $article_id . ')';
            $cond2 = ' (fichearticles.article_id1=' . $article_id . '
            or fichearticles.article_id2=' . $article_id . '
            or fichearticles.article_id3=' . $article_id . ')';
            $cond21 = ' (fichearticles.article_id2=' . $article_id . '
            or fichearticles.article_id3=' . $article_id . ')';
            $cond22 = ' (fichearticles.article_id3=' . $article_id . ')';
        } else {
            $cond2 = '1=1';
            $cond21 = '1=1';
            $cond22 = '1=1';
        }

        if ($famillemp_id != null) {
            $artfamilles = $this->fetchTable('Articles')->find('all')->where(['Articles.famille_id' => $famillemp_id]);
            $liste = "(";
            foreach ($artfamilles as $i => $art) {

                $liste .= ',' . "'" . ($art->id) . "'";

                // $liste[$i]=$art->id;
            }
            $liste .= ")";
            $liste = preg_replace('/,/', '', $liste, 1);

            //debug($liste);
            //  $cond.= ' and articles.famille_id='.$famillemp_id;
            $cond .= ' and (fichearticles.article_id1 in ' . $liste .
                ' or fichearticles.article_id2 in ' . $liste .
                ' or fichearticles.article_id3 in ' . $liste . ')';

            $cond2f = '(fichearticles.article_id1 in ' . $liste .
                ' or fichearticles.article_id2 in ' . $liste .
                ' or fichearticles.article_id3 in ' . $liste . ')';
            $cond22f = '(fichearticles.article_id2 in ' . $liste . '
                 or fichearticles.article_id3 in ' . $liste . ')';
            $cond222f = '(fichearticles.article_id3 in ' . $liste . ')';
            //debug($cond222f);//die;
        } else {
            $cond2f = '1=1';
            $cond22f = '1=1';
            $cond222f = '1=1';
        }
        if ($articlepf_id != null) {
            $cond .= ' and fichearticles.article_id=' . $articlepf_id;
            //$cond.= ' and articles.id='.$articlepf_id;

        }
        //   debug($cond);

        // $query = $this->fetchTable('Fichearticles')->find('all')->select('article_id')
        // ->where(['OR'=>['Fichearticles.article_id1='."'".$article_id."'" ,
        // 'Fichearticles.article_id2='."'".$article_id."'",
        // 'Fichearticles.article_id3='."'".$article_id."'"]])
        // ->group('Fichearticles.article_id');

        if ($this->request->getQuery()) {
            //  debug($cond2);
            $query = $connection->execute('SELECT * from fichearticles where ' . $cond . ' 
        group by fichearticles.article_id ;')->fetchAll('assoc');
            //              $querymp = $connection->execute('SELECT * from fichearticles where ' . $condmp . ' 
            //        group by fichearticles.article_id1,fichearticles.article_id2,fichearticles.article_id3 order by id;')->fetchAll('assoc');
            //              debug($querymp);die;
            //         $queryy = $connection->execute('SELECT * from fichearticles where '.$cond.' group by fichearticles.article_id1,fichearticles.article_id2,fichearticles.article_id3 order by id ;
            //        ')->fetchAll('assoc');
        }
        //  debug($queryy);//die;

        //debug($article);

        //debug($query->toArray());

        // $listearts=$this->paginate($query);
        $listearts = [];

        $articles = $this->fetchTable('Articles')->find('all')
            ->where('Articles.famille_id <>1');
        $mois = $this->fetchTable('Mois')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articlepfs = $this->fetchTable('Articles')->find('all')
            ->where('Articles.famille_id=1');
        $famillemps = $this->fetchTable('Familles')->find('all')
            ->where('Familles.id<>1');
        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('condmp', 'Ss_famille_id', 'S_famille_id', 'sousfamille1s', 'sousfamille2s', 'cond222f', 'cond22f', 'cond2f', 'cond22', 'cond21', 'cond2', 'queryy', 'article_id', 'listearts', 'articles', 'mois', 'articlepfs', 'articlepf_id', 'famillemp_id', 'famillemps', 'mois_debut', 'mois_fin', 'query'));
    }

    public function imprimerp()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_prévisionnement' . $abrv);

        //   debug($liendd);
        $inventaire = 0;
        foreach ($liendd as $k => $liens) {
            //debug($liens);
            if (@$liens['lien'] == 'inventaires') {
                $inventaire = $liens['imprimer'];
            }
        }

        if (($inventaire <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'logout'));
        }

        $connection = ConnectionManager::get('default');
        $mois_debut = $this->request->getQuery('mois_debut');
        $mois_fin = $this->request->getQuery('mois_fin');
        $article_id = $this->request->getQuery('article_id');
        $famillemp_id = $this->request->getQuery('famillemp_id');
        $articlepf_id = $this->request->getQuery('articlepf_id');
        // debug($mois_debut);

        $query = '';
        $cond = '1=1';
        if ($article_id != null) {
            $cond .= ' and (fichearticles.article_id1=' . $article_id . '
                   or fichearticles.article_id2=' . $article_id . '
                   or fichearticles.article_id3=' . $article_id . ')';
        }
        if ($famillemp_id != null) {
            $artfamilles = $this->fetchTable('Articles')->find('all')->where(['Articles.famille_id' => $famillemp_id]);
            $liste = "(";
            foreach ($artfamilles as $i => $art) {

                $liste .= ',' . "'" . ($art->id) . "'";
                // $liste[$i]=$art->id;
            }
            $liste .= ")";
            $liste = preg_replace('/,/', '', $liste, 1);

            //debug($liste);
            //  $cond.= ' and articles.famille_id='.$famillemp_id;
            $cond .= ' and (fichearticles.article_id1 in ' . $liste .
                ' or fichearticles.article_id2 in ' . $liste .
                ' or fichearticles.article_id3 in ' . $liste . ')';
        }
        if ($articlepf_id != null) {
            $cond .= ' and fichearticles.article_id=' . $articlepf_id;
            //$cond.= ' and articles.id='.$articlepf_id;

        }
        //debug($cond);

        // $query = $this->fetchTable('Fichearticles')->find('all')->select('article_id')
        // ->where(['OR'=>['Fichearticles.article_id1='."'".$article_id."'" ,
        // 'Fichearticles.article_id2='."'".$article_id."'",
        // 'Fichearticles.article_id3='."'".$article_id."'"]])
        // ->group('Fichearticles.article_id');
        if ($this->request->getQuery()) {
            $query = $connection->execute('SELECT * from fichearticles where ' . $cond . ' group by fichearticles.article_id ;')->fetchAll('assoc');
            $queryy = $connection->execute('SELECT * from fichearticles where ' . $cond . ' group by fichearticles.article_id1,fichearticles.article_id2,fichearticles.article_id3 ;
               ')->fetchAll('assoc');
        }


        //  debug($articles) ;
        $this->set(compact('mois_debut', 'mois_fin', 'articlepf_id', 'famillemp_id', 'article_id', 'query', 'queryy'));
    }


    public function calculQte()
    {

        /// $date = $this->request->getQuery('date');
        $depot = $this->request->getQuery('depot');
        $ind = $this->request->getQuery('ind');
        $tab = $this->request->getQuery('tab');
        $art_id = $this->request->getQuery('idarticle');
        // debug($art_id);


        //  debug($tab);

        $list = '0';
        foreach ($tab as $i) {

            $list = $list . ',' . $i;
        }

        $cond00 = 'Articles.id not in (' . $list . ')';
        $cond11 = 'Articles.famille_id = 1 ';


        //debug($cond00);

        $articles = $this->fetchTable('Articles')->find('all')->where([$cond00, $cond11]);

        ///debug($articles->toArray());
        /* 
    $articles= [] ; */
        $connection = ConnectionManager::get('default');


        /// debug($qtestock);



        $res = " <table  style='min-height: 3px; ' class='table table-bordered table-striped table-bottomless'>
    <thead>
    
    
         </thead>";
        $i = $ind;
        //debug($i);
        foreach ($articles as $art) :
            $i++;
            ///    debug($i);  

            //debug($i);
            $article_id = $art->id;
            /*         var_dump($article_id,$depot,$date) ;
 */
            date_default_timezone_set('Africa/Tunis');

            $date = date('Y-m-d H:i:s', strtotime($this->request->getQuery('date')));
            //  debug($date);die;
            $qtestock = $connection->execute("select stockbassem(" . $article_id . ",'" . $date . "','0','. $depot .') as v")->fetchAll('assoc');
            ///  debug($qtestock);

            if ($qtestock[0]['v'] > 0) {

                $res =  $res . "<tbody><tr>";
                $res = $res . "<td align='center' style='width: 50%; '><input style='color : red ;'  readonly  value='" . $art->Dsignation . "'   'type='text' index=" . $i . "  name='data[ligner][" . $i . "][article]'  champ='article' table='ligner' class='form-control' >
    <input value='" . $art->id . "' type='hidden' index=" . $i . "  name='data[ligner][" . $i . "][article_id]'  champ='article_id' table='ligner' class='form-control' >
    </td>";

                $res = $res . "<td align='center' style='width: 20%;'><input   readonly  value='" . $qtestock[0]['v'] . "'  type='text' name='data[ligner][" . $i . "][qteTheorique]' index=" . $i . "    champ='qteTheorique' table='ligner' class='form-control'  ></td>";
                $res = $res . "<td align='center' style='width: 20%;'><input value='0' type='number' name='data[ligner][" . $i . "][qteStock]'  index=" . $i . " champ='qteStock'    id='qteStock$i'  table='ligner' class='form-control'   Onblur='showBtn(this.value)'  ></td>";
                $res = $res . "<td align='center' style='width: 10%;'>  <i  index=" . $i . " id='supp$i' class='fa fa-times supLigne0' style='color: #c9302c;font-size: 22px; display:none ;'   Onclick='suppligne(this.value)'  ></i>    </td>";
            }


        endforeach;

        $res = $res . "</tr></tbody></table>";

        echo json_encode(array('res' => $res, 'indexx' => $i, "success" => true));
        die;
    }


    public function getquantite()

    {

        date_default_timezone_set('Africa/Tunis');
        $articleid = $this->request->getQuery('idarticle');
        // $date = $this->request->getQuery('date');
        $depotid = $this->request->getQuery('depot');
        $date = date("Y-m-d H:i:s");
        /*    $article_id = 886 ;
  $depot =  33 ;
  $date = "2023-01-03T16:34:46" ;  */

        //   debug($depotid);
        //   debug($date);
        //   debug($articleid);


        $connection = ConnectionManager::get('default');
        $inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
        $inv = $inventaires[0]['v'];
        /*   die ;
    $inventaires = $connection->execute("select stockbassem(" . $article_id . ",'" . $date . "','0'," . $depot . " ) as v")->fetchAll('assoc');
    
    $qte = $inventaires[0]['v'];
    ///debug($qte) ; */

        echo json_encode(array('qtes' => $inv,  "success" => true));
        die;
    }




    public function getDepot($id = null)
    {

        $id = $this->request->getQuery('id');

        $query = $this->fetchTable('Depots')->find();
        $query->where(['pointdevente_id' => $id]);

        $select = "
   
    <select name='import' id='import-id' class='form-control select2'  '>
                <option >Choisir depot !!</option>";
        foreach ($query as $q) {
            $select =  $select . "  <option value ='" . $q['id'] . "'";
            $select =  $select . " >" . $q['name'] . "</option>";
        }
        $select = $select . "</select> </div> </div> ";
        echo json_encode(array('select' => $select));
        die;
    }




    public function getDepotbs($id = null)
    {

        $id = $this->request->getQuery('id');

        $query = $this->fetchTable('Depots')->find();
        $query->where(['pointdevente_id' => $id]);

        $select = "
                   <label class='control-label' for='depot_id'>Dépot</label>
    <select name='depot_id' id='depot_id' class='form-control '  '>
                <option >Veuillez choisir !!</option>";
        foreach ($query as $q) {
            $select =  $select . "  <option value ='" . $q['id'] . "'";
            $select =  $select . " >" . $q['name'] . "</option>";
        }
        $select = $select . "</select>";
        echo json_encode(array('select' => $select));
        die;
    }
}

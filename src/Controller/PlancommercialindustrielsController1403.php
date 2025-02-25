<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;

/**
 * Plancommercialindustriels Controller
 *
 * @property \App\Model\Table\PlancommercialindustrielsTable $Plancommercialindustriels
 * @method \App\Model\Entity\Plancommercialindustriel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlancommercialindustrielsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->loadModel('Mois');
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        $depot_id = $this->request->getQuery('depot_id');
        $marge = $this->request->getQuery('marge');
        $moisdu = $this->request->getQuery('moisdu');
        $moisau = $this->request->getQuery('moisau');
        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        if ($datedebut) {
            $cond1 = "Plancommercialindustriels.date >=  '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond2 = "Plancommercialindustriels.date  <=  '" .     $datefin . "' ";
        }
        if ($depot_id) {
            $cond3 = "Plancommercialindustriels.depot_id  =  '" .     $depot_id . "' ";
        }
        if ($marge) {
            $cond4 = "Plancommercialindustriels.marge  =  '" .     $marge . "' ";
        }
        if ($moisdu) {
            $cond5 = "Plancommercialindustriels.moisdu_id  >=  '" .     $moisdu . "' ";
        }
        if ($moisau) {
            $cond6 = "Plancommercialindustriels.moisau_id  <=  '" .     $moisau . "' ";
        }
        $query = $this->Plancommercialindustriels->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6])->order(["Plancommercialindustriels.id" => 'desc']);
        $this->paginate = [
            'contain' => ['Depots', 'Mois'],
        ];
        // debug($query->toarray());
        $plancommercialindustriels = $this->paginate($query);
        $depots = $this->Plancommercialindustriels->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $mois = $this->fetchTable('Mois')->find('all');


        $this->set(compact('plancommercialindustriels', 'depots', 'mois', 'moisdu', 'moisau'));
    }

    /**
     * View method
     *
     * @param string|null $id Plancommercialindustriel id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $plancommercialindustriel = $this->Plancommercialindustriels->get($id, [
            'contain' => ['Depots'],
        ]);
        $depots = $this->Plancommercialindustriels->Depots->find('list', ['limit' => 200])->all();
        $this->loadModel('Mois');

        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        //  $moisdu = $this->request->getQuery('moisdu');
        //debug($moisdu);die;
        //  $moisau= $this->request->getQuery('moisau');
        $lignes = $this->fetchTable('Ligneplancommercials')->find('all', [
            'contain' => ['Articles']
        ])->where(['Ligneplancommercials.plancommercialindustriel_id  = (' . $id . ')']);

        ///debug($lignes->toarray());





        $moisdu = $plancommercialindustriel->moisdu_id;
        $moisau = $plancommercialindustriel->moisau_id;
        $this->set(compact('plancommercialindustriel', 'depots', 'mois', 'lignes', 'moisdu', 'moisau'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Ligneplancommercials');
        $num = $this->Plancommercialindustriels->find()->select(["num" =>
        'MAX(Plancommercialindustriels.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        $plancommercialindustriel = $this->Plancommercialindustriels->newEmptyEntity();
        if ($this->request->is('post')) {
            $plancommercialindustriel = $this->Plancommercialindustriels->patchEntity($plancommercialindustriel, $this->request->getData());
            if ($this->Plancommercialindustriels->save($plancommercialindustriel)) {

                $plancommercialindustriel_id = $plancommercialindustriel->id;
                if (isset($this->request->getData('data')['Pci']) && (!empty($this->request->getData('data')['Pci']))) {

                    foreach ($this->request->getData('data')['Pci'] as $i => $pc) {
                        //debug($this->request->getData('data')['Pci']);die;

                        $data['plancommercialindustriel_id'] = $plancommercialindustriel_id;
                        $data['article_id'] = $pc['article_id'];
                        $data['qtedisp'] = $pc['qtedisp'];
                        $data['qtenonliv'] = $pc['qtenonliv'];
                        $data['qtetheo'] = $pc['qtetheo'];
                        $data['stockminart'] = $pc['stockminart'];
                        $data['qtevendu'] = $pc['qtevendu'];
                        $data['qtelivper'] = $pc['qtelivper'];
                        $data['besoin'] = $pc['besoin'];
                        $data['qtenoncloture'] = $pc['qtenoncloture'];
                        $data['besoinprodtheoperiode'] = $pc['besoinprodtheoperiode'];
                        $data['qtprodpratique'] = $pc['qtprodpratique'];
                        $data['lancerpdp'] = $pc['lancerpdp'];
                        $data['qtem3'] = $pc['qtem3'];
                        $data['qtem2'] = $pc['qtem2'];
                        $data['qtem1'] = $pc['qtem1'];
                        $data['ventem1'] = $pc['ventem1'];
                        $data['ventem2'] = $pc['ventem2'];
                        $data['ventem3'] = $pc['ventem3'];

                        //debug($data);

                        $ligneplancommercial = $this->fetchTable('Ligneplancommercials')->newEmptyEntity();

                        $ligneplancommercial = $this->fetchTable('Ligneplancommercials')->patchEntity($ligneplancommercial, $data);
                        
                        if ($this->fetchTable('Ligneplancommercials')->save($ligneplancommercial)) {
                            //debug($ligneplancommercial);die();
                            //$this->Flash->success("Ligne ligneplancommercial ajouté");
                        } else {
                          //  $this->Flash->error("Veuillez réssayer");
                        }


                        $this->set(compact("ligneplancommercial"));
                    }
                }









               // $this->Flash->success(__('The plancommercialindustriel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The plancommercialindustriel could not be saved. Please, try again.'));
        }
        $depots = $this->Plancommercialindustriels->Depots->find('list', ['limit' => 200])->all();
        $this->loadModel('Mois');

        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);



        $moisdu = $this->request->getQuery('moisdu');
        $moisau = $this->request->getQuery('moisau');

        $this->set(compact('plancommercialindustriel', 'depots', 'mm', 'mois', 'moisdu', 'moisau'));
    }




    public function getplan($moisau = null)
    {
        // $plancommercialindustriel = $this->Plancommercialindustriels;

        //   $plancommercialindustriel_id = $plancommercialindustriel->id; 
        $connection = ConnectionManager::get('default');
        $index = $this->request->getQuery('index');
        $moisdu = $this->request->getQuery('moisdu'); //debug ($moisdu);die;
        $moisau = $this->request->getQuery('moisau');
        $moisau1 = $moisau + 1;
        $moisau2 = $moisau + 2;
        $moisau3 = $moisau + 3;
        //debug($moisau1);die;
        //$article_id= $this->request->getQuery('article_id');
        //debug($index);
        //die;
        $this->loadModel('Articles');

        //debug($r)->toArray();die;
        $arti = $connection->execute('SELECT article_id,SUM(qte) as q FROM ligneprevisionachats where   ligneprevisionachats.moi_id BETWEEN ' . $moisdu . '  AND  ' . $moisau . ' group by ligneprevisionachats.article_id;')->fetchAll('assoc');



        //      $list ='0' ;
        //            foreach ($arti as $i => $a) {
        //                //debug($a['q']);
        //                 $list = $list . ',' . $a['q'];
        //                 
        //                 //debug($list);
        //            }


        //$articless = $this->Articles->find('all')
        //        ->where(['Articles.id  in (' . $list . ')']) ;         
        //debug($query);
        // style='display:none;'
        $res = "<table  class='table table-bordered table-striped table-bottomless'>
                <thead><tr>
                    <td align='center' style='width:7%;'><strong>Désignation</strong></td>
                    <td align='center' style='width: 5%;'><strong>Quantité Disponible</strong></td>
                    <td align='center' style='width: 5%;'><strong>Qté cmd non liv</strong></td>
                     <td align='center' style='width: 5%;'><strong>Qté Théorique</strong></td>
                    <td align='center' style='width: 5%;'><strong>STOCK MIN ART</strong></td>
                    <td align='center' style='width: 5%;'><strong>Qte LIV PERIODE</strong></td>
                     <td align='center' style='width: 5%;'><strong>Qte vendue n-1</strong></td>
                     <td align='center' style='width: 5%;'><strong>Besoin</strong></td>
                     <td align='center' style='width: 5%;'><strong>QT OF NON CLOTURE PF</strong></td>
                     <td align='center' style='width: 5%;'><strong>Besoin Production THEORIQUE periode</strong></td>
                     <td align='center' style='width: 5%;'><strong>Besoin Production PRATIQUE</strong></td>
                     <td align='center' style='width: 3%;'><strong>Lancer Vers PDP FORMULE</strong></td>                   
                     <td align='center' style='width: 5%;'><strong>VENTE N-1  M1</strong></td>
                     <td align='center' style='width: 5%;'><strong>QTE M1</strong></td>
                     <td align='center' style='width: 5%;'><strong>VENTE N-1 M2</strong></td>
                     <td align='center' style='width: 5%;'><strong>QTE M2</strong></td>
                     <td align='center' style='width: 5%;'><strong>VENTE N-1 M3</strong></td>
                     <td align='center' style='width: 5%;'><strong>QTE M3</strong></td>
                    
                     

                    </tr> </thead>";
        $res =  $res . "<tbody>";

        $qtenoncloture = 0;
        $qtetheorique = 0;
        $besoin = 0;
        $besoinprodtheoperiode = 0;
        foreach ($arti as $i => $pf) {
            // debug($pf);die;
            $art = $this->Articles->get($pf['article_id'], [
                'contain' => []
            ]);
            //debug($art);die;

            //$date=date_default_timezone_set('Africa/Tunis');
            $time = new FrozenTime('now', 'Africa/Tunis');
            $date = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');
            //debug($date);die;

            $qtedisp = $connection->execute("select stockbassem(" . $art->id . ",'" . $date . "','0','0') as q")->fetchAll('assoc');

            //debug($qtedisp);
            $qtecmdnonliv = $connection->execute("select stockbassemseuil(" . $art->id . ",'" . $date . "','0','0') as v")->fetchAll('assoc');

           // debug($qtecmdnonliv);
            $qtetheorique =  $qtedisp[0]['q'] -  $qtecmdnonliv[0]['v'];
            $qteart = $connection->execute('SELECT  SUM(seuilmois.alert) as l FROM seuilmois where  seuilmois.article_id= ' . $art->id . ' AND seuilmois.moi_id BETWEEN ' . $moisdu . '  AND  ' . $moisau . ' group by seuilmois.article_id;')->fetchAll('assoc');
            $qtevendu = $connection->execute('SELECT  SUM(ligneprevisionachats.qte) as q FROM ligneprevisionachats where  ligneprevisionachats.moi_id BETWEEN ' . $moisdu . '  AND  ' . $moisau . ' group by ligneprevisionachats.article_id;')->fetchAll('assoc');

            $qteliv = $connection->execute('SELECT  SUM(lignebonlivraisons.quantiteliv) as liv FROM lignebonlivraisons INNER JOIN bonlivraisons ON bonlivraisons.id = lignebonlivraisons.bonlivraison_id where  lignebonlivraisons.article_id= ' . $art->id . ' AND  bonlivraisons.typebl=1 AND MONTH( bonlivraisons.date) BETWEEN ' . $moisdu . '  AND  ' . $moisau . '  ;')->fetchAll('assoc');
            $besoin =  $qtevendu[$i]['q'] * (1 +  $qtecmdnonliv[0]['v']) + $qteart[0]['l'] - $qteliv[0]['liv'];
          
            // debug($qtevendu[$i]['q'] ) ;
            // debug( $qtecmdnonliv[0]['v']) ;
            // debug($qteart[0]['l'] ) ;
            // debug( $qteliv[0]['liv']) ;

            // debug($besoin);
            // debug($qtetheorique) ;
            // debug($qtenoncloture) ;

            $besoinprodtheoperiode =  $besoin - $qtetheorique - $qtenoncloture;
            /// debug( $besoinprodtheoperiode) ;
            $venteM1 = $connection->execute('SELECT  SUM(ligneprevisionachats.qte) as q FROM ligneprevisionachats where   ligneprevisionachats.article_id= ' . $art->id . ' AND ligneprevisionachats.moi_id=' . $moisau1 . ' ;')->fetchAll('assoc');

            $qtprodpratique = $besoinprodtheoperiode;


            $venteM2 = $connection->execute('SELECT  SUM(ligneprevisionachats.qte) as q FROM ligneprevisionachats where   ligneprevisionachats.article_id= ' . $art->id . ' AND ligneprevisionachats.moi_id=' . $moisau2 . ' ;')->fetchAll('assoc');
            $venteM3 = $connection->execute('SELECT  SUM(ligneprevisionachats.qte) as q FROM ligneprevisionachats where   ligneprevisionachats.article_id= ' . $art->id . ' AND ligneprevisionachats.moi_id=' . $moisau3 . ' ;')->fetchAll('assoc');

            //debug($venteM1);die;
            if ($venteM1[0]['q'] == null) {
                $vent1 = 0;
            } else {
                $vent1 = $venteM1[0]['q'];
            }
            $qtem1 = $besoinprodtheoperiode + $vent1;
            if ($venteM2[0]['q'] == null) {
                $vent2 = 0;
            } else {
                $vent2 = $venteM2[0]['q'];
            }
            $qtem2 = $besoinprodtheoperiode + $vent1 + $vent2;
            if ($venteM3[0]['q'] == null) {
                $vent3 = 0;
            } else {
                $vent3 = $venteM3[0]['q'];
            }
            $qtem3 = $besoinprodtheoperiode + $vent1 + $vent2 + $vent3;
            if ($qtprodpratique > 0) {
                $ch = "oui";
            } else {
                $ch = "non";
            }

            $res =  $res . "<tr>";


            $res = $res . "<td>"
                // . "<input value='" .$pf['id'] ."' type='' name=data[Pci][".$i."][id] class='form-control'>"
                . "<input value='" . $art->id . "' type='hidden' name=data[Pci][" . $i . "][article_id] class='form-control'>"
                . "<input value='" . $art->Dsignation . "'  class='form-control' , readonly></td>";

            $res = $res . "<td><input value='" . $qtedisp[0]['q'] . "' name=data[Pci][" . $i . "][qtedisp] class='form-control' , readonly></td>";

            $res = $res . "<td><input value='" . $qtecmdnonliv[0]['v'] . "' name=data[Pci][" . $i . "][qtenonliv] class='form-control' , readonly></td>";
            $res = $res . "<td><input value='" . $qtetheorique . "'  name=data[Pci][" . $i . "][qtetheo] class='form-control' , readonly></td>";
            $res = $res . "<td><input value='" . $qteart[0]['l'] . "' name=data[Pci][" . $i . "][stockminart] class='form-control' , readonly></td>";
            $res = $res . "<td><input value='" . $qtevendu[$i]['q'] . "' name=data[Pci][" . $i . "][qtevendu] class='form-control' , readonly></td>";
            $res = $res . "<td><input value='" . $qteliv[0]['liv'] . "' name=data[Pci][" . $i . "][qtelivper] class='form-control' , readonly></td>";
            $res = $res . "<td><input value='" . $besoin . "' name=data[Pci][" . $i . "][besoin] class='form-control' , readonly></td>";
            $res = $res . "<td><input value='" . $qtenoncloture . "' name=data[Pci][" . $i . "][qtenoncloture] class='form-control' , readonly></td>";
            $res = $res . "<td><input value='" . $besoinprodtheoperiode . "' name=data[Pci][" . $i . "][besoinprodtheoperiode] class='form-control' , readonly></td>";
            $res = $res . "<td><input  id='qtepratique$i' value='" . $qtprodpratique . "' name=data[Pci][" . $i . "][qtprodpratique] class='form-control' Onkeyup='prodQte(this.value)' ></td>";
            $res = $res . "<td><input   id='lancerpdp$i'  value='" . $ch . "' name=data[Pci][" . $i . "][lancerpdp] class='form-control' ></td>";
            $res = $res . "<td><input value='" . $vent1 . "'  name=data[Pci][" . $i . "][ventem1] class='form-control' , readonly></td>";
            $res = $res . "<td><input value='" . $qtem1 . "'  name=data[Pci][" . $i . "][qtem1] class='form-control' , readonly></td>";
            $res = $res . "<td><input value='" . $vent2 . "'  name=data[Pci][" . $i . "][ventem2] class='form-control' , readonly></td>";
            $res = $res . "<td><input value='" . $qtem2 . "'  name=data[Pci][" . $i . "][qtem2] class='form-control' , readonly></td>";
            $res = $res . "<td><input value='" . $vent3 . "'  name=data[Pci][" . $i . "][ventem3] class='form-control' , readonly></td>";
            $res = $res . "<td><input value='" . $qtem3 . "'  name=data[Pci][" . $i . "][qtem3] class='form-control' , readonly></td>";


            $res = $res . "</tr>";
        }


        $res = $res . "</tbody></table>";   


       // debug($i);


        echo json_encode(array(
            'res' => $res,
            'indexa' => $i,

        ));
        exit;
        //die;
        //$this->set(compact('query'));
        /* foreach ($query as $q) {
            json_encode($q);
            debug($q);
        }
     */
    }



    /**
     * Edit method
     *
     * @param string|null $id Plancommercialindustriel id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */




    public function edit($id = null)
    {

        $plancommercialindustriel = $this->Plancommercialindustriels->get($id, [
            'contain' => [],
        ]);

        $this->loadModel('Ligneplancommercials');



        //$plancommercialindustriel_id=$plancommercialindustriel->id;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $plancommercialindustriel = $this->Plancommercialindustriels->patchEntity($plancommercialindustriel, $this->request->getData());
            if ($this->Plancommercialindustriels->save($plancommercialindustriel)) {

                $ligneexiste = $this->fetchTable('Ligneplancommercials')->find('all')->where('Ligneplancommercials.plancommercialindustriel_id =' . $id);
                //dd($ligneexiste);
                foreach ($ligneexiste as $ligne) {
                    // dd($ligne);
                    $this->Ligneplancommercials->delete($ligne);
                    // dd($ligne);
                }


                if (isset($this->request->getData('data')['Pci']) && (!empty($this->request->getData('data')['Pci']))) {

                    foreach ($this->request->getData('data')['Pci'] as $i => $pc) {
                        //debug($this->request->getData('data')['Pci']);die;
                        $ligneplancommercial = $this->fetchTable('Ligneplancommercials')->newEmptyEntity();
                        $data['plancommercialindustriel_id'] = $id;
                        $data['article_id'] = $pc['article_id'];
                        $data['qtedisp'] = $pc['qtedisp'];
                        $data['qtenonliv'] = $pc['qtenonliv'];
                        $data['qtetheo'] = $pc['qtetheo'];
                        $data['stockminart'] = $pc['stockminart'];
                        $data['qtevendu'] = $pc['qtevendu'];
                        $data['qtelivper'] = $pc['qtelivper'];
                        $data['besoin'] = $pc['besoin'];
                        $data['qtenoncloture'] = $pc['qtenoncloture'];
                        $data['besoinprodtheoperiode'] = $pc['besoinprodtheoperiode'];
                        $data['qtprodpratique'] = $pc['qtprodpratique'];
                        $data['lancerpdp'] = $pc['lancerpdp'];
                        $data['qtem3'] = $pc['qtem3'];
                        $data['qtem2'] = $pc['qtem2'];
                        $data['qtem1'] = $pc['qtem1'];
                        $data['ventem1'] = $pc['ventem1'];
                        $data['ventem2'] = $pc['ventem2'];
                        $data['ventem3'] = $pc['ventem3'];





                        $ligneplancommercial = $this->fetchTable('Ligneplancommercials')->patchEntity($ligneplancommercial, $data);
                        //debug($ligneplancommercial);die;
                        if ($this->fetchTable('Ligneplancommercials')->save($ligneplancommercial)) {
                            //debug($ligneplancommercial);die();
                          //  $this->Flash->success("Ligne ligneplancommercial ajouté");
                        } else {
                          //  $this->Flash->error("Veuillez réssayer");
                        }


                        $this->set(compact("ligneplancommercial"));
                    }
                }




               // $this->Flash->success(__('The plancommercialindustriel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The plancommercialindustriel could not be saved. Please, try again.'));
        }
        $depots = $this->Plancommercialindustriels->Depots->find('list', ['limit' => 200])->all();
        $this->loadModel('Mois');

        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        //  $moisdu = $this->request->getQuery('moisdu');
        //debug($moisdu);die;
        //  $moisau= $this->request->getQuery('moisau');
        $lignes = $this->fetchTable('Ligneplancommercials')->find('all', [
            'contain' => ['Articles']
        ])->where(['Ligneplancommercials.plancommercialindustriel_id  = (' . $id . ')']);

        ///debug($lignes->toarray());





        $moisdu = $plancommercialindustriel->moisdu_id;
        $moisau = $plancommercialindustriel->moisau_id;

        $this->set(compact('plancommercialindustriel', 'depots', 'mois', 'moisdu', 'moisau', 'lignes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Plancommercialindustriel id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $plancommercialindustriel = $this->Plancommercialindustriels->get($id);
        $lignes = $this->fetchTable('Ligneplancommercials')->find('all', [])
        ->where(['Ligneplancommercials.plancommercialindustriel_id=' . $id]);
        if ($this->Plancommercialindustriels->delete($plancommercialindustriel)) {


            foreach ($lignes as $l) {
                $this->fetchTable('Ligneplancommercials')->delete($l);
            }
           // $this->Flash->success(__('The plancommercialindustriel has been deleted.'));
        } else {
          //  $this->Flash->error(__('The plancommercialindustriel could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

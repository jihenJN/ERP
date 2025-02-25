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


        $this->set(compact('plancommercialindustriels','mois', 'moisdu', 'moisau'));
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
        $this->set(compact('plancommercialindustriel', 'mois', 'lignes', 'moisdu', 'moisau'));
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
         $marge = $this->request->getQuery('marge');
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
        $this->loadModel('Pcis');
          $historiques = $this->Pcis->find('all');
                  foreach ($historiques as $h) {
            $this->Pcis->delete($h);
        }
              $qtenoncloture = 0;
        $qtetheorique = 0;
        $besoin = 0;
        $besoinprodtheoperiode = 0;

            foreach ($arti as $k => $pf) {
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
            $qteart = $connection->execute('SELECT  SUM(seuilmois.min) as l FROM seuilmois where  seuilmois.article_id= ' . $art->id . ' AND seuilmois.moi_id BETWEEN ' . $moisdu . '  AND  ' . $moisau . ' group by seuilmois.article_id;')->fetchAll('assoc');
            $qtevendu = $connection->execute('SELECT  SUM(ligneprevisionachats.qte) as q FROM ligneprevisionachats where  ligneprevisionachats.moi_id BETWEEN ' . $moisdu . '  AND  ' . $moisau . ' group by ligneprevisionachats.article_id;')->fetchAll('assoc');

            $qteliv = $connection->execute('SELECT  SUM(lignebonlivraisons.quantiteliv) as liv FROM lignebonlivraisons INNER JOIN bonlivraisons ON bonlivraisons.id = lignebonlivraisons.bonlivraison_id where  lignebonlivraisons.article_id= ' . $art->id . ' AND  bonlivraisons.typebl=1 AND MONTH( bonlivraisons.date) BETWEEN ' . $moisdu . '  AND  ' . $moisau . '  ;')->fetchAll('assoc');
            $besoin =  $qtevendu[$k]['q'] * (1 +  $marge/100) + $qteart[0]['l'] - $qteliv[0]['liv'];

            // debug($qtevendu[$k]['q'] ) ;
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
          
              if($qtprodpratique>0)  {
                  $rem=1;
              }
              else{
                  if($qtem1>0){
                       $rem=2;
                  }
                  else{
                      if($qtem2>0){
                       $rem=3;
                  }
                    else{
                          if($qtem3>0){
                       $rem=4;
                  } 
                  else{ $rem=5;}
                    }
                  }
              }
            
                $tablignefac['article_id'] =$art->id;
                $tablignefac['designation'] =$art->Code . ' '. $art->Dsignation;
              
                $tablignefac['qtedisp'] =$qtedisp[0]['q'];
                $tablignefac['qtenonliv'] =$qtecmdnonliv[0]['v'];
                $tablignefac['qtetheo'] =$qtetheorique;
                $tablignefac['stockminart'] =$qteart[0]['l'];
                $tablignefac['qtevendu'] =$qtevendu[$k]['q'];
                $tablignefac['qteliv'] =$qteliv[0]['liv'];
                $tablignefac['besoin'] = $besoin;
                $tablignefac['qtenoncloture'] =$qtenoncloture;
                $tablignefac['besoinprodtheoperiode'] = $besoinprodtheoperiode;
                $tablignefac['qtprodpratique'] =$qtprodpratique;
                $tablignefac['lancerpdp'] = "";
                $tablignefac['rang'] =$rem;
                  
                $tablignefac['ventem1'] =$vent1;
                $tablignefac['qtem1'] =$qtem1;
                $tablignefac['ventem2'] =$vent2;
                $tablignefac['qtem2'] =$qtem2;
                $tablignefac['ventem3'] =$vent3;
                $tablignefac['qtem3'] = $qtem3;
           
                  $historiquearticles = $this->fetchTable('Pcis')->newEmptyEntity();
          
                $historiquearticles = $this->Pcis->patchEntity($historiquearticles, $tablignefac);
                $this->Pcis->save($historiquearticles);
           
        }
                $tablepcis = $this->fetchTable('Pcis')->find('all')->order(['Pcis.rang' => 'ASC']);

        $res = "<table  class='table table-bordered table-striped table-bottomless'>
                <thead><tr>
                    <td align='center' style='width:30%;'><strong>Désignation</strong></td>
                    <td align='center' ><strong>Qte Disponible</strong></td>
                    <td align='center' ><strong>Qté cmd non liv</strong></td>
                     <td align='center' ><strong>Qté Théorique</strong></td>
                    <td align='center' ><strong>STOCK MIN ART</strong></td>
                    <td align='center' ><strong>Qte LIV PERIODE</strong></td>
                     <td align='center' ><strong>Qte vendue n-1</strong></td>
                     <td align='center' ><strong>Besoin</strong></td>
                     <td align='center' ><strong>QT OF NON CLOTURE PF</strong></td>
                     <td align='center' ><strong>Besoin Production THEORIQUE periode</strong></td>
                     <td align='center' ><strong>Besoin Production PRATIQUE</strong></td>
                     <td align='center' ><strong>Rang</strong></td>
                     <td align='center' ><strong>Lancer Vers PDP FORMULE</strong></td>                   
                     <td align='center' ><strong>VENTE N-1  M1</strong></td>
                     <td align='center' ><strong>QTE M1</strong></td>
                     <td align='center' ><strong>VENTE N-1 M2</strong></td>
                     <td align='center' ><strong>QTE M2</strong></td>
                     <td align='center' ><strong>VENTE N-1 M3</strong></td>
                     <td align='center' ><strong>QTE M3</strong></td>
                    
                     

                    </tr> </thead>";
        $res =  $res . "<tbody>";
        foreach ($tablepcis as $i => $pc) {
            $ch="";
$res =  $res . "<tr>";


            $res = $res . "<td>"
                // . "<input value='" .$pf['id'] ."' type='' name=data[Pci][".$i."][id] class='form-control'>"
                . "<input value='" . $pc->article_id . "' type='hidden' name=data[Pci][" . $i . "][article_id] class='form-control'>"
                . "<input value='"  .$pc->designation. "'  class='form-control' , readonly></td>";
               // $articles = $this->fetchTable('Articles')->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation']);

            $res = $res . "<td ><input value='" . $pc->qtedisp. "' name=data[Pci][" . $i . "][qtedisp] class='form-control' , readonly></td>";

            $res = $res . "<td ><input style='width:80px!important;'  value='" . $pc->qtenonliv. "' name=data[Pci][" . $i . "][qtenonliv] class='form-control' , readonly></td>";
            $res = $res . "<td ><input style='width:80px!important;' value='" . $pc->qtetheo. "'  name=data[Pci][" . $i . "][qtetheo] class='form-control' , readonly></td>";
            $res = $res . "<td ><input style='width:55px!important;' value='" . $pc->stockminart. "' name=data[Pci][" . $i . "][stockminart] class='form-control' , readonly></td>";
                      $res = $res . "<td ><input style='width:80px!important;' value='" .$pc->qteliv. "' name=data[Pci][" . $i . "][qtelivper] class='form-control' , readonly></td>";

            $res = $res . "<td ><input style='width:80px!important;' value='" . $pc->qtevendu. "' name=data[Pci][" . $i . "][qtevendu] class='form-control' , readonly></td>";
            $res = $res . "<td ><input style='width:80px!important;' value='" . sprintf('%.0f',$pc->besoin) . "' name=data[Pci][" . $i . "][besoin] class='form-control' , readonly></td>";
            $res = $res . "<td ><input style='width:80px!important;' value='" .sprintf('%.0f',$pc->qtenoncloture). "' name=data[Pci][" . $i . "][qtenoncloture] class='form-control' , readonly></td>";
            $res = $res . "<td ><input style='width:80px!important;' value='" .  sprintf('%.0f',$pc->besoinprodtheoperiode). "' name=data[Pci][" . $i . "][besoinprodtheoperiode] class='form-control' , readonly></td>";
            $res = $res . "<td ><input style='width:80px!important;' id='qtepratique$i' value='" . sprintf('%.0f',$pc->qtprodpratique) . "' name=data[Pci][" . $i . "][qtprodpratique] class='form-control ' type='number' step = 'any' required = 'true' oninput='validity.valid||(value=\"\")'></td>";
            $res = $res . "<td ><input style='width:80px!important;' id='qtepratique$i' value='" . $pc->rang. "' name=data[Pci][" . $i . "][qtprodpratique] class='form-control ' type='number' step = 'any' required = 'true' oninput='validity.valid||(value=\"\")'></td>";
    //$res = $res . "<td><input   id='lancerpdp$i'  value='" . $ch . "' name=data[Pci][" . $i . "][lancerpdp] class='form-control' ></td>";
            $res = $res . " <td ><select style='width:80px!important;' id='lancerpdp$i' class='form-control' Onkeyup='prodQte()' name=data[Pci][" . $i . "][lancerpdp] value='" . $ch . "'>
                                    <option style='width:50%!important;' value='".$ch."' " . ($pc->qtprodpratique > 0 ? "selected='selected'" : "") . " >oui</option>
                                    <option style='width:50%!important;' value='".$ch."' " . ($pc->qtprodpratique < 0 ? "selected='selected'" : "") . " >non</option>
                                </select></td>";
            
            $res = $res . "<td ><input style='width:80px!important;' value='" . sprintf('%.0f',$pc->ventem1). "'  name=data[Pci][" . $i . "][ventem1] class='form-control' , readonly></td>";
            $res = $res . "<td ><input style='width:80px!important;' value='" . sprintf('%.0f',$pc->qtem1). "'  name=data[Pci][" . $i . "][qtem1] class='form-control' , readonly></td>";
            $res = $res . "<td ><input style='width:80px!important;' value='" . sprintf('%.0f',$pc->ventem2). "'  name=data[Pci][" . $i . "][ventem2] class='form-control' , readonly></td>";
            
            $res = $res . "<td ><input style='width:80px!important;' value='" . sprintf('%.0f',$pc->qtem2). "'  name=data[Pci][" . $i . "][qtem2] class='form-control' , readonly></td>";
            $res = $res . "<td ><input style='width:80px!important;' value='" . sprintf('%.0f',$pc->ventem3). "'  name=data[Pci][" . $i . "][ventem3] class='form-control' , readonly></td>";
            $res = $res . "<td ><input style='width:80px!important;' value='" . sprintf('%.0f',$pc->qtem3) . "'  name=data[Pci][" . $i . "][qtem3] class='form-control' , readonly></td>";

        

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
                        $data['Code'] = $pc['Code'];
                        //value='"  . $art->Code . ''. $art->Dsignation . "'
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

        $this->set(compact('plancommercialindustriel', 'mois', 'moisdu', 'moisau', 'lignes'));
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

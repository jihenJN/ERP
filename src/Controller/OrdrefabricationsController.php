<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Ordrefabrications Controller
 *
 * @property \App\Model\Table\OrdrefabricationsTable $Ordrefabrications
 * @method \App\Model\Entity\Ordrefabrication[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdrefabricationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        
        
        $depot_id = $this->request->getQuery('depot_id');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');

        if ($datedebut) {
            $cond1 = 'ordrefabrications.date >="' . $datedebut . " 00:00:00' ";
        }
        if ($datefin) {
            $cond2 = 'ordrefabrications.date <="' . $datefin . " 23:59:59' ";
        }

        if ($depot_id) {
            $cond3 = "ordrefabrications.depot_id  =  '" .     $depot_id . "' ";
        }
        if ($pointdevente_id) {
            $cond4 = "ordrefabrications.pointdevente_id  =  '" .     $pointdevente_id . "' ";
        }
        $query = $this->Ordrefabrications->find('all')->where([$cond1, $cond2, $cond3, $cond4])->order(["Ordrefabrications.id" => 'desc']);
        //dd($query);
        $this->paginate = [
            'contain' => ['Depots', 'Pointdeventes'],
        ];
        $ordrefabrications = $this->paginate($query);
        // dd($plancommercialindustriels);


        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Ordrefabrications->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('ordrefabrications', 'depots', 'pointdeventes'));
    }

public function view($id = null)
    {
        $ordrefabrication = $this->Ordrefabrications->get($id, [
            'contain' => ['Depots', 'Pointdeventes'],
        ]);
        $this->loadModel('ligneordrefabrications');
    $lignes = $this->fetchTable('Ligneordrefabrications')->find('all', [
        'contain' => ['Articles']
    ])->where(['Ligneordrefabrications.ordrefabrication_id  = (' . $id . ')']);

    $this->loadModel('Ligneligneordrefabs');
    $this->loadModel('Ligneligneligneordrefabs');
    $this->loadModel('Ligneligneligneligneordrefabs');
    foreach ($lignes as $k => $lign) {
        $ligneligneordrefab = $this->fetchTable('Ligneligneordrefabs')->find('all', [
            'contain' => ['Articles']
        ])->where('Ligneligneordrefabs.ligneordrefabrications_id =' . $lign->id);
        foreach ($ligneligneordrefab as $o => $lisss) {
            $ligneligneordrefab = $this->fetchTable('Ligneligneligneordrefabs')->find('all', [
                'contain' => ['Articles']
            ])->where('Ligneligneligneordrefabs.ligneligneordrefab_id =' . $lisss->id);

            foreach ($ligneligneordrefab as $sss => $safaff) {

                $ligneligneligneordrefabsafa = $this->fetchTable('Ligneligneligneligneordrefabs')->find('all')
                    ->where('Ligneligneligneligneordrefabs.ligneligneligneordrefab_id =' . $safaff->id);
            }
            // dd($ligneligneligneordrefab->toarray());

        }
    }
    $pointdeventes = $this->Ordrefabrications->Pointdeventes->find('list', ['limit' => 200]);
    $depots = $this->Ordrefabrications->Depots->find('list', ['limit' => 200]);

    $ligneligneligneordrefab = $this->fetchTable('Ligneligneligneordrefabs')->find();
    //dd($lignes->toarray());
    $this->set(compact('ordrefabrication', 'depots', 'pointdeventes', 'ligneligneordrefab', 'ligneligneordrefab', 'ligneligneligneordrefabsafa', 'lignes'));
}
    
    /**
     * View method
     *
     * @param string|null $id Ordrefabrication id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   
       
    
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Ligneordrefabrications');
        $this->loadModel('Ligneligneordrefabs');
        $this->loadModel('Ligneligneligneordrefabs');
        $this->loadModel('Ligneligneligneligneordrefabs');
        $ligneordrefabrications = $this->fetchTable('Ligneordrefabrications')->find();
        $ligneligneordrefab = $this->fetchTable('Ligneligneordrefabs')->find();
        $ligneligneligneordrefab = $this->fetchTable('Ligneligneligneordrefabs')->find();
        foreach ($ligneordrefabrications as $i => $lig) {
            $ligneordrefabrications_id = $lig['id'];
            //debug($ligneordrefabrications_id);die;
        }
        foreach ($ligneligneordrefab as $j => $liglig) {
            $ligneligneordrefab_id = $liglig['id'];
            //debug($ligneordrefabrications_id);die;
        }
        foreach ($ligneligneligneordrefab as $k => $ligliglig) {
            $ligneligneligneordrefab_id = $ligliglig['id'];
            //debug($ligneordrefabrications_id);die;
        }


        $num = $this->Ordrefabrications->find()->select(["num" =>
        'MAX(Ordrefabrications.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);


        $ordrefabrication = $this->Ordrefabrications->newEmptyEntity();
        if ($this->request->is('post')) { //debug($this->request->getData());die;
            $ordrefabrication = $this->Ordrefabrications->patchEntity($ordrefabrication, $this->request->getData());
            if ($this->Ordrefabrications->save($ordrefabrication)) {

                $ordrefabrication_id = $ordrefabrication->id;
                //dd($ordrefabrication_id);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {

                    foreach ($this->request->getData('data')['ligner'] as $s => $ligne) {
                        //dd($s); 
                        //debug($this->request->getData('data')['ligner'][$s]['article_id']);                
                        //debug($this->request->getData('data')['ligner']);die;
                        $ligneordrefabrication = $this->fetchTable('Ligneordrefabrications')->newEmptyEntity();
                        //dd($ligneordrefabrication);
                        $dataa['article_id'] = $ligne['article_id'];

                        $dataa['quantite'] = $ligne['qte'];
                        $dataa['ordrefabrication_id']  = $ordrefabrication_id;
                        //dd($dataa);
                        $ligneordrefabrication = $this->fetchTable('Ligneordrefabrications')->patchEntity($ligneordrefabrication, $dataa);
                        //dd($ligneordrefabrication);
                        //dd($dataa);
                        $this->fetchTable('Ligneordrefabrications')->save($ligneordrefabrication);
                        // dd($ligneordrefabrication);
                        $idligne = $ligneordrefabrication->id;
                        if (isset($this->request->getData('data')['ligner'][$s]['Ofsfligne']) && (!empty($this->request->getData('data')['ligner'][$s]['Ofsfligne']))) {
                            foreach ($this->request->getData('data')['ligner'][$s]['Ofsfligne'] as $i => $ligne1) {
                                $ligneligneordrefab = $this->fetchTable('Ligneligneordrefabs')->newEmptyEntity();
                                //dd($ligneligneordrefab);
                                $data['article_id'] = $ligne1['article_idm'];
                                $data['qte'] = $ligne1['qte1comp'];
                                $data['ligneordrefabrications_id'] = $idligne;
                                //dd($data);
                                $ligneligneordrefab = $this->fetchTable('Ligneligneordrefabs')->patchEntity($ligneligneordrefab, $data);
                                //debug($ligneligneordrefab);die;
                                $this->fetchTable('Ligneligneordrefabs')->save($ligneligneordrefab);
                                //dd($ligneligneordrefab);
                                $idliglig = $ligneligneordrefab->id;
                                //dd($idddd);
                                if (isset($this->request->getData('data')['ligner'][$s]['Ofsfligne'][$i]['Phaseofsf']) && (!empty($this->request->getData('data')['ligner'][$s]['Ofsfligne'][$i]['Phaseofsf']))) {

                                    foreach ($this->request->getData('data')['ligner'][$s]['Ofsfligne'][$i]['Phaseofsf'] as $j => $ligne2) {
                                        // debug($ligne2);die;
                                        $ligneligneligneordrefab = $this->fetchTable('Ligneligneligneordrefabs')->newEmptyEntity();

                                        $datal['article_id'] = $ligne2['article_idt'];
                                        $datal['qte'] = $ligne2['qte2comp'];
                                        $datal['ligneligneordrefab_id'] = $idliglig;
                                        $ligneligneligneordrefab = $this->fetchTable('Ligneligneligneordrefabs')->patchEntity($ligneligneligneordrefab, $datal);
                                        //dd($ligneligneligneordrefab);
                                        $this->fetchTable('Ligneligneligneordrefabs')->save($ligneligneligneordrefab);
                                        //dd($ligneligneligneordrefab);
                                        $idligliglig = $ligneligneligneordrefab->id;
                                        if (isset($this->request->getData('data')['ligner'][$s]['Ofsfligne'][$i]['Phaseofsf'][$j]['Phaseofsfligne']) && (!empty($this->request->getData('data')['ligner'][$s]['Ofsfligne'][$i]['Phaseofsf'][$j]['Phaseofsfligne']))) {

                                            foreach ($this->request->getData('data')['ligner'][$s]['Ofsfligne'][$i]['Phaseofsf'][$j]['Phaseofsfligne'] as $k => $ligne3) {
                                                //debug($ligne3);die;
                                                $ligneligneligneligneordrefab = $this->fetchTable('Ligneligneligneligneordrefabs')->newEmptyEntity();

                                                $datak['article_id'] = $ligne3['article_idd'];
                                                $datak['qte'] = $ligne3['qte3comp'];
                                                $datak['ligneligneligneordrefab_id'] = $idligliglig;

                                                $ligneligneligneligneordrefab = $this->fetchTable('Ligneligneligneligneordrefabs')->patchEntity($ligneligneligneligneordrefab, $datak);
                                                // dd($ligneligneligneligneordrefab);
                                                $this->fetchTable('Ligneligneligneligneordrefabs')->save($ligneligneligneligneordrefab);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }





                $this->Flash->success(__('ordre fabrication ajoutÃƒÂ©'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $depots = $this->Ordrefabrications->Depots->find('list', ['limit' => 200])->all();
        $pointdeventes = $this->Ordrefabrications->Pointdeventes->find('list', ['limit' => 200])->all();





        $cond = 'Articles.famille_id = 1 ';
        $articles = $this->fetchTable('Articles')->find('all')->where([$cond]);
        //debug($articles);die;
        $cond1 = 'Articles.famille_id = 2 ';
        $matieres = $this->fetchTable('Articles')->find('all')->where([$cond1]);

        $this->set(compact('ordrefabrication', 'depots', 'pointdeventes', 'articles', 'mm', 'matieres'));
    }






    public function getDepot($id = null)
    {

        $id = $this->request->getQuery('id');

        $query = $this->fetchTable('Depots')->find();
        $query->where(['pointdevente_id' => $id]);

        $select = "
   
    <select name='import' id='import-id' class='form-control select2'  '>
                <option >Veuillez choisir !!</option>";
        foreach ($query as $q) {
            $select =  $select . "  <option value ='" . $q['id'] . "'";
            $select =  $select . " >" . $q['name'] . "</option>";
        }
        $select = $select . "</select> </div> </div> ";
        echo json_encode(array('select' => $select));
        die;
    }
  
    //public function getOrdfab($id = null)
   // {
       // $article_id = $this->request->getQuery('article_id');
       // $id = $this->request->getQuery('id');

        //$article_idm = $this->request->getQuery('article_idm');
       // $idl = $this->request->getQuery('idl');

        //$article_idt = $this->request->getQuery('article_idt');
       // $idll = $this->request->getQuery('idll');

       //$article_idd = $this->request->getQuery('article_idd');
       // $idlll = $this->request->getQuery('idlll');
        //debug($id);die;
       // $this->loadModel('Ligneligneordrefabs');
       // $this->loadModel('Ligneordrefabrications');
       // $ss=$this->fetchTable('Ligneordrefabrications')->find('all')->where(['Ligneordrefabrications.ordrefabrication_id= '.$id])->where(['Ligneordrefabrications.article_id = '.$article_id]);
          // foreach ($ss as $c => $v) {
           //  debug($v);die;
          
       // $v->article_id;
        // debug('$v');
       // $sa = $this->fetchTable('Ligneligneordrefabs')->find('all')->where(['Ligneligneordrefabs.ligneordrefabrications_id= '.$id])->where(['Ligneligneordrefabs.article_id ='.$article_idm]);
             // foreach ($sa as $y => $f) {
           // debug($f);die;
        //$saf = $this->fetchTable('Ligneligneligneordrefabs')->find('all')->where(['Ligneligneligneordrefabs.ligneligneordrefab_id ='.$idll])->where(['Ligneligneligneordrefabs.article_id ='.$article_idt]);        
               // foreach ($saf as $e => $t) {
                 //debug($t);die;
            
       // $gf = $this->fetchTable('Ligneligneligneligneordrefabs')->find('all')->where(['Ligneligneligneligneordrefabs.ligneligneligneordrefab_id ='.$idlll])->where(['Ligneligneligneligneordrefabs.article_id ='.$article_idd]);   
                //   foreach ($gf as $u => $bb) {
                    # code...
                                             // }
             
                                         //  }
                                      //  }
                                   // }
        //$query = $this->fetchTable('Ligneligneordrefabs')->find('all')->where(['Ligneligneordrefabs.article_id' => $id])->first();

        //debug($query);die;
        
   // }

    public function getArticle()
    {

        $id = $this->request->getQuery('idart');


        $ligne = $this->fetchTable('Articles')->get($id);

        echo (json_encode($ligne));

        die;
    }


    public function getFiche($id = null)
    {
        $id = $this->request->getQuery('id');
        $s = $this->request->getQuery('index');
        //debug($index);
        //die;
       
        
        $this->loadModel('Articles');
        $articlesss = $this->fetchTable('Articles')->find()->select(['id', 'Dsignation', 'Code'])->where(['Articles.famille_id=2']);

        foreach ($articlesss as $i => $a) {
            // debug($a->id.' '.$a->Dsignation);
            $articles[$a->id] = $a->Code . ' ' . $a->Dsignation;
        }


        $fichearticles = $this->fetchTable('Fichearticles')->find('all',[
            'contain' => ['Articles'],
        ])
            ->where(['Fichearticles.article_id=' . $id])->group(['Fichearticles.article_id1'])->order(['Fichearticles.id' => 'ASC']);
         //debug($fichearticles->toArray());die;
        if (!empty($fichearticles)) {
            foreach ($fichearticles as $i => $fiche) {

                $article1 = $this->fetchTable('Articles')->get($fiche['article_id1']);

                $dat[$i]['id'] = $fiche['id'];
                $dat[$i]['article_id'] = $fiche['article_id1'];
                $dat[$i]['article1'] = $article1['Dsignation'];
                $dat[$i]['qte'] = $fiche['qte'];
                $fichearticles1 = $this->fetchTable('Fichearticles')->find('all',[
                    'contain' => ['Articles'],
                ])
                    ->where(['Fichearticles.article_id=' . $id, 'Fichearticles.article_id1=' . $fiche['article_id1'], 'Fichearticles.id!=' . $fiche['id']])->group(['Fichearticles.article_id1', 'Fichearticles.article_id2']);
                // debug($fichearticles1);//die;
                foreach ($fichearticles1 as $j => $fiche1) {

                    $article2 = $this->fetchTable('Articles')->get($fiche1['article_id2']);

                    $dat[$i]['Ligne'][$j]['id'] = $fiche1['id'];
                    $dat[$i]['Ligne'][$j]['article_id'] = $fiche1['article_id2'];
                    $dat[$i]['Ligne'][$j]['article2'] = $article2['Dsignation'];
                    $dat[$i]['Ligne'][$j]['qte'] = $fiche1['qte'];
                     /// dd($dat);
                    $fichearticles2 = $this->fetchTable('Fichearticles')->find('all',[
                        'contain' => ['Articles'],
                    ])
                        ->where(['Fichearticles.article_id=' . $id, 'Fichearticles.article_id1=' . $fiche1['article_id1'], 'Fichearticles.article_id2=' . $fiche1['article_id2'], 'Fichearticles.id!=' . $fiche1['id']])->group(['Fichearticles.article_id1', 'Fichearticles.article_id2', 'Fichearticles.article_id3']);
                    // debug($fichearticles2);//die;

                    foreach ($fichearticles2 as $k => $fiche2) {
                        $article3 = $this->fetchTable('Articles')->get($fiche2['article_id3']);

                        $dat[$i]['Ligne'][$j]['ligneligne'][$k]['id'] = $fiche2['id'];
                        $dat[$i]['Ligne'][$j]['ligneligne'][$k]['article_id'] = $fiche2['article_id3'];
                        $dat[$i]['Ligne'][$j]['ligneligne'][$k]['article3'] = $article3['Dsignation'];
                        $dat[$i]['Ligne'][$j]['ligneligne'][$k]['qte'] = $fiche2['qte'];
                    }
                }
            }



            // $cond1 = 'Articles.famille_id = 2 ';
            // $matieres = $this->fetchTable('Articles')->find('all')->where([$cond1]);
            // debug($matieres->toArray());

            // style='display:none;'
            $cond = 'Articles.famille_id = 1 ';
            $articles = $this->fetchTable('Articles')->find('all')->where([$cond]);
   
                $res = "<table>
                <thead></thead>";

                foreach ($dat as  $fech) {
                  ///  debug($fech);

                $res =  $res . "<tbody>";


                $res =  $res . "<tr bgcolor='#EDEDED'>
                    <td align='center' style='width: 25%;'><strong>Composant 1</strong></td>
                    <td align='center' style='width: 80%;'><strong>Quantité </strong></td>
                     
                    </tr>";


                $res =  $res . "<tr bgcolor='#EDEDED'>";
                $res = $res . "<td align='left'><input type='hidden'  readonly  value='" . $fech['article_id'] . "'  name='data[ligner][" . $s . "][Ofsfligne][" . $i . "][article_idm]' index=" . $s . " indexx=" . $i . "   id='article_idm$s-$i' champ='article_idm' table='Ofsfligne' class='form-control select2 calculqte'  >
                <input   readonly  value='" . $fech['article1'] . "'  name='data[ligner][" . $s . "][Ofsfligne][" . $i . "][article_idm]' index=" . $s . " indexx=" . $i . "   id='article_idm$s-$i' champ='article_idm' table='Ofsfligne' class='form-control select2 calculqte'  ></td>";


                $res = $res . "<td align='center''><input   readonly  value='" . $fech['qte'] . "'  name='data[ligner][" . $s . "][Ofsfligne][" . $i . "][qte1comp]' index=" . $s . " indexx=" . $i . "   id='qte1comp$s-$i' champ='qte1comp' table='Ofsfligne' class='form-control calculqte'  > </td>";




                $res = $res . "</tr>";
                $res =  $res . "<tr index='" . $i . "'   align='centre'>";
                $res = $res . "<td  champ='afef' class='afef' width='30%'></td>";

                $res = $res . "<td  id='" . $i . "' colspan='2' indexx='" . $i . "'>";



                $res = $res . " <table  id='addtableaa" . $i . "' style='width:100%' align='center'>
                                                                <thead>
                                                                    <tr  bgcolor='#EDEDED'>
                                                                        <td align='center'>Composant2</td>
                                                                        <td align='center'>Quantité</td>

                                                                        
                                                                    </tr></thead>";


                foreach ($fech['Ligne'] as $j => $fech1) {

                    $res =  $res . "<tbody><tr>";

                    $res = $res . "<td align='center' ><input type='hidden'  readonly  value='" . $fech1['article_id'] . "'  name='data[ligner][" . $s . "][Ofsfligne][" . $i . "][Phaseofsf][" . $j . "][article_idt]' index=" . $s . " indexx=" . $i . " indexligne=" . $j . "   champ='article_idt' table='Ofsfligne' tableligne='Phaseofsf'  class='form-control select2 calculqte' id='article_idt$s-$i-$j'  >
                    <input   readonly  value='" . $fech1['article2'] . "'  name='data[ligner][" . $s . "][Ofsfligne][" . $i . "][Phaseofsf][" . $j . "][article_idt]' index=" . $s . " indexx=" . $i . " indexligne=" . $j . "   champ='article_idt' table='Ofsfligne' tableligne='Phaseofsf'  class='form-control select2 calculqte' id='article_idt$s-$i-$j'  ></td>";
                    $res = $res . "<td align='center' ><input   readonly  value='" . $fech1['qte'] . "'  name='data[ligner][" . $s . "][Ofsfligne][" . $i . "][Phaseofsf][" . $j . "][qte2comp]' index=" . $s . " indexx=" . $i . " indexligne=" . $j . "   champ='qte2comp' table='Ofsfligne' tableligne='Phaseofsf'  class='form-control select2 calculqte' id= 'qte2comp$s-$i-$j' ></td>";


                    $res =  $res . "</tr>";
                    $res =  $res . "<tr id='traaligne" . $i . "-" . $j . "' champ='traaligne'>";
                    $res =  $res . "<td width='30%'></td>";
                    $res =  $res . "<td id='afefligne" . $i . "-" . $j . "' champ='afefligne' class='afefligne" . $i . "-" . $j . "'  colspan='3' id='afefligne" . $i . "-" . $j . "' indexx='" . $i . "'>";

                    $res = $res . "<table  indexx='" . $i . "' indexligneligne='" . $j . "' champ='addtableaaligne' id='addtableaaligne" . $i . "-" . $j . "' style='width:100%' align='center'>
                                                                                            <thead>
                                                                                                <tr bgcolor='#EDEDED'>
                                                                                                    <td align='center'>Composant3</td>
                                                                                                    <td align='center'>Quantité</td>
                                                                                                    
                                                                                                </tr>
                                                                                            </thead>";

                    foreach ($fech1['ligneligne'] as $k => $fech2) {

                        $res =  $res . "<tbody><tr>";

                        $res = $res . "<td align='center' ><input   readonly  value='" . $fech2['article_id'] . "'  name='data[ligner][" . $s . "][Ofsfligne][" . $i . "][Phaseofsf][" . $j . "][Phaseofsfligne][" . $k . "][article_idd]'  index=" . $s . " indexx=" . $i . " indexligne=" . $j . "  indexligneligne=" . $k . " champ='article_idd' table='Ofsfligne' tableligne='Phaseofsf'  tableligneligne= 'Phaseofsfligne' class='form-control calculqte select2' id= 'article_idd$s-$i-$j-$k'  ></td>";
                        $res = $res . "<td align='center' ><input   readonly  value='" . $fech2['qte'] . "'  name='data[ligner][" . $s . "][Ofsfligne][" . $i . "][Phaseofsf][" . $j . "][Phaseofsfligne][" . $k . "][qte3comp]' index=" . $s . " indexx=" . $i . " indexligne=" . $j . "  indexligneligne=" . $k . " champ='qte3comp' table='Ofsfligne' tableligne='Phaseofsf'  tableligneligne= 'Phaseofsfligne' class='form-control calculqte'  id= 'qte3comp$s-$i-$j-$k'   ></td>";


                        $res = $res . "</tr>";
                    }
                    $res = $res . "<input type='hidden' value='" . $k . "' class='' id='indexligneligne" . $s . "-" . $i . "-" . $j . "-" . $k . "' champ='indexligneligne' />";
                    $res = $res . "</tbody></table>";
                    $res = $res . "</td>";
                    $res = $res . "</tr>";
                }
                $res = $res . "<input type='hidden' value='" . $j . "' id='indexligne" . $s . "-" . $i . "-" . $j . "' />";





                $res = $res . "</tbody></table>";
                $res = $res . "</td>";
                $res = $res . "</tr>";
            }
        }
        $res = $res . "<input type='hidden' value='" . $i . "' id='indexx" . $s . "-" . $i . "' />";
        //}
        $res = $res . "<input table='ligner' type='hidden' value='" . $s . "' id='index" . $s . "' champ='index'/>";

        //$s++;

        $res = $res . "</tr></tbody></table>";

        echo json_encode(array('res' => $res));

        exit;
        //die;
        //$this->set(compact('query'));
        /* foreach ($query as $q) {
            json_encode($q);
            debug($q);
        }
     */
    }


    public function getQteval($id = null)
    {
        $id = $this->request->getQuery('id');
        $this->loadModel('Fichearticles');
        $idart = $this->fetchTable('Fichearticles')->find('all')
            ->where(['Fichearticles.article_id=' . $id])->last();
        //debug($idart);die;
        $article1 = $idart->article_id1;
        $qte1 = $this->fetchtable('Fichearticles')->find('all')
            ->where(['Fichearticles.article_id=' . $id])->where(['Fichearticles.article_id1=' . $article1])->first();
        //debug($qte1);die;
        $q1 = $qte1->qte;
        $article2 = $idart->article_id2;
        $qte2 = $this->fetchTable('Fichearticles')->find('all')
            ->where(['Fichearticles.article_id=' . $id])
            ->where(['Fichearticles.article_id1=' . $article1])
            ->where(['Fichearticles.article_id2=' . $article2])->first();
        $q2 = $qte2->qte;
        $article3 = $idart->article_id3;
        $qte3 = $this->fetchTable('Fichearticles')->find('all')
            ->where(['Fichearticles.article_id=' . $id])
            ->where(['Fichearticles.article_id1=' . $article1])
            ->where(['Fichearticles.article_id2=' . $article2])
            ->where(['Fichearticles.article_id3=' . $article3])->first();
        $q3 = $qte3->qte;
        echo json_encode(array('qte1' => $q1, 'qte2' => $q2, 'qte3' => $q3));
        die;
    }





    /**
     * Edit method
     *
     * @param string|null $id Ordrefabrication id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $ordrefabrications = $this->Ordrefabrications->get($id, [
            'contain' => [],
        ]);

        $this->loadModel('Ligneordrefabrications');
        $ordrefabrication = $this->Ordrefabrications->newEmptyEntity();
        if ($this->request->is(['patch', 'post', 'put'])) { //debug($this->request->getData());die;
            $ordrefabrication = $this->Ordrefabrications->patchEntity($ordrefabrication, $this->request->getData());
            if ($this->Ordrefabrications->save($ordrefabrication)) {


                $ligneexiste = $this->fetchTable('Ligneordrefabrications')->find('all')->where('Ligneordrefabrications.ordrefabrication_id =' . $id);
                //dd($ligneexiste);
                foreach ($ligneexiste as $ligne) {
                    // dd($ligne);
                    $this->Ligneordrefabrications->delete($ligne);
                    // dd($ligne);
                }
                $ordrefabrication_id = $ordrefabrication->id;

                //dd($ordrefabrication_id);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {

                    foreach ($this->request->getData('data')['ligner'] as $s => $ligne) {
                        //dd($s); 
                        //debug($this->request->getData('data')['ligner'][$s]['article_id']);                
                        //debug($this->request->getData('data')['ligner']);die;
                        $ligneordrefabrication = $this->fetchTable('Ligneordrefabrications')->newEmptyEntity();
                        //dd($ligneordrefabrication);
                        $dataa['article_id'] = $ligne['article_id'];

                        $dataa['quantite'] = $ligne['qte'];
                        $dataa['ordrefabrication_id']  = $ordrefabrication_id;
                        //dd($dataa);
                        $ligneordrefabrication = $this->fetchTable('Ligneordrefabrications')->patchEntity($ligneordrefabrication, $dataa);
                        //dd($ligneordrefabrication);
                        //dd($dataa);
                        $this->fetchTable('Ligneordrefabrications')->save($ligneordrefabrication);





                        // dd($ligneordrefabrication);
                        $idligne = $ligneordrefabrication->id;
                        if (isset($this->request->getData('data')['ligner'][$s]['Ofsfligne']) && (!empty($this->request->getData('data')['ligner'][$s]['Ofsfligne']))) {
                            foreach ($this->request->getData('data')['ligner'][$s]['Ofsfligne'] as $i => $ligne1) {
                                $ligneligneordrefab = $this->fetchTable('Ligneligneordrefabs')->newEmptyEntity();
                                //dd($ligneligneordrefab);
                                $data['article_id'] = $ligne1['article_idm'];
                                $data['qte'] = $ligne1['qte1comp'];
                                $data['ligneordrefabrications_id'] = $idligne;
                                //dd($data);
                                $ligneligneordrefab = $this->fetchTable('Ligneligneordrefabs')->patchEntity($ligneligneordrefab, $data);
                                //debug($ligneligneordrefab);die;
                                $this->fetchTable('Ligneligneordrefabs')->save($ligneligneordrefab);
                                //dd($ligneligneordrefab);
                                $idddd = $ligneligneordrefab->id;
                                //dd($idddd);
                                if (isset($this->request->getData('data')['ligner'][$s]['Ofsfligne'][$i]['Phaseofsf']) && (!empty($this->request->getData('data')['ligner'][$s]['Ofsfligne'][$i]['Phaseofsf']))) {

                                    foreach ($this->request->getData('data')['ligner'][$s]['Ofsfligne'][$i]['Phaseofsf'] as $j => $ligne2) {
                                        // debug($ligne2);die;
                                        $ligneligneligneordrefab = $this->fetchTable('Ligneligneligneordrefabs')->newEmptyEntity();

                                        $datal['article_id'] = $ligne2['article_idt'];
                                        $datal['qte'] = $ligne2['qte2comp'];
                                        $datal['ligneligneordrefab_id'] = $idddd;
                                        $ligneligneligneordrefab = $this->fetchTable('Ligneligneligneordrefabs')->patchEntity($ligneligneligneordrefab, $datal);
                                        //dd($ligneligneligneordrefab);
                                        $this->fetchTable('Ligneligneligneordrefabs')->save($ligneligneligneordrefab);
                                        //dd($ligneligneligneordrefab);
                                        $safa = $ligneligneligneordrefab->id;
                                        if (isset($this->request->getData('data')['ligner'][$s]['Ofsfligne'][$i]['Phaseofsf'][$j]['Phaseofsfligne']) && (!empty($this->request->getData('data')['ligner'][$s]['Ofsfligne'][$i]['Phaseofsf'][$j]['Phaseofsfligne']))) {

                                            foreach ($this->request->getData('data')['ligner'][$s]['Ofsfligne'][$i]['Phaseofsf'][$j]['Phaseofsfligne'] as $k => $ligne3) {
                                                //debug($ligne3);die;
                                                $ligneligneligneligneordrefab = $this->fetchTable('Ligneligneligneligneordrefabs')->newEmptyEntity();

                                                $datak['article_id'] = $ligne3['article_idd'];
                                                $datak['qte'] = $ligne3['qte3comp'];
                                                $datak['ligneligneligneordrefab_id'] = $safa;

                                                $ligneligneligneligneordrefab = $this->fetchTable('Ligneligneligneligneordrefabs')->patchEntity($ligneligneligneligneordrefab, $datak);
                                                // dd($ligneligneligneligneordrefab);
                                                $this->fetchTable('Ligneligneligneligneordrefabs')->save($ligneligneligneligneordrefab);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }


                return $this->redirect(['action' => 'index']);
            }
        }


        $cond = 'Articles.famille_id = 1 ';
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])->where([$cond]);
        //debug($articles);die;
        $cond1 = 'Articles.famille_id = 2 ';
        $matieres = $this->fetchTable('Articles')->find('all')->where([$cond1]);

        $depots = $this->Ordrefabrications->Depots->find('list', ['limit' => 200])->all();
        $pointdeventes = $this->Ordrefabrications->Pointdeventes->find('list', ['limit' => 200])->all();
        $this->loadModel('ligneordrefabrications');
        $lignes = $this->fetchTable('Ligneordrefabrications')->find('all', [
            'contain' => ['Articles']
        ])->where(['Ligneordrefabrications.ordrefabrication_id  = (' . $id . ')']);

        $this->loadModel('Ligneligneordrefabs');
        $this->loadModel('Ligneligneligneordrefabs');
        $this->loadModel('Ligneligneligneligneordrefabs');
        foreach ($lignes as $k => $lign) {
            //dd($lign);
            $ligneligneordrefab = $this->fetchTable('Ligneligneordrefabs')->find('all', [
                'contain' => ['Articles']
            ])->where('Ligneligneordrefabs.ligneordrefabrications_id =' . $lign->id);
            //dd($ligneligneordrefab->toArray());
         
            foreach ($ligneligneordrefab as $o => $lisss) {
                //dd($lisss->qte);
                $qtesaf=$lisss->qte;
                $ligneligneordrefab = $this->fetchTable('Ligneligneligneordrefabs')->find('all', [
                    'contain' => ['Articles']
                ])->where('Ligneligneligneordrefabs.ligneligneordrefab_id =' . $lisss->id);

                foreach ($ligneligneordrefab as $sss => $safaff) {

                    $ligneligneligneordrefabsafa = $this->fetchTable('Ligneligneligneligneordrefabs')->find('all')
                        ->where('Ligneligneligneligneordrefabs.ligneligneligneordrefab_id =' . $safaff->id);
                }
                // dd($ligneligneligneordrefab->toarray());

            }
        }


        $ligneligneligneordrefab = $this->fetchTable('Ligneligneligneordrefabs')->find();
        //dd($lignes->toarray());
        $this->set(compact('ordrefabrications', 'depots', 'pointdeventes','qtesaf', 'articles', 'matieres', 'ligneligneordrefab', 'ligneligneordrefab', 'ligneligneligneordrefabsafa', 'lignes'));
    }





    /**
     * Delete method
     *
     * @param string|null $id Ordrefabrication id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ordrefabrication = $this->Ordrefabrications->get($id);
        if ($this->Ordrefabrications->delete($ordrefabrication)) {
            $this->Flash->success(__('The ordrefabrication has been deleted.'));
        } else {
            $this->Flash->error(__('The ordrefabrication could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function imprime($id = null) {

        
        $ordrefabrication = $this->Ordrefabrications->get($id, [
            'contain' => ['Depots', 'Pointdeventes'],
        ]);
        //debug('$ordrefabrication');die;

        $this->loadModel('ligneordrefabrications');
    $lgord = $this->fetchTable('Ligneordrefabrications')->find('all', [
        'contain' => ['Articles']
    ])->where(['Ligneordrefabrications.ordrefabrication_id  = (' . $id . ')']);

    $this->loadModel('ligneligneordrefabs');
    $this->loadModel('ligneligneligneordrefabs');
    $this->loadModel('ligneligneligneligneordrefabs');
    foreach ($lgord as $k => $lign) {
        $lglgord = $this->fetchTable('Ligneligneordrefabs')->find('all', [
            'contain' => ['Articles']
        ])->where('Ligneligneordrefabs.ligneordrefabrications_id =' . $lign->id);
        foreach ($lglgord as $o => $lisss) {
            $lglgord = $this->fetchTable('Ligneligneligneordrefabs')->find('all', [
                'contain' => ['Articles']
            ])->where('Ligneligneligneordrefabs.ligneligneordrefab_id =' . $lisss->id);

            foreach ($lglgord as $sss => $safaff) {

                $ligneligneligneordrefab = $this->fetchTable('Ligneligneligneligneordrefabs')->find('all')
                    ->where('Ligneligneligneligneordrefabs.ligneligneligneordrefab_id =' . $safaff->id);
            }
            // dd($ligneligneligneordrefab->toarray());

        }
    }
    $pointdeventes = $this->Ordrefabrications->Pointdeventes->find('list', ['limit' => 200]);
    $depots = $this->Ordrefabrications->Depots->find('list', ['limit' => 200]);

    $ligneligneligneordrefab = $this->fetchTable('Ligneligneligneordrefabs')->find();
    //dd($lignes->toarray());
    $this->set(compact('ordrefabrication', 'depots', 'pointdeventes', 'lglgord', 'lglgord', 'ligneligneligneordrefab', 'lgord'));
}
 
    
 
}



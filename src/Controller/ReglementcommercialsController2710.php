<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Reglementcommercials Controller
 *
 * @property \App\Model\Table\ReglementcommercialsTable $Reglementcommercials
 * @method \App\Model\Entity\Reglementcommercial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReglementcommercialsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Commercials', 'Paiements'],
        ];
        $cond2 = '';
        $cond1 = '';
        $cond3 = '';
        $numero = $this->request->getQuery('numero');
        $commercial = $this->request->getQuery('commercial_id');
      $date = $this->request->getQuery('date');

        if ($numero) {
            $cond1 = "Reglementcommercials.numero  like'%" . $numero . "%'";
        }
        if ($commercial) {
            $cond2 = "Reglementcommercials.commercial_id like'%" . $commercial . "%'";
        }

        if ($date) {
            $cond3 = "Reglementcommercials.date like'%" . $date . "%'";
        }

        $query = $this->Reglementcommercials->find('all')->where([$cond1, $cond2,$cond3]);
        $reglementcommercials = $this->paginate($query);

        $commercials = $this->Reglementcommercials->Commercials->find('list', ['limit' => 200])->all();

        $this->set(compact('reglementcommercials', 'commercials'));
    }

    /**
     * View method
     *
     * @param string|null $id Reglementcommercial id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {


   $this->loadModel('Lignereglementcommercials');
        $reglementcommercial = $this->Reglementcommercials->get($id, [
            'contain' => [],
        ]);
        //  $commercial_id=$reglementcommercial->id; debug($reglementcommercial->commercial_id);die;
        $k = 0;
        $o = 0;
        $p = 0;
        $m = 0;
        $dat = array();
        $data = array();
        $liv = $this->fetchTable('Bonlivraisons')->find('all', ['contain' => ['Clients']])->where(['Bonlivraisons.commercial_id  ="' . $reglementcommercial->commercial_id . '"']);
        $bonus = $this->fetchTable('Bonusmaluscommercials')->find('all')->where(['Bonusmaluscommercials.commercial_id  ="' . $reglementcommercial->commercial_id . '"']);
//     debug($lignreglement);die;
  $ligneee=$this->fetchTable('Lignereglementcommercials')->find('all')->where(['Lignereglementcommercials.reglementcommercial_id ='.$id]);
//  debug($ligneee);
    $condbon='';
     $condliv='';
  $listlivv='0';
       $listbonn='0';
  foreach ($ligneee as  $t)
            {
//              debug($t)  ;// die;
        
                if ($t['lignebonlivraison_id'] !=0)
                { 
                 $listlivv=$listlivv.','.$t['lignebonlivraison_id'];
               
                }
//                debug($condliv)  ; //die;
               if ($t['lignebonusmalu_id'] !=0)
                {
                  $listbonn=$listbonn.','.$t['lignebonusmalu_id'];
                
                }
                
//debug($condbon);
           // die;
 
                
                
                
//            $this->Reglementcommercials->save($reglementcommercial);
       
            }
               $condliv = 'Lignebonlivraisons.id in (' . $listlivv . ')';
                  $condbon = 'Lignebonusmalus.id in (' . $listbonn . ')';
          //  die;
        $list = 0;
        foreach ($liv as $p => $livv) {
            $list = $list . ',' . $livv['id'];
        }


        $list2 = 0;
        foreach ($bonus as $o => $bonus) {
            $list2 = $list2 . ',' . $bonus['id'];
        }
        $cond3 = 'Lignebonusmalus.bonusmaluscommercial_id   in (' . $list2 . ')';
        $cond4 = 'Lignebonusmalus.montant >0';
        $cond5 = 'Lignebonusmalus.paye=0 or '.$condbon;

        $lignebonus = $this->fetchTable('Lignebonusmalus')->find('all')
                ->where([$cond3, $cond4, $cond5]);
//debug($lignebonus);//die;
//        $cond1 = '';
//        $cond2 = '';
        $cond1 = 'Lignebonlivraisons.bonlivraison_id   in (' . $list . ')';
        $cond2 = 'Lignebonlivraisons.commission  ="FALSE" or '.$condliv;
        $lignelivraison = $this->fetchTable('Lignebonlivraisons')->find('all')
                ->where([$cond1, $cond2]);
        $s = 0;
        $restbonus = 0;

        foreach ($lignebonus as $m => $ligne) {
            $lignreglementbonus = $this->fetchTable('Lignereglementcommercials')->find()->select(["num" => 'Lignereglementcommercials.montant'])
                    ->where(['Lignereglementcommercials.reglementcommercial_id=' . $id])
                    ->where(['Lignereglementcommercials.lignebonusmalu_id=' . $ligne->id])
                    ->first();
            $s = $lignreglementbonus['num'];
            $bonu = $this->fetchTable('Bonusmaluscommercials')->find('all')->where(['Bonusmaluscommercials.id  ="' . $ligne['bonusmaluscommercial_id'] . '"']);

            foreach ($bonu as $o => $bo) {
                $numero = $bo['numero'];
                $dateop = $bo['dateoperation'];
            }
            $rest = $ligne['montant'] - $ligne['montantregle'] + $lignreglementbonus['num'];

            $data[$m]['id'] = $ligne['id'];
            $data[$m]['dateoperation'] = $dateop;
            $data[$m]['numero'] = $numero;
            $data[$m]['montat'] = $ligne['montant'];
            $data[$m]['montantentrebonus'] = $s;
            $data[$m]['montantregle'] = $ligne['montantregle'] - $lignreglementbonus['num'];
            $data[$m]['reste'] = $rest;
        }
        $rest = 0;
        $r = 0;
        foreach ($lignelivraison as $k => $ligne) {//debug($ligne->id);// debug( $ligne->id);
            $lignreglement = $this->fetchTable('Lignereglementcommercials')->find()->select(["num" => 'Lignereglementcommercials.montant'])
                    ->where(['Lignereglementcommercials.reglementcommercial_id=' . $id])
                    ->where(['Lignereglementcommercials.lignebonlivraison_id=' . $ligne->id])
                    ->first(); 
                 //  debug($lignreglement);
            $r = $lignreglement['num'];//debug($r);die;
//debug($r);
            $li = $this->fetchTable('Bonlivraisons')->find('all', ['contain' => ['Clients']])->where(['Bonlivraisons.id  ="' . $ligne['bonlivraison_id'] . '"']);
            foreach ($li as $o => $livv) {
                $idbl = $livv['numero'];
                $bldate = $livv['date'];
                $clientbl = $livv->client->Raison_Sociale;
            }
            $rest = $ligne['montantcommission'] - $ligne['montantregle'] + $lignreglement['num'];
            $dat[$k]['id'] = $ligne['id'];
            $dat[$k]['date'] = $bldate;
            $dat[$k]['numero'] = $idbl;
            $dat[$k]['client_id'] = $clientbl;
            $dat[$k]['montat'] = $ligne['montantcommission'];
            $dat[$k]['montantregle'] = $ligne['montantregle'] - $lignreglement['num'];
            $dat[$k]['montantentre'] = $r;
            $dat[$k]['reste'] = $rest;
        }



//                                    debug($dat['montantentre']);



        if ($this->request->is(['patch', 'post', 'put'])) {
                   // debug($this->request->getData());die;
            $ligne=$this->fetchTable('Lignereglementcommercials')->find('all')->where(['Lignereglementcommercials.reglementcommercial_id ='.$id]);

             foreach ($ligne as  $t)
            {
                 
                 $mnt=$t['montant'];//debug($mnt);
                if ($t['lignebonlivraison_id'] !=0)
                { 
                    
                     $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($t['lignebonlivraison_id']);
                     //if($lignebonlivraison->montantregle ==$mnt )
                     $lignebonlivraison->montantregle= $lignebonlivraison->montantregle-$mnt;
                     
                     $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison); 
                }
               if ($t['lignebonusmalu_id'] !=0)
                {
                    $lignebonusmalus = $this->fetchTable('Lignebonusmalus')->get($t['lignebonusmalu_id']);
                   $lignebonusmalus->montantregle= $lignebonusmalus->montantregle-$mnt;
                   
                   //debug($lignebonusmalus->montantregle);die;
                   // $reglementcommercial['montantpaye']=$reglementcommercial['montantpaye']-$t['montant'];
                        $this->fetchTable('Lignebonusmalus')->save($lignebonusmalus);
                }
                

           // die;
 
                
                
                
//            $this->Reglementcommercials->save($reglementcommercial);
            $this->fetchTable('Lignereglementcommercials')->delete($t); 
            }
     // die;
            
            
          
             
           $reglementcommercial = $this->Reglementcommercials->patchEntity($reglementcommercial, $this->request->getData());
       //   debug($reglementcommercial);//die;
           if ($this->Reglementcommercials->save($reglementcommercial)) {
               // debug($reglementcommercial);die;
                $id_reg = $reglementcommercial->id;
           $li = array();
                if (!empty($this->request->getData('data')['reglement'])) {
                    foreach ($this->request->getData('data')['reglement']as $j => $l) {
                        $lignereglementcommercial = $this->Lignereglementcommercials->newEmptyEntity();
                        if ($l['montantentre'] > 0 && array_key_exists('lignelivraison_id', $l)) {
                          
                          // $li['lignebonusmalu_id'] = 0;
                            $li['reglementcommercial_id'] = $id_reg;
                            $li['lignebonlivraison_id'] = $l['lignelivraison_id'];
                            $li['montant'] = $l['montantentre'];

                            $lignereglementcommercial = $this->Lignereglementcommercials->patchEntity($lignereglementcommercial, $li);
                      
                            $this->Lignereglementcommercials->save($lignereglementcommercial);     //  debug($lignereglementcommercial);die;
                            $lignelivraison = $this->fetchTable('Lignebonlivraisons')->find('all')->where(['Lignebonlivraisons.id  ="' . $l['lignelivraison_id'] . '"']);
                            $lignelivraison = $this->fetchTable('Lignebonlivraisons')->get($l['lignelivraison_id']);
                            $lignelivraison->montantregle = $lignelivraison->montantregle + $l['montantentre'];
                            $this->fetchTable('Lignebonlivraisons')->save($lignelivraison);
                            if ($l['montantentre'] == $l['reste']) {
                                $lignelivraison->commission = 'TRUE';
                                $this->fetchTable('Lignebonlivraisons')->save($lignelivraison);
                            }
                        }
                    }
                }
//debug($this->request->getData('data')['bonusreglement']);die;
                $li = array();
           if (!empty($this->request->getData('data')['bonusreglement']))
                { 
                    foreach ($this->request->getData('data')['bonusreglement']as $j => $li) {
    $lignereglementcommercial = $this->Lignereglementcommercials->newEmptyEntity();
                        if ($li['montantentrebonus'] > 0 && array_key_exists('lignebonus_id', $li)) {

                            $li['reglementcommercial_id'] = $id_reg;
                            $li['lignebonusmalu_id'] = $li['lignebonus_id'];
//                            $li['lignelivraison_id'] = 0;
                            $li['montant'] = $li['montantentrebonus'];

                            $lignereglementcommercial = $this->Lignereglementcommercials->patchEntity($lignereglementcommercial, $li);
                           // debug($lignereglementcommercial);die;
                            $this->Lignereglementcommercials->save($lignereglementcommercial);
                          
                            $lignebonus = $this->fetchTable('Lignebonusmalus')->get($li['lignebonus_id']);
                            $lignebonus->montantregle = $lignebonus->montantregle + $li['montantentrebonus'];
                            $this->fetchTable('Lignebonusmalus')->save($lignebonus); //debug($lignebonus);
                            if ($li['montantentrebonus'] == $li['resteb']) {
                                $lignebonus->paye = 1;
                                $this->fetchTable('Lignebonusmalus')->save($lignebonus);
                            }
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }







        }

        
                 $banque=$this->fetchTable('Banques')->find('list',  ['limit' => 200],[ 'valueField' => 'name'])->all(); 
 
        $commercials = $this->Reglementcommercials->Commercials->find('list', ['limit' => 200])->all();
        $paiements = $this->Reglementcommercials->Paiements->find('list', ['limit' => 200])->all();
        $this->set(compact('reglementcommercial', 'commercials', 'paiements'));
        $this->set(compact('liv', 'paiements', 'lignelivraison', 'banque','dat', 'data', 'lignebonus', 'bonu'));
   
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() 
    {
        $this->loadModel('Lignereglementcommercials');
        $this->loadModel('Paiements');
        $this->loadModel('Lignebonlivraisons');
        $this->loadModel('Lignebonusmalus');
        $reglementcommercial = $this->Reglementcommercials->newEmptyEntity();
        if ($this->request->is('post')) {
           // debug($this->request->getData());//die;
                    $reglementcommercial['numero_cheque']=$this->request->getData('numero_cheque');


   

            $reglementcommercial = $this->Reglementcommercials->patchEntity($reglementcommercial, $this->request->getData());
            if ($this->Reglementcommercials->save($reglementcommercial)) {
 // debug($reglementcommercial);
                $id_reg = $reglementcommercial->id;
                $li = array();
                if (!empty($this->request->getData('data')['reglement'])) {
                    foreach ($this->request->getData('data')['reglement']as $j => $l) {
                        $lignereglementcommercial = $this->Lignereglementcommercials->newEmptyEntity();
                        if ($l['montantentre'] > 0 && array_key_exists('lignelivraison_id', $l)) {
                          
                          // $li['lignebonusmalu_id'] = 0;
                            $li['reglementcommercial_id'] = $id_reg;
                            $li['lignebonlivraison_id'] = $l['lignelivraison_id'];
                            $li['montant'] = $l['montantentre'];

                            $lignereglementcommercial = $this->Lignereglementcommercials->patchEntity($lignereglementcommercial, $li);
                      
                            $this->Lignereglementcommercials->save($lignereglementcommercial);     //  debug($lignereglementcommercial);die;
                            $lignelivraison = $this->Lignebonlivraisons->find('all')->where(['Lignebonlivraisons.id  ="' . $l['lignelivraison_id'] . '"']);
                            $lignelivraison = $this->Lignebonlivraisons->get($l['lignelivraison_id']);
                            $lignelivraison->montantregle = $lignelivraison->montantregle + $l['montantentre'];
                            $this->Lignebonlivraisons->save($lignelivraison);
                            if ($l['montantentre'] == $l['reste']) {
                                $lignelivraison->commission = 'TRUE';
                                $this->Lignebonlivraisons->save($lignelivraison);
                            }
                        }
                    }
                }
//debug($this->request->getData('data')['bonusreglement']);die;
                $li = array();
           if (!empty($this->request->getData('data')['bonusreglement']))
                { 
                    foreach ($this->request->getData('data')['bonusreglement']as $j => $li) {
    $lignereglementcommercial = $this->Lignereglementcommercials->newEmptyEntity();
                        if ($li['montantentrebonus'] > 0 && array_key_exists('lignebonus_id', $li)) {

                            $li['reglementcommercial_id'] = $id_reg;
                            $li['lignebonusmalu_id'] = $li['lignebonus_id'];
//                            $li['lignelivraison_id'] = 0;
                            $li['montant'] = $li['montantentrebonus'];

                            $lignereglementcommercial = $this->Lignereglementcommercials->patchEntity($lignereglementcommercial, $li);
                           // debug($lignereglementcommercial);die;
                            $this->Lignereglementcommercials->save($lignereglementcommercial);
                          
                            $lignebonus = $this->Lignebonusmalus->get($li['lignebonus_id']);
                            $lignebonus->montantregle = $lignebonus->montantregle + $li['montantentrebonus'];
                            $this->Lignebonusmalus->save($lignebonus); //debug($lignebonus);
                            if ($li['montantentrebonus'] == $li['resteb']) {
                                $lignebonus->paye = 1;
                                $this->Lignebonusmalus->save($lignebonus);
                            }
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
        }
        $num = $this->Reglementcommercials->find()->select(["num" =>
                    'MAX(Reglementcommercials.numero)'])->first();
        $numero = $num->num;
        //  DOF00001
        $n = 0;
        $n = $numero;
        if (!empty($n)) {

//debug($n);
            $x = $n + 1;
            $b = str_pad("$x", 5, '0', STR_PAD_LEFT);
        } else {
            $b = "00001";
        }
        //debug($b);
        $this->set(compact('b'));

//               $this->loadModel('Lignebonlivraisons');
//                  $this->loadModel('Bonlivraisons');
//                $liv = $this->Bonlivraisons->find('all')->where(['commercial_id  ="' . $id . '"']);
//                
//            
//        



        $banque=$this->fetchTable('Banques')->find('list',  ['limit' => 200],[ 'valueField' => 'name'])->all(); 
        $commercials = $this->Reglementcommercials->Commercials->find('list', ['limit' => 200])->all();
        $paiements = $this->Reglementcommercials->Paiements->find('list', ['limit' => 200])->all();
        $this->set(compact('reglementcommercial', 'banque','b', 'commercials', 'paiements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reglementcommercial id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->loadModel('Lignereglementcommercials');
        $reglementcommercial = $this->Reglementcommercials->get($id, [
            'contain' => [],
        ]);
        //  $commercial_id=$reglementcommercial->id; debug($reglementcommercial->commercial_id);die;
        $k = 0;
        $o = 0;
        $p = 0;
        $m = 0;
        $dat = array();
        $data = array();
        $liv = $this->fetchTable('Bonlivraisons')->find('all', ['contain' => ['Clients']])->where(['Bonlivraisons.commercial_id  ="' . $reglementcommercial->commercial_id . '"']);
        $bonus = $this->fetchTable('Bonusmaluscommercials')->find('all')->where(['Bonusmaluscommercials.commercial_id  ="' . $reglementcommercial->commercial_id . '"']);
//     debug($lignreglement);die;
  $ligneee=$this->fetchTable('Lignereglementcommercials')->find('all')->where(['Lignereglementcommercials.reglementcommercial_id ='.$id]);
//  debug($ligneee);
    $condbon='';
     $condliv='';
  $listlivv='0';
       $listbonn='0';
  foreach ($ligneee as  $t)
            {
//              debug($t)  ;// die;
        
                if ($t['lignebonlivraison_id'] !=0)
                { 
                 $listlivv=$listlivv.','.$t['lignebonlivraison_id'];
               
                }
//                debug($condliv)  ; //die;
               if ($t['lignebonusmalu_id'] !=0)
                {
                  $listbonn=$listbonn.','.$t['lignebonusmalu_id'];
                
                }
                
//debug($condbon);
           // die;
 
                
                
                
//            $this->Reglementcommercials->save($reglementcommercial);
       
            }
               $condliv = 'Lignebonlivraisons.id in (' . $listlivv . ')';
                  $condbon = 'Lignebonusmalus.id in (' . $listbonn . ')';
          //  die;
        $list = 0;
        foreach ($liv as $p => $livv) {
            $list = $list . ',' . $livv['id'];
        }


        $list2 = 0;
        foreach ($bonus as $o => $bonus) {
            $list2 = $list2 . ',' . $bonus['id'];
        }
        $cond3 = 'Lignebonusmalus.bonusmaluscommercial_id   in (' . $list2 . ')';
        $cond4 = 'Lignebonusmalus.montant >0';
        $cond5 = 'Lignebonusmalus.paye=0 or '.$condbon;

        $lignebonus = $this->fetchTable('Lignebonusmalus')->find('all')
                ->where([$cond3, $cond4, $cond5]);
//debug($lignebonus);//die;
//        $cond1 = '';
//        $cond2 = '';
        $cond1 = 'Lignebonlivraisons.bonlivraison_id   in (' . $list . ')';
        $cond2 = 'Lignebonlivraisons.commission  ="FALSE" or '.$condliv;
        $lignelivraison = $this->fetchTable('Lignebonlivraisons')->find('all')
                ->where([$cond1, $cond2]);
        $s = 0;
        $restbonus = 0;

        foreach ($lignebonus as $m => $ligne) {
            $lignreglementbonus = $this->fetchTable('Lignereglementcommercials')->find()->select(["num" => 'Lignereglementcommercials.montant'])
                    ->where(['Lignereglementcommercials.reglementcommercial_id=' . $id])
                    ->where(['Lignereglementcommercials.lignebonusmalu_id=' . $ligne->id])
                    ->first();
            $s = $lignreglementbonus['num'];
            $bonu = $this->fetchTable('Bonusmaluscommercials')->find('all')->where(['Bonusmaluscommercials.id  ="' . $ligne['bonusmaluscommercial_id'] . '"']);

            foreach ($bonu as $o => $bo) {
                $numero = $bo['numero'];
                $dateop = $bo['dateoperation'];
            }
            $rest = $ligne['montant'] - $ligne['montantregle'] + $lignreglementbonus['num'];

            $data[$m]['id'] = $ligne['id'];
            $data[$m]['dateoperation'] = $dateop;
            $data[$m]['numero'] = $numero;
            $data[$m]['montat'] = $ligne['montant'];
            $data[$m]['montantentrebonus'] = $s;
            $data[$m]['montantregle'] = $ligne['montantregle'] - $lignreglementbonus['num'];
            $data[$m]['reste'] = $rest;
        }
        $rest = 0;
        $r = 0;
        foreach ($lignelivraison as $k => $ligne) {//debug($ligne->id);// debug( $ligne->id);
            $lignreglement = $this->fetchTable('Lignereglementcommercials')->find()->select(["num" => 'Lignereglementcommercials.montant'])
                    ->where(['Lignereglementcommercials.reglementcommercial_id=' . $id])
                    ->where(['Lignereglementcommercials.lignebonlivraison_id=' . $ligne->id])
                    ->first(); 
                 //  debug($lignreglement);
            $r = $lignreglement['num'];//debug($r);die;
//debug($r);
            $li = $this->fetchTable('Bonlivraisons')->find('all', ['contain' => ['Clients']])->where(['Bonlivraisons.id  ="' . $ligne['bonlivraison_id'] . '"']);
            foreach ($li as $o => $livv) {
                $idbl = $livv['numero'];
                $bldate = $livv['date'];
                $clientbl = $livv->client->Raison_Sociale;
            }
            $rest = $ligne['montantcommission'] - $ligne['montantregle'] + $lignreglement['num'];
            $dat[$k]['id'] = $ligne['id'];
            $dat[$k]['date'] = $bldate;
            $dat[$k]['numero'] = $idbl;
            $dat[$k]['client_id'] = $clientbl;
            $dat[$k]['montat'] = $ligne['montantcommission'];
            $dat[$k]['montantregle'] = $ligne['montantregle'] - $lignreglement['num'];
            $dat[$k]['montantentre'] = $r;
            $dat[$k]['reste'] = $rest;
        }



//                                    debug($dat['montantentre']);



        if ($this->request->is(['patch', 'post', 'put'])) {
                   // debug($this->request->getData());die;
            $ligne=$this->fetchTable('Lignereglementcommercials')->find('all')->where(['Lignereglementcommercials.reglementcommercial_id ='.$id]);

             foreach ($ligne as  $t)
            {
                 
                 $mnt=$t['montant'];//debug($mnt);
                if ($t['lignebonlivraison_id'] !=0)
                { 
                    
                     $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($t['lignebonlivraison_id']);
                     //if($lignebonlivraison->montantregle ==$mnt )
                     $lignebonlivraison->montantregle= $lignebonlivraison->montantregle-$mnt;
                     
                     $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison); 
                }
               if ($t['lignebonusmalu_id'] !=0)
                {
                    $lignebonusmalus = $this->fetchTable('Lignebonusmalus')->get($t['lignebonusmalu_id']);
                   $lignebonusmalus->montantregle= $lignebonusmalus->montantregle-$mnt;
                   
                   //debug($lignebonusmalus->montantregle);die;
                   // $reglementcommercial['montantpaye']=$reglementcommercial['montantpaye']-$t['montant'];
                        $this->fetchTable('Lignebonusmalus')->save($lignebonusmalus);
                }
                

           // die;
 
                
                
                
//            $this->Reglementcommercials->save($reglementcommercial);
            $this->fetchTable('Lignereglementcommercials')->delete($t); 
            }
     // die;
            
            
          
             
           $reglementcommercial = $this->Reglementcommercials->patchEntity($reglementcommercial, $this->request->getData());
       //   debug($reglementcommercial);//die;
           if ($this->Reglementcommercials->save($reglementcommercial)) {
               // debug($reglementcommercial);die;
                $id_reg = $reglementcommercial->id;
           $li = array();
                if (!empty($this->request->getData('data')['reglement'])) {
                    foreach ($this->request->getData('data')['reglement']as $j => $l) {
                        $lignereglementcommercial = $this->Lignereglementcommercials->newEmptyEntity();
                        if ($l['montantentre'] > 0 && array_key_exists('lignelivraison_id', $l)) {
                          
                          // $li['lignebonusmalu_id'] = 0;
                            $li['reglementcommercial_id'] = $id_reg;
                            $li['lignebonlivraison_id'] = $l['lignelivraison_id'];
                            $li['montant'] = $l['montantentre'];

                            $lignereglementcommercial = $this->Lignereglementcommercials->patchEntity($lignereglementcommercial, $li);
                      
                            $this->Lignereglementcommercials->save($lignereglementcommercial);     //  debug($lignereglementcommercial);die;
                            $lignelivraison = $this->fetchTable('Lignebonlivraisons')->find('all')->where(['Lignebonlivraisons.id  ="' . $l['lignelivraison_id'] . '"']);
                            $lignelivraison = $this->fetchTable('Lignebonlivraisons')->get($l['lignelivraison_id']);
                            $lignelivraison->montantregle = $lignelivraison->montantregle + $l['montantentre'];
                            $this->fetchTable('Lignebonlivraisons')->save($lignelivraison);
                            if ($l['montantentre'] == $l['reste']) {
                                $lignelivraison->commission = 'TRUE';
                                $this->fetchTable('Lignebonlivraisons')->save($lignelivraison);
                            }
                        }
                    }
                }
//debug($this->request->getData('data')['bonusreglement']);die;
                $li = array();
           if (!empty($this->request->getData('data')['bonusreglement']))
                { 
                    foreach ($this->request->getData('data')['bonusreglement']as $j => $li) {
    $lignereglementcommercial = $this->Lignereglementcommercials->newEmptyEntity();
                        if ($li['montantentrebonus'] > 0 && array_key_exists('lignebonus_id', $li)) {

                            $li['reglementcommercial_id'] = $id_reg;
                            $li['lignebonusmalu_id'] = $li['lignebonus_id'];
//                            $li['lignelivraison_id'] = 0;
                            $li['montant'] = $li['montantentrebonus'];

                            $lignereglementcommercial = $this->Lignereglementcommercials->patchEntity($lignereglementcommercial, $li);
                           // debug($lignereglementcommercial);die;
                            $this->Lignereglementcommercials->save($lignereglementcommercial);
                          
                            $lignebonus = $this->fetchTable('Lignebonusmalus')->get($li['lignebonus_id']);
                            $lignebonus->montantregle = $lignebonus->montantregle + $li['montantentrebonus'];
                            $this->fetchTable('Lignebonusmalus')->save($lignebonus); //debug($lignebonus);
                            if ($li['montantentrebonus'] == $li['resteb']) {
                                $lignebonus->paye = 1;
                                $this->fetchTable('Lignebonusmalus')->save($lignebonus);
                            }
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }







        }

        
                 $banque=$this->fetchTable('Banques')->find('list',  ['limit' => 200],[ 'valueField' => 'name'])->all(); 
 
        $commercials = $this->Reglementcommercials->Commercials->find('list', ['limit' => 200])->all();
        $paiements = $this->Reglementcommercials->Paiements->find('list', ['limit' => 200])->all();
        $this->set(compact('reglementcommercial', 'commercials', 'paiements'));
        $this->set(compact('liv', 'paiements', 'lignelivraison', 'banque','dat', 'data', 'lignebonus', 'bonu'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reglementcommercial id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
      $this->loadModel('Lignebonlivraisons');
        $this->request->allowMethod(['post', 'delete']);
        $reglementcommercial = $this->Reglementcommercials->get($id);

        $lignereglement = $this->fetchTable('Lignereglementcommercials')->find('all')
                ->where(['Lignereglementcommercials.reglementcommercial_id ="' . $id . '"']);

             $ligne=$this->fetchTable('Lignereglementcommercials')->find('all')->where(['Lignereglementcommercials.reglementcommercial_id ='.$id]);

             foreach ($ligne as  $t)
            {
                 
                 $mnt=$t['montant'];//debug($mnt);
                if ($t['lignebonlivraison_id'] !=0)
                { 
                    
                     $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($t['lignebonlivraison_id']);
                     $lignebonlivraison->montantregle= $lignebonlivraison->montantregle-$mnt;
                     
                     $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison); 
                }
               if ($t['lignebonusmalu_id'] !=0)
                {
                    $lignebonusmalus = $this->fetchTable('Lignebonusmalus')->get($t['lignebonusmalu_id']);
                   $lignebonusmalus->montantregle= $lignebonusmalus->montantregle-$mnt;
                   
                   //debug($lignebonusmalus->montantregle);die;
                   // $reglementcommercial['montantpaye']=$reglementcommercial['montantpaye']-$t['montant'];
                        $this->fetchTable('Lignebonusmalus')->save($lignebonusmalus);
                }
                

           // die;
 
                
                
                
//            $this->Reglementcommercials->save($reglementcommercial);
            $this->fetchTable('Lignereglementcommercials')->delete($t); 
            }     $ligne=$this->fetchTable('Lignereglementcommercials')->find('all')->where(['Lignereglementcommercials.reglementcommercial_id ='.$id]);

             foreach ($ligne as  $t)
            {
                 
                 $mnt=$t['montant'];//debug($mnt);
                if ($t['lignebonlivraison_id'] !=0)
                { 
                    
                     $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($t['lignebonlivraison_id']);
                     $lignebonlivraison->montantregle= $lignebonlivraison->montantregle-$mnt;
                     
                     $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison); 
                }
               if ($t['lignebonusmalu_id'] !=0)
                {
                    $lignebonusmalus = $this->fetchTable('Lignebonusmalus')->get($t['lignebonusmalu_id']);
                   $lignebonusmalus->montantregle= $lignebonusmalus->montantregle-$mnt;
                   
                   //debug($lignebonusmalus->montantregle);die;
                   // $reglementcommercial['montantpaye']=$reglementcommercial['montantpaye']-$t['montant'];
                        $this->fetchTable('Lignebonusmalus')->save($lignebonusmalus);
                }
                

           // die;
 
                
                
                
//            $this->Reglementcommercials->save($reglementcommercial);
            $this->fetchTable('Lignereglementcommercials')->delete($t); 
            }
        
        
        
        
       


        if ($this->Reglementcommercials->delete($reglementcommercial)) {
          //  $this->Flash->success(__('The reglementcommercial has been deleted.'));
        } else {
           // $this->Flash->error(__('The reglementcommercial could not be deleted. Please, try again.'));
        }
        //return $this->redirect(['action' => 'index']);
    }

    public function contenureglement() {
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignebonlivraisons');
        $this->loadModel('Lignebonusmalus');
        $this->loadModel('Bonusmaluscommercials');
        $this->loadModel('Clients');
        $this->loadModel('Bonusmaluscommercials');
        $id = $this->request->getQuery('idcomm');
        $this->loadModel('Reglementcommercials');
        $reglementcommercial = $this->Reglementcommercials->newEmptyEntity();
        $k = 0;
        $o = 0;

        $p = 0;
        $m = 0;
        $dat = array();
        $data = array();
        $liv = $this->Bonlivraisons->find('all', ['contain' => ['Clients']])->where(['Bonlivraisons.commercial_id  ="' . $id . '"']);
        $bonus = $this->Bonusmaluscommercials->find('all')->where(['Bonusmaluscommercials.commercial_id  ="' . $id . '"']);
        //debug($bonus); die;
        $list = 0;
        foreach ($liv as $p => $livv) {
            $list = $list . ',' . $livv['id'];
        }


        $list2 = 0;
        foreach ($bonus as $o => $bonus) {
            $list2 = $list2 . ',' . $bonus['id'];
        }
        //debug($list2);die;



        $cond3 = 'Lignebonusmalus.bonusmaluscommercial_id   in (' . $list2 . ')';
        $cond4 = 'Lignebonusmalus.montant >0';
        $cond5 = 'Lignebonusmalus.paye=0';
        $lignebonus = $this->Lignebonusmalus->find('all')
                ->where([$cond3, $cond4, $cond5]);

        //    debug($lignebonus);die;



        $cond1 = '';
        $cond2 = '';
        $cond1 = 'Lignebonlivraisons.bonlivraison_id   in (' . $list . ')';
        $cond2 = 'Lignebonlivraisons.commission  ="FALSE"';
        $lignelivraison = $this->Lignebonlivraisons->find('all')
                ->where([$cond1, $cond2]);

        // debug($lignelivraison);




        foreach ($lignebonus as $m => $ligne) {

            $bonu = $this->Bonusmaluscommercials->find('all')->where(['Bonusmaluscommercials.id  ="' . $ligne['bonusmaluscommercial_id'] . '"']);
//debug($bonu);

            foreach ($bonu as $o => $bo) {
                $numero = $bo['numero'];
//                $datefin = $bo['datefin'];
                $dateop = $bo['dateoperation'];
            }
            $rest = $ligne['montant'] - $ligne['montantregle'];
            $data[$m]['id'] = $ligne['id'];
//            $data[$m]['datedebut'] = $datedebut;
//            $data[$m]['datefin'] = $datefin;
            $data[$m]['dateoperation'] = $dateop;
            $data[$m]['numero'] = $numero;
            $data[$m]['montat'] = $ligne['montant'];
            $data[$m]['montantregle'] = $ligne['montantregle'];
            $data[$m]['reste'] = $rest;
        }
        //  debug($data);
















        foreach ($lignelivraison as $k => $ligne) {
            $li = $this->Bonlivraisons->find('all', ['contain' => ['Clients']])->where(['Bonlivraisons.id  ="' . $ligne['bonlivraison_id'] . '"']);
            foreach ($li as $o => $livv) {
                $idbl = $livv['numero'];
                $bldate = $livv['date'];
                $clientbl = $livv->client->Raison_Sociale;
            }
            $rest = $ligne['montantcommission'] - $ligne['montantregle'];

            $dat[$k]['id'] = $ligne['id'];
            $dat[$k]['date'] = $bldate;
            $dat[$k]['numero'] = $idbl;
            $dat[$k]['client_id'] = $clientbl;

            $dat[$k]['montat'] = $ligne['montantcommission'];
            $dat[$k]['montantregle'] = $ligne['montantregle'];
            $dat[$k]['reste'] = $rest;
        }





        $this->layout = '';
        $paiements = $this->Reglementcommercials->Paiements->find('list', ['limit' => 200])->all();

        $this->set(compact('liv', 'paiements', 'reglementcommercial', 'lignelivraison', 'dat', 'data', 'lignebonus', 'bonu'));
    }

}

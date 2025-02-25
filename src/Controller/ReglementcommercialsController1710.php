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
        $reglementcommercials = $this->paginate($this->Reglementcommercials);
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
        $reglementcommercial = $this->Reglementcommercials->get($id, [
            'contain' => ['Commercials', 'Paiements', 'Lignereglementcommercials'],
        ]);

        $this->set(compact('reglementcommercial'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->loadModel('Lignereglementcommercials');
        $this->loadModel('Paiements');
        $this->loadModel('Lignebonlivraisons');
        $this->loadModel('Lignebonusmalus');
        $reglementcommercial = $this->Reglementcommercials->newEmptyEntity();
        if ($this->request->is('post')) {
//        debug($this->request->getData('data'));//die;
//$dat['date']=$this->request->getData('date');
//$dat['numero']=$this->request->getData('numero');
//$dat['commercial_id']=$this->request->getData('commercial_id');
//$dat['paiement_id']=$this->request->getData('paiement_id');
//$dat['montant']=$this->request->getData('data')['reglement']['montat'];
//$dat['montant']=$this->request->getData('data')['bonusreglement']['montant'];



            $reglementcommercial = $this->Reglementcommercials->patchEntity($reglementcommercial, $this->request->getData());
            if ($this->Reglementcommercials->save($reglementcommercial)) {
              //  debug($reglementcommercial);
$id_reg=$reglementcommercial->id;
                $li=array();
                if(!empty($this->request->getData('data')['reglement'])){
                foreach ($this->request->getData('data')['reglement']as $j => $l) {
        $lignereglementcommercial = $this->Lignereglementcommercials->newEmptyEntity();
                 if ($l['montantentre'] > 0 && array_key_exists('lignelivraison_id', $l)) {
                    // debug($l['lignelivraison_id']);
                    $li['reglementcommercial_id'] = $id_reg;
                       $li['lignelivraison_id'] = $l['lignelivraison_id'];
                             $li['montant'] = $l['montantentre'];
  
                        
                        
                        
                         $lignereglementcommercial = $this->Lignereglementcommercials->patchEntity($lignereglementcommercial,$li);
            $this->Lignereglementcommercials->save($lignereglementcommercial) ;
                       $lignelivraison= $this->Lignebonlivraisons->find('all')->where(['Lignebonlivraisons.id  ="' . $l['lignelivraison_id'] . '"']);
                        $lignelivraison= $this->Lignebonlivraisons->get($l['lignelivraison_id']);
                         $lignelivraison->montantregle=  $lignelivraison->montantregle + $l['montantentre'];
                      $this->Lignebonlivraisons->save($lignelivraison) ;
                           if($l['montantentre']==$l['reste']){
                           $lignelivraison->commission='TRUE'; 
                           
                        
                      $this->Lignebonlivraisons->save($lignelivraison) ;
                      
                        }
                        
                      
                    }
                }}
                
                
                
                
                $li=array();
                if(!empty($this->request->getData('data')['bonusreglement'])){
                foreach ($this->request->getData('data')['bonusreglement']as $j => $l) {
                 //  debug($this->request->getData('data')['bonusreglement']);
                    
                    if ($l['montantentrebonus'] > 0 && array_key_exists('lignebonus_id', $l)) {
                         $li['reglementcommercial_id'] = $id_reg;
                          $li['lignebonusmalu_id'] = $l['lignebonus_id'];
                              $li['montant'] = $l['montantentrebonus'];
                             // debug($li);
                              $lignereglementcommercial = $this->Lignereglementcommercials->patchEntity($lignereglementcommercial,$li);
                              // debug($lignereglementcommercial);
            $this->Lignereglementcommercials->save($lignereglementcommercial) ;
                        //debug($lignereglementcommercial);die;
            
            
            
            
            
                        $lignebonus= $this->Lignebonusmalus->get($l['lignebonus_id']);
                         $lignebonus->montantregle=  $lignebonus->montantregle + $l['montantentrebonus'];
                      $this->Lignebonusmalus->save($lignebonus) ;
                           if($l['montantentrebonus']==$l['resteb']){
                           $lignebonus->paye=1; 
                      $this->Lignebonusmalus->save($lignebonus) ;
            
            
            
            
            
            
                        
                    
                    }
                }}



}




                
                
                






             //   $this->Flash->success(__('The reglementcommercial has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The reglementcommercial could not be saved. Please, try again.'));
        }
        $num = $this->Reglementcommercials->find()->select(["num" =>
                    'MAX(Reglementcommercials.numero)'])->first();
        $numero = $num->num;
        //  DOF00001
        $n = 0;
        $n = $numero;
        if (!empty($n)) {

            $c = $n + 1;
            $b = "0000" . $c;
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




        $commercials = $this->Reglementcommercials->Commercials->find('list', ['limit' => 200])->all();
        $paiements = $this->Reglementcommercials->Paiements->find('list', ['limit' => 200])->all();
        $this->set(compact('reglementcommercial', 'b', 'commercials', 'paiements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reglementcommercial id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $reglementcommercial = $this->Reglementcommercials->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reglementcommercial = $this->Reglementcommercials->patchEntity($reglementcommercial, $this->request->getData());
            if ($this->Reglementcommercials->save($reglementcommercial)) {
                $this->Flash->success(__('The reglementcommercial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reglementcommercial could not be saved. Please, try again.'));
        }
        $commercials = $this->Reglementcommercials->Commercials->find('list', ['limit' => 200])->all();
        $paiements = $this->Reglementcommercials->Paiements->find('list', ['limit' => 200])->all();
        $this->set(compact('reglementcommercial', 'commercials', 'paiements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reglementcommercial id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $reglementcommercial = $this->Reglementcommercials->get($id);
        if ($this->Reglementcommercials->delete($reglementcommercial)) {
            $this->Flash->success(__('The reglementcommercial has been deleted.'));
        } else {
            $this->Flash->error(__('The reglementcommercial could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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
    $bonus=$this->Bonusmaluscommercials->find('all')->where(['Bonusmaluscommercials.commercial_id  ="' . $id . '"']);
   //debug($bonus); die;
    $list=0;
        foreach ($liv as $p => $livv) {
            $list=$list.','.$livv['id'];
        }
    
    
        $list2=0;
        foreach ($bonus as $o => $bonus) 
        {
            $list2=$list2.','.$bonus['id'];
        }
        //debug($list2);die;
        
       
         $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond3='Lignebonusmalus.bonusmaluscommercial_id   in (' . $list2 . ')';
        $cond4 ='Lignebonusmalus.montant >0';
        $cond5='Lignebonusmalus.paye=0';
             $lignebonus = $this->Lignebonusmalus->find('all')
                    ->where([$cond3,$cond4,$cond5]);
                   
       // debug($lignebonus);die;
             
  
             
             $cond1 = '';
        $cond2 = '';
                 $cond1='Lignebonlivraisons.bonlivraison_id   in (' . $list . ')';
                 $cond2='Lignebonlivraisons.commission  ="FALSE"';
            $lignelivraison = $this->Lignebonlivraisons->find('all')
                    ->where([$cond1, $cond2]);
            
          // debug($lignelivraison);
            
            
            
            
              foreach ($lignebonus as $m => $ligne) {
                  
  $bonu = $this->Bonusmaluscommercials->find('all')->where(['Bonusmaluscommercials.id  ="' . $ligne['bonusmaluscommercial_id'] . '"']);
//debug($bonu);
  
  foreach ($bonu as $o => $bo) {
            $datedebut=$bo['datedebut'];
          $datefin=$bo['datefin'];
          $dateop=$bo['dateoperation'];
          }
        $rest=$ligne['montant']-$ligne['montantregle'];
                  $data[$m]['id'] = $ligne['id'];
            $data[$m]['datedebut'] = $datedebut;
            $data[$m]['datefin'] = $datefin;
           $data[$m]['dateoperation'] = $dateop;
           // $data[$m]['article_id']=$ligne->article->Dsignation;
            $data[$m]['montat'] = $ligne['montant'];
            $data[$m]['montantregle'] = $ligne['montantregle'];
             $data[$m]['reste']=$rest;
                                   
            }
         //  debug($data);
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
          
            foreach ($lignelivraison as $k => $ligne) {
  $li = $this->Bonlivraisons->find('all', ['contain' => ['Clients']])->where(['Bonlivraisons.id  ="' . $ligne['bonlivraison_id'] . '"']);
   foreach ($li as $o => $livv) {
            $idbl=$livv['numero'];
          $bldate=$livv['date'];
           $clientbl=$livv->client->Raison_Sociale;
          


        }
        $rest=$ligne['montantcommission']-$ligne['montantregle'];

                  $dat[$k]['id'] = $ligne['id'];
            $dat[$k]['date'] = $bldate;
            $dat[$k]['numero'] = $idbl;
            $dat[$k]['client_id'] = $clientbl;
            
            
            $dat[$k]['montat'] = $ligne['montantcommission'];
            $dat[$k]['montantregle'] = $ligne['montantregle'];
             $dat[$k]['reste']=$rest;
                
                
                
                


                                   
            }
           
           



     $this->layout = '';

        $this->set(compact('liv', 'reglementcommercial','lignelivraison','dat','data','lignebonus','bonu'));
    }

}

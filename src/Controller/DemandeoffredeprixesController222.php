<?php
declare(strict_types=1);

namespace App\Controller;

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
    
    
    
    
    
    
    
    
    
    
    
    public function imprimevieww()
    {
         $cond2='';
        $cond1='';
        $cond3='';
 $numero=$this->request->getQuery('numero');
     $datedebut=$this->request->getQuery('datedebut');
        $datefin=$this->request->getQuery('datefin');
        
        
         if ($numero) {
               $cond1 = "Demandeoffredeprixes.numero like  '%" . $numero . "%' ";
         }
          
            if ($datedebut) {
                $cond2="Demandeoffredeprixes.date like '%".$datedebut."%'";
            }
            
           if ($datefin) {
               $cond3= "Demandeoffredeprixes.date like'%".$datefin."%'";
               
           }
     

          $query = $this->Demandeoffredeprixes->find('all')->where([$cond1, $cond2,$cond3]); 
      
        
                
           $recherches = $this->paginate($query);
        $demandeoffredeprixes = $this->paginate($this->Demandeoffredeprixes);
        $this->set(compact('demandeoffredeprixes','recherches','numero','datedebut','datefin'));
         //debug($recherches);die();
        
      
    }
    
    
    
    
    public function index()
   {     $cond2='';
        $cond1='';
        $cond3='';
 $numero=$this->request->getQuery('numero');
     $datedebut=$this->request->getQuery('datedebut');
        $datefin=$this->request->getQuery('datefin');
        
        
         if ($numero) {
               $cond1 = "Demandeoffredeprixes.numero like  '%" . $numero . "%' ";
         }
          
            if ($datedebut) {
                $cond2="Demandeoffredeprixes.date like '%".$datedebut."%'";
            }
            
           if ($datefin) {
               $cond3= "Demandeoffredeprixes.date like'%".$datefin."%'";
               
           }
     
          $query = $this->Demandeoffredeprixes->find('all')->where([$cond1, $cond2,$cond3]); 
      
        
                
           $recherches = $this->paginate($query);
      
    
        $demandeoffredeprixes = $this->paginate($this->Demandeoffredeprixes);
        $this->set(compact('demandeoffredeprixes','recherches','numero','datedebut','datefin'));
         //debug($recherches);die();
        
      
    }

    /**
     * View method
     *
     * @param string|null $id Demandeoffredeprix id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Bandeconsultations', 'Lignedemandeoffredeprixes','Commandes','Fournisseurs','Articles','Lignebandeconsultations', 'Lignedemandeoffredeprixes', 'Lignelignebandeconsultations'],
        ]);

        $this->set(compact('demandeoffredeprix'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    
    public function add()
    
    {           
        $this->loadModel('Fournisseurs');
                $this->loadModel('Articles');
                   $this->loadModel('lignedemandeoffredeprixes');
                   
                   
//        $numeroobj = $this->Demandeoffredeprixes->find()->select (["numerox"=>
//            'MAX(Demandeoffredeprixes.numero)'])->first();
//        $numero=$numeroobj->numerox;
//        
//                 $this->set(compact('numero'));
                 
                 
                 
    $num = $this->Demandeoffredeprixes->find()->select(["numdepot" =>
                    'MAX(Demandeoffredeprixes.numero)'])->first();
        $numero = $num->numdepot;
        $inc = substr($numero, 7, 1);
        $i = $inc + 1;
//        (le compteur debut des le 0 non le 1) 
        $z = str_pad("$i", 5, '0', STR_PAD_LEFT);
        $c = str_pad("$z", 6, 'F', STR_PAD_LEFT);
        $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
        $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
       
        









//debug($b);
//  $b=   str_pad("$inc", 5, 'F', STR_PAD_LEFT);
//  debug($b);
// 
// //debug($c);
// $code=str_pad($c, 7, 'D', STR_PAD_LEFT);
//                 
                 
                 
                 
                 
                 
                 
                 
                 
                 
                         $demandeoffredeprix = $this->Demandeoffredeprixes->newEmptyEntity();
                        //debug($demandeoffredeprix);die;
 if ($this->request->is('post')) {
            //debug($this->request->getData());die;
         //debug($this->request->getData('data'));die();


     //debug($this->request->getData());die;
                 $demandeoffredeprix = $this->Demandeoffredeprixes->patchEntity($demandeoffredeprix, $this->request->getData());
                   if ($this->Demandeoffredeprixes->save($demandeoffredeprix)) {  
                $id = $demandeoffredeprix->id;
                  //debug($id);

 
                
                
                
                
                
                
                
                  
                  			//$this->misejour("Demandeoffredeprixes","add",$this->Demandeoffredeprixes->id);
                               
				if (isset($this->request->getData('data')['lignef']) && (!empty($this->request->getData('data')['lignef']))) {
                    foreach ($this->request->getData('data')['lignef'] as $j => $fourni) {
                        //debug($fourni);die();
						    if($fourni['fournisseur_id']){
                                                          $fr = $this->Fournisseurs->find()->select (["nomfour"=>'(Fournisseurs.name)'])->where(["Fournisseurs.id like  '%" .$fourni['fournisseur_id']. "%' "])->first();          
                                                             $frr=$fr->nomfour;
//debug($frr);die();
                                                            $fourni['nameF']=$frr;
                                                            //debug($fourni);die();
						    } 
                                                    //debug('yyyy');die;
						    if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
							//debug('pppp');die(); 
                                                        
                                                        foreach ($this->request->getData('data')['lignea'] as $i => $art) {
                                                                //debug($art);die;
		                            if($art['article_id']){ //debug($art['article_id']);die;
                                                  //debug('rrr');die();
                                                $ar = $this->Articles->find()->select (["nomarticle"=>'(Articles.designiation)'])->where(["Articles.id like  '%" .$art['article_id']. "%' "])->first();          
                                              $arr=$ar->nomarticle;
                                                
									    //debug($ar);die();
                                                                            $art['designiationA']=$arr;
                                                                            //debug($art['designiationA']);die
;                                                          }
								 
								    $data['demandeoffredeprix_id']=$id;
								    $data['article_id']=$art['article_id'];
								    $data['designiationA']= $art['designiationA'];
                                                                    //debug($data['designiationA']);die();
								    $data['qte']=$art['qte'];
								    $data['fournisseur_id']=$fourni['fournisseur_id'];
								    $data['nameF']=$fourni['nameF'];
                                                                    //debug($data);die
;                                                                     $demandeoffre = $this->fetchTable('lignedemandeoffredeprixes')->newEmptyEntity();
                            $demandeoffre= $this->lignedemandeoffredeprixes->patchEntity($demandeoffre, $data);
                            //debug($demandeoffre);die();
                            if ($this->lignedemandeoffredeprixes->save($demandeoffre)) {
                              $this->Flash->success("demande offre de prix has been created successfully");
                               return $this->redirect(['action' => 'index']);
                            }
                             else {
                               $this->Flash->error("Failed to create demande offre de prix");
                            }
                        
                        $this->set(compact("demandeoffre"));
                        
                    
                                                    }
                                                    
                             }                                       
                                                                    
                                } 
                                
                   }        
                   
                   
 }
 } 
 
        $fournisseurs= $this->Demandeoffredeprixes->Fournisseurs->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        $articles= $this->Demandeoffredeprixes->Articles->find('list',['keyfield' => 'id', 'valueField' => 'designiation']);
        $this->set(compact('demandeoffredeprix','articles','fournisseurs','b'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Demandeoffredeprix id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Lignedemandeoffredeprixes']
        ]);
       
        if ($this->request->is(['patch', 'post', 'put'])) { 
            debug('rrr');die
;            $demandeoffredeprix = $this->Demandeoffredeprixes->patchEntity($demandeoffredeprix, $this->request->getData());
            //$this->request->data['Demandeoffredeprix']['date'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Demandeoffredeprix']['date'])));
	  		
            if ($this->Demandeoffredeprixes->save($demandeoffredeprix)) {
				if (isset($this->request->getdata('data')['lignef']) && (!empty($this->request->getData('data')['lignef']))) {
                    foreach ($this->request->data['lignef'] as $j => $fourni) {
						 if($fourni['fournisseur_id']){
                                                          $fr = $this->Fournisseurs->find()->select (["nomfour"=>'(Fournisseurs.name)'])->where(["Fournisseurs.id like  '%" .$fourni['fournisseur_id']. "%' "])->first();          
                                                             $frr=$fr->nomfour;
//debug($frr);die();
                                                            $fourni['nameF']=$frr;
                                                            debug($fourni);die();
						    }
						    if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
							    foreach ($this->request->getData('data')['lignea'] as $i => $art) {
                                                               //debug($art);die();
		                            if($art['article_id']){ //debug($art['article_id']);die;
                                                  //debug('rrr');die();
                                                $ar = $this->Articles->find()->select (["nomarticle"=>'(Articles.designiation)'])->where(["Articles.id like  '%" .$art['article_id']. "%' "])->first();          
                                              $arr=$ar->nomarticle;
                                                
									    //debug($ar);die();
                                                                            $art['designiationA']=$arr;
                                                                            //debug($art['designiationA']);die
;                                                          }
								 
								    $data['demandeoffredeprix_id']=$id;
								    $data['article_id']=$art['article_id'];
								    $data['designiationA']= $art['designiationA'];
                                                                    //debug($data['designiationA']);die();
								    $data['qte']=$art['qte'];
								    $data['fournisseur_id']=$fourni['fournisseur_id'];
								    $data['nameF']=$fourni['nameF'];
                                                                    
                                                                    
                                                               $demandeoffre = $this->fetchTable('lignedemandeoffredeprixes')->newEmptyEntity();
                            $demandeoffre= $this->lignedemandeoffredeprixes->patchEntity($demandeoffre, $data);
                            debug($demandeoffre);die();
                            if ($this->lignedemandeoffredeprixes->save($demandeoffre)) {
                              $this->Flash->success("demande offre de prix has been created successfully");
                            }
                             else {
                               $this->Flash->error("Failed to create demande offre de prix");
                            }
                        
                        $this->set(compact("demandeoffre"));
                        
                    
                                                    }
                                                    
                             }                                       
                                                                    
                                } 
                                
                   }        
                   
                   
 }
 }             
            
            
            
            
            
      
        $this->set(compact('demandeoffredeprix'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Demandeoffredeprix id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id);
        if ($this->Demandeoffredeprixes->delete($demandeoffredeprix)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Demandeoffredeprix'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Demandeoffredeprix'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    
    
        public function imprimerrecherche()
    { 
            
                $cond2='';
        $cond1='';
        $cond3='';
 $numero=$this->request->getQuery('numero');
     $datedebut=$this->request->getQuery('datedebut');
        $datefin=$this->request->getQuery('datefin');
        
        
         if ($numero) {
               $cond1 = "Demandeoffredeprixes.numero like  '%" . $numero . "%' ";
         }
          
            if ($datedebut) {
                $cond2="Demandeoffredeprixes.date like '%".$datedebut."%'";
            }
            
           if ($datefin) {
               $cond3= "Demandeoffredeprixes.date like'%".$datefin."%'";
               
           }
     
        
//echo $cond1.'-'. $cond2.$cond3;

          $query = $this->Demandeoffredeprixes->find('all')->where([$cond1, $cond2,$cond3]); 
      
        
                
           $recherches = $this->paginate($query);
      
            
            
            
            
            $demandeoffredeprixes = $this->paginate($this->Demandeoffredeprixes);
        $this->set(compact('demandeoffredeprixes','recherches'));
         //debug($recherches);die(); 
            
            
            
            
            
            
            
            
            
            
            
            
            
    
    }

    
    

    
    
    
    
  
    public function bandeconsultation($id = null)
    {
         {
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Lignedemandeoffredeprixes']
        ]);
       
        if ($this->request->is(['patch', 'post', 'put'])) { 
            debug('rrr');die
;            $demandeoffredeprix = $this->Demandeoffredeprixes->patchEntity($demandeoffredeprix, $this->request->getData());
            //$this->request->data['Demandeoffredeprix']['date'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Demandeoffredeprix']['date'])));
	  		
            if ($this->Demandeoffredeprixes->save($demandeoffredeprix)) {
				if (isset($this->request->getdata('data')['lignef']) && (!empty($this->request->getData('data')['lignef']))) {
                    foreach ($this->request->data['lignef'] as $j => $fourni) {
						 if($fourni['fournisseur_id']){
                                                          $fr = $this->Fournisseurs->find()->select (["nomfour"=>'(Fournisseurs.name)'])->where(["Fournisseurs.id like  '%" .$fourni['fournisseur_id']. "%' "])->first();          
                                                             $frr=$fr->nomfour;
//debug($frr);die();
                                                            $fourni['nameF']=$frr;
                                                            debug($fourni);die();
						    }
						    if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
							    foreach ($this->request->getData('data')['lignea'] as $i => $art) {
                                                               //debug($art);die();
		                            if($art['article_id']){ //debug($art['article_id']);die;
                                                  //debug('rrr');die();
                                                $ar = $this->Articles->find()->select (["nomarticle"=>'(Articles.designiation)'])->where(["Articles.id like  '%" .$art['article_id']. "%' "])->first();          
                                              $arr=$ar->nomarticle;
                                                
									    //debug($ar);die();
                                                                            $art['designiationA']=$arr;
                                                                            //debug($art['designiationA']);die
;                                                          }
								 
								    $data['demandeoffredeprix_id']=$id;
								    $data['article_id']=$art['article_id'];
								    $data['designiationA']= $art['designiationA'];
                                                                    //debug($data['designiationA']);die();
								    $data['qte']=$art['qte'];
								    $data['fournisseur_id']=$fourni['fournisseur_id'];
								    $data['nameF']=$fourni['nameF'];
                                                                    
                                                                    
                                                               $demandeoffre = $this->fetchTable('lignedemandeoffredeprixes')->newEmptyEntity();
                            $demandeoffre= $this->lignedemandeoffredeprixes->patchEntity($demandeoffre, $data);
                            //debug($demandeoffre);die();
                            if ($this->lignedemandeoffredeprixes->save($demandeoffre)) {
                              $this->Flash->success("demande offre de prix has been created successfully");
                            }
                             else {
                               $this->Flash->error("Failed to create demande offre de prix");
                            }
                        
                        $this->set(compact("demandeoffre"));
                        
                    
                                                    }
                                                    
                             }                                       
                                                                    
                                } 
                                
                   }        
                   
                   
 }
 }             
            
            
            
            
            
      
        $this->set(compact('demandeoffredeprix'));
    }

    }

    
    
    
    
    
    
    
    
    
    
}




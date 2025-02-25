<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Commandes Controller
 *
 * @property \App\Model\Table\CommandesTable $Commandes
 * @method \App\Model\Entity\Commande[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommandefournisseursController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
          $cond1='';
        $cond2='';
        $cond3='';
          $cond4='';
        $cond5='';
        $cond6='';
          $cond7='';
        $cond8='';
        $cond9='';
          $cond10='';
        $cond11='';
        
        $datedebut=$this->request->getQuery('datedebut');
        $datefin=$this->request->getQuery('datefin');
         $numero=$this->request->getQuery('numero');
          $fournisseur_id=$this->request->getQuery('fournisseur_id');
            $materieltransport_id=$this->request->getQuery('materieltransport_id');
                  $pointdevente_id=$this->request->getQuery('pointdevente_id');
                  $chauffeur=$this->request->getQuery('chauffeur');
                  $depot_id=$this->request->getQuery('depot_id');
                  $convoyeur=$this->request->getQuery('convoyeur');
                  $cartecarburant_id=$this->request->getQuery('cartecarburant_id');
                  $annee=$this->request->getQuery('annee');
                
                  
                  
            
                  
          if ($fournisseur_id) {
               $cond1 = "Commandefournisseurs.fournisseur_id like  '%" .    $fournisseur_id . "%' ";
         }
         if ($numero) {
               $cond2 = "Commandefournisseurs.numero like  '%" .   $numero . "%' ";
         }
           if ($datedebut) {
               $cond3 = "Commandefournisseurs.date like  '%" .    $datedebut . "%' ";
         }     
           if ($datefin) {
               $cond4 = "Commandefournisseurs.date like  '%" .     $datefin . "%' ";
         }     
           if ($materieltransport_id) {
               $cond5 = "Commandefournisseurs.materieltransport_id like  '%" .       $materieltransport_id . "%' ";
         }     
           if ($pointdevente_id) {
               $cond6 = "Commandefournisseurs.pointdevente_id like  '%" .         $pointdevente_id . "%' ";
         }    
          if ($depot_id) {
               $cond7 = "Commandefournisseurs.depot_id like  '%" .         $depot_id . "%' ";
         }    
           if ($cartecarburant_id) {
               $cond8 = "Commandefournisseurs.cartecarburant_id like  '%" .         $cartecarburant_id . "%' ";
         } 
           if ($convoyeur) {
               $cond9 = "Commandefournisseurs.convoyeur like  '%" .         $convoyeur . "%' ";
         } 
          if ($chauffeur) {
               $cond10 = "Commandefournisseurs.chauffeur like  '%" .         $chauffeur . "%' ";
         } 
         
         
         
          $query = $this->Commandefournisseurs->find('all')->where([$cond1, $cond2, $cond3, $cond4,$cond5,$cond6,$cond7,$cond8,$cond9,$cond10]); 
      
           $cmd = $this->paginate($query);
        
        
        
        
        
        
        
    
     
        
        
        
        
        
        
        
        
        
        
         //$this->loadModel('Personnels');
//        $this->paginate = [
//            'contain' => ['Demandeoffredeprixes', 'Fournisseurs','Pointdeventes','Depots', 'Personnels','Cartecarburants', 'Materieltransports'],
//        ];
        $commandes = $this->paginate($this->Commandefournisseurs);
        
        
        
        $fournisseurs = $this->Commandefournisseurs->Fournisseurs->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        
        $materieltransports = $this->Commandefournisseurs->Materieltransports->find('list',['keyfield' => 'id', 'valueField' => 'matricule']);
        $pointdeventes = $this->Commandefournisseurs->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Commandefournisseurs->Depots->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        //$chauffeurs= $this->Commandefournisseurs->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="1"'),'fields'=>array('Commandes->Personnels.code','Commandes->Personnels.nom','Commandes->Personnels.prenom')));
        $chauffeurs= $this->Commandefournisseurs->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="1"'),'fields'=>array('Personnels.code','Personnels.nom','Personnels.prenom')));
        
        
        $confaieurs= $this->Commandefournisseurs->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="5"'),'fields'=>array('Personnels.code','Personnels.nom','Personnels.prenom')));
        //$chauffeurs=$this->Personnel->find('list',array('conditions'=>array('Personnel.fonction_id="1"')));
        $cartecarburants = $this->Commandefournisseurs->Cartecarburants->find('list',['keyfield' => 'id', 'valueField' => 'num']);
        $this->set(compact('confaieurs','cmd','commandes','fournisseurs','chauffeurs','materieltransports','pointdeventes','depots','cartecarburants'));
    }

    /**
     * View method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commande = $this->Commandefournisseurs->get($id, [
            'contain' => ['Demandeoffredeprixes', 'Fournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports', 'Livraisons', 'Lignecommandefournisseurs', 'Lignelivraisons', 'Livraisonsanc'],
        ]);

        $this->set(compact('commande'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    
    { 
        $this->loadModel('Articles');
        $this->loadModel('Lignecommandefournisseurs');
        
         $num = $this->Commandefournisseurs->find()->select(["numdepot" =>
                    'MAX(Commandefournisseurs.numero)'])->first();
        $numero = $num->numdepot;
       //debug($numero);die;
//       C00002
         $inc = substr($numero, 5, 1);
//debug($inc);die;
        $i = $inc + 1;
        //debug($i);die;
//       (le compteur debut des le 0 non le 1) 
        $z = str_pad("$i", 5, '0', STR_PAD_LEFT);
        //debug($z);die;
        $c = str_pad("$z", 6, 'C', STR_PAD_LEFT);
        //debug($c);die;  

 $this->set(compact('c'));

        
        
      
        


        
        
        
        
        
        $numeroobj = $this->Commandefournisseurs->find()->select (["numerox"=>
            'MAX(Commandefournisseurs.numero)'])->first();
        $numero=$numeroobj->numerox;
            //debug($numeroobj->numerox);die();             
                 $this->set(compact('numero'));
     
        $this->paginate = [
            'contain' => ['Demandeoffredeprixes','Articles', 'Commandefournisseurs','Fournisseurs','Pointdeventes', 'Depots', 'Personnels','Cartecarburants', 'Materieltransports'],
        ];
      
        $commande = $this->Commandefournisseurs->newEmptyEntity();
        if ($this->request->is('post')) {
            $commande = $this->Commandefournisseurs->patchEntity($commande, $this->request->getData());
            if ($this->Commandefournisseurs->save($commande)) {
                  $commande_id = $commande->id;
                  //debug($commande_id);die;
                
                       

                 if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                       $this->loadModel('Commandefournisseurs');
                  foreach ($this->request->getData('data')['ligner'] as $i => $commande) {
                      //debug($this->request->getData('data')['ligner']);die;
if( $commande['sup0']!=1){
			        $data['commande_id'] =  $commande_id;
                                
                                //debug($data['commande_id']);die();
                            $cd = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();//fetchtable pour creer une ligne vide avant de la remplir
                            $cd = $this->Lignecommandefournisseurs->patchEntity($cd, $data);
                             //debug($cd);die();
                            if ($this->Lignecommandefournisseurs->save($cd)) { 
                              $this->Flash->success("adresselivraisonfournisseur has been created successfully");
                            }
                             else {
                               $this->Flash->error("Failed to create Lignecommandefournisseurs");
                            }
                        
                        $this->set(compact("cd"));
                    
                }
}
                 }
                
                  
                  
                  
                
                
                
                
                
                $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }
        $demandeoffredeprixes = $this->Commandefournisseurs->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Commandefournisseurs->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Commandefournisseurs->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandefournisseurs->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandefournisseurs->Cartecarburants->find('list', ['limit' => 200]);
        //$articles=$this->Commandes->Articles->find('list',['keyfield' => 'id', 'valueField' => 'designiation']);
        //debug($articles);die;
        $materieltransports = $this->Commandefournisseurs->Materieltransports->find('list', ['limit' => 200]);
        $articles=$this->Commandefournisseurs->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        //debug($articles);die();
        $this->set(compact('commande','articles', 'demandeoffredeprixes', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
            }


    /**
     * Edit method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commande = $this->Commandefournisseurs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commande = $this->Commandefournisseurs->patchEntity($commande, $this->request->getData());
            if ($this->Commandefournisseurs->save($commande)) {
                $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }
        $demandeoffredeprixes = $this->Commandefournisseurs->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Commandefournisseurs->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Commandefournisseurs->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandefournisseurs->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandefournisseurs->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandefournisseurs->Materieltransports->find('list', ['limit' => 200]);
        $this->set(compact('commande', 'demandeoffredeprixes', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commande = $this->Commandefournisseurs->get($id);
        if ($this->Commandefournisseurs->delete($commande)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Commande'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Commande'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    public function validation($id = null) {
		
		
		
    
    
    
    
    
    
    
    }
    
    
    

}
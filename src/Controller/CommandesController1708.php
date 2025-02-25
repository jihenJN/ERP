<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Commandes Controller
 *
 * @property \App\Model\Table\CommandesTable $Commandes
 * @method \App\Model\Entity\Commande[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommandesController extends AppController
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
                  //$chauffeur=$this->request->getQuery('chauffeur');
                  $depot_id=$this->request->getQuery('depot_id');
                  //$convoyeur=$this->request->getQuery('convoyeur');
                  $cartecarburant_id=$this->request->getQuery('cartecarburant_id');
                  $annee=$this->request->getQuery('annee');
                
                  
                  
            
                  
          if (   $fournisseur_id) {
               $cond1 = "Commandes.fournisseur_id like  '%" .    $fournisseur_id . "%' ";
         }
         if (  $numero) {
               $cond2 = "Commandes.numero like  '%" .   $numero . "%' ";
         }
           if (   $datedebut) {
               $cond3 = "Commandes.date like  '%" .    $datedebut . "%' ";
         }     
           if (    $datefin) {
               $cond4 = "Commandes.date like  '%" .     $datefin . "%' ";
         }     
           if (      $materieltransport_id) {
               $cond5 = "Commandes.materieltransport_id like  '%" .       $materieltransport_id . "%' ";
         }     
           if (        $pointdevente_id) {
               $cond6 = "Commandes.pointdevente_id like  '%" .         $pointdevente_id . "%' ";
         }    
          if (        $depot_id) {
               $cond7 = "Commandes.depot_id like  '%" .         $depot_id . "%' ";
         }    
           if (        $cartecarburant_id) {
               $cond8 = "Commandes.cartecarburant_id like  '%" .         $cartecarburant_id . "%' ";
         } 
         
          
         
         
         
          $query = $this->Commandes->find('all')->where([$cond1, $cond2, $cond3, $cond4,$cond5,$cond6,$cond7,$cond8]); 
      
        
                
           $cmd = $this->paginate($query);
        
        
        
        
        
        
        
    
     
        
        
        
        
        
        
        
        
        
        
         //$this->loadModel('Personnels');
//        $this->paginate = [
//            'contain' => ['Demandeoffredeprixes', 'Fournisseurs','Pointdeventes','Depots', 'Personnels','Cartecarburants', 'Materieltransports'],
//        ];
        $commandes = $this->paginate($this->Commandes);
        
        
        
        $fournisseurs = $this->Commandes->Fournisseurs->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        
        $materieltransports = $this->Commandes->Materieltransports->find('list',['keyfield' => 'id', 'valueField' => 'matricule']);
        $pointdeventes = $this->Commandes->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Commandes->Depots->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        //$chauffeurs= $this->Commandes->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="1"'),'fields'=>array('Commandes->Personnels.code','Commandes->Personnels.nom','Commandes->Personnels.prenom')));
        $chauffeurs= $this->Commandes->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="1"'),'fields'=>array('Personnels.code','Personnels.nom','Personnels.prenom')));
        
        
        $confaieurs= $this->Commandes->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="5"'),'fields'=>array('Personnels.code','Personnels.nom','Personnels.prenom')));
        //$chauffeurs=$this->Personnel->find('list',array('conditions'=>array('Personnel.fonction_id="1"')));
        $cartecarburants = $this->Commandes->Cartecarburants->find('list',['keyfield' => 'id', 'valueField' => 'num']);
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
        $commande = $this->Commandes->get($id, [
            'contain' => ['Demandeoffredeprixes', 'Fournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports', 'Livraisons', 'Lignecommandes', 'Lignelivraisons', 'Livraisonsanc'],
        ]);

        $this->set(compact('commande'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {$numeroobj = $this->Commandes->find()->select (["numerox"=>
            'MAX(Commandes.numero)'])->first();
        $numero=$numeroobj->numerox;
            //debug($numeroobj->numerox);die();             
                 $this->set(compact('numero'));
     
        $this->paginate = [
            'contain' => ['Demandeoffredeprixes','Articles', 'Commandes','Fournisseurs','Pointdeventes', 'Depots', 'Personnels','Cartecarburants', 'Materieltransports'],
        ];
        $commande = $this->Commandes->newEmptyEntity();
        if ($this->request->is('post')) {
            $commande = $this->Commandes->patchEntity($commande, $this->request->getData());
            if ($this->Commandes->save($commande)) {
                $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }
        $demandeoffredeprixes = $this->Commandes->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Commandes->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Commandes->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandes->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandes->Cartecarburants->find('list', ['limit' => 200]);
        //$articles=$this->Commandes->Articles->find('list',['keyfield' => 'id', 'valueField' => 'designiation']);
        //debug($articles);die;
        $materieltransports = $this->Commandes->Materieltransports->find('list', ['limit' => 200]);
        $this->set(compact('commande', 'demandeoffredeprixes', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
          
        
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
        $commande = $this->Commandes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commande = $this->Commandes->patchEntity($commande, $this->request->getData());
            if ($this->Commandes->save($commande)) {
                $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }
        $demandeoffredeprixes = $this->Commandes->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Commandes->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Commandes->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandes->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandes->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandes->Materieltransports->find('list', ['limit' => 200]);
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
        $commande = $this->Commandes->get($id);
        if ($this->Commandes->delete($commande)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Commande'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Commande'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

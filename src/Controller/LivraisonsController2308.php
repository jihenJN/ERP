<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Livraisons Controller
 *
 * @property \App\Model\Table\LivraisonsTable $Livraisons
 * @method \App\Model\Entity\Livraison[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LivraisonsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    { $cond1='';
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
         $materieltransport_id=$this->request->getQuery('materieltransport_id');
                  $pointdevente_id=$this->request->getQuery('pointdevente_id');
          $depot_id=$this->request->getQuery('depot_id');
         $cartecarburant_id=$this->request->getQuery('cartecarburant_id');
                  $annee=$this->request->getQuery('annee');
        
        
                  
                  
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
         
          $query = $this->Livraisons->find('all')->where([ $cond2, $cond3, $cond4,$cond5,$cond6,$cond7,$cond8]); 
      
        
                
           $lvr= $this->paginate($query);
        
        
                  
                  
                  
                  
                  
        
        
        $this->paginate = [
            'contain' => ['Fournisseurs', 'Adresselivraisonfournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports'],
        ];
          $commandes = $this->paginate($this->Livraisons);
        $fournisseurs = $this->Livraisons->Fournisseurs->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        $materieltransports = $this->Livraisons->Materieltransports->find('list',['keyfield' => 'id', 'valueField' => 'matricule']);
        $pointdeventes = $this->Livraisons->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Livraisons->Depots->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        //$chauffeurs= $this->Commandes->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="1"'),'fields'=>array('Commandes->Personnels.code','Commandes->Personnels.nom','Commandes->Personnels.prenom')));
        $chauffeurs= $this->Livraisons->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="1"'),'fields'=>array('Personnels.code','Personnels.nom','Personnels.prenom')));
        
         $livraisons = $this->paginate($this->Livraisons);
        $confaieurs= $this->Livraisons->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="5"'),'fields'=>array('Personnels.code','Personnels.nom','Personnels.prenom')));
        //$chauffeurs=$this->Personnel->find('list',array('conditions'=>array('Personnel.fonction_id="1"')));
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list',['keyfield' => 'id', 'valueField' => 'num']);
        $this->set(compact('confaieurs','lvr','commandes','fournisseurs','livraisons','chauffeurs','materieltransports','pointdeventes','depots','cartecarburants'));
    
       

    }

    /**
     * View method
     *
     * @param string|null $id Livraison id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $livraison = $this->Livraisons->get($id, [
            'contain' => ['Fournisseurs', 'Adresselivraisonfournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports', 'Commandes', 'Factures'],
        ]);

        $this->set(compact('livraison'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $livraison = $this->Livraisons->newEmptyEntity();
        if ($this->request->is('post')) {
            $livraison = $this->Livraisons->patchEntity($livraison, $this->request->getData());
            if ($this->Livraisons->save($livraison)) {
                $this->Flash->success(__('The {0} has been saved.', 'Livraison'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Livraison'));
        }
        $fournisseurs = $this->Livraisons->Fournisseurs->find('list', ['limit' => 200]);
        $adresselivraisonfournisseurs = $this->Livraisons->Adresselivraisonfournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Livraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Livraisons->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Livraisons->Materieltransports->find('list', ['limit' => 200]);
        $this->set(compact('livraison', 'fournisseurs', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Livraison id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $livraison = $this->Livraisons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $livraison = $this->Livraisons->patchEntity($livraison, $this->request->getData());
            if ($this->Livraisons->save($livraison)) {
                $this->Flash->success(__('The {0} has been saved.', 'Livraison'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Livraison'));
        }
        $fournisseurs = $this->Livraisons->Fournisseurs->find('list', ['limit' => 200]);
        $adresselivraisonfournisseurs = $this->Livraisons->Adresselivraisonfournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Livraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Livraisons->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Livraisons->Materieltransports->find('list', ['limit' => 200]);
        $this->set(compact('livraison', 'fournisseurs', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Livraison id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $livraison = $this->Livraisons->get($id);
        if ($this->Livraisons->delete($livraison)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Livraison'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Livraison'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

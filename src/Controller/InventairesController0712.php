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
    public function index()
    {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
       
        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        $depot_id = $this->request->getQuery('depot_id');
       
       
        if ($datedebut!='') {
            $cond1 = 'Inventaires.date >= '."'" .$datedebut ."'" ;
            
      }
         if ($datefin!='') {
            $cond2 = 'Inventaires.date <= '."'" .$datefin ."'" ;
      }  
      if ($depot_id) {
        $cond3 = "Inventaires.depot_id  =  '" . $depot_id . "' ";
         
       }
      

       $query = $this->Inventaires->find('all')->where([$cond1,$cond2,$cond3])->order(['Inventaires.id' =>'DESC']);
       
         //debug($query);

         $this->paginate = [
            'contain' => ['Depots'],
        ];

        $inventaires = $this->paginate($query);


        $depots=$this->fetchTable('Depots')->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('inventaires','depots'));
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
            'contain' => ['Depots', 'Ligneinventaires'],
        ]);

        $depots = $this->Inventaires->Depots->find('list', ['limit' => 200]);
        $articles= $this->fetchTable('Articles')->find('list',['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $lignes = $this->fetchTable('Ligneinventaires')->find()->where('Ligneinventaires.inventaire_id='.$id);
       
        $this->set(compact('inventaire','depots','lignes','articles'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inventaire = $this->Inventaires->newEmptyEntity();
        if ($this->request->is('post')) {
            $inventaire = $this->Inventaires->patchEntity($inventaire, $this->request->getData());
            if ($this->Inventaires->save($inventaire)) {
                $inv_id = ($this->Inventaires->save($inventaire)->id);
                         
                $this->misejour("Inventaires", "add", $inv_id);
                              
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) 
                { 
                  
                    $this->loadModel('Ligneinventaires');
               
               foreach ($this->request->getData('data')['ligner'] as $i => $li) {
                        if($li['sup1']!=1){
                            //debug($dep['sup1']);
                            $data1['inventaire_id']=$inventaire->id;
                            $data1['article_id']=$li['article_id'];
                            $data1['qteStock']=$li['qteStock'];

                            //debug($data1);die();
                         $ligneinv = $this->fetchTable('Ligneinventaires')->newEmptyEntity();//fetchtable pour creer une ligne vide avant de la remplir
                        
                         $ligneinv = $this->Ligneinventaires->patchEntity($ligneinv, $data1);
                        
                         if ($this->Ligneinventaires->save($ligneinv)) {
                            
                         // $this->Flash->success("Articlematierepremieres has been created successfully");
                         }
                          else {
                           // $this->Flash->error("Articlematierepremieres");
                         }
                     
                     $this->set(compact("ligneinv"));
                 
             }
            }
             
}
             //   $this->Flash->success(__('The {0} has been saved.', 'Inventaire'));

                return $this->redirect(['action' => 'index']);
            }
          //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Inventaire'));
        }

        $numeroobj = $this->Inventaires->find()->select (["numerox"=>
        'MAX(Inventaires.numero)'])->first();
    $numero=$numeroobj->numerox;
    if($numero!=null){
      // debug($numero);
       
            $n = $numero;
          
                $lastnum = $n;
                $nume = intval($lastnum) + 1;
                $nn=(string)$nume;
             
                $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
            // debug($code);die;
        
    }
    else {
        $code = "00001";
    }

        $depots = $this->Inventaires->Depots->find('list', ['limit' => 200]);
        $articles= $this->fetchTable('Articles')->find('all');
       
        $now=  new FrozenTime('now', 'Africa/Tunis');
        $this->set(compact('inventaire', 'depots','articles','now','code'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inventaire = $this->Inventaires->patchEntity($inventaire, $this->request->getData());
            if ($this->Inventaires->save($inventaire)) {
                $inv_id = ($this->Inventaires->save($inventaire)->id);
                         
                $this->misejour("Inventaires", "edit", $inv_id);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $li) {     
                   
    
                           $this->loadModel('Ligneinventaires');
                    if ($li['sup1'] != 1) {   
                           
                            $data1['inventaire_id']=$inventaire->id;
                            $data1['article_id']=$li['article_id'];
                            $data1['qteStock']=$li['qteStock'];
                            
                            
                            
                              //debug($data1);die;
                            if (isset($li['id']) && (!Empty($li['id']))) {
                              
                               $ligneinv = $this->fetchTable('Ligneinventaires')->get($li['id'], [
                                    'contain' => []
                                ]);
    
                                //debug('rrr');
                                
                            } else {
                                //debug('uuu');
                                $ligneinv  = $this->fetchTable('Ligneinventaires')->newEmptyEntity();
                            };
                            $ligneinv=$this->fetchTable('Ligneinventaires')->patchEntity( $ligneinv ,$data1);
    
                            
                           
    
                            if ($this->fetchTable('Ligneinventaires')->save($ligneinv)) {
                               // $this->Flash->success("Fournisseurbanques has been modified successfully");
                            } else {
                               // $this->Flash->error("Failed to modify fournisseurbanques");
                            }
                            
                }
                else {         
                    if(!Empty($li['id'])){ 
              
                            
                            // $this->request->allowMethod(['post', 'delete']);
                            $ligneinv = $this->fetchTable('Ligneinventaires')->get($li['id']);
                            $this->fetchTable('Ligneinventaires')->delete($ligneinv);
                    }
                    }
                 }
                }


               // $this->Flash->success(__('The {0} has been saved.', 'Inventaire'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Inventaire'));
        }
        $this->loadModel('Ligneinventaires');
        $depots = $this->Inventaires->Depots->find('list', ['limit' => 200]);
        $articles= $this->fetchTable('Articles')->find('all');
        $lignes = $this->fetchTable('Ligneinventaires')->find()->where('Ligneinventaires.inventaire_id='.$id);
        $this->set(compact('inventaire', 'depots','lignes','articles'));
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
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel("Ligneinventaires");
        $lignes = $this->Ligneinventaires->find('all')->where(['Ligneinventaires.inventaire_id ='.$id]);
        foreach ($lignes as $li) {
        $this->Ligneinventaires->delete($li);
        }
        $inventaire = $this->Inventaires->get($id);
        if ($this->Inventaires->delete($inventaire)) {
            $inv_id = ($this->Inventaires->save($inventaire)->id);
                         
            $this->misejour("Inventaires", "delete", $inv_id);
            //$this->Flash->success(__('The {0} has been deleted.', 'Inventaire'));
        } else {
            //$this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Inventaire'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function valider($id = null)
    {
        $inventaire = $this->Inventaires->get($id);
        $inventaire->valide=1;
        $this->Inventaires->save($inventaire);

        return $this->redirect(['action' => 'index']);
    }
}

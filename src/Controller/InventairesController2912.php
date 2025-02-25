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
        //$articles= $this->fetchTable('Articles')->find('list',['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $articles= $this->fetchTable('Articles')->find('all');

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


    public function indexp(){

        // $cond1='';
        // $cond2='';
        // $cond3='';
        $connection = ConnectionManager::get('default'); 
        $mois_debut = $this->request->getQuery('mois_debut');
        $mois_fin = $this->request->getQuery('mois_fin');
        $article_id = $this->request->getQuery('article_id');
        $famillemp_id = $this->request->getQuery('famillemp_id');
        $articlepf_id = $this->request->getQuery('articlepf_id');

        
        
        $query='';
$cond='1=1';
$condd='1=1';
        if ($article_id != null)
        {
            $cond.= ' and (fichearticles.article_id1='.$article_id.'
            or fichearticles.article_id2='.$article_id.'
            or fichearticles.article_id3='.$article_id.')';
             $cond2= ' (fichearticles.article_id1='.$article_id.'
            or fichearticles.article_id2='.$article_id.'
            or fichearticles.article_id3='.$article_id.')';
           $cond21= ' (fichearticles.article_id2='.$article_id.'
            or fichearticles.article_id3='.$article_id.')';  
              $cond22= ' (fichearticles.article_id3='.$article_id.')';  
        }
        else{
         $cond2='1=1'  ;
          $cond21='1=1'  ;
            $cond22='1=1'  ;
        }
        
        if ($famillemp_id != null)
        {
            $artfamilles=$this->fetchTable('Articles')->find('all')->where(['Articles.famille_id'=>$famillemp_id]);
        $liste="(";
        foreach($artfamilles as $i=> $art)
        {   
           
           $liste.=','."'".($art->id)."'";
           
          // $liste[$i]=$art->id;
        }
        $liste.=")";
        $liste=preg_replace('/,/', '', $liste, 1);
      
        //debug($liste);
          //  $cond.= ' and articles.famille_id='.$famillemp_id;
          $cond.= ' and (fichearticles.article_id1 in '.$liste.
                ' or fichearticles.article_id2 in '.$liste.
                ' or fichearticles.article_id3 in '.$liste.')' ;

$cond2f= '(fichearticles.article_id1 in '.$liste.
                ' or fichearticles.article_id2 in '.$liste.
                ' or fichearticles.article_id3 in '.$liste.')' ;
$cond22f= '(fichearticles.article_id2 in '.$liste.'
                 or fichearticles.article_id3 in '.$liste.')' ;
$cond222f= '(fichearticles.article_id3 in '.$liste.')' ;
//debug($cond222f);//die;
        }
        else{
         $cond2f= '1=1' ;
$cond22f= '1=1' ;
$cond222f= '1=1' ;   
        }
        if ($articlepf_id != null)
        {
            $cond.= ' and fichearticles.article_id='.$articlepf_id;
          //$cond.= ' and articles.id='.$articlepf_id;

        }
     //   debug($cond);

        // $query = $this->fetchTable('Fichearticles')->find('all')->select('article_id')
        // ->where(['OR'=>['Fichearticles.article_id1='."'".$article_id."'" ,
        // 'Fichearticles.article_id2='."'".$article_id."'",
        // 'Fichearticles.article_id3='."'".$article_id."'"]])
        // ->group('Fichearticles.article_id');
      
        if($this->request->getQuery()){
            //  debug($cond2);
        $query = $connection->execute('SELECT * from fichearticles where '.$cond.' 
        group by fichearticles.article_id ;')->fetchAll('assoc');
      //  debug($query);//die;
//         $queryy = $connection->execute('SELECT * from fichearticles where '.$cond.' group by fichearticles.article_id1,fichearticles.article_id2,fichearticles.article_id3 order by id ;
//        ')->fetchAll('assoc');
    }
 //  debug($queryy);//die;

                //debug($article);
     
        //debug($query->toArray());
            
       // $listearts=$this->paginate($query);
       $listearts=[];

        $articles=$this->fetchTable('Articles')->find('list',['keyfield' => 'id', 'valueField' => 'Dsignation'])
        ->where('Articles.famille_id <>1');
        $mois= $this->fetchTable('Mois')->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        $articlepfs=$this->fetchTable('Articles')->find('list',['keyfield' => 'id', 'valueField' => 'Dsignation'])
        ->where('Articles.famille_id=1');
        $famillemps=$this->fetchTable('Familles')->find('list',['keyfield' => 'id', 'valueField' => 'Nom'])
        ->where('Familles.id<>1');

        $this->set(compact('cond222f','cond22f','cond2f','cond22','cond21','cond2','queryy','article_id','listearts','articles','mois','articlepfs','articlepf_id','famillemp_id','famillemps','mois_debut','mois_fin','query'));
    }

    public function imprimerp() {
        $connection = ConnectionManager::get('default'); 
        $mois_debut = $this->request->getQuery('mois_debut');
        $mois_fin = $this->request->getQuery('mois_fin');
        $article_id = $this->request->getQuery('article_id');
        $famillemp_id = $this->request->getQuery('famillemp_id');
        $articlepf_id = $this->request->getQuery('articlepf_id');
       // debug($mois_debut);
      
       $query='';
       $cond='1=1';
               if ($article_id != null)
               {
                   $cond.= ' and (fichearticles.article_id1='.$article_id.'
                   or fichearticles.article_id2='.$article_id.'
                   or fichearticles.article_id3='.$article_id.')';
               }
               if ($famillemp_id != null)
               {
                   $artfamilles=$this->fetchTable('Articles')->find('all')->where(['Articles.famille_id'=>$famillemp_id]);
               $liste="(";
               foreach($artfamilles as $i=> $art)
               {   
                  
                  $liste.=','."'".($art->id)."'";
                 // $liste[$i]=$art->id;
               }
               $liste.=")";
               $liste=preg_replace('/,/', '', $liste, 1);
             
               //debug($liste);
                 //  $cond.= ' and articles.famille_id='.$famillemp_id;
                 $cond.= ' and (fichearticles.article_id1 in '.$liste.
                       ' or fichearticles.article_id2 in '.$liste.
                       ' or fichearticles.article_id3 in '.$liste.')' ;
       
       
               }
               if ($articlepf_id != null)
               {
                   $cond.= ' and fichearticles.article_id='.$articlepf_id;
                 //$cond.= ' and articles.id='.$articlepf_id;
       
               }
               //debug($cond);
       
               // $query = $this->fetchTable('Fichearticles')->find('all')->select('article_id')
               // ->where(['OR'=>['Fichearticles.article_id1='."'".$article_id."'" ,
               // 'Fichearticles.article_id2='."'".$article_id."'",
               // 'Fichearticles.article_id3='."'".$article_id."'"]])
               // ->group('Fichearticles.article_id');
               if($this->request->getQuery()){
               $query = $connection->execute('SELECT * from fichearticles where '.$cond.' group by fichearticles.article_id ;')->fetchAll('assoc');
               $queryy = $connection->execute('SELECT * from fichearticles where '.$cond.' group by fichearticles.article_id1,fichearticles.article_id2,fichearticles.article_id3 ;
               ')->fetchAll('assoc');
           }

       
      //  debug($articles) ;
        $this->set(compact('mois_debut','mois_fin','articlepf_id','famillemp_id','article_id','query','queryy'));
    }
}

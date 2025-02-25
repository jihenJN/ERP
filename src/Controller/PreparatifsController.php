<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Preparatifs Controller
 *
 * @property \App\Model\Table\PreparatifsTable $Preparatifs
 * @method \App\Model\Entity\Preparatif[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PreparatifsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */


    public function imprimeview($id = null) {
        $preparatif = $this->fetchTable('Preparatifs')->find('all', [
            'contain' => ['Materieltransports']
        ])
        ->where(['Preparatifs.id'=>$id]);

        foreach ($preparatif as $p) {
            $p['date'] = date('Y-m-d');
            
        }

        foreach ($preparatif as $p) {
            $chauffeur_id = $p['chauffeur_id'];
            $convoyeur_id = $p['convoyeur_id'];
            //debug($chauffeur_id) ;die ;
         
        }
        $chauffeur = $this->fetchTable('Personnels')->find()->select(["id" =>
        '(' . $chauffeur_id . ') ' , "nom" => "nom"  ])->first();
       //debug($chauffeur) ; die ; 
       $chauffeur = $this->fetchTable('Personnels')->find('all', [
        
    ])
        ->where(['Personnels.id'=>$chauffeur_id]);
        foreach ($chauffeur as $ch ){
            $chauff=$ch['nom'];
        }
       
   
        //debug($namech) ; die ; 

        $convoyeur = $this->fetchTable('Personnels')->find()->select(["id" =>
        '(' . $chauffeur_id . ') ' , "nom" => "nom"  ])->first();
       //debug($chauffeur) ; die ; 
       $convoyeur = $this->fetchTable('Personnels')->find('all', [
        
    ])
        ->where(['Personnels.id'=>$convoyeur_id]);
        foreach ($convoyeur as $cv ){
            $conv=$cv['nom'];
        }

        $this->set(compact('preparatif'  , 'chauff'  , 'conv'));

        
    }


    public function imprimeview2($id = null) {

        $this->loadModel('Bonlivraisons');

        $bonliv = $this->fetchTable('Bonlivraisons')->find('all', [

            'contain' => ['Preparatifs','Materieltransports']
        ])
        ->where(['Bonlivraisons.preparatif_id =  (' . $id . ')       ']);

        ///debug($bonliv) ;
        
        $this->loadModel('Societes');
        
        $societe = $this->fetchTable('Societes')->find('all', [

            'contain' => []
        ]);
        foreach ($societe as $s) {
            $nomsoc =  $s['nom'] ;
            $adresse =  $s['adresse'] ;     
        }
      

     
        

        foreach ($bonliv as $i => $bl) {
            $data[$i]['id'] = $bl['id'];
            $data[$i]['date'] = date('Y-m-d');
            $data[$i]['numero'] = $bl['preparatif']['numero'];
            $data[$i]['matricule'] = $bl['materieltransport']['matricule'];
            $data[$i]['designation'] = $bl['materieltransport']['designation'];
            $chauffeur_id = $bl['preparatif']['chauffeur_id'];
            $convoyeur_id = $bl['preparatif']['convoyeur_id'];
            $data[$i]['id'] = $bl['nbcartons'];

         

           
          
        
        $ligneliv = $this->fetchTable('Lignebonlivraisons')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['Lignebonlivraisons.bonlivraison_id  =  (' . $bl['id'] . ')       ']);

            foreach ($ligneliv as $j   => $ligne) {
                $data[$i]['Ligne'][$j]['Dsignation'] = $ligne['article']['Dsignation'];
                $data[$i]['Ligne'][$j]['Code'] = $ligne['article']['Code'];
                $data[$i]['Ligne'][$j]['nombrepiece'] = $ligne['article']['nombrepiece'];
                $data[$i]['Ligne'][$j]['quantiteliv'] = $ligne['quantiteliv'];
             
            }



        }


       

//        $chauffeur = $this->fetchTable('Personnels')->find()->select(["id" =>
//        '(' . $chauffeur_id . ') ' , "nom" => "nom"  ])->first();
       //debug($chauffeur) ; die ; 
       $chauffeur = $this->fetchTable('Personnels')->find('all', [
        
    ])
    ->where(['Personnels.id  =  ' . $chauffeur_id . '      ']);

////        debug($chauffeur);
        foreach ($chauffeur as $ch ){
            $chauff=$ch['nom'];
            $date=$ch['dateentre'];
           // debug($date) ;
          
        }

     
       
       
//
//        $convoyeur = $this->fetchTable('Personnels')->find()->select(["id" =>
//        '(' . $chauffeur_id . ') ' , "nom" => "nom"  ])->first();
      
       $convoyeur = $this->fetchTable('Personnels')->find('all', [
        
    ])
    ->where(['Personnels.id  =  ' . $convoyeur_id . '      ']);
        foreach ($convoyeur as $cv ){
            $conv=$cv['nom'];
            $datec=$cv['dateentre'];
            
        }
    
    
        $this->set(compact('bonliv'  , 'ligneliv'  ,'data' , 'chauff' , 'date' , 'conv' , 'datec' , 'nomsoc','adresse'));

        
    }





    public function index()
    {
        $cond1 = '';

        $numero = $this->request->getQuery('numero');

        if ($numero) {
            $cond1 = "Preparatifs.numero like '%" . $numero . "%' ";
        }

        $preparatif = $this->fetchTable('Preparatifs')->find('all', [
        ]) ; 

        $query = $this->Preparatifs->find('all')->where([$cond1])->order(['Preparatifs.id' => 'DESC']);
        $this->paginate = [
            'contain' => [],
        ];
        $preparatif = $this->paginate($query);
    //     foreach ($preparatif as $p) {
    //         $p['date'] = date('Y-m-d');
            
    //     }


        
    //     foreach ($preparatif as $p) {
    //         $chauffeur_id = $p['chauffeur_id'];
    //         $convoyeur_id = $p['convoyeur_id'];
    //         //debug($chauffeur_id) ;die ;
         
    //     }
    //     $chauffeur = $this->fetchTable('Personnels')->find()->select(["id" =>
    //     '(' . $chauffeur_id . ') ' , "nom" => "nom"  ])->first();
    //    //debug($chauffeur) ; die ; 
    //    $chauffeur = $this->fetchTable('Personnels')->find('all', [
        
    // ])
    //     ->where(['Personnels.id'=>$chauffeur_id]);
    //     foreach ($chauffeur as $ch ){
    //         $chauff=$ch['nom'];
    //     }
       
   
    //     //debug($namech) ; die ; 

    //     $convoyeur = $this->fetchTable('Personnels')->find()->select(["id" =>
    //     '(' . $chauffeur_id . ') ' , "nom" => "nom"  ])->first();
    //    //debug($chauffeur) ; die ; 
    //    $convoyeur = $this->fetchTable('Personnels')->find('all', [
        
    // ])
    //     ->where(['Personnels.id'=>$convoyeur_id]);
    //     foreach ($convoyeur as $cv ){
    //         $conv=$cv['nom'];
    //     }

        $this->set(compact('preparatif'));

    

    }

    /**
     * View method
     *
     * @param string|null $id Preparatif id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
     
        $preparatif = $this->Preparatifs->get($id, [
           
        ]);
        ///debug($preparatif);

        $bonliv = $this->fetchTable('Bonlivraisons')->find('all', [
            'contain' => ['Clients','Commercials']
            ]) 
         ->where(['Bonlivraisons.preparatif_id  =  ' . $preparatif->id . '      ']);

        foreach ($bonliv as $i => $bon) {
         
        //debug($bon);
            $data[$i]['date'] = $bon['date'];
            $data[$i]['client'] = $bon['client']['Raison_Sociale'];
            $data[$i]['commercial'] = $bon['commercial']['name'];
            $data[$i]['numero'] = $bon['numero'];

            
            $ligneliv = $this->fetchTable('Lignebonlivraisons')->find('all', [
                'contain' => ['Articles']
            ])
            ->where(['Lignebonlivraisons.bonlivraison_id  =  (' . $bon['id'] . ')       ']);

            foreach ($ligneliv as $j => $ligne) {
                ///debug($ligne);
            $data[$i]['Ligne'][$j]['Article'] = $ligne['article']['Dsignation'];
            $data[$i]['Ligne'][$j]['Code'] = $ligne['article']['Code'];
            $data[$i]['Ligne'][$j]['quantiteliv'] = $ligne['quantiteliv'];
            $data[$i]['Ligne'][$j]['prixht'] = $ligne['prixht'];
           // $dat[$i]['Ligne'][$j]['Article'] = $ligne['Dsignation'];

            }


        }

    ///debug($data);

        


        $this->set(compact('preparatif','bonliv','ligneliv','data'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $preparatif = $this->Preparatifs->newEmptyEntity();
        if ($this->request->is('post')) {
            $preparatif = $this->Preparatifs->patchEntity($preparatif, $this->request->getData());
            if ($this->Preparatifs->save($preparatif)) {
                //$this->Flash->success(__('The {0} has been saved.', 'Preparatif'));

                return $this->redirect(['action' => 'index']);
            }
           /// $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Preparatif'));
        }
        $bonlivraisons = $this->Preparatifs->Bonlivraisons->find('list', ['limit' => 200]);
        $clients = $this->Preparatifs->Clients->find('list', ['limit' => 200]);
        $pointdeventes = $this->Preparatifs->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Preparatifs->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Preparatifs->Materieltransports->find('list', ['limit' => 200]);
        $cartecarburants = $this->Preparatifs->Cartecarburants->find('list', ['limit' => 200]);
        $chauffeurs = $this->Preparatifs->Chauffeurs->find('list', ['limit' => 200]);
        $convoyeurs = $this->Preparatifs->Convoyeurs->find('list', ['limit' => 200]);
        $factureclients = $this->Preparatifs->Factureclients->find('list', ['limit' => 200]);
        $adresselivraisonclients = $this->Preparatifs->Adresselivraisonclients->find('list', ['limit' => 200]);
        $commandes = $this->Preparatifs->Commandes->find('list', ['limit' => 200]);
        $this->set(compact('preparatif', 'bonlivraisons', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'convoyeurs', 'factureclients', 'adresselivraisonclients', 'commandes'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Preparatif id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $preparatif = $this->Preparatifs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $preparatif = $this->Preparatifs->patchEntity($preparatif, $this->request->getData());
            if ($this->Preparatifs->save($preparatif)) {
                ///$this->Flash->success(__('The {0} has been saved.', 'Preparatif'));

                return $this->redirect(['action' => 'index']);
            }
           /// $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Preparatif'));
        }
        $bonlivraisons = $this->Preparatifs->Bonlivraisons->find('list', ['limit' => 200]);
        $clients = $this->Preparatifs->Clients->find('list', ['limit' => 200]);
        $pointdeventes = $this->Preparatifs->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Preparatifs->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Preparatifs->Materieltransports->find('list', ['limit' => 200]);
        $cartecarburants = $this->Preparatifs->Cartecarburants->find('list', ['limit' => 200]);
        $chauffeurs = $this->Preparatifs->Chauffeurs->find('list', ['limit' => 200]);
        $convoyeurs = $this->Preparatifs->Convoyeurs->find('list', ['limit' => 200]);
        $factureclients = $this->Preparatifs->Factureclients->find('list', ['limit' => 200]);
        $adresselivraisonclients = $this->Preparatifs->Adresselivraisonclients->find('list', ['limit' => 200]);
        $commandes = $this->Preparatifs->Commandes->find('list', ['limit' => 200]);
        $this->set(compact('preparatif', 'bonlivraisons', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'convoyeurs', 'factureclients', 'adresselivraisonclients', 'commandes'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Preparatif id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
       /// $this->request->allowMethod(['post', 'delete']);
        $preparatif = $this->Preparatifs->get($id);
        if ($this->Preparatifs->delete($preparatif)) {
           /// $this->Flash->success(__('The {0} has been deleted.', 'Preparatif'));
        } else {
            ///$this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Preparatif'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
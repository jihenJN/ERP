<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fournisseurs Controller
 *
 * @property \App\Model\Table\FournisseursTable $Fournisseurs
 * @method \App\Model\Entity\Fournisseur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FournisseursController extends AppController
{
    /**
     * Index method
    
     * @return \Cake\Http\Response|null|void Renders view
     */
    
    //public function index()/*
    /*
        $cin=$this->request->getQuery('cin');
        $compteComptable=$this->request->getQuery('comptecomptable');
        $passeport=$this->request->getQuery('passeport');
        $typeutilisateur_id=$this->request->getQuery('typeutilisateur_id');
        $cartesejour=$this->request->getQuery('cartesejour');
        $paiement=$this->request->getQuery('paiement_id');
        $matriculefiscale=$this->request->getQuery('Matriculefiscale');
        $name=$this->request->getQuery('name');
        $typeutilisateursoptions = $this->Clients->Typeutilisateurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $paiementsoptions = $this->Clients->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        if($cin && $passeport && $compteComptable && $cartesejour && $matriculefiscale && $name && $typeutilisateur_id && $paiement ){
            $query=$this->Clients->find('all')->where(['Or'=>['cin like'=>'%'.$cin.'%','passeport like'=>'%'.$passeport.'%','compteComptable like'=>'%'.$compteComptable.'%','matriculefiscale like'=>'%'.$matriculefiscale.'%','clients.name like'=>'%'.$name.'%',' clients.typeutilisateur_id like'=>'%'.$typeutilisateur_id.'%',' clients.paiement_id like'=>'%'.$paiement.'%']]);
            //debug($query);
        }else{
            $query=$this->Clients;}
            
            
            
        $this->paginate = [
            'contain' => ['Typeutilisateurs', 'Villes', 'Regions', 'Pays', 'Activites', 'Paiements'],
        ];
        $clients = $this->paginate($query);
        //debug($clients);
        $this->set(compact('clients','typeutilisateursoptions','paiementsoptions'));*/
   // }
    
    
    
    
    
     public function print()
    {   
         //debug('rrr');die;
       $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond0 = '';
         
        if ($this->request->getQuery('name') != '') {
              //debug('rrr');die;
                $name = $this->request->getQuery('name');
               //debug($name);die();
               
                
                 $cond0 = "Fournisseurs.name like  '%" . $name . "%' ";
                
                
            }
			//debug($cond0);die;
			if ($this->request->getQuery('compte_comptable') != '') {
                $compte_comptable = $this->request->getQuery('compte_comptable');
                
                     $cond1 = "Fournisseurs.compte_comptable  like  '%" .  $compte_comptable . "%' ";
                
                
            }
			
			if ($this->request->getQuery('Typelocalisation_id') != '') {
                $Typelocalisation_id = $this->request->getQuery('Typelocalisation_id');

                 $cond3 = "Fournisseurs.typelocalisation_id  like  '%" . $typelocalisation_id . "%' ";
                
                
            }
			
			if ($this->request->getQuery('Paiement_id') != '') {
                $Paiement_id = $this->request->query('Paiement_id');
  
                
                   $cond4 = "Fournisseurs.paiement_id   like  '%" . $paiement_id . "%' ";
                
                
                
            }
		
                 $query = $this->Fournisseurs->find('all')->where([$cond1, $cond2,$cond3,$cond4,$cond0]);
        $this->paginate = [
            'contain' => ['Typeutilisateurs', 'Typelocalisations', 'Villes', 'Regions', 'Pays', 'Paiements', 'Devises'],
        ];
             $fournisseurs = $this->paginate($query);
                   
                   
                     $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
              $paiements = $this->Fournisseurs->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
       $this->set(compact( 'fournisseurs','typeutilisateurs', 'typelocalisations', 'paiements'));

	}

    
            
    
        
        
        
        
        
        
        
     
      
    






        
        
        
        
        
        
        
        
        
        
        
    
    
    
    

    
    
    public function index()
    {   
         
        
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
         $name=$this->request->getQuery('name');
        $compte_comptable=$this->request->getQuery('compte_comptable');
        $typeutilisateur_id=$this->request->getQuery('typeutilisateur_id');
   
        $typelocalisation_id=$this->request->getQuery('typelocalisation_id');
          $paiement_id=$this->request->getQuery('paiement_id');
         //if($nom ){
            //$query=$this->Fournisseurs->find('all')->where(['Or'=>['nom like'=>'%'.$nom.'%']]);
            //debug($query);
        //}else{
            //$query=$this->Fournisseurs;}
            
          if ($name) {
            $cond1 = "Fournisseurs.name like  '%" . $name . "%' ";
        }
           if ($typeutilisateur_id) {
            $cond3 = "Fournisseurs.typeutilisateur_id  like  '%" .     $typeutilisateur_id . "%' ";
        }    
        
        
           if ($typelocalisation_id) {
            $cond4 = "Fournisseurs.typelocalisation_id  like  '%" . $typelocalisation_id . "%' ";
        }
             
            
           if ( $compte_comptable) {
            $cond2 = "Fournisseurs.compte_comptable  like  '%" .  $compte_comptable . "%' ";
        }
              if ($paiement_id) {
            $cond5 = "Fournisseurs.paiement_id   like  '%" . $paiement_id . "%' ";
        }
           
         
           
           
           
       $query = $this->Fournisseurs->find('all')->where([$cond1,$cond2,$cond3,$cond4,$cond5]);
        $this->paginate = [
            'contain' => ['Typeutilisateurs', 'Typelocalisations', 'Villes', 'Regions', 'Pays', 'Paiements', 'Devises'],
        ];
             $fournisseurs = $this->paginate($query);
             
         
         $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
          $paiements = $this->Fournisseurs->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
       $this->set(compact('fournisseurs','name','compte_comptable','typeutilisateur_id','paiement_id','compte_comptable','typelocalisation_id','typeutilisateurs', 'typelocalisations', 'paiements'));
 

    }
            
          
   
    
    
    
   
    
    
    
    
    
    
           
           
            public function imprimeview($id = null)
          {
                      $fournisseur = $this->Fournisseurs->get($id, [
            'contain' => [ 'Fournisseurresponsables','Fournisseurbanques','Typelocalisations', 'Villes', 'Regions', 'Pays', 'Paiements', 'Devises', 'Adresselivraisonfournisseurs', 'Articlefournisseurs', 'Bandeconsultations', 'Exonerations', 'Factures', 'Fournisseurbanques', 'Fournisseurresponsables', 'Lignebandeconsultations',  'Lignedemandeoffredeprixes', 'Lignefactures', 'Lignelignebandeconsultations', 'Lignelivraisons', 'Livraisons', 'Livraisonsanc'],
        ]);
        $this->set(compact('fournisseur'));
    
        
        
        
        
         $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list', ['limit' => 200]);
        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['limit' => 200]);
        $villes = $this->Fournisseurs->Villes->find('list', ['limit' => 200]);
        $regions = $this->Fournisseurs->Regions->find('list', ['limit' => 200]);
        $pays = $this->Fournisseurs->Pays->find('list', ['limit' => 200]);
       $paiements = $this->Fournisseurs->Paiements->find('list', ['limit' => 200]);
        $devises = $this->Fournisseurs->Devises->find('list', ['limit' => 200]);
        $this->set(compact('fournisseur','typeutilisateurs', 'typelocalisations', 'villes', 'regions', 'pays', 'paiements', 'devises'));
        
          }
           
          
            
       
     
    

    
    
    
    
    /**
     * View method
     *
     * @param string|null $id Fournisseur id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
          {
             $exonerations=array();
	$exonerations[0]='exonoré';
	$exonerations[1]='non exonoré';
        $this->set(compact('exonerations'));
        
        $fournisseur = $this->Fournisseurs->get($id, [
            'contain' => [ 'Fournisseurresponsables','Fournisseurbanques','Typelocalisations', 'Villes', 'Regions', 'Pays', 'Paiements', 'Devises', 'Adresselivraisonfournisseurs', 'Articlefournisseurs', 'Bandeconsultations', 'Exonerations', 'Factures', 'Fournisseurbanques', 'Fournisseurresponsables', 'Lignebandeconsultations', 'Lignedemandeoffredeprixes', 'Lignefactures', 'Lignelignebandeconsultations', 'Lignelivraisons', 'Livraisons', 'Livraisonsanc'],
        ]);
        $this->set(compact('fournisseur'));
    
        
        $this->loadModel('Banques');
        
          $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
         $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list', ['limit' => 200]);
        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['limit' => 200]);
        $villes = $this->Fournisseurs->Villes->find('list', ['limit' => 200]);
        $regions = $this->Fournisseurs->Regions->find('list', ['limit' => 200]);
        $pays = $this->Fournisseurs->Pays->find('list', ['limit' => 200]);
       $paiements = $this->Fournisseurs->Paiements->find('list', ['limit' => 200]);
        $devises = $this->Fournisseurs->Devises->find('list', ['limit' => 200]);
           $typeexonerations = $this->Fournisseurs->Typeexons->find('list',['limit' => 200]); 
        $this->set(compact('typeexonerations','banques','fournisseur','typeutilisateurs','typelocalisations', 'villes', 'regions', 'pays', 'paiements', 'devises'));
        
          }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
  {  
         
                
    $exonerations=array();
	$exonerations[0]='exonoré';
	$exonerations[1]='non exonoré';
        $this->set(compact('exonerations'));
        //$this->loadModel('Exoneration');
        $fournisseur = $this->Fournisseurs->newEmptyEntity();
        //debug($fournisseur);die;
        if ($this->request->is('post')) {
           //  debug($this->request->getData());die(); 
          //  debug($this->request->getData());die;
               //debug($this->request->getData());die;
         //debug(($this->request->getData()));
     //debug(($this->request->getData('data')['ligne']));
       //debug(($this->request->getData('data')['lignead']));
                //debug(($this->request->getData('data')['lignes']));
             
            $fournisseur = $this->Fournisseurs->patchEntity($fournisseur, $this->request->getData());
            if ($this->Fournisseurs->save($fournisseur)) {  
                $fournisseur_id = $fournisseur->id;
                            
                if (isset($this->request->getData('data')['lignead']) && (!empty($this->request->getData('data')['lignead']))) {
                      $this->loadModel('Adresselivraisonfournisseurs');
                                   foreach ($this->request->getData('data')['lignead'] as $i => $adresseliv) {
                                      //debug($adresseliv);
                       if ($adresseliv['sup'] != 1) {
                          $data['adresse'] = $adresseliv['adresse'];
                          $data['fournisseur_id'] = $fournisseur_id;
                            $adresselivraisonfournisseur = $this->fetchTable('Adresselivraisonfournisseurs')->newEmptyEntity();
                            $adresselivraisonfournisseur = $this->Adresselivraisonfournisseurs->patchEntity($adresselivraisonfournisseur, $data);
                                      
                            if ($this->Adresselivraisonfournisseurs->save( $adresselivraisonfournisseur)){
                                //debug($adresselivraisonfournisseur);die(); 
                            //    $this->Flash->success("adresselivraisonfournisseur has been created successfully");
                            } else {
                              $this->Flash->error("Failed to create adresselivraisonfournisseur");                            }
                        }
                       $this->set(compact("adresselivraisonfournisseur"));
                    }
               

                }
                
                
               
                if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    $this->loadModel('Fournisseurresponsables');
                            //debug($this->request->getData('data')['ligne']);die;
                   foreach ($this->request->getData('data')['ligne'] as $i => $responsable) {
                       
                        $dataa['name'] = $responsable['name'];
		         $dataa['mail'] = $responsable['mail'];
		        $dataa['tel'] = $responsable['tel'];
		        $dataa['poste'] = $responsable['poste'];
                           $dataa['fournisseur_id'] = $fournisseur_id;
                           //debug($dataa);die;
                         $fournisseurresponsables = $this->fetchTable('Fournisseurresponsables')->newEmptyEntity();
                           // debug($fournisseurresponsables);die;
                           $fournisseurresponsables = $this->Fournisseurresponsables->patchEntity($fournisseurresponsables, $dataa);
//                          debug($fournisseurresponsables);die;
                          if ($this->Fournisseurresponsables->save( $fournisseurresponsables)) {
//                              debug('rrr');
                             //   $this->Flash->success("fournisseurresponsables has been created successfully");
                       } else {
                            $this->Flash->error("Failed to create fournisseurresponsables");
                            }
                       
                        $this->set(compact("fournisseurresponsables"));
                  }   
               }


                
                
                        if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                       $this->loadModel('Fournisseurbanques');
                  
                  foreach ($this->request->getData('data')['ligner'] as $i => $banque) {
//                                if($banque['sup1']!=1){
                                $data1['banque_id'] = $banque['banque_id'];
			        $data1['agence'] = $banque['agence'];
				$data1['code_banque'] = $banque['code_banque'];
				$data1['swift'] = $banque['swift'];
				$data1['compte'] = $banque['compte'];
				$data1['rib'] = $banque['rib'];
				$data1['document'] = $banque['document'];
                                $data1['fournisseur_id'] = $fournisseur_id;
                            $fb = $this->fetchTable('Fournisseurbanques')->newEmptyEntity();//fetchtable pour creer une ligne vide avant de la remplir
                            
                            $fb = $this->Fournisseurbanques->patchEntity($fb, $data1);
                             //debug($fb);die();
                            if ($this->Fournisseurbanques->save( $fb)) {
                               
                            //  $this->Flash->success("fournisseurbanques has been created successfully");
                            }
                             else {
                               $this->Flash->error("Failed to create fournisseurbanques");
                            }
                        
                        $this->set(compact("fb"));
                    
                }
}

                        if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {
                           $this->loadModel('Exonerations');
				foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
				//	debug($exon);
					if($exon['sup2']!=1){
					$data2['typeexon_id'] = $exon['typeexon_id'];
					$data2['num_att_taxes'] = $exon['num_att_taxes'];
					$data2['date_debut'] = $exon['date_debut'];
					$data2['date_fin'] = $exon['date_fin'];
					$data2['document'] = $exon['document'];
                                        $data2['fournisseur_id'] = $fournisseur_id;
					 $exonerations = $this->fetchTable('Exonerations')->newEmptyEntity();
                            $exonerations= $this->Exonerations->patchEntity($exonerations, $data2);
                            if ($this->Exonerations->save($exonerations)) {
                          //    $this->Flash->success("exonerations has been created successfully");
                            }
                            } else {
                               $this->Flash->error("Failed to create exonerations");
                            }
                        
                        $this->set(compact("exonerations"));
                    
                }
}

              //  $this->Flash->success(__('The fournisseur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fournisseur could not be saved. Please, try again.'));
            }
        }
        $banques= $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $typeexonerations = $this->Fournisseurs->Typeexons->find('list',['limit' => 200]);
        $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list', ['limit' => 200]);
        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['limit' => 200]);
        $villes = $this->Fournisseurs->Villes->find('list', ['limit' => 200]);
        $regions = $this->Fournisseurs->Regions->find('list', ['limit' => 200]);
        $pays = $this->Fournisseurs->Pays->find('list', ['limit' => 200]);
        $paiements = $this->Fournisseurs->Paiements->find('list', ['limit' => 200]);
        $devises = $this->Fournisseurs->Devises->find('list', ['limit' => 200]);
        $this->set(compact('banques','fournisseur','typeexonerations','typeutilisateurs', 'typelocalisations', 'villes', 'regions', 'pays', 'paiements', 'devises'));
        

        
    }

    /**
     * Edit method
     *
     * @param string|null $id Fournisseur id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    
    
    
    
    
    
  
    
    
    
    
    
//   public function view($id = null)
//    {
//        $bondereservation = $this->Bondereservations->get($id, [
//            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Commandeclients', 'Lignebondereservations'],
//        ]);
//        $bondereservation_id = $bondereservation->id;
//        $this->loadModel('Lignebondereservations');
//        $this->loadModel('Articles');
//        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
//        $lignebondereservations = $this->Lignebondereservations->find('all', ['keyfield' => 'id', 'valueField' => 'id'])->where(["lignebondereservations.bondereservation_id like  '%" . $bondereservation_id . "%' "]);
//        $lignebondereservations = $this->paginate($lignebondereservations);
//        //debug($lignebondereservations);
//        //debug($lignebondereservations);
//        /* if (isset($lignebondereservations) && (!empty($lignebondereservations))) {
//            //debug($lignebondereservations);
//            //debug($this->request->getData('data')['tabligne2']);
//            //$this->loadModel('lignebondereservations');
//            // debug(($this->request->getData('data')));
//            foreach ($lignebondereservations as $i => $reservation) {
//                //debug($lignebondereservations);
//                debug($$reservation);
//                if ($reservation['sup'] != 1) {
//                    // debug($reservation);
//                    $data['quantite'] = $reservation['quantite'];
//                    $data['bondereservation_id'] = $bondereservation_id;
//                    $data['article_id'] = $reservation['article_id'];
//                    //debug($data);
//                    $lignebondereservation = $this->fetchTable('lignebondereservations')->newEmptyEntity();
//                    //debug($lignebondereservation);
//                    //$this->adresselivraisonclient->create();
//                    //$this->adresselivraisonclient->save($data);
//                    $lignebondereservation = $this->lignebondereservations->patchEntity($lignebondereservation, $data);
//                    //debug($lignebondereservation);
//                    if ($this->lignebondereservations->save($lignebondereservation)) {
//                        $this->Flash->success("lignebondereservations has been created successfully");
//                    } else {
//                        $this->Flash->error("Failed to create lignebondereservations");
//                    }
//                }
//                $this->set(compact("lignebondereservation"));
//            }
//        }*/
//        //debug($lignebondereservations);
//        //debug($articles);
//        //$this->set(compact('artreserver', 'articles', 'exercices', 'utilisateurs'));
//        $this->set(compact('bondereservation', 'lignebondereservations', 'articles'));
//    } 
//  
    
    
    
    
    
    public function edit($id = null)
    {
        
        $this->loadModel('Exonerations');
        $exonerations=array();
	$exonerations[0]='exonoré';
	$exonerations[1]='non exonoré';
        $this->set(compact('exonerations'));
        $fournisseur = $this->Fournisseurs->get($id,[
            'contain' => ['Adresselivraisonfournisseurs','Exonerations','Fournisseurbanques','Fournisseurresponsables']
        ]); //debug($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData('data')['lignes']);die;
           // debug($this->request->getData('data')['lignead']);
            
          // debug($this->request->getData());die;
            //die;demandeoffredeprix_id
            
            $fournisseur = $this->Fournisseurs->patchEntity($fournisseur,$this->request->getData() );
        
            if ($this->Fournisseurs->save($fournisseur)) {
                    $fournisseur_id = $fournisseur->id;
                if (isset($this->request->getData('data')['lignead']) && (!empty($this->request->getData('data')['lignead']))) {
                    foreach ($this->request->getData('data')['lignead'] as $i => $adresseliv) {
                       //debug($adresseliv);
                        //die;
                        $this->loadModel('Adresselivraisonfournisseurs');
                           if ($adresseliv['sup0'] != 1) {
                            $data['adresse'] = $adresseliv['adresse'];
                            $data['fournisseur_id'] = $id;
                         //debug($data);
                            if (isset($adresseliv['id']) && (!empty($adresseliv['id']))) {
                                $adresselivraisonfournisseur = $this->fetchTable('Adresselivraisonfournisseurs')->get($adresseliv['id'], [
                                    'contain' => []
                                ]);
                                
                                //modif ici 
                          // $adresselivraisonfournisseur = $this->fetchTable('Adresselivraisonfournisseurs')->patchEntity($adresselivraisonfournisseur, $data);

                            } else {
                               // debug($data);
                               // die;
                                $adresselivraisonfournisseur = $this->fetchTable('Adresselivraisonfournisseurs')->newEmptyEntity();
                             $adresselivraisonfournisseur = $this->fetchTable('Adresselivraisonfournisseurs')->patchEntity($adresselivraisonfournisseur, $data);
 //debug($adresselivraisonfournisseur);
                                //die;
                            };


                            //debug($adresselivraisonclient);

                          // $adresselivraisonfournisseur = $this->fetchTable('adresselivraisonfournisseurs')->patchEntity($adresselivraisonfournisseur, $data);
                            // debug($adresselivraisonclient);

                            if ($this->fetchTable('Adresselivraisonfournisseurs')->save($adresselivraisonfournisseur)) {
                                // debug($adresselivraisonclient);
                             //   $this->Flash->success("adresselivraisonfournisseurs has been òodified successfully");
                            } else {


                                $this->Flash->error("Failed to midify adresselivraisonfournisseurs");
                            }
                    }
                    else {
                            //S  $this->request->allowMethod(['post', 'delete']);
                            $adresselivraisonfournisseur = $this->fetchTable('adresselivraisonfournisseurs')->get($adresseliv['id']);
                            $this->fetchTable('adresselivraisonfournisseurs')->delete($adresselivraisonfournisseur);
                        }
                      
                        
                      
                        
                    }
                }

                
                
                 $this->set(compact("adresselivraisonfournisseur")); 
              
                
                
                
                
 if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    //debug($this->request->getData('data')['clientresponsables']);
      $this->loadModel('Fournisseurresponsables');
                    foreach ($this->request->getData('data')['ligne'] as $i => $res) {
                        //debug($res);
                        // die;
                            if ($res['sup1'] != 1) {
                            $dat['name'] = $res['name'];
                            $dat['tel'] = $res['tel'];
                            $dat['mail'] = $res['mail'];
                            $dat['poste'] = $res['poste'];
                            $dat['fournisseur_id'] = $id;
                            //debug($dat);
                            if (isset($res['id']) && (!empty($res['id']))) {
                               $fournisseurresponsables = $this->fetchTable('Fournisseurresponsables')->get($res['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $fournisseurresponsables = $this->fetchTable('Fournisseurresponsables')->newEmptyEntity();
                            };



                        $fournisseurresponsables= $this->fetchTable('Fournisseurresponsables')->patchEntity( $fournisseurresponsables, $dat);
                            //debug($clientresponsable);

                            if ($this->fetchTable('Fournisseurresponsables')->save( $fournisseurresponsables)) {
                                // debug($clientresponsable);
                            //    $this->Flash->success("Fournisseurresponsables has been òodified successfully");
                            } else {


                                $this->Flash->error("Failed to midify clientresponsable");
                            }
                        
 }
  else {
                            //S  $this->request->allowMethod(['post', 'delete']);
                            $fournisseurresponsables = $this->fetchTable('Fournisseurresponsables')->get($res['id']);
                            $this->fetchTable('Fournisseurresponsables')->delete($fournisseurresponsables);
                        }
                      
                    }
                }
                  $this->set(compact("fournisseurresponsables"));
                   if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {
                           $this->loadModel('Exonerations');
                 foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
				//	debug($exon);
                      $exonerations = $this->fetchTable('Exonerations')->newEmptyEntity();
					if($exon['sup2']!=1){
					$data2['typeexon_id'] = $exon['typeexon_id'];
					$data2['num_att_taxes'] = $exon['num_att_taxes'];
					$data2['date_debut'] = $exon['date_debut'];
					$data2['date_fin'] = $exon['date_fin'];
					$data2['document'] = $exon['document'];
                                        $data2['fournisseur_id'] = $fournisseur_id;
                                          // if (isset($exon['id']) && ($exon['id']!='')) {
                                              $ligneExonerations = $this->Exonerations->find()->where(["fournisseur_id =".$fournisseur_id])->all();
                foreach ($ligneExonerations as $item) {
                     $this->Exonerations->delete($item);
                                        }//}
					
                            $exonerations= $this->Exonerations->patchEntity($exonerations, $data2);
                           
                            if ($this->Exonerations->save($exonerations)) {
                                // debug($exonerations);die;
                             $this->Flash->success("exonerations has been created successfully");
                            }
                            } else {
                               $this->Flash->error("Failed to create exonerations");
                            }
                        
                       // $this->set(compact("exonerations"));
                    
                }
//                      
//				foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
//                                      // debug($exon);//die;
//				//	debug($exon);
//					if($exon['sup2']!=1){
//					$exon['typeexon_id'] = $exon['typeexon_id'];
//					$exon['num_att_taxes'] = $exon['num_att_taxes'];
//					$exon['date_debut'] = $exon['date_debut'];
//					$exon['date_fin'] = $exon['date_fin'];
//					$exon['document'] = $exon['document'];
//                                        $exon['fournisseur_id'] = $fournisseur_id;
//                                        if (isset($exon['id']) && ($exon['id']!='')) {
//                                              $ligneExonerations = $this->Exonerations->find()->where(["fournisseur_id" => $id])->all();
//                foreach ($ligneExonerations as $item) {
//                     $this->Exonerations->delete($item);
//                                        }}
////                                      if (isset($exon['id']) && ($exon['id']!='')) {
////                                       //debug('aaaaa')   ;
////                               $exonerations = $this->fetchTable('Exonerations')->get($exon['id'], [
////                                    'contain' => []
////                                ]);
////                            } else {
//                             
//                                $exonerations = $this->fetchTable('Exonerations')->newEmptyEntity();
//                           //}
//
//                                        
//                            
//                              $exonerations=$this->fetchTable('Exonerations')->patchEntity($exonerations ,$exon);
//                            
//                                 if ($this->fetchTable('Exonerations')->save( $exonerations)) {
//                                      //  debug('bbbb')   ;die;
//                                // debug($clientresponsable);
//                               // $this->Flash->success("Exonerations has been òodified successfully");
//                            } else {
//
//
//                                $this->Flash->error("Failed to midify Exonerations");
//                            }
//                              
//                              
//                              
//                              
//                              
//                            
//                         }
//  else {
//                            //S  $this->request->allowMethod(['post', 'delete']);
//                            $exonerations = $this->fetchTable('Exonerations')->get($exon['id']);
//                            $this->fetchTable('Exonerations')->delete($exonerations);
//                        }
//                      
//                    }
                }
                  $this->set(compact("exonerations"));
                
                
                
                
                
                
                
                
                
                
                
                   if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $banque) {     
//                        debug($banque);die;
                           $this->loadModel('Fournisseurbanques');
  if ($banque['sup4'] != 1) {
                            $datee['banque_id'] = $banque['banque_id'];
                            $datee['agence'] = $banque['agence'];
                            $datee['code_banque'] = $banque['code_banque'];
                            $datee['swift'] = $banque['swift'];
                            $datee['compte'] = $banque['compte'];
                            $datee['rib'] = $banque['rib'];
                            $datee['document'] = $banque['document'];
                            $datee['fournisseur_id'] = $id;
                            //debug($banque['banque_id']);die;
                              //debug($datee);die;
                            if (isset($banque['id']) && (!Empty($banque['id']))) {
                               //debug($banque['id']);die();
                               $fournisseurbanques = $this->fetchTable('Fournisseurbanques')->get($banque['id'], [
                                    'contain' => []
                                ]);
                                //debug('rrr');
                            } else {
                                ////debug('uuu');
                                $fournisseurbanques  = $this->fetchTable('Fournisseurbanques')->newEmptyEntity();
                            };
                           //debug($datee);die();
                        $fournisseurbanques=$this->fetchTable('Fournisseurbanques')->patchEntity( $fournisseurbanques ,$datee);

                            if ($this->fetchTable('Fournisseurbanques')->save( $fournisseurbanques )) {
                              
                                //$this->Flash->success("Fournisseurbanques has been òodified successfully");
                            } else {
                                $this->Flash->error("Failed to midify fournisseurbanques");
                            }
                            
 }
 else {
                            //S  $this->request->allowMethod(['post', 'delete']);
                            $fournisseurbanques = $this->fetchTable('Fournisseurbanques')->get($banque['id']);
                            $this->fetchTable('Fournisseurbanques')->delete($fournisseurbanques);
                        }
                      
                                         }
                }

               // $this->Flash->success(__('The {0} has been saved.', 'Fournisseur'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fournisseur'));
        }
      
             $this->loadModel('Adresselivraisonfournisseurs');
              $this->loadModel('Fournisseurresponsables');
               $this->loadModel('Fournisseurbanques');
       $adressees = $this->Adresselivraisonfournisseurs->find('all', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(["Adresselivraisonfournisseurs.fournisseur_id like  '%" . $id . "%' "]);
       $responsable = $this->Fournisseurresponsables->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Fournisseurresponsables.fournisseur_id like  '%" . $id . "%' "]);
        $banquess = $this->Fournisseurbanques->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Fournisseurbanques.fournisseur_id = " . $id . ""]);
    $ban= $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
              $exoner=$this->Exonerations->find('all')->where(["Exonerations.fournisseur_id = " . $id . ""]);
    $typeexonerations = $this->Fournisseurs->Typeexons->find('list',['limit' => 200]); 
         
                
        
       
        $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list', ['limit' => 200]);
        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['limit' => 200]);
        $villes = $this->Fournisseurs->Villes->find('list', ['limit' => 200]);
        $regions = $this->Fournisseurs->Regions->find('list', ['limit' => 200]);
        $pays = $this->Fournisseurs->Pays->find('list', ['limit' => 200]);
        $paiements = $this->Fournisseurs->Paiements->find('list', ['limit' => 200]);
        $devises = $this->Fournisseurs->Devises->find('list', ['limit' => 200]);
        $this->set(compact('banquess','typeexonerations','fournisseur', 'exoner','ban','responsable','typeutilisateurs', 'typelocalisations', 'adressees','villes', 'regions', 'pays', 'paiements', 'devises'));
    }

//    public function edit($id = null)
//    {  
//          
//        $fournisseur = $this->Fournisseurs->get($id, [
//            'contain' => ['Typeutilisateurs', 'Fournisseurresponsables','Fournisseurbanques','Typelocalisations', 'Villes', 'Regions', 'Pays', 'Paiements', 'Devises', 'Adresselivraisonfournisseurs', 'Articlefournisseurs', 'Bandeconsultations', 'Commandes', 'Exonerations', 'Factures', 'Fournisseurbanques', 'Fournisseurresponsables', 'Lignebandeconsultations', 'Lignecommandes', 'Lignedemandeoffredeprixes', 'Lignefactures', 'Lignelignebandeconsultations', 'Lignelivraisons', 'Livraisons', 'Livraisonsanc']
//        ]);
//        
//     
//                
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            
//if ($this->Fournisseurs->save($fournisseur)) {
//    
//
//                   
//                 
////debug($this->request->data['lignes']);die;
//
//        } 
//             //debug($this->request->getData());die;
//            $fournisseur = $this->Fournisseurs->patchEntity($fournisseur, $this->request->getData());
//            if ($this->Fournisseurs->save($fournisseur)) {
//                $this->Flash->success(__('The {0} has been saved.', 'Fournisseur'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fournisseur'));
//        }
//        $typeutilisateurs = $this->Fournisseurs->Typeutilisateurs->find('list', ['limit' => 200]);
//        $typelocalisations = $this->Fournisseurs->Typelocalisations->find('list', ['limit' => 200]);
//        $villes = $this->Fournisseurs->Villes->find('list', ['limit' => 200]);
//        $regions = $this->Fournisseurs->Regions->find('list', ['limit' => 200]);
//        $pays = $this->Fournisseurs->Pays->find('list', ['limit' => 200]);
//        $paiements = $this->Fournisseurs->Paiements->find('list', ['limit' => 200]);
//        $devises = $this->Fournisseurs->Devises->find('list', ['limit' => 200]);
//        $this->set(compact('fournisseur', 'typeutilisateurs', 'typelocalisations', 'villes', 'regions', 'pays', 'paiements', 'devises'));
//    }

    
     
    
    
    

    /**
     * Delete method
     *
     * @param string|null $id Fournisseur id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
         $this->loadModel('Fournisseurbanques');
//          $lignedemande=$this->Fournisseurbanques->find('all', [])
//                ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);
//           foreach ($lignedemande as $c) {
//                $this->Demandeoffredeprixes->Lignedemandeoffredeprixes->delete($c);
//            }
        // $this->Fournisseurbanques->deleteAll(['Fournisseurbanques.fournisseur_id ='.$id]);
        $fournisseurbanque = $this->Fournisseurbanques->find('all',[])->where(['Fournisseurbanques.fournisseur_id ='.$id]);
        foreach ($fournisseurbanque as $c) {
        $this->Fournisseurbanques->delete($c);
        }
          $this->loadModel('Fournisseurresponsables');
        $fournisseurresponsable = $this->Fournisseurresponsables->find('all',[])->where(['Fournisseurresponsables.fournisseur_id ='.$id]);
         foreach ($fournisseurresponsable as $c) {
         $this->Fournisseurresponsables->delete($c);}
        $this->loadModel('Adresselivraisonfournisseurs');
        $adresselivraisonfournisseur = $this->Adresselivraisonfournisseurs->find('all',[])->where(['Adresselivraisonfournisseurs.fournisseur_id ='.$id]);
          foreach ($adresselivraisonfournisseur as $c) {
          $this->Adresselivraisonfournisseurs->delete($c);}
        $this->loadModel('Exonerations');
        $exoneration = $this->Exonerations->find('all',[])->where(['Exonerations.fournisseur_id ='.$id]);
             foreach ($adresselivraisonfournisseur as $c) {
             $this->Exonerations->delete($c);}
        $fournisseur = $this->Fournisseurs->get($id);
        if ($this->Fournisseurs->delete($fournisseur)) {
          //  $this->Flash->success(__('The {0} has been deleted.', 'Fournisseur'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Fournisseur'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

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
        $this->loadModel('Lignelivraisons');

        $lignes=$this->Lignelivraisons->find()->where(["Livraison_id"=>$id])->contain(['Articles'])->all();


        $this->set(compact('livraison','lignes'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $livraison = $this->Livraisons->newEmptyEntity();
        $last=$this->Livraisons->find()->order(['id'=>"desc"])->first();
        $numero=1;
        if ($last!=null) {
            preg_match_all('!\d+!', $last->numero, $numero);

            $numero=$numero[0][0];
        }
        if ($this->request->is('post')) {
            $livraison = $this->Livraisons->patchEntity($livraison, $this->request->getData());
            if ($this->Livraisons->save($livraison)) {
                $this->loadModel('Lignelivraisons');
                $articles_ids=$this->request->getData('articles_ids');
                $codefs=$this->request->getData('codef');
                $qtes=$this->request->getData('qte');
                $prixhts=$this->request->getData('prixht');
                $remises=$this->request->getData('remise');
                $prixunhts=$this->request->getData('prixunht');
                $fcodecs=$this->request->getData('fcodec');
                $tvas=$this->request->getData('tva');
                $ttcs=$this->request->getData('ttc');
                for ($i=0; $i <sizeof($articles_ids) ; $i++) { 
                    $ligne = $this->Lignelivraisons->newEmptyEntity();
                    $this->loadModel('Lignebonchargements');
                    $lignebonChar=$this->Lignebonchargements->find()->where(['article_id'=>$articles_ids[$i]])->order(['id'=>"DESC"])->first();
                    $qte=0;
                    if($lignebonChar!=null)
                    {
                        $qte=$lignebonChar->qte;
                        $lignebonChar->qte-=$qtes[$i];
                        $this->Lignebonchargements->save($lignebonChar);
                    }
                    $ligne->Livraison_id=$livraison->id;
                    $ligne->commande_id=$livraison->commande_id;
                    $ligne->fournisseur_id=$livraison->fournisseur_id;
                    $ligne->codefrs=$codefs[$i];
                    $ligne->article_id=$articles_ids[$i];
                    $ligne->qte=$qte;
                    $ligne->qteliv=$qtes[$i];
                    $ligne->remise=$remises[$i];
                    $ligne->fodec=$fcodecs[$i];
                    $ligne->tva=$tvas[$i];
                    $ligne->ttc=$ttcs[$i];
                    $ligne->prix=$prixhts[$i];
                    $ligne->ht=$prixunhts[$i];
                    $this->Lignelivraisons->save($ligne);
                }
                $this->misejour("Livraisons","add",$facture->id);

                $this->Flash->success(__('The {0} has been saved.', 'Livraison'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Livraison'));
        }
        $commandes = $this->Livraisons->Commandes->find('list', ['limit' => 200]);
        $factures = $this->Livraisons->Factures->find('list', ['limit' => 200]);
        $fournisseurs = $this->Livraisons->Fournisseurs->find('list', ['limit' => 200]);
        $adresselivraisonfournisseurs = $this->Livraisons->Adresselivraisonfournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Livraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Livraisons->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Livraisons->Materieltransports->find('list', ['limit' => 200]);
        $chauffeurs = $this->Livraisons->Personnels->find('list', ['limit' => 200])->where(['fonction_id'=>1]);

        $conffaieurs = $this->Livraisons->Personnels->find('list', ['limit' => 200])->where(['fonction_id'=>5]);;
        $this->loadModel('Articles');
        $articles=$this->Articles->find('all');
        $this->set(compact('numero','livraison','commandes','articles','factures', 'chauffeurs','conffaieurs','fournisseurs', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
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
        $this->loadModel('Lignelivraisons');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $livraison = $this->Livraisons->patchEntity($livraison, $this->request->getData());
            if ($this->Livraisons->save($livraison)) {
                $this->loadModel('Lignelivraisons');
                $articles_ids=$this->request->getData('articles_ids');
                $codefs=$this->request->getData('codef');
                $qtes=$this->request->getData('qte');
                $prixhts=$this->request->getData('prixht');
                $remises=$this->request->getData('remise');
                $prixunhts=$this->request->getData('prixunht');
                $fcodecs=$this->request->getData('fcodec');
                $tvas=$this->request->getData('tva');
                $ttcs=$this->request->getData('ttc');
                $lignes=$this->Lignelivraisons->find()->where(["Livraison_id"=>$id])->all();
                 foreach ($lignes as $item) {
                    $this->Lignelivraisons->delete($item);
                }
                for ($i=0; $i <sizeof($articles_ids) ; $i++) { 
                    $ligne = $this->Lignelivraisons->newEmptyEntity();
                    $this->loadModel('Lignebonchargements');
                    $lignebonChar=$this->Lignebonchargements->find()->where(['article_id'=>$articles_ids[$i]])->order(['id'=>"DESC"])->first();
                    $qte=0;
                    if($lignebonChar!=null)
                    {
                        $qte=$lignebonChar->qte;
                        $lignebonChar->qte-=$qtes[$i];
                        $this->Lignebonchargements->save($lignebonChar);
                    }
                    $ligne->Livraison_id=$livraison->id;
                    $ligne->commande_id=$livraison->commande_id;
                    $ligne->fournisseur_id=$livraison->fournisseur_id;
                    $ligne->codefrs=$codefs[$i];
                    $ligne->article_id=$articles_ids[$i];
                    $ligne->qte=$qte;
                    $ligne->qteliv=$qtes[$i];
                    $ligne->remise=$remises[$i];
                    $ligne->fodec=$fcodecs[$i];
                    $ligne->tva=$tvas[$i];
                    $ligne->ttc=$ttcs[$i];
                    $ligne->prix=$prixhts[$i];
                    $ligne->ht=$prixunhts[$i];
                    $this->Lignelivraisons->save($ligne);
                }
                $this->misejour("Livraisons","edit",$livraison->id);

                $this->Flash->success(__('The {0} has been saved.', 'Livraison'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Livraison'));
        }
        $commandes = $this->Livraisons->Commandes->find('list', ['limit' => 200]);

        $fournisseurs = $this->Livraisons->Fournisseurs->find('list', ['limit' => 200]);
        $adresselivraisonfournisseurs = $this->Livraisons->Adresselivraisonfournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Livraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Livraisons->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Livraisons->Materieltransports->find('list', ['limit' => 200]);
        $lignes=$this->Lignelivraisons->find()->where(["Livraison_id"=>$id])->all();
        $count=$this->Lignelivraisons->find()->where(["Livraison_id"=>$id])->count();

        $this->loadModel('Articles');
        $articles=$this->Articles->find('all');

        $this->set(compact('livraison','lignes','count','articles' ,'fournisseurs','commandes', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
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
        $this->misejour("Livraisons","delete",$facture->id);

        if ($this->Livraisons->delete($livraison)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Livraison'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Livraison'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function addFacture ($id=null)
    {
        $livraison = $this->Livraisons->get($id);
        $this->loadModel('Lignelivraisons');
        $lignes=$this->Lignelivraisons->find()->where(["Livraison_id"=>$id])->all();
        $count=$this->Lignelivraisons->find()->where(["Livraison_id"=>$id])->count();
        $this->loadModel('Articles');
        $articles=$this->Articles->find('all');

        $this->loadModel('Factures');
        $facture = $this->Factures->newEmptyEntity();
        $last_facture=$this->Factures->find()->order(['id'=>"desc"])->first();
        $numero=0;
        if ($last_facture!=null) {
            $numero=$last_facture->numero;
        }
        $this->loadModel('Lignefactures');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $facture = $this->Factures->patchEntity($facture, $this->request->getData());
            if ($this->Factures->save($facture)) {
                $this->loadModel('Lignefactures');
                $articles_ids=$this->request->getData('articles_ids');
                $codefs=$this->request->getData('codef');
                $qtes=$this->request->getData('qte');
                $prixhts=$this->request->getData('prixht');
                $remises=$this->request->getData('remise');
                $prixunhts=$this->request->getData('prixunht');
                $fcodecs=$this->request->getData('fcodec');
                $tvas=$this->request->getData('tva');
                $ttcs=$this->request->getData('ttc');
                $lignes=$this->Lignefactures->find()->where(["facture_id"=>$id])->all();
                for ($i=0; $i <sizeof($articles_ids) ; $i++) { 
                    $ligne = $this->Lignefactures->newEmptyEntity();
                    $this->loadModel('Lignebonchargements');
                    $lignebonChar=$this->Lignebonchargements->find()->where(['article_id'=>$articles_ids[$i]])->order(['id'=>"DESC"])->first();
                    $qte=0;
                    if($lignebonChar!=null)
                    {
                        $qte=$lignebonChar->qte;
                    }
                    $ligne->facture_id=$facture->id;
                    $ligne->fournisseur_id=$livraison->fournisseur_id;
                    $ligne->codefrs=$codefs[$i];
                    $ligne->article_id=$articles_ids[$i];
                    $ligne->qte=$qte;
                    $ligne->qteliv=$qtes[$i];
                    $ligne->remise=$remises[$i];
                    $ligne->fodec=$fcodecs[$i];
                    $ligne->tva=$tvas[$i];
                    $ligne->ttc=$ttcs[$i];
                    $ligne->prix=$prixhts[$i];
                    $ligne->ht=$prixunhts[$i];
                    $this->Lignefactures->save($ligne);
                }
                $livraison->facture_id=$facture->id;
                $this->Livraisons->save($livraison);

                $this->Flash->success(__('The {0} has been saved.', 'Facture'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Facture'));
        }

        $fournisseurs = $this->Livraisons->Fournisseurs->find('list', ['limit' => 200]);
        $adresselivraisonfournisseurs = $this->Livraisons->Adresselivraisonfournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Livraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Livraisons->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Livraisons->Materieltransports->find('list', ['limit' => 200]);
        $this->set(compact('numero','fournisseurs','pointdeventes','materieltransports','depots','cartecarburants','adresselivraisonfournisseurs','facture','lignes','count','livraison','articles'));
        $this->render('/Livraisons/facture');        
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Factures Controller
 *
 * @property \App\Model\Table\FacturesTable $Factures
 * @method \App\Model\Entity\Facture[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FacturesController extends AppController
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
         $materieltransport_id=$this->request->getQuery('materieltransport_id');
                  $pointdevente_id=$this->request->getQuery('pointdevente_id');
          $depot_id=$this->request->getQuery('depot_id');
         $cartecarburant_id=$this->request->getQuery('cartecarburant_id');
                  $annee=$this->request->getQuery('annee');
                  $conffaieur_id=$this->request->getQuery('conffaieur_id');
                  $chauffeur_id=$this->request->getQuery('chauffeur_id');
                  $fournisseur_id=$this->request->getQuery('fournisseur_id');

                  
                  
                   if (  $numero) {
               $cond2 = "Factures.numero like  '%" .   $numero . "%' ";
         }
           if (   $datedebut) {
               $cond3 = "Factures.date like  '%" .    $datedebut . "%' ";
         }     
           if (    $datefin) {
               $cond4 = "Factures.date like  '%" .     $datefin . "%' ";
         }     
           if (      $materieltransport_id) {
               $cond5 = "Factures.materieltransport_id like  '%" .       $materieltransport_id . "%' ";
         }     
           if (        $pointdevente_id) {
               $cond6 = "Factures.pointdevente_id like  '%" .         $pointdevente_id . "%' ";
         }    
          if (        $depot_id) {
               $cond7 = "Factures.depot_id like  '%" .         $depot_id . "%' ";
         }    
           if (        $cartecarburant_id) {
               $cond8 = "Factures.cartecarburant_id like  '%" .         $cartecarburant_id . "%' ";
         } 
         if (        $chauffeur_id) {
            $cond9 = "Factures.chauffeur like  '%" .         $chauffeur_id . "%' ";
      } 
      if (        $conffaieur_id) {
        $cond10 = "Factures.convoyeur like  '%" .         $conffaieur_id . "%' ";
  } 
  if (        $fournisseur_id) {
    $cond11 = "Factures.fournisseur_id like  '%" .         $fournisseur_id . "%' ";
} 
          $this->paginate = [
            'contain' => ['Fournisseurs', 'Adresselivraisonfournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports','Livraisons'],
        ];
          $commandes = $this->paginate($this->Factures);
        $fournisseurs = $this->Factures->Fournisseurs->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        $materieltransports = $this->Factures->Materieltransports->find('list',['keyfield' => 'id', 'valueField' => 'matricule']);
        $pointdeventes = $this->Factures->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Factures->Depots->find('list',['keyfield' => 'id', 'valueField' => 'name']);        
        //$livraisons = $this->paginate($this->Factures);
        $confaieurs= $this->Factures->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="5"'),'fields'=>array('Personnels.code','Personnels.nom','Personnels.prenom')));
        $chauffeurs=$this->Factures->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="1"')));
        $cartecarburants = $this->Factures->Cartecarburants->find('list',['keyfield' => 'id', 'valueField' => 'num']);
        $this->set(compact('confaieurs','commandes','fournisseurs','chauffeurs','materieltransports','pointdeventes','depots','cartecarburants'));
        
        
        
        $query = $this->Factures->find('all')->where([ $cond2, $cond3, $cond4,$cond5,$cond6,$cond7,$cond8,$cond9,$cond10,$cond11]); 

      
        $factures = $this->paginate($query);

        $this->set(compact('factures'));
    }

    /**
     * View method
     *
     * @param string|null $id Facture id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $facture = $this->Factures->get($id, [
            'contain' => ['Fournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports', 'Adresselivraisonfournisseurs', 'Livraisons', 'Lignefactures'],
        ]);

        $this->set(compact('facture'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $facture = $this->Factures->newEmptyEntity();
        $last_facture=$this->Factures->find()->order(['id'=>"desc"])->first();
        $numero=0;
        if ($last_facture!=null) {
            $numero=$last_facture->numero+1;
        }
        if ($this->request->is('post')) {
            $facture = $this->Factures->patchEntity($facture, $this->request->getData());
            if ($this->Factures->save($facture)) {
                $this->loadModel('Livraisons');
                $livraison=$this->Livraisons->get($facture->livraison_id);
                $livraison->facture_id=$facture->id;
                $this->Livraisons->save($livraison);
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
                    $this->loadModel('Lignefactures');
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
                    $ligne->qte=$qtes[$i];
                    $ligne->remise=$remises[$i];
                    $ligne->fodec=$fcodecs[$i];
                    $ligne->tva=$tvas[$i];
                    $ligne->ttc=$ttcs[$i];
                    $ligne->prix=$prixhts[$i];
                    $ligne->ht=$prixunhts[$i];
                    $this->Lignefactures->save($ligne);
                }
               
                $this->misejour("Factures","add",$facture->id);

                $this->Flash->success(__('The {0} has been saved.', 'Facture'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Facture'));
        }
        $fournisseurs = $this->Factures->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Factures->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factures->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Factures->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Factures->Materieltransports->find('list', ['limit' => 200]);
        $livraisons = $this->Factures->Livraisons->find('list', ['limit' => 200]);
        $adresselivraisonfournisseurs = $this->Factures->Adresselivraisonfournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('facture','numero','livraisons','fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports', 'adresselivraisonfournisseurs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Facture id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $facture = $this->Factures->get($id, [
            'contain' => ["Livraisons"]
        ]);
        $this->loadModel('Lignefactures');        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facture = $this->Factures->patchEntity($facture, $this->request->getData());
            if ($this->Factures->save($facture)) {
                $this->loadModel('Livraisons');
                $livraison=$this->Livraisons->get($facture->livraison_id);
                $livraison->facture_id=$facture->id;
                $this->Livraisons->save($livraison);

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
                foreach ($lignes as $item) {
                    $this->Lignefactures->delete($item);
                }
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
                    $ligne->qte=$qtes[$i];
                    $ligne->remise=$remises[$i];
                    $ligne->fodec=$fcodecs[$i];
                    $ligne->tva=$tvas[$i];
                    $ligne->ttc=$ttcs[$i];
                    $ligne->prix=$prixhts[$i];
                    $ligne->ht=$prixunhts[$i];
                    $this->Lignefactures->save($ligne);
                }
                $this->misejour("Factures","edit",$facture->id);

                $this->Flash->success(__('The {0} has been saved.', 'Facture'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Facture'));
        }
        $fournisseurs = $this->Factures->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Factures->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factures->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Factures->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Factures->Materieltransports->find('list', ['limit' => 200]);
        $adresselivraisonfournisseurs = $this->Factures->Adresselivraisonfournisseurs->find('list', ['limit' => 200]);
        $livraisons = $this->Factures->Livraisons->find('list', ['limit' => 200]);
        $lignes=$this->Lignefactures->find()->where(["facture_id"=>$id])->all();
        $count=$this->Lignefactures->find()->where(["facture_id"=>$id])->count();
        $this->loadModel('Articles');
        $articles=$this->Articles->find('all');

        $this->set(compact('livraisons','facture','lignes','count','articles' ,'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports', 'adresselivraisonfournisseurs'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Facture id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $facture = $this->Factures->get($id);
        $this->misejour("Factures","delete",$facture->id);

        if ($this->Factures->delete($facture)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Facture'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Facture'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getLigneLivraisons()
    {   
        $this->loadModel('Livraisons');
        $livraison = $this->Livraisons->get($_GET['livraison_id']);
        $this->loadModel('Lignelivraisons');
        $lignes=$this->Lignelivraisons->find()->where(["Livraison_id"=>$_GET['livraison_id']])->all();
        $count=$this->Lignelivraisons->find()->where(["Livraison_id"=>$_GET['livraison_id']])->count();
        $this->loadModel('Articles');
        $articles=$this->Articles->find('all');
        echo json_encode(array("lignes"=>$lignes,'count'=>$count,'articles'=>$articles,'livraison'=>$livraison,"success"=>true));   
        exit;  
    }
}

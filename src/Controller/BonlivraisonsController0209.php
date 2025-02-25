<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Bonlivraisons Controller
 *
 * @property \App\Model\Table\BonlivraisonsTable $Bonlivraisons
 * @method \App\Model\Entity\Bonlivraison[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BonlivraisonsController extends AppController
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
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';

        $cond8 = '';

        $cond9 = '';


        $numero = $this->request->getQuery('numero');
        $date = $this->request->getQuery('date');
        $clients_id = $this->request->getQuery('clients_id');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $depot_id = $this->request->getQuery('depot_id');
        $materieltransport_id = $this->request->getQuery('dmaterieltransport_id');
        $cartecarburant_id = $this->request->getQuery('cartecarburant_id');
        $cartecarburant_id = $this->request->getQuery('cartecarburant_id');
        $factureclient_id = $this->request->getQuery('factureclient_id');
        $adresselivraisonclient_id = $this->request->getQuery('adresselivraisonclient_id');

        if ($date) {
            $cond2 = "Bonlivraisons.date like  '%" . $date . "%' ";
        }
        if ($clients_id) {
            $cond3 = "Bonlivraisons.client_id like  '%" . $clients_id . "%' ";
        }
        if ($pointdevente_id) {
            $cond4 = "Bonlivraisons.pointdevente_id like  '%" . $pointdevente_id . "%' ";
        }
        if ($depot_id) {
            $cond5 = "Bonlivraisons.depot_id like  '%" . $depot_id . "%' ";
        }
        if ($materieltransport_id) {
            $cond6 = "Bonlivraisons.materieltransport_id like  '%" . $materieltransport_id . "%' ";
        }
        if ($cartecarburant_id) {
            $cond7 = "Bonlivraisons.cartecarburant_id like  '%" . $cartecarburant_id . "%' ";
        }
        if ($factureclient_id) {
            $cond8 = "Bonlivraisons.factureclient_id like  '%" . $factureclient_id . "%' ";
        }
        if ($adresselivraisonclient_id) {
            $cond9 = "Bonlivraisons.adresselivraisonclient_id like  '%" . $adresselivraisonclient_id . "%' ";
        }




        $this->loadModel('Personnels');


        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);


        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clientsoptions = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointsdeventesoptions = $this->Bonlivraisons->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Bonlivraisons->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $materieltransportsoptions = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $Cartecarburantsoptions = $this->Bonlivraisons->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);

        $Factureclientsoptions = $this->Bonlivraisons->Factureclients->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);

        $adresselivraisonclientsoptions = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);

        $query = $this->Bonlivraisons->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6]);




        $this->paginate = [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants', 'Factureclients', 'Adresselivraisonclients'],
        ];
        $bonlivraisons = $this->paginate($query);

        $this->set(compact('bonlivraisons', 'clientsoptions', 'pointsdeventesoptions', 'depotsoptions', 'materieltransportsoptions', 'Cartecarburantsoptions', 'Factureclientsoptions', 'adresselivraisonclientsoptions', 'chauffeurs', 'convoyeurs'));
    }

    /**
     * View method
     *
     * @param string|null $id Bonlivraison id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants',/* 'Chauffeurs', 'Convoyeurs',*/ 'Factureclients', 'Adresselivraisonclients', 'Commandeclients', 'Lignebonlivraisons'],
        ]);
        $this->loadModel('Lignebonlivraisons');
        $lignes=$this->Lignebonlivraisons->find()->where(["bonlivraison_id"=>$id])->contain(['Articles'])->all();
        $count=$this->Lignebonlivraisons->find()->where(["bonlivraison_id"=>$id])->count();
        $this->loadModel('Articles');
        $articles=$this->Articles->find('all');

        $this->set(compact('bonlivraison','lignes','articles','count'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $bonlivraison = $this->Bonlivraisons->newEmptyEntity();
        if ($this->request->is('post')) {
            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $this->request->getData());
            if ($this->Bonlivraisons->save($bonlivraison)) {
                $this->Flash->success(__('The {0} has been saved.', 'Bonlivraison'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
        }
        $this->loadModel('Personnels');


        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Bonlivraisons->Clients->find('list', ['limit' => 200]);
        $pointdeventes = $this->Bonlivraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonlivraisons->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['limit' => 200]);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
        $factureclients = $this->Bonlivraisons->Factureclients->find('list', ['limit' => 200]);
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['limit' => 200]);
        $this->set(compact('bonlivraison', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'convoyeurs', 'factureclients', 'adresselivraisonclients'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Bonlivraison id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Personnels');

        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Lignebonlivraisons');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $this->request->getData());
            if ($this->Bonlivraisons->save($bonlivraison)) {
                $lignes=$this->Lignebonlivraisons->find()->where(["bonlivraison_id"=>$id])->all();
                foreach ($lignes as $item) {
                   $this->Lignebonlivraisons->delete($item);
               }
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
                   $ligne = $this->Lignebonlivraisons->newEmptyEntity();
                   $this->loadModel('Lignebonchargements');
                   $lignebonChar=$this->Lignebonchargements->find()->where(['article_id'=>$articles_ids[$i]])->order(['id'=>"DESC"])->first();
                   $qte=0;
                   if($lignebonChar!=null)
                   {
                       $qte=$lignebonChar->qte;
                       $lignebonChar->qte-=$qtes[$i];
                   }
                   $ligne->bonlivraison_id=$bonlivraison->id;
                   $ligne->commandeclient_id=$bonlivraison->client_id;
                   $ligne->article_id=$articles_ids[$i];
                   $ligne->qte=$qte;
                   $ligne->quantiteliv=$qtes[$i];
                   $ligne->remise=$remises[$i];
                   $ligne->fodec=$fcodecs[$i];
                   $ligne->tva=$tvas[$i];
                   $ligne->ttc=$ttcs[$i];
                   $ligne->prixht=$prixhts[$i];
                   $ligne->punht=$prixunhts[$i];
                   $this->Lignebonlivraisons->save($ligne);
               }
                $this->Flash->success(__('The {0} has been saved.', 'Bonlivraison'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
        }
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Bonlivraisons->Clients->find('list', ['limit' => 200]);
        $pointdeventes = $this->Bonlivraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonlivraisons->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['limit' => 200]);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list', ['limit' => 200]);
        /* $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        $convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);*/
        $factureclients = $this->Bonlivraisons->Factureclients->find('list', ['limit' => 200]);
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['limit' => 200]);
        $lignes=$this->Lignebonlivraisons->find()->where(["bonlivraison_id"=>$id])->all();
        $count=$this->Lignebonlivraisons->find()->where(["bonlivraison_id"=>$id])->count();

        $this->loadModel('Articles');
        $articles=$this->Articles->find('all');

        $this->set(compact('articles','count','lignes','bonlivraison', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'convoyeurs',  'factureclients', 'adresselivraisonclients'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Bonlivraison id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bonlivraison = $this->Bonlivraisons->get($id);
        if ($this->Bonlivraisons->delete($bonlivraison)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Bonlivraison'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Bonlivraison'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Bonlivraison;
use App\Model\Entity\Lignebondereservation;
use App\Model\Table\BondetransfertsTable;

/**
 * Bondereservations Controller
 *
 * @property \App\Model\Table\BondereservationsTable $Bondereservations
 * @method \App\Model\Entity\Bondereservation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BondereservationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {


        $pointsdeventesoptions = $this->Bondereservations->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Bondereservations->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        /* $commandeclientsoptions = $this->Bondereservations->Commandeclients->find('list', ['keyfield' => 'id', 'valueField' => 'code']);*/
        $clientsoptions = $this->Bondereservations->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Contact']);
        $clients = $this->Bondereservations->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Contact']);





        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';

        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $datecreation = $this->request->getQuery('datecreation');
        $date = $this->request->getQuery('date');
        $depot_id = $this->request->getQuery('depot_id');
        $client_id = $this->request->getQuery('client_id');

        if ($pointdevente_id) {
            $cond2 = 'Bondereservations.pointdevente_id="' . $pointdevente_id . '"';
        }
        if ($datecreation) {
            $cond3 = 'Bondereservations.datecreation >= ' . "'" . $datecreation . " 00:00:00'";
        }
        if ($date) {
            $cond4 = 'Bondereservations.date <= ' . "'" . $date . " 23:59:59'";
        }
        if ($depot_id) {
            $cond5 = 'Bondereservations.depot_id="' . $depot_id . '"';
        }
        if ($client_id) {
            $cond6 = 'Bondereservations.client_id="' . $client_id . '"';
        }

        $query = $this->Bondereservations->find('all')->where([$cond2, $cond3, $cond4, $cond5, $cond6]);
        $this->paginate = [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', /*'Commandeclients'*/],
        ];
        $bondereservations = $this->paginate($query);
        $this->set(compact('bondereservations', 'pointsdeventesoptions', 'depotsoptions',/* 'commandeclientsoptions',*/ 'clientsoptions', 'pointdevente_id', 'datecreation', 'date', 'depot_id', 'client_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Bondereservation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('Lignebondereservations');


        $bondereservation = $this->Bondereservations->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots'],
        ]);
        $this->paginate = [
            'contain' => [''],
        ];
        $lignebondereservationss = $this->Lignebondereservations->find('all')->where(['Lignebondereservations.bondereservation_id ="' . $id . '"'])->contain(['Articles']);

        $this->set(compact('bondereservation', 'lignebondereservationss'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $query = $this->Bondereservations->find();
        $numero = $query->select(['numero' => $query->func()->max('Bondereservations.numero')]);

        foreach ($numero as $num) {

            $n = $num->numero;

            if (!empty($n)) {

                $lastnum = $n;

                $nume = @intval($lastnum) + 1;

                $var2 = strval($nume);

                $mm = str_pad($var2, 6, "0", STR_PAD_LEFT);
            } else {
                $mm = "000001";
            }
            $this->set(compact('mm'));
        }

      $bondereservation = $this->Bondereservations->newEmptyEntity(); 

        if ($this->request->is('post')) {
 
            $bondereservation = $this->Bondereservations->patchEntity($bondereservation, $this->request->getData());



            if ($this->Bondereservations->save($bondereservation))
            {


                $bondereservation_id = $bondereservation->id;
                if (isset($this->request->getData('data')['tabligne2']) && (!empty($this->request->getData('data')['tabligne2']))) {
                    $this->loadModel('Lignebondereservations');


                    foreach ($this->request->getData('data')['tabligne2'] as $i => $reservation) {

                        if ($reservation['sup'] != 1) {
                            $data['quantite'] = $reservation['quantite'];
                            $data['bondereservation_id'] = $bondereservation_id;
                            $data['article_id'] = $reservation['article_id'];
                         //   $data['qtestock'] = $reservation['qtestock'];




                            $lignebondereservation = $this->fetchTable('Lignebondereservations')->newEmptyEntity();

                            $lignebondereservation = $this->Lignebondereservations->patchEntity($lignebondereservation, $data);

                            if ($this->Lignebondereservations->save($lignebondereservation)) {
                            }
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);


                $this->Flash->success(__('bondereservation has been saved.'));
            }
        }

        $clients = $this->Bondereservations->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $pointdeventes = $this->Bondereservations->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bondereservations->Depots->find('list', ['limit' => 200]);
        $this->loadModel('Articles');

        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);

        $this->set(compact('bondereservation', 'clients', 'pointdeventes', 'depots',/* 'commandeclients',*/ 'articles', 'mm'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Bondereservation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $bondereservation = $this->Bondereservations->get($id, [
            'contain' => ['Lignebondereservations']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {


            $bondereservation = $this->Bondereservations->patchEntity($bondereservation, $this->request->getData());



            if ($this->Bondereservations->save($bondereservation)) {
                $bondereservation_id = $bondereservation->id;

                if (isset($this->request->getData('data')['tabligne2']) && (!empty($this->request->getData('data')['tabligne2']))) {
                    $this->loadModel('Lignebondereservations');


                    foreach ($this->request->getData('data')['tabligne2'] as $i => $reservation) {
                        if ($reservation['sup'] != 1) {
                            $data['quantite'] = $reservation['quantite'];
                            $data['bondereservation_id'] = $bondereservation_id;
                            $data['article_id'] = $reservation['article_id'];
                            $data['client_id'] = $id;
                         // $data['qtestock'] = $reservation['qtestock'];
                            $this->loadModel('Articles');


                            if (isset($reservation['id']) && (!empty($reservation['id']))) {


                                $lignebondereservation = $this->fetchTable('Lignebondereservations')->get($reservation['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignebondereservation = $this->fetchTable('lignebondereservations')->newEmptyEntity();
                            };


                            $lignebondereservation = $this->Lignebondereservations->patchEntity($lignebondereservation, $data);
                            if ($this->Lignebondereservations->save($lignebondereservation)) {

                                $this->Flash->success("lignebondereservations has been created successfully");
                            } else {


                                $this->Flash->error("Failed to create lignebondereservations");
                            }
                        } else {
                            $lignebondereservation  = $this->fetchTable('Lignebondereservations')->get($reservation['id']);
                            $this->fetchTable('Lignebondereservations')->delete($lignebondereservation);
                        }

                        $this->set(compact("lignebondereservation"));
                    }
                }



                $this->Flash->success(__('The {0} has been saved.', 'Bondereservation'));

                return $this->redirect(['action' => 'index']);
            }



            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bondereservation'));
        }
        $this->loadModel('Lignebondereservations');

        $clients = $this->Bondereservations->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Contact']);
        $pointdeventes = $this->Bondereservations->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bondereservations->Depots->find('list', ['limit' => 200]);
        $this->loadModel('Articles');

        $lignebondereservations = $this->Lignebondereservations->find('all')->where(["Lignebondereservations.bondereservation_id like  '%" . $id . "%' "])->contain(['Articles']);


        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);

        $this->set(compact('bondereservation', 'clients', 'pointdeventes', 'depots',/* 'commandeclients',*/ 'articles', 'lignebondereservations'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Bondereservation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
      $this->loadModel('Lignebondereservations');
        $this->request->allowMethod(['post', 'delete']);
        $bondereservation = $this->Bondereservations->get($id);
          $lignecommande=$this->Lignebondereservations->find('all', [])
                ->where(["Lignebondereservations.bondereservation_id  ='" . $id . "'"]);
           foreach ($lignecommande as $c) {
                $this->Bondereservations->Lignebondereservations->delete($c);
            }
        if ($this->Bondereservations->delete($bondereservation)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Bondereservation'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Bondereservation'));
        }

        return $this->redirect(['action' => 'index']);
    }



    public function imprimerrecherche()
    {


        $pointsdeventesoptions = $this->Bondereservations->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Bondereservations->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clientsoptions = $this->Bondereservations->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Contact']);




        //$cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';

        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $datecreation = $this->request->getQuery('datecreation');
        $date = $this->request->getQuery('date');
        $depot_id = $this->request->getQuery('depot_id');
        $client_id = $this->request->getQuery('client_id');

        if ($pointdevente_id) {
            $cond2 = 'Bondereservations.pointdevente_id="' . $pointdevente_id . '"';
        }
        if ($datecreation) {
            $cond3 = 'Bondereservations.datecreation >= ' . "'" . $datecreation . " 00:00:00'";
        }
        if ($date) {
            $cond4 = 'Bondereservations.date <= ' . "'" . $date . " 23:59:59'";
        }
        if ($depot_id) {
            $cond5 = 'Bondereservations.depot_id="' . $depot_id . '"';
        }
        if ($client_id) {
            $cond6 = 'Bondereservations.client_id="' . $client_id . '"';
        }
        $query = $this->Bondereservations->find('all')->where([$cond2, $cond3, $cond4, $cond5, $cond6]);
        $this->paginate = [
            'contain' => ['Clients', 'Pointdeventes', 'Depots'/*, 'Commandeclients'*/],
        ];
        $bondereservationss = $this->paginate($query);

        $this->set(compact('bondereservationss'));
    }
    public function imprimer($id)
    {


        $this->loadModel('Lignebondereservations');

        $this->loadModel('clients');

        $clients = $this->Bondereservations->Clients->find('list', ['limit' => 200])->all();
        $this->loadModel('Articles');

        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'commantaire']);

        $lignebondereservationss = $this->Lignebondereservations->find('all')->where(['Lignebondereservations.bondereservation_id ="' . $id . '"'])->contain(['Articles']);

        $bondereservationss = $this->Bondereservations->find('all')->where(['Bondereservations.id ="' . $id . '"']);
        $this->paginate = [
            'contain' => ['Clients'],
        ];
        $bondereservationss = $this->paginate($bondereservationss);
        $this->set(compact('lignebondereservationss', 'bondereservationss', 'articles'));
    }
}

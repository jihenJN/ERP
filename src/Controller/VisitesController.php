<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Visites Controller
 *
 * @property \App\Model\Table\VisitesTable $Visites
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VisitesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index22012025()
    {
        $this->paginate = [
            'contain' => ['Clients', 'Demandeclients'],
        ];
        $visites = $this->paginate($this->Visites);

        $this->set(compact('visites'));
    }
    public function index()
    {
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $visite='';
        $nbreJoursRestant =0;

        $datedebut = $this->request->getQuery('datedebut');
        // debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        // debug($datefin);
        $client_id = $this->request->getQuery('client_id');
        $numero = $this->request->getQuery('numero');


        if ($datedebut) {
            $cond2 = "date(Visites.datecontact)   >= '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "date(Visites.datecontact ) <=  '" . $datefin . "' ";
        }
        if ($client_id) {
            $cond4 = "Visites.client_id = '" . $client_id . "' ";
        }
        
        // Check if filtering by 'numero'
        if ($numero) {
            $query = $this->Visites->find()
                ->contain(['Clients', 'Commercials', 'TypeContacts'])
                ->where(['Visites.numero' => $numero]);

            $visite = $query->first();

            if ($visite) {
                $currentDate = new \DateTime();
                $datePrevu = $visite->dateplanifie ? new \DateTime($visite->dateplanifie->toDateString()) : null;
                $dateVisite = $visite->date_visite ? new \DateTime($visite->date_visite->toDateString()) : null;

                if ($datePrevu && $datePrevu > $currentDate && !$dateVisite) {
                    $interval = $datePrevu->diff($currentDate);
                    $nbreJoursRestant = $interval->days;
                }
            }

            if ($query->isEmpty()) {
                $this->Flash->error(__('There is no visit with number {0}', h($numero)));
            } else {
                $title = 'Nbre jour(s) Reste pour la visite N° ' . h($numero);
            }
        } else {
            $query = $this->Visites->find('all')
                ->where([$cond2, $cond3, $cond4])
                ->order(['Visites.id' => 'DESC']);
        }

        $this->paginate = [
            'contain' => ['Clients', 'Demandeclients','TypeContacts','Commercials'],
        ];
     
        $visites = $this->paginate($query);

        $this->set(compact('visites'));
        // debug($factureclients);
        $count = $query->count();
        ///debug($count);

        $clients = $this->Visites->Clients->find('all'); //->where(["Clients.etat" => 'TRUE']);

         // Calculate total visits
         $totalVisites = $this->Visites->find()->count();

        // Calculate completed visits (where date_visite is not null)
        $completedVisites = $this->Visites->find()
        ->where(['date_visite IS NOT' => null])
        ->count();

        // Calculate pending visits (where date_visite is null)
        $pendingVisites = $totalVisites - $completedVisites;

         // Calculate delayed visits (where date_visite is later than dateplanifie)
         $delayedVisites = $this->Visites->find()
         ->where(['date_visite > dateplanifie'])
         ->count();

        // Calculate Taux de retard
        $tauxRetard = ($totalVisites > 0) ? ($delayedVisites / $totalVisites) * 100 : 0;

         // Calculate Taux de reponse
         $tauxReponse = ($totalVisites > 0 )? ($completedVisites / $totalVisites) * 100 : 0;


          // Fetch the list of TypeContacts
          $typeContacts = $this->Visites->TypeContacts->find()
            ->select(['id', 'libelle']) // Select id and libelle
            ->all()
            ->combine('id', 'libelle') // Convert to associative array [id => libelle]
            ->toArray();
 

          // Prepare data: Get visit counts grouped by type_contact_id
          $typeContactsCounts = $this->Visites->find()
              ->select([
              'type_contact_id', 
              'nbre_visites' => $this->Visites->find()->func()->count('*')])
              ->group('type_contact_id')
              ->toArray();
  
          // Convert counts to an associative array [type_contact_id => nbre_visites]
          $typeContactsCountsMap = [];
          foreach ($typeContactsCounts as $row) {
              $typeContactsCountsMap[$row->type_contact_id] = $row->nbre_visites;
          }

      
  
          // Prepare data array
          $typeContactsData = [];
          foreach ($typeContacts as $id => $name) {
              $typeContactsData[] = [
                  'type_contact' => $name,
                  'nbre_visites' => isset($typeContactsCountsMap[$id]) ? $typeContactsCountsMap[$id] : 0
              ];
          }
  
        $this->set(compact('visites', 'count', 'clients', 'datefin', 'client_id', 'datedebut','totalVisites', 'completedVisites', 'pendingVisites', 'tauxRetard','tauxReponse','typeContactsData','nbreJoursRestant','visite'));
    }
    /**
     * View method
     *
     * @param string|null $id Visite id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view22012025($id = null)
    {
        $visite = $this->Visites->get($id, [
            'contain' => ['Clients', 'Demandeclients'],
        ]);

        $this->set(compact('visite'));
    }
    public function view($id = null)
    {

        $listetypeIds = [];  // Initialize to avoid undefined variable error
        $listetypecomteIds = []; 
        $listetypedemandes = []; 
        $typedemandes = [];
        // Configure::write('debug', false);
        $visite = $this->Visites->get($id, [
            'contain' => ['Clients', 'Demandeclients','TypeContacts'],
        ]);
        $client_id = $visite->client_id;
        if (!empty($client_id)) {
            $clients = $this->fetchTable('Clients')->find('all')->where(['Clients.id' => $client_id])->first();
            // debug($clients);
        }



        // $typedemandes = $this->fetchTable('Typedemandes')->find('list', ['limit' => 200])->all();
        $compterendus = $this->fetchTable('Compterendus')->find('list')->toArray();



        $listecompterendus = $this->fetchTable('Listecompterendus')
            ->find('all')

            ->where(['Listecompterendus.visite_id' => $visite->id])
            // ->enableHydration(false)
            ->toList();
        if (!empty($listecompterendus)) {
            $listetypecomteIds = array_column($listecompterendus, 'compterendu_id');
        }

        $listebesoins = $this->fetchTable('Listetypebesoins')
            ->find('all')

            ->where(['Listetypebesoins.visite_id' => $visite->id])
            // ->enableHydration(false)
            ->toList();
        if (!empty($listebesoins)) {
            $listetypeIds = array_column($listebesoins, 'typebesoin_id');
        }
        $typebesoins = $this->fetchTable('Typebesoins')->find('list')->toArray();
        // debug($familles) ;
        // var_dump($listetypeIds);
        //, ['keyfield' => 'id', 'valueField' => 'Nom']);
        $this->set(compact('visite', 'listecompterendus', 'compterendus', 'listebesoins', 'listetypeIds', 'clients', 'listebesoins', 'listetypecomteIds', 'typebesoins', 'listetypedemandes', 'typedemandes'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add22022025()
    {
        $visite = $this->Visites->newEmptyEntity();
        if ($this->request->is('post')) {
            $visite = $this->Visites->patchEntity($visite, $this->request->getData());
            if ($this->Visites->save($visite)) {
                $this->Flash->success(__('The visite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visite could not be saved. Please, try again.'));
        }
        $clients = $this->Visites->Clients->find('list', ['limit' => 200])->all();
        $demandeclients = $this->Visites->Demandeclients->find('list', ['limit' => 200])->all();
        $this->set(compact('visite', 'clients', 'demandeclients'));
    }
    public function addvisite($id = null)
    {

        $this->loadModel('Listecompterendus');
        $this->loadModel('Compterendus');
        $visite = $this->Visites->newEmptyEntity();

        $num = $this->Visites->find()->select(["num" => 'MAX(Visites.numero)'])->first();
        // debug($num);
        $n = $num->num;
        $in = intval($n) + 1;
        $mm = str_pad("$in", 3, "0", STR_PAD_LEFT);

        // echo $mm;
        $demandeclient = $this->fetchTable('Demandeclients')->get($id, [
            'contain' => [],
        ]);
        $client_id = $demandeclient->client_id;
        $type_contact_id = $demandeclient->type_contact_id;
        $commercial_id = $demandeclient->commercial_id;
        if (!empty($client_id)) {
            $clients = $this->fetchTable('Clients')->find('all')->where(['Clients.id' => $client_id])->first();
            // debug($clients);
        }

        if (!empty($type_contact_id)) {
            $typeContacts = $this->fetchTable('TypeContacts')->find('all')->where(['TypeContacts.id' => $type_contact_id])->first();
            // debug($typeContacts);
        }

        if (!empty($type_contact_id)) {
            $commercials = $this->fetchTable('Commercials')->find('all')->where(['Commercials.id' => $commercial_id ])->first();
            // debug($commercials);
        }
        if ($this->request->is('post')) {
            // debug($this->request->getData());die;
            $document = $this->request->getData('piece');
            if ($document && $document->getClientFilename()) {
                $namedoc = $document->getClientFilename();
                $targetPath = WWW_ROOT . 'img' . DS . 'imgpersonnels' . $namedoc;
                $document->moveTo($targetPath);
                $data['piece'] = $namedoc;
            }


            $num = $this->Visites->find()->select(["num" => 'MAX(Visites.numero)'])->first();
            // debug($num);
            $n = $num->num;
            $in = intval($n) + 1;
            $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);

            $data['numero'] = $mm;

            $data['demandeclient_id'] = $id;
            $data['datecontact'] = $this->request->getData('datecontact');
            $data['dateplanifie'] = $this->request->getData('dateplanifie');
            $data['trdemande'] = $this->request->getData('trdemande');
            $data['description'] = $this->request->getData('description');
            $data['client_id'] = $this->request->getData('client_id');
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $data['type_contact_id'] = $this->request->getData('type_contact_id');

            // $data['commercial_id'] = $this->request->getData('commercial_id');
            // $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['descriptif'] = !empty($this->request->getData('descriptif')) ? $this->request->getData('descriptif') : null;
            if ($this->request->getData('datecptrendu')) {
                $data['datecptrendu'] = date('Y-m-d H:i:s', strtotime($this->request->getData('datecptrendu')));
            }

            $data['responsable'] = !empty($this->request->getData('responsable')) ? $this->request->getData('responsable') : null;
            $data['visiteur'] = $this->request->getData('visiteur');
            $data['tel'] = $this->request->getData('Tel');
            $data['adresse'] = $this->request->getData('Adresse');
            $visite = $this->Visites->patchEntity($visite, $data);

            if ($this->Visites->save($visite)) {
                $this->loadModel('Listetypebesoins');
                $besoinIds = $this->request->getData('typebesoins');
                $filterebesoinIds = array_filter($besoinIds);

                if (!empty($filterebesoinIds)) {
                    foreach ($filterebesoinIds as $typebesoin_id) {
                        $dataas = [
                            'visite_id' => $visite->id,
                            'typebesoin_id' => $typebesoin_id[0],
                        ];

                        $besoinlist = $this->Listetypebesoins->newEntity($dataas);
                        if ($this->Listetypebesoins->save($besoinlist)) {
                        } else {
                        }
                    }
                }

                ////////////////
                $this->loadModel('Listecompterendus');
                $compteIds = $this->request->getData('compterendus');
                $filterecompteIds = array_filter($compteIds);

                if (!empty($filterecompteIds)) {
                    foreach ($filterecompteIds as $compterendu_id) {
                        $dataa = [
                            'visite_id' => $visite->id,
                            'compterendu_id' => $compterendu_id[0],
                        ];

                        $comptelist = $this->Listecompterendus->newEntity($dataa);
                        if ($this->Listecompterendus->save($comptelist)) {
                        } else {
                        }
                    }
                }


                return $this->redirect(['action' => 'index']);
            }
        }
        $typebesoins = $this->fetchTable('Typebesoins')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $compterendus = $this->fetchTable('Compterendus')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('mm', 'typebesoins', 'visite', 'clients', 'compterendus','typeContacts','commercials'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Visite id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit22012025($id = null)
    {
        $visite = $this->Visites->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $visite = $this->Visites->patchEntity($visite, $this->request->getData());
            if ($this->Visites->save($visite)) {
                $this->Flash->success(__('The visite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visite could not be saved. Please, try again.'));
        }
        $clients = $this->Visites->Clients->find('list', ['limit' => 200])->all();
        $demandeclients = $this->Visites->Demandeclients->find('list', ['limit' => 200])->all();
        $this->set(compact('visite', 'clients', 'demandeclients'));
    }
    public function edit($id = null)

    {
        $listetypeIds = [];  // Initialize to avoid undefined variable error
        $listetypecomteIds = []; 
        $listetypedemandes = []; 
        $typedemandes = [];
       
        $this->loadModel('Listecompterendus');
        $this->loadModel('Compterendus');
        // Configure::write('debug', false);
        $visite = $this->Visites->get($id, [
            'contain' => ['Clients'],
        ]);
        $client_id = $visite->client_id;
        if (!empty($client_id)) {
            $clients = $this->fetchTable('Clients')->find('all')->where(['Clients.id' => $client_id])->first();
            // debug($clients);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {

            $document = $this->request->getData('piece');
            if ($document && $document->getClientFilename()) {
                $namedoc = $document->getClientFilename();
                $targetPath = WWW_ROOT . 'img' . DS . 'imgpersonnels' . $namedoc;
                $document->moveTo($targetPath);
                $data['piece'] = $namedoc;
            }




            $data['numero'] = $visite->numero;

            $data['demandeclient_id'] = $visite->demandeclient_id;
            $data['datecontact'] = $this->request->getData('datecontact');
            $data['dateplanifie'] = $this->request->getData('dateplanifie');
            $data['trdemande'] = $this->request->getData('trdemande');
            $data['description'] = $this->request->getData('description');
            $data['client_id'] = $this->request->getData('client_id');
            // $data['commercial_id'] = $this->request->getData('commercial_id');
            // $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['descriptif'] = !empty($this->request->getData('descriptif')) ? $this->request->getData('descriptif') : null;
            if ($this->request->getData('datecptrendu')) {
                $data['datecptrendu'] = date('Y-m-d H:i:s', strtotime($this->request->getData('datecptrendu')));
            }

            $data['responsable'] = !empty($this->request->getData('responsable')) ? $this->request->getData('responsable') : null;
            $data['visiteur'] = $this->request->getData('visiteur');
            $data['tel'] = $this->request->getData('Tel');
            $data['adresse'] = $this->request->getData('Adresse');
            $visite = $this->Visites->patchEntity($visite, $data);

            /////////////
            $this->loadModel('Listetypebesoins');
            $existingtypes = $this->Listetypebesoins->find()
                ->where(['visite_id' => $visite->id])
                ->toArray();
            foreach ($existingtypes as $existingtype) {
                $this->Listetypebesoins->delete($existingtype);
            }

            /////////////
            $this->loadModel('Listecompterendus');

            $existingcomps = $this->Listecompterendus->find()
                ->where(['visite_id' => $visite->id])
                ->toArray();
            foreach ($existingcomps as $ex) {
                $this->Listecompterendus->delete($ex);
            }




            if ($this->Visites->save($visite)) {
                $this->loadModel('Listetypebesoins');
                $besoinIds = $this->request->getData('typebesoins');
                $filterebesoinIds = array_filter($besoinIds);

                if (!empty($filterebesoinIds)) {
                    foreach ($filterebesoinIds as $typebesoin_id) {
                        $dataas = [
                            'visite_id' => $visite->id,
                            'typebesoin_id' => $typebesoin_id[0],
                        ];

                        $besoinlist = $this->Listetypebesoins->newEntity($dataas);
                        if ($this->Listetypebesoins->save($besoinlist)) {
                        } else {
                        }
                    }
                }

                ////////////////
                $this->loadModel('Listecompterendus');
                $compteIds = $this->request->getData('compterendus');
                $filterecompteIds = array_filter($compteIds);

                if (!empty($filterecompteIds)) {
                    foreach ($filterecompteIds as $compterendu_id) {
                        $dataa = [
                            'visite_id' => $visite->id,
                            'compterendu_id' => $compterendu_id[0],
                        ];

                        $comptelist = $this->Listecompterendus->newEntity($dataa);
                        if ($this->Listecompterendus->save($comptelist)) {
                        } else {
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The visite could not be saved. Please, try again.'));
        }
        // $typedemandes = $this->fetchTable('Typedemandes')->find('list', ['limit' => 200])->all();
        $compterendus = $this->fetchTable('Compterendus')->find('list')->toArray();

        $listecompterendus = $this->fetchTable('Listecompterendus')
            ->find('all')

            ->where(['Listecompterendus.visite_id' => $visite->id])
            // ->enableHydration(false)
            ->toList();
        if (!empty($listecompterendus)) {
            $listetypecomteIds = array_column($listecompterendus, 'compterendu_id');
        }

        $listebesoins = $this->fetchTable('Listetypebesoins')
            ->find('all')

            ->where(['Listetypebesoins.visite_id' => $visite->id])
            // ->enableHydration(false)
            ->toList();
        if (!empty($listebesoins)) {
            $listetypeIds = array_column($listebesoins, 'typebesoin_id');
        }
        $typebesoins = $this->fetchTable('Typebesoins')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // debug($familles) ;
        // var_dump($listetypeIds);
        //, ['keyfield' => 'id', 'valueField' => 'Nom']);

        $listetypedemandes = $this->fetchTable('Typedemandes')->find('list')->toArray();
$typedemandes = $this->fetchTable('Typedemandes')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->toArray();

        $this->set(compact('visite', 'listecompterendus', 'compterendus', 'listebesoins', 'listetypeIds', 'clients', 'listebesoins', 'listetypecomteIds', 'typebesoins', 'listetypedemandes', 'typedemandes'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Visite id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //  $this->request->allowMethod(['post', 'delete']);

        $this->loadModel('Listecompterendus');

        $existingcomps = $this->Listecompterendus->find()
            ->where(['visite_id' => $id])
            ->toArray();
        foreach ($existingcomps as $ex) {
            $this->Listecompterendus->delete($ex);
        }

        $this->loadModel('Listetypebesoins');
        $existingtypes = $this->Listetypebesoins->find()
            ->where(['visite_id' => $id])
            ->toArray();
        foreach ($existingtypes as $existingtype) {
            $this->Listetypebesoins->delete($existingtype);
        }
        $visite = $this->Visites->get($id);
        if ($this->Visites->delete($visite->id)) {
            // $this->Flash->success(__('The visite has been deleted.'));
        } else {
            //  $this->Flash->error(__('The visite could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

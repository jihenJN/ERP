<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;

/**
 * Demandeclients Controller
 *
 * @property \App\Model\Table\DemandeclientsTable $Demandeclients
 * @method \App\Model\Entity\Demandeclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DemandeclientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    public function index()
    {
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';

        $datedebut = $this->request->getQuery('datedebut');
        // debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        // debug($datefin);
        $client_id = $this->request->getQuery('client_id');

        if ($datedebut) {
            $cond2 = "date(Demandeclients.dateconsulation)   >= '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "date(Demandeclients.dateconsulation ) <=  '" . $datefin . "' ";
        }
        if ($client_id) {
            $cond4 = "Demandeclients.client_id = '" . $client_id . "' ";
        }

        $query = $this->Demandeclients->find('all')->where([$cond2, $cond3, $cond4])


            ->order(['Demandeclients.id' => 'DESC']);

        $this->paginate = [
            'contain' => ['Clients', 'Typedemandes'],
        ];
        $demandeclients = $this->paginate($query);

        $this->set(compact('demandeclients'));
        // debug($factureclients);
        $count = $query->count();
        ///debug($count);

        $clients = $this->Demandeclients->Clients->find('all'); //->where(["Clients.etat" => 'TRUE']);

        $this->set(compact('demandeclients', 'count', 'clients', 'datefin', 'client_id', 'datedebut'));
    }
    public function getsousfam()
    {
        $idf = $this->request->getQuery('id');
        $ind = $this->request->getQuery('ind');

        $query = $this->fetchTable('Sousfamille1s')->find('all')->where(['famille_id' => $idf]);

        $select = "
        <select name='data[ligner][$ind][sousfamille1_id]' id='sousfamille1_id$ind' table='ligner' champ='sousfamille1_id' class='form-control select2 sousfamille1_id' onchange='getArticles(this.value, $ind)'>
            <option value='' selected>Veuillez choisir !!</option>";
        foreach ($query as $q) {
            $select .= "<option value='" . $q->id . "'>" . $q->name . "</option>";
        }
        $select .= "</select>";

        echo json_encode(['select' => $select]);
        exit;
    }
    public function getarticles()
    {
        $ids = $this->request->getQuery('id');
        $ind = $this->request->getQuery('ind');

        $query = $this->fetchTable('Articles')->find('all')->where(['sousfamille1_id' => $ids]);

        $select = "
        <select name='data[ligner][$ind][article_id]' id='article_id$ind' table='ligner' champ='article_id' class='form-control select2 article_id' onchange='getUnites(this.value, $ind)'>
            <option value='' selected>Veuillez choisir !!</option>";
        foreach ($query as $q) {
            $select .= "<option value='" . $q->id . "'>" . $q->Code . ' ' . $q->Dsignation . "</option>";
        }
        $select .= "</select>";

        echo json_encode(['select' => $select]);
        exit;
    }
    public function getunites()
    {
        $ida = $this->request->getQuery('id');
        $ind = $this->request->getQuery('ind');
        $arti = $this->fetchTable('Articles')->find('all')->where(['id' => $ida])->first();

        $query = $this->fetchTable('Unites')->find('all')->where(['Unites.id' => $arti->unite_id]);

        $select = "
    <select name='data[ligner][$ind][unite_id]' readonly id='unite_id$ind' table='ligner' champ='unite_id' class='form-control'>
        ";
        foreach ($query as $q) {
            $select .= "<option value='" . $q->id . "'>" . $q->name . "</option>";
        }
        $select .= "</select>";

        echo json_encode(['select' => $select]);
        exit;
    }

    public function add()
    {
        $this->loadModel('Clients');
        $this->loadModel('TypeContacts');
        $this->loadModel('Commercials');
        
        $datacl = $this->Clients->newEmptyEntity();
        $prefix = "4113";
        $maxLimit = $prefix . "9999"; // Limite supérieure 41199999

        // Rechercher le plus grand Code qui est en dessous de la limite
        $numeroobj = $this->Clients->find()
            ->select(["numerox" => 'MAX(Clients.Code)'])
            ->where(["Clients.Code <" => $maxLimit]) // Exclure les codes >= 41199999
            ->first();

        $lastCode = $numeroobj ? $numeroobj->numerox : null;

        if ($lastCode !== null) {
            $lastCodeAsString = strval($lastCode); // Convertir $lastCode en chaîne
            $lastNumber = intval(substr($lastCodeAsString, strlen($prefix))); // Extraire la partie numérique
            $newNumber = $lastNumber + 1;
            $code = $prefix . str_pad((string)$newNumber, 4, "0", STR_PAD_LEFT);
        } else {
            $code = $prefix . "0001";
        }
        if ($this->request->is('post')) {
            /// debug($this->request->getData());die;
            $prefix = "4113";
            $maxLimit = $prefix . "9999";

            // Rechercher le plus grand Code qui est en dessous de la limite
            $numeroobj = $this->Clients->find()
                ->select(["numerox" => 'MAX(Clients.Code)'])
                ->where(["Clients.Code <" => $maxLimit]) // Exclure les codes >= 41199999
                ->first();

            $lastCode = $numeroobj ? $numeroobj->numerox : null;

            if ($lastCode !== null) {
                $lastCodeAsString = strval($lastCode); // Convertir $lastCode en chaîne
                $lastNumber = intval(substr($lastCodeAsString, strlen($prefix))); // Extraire la partie numérique
                $newNumber = $lastNumber + 1;
                $code = $prefix . str_pad((string)$newNumber, 4, "0", STR_PAD_LEFT);
            } else {
                $code = $prefix . "0001";
            }
            $datacl->Code = $this->request->getData('Code');
            $datacl->Raison_Sociale = $this->request->getData('Raison_Sociale');
            $datacl->Tel = $this->request->getData('tel');
            $datacl->Fax = $this->request->getData('fax');
            $datacl->Adresse = $this->request->getData('Adresse');
            $datacl->Contact = $this->request->getData('portable');
            $datacl->Email = $this->request->getData('mail');
            $datacl->responsable = $this->request->getData('responsable');

            if ($this->Clients->save($datacl)) {
                $client_id = $datacl->id;

                $demande = $this->Demandeclients->newEmptyEntity();
                $demande->dateconsulation = $this->request->getData('dateconsulation');
                $demande->delaivoulu = $this->request->getData('delaivoulu');
                $demande->delaireponse = $this->request->getData('delaireponse');
                $demande->delaiapprov = $this->request->getData('delaiapprov');
                $demande->type_contact_id = (int) $this->request->getData('type_contact_id');
                $demande->commercial_id = (int) $this->request->getData('commercial_id');
                $demande->client_id = $client_id;
                $this->Demandeclients->save($demande);
                $this->loadModel('Listetypedemandes');
                $demandeIds = $this->request->getData('typedemandes')??[];
                $filteredemandeIds = array_filter($demandeIds);

                if (!empty($filteredemandeIds)) {
                    foreach ($filteredemandeIds as $typedemande_id) {
                        $dataa = [
                            'demandeclient_id' => $demande->id,
                            'typedemande_id' => $typedemande_id[0],
                        ];

                        $clientlist = $this->Listetypedemandes->newEntity($dataa);
                        if ($this->Listetypedemandes->save($clientlist)) {
                        } else {
                        }
                    }
                }

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $j => $p) {
                        //debug($p['prix']);die;
                        //die;

                        if ($p['sup'] != 1) {
                            $demand = $this->fetchTable('Lignedemandeclients')->newEmptyEntity();

                            //debug($clientarticle);
                            $data['demandeclient_id'] = $demande->id;
                            $data['famille_id'] = $p['famille_id'];

                            $data['sousfamille1_id'] = $p['sousfamille1_id'];
                            $data['article_id'] = $p['article_id'];
                            $data['numboite'] = $p['numboite'];
                            $data['unite_id'] = $p['unite_id'];
                            $data['qte'] = $p['qte'];
                            $data['exigence'] = $p['exigence'];
                            $lignedemande = $this->fetchTable('Lignedemandeclients')->patchEntity($demand, $data);
                            //debug($clientarticle);
                            $this->fetchTable('Lignedemandeclients')->save($lignedemande);


                            //    debug($ca);
                            //     die;

                        }
                    }
                }



                return $this->redirect(['action' => 'index']);
            }
        }

        $typedemandes = $this->fetchTable('Typedemandes')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('all'); //, ['keyfield' => 'id', 'valueField' => 'name']);
        $unites = $this->fetchTable('Unites')->find('all'); //, ['keyfield' => 'id', 'valueField' => 'name']);
        $familles = $this->fetchTable('Familles')->find('all'); //, ['keyfield' => 'id', 'valueField' => 'Nom']);
        $typeContacts = $this->TypeContacts->find('list',['keyfield' => 'id', 'valueField' => 'libelle'])->toArray();
        $commercials = $this->Commercials->find('list',['keyfield' => 'id', 'valueField' => 'name'])->toArray(); 
  
        $this->set(compact('familles', 'demande', 'code', 'sousfamille1s', 'unites', 'articles', 'typedemandes','typeContacts','commercials'));
    }
    /**
     * View method
     *
     * @param string|null $id Demandeclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view15012025($id = null)
    {
        $demandeclient = $this->Demandeclients->get($id, [
            'contain' => ['Clients', 'Typedemandes', 'Lignedemandeclients'],
        ]);

        $this->set(compact('demandeclient'));
    }
    public function view($id = null)
    {
        Configure::write('debug', false);
        $demandeclient = $this->Demandeclients->get($id, [
            'contain' => [],
        ]);
        $client_id = $demandeclient->client_id;
        if (!empty($client_id)) {
            $clients = $this->fetchTable('Clients')->find('all')->where(['Clients.id' => $client_id])->first();
            // debug($clients);
        }



        // $typedemandes = $this->fetchTable('Typedemandes')->find('list', ['limit' => 200])->all();
        $typedemandes = $this->fetchTable('Typedemandes')->find('list')->toArray();



        $listetypedemandes = $this->fetchTable('Listetypedemandes')
            ->find('all')

            ->where(['Listetypedemandes.demandeclient_id' => $demandeclient->id])
            // ->enableHydration(false)
            ->toList();
        if (!empty($listetypedemandes)) {
            $listetypedemandeIds = array_column($listetypedemandes, 'typedemande_id');
        }
        if (!empty($demandeclient->id)) {
            $lignedemandeclients = $this->fetchTable('Lignedemandeclients')->find('all')->where(['Lignedemandeclients.demandeclient_id' => $demandeclient->id])->toArray();
        }
        //  debug($listetypedemandeIds);
        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('all'); //, ['keyfield' => 'id', 'valueField' => 'name']);
        $unites = $this->fetchTable('Unites')->find('all'); //, ['keyfield' => 'id', 'valueField' => 'name']);

        $familles = $this->fetchTable('Familles')->find('all');
        // debug($familles) ;
        $articles = $this->fetchTable('Articles')->find('all');

        //, ['keyfield' => 'id', 'valueField' => 'Nom']);
        $this->set(compact('demandeclient', 'articles', 'sousfamille1s', 'unites', 'familles', 'lignedemandeclients', 'clients', 'listetypedemandeIds', 'listetypedemandes', 'typedemandes'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $demandeclient = $this->Demandeclients->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         $demandeclient = $this->Demandeclients->patchEntity($demandeclient, $this->request->getData());
    //         if ($this->Demandeclients->save($demandeclient)) {
    //             $this->Flash->success(__('The demandeclient has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The demandeclient could not be saved. Please, try again.'));
    //     }
    //     $clients = $this->Demandeclients->Clients->find('list', ['limit' => 200])->all();
    //     $typedemandes = $this->Demandeclients->Typedemandes->find('list', ['limit' => 200])->all();
    //     $this->set(compact('demandeclient', 'clients', 'typedemandes'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id Demandeclient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        Configure::write('debug', false);
        $demandeclient = $this->Demandeclients->get($id, [
            'contain' => [],
        ]);
        $client_id = $demandeclient->client_id;
        if (!empty($client_id)) {
            $clients = $this->fetchTable('Clients')->find('all')->where(['Clients.id' => $client_id])->first();
            // debug($clients);
        }


        if ($this->request->is(['patch', 'post', 'put'])) {
            ///demande
            $data['dateconsulation'] = $this->request->getData('dateconsulation');
            $data['delaivoulu'] = $this->request->getData('delaivoulu');
            $data['delaireponse'] = $this->request->getData('delaireponse');
            $data['delaiapprov'] = $this->request->getData('delaiapprov');
            $data['client_id'] = $clients->id;


            $demandeclient = $this->Demandeclients->patchEntity($demandeclient, $data);
            if ($this->Demandeclients->save($demandeclient)) {
                ///client
                $clients->Code = $this->request->getData('Code');
                $clients->Raison_Sociale = $this->request->getData('Raison_Sociale');
                $clients->Tel = $this->request->getData('tel');
                $clients->Fax = $this->request->getData('fax');
                $clients->Adresse = $this->request->getData('Adresse');
                $clients->Contact = $this->request->getData('portable');
                $clients->Email = $this->request->getData('mail');
                $clients->responsable = $this->request->getData('responsable');

                $this->fetchTable('Clients')->save($clients);
                //// liste demande 

                $this->loadModel('Listetypedemandes');

                // Supprimer toutes les associations trouvées
                $existingtypes = $this->Listetypedemandes->find()
                    ->where(['demandeclient_id' => $demandeclient->id])
                    ->toArray();
                foreach ($existingtypes as $existingtype) {
                    $this->Listetypedemandes->delete($existingtype);
                }
                ////////////insertion
                $this->loadModel('Listetypedemandes');
                $demandeIds = $this->request->getData('typedemandes');
                $filteredemandeIds = array_filter($demandeIds);

                if (!empty($filteredemandeIds)) {
                    foreach ($filteredemandeIds as $typedemande_id) {
                        $dataa = [
                            'demandeclient_id' => $demandeclient->id,
                            'typedemande_id' => $typedemande_id[0],
                        ];

                        $clientlist = $this->Listetypedemandes->newEntity($dataa);
                        if ($this->Listetypedemandes->save($clientlist)) {
                        } else {
                        }
                    }
                }

                /////lignedemande

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $j => $p) {
                        if ($p['sup'] != 1) {
                            $clientarticle = $this->fetchTable('Lignedemandeclients')->newEmptyEntity();
                            $data['demandeclient_id'] = $demandeclient->id;
                            $data['famille_id'] = $p['famille_id'];

                            $data['sousfamille1_id'] = $p['sousfamille1_id'];
                            $data['article_id'] = $p['article_id'];
                            $data['numboite'] = $p['numboite'];
                            $data['unite_id'] = $p['unite_id'];
                            $data['qte'] = $p['qte'];
                            $data['exigence'] = $p['exigence'];

                            if (isset($p['id']) && (!empty($p['id']))) {

                                $clientarticle = $this->fetchTable('Lignedemandeclients')->get($p['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientarticle = $this->fetchTable('Lignedemandeclients')->newEmptyEntity();
                            }
                            $clientarticle = $this->fetchTable('Lignedemandeclients')->patchEntity($clientarticle, $data);
                            if ($this->fetchTable('Lignedemandeclients')->save($clientarticle)) {
                            } else {
                            }
                        } else if ($p['sup'] == 1 && !empty($p['id'])) {

                            $clientarticle = $this->fetchTable('Lignedemandeclients')->get($p['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Lignedemandeclients')->delete($clientarticle);
                        }
                    }
                }
                // $this->Flash->success(__('The demandeclient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The demandeclient could not be saved. Please, try again.'));
        }
        // $typedemandes = $this->fetchTable('Typedemandes')->find('list', ['limit' => 200])->all();
        $typedemandes = $this->fetchTable('Typedemandes')->find('list')->toArray();



        $listetypedemandes = $this->fetchTable('Listetypedemandes')
            ->find('all')

            ->where(['Listetypedemandes.demandeclient_id' => $demandeclient->id])
            // ->enableHydration(false)
            ->toList();
        if (!empty($listetypedemandes)) {
            $listetypedemandeIds = array_column($listetypedemandes, 'typedemande_id');
        }
        if (!empty($demandeclient->id)) {
            $lignedemandeclients = $this->fetchTable('Lignedemandeclients')->find('all')->where(['Lignedemandeclients.demandeclient_id' => $demandeclient->id])->toArray();
        }
        //  debug($listetypedemandeIds);
        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('all'); //, ['keyfield' => 'id', 'valueField' => 'name']);
        $unites = $this->fetchTable('Unites')->find('all'); //, ['keyfield' => 'id', 'valueField' => 'name']);

        $familles = $this->fetchTable('Familles')->find('all');
        // debug($familles) ;
        $articles = $this->fetchTable('Articles')->find('all');

        //, ['keyfield' => 'id', 'valueField' => 'Nom']);
        $this->set(compact('demandeclient', 'articles', 'sousfamille1s', 'unites', 'familles', 'lignedemandeclients', 'clients', 'listetypedemandeIds', 'listetypedemandes', 'typedemandes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Demandeclient id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete15012025($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $demandeclient = $this->Demandeclients->get($id);
        if ($this->Demandeclients->delete($demandeclient)) {
            $this->Flash->success(__('The demandeclient has been deleted.'));
        } else {
            $this->Flash->error(__('The demandeclient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function delete($id = null)
    {


        ///////////user point////
        $this->loadModel('Listetypedemandes');
        $this->loadModel('Lignedemandeclients');
        $this->loadModel('Clients');


        $pp = $this->fetchTable('Listetypedemandes')->find('all', [])->where(['Listetypedemandes.demandeclient_id =' . $id]);
        foreach ($pp as $f) {
            $this->Listetypedemandes->delete($f);
        }
        //////////////////

        // $this->request->allowMethod(['post', 'delete']);
        $demandeclient = $this->Demandeclients->get($id);
        $client = $this->fetchTable('Clients')->find('all', [])->where(['Clients.id =' . $demandeclient->client_id])->first();
        if ($client) {
            $this->Clients->delete($client);
        }
        $lignedemande = $this->Lignedemandeclients->find('all')
            ->where(['Lignedemandeclients.demandeclient_id' => $id]);
        foreach ($lignedemande as $l) {
            $this->Lignedemandeclients->delete($l);
        }
        if ($this->Demandeclients->delete($demandeclient)) {
            // $user_id = ($this->Users->save($user)->id);
            // $this->misejour("Users", "delete", $user_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

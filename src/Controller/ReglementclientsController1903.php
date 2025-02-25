<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;


/**
 * Reglementclients Controller
 *
 * @property \App\Model\Table\ReglementclientsTable $Reglementclients
 * @method \App\Model\Entity\Reglementclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReglementclientsController extends AppController
{


    public function imprimret($id = null)
    {
        $this->viewBuilder()->setLayout('');
        $this->loadModel('Piecereglementclients');

        $pieces = $this->Piecereglementclients->get($id);
        $this->set(compact('pieces'));
    }
    public function etatreste()
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        // $reglementclient = $this->Reglementclients->newEmptyEntity();
        //debug($reglementclient);


        $factureclients = '';
        $livraisons = '';





        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list')->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list')->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list')->all();
        $this->loadModel('Banques');
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clientslist = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);

        $commerciallist = $this->fetchTable('Commercials')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        // $piece = $this->Piecereglementclients->find('all', ['']);
        //debug($piece->toArray());
        $cha = "TRUE";
        $offredeprix = $this->fetchTable('Bonlivraisons')->find('list', ['keyfield' => 'client_id', 'valueField' => 'client_id'])->where('Bonlivraisons.typebl=2')->toArray();

        if (!empty($offredeprix)) $idcl = implode(',', $offredeprix);
        //debug($this->request->getQuery('Client_id') );
        $condclient = '';
        $condcommercial = '';

        $cl_id = $this->request->getQuery('client_id');
        $com_id = $this->request->getQuery('commercial_id');
        if ($cl_id != null) {
            $condclient = 'Clients.id =' . $cl_id;
        }
        if ($com_id != null) {
            $condcommercial = 'Clients.commercial_id =' . $com_id;
        }



        if ($cl_id == null && $com_id == null) {
            $clients = $this->fetchTable('Clients')->find('all')->where('Clients.id IN (' . $idcl . ')');
        } else if ($cl_id != null || $com_id != null) {
            $clients = $this->fetchTable('Clients')->find('all')->where($condcommercial)->where($condclient);
        }
        // $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        // 'MAX(Timbres.timbre)'])->first();
        // $timbre = $tim->timbre;

        $this->set(compact('commerciallist', 'clientslist', 'commandes', 'caisses', 'banques', 'timbre', 'type', 'valeurs', 'carnetcheques', 'paiements', 'livraisons', 'factureclients', 'client_id',  'code', 'reglementclient', 'clients'));
    }

    public function imprimeetat()
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        // $reglementclient = $this->Reglementclients->newEmptyEntity();
        //debug($reglementclient);


        $factureclients = '';
        $livraisons = '';





        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list')->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list')->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list')->all();
        $this->loadModel('Banques');
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clientslist = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);

        $commerciallist = $this->fetchTable('Commercials')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        // $piece = $this->Piecereglementclients->find('all', ['']);
        //debug($piece->toArray());
        $cha = "TRUE";
        $offredeprix = $this->fetchTable('Bonlivraisons')->find('list', ['keyfield' => 'client_id', 'valueField' => 'client_id'])->where('Bonlivraisons.typebl=2')->toArray();

        if (!empty($offredeprix)) $idcl = implode(',', $offredeprix);
        //debug($this->request->getQuery('Client_id') );
        $condclient = '';
        $condcommercial = '';

        $cl_id = $this->request->getQuery('client_id');
        $com_id = $this->request->getQuery('commercial_id');
        if ($cl_id != null) {
            $condclient = 'Clients.id =' . $cl_id;
        }
        if ($com_id != null) {
            $condcommercial = 'Clients.commercial_id =' . $com_id;
        }



        if ($cl_id == null && $com_id == null) {
            $clients = $this->fetchTable('Clients')->find('all')->where('Clients.id IN (' . $idcl . ')');
        } else if ($cl_id != null || $com_id != null) {
            $clients = $this->fetchTable('Clients')->find('all')->where($condcommercial)->where($condclient);
        }
        // $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        // 'MAX(Timbres.timbre)'])->first();
        // $timbre = $tim->timbre;

        $this->set(compact('commerciallist', 'clientslist', 'commandes', 'caisses', 'banques', 'timbre', 'type', 'valeurs', 'carnetcheques', 'paiements', 'livraisons', 'factureclients', 'client_id',  'code', 'reglementclient', 'clients'));
    }


    public function imprimebon($type = null, $id = null)
    {
        $this->loadModel('Lignebonlivraisons');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        // $this->loadModel('Reglementclients');
        $reglement = $this->Reglementclients->get($id, ['contain' => ['Clients'],]);
        // debug($reglement);
        $clients = $this->Reglementclients->Clients->find('list', ['limit' => 200])->all();
        $this->set(compact('clients', 'reglement'));
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($type = null)
    {

        $this->paginate = [
            'contain' => ['Utilisateurs', 'Clients','Users'],
            'order' => [
                'id' => 'DESC'
            ],
        ];
        $reglementclients = $this->paginate($this->Reglementclients);


        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find()->where('Users.id=' . $user_id)->first();


        $condcommercial = '';
        if ($user['poste'] == 2) {
            $usercommercials = $this->fetchTable('Usercommercials')->find()->where('Usercommercials.user_id=' . $user_id);
            if ($usercommercials->count() > 0) {

                $commercialIds = [];
                foreach ($usercommercials as $usercommercial) {
                    $commercialIds[] = $usercommercial->commercial_id;
                }

                $commercialIdsString = implode(',', $commercialIds);



                $condcommercial = 'Clients.commercial_id IN (' . $commercialIdsString . ')';
            } else {
                $condcommercial = '1=0';
            }
        }

        $factures = $this->Reglementclients->find('all')->contain(['Clients','Users'])->where($condcommercial)->order(['Reglementclients.id' => 'DESC']);

        $bonlivraisons = $this->Reglementclients->find('all')->contain(['Clients','Users'])->where($condcommercial)->order(['Reglementclients.id' => 'DESC']);

        $this->set(compact('reglementclients', 'type', 'factures', 'bonlivraisons'));
    }

    /**
     * View method
     *
     * @param string|null $id Reglementclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($type = null, $id = null)
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        $reglement = $this->Reglementclients->get($id, [
            'contain' => [],
        ]);

    
        $cli = $reglement->client_id;
        //debug($id);

        $lignesreg = $this->Lignereglementclients->find('all')->where(['Lignereglementclients.reglementclient_id =' . $id]);
        //debug(($lignesreg->toArray())) ;die;

        $l = '(0';
        foreach ($lignesreg as  $li) {


            if ($li['factureclient_id'] != 0) {
                $l = $l . ',' . $li['factureclient_id'];
            } else if ($li['bonlivraison_id'] != 0) {
                $l = $l . ',' . $li['bonlivraison_id'];
            }
            else if ($li['commande_id'] != 0) {
                $l = $l . ',' . $li['commande_id'];
            }
        }
        $l = $l . ',0)';




        foreach ($lignesreg as $s => $si) {

            if ($si['factureclient_id'] != 0) {
                $s = $si['reglementclient_id'];
            } else if ($si['bonlivraison_id'] != 0) {
                $s = $si['reglementclient_id'];
            } else if ($si['commande_id'] != 0) {
                $s = $si['reglementclient_id'];
            }
        }
        $piecereglementclients = $this->Piecereglementclients->find('all')->where(['Piecereglementclients.reglementclient_id =' . $id]);
        $mtbon = 0.000;
        $mtfact = 0.000;




        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['factureclient_id'] != null) {
                $facreg[$ligne['factureclient_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else {
                $facreg[$ligne['bonlivraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
        }

        if ($cli != null) {
            $this->loadModel('Factureclients');
            $this->loadModel('Bonlivraisons');

            $connection = ConnectionManager::get('default');
            // $livraisons = $connection->execute("select * from bonlivraisons where ('bonlivraisons.commande_id=0' and bonlivraisons.client_id=" . $cli . " and bonlivraisons.typebl=2 and bonlivraisons.totalttc > bonlivraisons.Montant_Regler) OR (bonlivraisons.id in" . $l . ");")->fetchAll('assoc');
            //    $commandes = $this->fetchTable('Commandes')->find('all')->where(' (Commandes.client_id =' . $cli.' and Commandes.totalttc > Commandes.Montant_Regler )  OR (Commandes.id in' . $l . ')');
            $commandes = $this->fetchTable('Commandes')->find('all')->where('Commandes.id in' . $l);
            $livraisons = $connection->execute("select * from bonlivraisons where  bonlivraisons.typebl=2 and bonlivraisons.id in" . $l . ";")->fetchAll('assoc');

           
            //debug($livraisons->toArray());
        }


        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list')->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list')->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list')->all();
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all')->where(["Clients.etat='$cha'"]);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->loadModel('Banques');
        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $caisses = $this->fetchTable('Caisses')->find('list');
        


        $this->set(compact('commandes','caisses', 'timbre', 'banques', 'type', 's', 'id', 'mtfact', 'mtbon', 'facreg', 'piecereglementclients', 'lignesreg', 'valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients'));
    
    }



    public function addlibre($type = null, $client_id = null, $piece)
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        $reglementclient = $this->Reglementclients->newEmptyEntity();
        //debug($reglementclient);
        if ($this->request->is('post')) {


            $data['Date'] = $this->request->getData('Date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['Montant'] = $this->request->getData('data')['Reglementclient']['Montant'];
            $data['ttpayer'] = $this->request->getData('data')['Reglementclient']['ttpayer'];

            $data['libre'] = 1;

            if ($type == 1) {
                $data['type'] = 0;
            } else if ($type == 2) {
                $data['type'] = 1;
            }

            $numeroobj = $this->Reglementclients->find()->select(["numero" =>
            'MAX(Reglementclients.numeroconca)'])->first();
            $numero = $numeroobj->numero;
            if ($numero != null) {

                $n = $numero;
                $lastnum = $n;
                $nume = intval($lastnum) + 1;
                $nn = (string)$nume;
                $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
            } else {
                $code = "00001";
            }

            $data['numeroconca'] = $code;


            $reglement = $this->Reglementclients->patchEntity($reglementclient, $data);
            if ($this->Reglementclients->save($reglement)) {
                // debug($reglement);
                $reglement_id = $reglement->id;
                if (isset($this->request->getData('data')['Lignereglementclient']) && (!empty($this->request->getData('data')['Lignereglementclient']))) {
                    foreach ($this->request->getData('data')['Lignereglementclient'] as $i => $l) {

                        if (isset($l['factureclient_id'])) {

                            $ta = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $ta['reglementclient_id'] = $reglement_id;
                            $ta['factureclient_id'] = $l['factureclient_id'];
                            $ta['Montant'] = $l['Montanttt'];

                            $fact = $this->Factureclients->get($l['factureclient_id']);
                            $fact->Montant_Regler =  $fact->Montant_Regler + $l['Montanttt'];
                            $this->Factureclients->save($fact);
                            $this->fetchTable('Lignereglementclients')->save($ta);
                            // debug($ta);die;
                        }

                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabb['reglementclient_id'] = $reglement_id;
                            $tabb['bonlivraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = $l['Montanttt'];


                            $fact = $this->Bonlivraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler =  $fact->Montant_Regler + $l['Montanttt'];
                            $this->Bonlivraisons->save($fact);
                            $this->fetchTable('Lignereglementclients')->save($tabb);
                            //debug($tabb);die;

                        }

                        if (isset($l['commande_id'])) {
                            $tabb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabb['reglementclient_id'] = $reglement_id;
                            $tabb['commande_id'] = $l['commande_id'];
                            $tabb['Montant'] = $l['Montanttt'];
                            $this->fetchTable('Lignereglementclients')->save($tabb);
                            //debug($tabb);die;

                        }
                    }
                }

                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    //debug($this->request->getData('data')['pieceregelemnt']);
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglementclients')->newEmptyEntity();
                            $tab['reglementclient_id'] = $reglement_id;
                            $tab['paiement_id'] = $p['paiement_id'];
                            $tab['montant'] = $p['montant'];
                            $tab['to_id'] = $p['taux'];
                            $tab['montant_net'] = $p['montantnet'];
                            $tab['echance'] = $p['echance'];
                            $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                            $tab['num'] = $p['num_piece'];
                            $tab['banque_id'] = $p['banque'];
                            $tab['caisse_id'] = $p['caisse_id'];
                            $tab['porteurcheque'] = $p['porteurcheque'];
                            $tab['rib'] = $p['rib'];


                            $name =   $p['piecejointe']->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'reglementclient' . DS . $name;
                            if ($name) {
                                $p['piecejointe']->moveTo($targetPath);
                                $tab['piecejointe'] = $name;
                            };


                            $this->fetchTable('Piecereglementclients')->save($tab);
                            //debug($tab);die;

                        }
                    }
                }
                //  $this->Flash->success(__('The reglement has been saved.'));

                return $this->redirect(['action' => 'index/' . $type]);
            }
            // $this->Flash->error(__('The reglement could not be saved. Please, try again.'));
        }

        $factureclients = '';
        $livraisons = '';

        if ($client_id != null) {
            $this->loadModel('Factureclients');
            $this->loadModel('Bonlivraisons');
            $this->loadModel('Commandes');

            $this->loadModel('Clients');

            //debug($client_id);
            $compte = $this->Clients->find('all')->where(['Clients.id =' . $client_id])->first();
            //debug($compte->toArray());
            $c = $compte['Code'];
            //debug($c);

            $factureclients = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $client_id, 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            $livraisons = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.client_id =' . $client_id, 'Bonlivraisons.commande_id=0', 'Bonlivraisons.typebl=2', 'Bonlivraisons.totalttc > Bonlivraisons.Montant_Regler']);
            $commandes = $this->Commandes->find('all')->where(['Commandes.client_id =' . $client_id, 'Commandes.totalttc > Commandes.Montant_Regler']);
        }



        $numeroobj = $this->Reglementclients->find()->select(["numero" =>
        'MAX(Reglementclients.numeroconca)'])->first();
        $numero = $numeroobj->numero;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
        } else {
            $code = "00001";
        }


        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list')->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list')->where('type=0');
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list')->all();
        $this->loadModel('Banques');
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $piece = $this->Piecereglementclients->find('all', ['']);
        //debug($piece->toArray());
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all')->where(["Clients.etat='$cha'"]);

        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        $this->set(compact('piece', 'commandes', 'caisses', 'banques', 'timbre', 'type', 'valeurs', 'carnetcheques', 'paiements', 'livraisons', 'factureclients', 'client_id',  'code', 'reglementclient', 'clients'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($type = null, $client_id = null, $piece = null, $piece_id = null)
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');
        $result = $this->request->getAttribute('authentication')->getIdentity();

        $reglementclient = $this->Reglementclients->newEmptyEntity();
        //debug($reglementclient);
        if ($this->request->is('post')) {

            $data['user_id'] = $result['id'];

            $data['Date'] = $this->request->getData('Date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['Montant'] = $this->request->getData('data')['Reglementclient']['Montant'];
            $data['ttpayer'] = $this->request->getData('data')['Reglementclient']['ttpayer'];

            if ($type == 1) {
                $data['type'] = 0;
            } else if ($type == 2) {
                $data['type'] = 1;
            }

            $numeroobj = $this->Reglementclients->find()->select(["numero" =>
            'MAX(Reglementclients.numeroconca)'])->first();
            $numero = $numeroobj->numero;
            if ($numero != null) {

                $n = $numero;
                $lastnum = $n;
                $nume = intval($lastnum) + 1;
                $nn = (string)$nume;
                $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
            } else {
                $code = "00001";
            }

            $data['numeroconca'] = $code;


            $reglement = $this->Reglementclients->patchEntity($reglementclient, $data);
            if ($this->Reglementclients->save($reglement)) {
                // debug($reglement);
                $reglement_id = $reglement->id;
                if (isset($this->request->getData('data')['Lignereglementclient']) && (!empty($this->request->getData('data')['Lignereglementclient']))) {
                    foreach ($this->request->getData('data')['Lignereglementclient'] as $i => $l) {

                        if (isset($l['factureclient_id'])) {

                            $ta = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $ta['reglementclient_id'] = $reglement_id;
                            $ta['factureclient_id'] = $l['factureclient_id'];
                            $ta['Montant'] = $l['Montanttt'];

                            $fact = $this->Factureclients->get($l['factureclient_id']);
                            $fact->Montant_Regler =  $fact->Montant_Regler + $l['Montanttt'];
                            $this->Factureclients->save($fact);
                            $this->fetchTable('Lignereglementclients')->save($ta);
                            // debug($ta);die;
                        }

                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabb['reglementclient_id'] = $reglement_id;
                            $tabb['bonlivraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = $l['Montanttt'];


                            $fact = $this->Bonlivraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler =  $fact->Montant_Regler + $l['Montanttt'];
                            $this->Bonlivraisons->save($fact);
                            $this->fetchTable('Lignereglementclients')->save($tabb);
                            //debug($tabb);die;

                        }

                        if (isset($l['commande_id'])) {
                            $tabb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabb['reglementclient_id'] = $reglement_id;
                            $tabb['commande_id'] = $l['commande_id'];
                            $tabb['Montant'] = $l['Montanttt'];

                            //debug($tabb);die;
                            $fact = $this->fetchTable('Commandes')->get($l['commande_id']);
                            $fact->Montant_Regler =  $fact->Montant_Regler + $l['Montanttt'];
                            $this->fetchTable('Commandes')->save($fact);

                            $this->fetchTable('Lignereglementclients')->save($tabb);
                            

                        }
                    }
                }

                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    //debug($this->request->getData('data')['pieceregelemnt']);
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglementclients')->newEmptyEntity();
                            $tab['reglementclient_id'] = $reglement_id;
                            $tab['paiement_id'] = $p['paiement_id'];
                            $tab['montant'] = $p['montant'];
                            $tab['to_id'] = $p['taux'];
                            $tab['montant_net'] = $p['montantnet'];
                            $tab['echance'] = $p['echance'];
                            $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                            $tab['num'] = $p['num_piece'];
                            $tab['banque_id'] = $p['banque'];
                            $tab['caisse_id'] = $p['caisse_id'];
                            $tab['porteurcheque'] = $p['porteurcheque'];
                            $tab['rib'] = $p['rib'];


                            $name =   $p['piecejointe']->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'reglementclient' . DS . $name;
                            if ($name) {
                                $p['piecejointe']->moveTo($targetPath);
                                $tab['piecejointe'] = $name;
                            };


                            $this->fetchTable('Piecereglementclients')->save($tab);
                            //debug($tab);die;

                        }
                    }
                }
                //  $this->Flash->success(__('The reglement has been saved.'));

                return $this->redirect(['action' => 'index/' . $type]);
            }
            // $this->Flash->error(__('The reglement could not be saved. Please, try again.'));
        }

        $factureclients = '';
        $livraisons = '';


        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Commandes');

        $this->loadModel('Clients');

        //debug($client_id);
        if ($client_id != null) {
            $compte = $this->Clients->find('all')->where(['Clients.id =' . $client_id])->first();
        }
        //debug($compte->toArray());
        $c = $compte['Code'];
        //debug($c);

        // $factureclients = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $client_id, 'Factureclients.totalttc > Factureclients.Montant_Regler']);
        $condbc = '';
        $condbl = '';
        $condclbl = '';
        $condclbc = '';

        if ($piece == 'BC' && $piece_id != 0) {
            $condbc = "Commandes.id=" . $piece_id;

            $commandeobj=$this->fetchTable('Commandes')->find()->where($condbc)->first();
            // debug($commandeobj);
            $client_id=$commandeobj->client_id;
        }
        if ($piece == 'DE' && $piece_id != 0) {
            $condbl = "Bonlivraisons.id=" . $piece_id;
            
            $bonlivraisonobj=$this->fetchTable('Bonlivraisons')->find()->where($condbl)->first();
            // debug($commandeobj);
            $client_id=$bonlivraisonobj->client_id;
        }
        if ($client_id != 0) {
            $condclbl = "Bonlivraisons.client_id =" . $client_id;
        } else {
            $condclbl = "1=1";
        }
        if ($client_id != 0) {
            $condclbc = "Commandes.client_id =" . $client_id;
        } else {
            $condclbc = "1=1";
        }
        // debug( $condclbl);

        if ($piece == 'BC' && $piece_id != 0) {
            $commandes = $this->Commandes->find('all')->where([$condclbc,  $condbc])->where(['Commandes.totalttc > Commandes.Montant_Regler']);
            $livraisons = [];
        }
        if ($piece == 'DE' && $piece_id != 0) {
            $livraisons = $this->Bonlivraisons->find('all')->where([$condclbl, $condbl])->where(['Bonlivraisons.commande_id=0','Bonlivraisons.typebl=2', 'Bonlivraisons.totalttc > Bonlivraisons.Montant_Regler']);
            $commandes = [];
        }


        // debug($commandes->toarray());
        // $livraisons = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.client_id =' . $client_id, 'Bonlivraisons.commande_id=0', 'Bonlivraisons.typebl=2', 'Bonlivraisons.totalttc > Bonlivraisons.Montant_Regler']);

        // $commandes = $this->Commandes->find('all')->where(['Commandes.client_id =' . $client_id, 'Commandes.totalttc > Commandes.Montant_Regler']);




        $numeroobj = $this->Reglementclients->find()->select(["numero" =>
        'MAX(Reglementclients.numeroconca)'])->first();
        $numero = $numeroobj->numero;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
        } else {
            $code = "00001";
        }


        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list')->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list')->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list')->all();
        $this->loadModel('Banques');
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $piece = $this->Piecereglementclients->find('all', ['']);
        //debug($piece->toArray());
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all')->where(["Clients.etat='$cha'"]);

        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $listebonlivraisons = $this->fetchTable('Bonlivraisons')->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])
        ->where(['Bonlivraisons.typebl=2','Bonlivraisons.commande_id=0','Bonlivraisons.totalttc > Bonlivraisons.Montant_Regler']);
        $listecommandes = $this->fetchTable('Commandes')->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])->where(['Commandes.totalttc > Commandes.Montant_Regler']);



        $this->set(compact('piece_id', 'listecommandes', 'listebonlivraisons', 'piece', 'commandes', 'caisses', 'banques', 'timbre', 'type', 'valeurs', 'carnetcheques', 'paiements', 'livraisons', 'factureclients', 'client_id',  'code', 'reglementclient', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reglementclient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($type = null, $id = null)
    {

        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');
        $result = $this->request->getAttribute('authentication')->getIdentity();

        $reglement = $this->Reglementclients->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data['user_id'] = $result['id'];


            $data['numeroconca'] = $this->request->getData('numeroconca');;
            $data['Date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['Montant'] = $this->request->getData('data')['Reglementclients']['Montant'];
            $data['ttpayer'] = $this->request->getData('data')['Reglementclients']['ttpayer'];
            $reglement = $this->Reglementclients->patchEntity($reglement, $data);
            if ($this->Reglementclients->save($reglement)) {
                //debug($reglement);die;
                $lignes = $this->Lignereglementclients->find()->where(["Lignereglementclients.reglementclient_id=" . $id])->all();

                //debug($lignes);die;

                foreach ($lignes as $item) {

                    if ($item['factureclient_id'] != null) {
                        $mtg = $this->Factureclients->find()->select(["mtreg" =>
                        'Factureclients.Montant_Regler'])->where(['Factureclients.id =' . $item['factureclient_id']])->first();
                        $MontantRegler = $mtg->mtreg;
                        $fact = $this->Factureclients->get($item['factureclient_id']);
                        $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                        $this->Factureclients->save($fact);
                    }
                    if ($item['bonlivraison_id'] != null) {
                        $mtg = $this->Bonlivraisons->find()->select(["mtreg" =>
                        'Bonlivraisons.Montant_Regler'])->where(['Bonlivraisons.id =' . $item['bonlivraison_id']])->first();
                        $MontantRegler = $mtg->mtreg;
                        $fact = $this->Bonlivraisons->get($item['bonlivraison_id']);
                        $fact->Montant_Regler =   $fact->Montant_Regler - $item['Montant'];
                        $this->Bonlivraisons->save($fact);
                    }

                    if ($item['commande_id'] != null) {
                        $mtg = $this->fetchTable('Commandes')->find()->select(["mtreg" =>
                        'Commandes.Montant_Regler'])->where(['Commandes.id =' . $item['commande_id']])->first();
                        $MontantRegler = $mtg->mtreg;
                        $fact = $this->fetchTable('Commandes')->get($item['commande_id']);
                        $fact->Montant_Regler =  $fact->Montant_Regler - $item['Montant'];
                        $this->fetchTable('Commandes')->save($fact);
                    }

                    $this->Lignereglementclients->delete($item);
                }
                $lignes2 = $this->Piecereglementclients->find()->where(["Piecereglementclients.reglementclient_id =" . $id])->all();
                foreach ($lignes2 as $item) {
                    $this->Piecereglementclients->delete($item);
                }
                if (isset($this->request->getData('data')['Lignereglementclient']) && (!empty($this->request->getData('data')['Lignereglementclient']))) {

                    foreach ($this->request->getData('data')['Lignereglementclient'] as $i => $l) {
                        if (isset($l['factureclient_id'])) {

                            $ta = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $ta['reglementclient_id'] = $id;
                            $ta['factureclient_id'] = $l['factureclient_id'];
                            $ta['Montant'] = $l['Montanttt'];

                            $mtg = $this->Factureclients->find()->select(["mtreg" =>
                            'Factureclients.Montant_Regler'])->where(['Factureclients.id =' . $l['factureclient_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factureclients->get($l['factureclient_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Factureclients->save($fact);

                            $this->fetchTable('Lignereglementclients')->save($ta);
                        }

                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabb['reglementclient_id'] = $id;
                            $tabb['bonlivraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = $l['Montanttt'];

                            $mtg = $this->Bonlivraisons->find()->select(["mtreg" =>
                            'Bonlivraisons.Montant_Regler'])->where(['Bonlivraisons.id =' . $l['bonreception_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Bonlivraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt']; /*ttc*/

                            $this->Bonlivraisons->save($fact);
                            //debug($fact);
                            $this->fetchTable('Lignereglementclients')->save($tabb);
                            //debug($tabb);die;
                        }
                        if (isset($l['commande_id'])) {
                            $tabb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabb['reglementclient_id'] = $id;
                            $tabb['commande_id'] = $l['commande_id'];
                            $tabb['Montant'] = $l['Montanttt'];

                            $mtg = $this->fetchTable('Commandes')->find()->select(["mtreg" =>
                            'Commandes.Montant_Regler'])->where(['Commandes.id =' . $l['commande_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->fetchTable('Commandes')->get($l['commande_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt']; /*ttc*/

                            $this->fetchTable('Commandes')->save($fact);
                            //debug($fact);
                            $this->fetchTable('Lignereglementclients')->save($tabb);
                            //debug($tabb);die;
                        }
                    }
                }



                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglementclients')->newEmptyEntity();
                            $tab['reglementclient_id'] = $id;
                            $tab['paiement_id'] = $p['paiement_id'];
                            $tab['montant'] = $p['montant'];
                            $tab['to_id'] = $p['taux'];
                            $tab['montant_net'] = $p['montantnet'];
                            $tab['echance'] = $p['echance'];
                            $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                            $tab['num'] = $p['num_piece'];
                            $tab['banque_id'] = $p['banque_id'];
                            $tab['caisse_id'] = $p['caisse_id'];
                            $tab['porteurcheque'] = $p['porteurcheque'];
                            $tab['rib'] = $p['rib'];

                            if (isset($p['piecejointe']) && $p['piecejointe'] !== null) {
                                $name = $p['piecejointe']->getClientFilename();
                                $targetPath = WWW_ROOT . 'img' . DS . 'reglementclient' . DS . $name;
                                if ($name) {
                                    $p['piecejointe']->moveTo($targetPath);
                                    $tab['piecejointe'] = $name;
                                }
                            }
                            $this->fetchTable('Piecereglementclients')->save($tab);
                        }
                    }
                }

                return $this->redirect(['action' => 'index/' . $type]);
            }
        }
        $cli = $reglement->client_id;
        //debug($id);

        $lignesreg = $this->Lignereglementclients->find('all')->where(['Lignereglementclients.reglementclient_id =' . $id]);
        //debug(($lignesreg->toArray())) ;die;

        $l = '(0';
        foreach ($lignesreg as  $li) {


            if ($li['factureclient_id'] != 0) {
                $l = $l . ',' . $li['factureclient_id'];
            } else if ($li['bonlivraison_id'] != 0) {
                $l = $l . ',' . $li['bonlivraison_id'];
            }
            else if ($li['commande_id'] != 0) {
                $l = $l . ',' . $li['commande_id'];
            }
        }
        $l = $l . ',0)';




        foreach ($lignesreg as $s => $si) {

            if ($si['factureclient_id'] != 0) {
                $s = $si['reglementclient_id'];
            } else if ($si['bonlivraison_id'] != 0) {
                $s = $si['reglementclient_id'];
            } else if ($si['commande_id'] != 0) {
                $s = $si['reglementclient_id'];
            }
        }
        $piecereglementclients = $this->Piecereglementclients->find('all')->where(['Piecereglementclients.reglementclient_id =' . $id]);
        $mtbon = 0.000;
        $mtfact = 0.000;




        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['factureclient_id'] != null) {
                $facreg[$ligne['factureclient_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else {
                $facreg[$ligne['bonlivraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
        }

        if ($cli != null) {
            $this->loadModel('Factureclients');
            $this->loadModel('Bonlivraisons');

            $connection = ConnectionManager::get('default');
            // $livraisons = $connection->execute("select * from bonlivraisons where ('bonlivraisons.commande_id=0' and bonlivraisons.client_id=" . $cli . " and bonlivraisons.typebl=2 and bonlivraisons.totalttc > bonlivraisons.Montant_Regler) OR (bonlivraisons.id in" . $l . ");")->fetchAll('assoc');
            //    $commandes = $this->fetchTable('Commandes')->find('all')->where(' (Commandes.client_id =' . $cli.' and Commandes.totalttc > Commandes.Montant_Regler )  OR (Commandes.id in' . $l . ')');
            $commandes = $this->fetchTable('Commandes')->find('all')->where('Commandes.id in' . $l);
            $livraisons = $connection->execute("select * from bonlivraisons where  bonlivraisons.typebl=2 and bonlivraisons.id in" . $l . ";")->fetchAll('assoc');

           
            //debug($livraisons->toArray());
        }


        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list')->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list')->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list')->all();
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all')->where(["Clients.etat='$cha'"]);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->loadModel('Banques');
        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $caisses = $this->fetchTable('Caisses')->find('list');
        


        $this->set(compact('commandes','caisses', 'timbre', 'banques', 'type', 's', 'id', 'mtfact', 'mtbon', 'facreg', 'piecereglementclients', 'lignesreg', 'valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Reglementclient id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($type = null, $id = null)
    {
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Piecereglementclients');

        $this->request->allowMethod(['post', 'delete']);

        $lignes = $this->Lignereglementclients->find('all', [])->where(['Lignereglementclients.reglementclient_id =' . $id]);
        foreach ($lignes as $item) {
            //debug($item);die;
            if ($item['factureclient_id'] != null) {

                $mtg = $this->Factureclients->find('all')->select(["mtreg" => 'Factureclients.Montant_Regler'])->where(['Factureclients.id =' . $item['factureclient_id']])->first();
                $MontantRegler = $mtg->mtreg;
                $fact = $this->Factureclients->get($item['factureclient_id']);
                $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                $this->Factureclients->save($fact);
            }
            if ($item['bonlivraison_id'] != null) {
                $mtg = $this->Bonlivraisons->find()->select(["mtreg" =>
                'Bonlivraisons.Montant_Regler'])->where(['Bonlivraisons.id =' . $item['bonlivraison_id']])->first();
                $MontantRegler = $mtg->mtreg;
                $fact = $this->Bonlivraisons->get($item['bonlivraison_id']);
                $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                $this->Bonlivraisons->save($fact);
            }
            if ($item['commande_id'] != null) {
                $mtg = $this->fetchTable('Commandes')->find()->select(["mtreg" =>
                'Commandes.Montant_Regler'])->where(['Commandes.id =' . $item['commande_id']])->first();
                $MontantRegler = $mtg->mtreg;
                $fact = $this->fetchTable('Commandes')->get($item['commande_id']);
                $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                $this->fetchTable('Commandes')->save($fact);
            }

            $this->Lignereglementclients->delete($item);
        }

        $lignes2 = $this->Piecereglementclients->find()->where(["Piecereglementclients.reglementclient_id=" . $id])->all();
        foreach ($lignes2 as $item) {
            $this->Piecereglementclients->delete($item);
        }


        $reglementclient = $this->Reglementclients->get($id);
        if ($this->Reglementclients->delete($reglementclient)) {
            // $this->Flash->success(__('The reglementclient has been deleted.'));
        } else {
            // $this->Flash->error(__('The reglementclient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index/' . $type]);
    }
}

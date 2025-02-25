<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;

use Cake\ORM\TableRegistry;

/**
 * Factures Controller
 *
 * @property \App\Model\Table\FacturesTable $Factures
 * @method \App\Model\Entity\Facture[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FacturesController extends AppController
{





    public function etatsoldefournisseur()
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_stat' . $abrv);

        // $unite = 0;
        // foreach ($liendd as $k => $liens) {
        //     if (@$liens['lien'] == 'etatsoldefournisseur') {
        //         $unite = 1;
        //     }
        // }
        // if (($unite <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Factures');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $this->loadModel('Factureavoirfrs');
        $this->loadModel('Livraisons');

        $date1 = '2023-01-01 00:00:00';
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

        if ($this->request->getQuery()) {
            if (!empty($this->request->getQuery('date1'))) {
                $date1 = date("Y-m-d 00:00:00", strtotime(str_replace('/', '-', $this->request->getQuery('date1'))));
            }
            if (!empty($this->request->getQuery('date2'))) {
                $date2 = date("Y-m-d 23:59:59", strtotime(str_replace('/', '-', $this->request->getQuery('date2'))));
            }
        }

        $fournisseurs = $this->Fournisseurs->find('all')->toArray();
        $data = [];

        foreach ($fournisseurs as $fournisseur) {
            $fournisseurId = $fournisseur->id;

            $facturesSum = $this->Factures->find()
                ->where(['Factures.fournisseur_id' => $fournisseurId, 'Factures.date >=' => $date1, 'Factures.date <=' => $date2])
                ->sumOf('ttc');
            $Livraisonssum = $this->Livraisons->find()
                ->where(['Livraisons.fournisseur_id' => $fournisseurId, 'Livraisons.date >=' => $date1, 'Livraisons.date <=' => $date2,'Livraisons.facture_id'=>0])
                ->sumOf('ttc');




            $avoirsSum = $this->Factureavoirfrs->find()
                ->where(['Factureavoirfrs.fournisseur_id' => $fournisseurId, 'Factureavoirfrs.date >=' => $date1, 'Factureavoirfrs.date <=' => $date2/*,'Factureavoirfrs.facture_id'=>0*/])
                ->sumOf('totalttc');

            $paymentsSum = $this->Piecereglements->find()
                ->contain(['Reglements'])
                ->where(['Reglements.fournisseur_id' => $fournisseurId, 'Reglements.Date >=' => $date1, 'Reglements.Date <=' => $date2])
                ->sumOf('montant');

            $data[$fournisseurId] = [
                'client' => $fournisseur->name,
                'code' => $fournisseur->code,
                'soldedepart' => $fournisseur->soldedebut,
                'Debit' => $facturesSum + $Livraisonssum,
                'Credit' => $paymentsSum + $avoirsSum,
                // 'Solde' => $facturesSum - $paymentsSum - $avoirsSum 
            ];
        }

        $this->set(compact('fournisseurs', 'data', 'date1', 'date2'));
    }

    public function impetatsolde()
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_stat' . $abrv);

        // $unite = 0;
        // foreach ($liendd as $k => $liens) {
        //     if (@$liens['lien'] == 'etatsoldefournisseur') {
        //         $unite = 1;
        //     }
        // }
        // if (($unite <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Factures');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $this->loadModel('Factureavoirfrs');
        $this->loadModel('Livraisons');

        $date1 = '2023-01-01 00:00:00';
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

        if ($this->request->getQuery()) {
            if (!empty($this->request->getQuery('date1'))) {
                $date1 = date("Y-m-d 00:00:00", strtotime(str_replace('/', '-', $this->request->getQuery('date1'))));
            }
            if (!empty($this->request->getQuery('date2'))) {
                $date2 = date("Y-m-d 23:59:59", strtotime(str_replace('/', '-', $this->request->getQuery('date2'))));
            }
        }

        $fournisseurs = $this->Fournisseurs->find('all')->toArray();
        $data = [];

        foreach ($fournisseurs as $fournisseur) {
            $fournisseurId = $fournisseur->id;

            $facturesSum = $this->Factures->find()
                ->where(['Factures.fournisseur_id' => $fournisseurId, 'Factures.date >=' => $date1, 'Factures.date <=' => $date2])
                ->sumOf('ttc');
            $Livraisonssum = $this->Livraisons->find()
                ->where(['Livraisons.fournisseur_id' => $fournisseurId, 'Livraisons.date >=' => $date1, 'Livraisons.date <=' => $date2,'Livraisons.facture_id'=>0])
                ->sumOf('ttc');




            $avoirsSum = $this->Factureavoirfrs->find()
                ->where(['Factureavoirfrs.fournisseur_id' => $fournisseurId, 'Factureavoirfrs.date >=' => $date1, 'Factureavoirfrs.date <=' => $date2/*,'Factureavoirfrs.facture_id'=>0*/])
                ->sumOf('totalttc');

            $paymentsSum = $this->Piecereglements->find()
                ->contain(['Reglements'])
                ->where(['Reglements.fournisseur_id' => $fournisseurId, 'Reglements.Date >=' => $date1, 'Reglements.Date <=' => $date2])
                ->sumOf('montant');

            $data[$fournisseurId] = [
                'client' => $fournisseur->name,
                'code' => $fournisseur->code,
                'soldedepart' => $fournisseur->soldedebut,
                'Debit' => $facturesSum + $Livraisonssum,
                'Credit' => $paymentsSum + $avoirsSum,
                // 'Solde' => $facturesSum - $paymentsSum - $avoirsSum 
            ];
        }

        $this->set(compact('fournisseurs', 'data', 'date1', 'date2'));
    }
    public function etatsoldefournisseur1610()
    {
        // Set error reporting
        error_reporting(E_ERROR | E_PARSE);

        // Load necessary models
        $this->loadModel('Factures');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $cond1 = "";
        $cond2 = "";
        $conde1 = "";
        $conde2 = "";
        $condb = "";
        $condp = "";
        // Set default dates
        $date1 = '2023-01-01 00:00:00';
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

        // Initialize conditions array
        // $conditions = [];

        // Check for query parameters and update dates if provided
        if ($this->request->getQuery()) {
            if (!empty($this->request->getQuery('date1'))) {
                $date1 = date("Y-m-d 00:00:00", strtotime(str_replace('/', '-', $this->request->getQuery('date1'))));
            }

            if (!empty($this->request->getQuery('date2'))) {
                $date2 = date("Y-m-d 23:59:59", strtotime(str_replace('/', '-', $this->request->getQuery('date2'))));
            }

            // Add date conditions
            if ($date2) {
                $cond1 = 'date(Reglements.Date)  <= ' . "'" . $date2 . " 23:59:59'";
                $conde1 = 'date(Factures.Date)  <= ' . "'" . $date2 . " 23:59:59'";
            }
            if ($date1) {
                $cond2 = 'date(Reglements.Date ) >= ' . "'" . $date1 . " 00:00:00'";
                $conde2 = 'date(Factures.Date)  <= ' . "'" . $date2 . " 23:59:59'";
            }
        }

        // Fetch list of suppliers
        $suppliers = $this->Fournisseurs->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);

        // Fetch unpaid invoices for the specified period
        $unpaidInvoices = $this->Factures->find()
            ->contain(['Fournisseurs'])
            ->where([
                'Factures.Montant_Regler' => 0,
                $conde1,
                $conde2
            ])
            ->toArray();

        // Fetch payment pieces for the specified period
        $payments = $this->Piecereglements->find()
            ->contain(['Reglements' => ['Fournisseurs']])
            ->where([$cond1, $cond2])
            ->toArray();

        // Initialize an array to hold the results
        $supplierBalances = [];

        // Process unpaid invoices
        foreach ($unpaidInvoices as $invoice) {
            $supplierId = $invoice->fournisseur_id;

            // Initialize supplier entry if not already set
            if (!isset($supplierBalances[$supplierId])) {
                $supplierBalances[$supplierId] = [
                    'fournisseur' => $invoice->fournisseur->name,
                    'code' => $invoice->fournisseur->code,
                    'soldedepart' => $invoice->fournisseur->soldedebut,
                    'Debit' => $invoice->ttc,
                    'Credit' => 0,
                    'Solde' => $invoice->fournisseur->soldedebut - $invoice->ttc
                ];
            } else {
                // Update the supplier's financial entries
                $supplierBalances[$supplierId]['Debit'] += $invoice->ttc;
                $supplierBalances[$supplierId]['Solde'] -= $invoice->ttc;
            }
        }

        // Process payments
        foreach ($payments as $payment) {
            $supplierId = $payment->reglement->fournisseur_id;

            // Initialize supplier entry if not already set
            if (!isset($supplierBalances[$supplierId])) {
                $supplierBalances[$supplierId] = [
                    'fournisseur' => $payment->reglement->fournisseur->name,
                    'code' => $payment->reglement->fournisseur->code,
                    'soldedepart' => $payment->reglement->fournisseur->soldedebut,
                    'Debit' => 0,
                    'Credit' => $payment->montant,
                    'Solde' => $payment->reglement->fournisseur->soldedebut + $payment->montant
                ];
            } else {
                // Update the supplier's financial entries
                $supplierBalances[$supplierId]['Credit'] += $payment->montant;
                $supplierBalances[$supplierId]['Solde'] += $payment->montant;
            }
        }

        // Set variables for the view
        $this->set(compact('suppliers', 'supplierBalances', 'date1', 'date2'));
    }


  

    public function imprimelistefacture()
    {
        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $fournisseur_id = $this->request->getQuery('fournisseur_id');
        $article_id = $this->request->getQuery('article_id');
        $historiquede = $this->request->getQuery('historiquede');
        $article = $this->request->getQuery('article_id');
        $achat = $this->request->getQuery('achat');
        $confirme = $this->request->getQuery('confirme');

        $service = $this->request->getQuery('service_id');
        $machine = $this->request->getQuery('machine_id');



        // debug($historiquede);   
        $au = $this->request->getQuery('au');
        // debug($au);
        $conditions = [];
        if ($historiquede) {
            $conditions[] = ["Factures.date >= '" . $historiquede . " 00:00:00'"];
        }
        if ($au) {
            $conditions[] = ["Factures.date <='" . $au . " 23:59:59' "];
        }
        if ($fournisseur_id) {
            $conditions[] = ["Factures.fournisseur_id = '" . $fournisseur_id . "' "];
        }
        if ($achat) {
            $conditions[] = ["Factures.typef = '" . $achat . "' "];
        }

        if ($confirme) {
            if ($confirme == 1) {

                $etat = 1;
            } else if ($confirme == 2) {
                $etat = 0;
            }
            $conditions[] = ["Factures.valide = '" . $etat . "' "];
        }

        if ($service) {
            $conditions[] = ["Factures.service_id = '" . $service . "'"];
            // $conditions[] = ["Besionachats.service_id = '" . $service . "'"];
        }

        if ($machine) {
            $conditions[] = ["Factures.machine_id = '" . $machine . "'"];
        }

        if ($article) {
            $subquery = $this->fetchTable('Lignefactures')
                ->find('list', [
                    'keyField' => 'facture_id',
                    'valueField' => 'facture_id'
                ])
                ->where(['Lignefactures.article_id' => $article]);
            $conditions[] = ['Factures.id IN' => $subquery];
        }
        // $conditions[] = ["Factures.typebl" => 1];


        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find()->where('Users.id=' . $user_id)->first();




        $factures = $this->fetchTable('Factures')->find('all')->where([$conditions])->contain(['Fournisseurs'])->order(['Factures.id' => 'DESC'])->ToArray();
        // debug($factures->ToArray());
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {


                return  $art->name;
            }
        ]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])->where(['Articles.famille_id = 2']);

        // $articles = $this->Articles->find('list', ['keyField' => 'id', 'valueField' => 'Dsignation']);
        $this->set(compact('article_id', 'fournisseurs', 'fournisseur_id', 'article_id', 'articles', 'factures', 'historiquede', 'au'));
    }



    public function listefacture()
    {
        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $fournisseur_id = $this->request->getQuery('fournisseur_id');
        $article_id = $this->request->getQuery('article_id');
        $historiquede = $this->request->getQuery('historiquede');
        $article = $this->request->getQuery('article_id');
        $achat = $this->request->getQuery('achat');
        $confirme = $this->request->getQuery('confirme');
        $service = $this->request->getQuery('service_id');
        $machine = $this->request->getQuery('machine_id');


        // debug($historiquede);   
        $au = $this->request->getQuery('au');
        // debug($au);
        $conditions = [];
        if ($historiquede) {
            $conditions[] = ["Factures.date >= '" . $historiquede . " 00:00:00'"];
        }
        if ($au) {
            $conditions[] = ["Factures.date <='" . $au . " 23:59:59' "];
        }
        if ($fournisseur_id) {
            $conditions[] = ["Factures.fournisseur_id = '" . $fournisseur_id . "' "];
        }
        if ($achat) {
            $conditions[] = ["Factures.typef = '" . $achat . "' "];
        }
        if ($confirme) {
            if ($confirme == 1) {

                $etat = 1;
            } else if ($confirme == 2) {
                $etat = 0;
            }
            $conditions[] = ["Factures.valide = '" . $etat . "' "];
        }


        if ($service) {
            $conditions[] = ["Factures.service_id = '" . $service . "'"];
            // $conditions[] = ["Besionachats.service_id = '" . $service . "'"];
        }

        if ($machine) {
            $conditions[] = ["Factures.machine_id = '" . $machine . "'"];
        }

        if ($article) {
            $subquery = $this->fetchTable('Lignefactures')
                ->find('list', [
                    'keyField' => 'facture_id',
                    'valueField' => 'facture_id'
                ])
                ->where(['Lignefactures.article_id' => $article]);
            $conditions[] = ['Factures.id IN' => $subquery];
        }
        // $conditions[] = ["Factures.typebl" => 1];


        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find()->where('Users.id=' . $user_id)->first();




        $factures = $this->fetchTable('Factures')->find('all')->where([$conditions])->contain(['Fournisseurs', 'Machines'])->order(['Factures.id' => 'DESC'])->ToArray();
        // debug($factures->ToArray());
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {


                return  $art->name;
            }
        ]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])->where(['Articles.famille_id = 2']);
        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $articles = $this->Articles->find('list', ['keyField' => 'id', 'valueField' => 'Dsignation']);
        $this->set(compact('machines', 'services', 'article_id', 'fournisseurs', 'fournisseur_id', 'article_id', 'articles', 'factures', 'historiquede', 'au'));
    }





    public function validation($id = null)
    {
        $facture = $this->Factures->get($id, [
            'contain' => [],
        ]);

        $data['valide'] = 1;



        $facture = $this->Factures->patchEntity($facture, $data);
        if ($this->Factures->save($facture)) {
        }



        return $this->redirect(['action' => 'index/' . $facture->typef . '/0']);
    }

    public function imprimeview($id = null)
    {

        $facture = $this->Factures->get($id, [
            'contain' => ['Fournisseurs']
        ]);
        $fournisseurs = $this->Factures->Fournisseurs->find('list');
        // $this->set(compact('commande','commercials','clients'));


        $this->loadModel('Lignefactures');
        $lignefactures = $this->Lignefactures->find('all')->contain(['Articles'])->where(["Lignefactures.facture_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $factures = $this->Factures->find('all')->contain(['Fournisseurs']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->set(compact('lignefactures', 'articles', 'facture', 'fournisseurs', 'timbre'));
    }
    //    
    public function addindirect($tab = null)
    {





        $livraisonsTable = TableRegistry::getTableLocator()->get('Livraisons');
        $livraisons = $livraisonsTable->find('all')
            ->where('id IN (' . $tab . ')');


        $livraison = $livraisonsTable->find()
            ->where('id IN (' . $tab . ')')->first();




        $lignelivraisonsTable = TableRegistry::getTableLocator()->get('Lignelivraisons');
        $lignelivraisons = $lignelivraisonsTable->find()
            ->select([
                'article_id',
                'prix',
                'remise',
                'fodec',
                'tva',
                'ttc',
                'qteliv' => $lignelivraisonsTable->query()->func()->sum('Lignelivraisons.qteliv'),
            ])
            ->where('livraison_id IN (' . $tab . ')')
            ->group(['article_id', 'prix'])
            ->contain(['Articles']);

        //debug($lignelivraisons->toarray());


        $yearf = date('Y');

        $currentYear = date('y');
        $num = $this->Factures->find()->select(["num" =>
        'MAX(Factures.numero)'])->where('YEAR(Factures.date)=' . $yearf)->first();

        $n = $num->num;

        if ($n) {
            $lastFourDigits = substr($n, -4);
            $in = intval($lastFourDigits) + 1;
        } else {
            $in = '0001';
        }

        $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
        $b = "FC{$currentYear}00{$mm}";

        $facture = $this->Factures->newEmptyEntity();

        if ($this->request->is('post')) {
            //   debug($this->request->getData());

            $inputDate = $this->request->getData('date');

            $yearf = date('Y', strtotime($inputDate));

            $currentYear = date('y', strtotime($inputDate));
            $num = $this->Factures->find()->select(["num" =>
            'MAX(Factures.numero)'])->where('YEAR(Factures.date)=' . $yearf)->first();

            $n = $num->num;

            if ($n) {
                $lastFourDigits = substr($n, -4);
                $in = intval($lastFourDigits) + 1;
            } else {
                $in = '0001';
            }

            $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
            $b = "FC{$currentYear}00{$mm}";

            // $data['numero'] =  $b;
            $data['numero'] =  $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $data['adresselivraisonfournisseur_id'] = $this->request->getData('adresselivraisonfournisseur_id');
            // $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['ht'] = $this->request->getData('ht');
            $data['tva'] = $this->request->getData('tva');
            $data['fodec'] = $this->request->getData('fodec');
            $data['remise'] = $this->request->getData('remise');
            $data['ttc'] = $this->request->getData('ttc');
            $data['livraison_id'] = $tab;
            $data['typef'] = $livraison->typelivraison;
            $data['typefac'] = 0;
            $data['service_id'] = $this->request->getData('service_id');
            $data['machine_id'] = $this->request->getData('machine_id');
            $data['observation'] = $this->request->getData('observation');
            $data['facturefournisseur'] = $this->request->getData('facturefournisseur');
            $data['datefournisseur'] = $this->request->getData('datefournisseur');





            $facture = $this->Factures->patchEntity($facture, $data);
            //debug($facture);
            if ($this->Factures->save($facture)) {
                $facture_id = $facture->id;

                $tabArray = explode(',', $tab);

                foreach ($tabArray as $id) {

                    $d = $this->fetchTable('Livraisons')->get($id, ['contain' => []]);


                    $d['facture_id'] = $facture_id;


                    $this->fetchTable('Livraisons')->save($d);
                }


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // die;
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //debug($l);
                        $tab = $this->fetchTable('Lignefactures')->newEmptyEntity();
                        $tab['facture_id'] = $facture_id;
                        $tab['article_id'] = $l['article_id'];
                        $tab['qte'] = $l['qte'];
                        $tab['ttc'] = $l['ttc'];
                        $tab['fodec'] = $l['fodec'];
                        $tab['tva'] = $l['tva'];
                        $tab['ht'] = $l['punht'];
                        $tab['remise'] = $l['remise'];
                        $tab['prix'] = $l['prix'];
                        // debug($tab);die;

                        //  $this->fetchTable('Lignefactures')->save($tab);

                        if ($this->fetchTable('Lignefactures')->save($tab)) {

                            $article = $this->fetchTable('Articles')->get($l['article_id']);
                            // debug($article);die;
                            $article->prixachat = $l['prix'];
                            $this->fetchTable('Articles')->save($article);
                        } else {
                        }
                    }
                }
                //$this->Flash->success(__('The {0} has been saved.', 'factures'));
                return $this->redirect(['action' => 'index/' . $livraison->typelivraison . '/' . 0]);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignefactures'));
        }
        $this->loadModel('Personnels');


        $fournisseurs = $this->fetchTable('Livraisons')->Fournisseurs->find('list', ['keyfield' => 'id']);
        $this->loadModel('Pointdeventes');
        /// $pointdeventes = $this->Pointdeventes->find('list');
        $this->loadModel('Depots');
        $depots = $this->Depots->find('list');
        $this->loadModel('Materieltransports');
        $materieltransports = $this->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $this->loadModel('Cartecarburants');
        $cartecarburants = $this->Cartecarburants->find('list');
        $this->loadModel('Adresselivraisonfournisseurs');
        $adresselivraisonfournisseurs = $this->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        $this->loadModel('Personnels');
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id  ='" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id ='" . 1 . "%' "]);
        $this->loadModel('Timbres');
        $timbr = $this->Timbres->find('all', ['keyfield' => 'id', 'valueField' => 'timbre']);
        $tab1 = array();
        foreach ($timbr as $tab1); {
            // debug($tab1['timbre']);
        }

        $type = $livraison->typelivraison;


        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('livraison', 'machines', 'services', 'type', 'b', 'lignelivraisons', 'tab1', 'timbr', 'numero', 'articles', 'facture', 'fournisseurs', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonfournisseurs'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($typef = null, $typefact = null)
    {
        // debug($typef);
        // debug($typefact);
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        $cond8 = '';
        // $historiquede = $this->request->getQuery('historiquede');
        // $au = $this->request->getQuery('au');
        $numero = $this->request->getQuery('numero');
        ///  $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $depot_id = $this->request->getQuery('depot_id');
        $fournisseur_id = $this->request->getQuery('fournisseur_id');
        $datedebutfacture = $this->request->getQuery('datedebutfacture');
        $datefinfacture = $this->request->getQuery('datefinfacture');
        $facturefournisseur = $this->request->getQuery('facturefournisseur');
        //debug($facturefournisseur);
        if ($depot_id) {
            $cond1 = "Factures.depot_id =  '" . $depot_id . "'";
        }
        if ($numero) {
            $cond2 = "Factures.numero =  '" . $numero . "' ";
        }
        // if ($historiquede) {
        //     $cond3 = "Factures.date >=  '%" . $historiquede . "%' ";
        // }
        // if ($au) {
        //     $cond4 = "Factures.date <=  '%" . $au . "%' ";
        // }
        if ($fournisseur_id) {
            $cond5 = "Factures.fournisseur_id =  '" . $fournisseur_id . "' ";
        }
        if ($datedebutfacture) {
            $cond6 = 'Factures.datefournisseur >= ' . "'" . $datedebutfacture . " 00:00:00'";
        }
        if ($datefinfacture) {
            $cond7 = 'Factures.datefournisseur <= ' . "'" . $datefinfacture . " 23:59:59 '";
        }
        if ($facturefournisseur) {
            $cond8 = "Factures.facturefournisseur =  '" . $facturefournisseur . "' ";
        }
        // if ($pointdevente_id) {
        //     $cond6 = "Factures.pointdevente_id =  '" . $pointdevente_id . "' ";
        // }
        $condtype = "Factures.typef=" . $typef;
        $condtype0 = "Factures.typefac=" . $typefact;

        // debug($condtype0);
        $query = $this->Factures->find('all')->where([$condtype, $cond1, $cond2, $cond5, $cond6, $cond7, $cond8])
            ->order(["Factures.id" => 'DESC']);
        // debug($query);die;
        $this->paginate = [
            'contain' => ['Fournisseurs', 'Depots', 'Materieltransports'],
        ];
        // debug($query->toArray());
        $factures = $this->paginate($query);
        //    debug($factures->toArray());
        $fournisseurs = $this->Factures->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $materieltransports = $this->Factures->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        //// $pointdeventes = $this->Factures->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Factures->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $confaieurs = $this->Factures->Personnels->find('list', array('conditions' => array('Personnels.fonction_id="5"'), 'fields' => array('Personnels.code', 'Personnels.nom', 'Personnels.prenom')));
        $chauffeurs = $this->Factures->Personnels->find('list', array('conditions' => array('Personnels.fonction_id="1"')));
        $cartecarburants = $this->Factures->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);
        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find()->where('Users.id=' . $user_id)->first();
        $validationfactureachat = $user->validationfactureachat;
        $suivi = [];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facture_id = $this->request->getData('iddialog');
            $factureobj = $this->fetchTable('Factures')->get($facture_id);
            $factureobj = $this->Factures->patchEntity($factureobj, $this->request->getData());
            $factureobj->valide = 1;
            $factureobj->commentaireReglement = $this->request->getData('commentaireReglement');
            $this->loadModel('Paiementfactures');
            $paiementIds = $this->request->getData('paiement_id');
            // debug($commercialIds);
            $filteredPaiementIds = array_filter($paiementIds);
            //   debug($filteredCommercialIds);
            if (!empty($filteredPaiementIds)) {
                foreach ($filteredPaiementIds as $paiement_id) {
                    $data = [
                        'facture_id' => $facture_id,
                        'paiement_id' => $paiement_id[0],
                    ];
                    $paiementfacture = $this->Paiementfactures->newEntity($data);
                    if ($this->Paiementfactures->save($paiementfacture)) {
                        // Data saved successfully
                    } else {
                        // debug($usercommercial->getErrors());
                    }
                }
            }
            if ($this->Factures->save($factureobj)) {
                return $this->redirect(['action' => 'index/' . $typef . '/' . $typefact]);
            }
        }
        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $tim = $this->fetchTable('Timbres')->find()->select([
            "timbre" =>
            'MAX(Timbres.timbre)'
        ])->first();
        $timbre = $tim->timbre;
        $this->set(compact('query', 'timbre', 'paiements', 'validationfactureachat', 'typef', 'typefact', 'confaieurs', 'factures', 'fournisseurs', 'chauffeurs', 'materieltransports', 'depots', 'cartecarburants'));
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
            'contain' => []
        ]);
        $this->loadModel('Lignefactures');

        $typef = $facture->typef;
        $typefac = $facture->typefac;
        //$commandes = $this->Factures->Commandes->find('list');

        $fournisseurs = $this->Factures->Fournisseurs->find('list');
        /// $pointdeventes = $this->Factures->Pointdeventes->find('list');
        $depots = $this->Factures->Depots->find('list');
        $cartecarburants = $this->Factures->Cartecarburants->find('list');
        $materieltransports = $this->Factures->Materieltransports->find('list');
        // $lignes = $this->fetchTable('Lignefactures')->find()->where(["Facture_id" => $id])->all();
        $lignes = $this->fetchTable('Lignefactures')->find()
            ->where(["Facture_id" => $id])
            ->contain('Articles') // Contient la relation Articles
            ->all();
        // debug($lignes);
        $count = $this->Lignefactures->find()->where(["Facture_id" => $id])->count();
        $adresselivraisonfournisseurs = $this->Factures->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
        $this->loadModel('Personnels');
        // $articles = $this->Articles->find('all');
        $articles = $this->fetchTable('Articles')->find('all', [
            'contain' => [],
        ]);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id  ='" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id ='" . 1 . "%' "]);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $this->set(compact('machines', 'services', 'timbre', 'typefac', 'typef', 'conffaieurs', 'chauffeurs', 'facture', 'lignes', 'count', 'articles', 'fournisseurs', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($typef = null, $typefact = null)
    {




        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        //   debug($liendd);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'factures') {
                $fournisseur = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $facture = $this->Factures->newEmptyEntity();
        // $num = $this->Factures->find()->select(["num" =>
        // 'MAX(Factures.numero)'])->first();
        // // debug($num);
        // $n = $num->num;
        // ///debug($n);
        // // $int=intval($n);
        // $in = intval($n) + 1;
        // // debug($in);
        // $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);


        $yearf = date('Y');

        $currentYear = date('y');
        $num = $this->Factures->find()->select(["num" =>
        'MAX(Factures.numero)'])->where('YEAR(Factures.date)=' . $yearf)->first();

        $n = $num->num;

        if ($n) {
            $lastFourDigits = substr($n, -4);
            $in = intval($lastFourDigits) + 1;
        } else {
            $in = '0001';
        }

        $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
        $b = "FC{$currentYear}00{$mm}";


        if ($this->request->is('post')) {
            //debug($this->request->getData());


            $yearf = date('Y');

            $currentYear = date('y');
            $num = $this->Factures->find()->select(["num" =>
            'MAX(Factures.numero)'])->where('YEAR(Factures.date)=' . $yearf)->first();

            $n = $num->num;

            if ($n) {
                $lastFourDigits = substr($n, -4);
                $in = intval($lastFourDigits) + 1;
            } else {
                $in = '0001';
            }

            $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
            $b = "FC{$currentYear}00{$mm}";

            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $data['typef'] = $typef;
            $data['typefac'] = $typefact;
            $data['adresselivraisonfournisseur'] = $this->request->getData('adresselivraisonfournisseur');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['conffaieur_id'] = $this->request->getData('conffaieur_id');
            $data['remise'] = $this->request->getData('remise');
            $data['tva'] = $this->request->getData('tva');
            $data['fodec'] = $this->request->getData('fodec');
            $data['ht'] = $this->request->getData('ht');
            $data['ttc'] = $this->request->getData('ttc');




            $facture = $this->Factures->patchEntity($facture, $data);


            if ($this->Factures->save($facture)) {


                $this->loadModel('Livraisons');
                $facture_id = $facture->id;
                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                    $this->loadModel('Lignefactures');
                    foreach ($this->request->getData('data')['tabligne3'] as $i => $facture) {
                        if ($facture['sup'] != 1 && (!empty($facture['article_idd']))) {

                            //debug($facture_id);die;
                            $lignefactures = $this->fetchTable('Lignefactures')->newEmptyEntity();
                            $data['facture_id'] = $facture_id;
                            $data['article_id'] = $facture['article_idd'];
                            $data['qte'] = $facture['qte'];
                            $data['prix'] = $facture['prix'];
                            $data['remise'] = $facture['remise'];
                            $data['ht'] = $facture['punht'];
                            $data['tva'] = $facture['tva'];
                            $data['fodec'] = $facture['fodec'];
                            $data['ttc'] = $facture['ttc'];



                            $lignefactures = $this->Lignefactures->patchEntity($lignefactures, $data);

                            ///   debug($lignefactures);
                            //debug($data);die;

                            if ($this->Lignefactures->save($lignefactures)) {
                                $article = $this->fetchTable('Articles')->get($facture['article_idd']);
                                // debug($article);die;
                                $article->prixachat = $facture['prix'];
                                $this->fetchTable('Articles')->save($article);
                                //debug($lignefactures) ;

                                //   $this->Flash->success("lignefactures has been created successfully");
                            } else {
                                // $this->Flash->error("Failed to create lignefactures");
                            }
                        }
                    }
                }
            }
            // $this->Flash->success(__('The {0} has been saved.', 'Facture'));

            return $this->redirect(['action' => 'index/' . $typef]);
        }
        // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Facture'));
        $cond00 = 'Fournisseurs.typelocalisation_id = 1 ';
        $cond01 = 'Fournisseurs.typelocalisation_id = 2 ';

        // if ($typef == 1) {
        $fournisseurs = $this->Factures->Fournisseurs->find('list'); //->where([$cond00]);
        // }


        if ($typef == 2) {
            $fournisseurs = $this->Factures->Fournisseurs->find('list')->where([$cond01]);
        }
        ////  $pointdeventes = $this->Factures->Pointdeventes->find('list');
        $depots = $this->Factures->Depots->find('list');
        $cartecarburants = $this->Factures->Cartecarburants->find('list');
        $materieltransports = $this->Factures->Materieltransports->find('list');
        $livraisons = $this->Factures->Livraisons->find('list');
        //$adresselivraisonfournisseurs = $this->Factures->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        //$personnels = $this->Factures->Personnels->find('list');
        $chauffeurs = $this->Factures->Personnels->find('list')->where(['fonction_id' => 1]);
        $conffaieurs = $this->Factures->Personnels->find('list')->where(['fonction_id' => 5]);

        $this->loadModel('Articles');
        $cond = 'Articles.famille_id != 1 ';
        // $articles = $this->Articles->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        //  ->where([$cond]);
        $articles = $this->fetchTable('Articles')->find('all', [
            'contain' => [],
        ]);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->set(compact('mm', 'conffaieurs', 'timbre', 'chauffeurs', 'articles', 'b', 'facture', 'numero', 'livraisons', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports', 'typef'));
    }

    public function getadresselivraison($id = null)
    {
        $id = $this->request->getQuery('idfam');

        $ligne = $this->fetchTable('fournisseurs')->get($id, [
            'contain' => [],
        ]);
        $query = $this->fetchTable('adresselivraisonfournisseurs')->find();
        $query->where(['fournisseur_id' => $id]);
        // debug($query);
        $select = "
        <label class='control-label' for='sousfamille1-id'>Adresse livraison</label>
        <select name='adresse' id='adresselivraison-id' class='form-control select2'  onchange='getsousfamille2(this.value)'>
                    <option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
            //  debug($q);
            $select =  $select . "  <option value ='" . $q['id'] . "'";
            $select =  $select . " >" . $q['adresse'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select = $select . "</select> </div> </div> ";
        echo json_encode(array('select' => $select, 'ligne' => $ligne));
        die;
        //$this->set(compact('query'));
        /* foreach ($query as $q) {
            json_encode($q);
            debug($q);
        }
     */
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
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        //   debug($liendd);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'factures') {
                $fournisseur = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $facture = $this->Factures->get($id, [
            'contain' => []
        ]);

        $typef = $facture->typef;
        $typefac = $facture->typefac;
        ////debug($facture->toArray());
        $this->loadModel('Lignefactures');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $facture = $this->Factures->patchEntity($facture, $this->request->getData());
            if ($this->Factures->save($facture)) {
                $this->loadModel('Lignefactures');
                $articles_ids = $this->request->getData('articles_ids');
                $codefs = $this->request->getData('codef');
                $qtes = $this->request->getData('qte');
                $prixhts = $this->request->getData('prixht');
                $remises = $this->request->getData('remise');
                $prixunhts = $this->request->getData('prixunht');
                $fodecs = $this->request->getData('fodec');
                $tvas = $this->request->getData('tva');
                $ttcs = $this->request->getData('ttc');
                $lignes = $this->Lignefactures->find()->where(["Facture_id" => $id])->all();

                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                    $this->loadModel('Lignefactures');

                    foreach ($this->request->getData('data')['tabligne3'] as $i => $liv) {

                        if ($liv['sup'] != 1 && (!empty($liv['article_idd']))) {

                            $data['article_id'] = $liv['article_idd'];
                            $data['facture_id'] = $id;
                            $data['qte'] = $liv['qte'];
                            $data['prix'] = $liv['prix'];
                            $data['remise'] = $liv['remise'];
                            $data['punht'] = $liv['punht'];
                            $data['tva'] = $liv['tva'];
                            $data['fodec'] = $liv['fodec'];
                            $data['ttc'] = $liv['ttc'];  //   debug($data);die;



                            $lignefactures = $this->fetchTable('Lignefactures')->get($liv['id']);
                            $lignefactures = $this->Lignefactures->patchEntity($lignefactures, $data);
                            //   $lignefacture = $this->fetchTable('Lignefactures')->patchEntity($lignefactureclient, $tab);
                            if ($this->fetchTable('Lignefactures')->save($lignefactures)) {
                                $article = $this->fetchTable('Articles')->get($liv['article_idd']);
                                // debug($article);die;
                                $article->prixachat = $liv['prix'];
                                $this->fetchTable('Articles')->save($article);
                            } else {
                            }
                        }

                        //   $this->set(compact("Lignefactures"));
                    }
                }
                $lignefacture = $this->Factures->Lignefactures->find('all', [
                    'contain' => ['Articles']
                ])
                    ->where(['facture_id' => $id]);
                //  $this->Flash->success(__('The {0} has been saved.', 'Facture'));

                return $this->redirect(['action' => 'index/' . $typef . '/' . $typefac]);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Facture'));
        }
        //$commandes = $this->Factures->Commandes->find('list');

        $fournisseurs = $this->Factures->Fournisseurs->find('list');
        /// $pointdeventes = $this->Factures->Pointdeventes->find('list');
        $depots = $this->Factures->Depots->find('list');
        $cartecarburants = $this->Factures->Cartecarburants->find('list');
        $materieltransports = $this->Factures->Materieltransports->find('list');
        // $lignes = $this->Lignefactures->find()->where(["Facture_id" => $id])->all();
        $lignes = $this->Lignefactures->find()
            ->where(["facture_id" => $id])
            ->contain('Articles') // Contient la relation Articles
            ->all();

        ///debug($lignes);
        $count = $this->Lignefactures->find()->where(["Facture_id" => $id])->count();
        $adresselivraisonfournisseurs = $this->Factures->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
        $this->loadModel('Personnels');
        // $articles = $this->Articles->find('all');
        $articles = $this->fetchTable('Articles')->find('all', [
            'contain' => [],
        ]);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id  ='" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id ='" . 1 . "%' "]);



        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $this->set(compact('machines', 'services', 'timbre', 'typefac', 'typef', 'conffaieurs', 'chauffeurs', 'facture', 'lignes', 'count', 'articles', 'fournisseurs', 'adresselivraisonfournisseurs', 'depots', 'cartecarburants', 'materieltransports'));
    }



    public function editsalma($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Adresselivraisonclients'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');



        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData());
            $factureclient = $this->Factureclients->patchEntity($factureclient, $this->request->getData());
            if ($this->Factureclients->save($factureclient)) {



                $this->misejour("Factureclients", "edit", $id);


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //  debug($l);

                        if ($l['supp'] != 1) {
                            $tab['bonlivraison_id'] = $id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['prixht'] = $l['prixht'];
                            $tab['remise'] = $l['remise'];
                            $tab['punht'] = $l['punht'];

                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['ttc'] = $l['ttc'];

                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            };

                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->patchEntity($lignefactureclient, $tab);
                            //  debug($lignefactureclient);

                            $this->fetchTable('Lignefactureclients')->save($lignefactureclient);
                        } else if (isset($l['id']) && (!empty($l['id']))) {

                            //S  $this->request->allowMethod(['post', 'delete']);
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id']);

                            $this->fetchTable('Lignefactureclients')->delete($lignefactureclient);
                        }
                    }
                }









                // $this->Flash->success(__('The {0} has been saved.', 'facture'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'facture'));
        }
        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);
    }

    /* foreach($lignebonlivraisons as $l){
            debug($l);}*/












    /**
     * Delete method
     *
     * @param string|null $id Facture id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        //   debug($liendd);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'factures') {
                $fournisseur = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Lignefactures');
        $this->request->allowMethod(['post', 'delete']);
        $facture = $this->Factures->get($id);

        // debug($facture);


        if ($this->Factures->delete($facture)) {


            $this->loadModel('Livraisons');
            $livraisons = $this->Livraisons->find('all', [
                'conditions' => ['facture_id' => $id]
            ]);

            foreach ($livraisons as $livraison) {
                $livraison->facture_id = 0;
                $this->Livraisons->save($livraison);
            }

            $lignefactures = $this->Lignefactures->find('all', [])
                ->where(['facture_id' => $id]);
            foreach ($lignefactures as $c) {

                $this->Lignefactures->delete($c);
            }

            $paiementfactures = $this->fetchTable('Paiementfactures')->find('all', [])
                ->where(['facture_id' => $id]);
            foreach ($paiementfactures as $pf) {

                $this->fetchTable('Paiementfactures')->delete($pf);
            }
        } else {
        }


        return $this->redirect(['action' => 'index/' . $facture->typef . '/' . $facture->typefac]);
    }

    public function getLigneLivraisons()
    {
        $this->loadModel('Livraisons');
        $livraison = $this->Livraisons->get($_GET['livraison_id']);
        $this->loadModel('Lignelivraisons');
        $lignes = $this->Lignelivraisons->find()->where(["Livraison_id" => $_GET['livraison_id']])->all();
        $count = $this->Lignelivraisons->find()->where(["Livraison_id" => $_GET['livraison_id']])->count();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        echo json_encode(array("lignes" => $lignes, 'count' => $count, 'articles' => $articles, 'livraison' => $livraison, "success" => true));
        exit;
    }





    public function addservice($typef = null, $typefact = null)
    {


        $num = $this->Factures->find()->select(["num" =>
        'MAX(Factures.numero)'])->first();
        // debug($num);
        $n = $num->num;
        /// debug($n);
        // $int=intval($n);
        $in = intval($n) + 1;
        // debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);

        // debug($mm);

        $factureservice = $this->Factures->newEmptyEntity();

        if ($this->request->is('post')) {

            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $data['typefacture_id'] = $this->request->getData('typefacture_id');
            $data['typef'] = $typef;
            $data['typefac'] = $typefact;
            $data['adresselivraisonfournisseur'] = $this->request->getData('adresselivraisonfournisseur');
            $data['devise'] = $this->request->getData('devise');
            $data['taux'] = $this->request->getData('taux');
            $data['dossierimportation_id'] = $this->request->getData('dossierimportation_id');
            $data['totaltva'] = $this->request->getData('tvacommande');
            $data['remise'] = $this->request->getData('remise');
            $data['tva'] = $this->request->getData('tva');
            $data['fodec'] = $this->request->getData('fodec');
            $data['ht'] = $this->request->getData('ht');
            $data['ttc'] = $this->request->getData('ttc');


            /// debug($data); die ;

            $factureservice = $this->Factures->patchEntity($factureservice, $data);


            //debug($factureservice->toArray());
            if ($this->Factures->save($factureservice)) {

                $facture_id = $factureservice->id;

                ///debug($facture_id) ;

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $c) {
                        if ($c['sup'] != 1) {

                            $lignefac = $this->fetchTable('Lignefactures')->newEmptyEntity();

                            $tab['facture_id'] = $facture_id;
                            $tab['qte'] = $c['qte'];
                            $tab['article_id'] = $c['article_id'];
                            $tab['charge_id'] = $c['charge_id'];
                            $tab['prix'] = $c['prix'];
                            $tab['remise'] = $c['remise'];
                            $tab['ht'] = $c['ht'];
                            $tab['fodec'] = $c['fodec'];
                            $tab['tva'] = $c['tvaa'];
                            $tab['ttc'] = $c['ttc'];

                            ///debug($tab);

                            $lignefac = $this->fetchTable('Lignefactures')->patchEntity($lignefac, $tab);
                            $this->fetchTable('Lignefactures')->save($lignefac);

                            //debug($lignefac);
                        }
                    }
                }
            }

            return $this->redirect(['action' => 'index/' . $typef . '/' . 1]);
        }



        $depot = $this->fetchTable('Depots')->find()->select(["nom" =>
        'name'])->first();
        //debug($depot);
        $dep = $depot->nom;
        ///debug($dep);



        $depots = $this->Factures->Depots->find('all');
        $paiements = $this->Factures->Paiements->find('list');
        $cond00 = 'Fournisseurs.typelocalisation_id = 1 ';
        $cond01 = 'Fournisseurs.typelocalisation_id = 2 ';
        if ($typef == 1) {
            $fournisseurs = $this->Factures->Fournisseurs->find('list')->where([$cond00]);
        }


        if ($typef == 2) {
            $fournisseurs = $this->Factures->Fournisseurs->find('list')->where([$cond01]);
        }

        $dossierimportations = $this->Factures->Dossierimportations->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $devises = $this->Factures->Devises->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $cond = 'Articles.famille_id != 1 ';
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all')->where([$cond]);
        $this->loadModel('Charges');
        $charges = $this->Charges->find('all');

        $typefactures = $this->fetchTable('Typefactures')->find('all');


        $this->loadModel('Personnels');
        // $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id =  '" . 5 . "' "]);
        // $conffaieurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id =  '" . 1 . "' "]);
        $materieltransports = $this->Factures->Materieltransports->find('list');
        $cartecarburants = $this->Factures->Cartecarburants->find('list');


        $this->set(compact('dep', 'typefactures', 'mm', 'paiements', 'typef', 'typefact', 'dossierimportations', 'materieltransports', 'articles', 'fournisseurs',  'depots', 'cartecarburants', 'factureservice', 'charges', 'devises'));
    }


    public function getadresse($id = null)
    {

        $id = $this->request->getQuery('id');

        $fournisseurs = $this->fetchTable('Fournisseurs')->find('all')
            ->where(["Fournisseurs.id  ='" . $id . "'"]);

        foreach ($fournisseurs as $li) {
            $adr = $li['adresse'];
        }
        echo json_encode(array("adresse" => $adr, "success" => true));
        die;
    }


    public function gettitre($id = null)
    {

        $id = $this->request->getQuery('id');

        $query = $this->fetchTable('Dossierimportations')->find();
        $query->where(['fournisseur_id' => $id]);

        $select = "
       
        <select name='import' id='import-id' class='form-control select2'  '>
                    <option >Veuillez choisir !!</option>";
        foreach ($query as $q) {
            $select =  $select . "  <option value ='" . $q['id'] . "'";
            $select =  $select . " >" . $q['numero'] . "</option>";
        }
        $select = $select . "</select> </div> </div> ";
        echo json_encode(array('select' => $select));
        die;
    }



    public function getdevice($id = null)
    {

        $id = $this->request->getQuery('id');

        $fournisseurs = $this->fetchTable('Fournisseurs')->find('all')
            ->where(["Fournisseurs.id  ='" . $id . "'"]);
        foreach ($fournisseurs as $fr) {


            $dev_id = $fr->devise_id;
        }
        $query = $this->fetchTable('Devises')->find();
        $query->where(['id' => $dev_id]);

        $select = "
       
        <select name='devise' id='devise-id' class='form-control select2'  '>
                    <option >Veuillez choisir !!</option>";
        foreach ($query as $q) {
            $select =  $select . "  <option value ='" . $q['id'] . "'";
            $select =  $select . " >" . $q['name'] . "</option>";
        }
        $select = $select . "</select> </div> </div> ";
        echo json_encode(array('select' => $select));
        die;
    }
}

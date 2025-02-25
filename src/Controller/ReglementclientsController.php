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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    public function getids()
    {
        $tabs = [];
        $connection = ConnectionManager::get('default');
        $tabs = $this->request->getQuery('tabValues');
        //  debug($tabs);
        $tab = explode(',', $tabs);



        $userId = $this->request->getAttribute('authentication')->getIdentity()['id'];
        $user_id = $userId;

        $num = $this->fetchTable('Bordereauversementcheques')->find()
            ->select(["num" => 'MAX(Bordereauversementcheques.numero)'])
            ->where(['Bordereauversementcheques.type=1'])

            ->first();
        $n = $num->num;

        $in = intval($n) + 1;

        $mm = str_pad("$in", 0, "0", STR_PAD_LEFT);
        $numero = $mm;



        ////////////compte////////////
        $compte = $this->fetchTable('Comptes')->find()->first();

        //////////////////sum mnt/////////////

        $sumpiecereglementcheques = $this->fetchTable('Piecereglementclients')->find('all', [
            'conditions' => ['Piecereglementclients.id in (' . $tabs . ')'],
            'contain' => ['Reglementclients']
        ]);
        $mnt = 0;
        foreach ($sumpiecereglementcheques as $s) {
            $mnt += $s->montant;
        }

        //////////Nombre piece////////////
        $count = $this->fetchTable('Piecereglementclients')->find('all', [
            'conditions' => ['Piecereglementclients.id in (' . $tabs . ')'],
            'contain' => ['Reglementclients']
        ])->count();
        /////////////////////////////////

        $date = date('Y-m-d H:i:s');
        $utilisateur_id = $user_id;
        $compte_id = $compte->id;
        $montanttotal = $mnt;
        $observation = 'Bordereau Versement Chéque';
        $situation = 'En Attente';
        $Nomberpiece = $count;
        $integre = 0;
        $name = 0;
        $montant = 0;
        $datefin = NULL;
        $dateimp = date('Y-m-d');
        $type = 2;






        $connection->execute("INSERT INTO bordereauversementcheques 
        (numero, date, utilisateur_id, compte_id, montanttotal, observation, situation, Nomberpiece, integre, name, montant, datefin, dateimp,type) 
        VALUES 
        ($numero, '$date', $utilisateur_id,$compte_id, $montanttotal, '$observation', '$situation', $Nomberpiece, $integre, $name, $montant, '$datefin', '$dateimp',$type)");

        $maxIdResult = $connection->execute("SELECT MAX(id) AS max_id FROM bordereauversementcheques")->fetch('assoc');
        $maxId = $maxIdResult['max_id'];
        $bordereauIds[] = $maxId;


        $piecereglementcheques = $this->fetchTable('Piecereglementclients')->find('all', [
            'conditions' => ['Piecereglementclients.id in (' . $tabs . ')'],
            'contain' => ['Reglementclients']
        ]);
        foreach ($piecereglementcheques as $bb) {

            $bordereauversementcheque_id = $maxId;
            $client_id = $bb->reglementclient->id;
            $banque = $bb->banque_id;
            // $echance = $bb->echance;
            $echance = $bb->echance->format('Y-m-d');

            $piecereglementclient_id = $bb->id;
            $montant = $bb->montant;
            $etat_id = $bb->etat_id;
            $numpiece = $bb->num;
            $situation = $bb->situation;
            $Nomberpiecee = $count;
            $coffre_id = 0;
            $montanttotal = 0;


            $connection->execute("INSERT INTO lignebordereauversementcheques (bordereauversementcheque_id, client_id, banque, echance, piecereglementclient_id, montant, etat_id, numpiece, situation, Nomberpiece, coffre_id,montanttotal) 
                 VALUES ($bordereauversementcheque_id, $client_id,'$banque', '$echance', $piecereglementclient_id ,$montant,'$etat_id', '$numpiece','$situation', $Nomberpiecee,$coffre_id,$montanttotal)
                 ;")->fetchAll('assoc');

            $connection = ConnectionManager::get('default');

            $compte_idd = $bb->compte;
            $requetteupdate = $connection->execute(" UPDATE `piecereglementclients`  SET `etat_id` = 9,  `compte` = '" . $compte_idd . "'  WHERE id = " . $bb->id . ";")->fetchAll('assoc');
            // $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=9 , compte=" . $compte_idd . "  WHERE id=" . $bb->id . ";")->fetchAll('assoc');
        }
        // die;
        echo json_encode(array(
            'jbn' => 0,

        ));
        exit;
    }
    public function getidstr()
    {
        $tabs = [];
        $connection = ConnectionManager::get('default');
        $tabs = $this->request->getQuery('tabValues');
        //  debug($tabs);
        $tab = explode(',', $tabs);



        $userId = $this->request->getAttribute('authentication')->getIdentity()['id'];
        $user_id = $userId;

        $num = $this->fetchTable('Bordereauversementcheques')->find()
            ->select(["num" => 'MAX(Bordereauversementcheques.numero)'])
            ->where(['Bordereauversementcheques.type=1'])
            ->first();
        $n = $num->num;

        $in = intval($n) + 1;

        $mm = str_pad("$in", 0, "0", STR_PAD_LEFT);
        $numero = $mm;



        ////////////compte////////////
        $compte = $this->fetchTable('Comptes')->find()->first();

        //////////////////sum mnt/////////////

        $sumpiecereglementcheques = $this->fetchTable('Piecereglementclients')->find('all', [
            'conditions' => ['Piecereglementclients.id in (' . $tabs . ')'],
            'contain' => ['Reglementclients']
        ]);
        $mnt = 0;
        foreach ($sumpiecereglementcheques as $s) {
            $mnt += $s->montant;
        }

        //////////Nombre piece////////////
        $count = $this->fetchTable('Piecereglementclients')->find('all', [
            'conditions' => ['Piecereglementclients.id in (' . $tabs . ')'],
            'contain' => ['Reglementclients']
        ])->count();
        /////////////////////////////////

        $date = date('Y-m-d H:i:s');
        $utilisateur_id = $user_id;
        $compte_id = $compte->id;
        $montanttotal = $mnt;
        $observation = 'Bordereau Versement Traite';
        $situation = 'En Attente';
        $Nomberpiece = $count;
        $integre = 0;
        $name = 0;
        $montant = 0;
        $datefin = NULL;
        $dateimp = date('Y-m-d');
        $type = 1;





        $connection->execute("INSERT INTO bordereauversementcheques 
        (numero, date, utilisateur_id, compte_id, montanttotal, observation, situation, Nomberpiece, integre, name, montant, datefin, dateimp,type) 
        VALUES 
        ($numero, '$date', $utilisateur_id,$compte_id, $montanttotal, '$observation', '$situation', $Nomberpiece, $integre, $name, $montant, '$datefin', '$dateimp',$type)");

        $maxIdResult = $connection->execute("SELECT MAX(id) AS max_id FROM bordereauversementcheques")->fetch('assoc');
        $maxId = $maxIdResult['max_id'];
        $bordereauIds[] = $maxId;


        $piecereglementcheques = $this->fetchTable('Piecereglementclients')->find('all', [
            'conditions' => ['Piecereglementclients.id in (' . $tabs . ')'],
            'contain' => ['Reglementclients']
        ]);
        foreach ($piecereglementcheques as $bb) {

            $bordereauversementcheque_id = $maxId;
            $client_id = $bb->reglementclient->id;
            $banque = $bb->banque_id;
            // $echance = $bb->echance;
            $echance = $bb->echance->format('Y-m-d');

            $piecereglementclient_id = $bb->id;
            $montant = $bb->montant;
            $etat_id = $bb->etat_id;
            $numpiece = $bb->num;
            $situation = $bb->situation;
            $Nomberpiecee = $count;
            $coffre_id = 0;
            $montanttotal = 0;


            $connection->execute("INSERT INTO lignebordereauversementcheques (bordereauversementcheque_id, client_id, banque, echance, piecereglementclient_id, montant, etat_id, numpiece, situation, Nomberpiece, coffre_id,montanttotal) 
                 VALUES ($bordereauversementcheque_id, $client_id,'$banque', '$echance', $piecereglementclient_id ,$montant,'$etat_id', '$numpiece','$situation', $Nomberpiecee,$coffre_id,$montanttotal)
                 ;")->fetchAll('assoc');

            $connection = ConnectionManager::get('default');

            $compte_idd = $bb->compte;
            $requetteupdate = $connection->execute(" UPDATE `piecereglementclients`  SET `etat_id` = 9,  `compte` = '" . $compte_idd . "'  WHERE id = " . $bb->id . ";")->fetchAll('assoc');
            // $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=9 , compte=" . $compte_idd . "  WHERE id=" . $bb->id . ";")->fetchAll('assoc');
        }
        // die;
        echo json_encode(array(
            'jbn' => 0,

        ));
        exit;
    }

    public function afflesecheancestr()
    {

        $connection = ConnectionManager::get('default');
        $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' -20 day'));

        $echeances = $connection->execute("SELECT * from piecereglementclients where  echance <='" . $dateauj . "' and piecereglementclients.etat_id !=9 and  paiement_id in (3)")->fetchAll('assoc');
        $this->set(compact('clients', 'reglementclients', 'type', 'factures', 'echeances'));
    }
    public function afflesecheances()
    {

        $connection = ConnectionManager::get('default');
        $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));

        $echeances = $connection->execute("SELECT * from piecereglementclients where  echance <='" . $dateauj . "' and piecereglementclients.etat_id !=9 and  paiement_id in (2,3)")->fetchAll('assoc');
        $this->set(compact('clients', 'reglementclients', 'type', 'factures', 'echeances'));
    }
    public function index($type = null)
    {
        $this->loadModel('Clients');
        error_reporting(E_ERROR | E_PARSE);
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';



        $numero = $this->request->getQuery('numero');

        $datedebut = $this->request->getQuery('datedebut');
        // debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        // debug($datefin);
        $client_id = $this->request->getQuery('client_id');
        // debug($client_id);





        if ($numero) {
            $cond1 = "Reglementclients.numero   = '" . $numero . "' ";
        }

        if ($datedebut) {
            $cond2 = "date(Reglementclients.Date) <= '" . $datedebut . "'";
        }
        if ($datefin) {
            $cond3 = "date(Reglementclients.Date) >= '" . $datefin . "'";
        }
        if ($client_id) {
            $cond4 = "Reglementclients.client_id = '" . $client_id . "' ";
        }



        $this->paginate = [
            'contain' => ['Utilisateurs', 'Clients'],
        ];

        $query = $this->Reglementclients->find('all')->where(['Reglementclients.type=' . $type, @$cond1, @$cond2, @$cond3, @$cond4])->contain(['Clients', 'Users'])->order(["Reglementclients.id" => 'desc']);;
        $factures = $this->paginate($query);

        $query1 = $this->Reglementclients->find('all')->where(['Reglementclients.type =' . $type, @$cond1, @$cond2, @$cond3, @$cond4])->contain(['Clients', 'Users'])->order(["Reglementclients.id" => 'desc']);
        $bonlivraisons = $this->paginate($query1);
        // debug($bonlivraisons);

        $clients = $this->Clients->find('all');

        $this->set(compact('clients', 'reglementclients', 'type', 'factures', 'bonlivraisons'));
    }
    public function etatimpayepaye()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Comptes');

        $cond1 = '';
        $cond2 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        $condet = '';
        $modeid = 2;
        $cond1 = 'Piecereglementclients.paiement_id = ' . $modeid;

        // Get query parameters
        $clientid = $this->request->getQuery('client_id');
        if (!empty($clientid)) {
            $cond2 = 'Reglementclients.client_id = ' . $clientid;
        }

        $echance = $this->request->getQuery('echance');
        if (!empty($echance)) {
            $cond4 = 'date(Piecereglementclients.echance) >=  ' . "'" . $echance . "'";
        }

        $echance2 = $this->request->getQuery('echance2');
        if (!empty($echance2)) {
            $cond7 = 'date(Piecereglementclients.echance2) >=  ' . "'" . $echance2 . "'";
        }

        $etat_id = $this->request->getQuery('etat_id');
        if (!empty($etat_id)) {
            $condet = 'Piecereglementclients.etat_id = ' . $etat_id;
        }
        // $datereg = $this->request->getQuery('date');
        // if (!empty($datereg)) {
        //     $cond5 = 'date(Reglementclients.date) >=  ' . "'" . $datereg . "'";
        // }

        $endosse = $this->request->getQuery('endosse');
        if (!empty($endosse)) {
            $cond6 = "Piecereglementclients.endosse LIKE '%" . $endosse . "%'";
        }


        $subquery = $this->Piecereglementclients->Etatreglementclients->find()
            ->select(['piecereglementclient_id'])
            ->where(['Etatreglementclients.etat_id' => 3])
            ->andWhere([$cond4, $cond2, $cond6, $cond7])
            ->distinct(['piecereglementclient_id']);

        $piecereglements = $this->Piecereglementclients->find('all')
            ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
            ->where(['Piecereglementclients.id IN' => $subquery, $condet])
            ->andWhere(['Paiements.id' => '2'])
            ->order(['Piecereglementclients.id' => 'ASC'])
            ->toArray();
        // debug($piecereglements);

        $count = count($piecereglements);

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyField' => 'id', 'valueField' => 'Raison_Sociale']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Paiements.id' => 2]);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['id = 3']);
        $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('piecereglements', 'count', 'etats', 'agences', 'etat_id', 'comptes', 'modes', 'clients', 'echance', 'modeid', 'clientid', 'datereg', 'endosse', 'echance2'));
    }
    
    public function impetatimpayepaye()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Comptes');

        $cond1 = '';
        $cond2 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        $condet = '';
        $modeid = 2;
        $cond1 = 'Piecereglementclients.paiement_id = ' . $modeid;

        // Get query parameters
        $clientid = $this->request->getQuery('client_id');
        if (!empty($clientid)) {
            $cond2 = 'Reglementclients.client_id = ' . $clientid;
        }

        $echance = $this->request->getQuery('echance');
        if (!empty($echance)) {
            $cond4 = 'date(Piecereglementclients.echance) >=  ' . "'" . $echance . "'";
        }

        $echance2 = $this->request->getQuery('echance2');
        if (!empty($echance2)) {
            $cond7 = 'date(Piecereglementclients.echance2) >=  ' . "'" . $echance2 . "'";
        }

        $etat_id = $this->request->getQuery('etat_id');
        if (!empty($etat_id)) {
            $condet = 'Piecereglementclients.etat_id = ' . $etat_id;
        }
        // $datereg = $this->request->getQuery('date');
        // if (!empty($datereg)) {
        //     $cond5 = 'date(Reglementclients.date) >=  ' . "'" . $datereg . "'";
        // }

        $endosse = $this->request->getQuery('endosse');
        if (!empty($endosse)) {
            $cond6 = "Piecereglementclients.endosse LIKE '%" . $endosse . "%'";
        }


        $subquery = $this->Piecereglementclients->Etatreglementclients->find()
            ->select(['piecereglementclient_id'])
            ->where(['Etatreglementclients.etat_id' => 3])
            ->andWhere([$cond4, $cond2, $cond6, $cond7])
            ->distinct(['piecereglementclient_id']);

        $piecereglements = $this->Piecereglementclients->find('all')
            ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
            ->where(['Piecereglementclients.id IN' => $subquery, $condet])
            ->andWhere(['Paiements.id' => '2'])
            ->order(['Piecereglementclients.id' => 'ASC'])
            ->toArray();
        // debug($piecereglements);

        $count = count($piecereglements);

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyField' => 'id', 'valueField' => 'Raison_Sociale']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Paiements.id' => 2]);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['id = 3']);
        $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('piecereglements', 'count', 'etats', 'agences', 'etat_id', 'comptes', 'modes', 'clients', 'echance', 'modeid', 'clientid', 'datereg', 'endosse', 'echance2'));
    }
    
    public function etatimpaye29122024()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Comptes');

        $cond1 = '';
        $cond2 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        $condet = '';
        $modeid = 2;
        $cond1 = 'Piecereglementclients.paiement_id = ' . $modeid;

        // Get query parameters
        $clientid = $this->request->getQuery('client_id');
        if (!empty($clientid)) {
            $cond2 = 'Reglementclients.client_id = ' . $clientid;
        }

        $echance = $this->request->getQuery('echance');
        if (!empty($echance)) {
            $cond4 = 'date(Piecereglementclients.echance) >=  ' . "'" . $echance . "'";
        }

        $echance2 = $this->request->getQuery('echance2');
        if (!empty($echance2)) {
            $cond7 = 'date(Piecereglementclients.echance2) >=  ' . "'" . $echance2 . "'";
        }

        $etat_id = $this->request->getQuery('etat_id');
        if (!empty($etat_id)) {
            $condet = 'Piecereglementclients.etat_id = ' . $etat_id;
        }
        // $datereg = $this->request->getQuery('date');
        // if (!empty($datereg)) {
        //     $cond5 = 'date(Reglementclients.date) >=  ' . "'" . $datereg . "'";
        // }

        $endosse = $this->request->getQuery('endosse');
        if (!empty($endosse)) {
            $cond6 = "Piecereglementclients.endosse LIKE '%" . $endosse . "%'";
        }


        $subquery = $this->Piecereglementclients->Etatreglementclients->find()
            ->select(['piecereglementclient_id'])
            ->where(['Etatreglementclients.etat_id' => 3])
            ->andWhere([$cond4, $cond2, $cond6, $cond7])
            ->distinct(['piecereglementclient_id']);

        $piecereglements = $this->Piecereglementclients->find('all')
            ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
            ->where(['Piecereglementclients.id IN' => $subquery, $condet])
            ->andWhere(['Paiements.id' => '2'])
            ->order(['Piecereglementclients.id' => 'ASC'])
            ->toArray();
        // debug($piecereglements);

        $count = count($piecereglements);

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyField' => 'id', 'valueField' => 'Raison_Sociale']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Paiements.id' => 2]);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['id = 3']);
        $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('piecereglements', 'count', 'etats', 'agences', 'etat_id', 'comptes', 'modes', 'clients', 'echance', 'modeid', 'clientid', 'datereg', 'endosse', 'echance2'));
    }
    public function etatimpaye()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Comptes');

        $cond1 = '';
        $cond2 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        $condet = '';
        $modeid = 2;
        $cond1 = 'Piecereglementclients.paiement_id = ' . $modeid;

        // Get query parameters
        $clientid = $this->request->getQuery('client_id');
        if (!empty($clientid)) {
            $cond2 = 'Reglementclients.client_id = ' . $clientid;
        }

        $echance = $this->request->getQuery('echance');
        if (!empty($echance)) {
            $cond4 = 'date(Piecereglementclients.echance) >=  ' . "'" . $echance . "'";
        }

        $echance2 = $this->request->getQuery('echance2');
        if (!empty($echance2)) {
            $cond7 = 'date(Piecereglementclients.echance2) >=  ' . "'" . $echance2 . "'";
        }

        $etat_id = $this->request->getQuery('etat_id');
        if (!empty($etat_id)) {
            $condet = 'Piecereglementclients.etat_id = ' . $etat_id;
        }
        // $datereg = $this->request->getQuery('date');
        // if (!empty($datereg)) {
        //     $cond5 = 'date(Reglementclients.date) >=  ' . "'" . $datereg . "'";
        // }

        $endosse = $this->request->getQuery('endosse');
        if (!empty($endosse)) {
            $cond6 = "Piecereglementclients.endosse LIKE '%" . $endosse . "%'";
        }


      /*  $subquery = $this->Piecereglementclients->Etatreglementclients->find()
            ->select(['piecereglementclient_id'])
            ->where(['Etatreglementclients.etat_id' => 3])
            ->andWhere([$cond4, $cond2, $cond6, $cond7])
            ->distinct(['piecereglementclient_id']);*/

        $piecereglements = $this->Piecereglementclients->find('all')
            ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
            ->where([/*'Piecereglementclients.id IN' => $subquery, */ 'Piecereglementclients.etat_id' => 3,$condet])
            ->andWhere(['Paiements.id' => '2'])
            ->order(['Piecereglementclients.id' => 'ASC'])
            ->toArray();
        // debug($piecereglements);

        $count = count($piecereglements);

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyField' => 'id', 'valueField' => 'Raison_Sociale']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Paiements.id' => 2]);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['id = 3']);
        $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('piecereglements', 'count', 'etats', 'agences', 'etat_id', 'comptes', 'modes', 'clients', 'echance', 'modeid', 'clientid', 'datereg', 'endosse', 'echance2'));
    }

    public function impetatimpaye()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Comptes');

        $cond1 = '';
        $cond2 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        $condet = '';
        $modeid = 2;
        $cond1 = 'Piecereglementclients.paiement_id = ' . $modeid;

        // Get query parameters
        $clientid = $this->request->getQuery('client_id');
        if (!empty($clientid)) {
            $cond2 = 'Reglementclients.client_id = ' . $clientid;
        }

        $echance = $this->request->getQuery('echance');
        if (!empty($echance)) {
            $cond4 = 'date(Piecereglementclients.echance) >=  ' . "'" . $echance . "'";
        }

        $echance2 = $this->request->getQuery('echance2');
        if (!empty($echance2)) {
            $cond7 = 'date(Piecereglementclients.echance2) >=  ' . "'" . $echance2 . "'";
        }

        $etat_id = $this->request->getQuery('etat_id');
        if (!empty($etat_id)) {
            $condet = 'Piecereglementclients.etat_id = ' . $etat_id;
        }
        // $datereg = $this->request->getQuery('date');
        // if (!empty($datereg)) {
        //     $cond5 = 'date(Reglementclients.date) >=  ' . "'" . $datereg . "'";
        // }

        $endosse = $this->request->getQuery('endosse');
        if (!empty($endosse)) {
            $cond6 = "Piecereglementclients.endosse LIKE '%" . $endosse . "%'";
        }


      /*  $subquery = $this->Piecereglementclients->Etatreglementclients->find()
            ->select(['piecereglementclient_id'])
            ->where(['Etatreglementclients.etat_id' => 3])
            ->andWhere([$cond4, $cond2, $cond6, $cond7])
            ->distinct(['piecereglementclient_id']);*/

        $piecereglements = $this->Piecereglementclients->find('all')
            ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
            ->where([/*'Piecereglementclients.id IN' => $subquery, */ 'Piecereglementclients.etat_id' => 3,$condet])
            ->andWhere(['Paiements.id' => '2'])
            ->order(['Piecereglementclients.id' => 'ASC'])
            ->toArray();
        // debug($piecereglements);

        $count = count($piecereglements);

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyField' => 'id', 'valueField' => 'Raison_Sociale']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Paiements.id' => 2]);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['id = 3']);
        $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('piecereglements', 'count', 'etats', 'agences', 'etat_id', 'comptes', 'modes', 'clients', 'echance', 'modeid', 'clientid', 'datereg', 'endosse', 'echance2'));
    }
    public function indexengcltfour1410()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $this->loadModel('Comptes');
        if ($this->request->getQuery()) {

            $cond1 = '';
            $cond11 = '';
            $cond2 = '';
            $cond22 = '';
            //  $cond3 = '';
            $cond4 = '';
            $cond44 = '';
            $cond5 = '';
            $cond55 = '';
            $cond6 = '';
            $cond7 = '';

            $modeid = $this->request->getQuery('paiement_id');
            if (!empty($modeid)) {

                $cond1 = 'Piecereglementclients.paiement_id =' . $modeid;
                $cond11 = 'Piecereglements.paiement_id =' . $modeid;
            }
            // debug($modeid);

            $clientid = $this->request->getQuery('client_id');
            if (!empty($clientid)) {
                $cond2 = 'Reglementclients.client_id =' . $clientid;
            }

            $fournisseurid = $this->request->getQuery('fournisseur_id');
            if (!empty($fournisseurid)) {
                $cond22 = 'Reglementclients.fournisseur_id =' . $fournisseurid;
            }

            $echance = $this->request->getQuery('echance');
            // debug($echance);

            if (!empty($echance)) {
                $cond4 = 'date(Piecereglementclients.echance) >=  ' . "'" . $echance . "'";
                $cond44 = 'date(Piecereglements.echance) >=  ' . "'" . $echance . "'";
            }


            $datereg = $this->request->getQuery('date');
            // debug($datereg);
            if (!empty($datereg)) {
                $cond5 = 'date(Reglementclients.date) >=  ' . "'" . $datereg . "'";

                $cond55 = 'date(Reglementachats.date) >=  ' . $datereg . " '";
            }

            $data = [];
            //  debug($cond6);
            $reglementventes = $this->fetchTable('Reglementclients')->find('all', [
                'contain' => ['Clients'],
            ])
                ->where([$cond2, $cond5])
                ->toArray();

            $piecereglementventes = $this->Piecereglementclients->find('all')
                ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
                ->where([$cond1, $cond4, $cond2, $cond5, 'Paiements.id' => '2'])
                ->toArray();

            $reglementachats = $this->fetchTable('Reglements')->find('all', [
                'contain' => ['Fournisseurs'],
            ])
                ->where([$cond22, $cond55])
                ->toArray();

            $piecereglementachats = $this->Piecereglements->find('all')
                ->contain(['Paiements', 'Etats', 'Reglements' => ['Fournisseurs']])
                ->where([$cond11, $cond44, $cond22, $cond55, 'Paiements.id' => '2'])
                ->toArray();
            foreach ($piecereglementachats as $p) {
                $data[] = [
                    'fournisseur' => $p->reglement->fournisseur->name,
                    'code' => $p->reglement->fournisseur->code,
                    'soldedepart' => $p->reglement->fournisseur->soldedebut,
                    'Debit' => $p->montant,
                    'Credit' => '',
                    'client' => '',
                    'index' => '1',
                ];
            }
            foreach ($piecereglementventes as $pv) {
                $data[] = [
                    'client' => $pv->reglementclient->client->Raison_Sociale,
                    'code' => $pv->reglementclient->client->Code,
                    'soldedepart' => $pv->reglement->client->soldedebut,
                    'Debit' => '',
                    'Credit' => $pv->montant,
                    'fournisseur' => '',
                    'index' => '2',
                ];
            }
        }

        $reglementventes = $this->fetchTable('Reglementclients')->find('all', [
            'contain' => ['Clients'],
        ])
            ->where([$cond2, $cond5])
            ->toArray();

        $piecereglementventes = $this->Piecereglementclients->find('all')
            ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
            ->where([$cond1, $cond4, $cond2, $cond5, 'Paiements.id' => '2'])
            ->toArray();

        $reglementachats = $this->fetchTable('Reglements')->find('all', [
            'contain' => ['Fournisseurs'],
        ])
            ->where([$cond22, $cond55])
            ->toArray();

        $piecereglementachats = $this->Piecereglements->find('all')
            ->contain(['Paiements', 'Etats', 'Reglements' => ['Fournisseurs']])
            ->where([$cond11, $cond44, $cond22, $cond55, 'Paiements.id' => '2'])
            ->toArray();
        foreach ($piecereglementachats as $p) {
            $data[] = [
                'fournisseur' => $p->reglement->fournisseur->name,
                'code' => $p->reglement->fournisseur->code,
                'soldedepart' => $p->reglement->fournisseur->soldedebut,
                'Debit' => $p->montant,
                'Credit' => '',
                'client' => '',
                'index' => '1',
            ];
        }
        foreach ($piecereglementventes as $pv) {
            $data[] = [
                'client' => $pv->reglementclient->client->Raison_Sociale,
                'code' => $pv->reglementclient->client->Code,
                'soldedepart' => $pv->reglement->client->soldedebut,
                'Debit' => '',
                'Credit' => $pv->montant,
                'fournisseur' => '',
                'index' => '2',
            ];
        }
        // $count = count($data);

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        //  debug($fournisseurs->toarray());
        $clients = $this->fetchTable('Clients')->find('list', ['keyField' => 'id', 'valueField' => 'Raison_Sociale']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Paiements.id' => '2']);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('reglements', 'fournisseurs', 'piecereglements', 'data', 'count', 'etats', 'agences', 'comptes', 'modes', 'clients', 'echance', 'modeid', 'clientid', 'compteid', 'modes', 'datereg', 'fournisseurid'));
    }

    public function indexengcltfour()
    {
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Paiements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');

        $data = [];
        $modeid = $this->request->getQuery('paiement_id');
        $clientid = $this->request->getQuery('client_id');
        $fournisseurid = $this->request->getQuery('fournisseur_id');
        $datereg = $this->request->getQuery('date');
        $echance = $this->request->getQuery('echance');
        if ($this->request->getQuery()) {
            $conditionsClient = [];
            $conditionsFournisseur = [];

            // $modeid = $this->request->getQuery('paiement_id');
            if (!empty($modeid)) {
                $conditionsClient['Piecereglementclients.paiement_id'] = $modeid;
                $conditionsFournisseur['Piecereglements.paiement_id'] = $modeid;
            }

            // $clientid = $this->request->getQuery('client_id');
            if (!empty($clientid)) {
                $conditionsClient['Reglementclients.client_id'] = $clientid;
            }

            // $fournisseurid = $this->request->getQuery('fournisseur_id');
            if (!empty($fournisseurid)) {
                $conditionsFournisseur['Reglements.fournisseur_id'] = $fournisseurid;
            }

            // $datereg = $this->request->getQuery('date');
            if (!empty($datereg)) {
                $conditionsClient['date(Reglementclients.date) >='] = $datereg;
                $conditionsFournisseur['date(Reglements.Date) >='] = $datereg;
            }

            // $echance = $this->request->getQuery('echance');
            if (!empty($echance)) {
                $conditionsClient['date(Piecereglementclients.echance) >='] = $echance;
                $conditionsFournisseur['date(Piecereglements.echance) >='] = $echance;
            }

            $piecereglementventes = $this->Piecereglementclients->find('all')
                ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
                ->where($conditionsClient)
                ->andWhere(['Piecereglementclients.etat_id IN' => [3, 1]])
                ->toArray();

            foreach ($piecereglementventes as $pv) {
                $data[] = [
                    'date' => $pv->reglementclient->date,
                    'client' => $pv->reglementclient->client->Raison_Sociale,
                    'code' => $pv->reglementclient->client->Code,
                    'debit' => 0,
                    'num' => $pv->num,
                    'credit' => $pv->montant,
                    'fournisseur' => '',
                    'echance' => $pv->echance,
                    'index' => '1',
                ];
            }

            $piecereglementachats = $this->Piecereglements->find('all')
                ->contain(['Paiements', 'Etats', 'Reglements' => ['Fournisseurs']])
                ->where($conditionsFournisseur)
                ->andWhere(['Piecereglements.etat_id IN' => [3, 1]])
                ->toArray();

            foreach ($piecereglementachats as $p) {
                // debug($p->montant);
                $data[] = [
                    'date' => $p->reglement->Date,
                    'fournisseur' => $p->reglement->fournisseur->name,
                    'code' => $p->reglement->fournisseur->code,
                    'credit' => 0,
                    'num' => $p->num,
                    'echance' => $p->echance,

                    'debit' => $p->montant,
                    'client' => '',
                    'index' => '2',
                ];
            }
        }
        $count = count($data);

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        //   debug($data);
        $clients = $this->fetchTable('Clients')->find('list', ['keyField' => 'id', 'valueField' => 'Raison_Sociale']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Paiements.id' => '2']);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('reglements', 'fournisseurs', 'piecereglements', 'data', 'count', 'etats', 'agences', 'comptes', 'modes', 'clients', 'echance', 'modeid', 'clientid', 'compteid', 'modes', 'datereg', 'fournisseurid'));
    }
    public function impengcltfour()
    {
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Paiements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');

        $data = [];
        $modeid = $this->request->getQuery('paiement_id');
        $clientid = $this->request->getQuery('client_id');
        $fournisseurid = $this->request->getQuery('fournisseur_id');
        $datereg = $this->request->getQuery('date');
        $echance = $this->request->getQuery('echance');
        if ($this->request->getQuery()) {
            $conditionsClient = [];
            $conditionsFournisseur = [];

            // $modeid = $this->request->getQuery('paiement_id');
            if (!empty($modeid)) {
                $conditionsClient['Piecereglementclients.paiement_id'] = $modeid;
                $conditionsFournisseur['Piecereglements.paiement_id'] = $modeid;
            }

            // $clientid = $this->request->getQuery('client_id');
            if (!empty($clientid)) {
                $conditionsClient['Reglementclients.client_id'] = $clientid;
            }

            // $fournisseurid = $this->request->getQuery('fournisseur_id');
            if (!empty($fournisseurid)) {
                $conditionsFournisseur['Reglements.fournisseur_id'] = $fournisseurid;
            }

            // $datereg = $this->request->getQuery('date');
            if (!empty($datereg)) {
                $conditionsClient['date(Reglementclients.date) >='] = $datereg;
                $conditionsFournisseur['date(Reglements.Date) >='] = $datereg;
            }

            // $echance = $this->request->getQuery('echance');
            if (!empty($echance)) {
                $conditionsClient['date(Piecereglementclients.echance) >='] = $echance;
                $conditionsFournisseur['date(Piecereglements.echance) >='] = $echance;
            }

            $piecereglementventes = $this->Piecereglementclients->find('all')
                ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
                ->where($conditionsClient)
                ->andWhere(['Piecereglementclients.etat_id IN' => [3, 1]])

                // ->andwhere('Piecereglementclients.etat_id=2')
                ->toArray();

            foreach ($piecereglementventes as $pv) {
                $data[] = [
                    'date' => $pv->reglementclient->date,
                    'client' => $pv->reglementclient->client->Raison_Sociale,
                    'code' => $pv->reglementclient->client->Code,
                    'credit' => $pv->montant,
                    'num' => $pv->num,
                    'debit' => 0,
                    'fournisseur' => '',
                    'echance' => $pv->echance,
                    'index' => '1',
                ];
            }

            $piecereglementachats = $this->Piecereglements->find('all')
                ->contain(['Paiements', 'Etats', 'Reglements' => ['Fournisseurs']])
                ->where($conditionsFournisseur)
                ->andWhere(['Piecereglements.etat_id IN' => [3, 1]])

                // ->andwhere('Piecereglements.etat_id=2')
                ->toArray();

            foreach ($piecereglementachats as $p) {
                $data[] = [
                    'date' => $p->reglement->Date,
                    'fournisseur' => $p->reglement->fournisseur->name,
                    'code' => $p->reglement->fournisseur->code,
                    'debit' => $p->montant,
                    'num' => $p->num,
                    'echance' => $p->echance,

                    'credit' => 0,
                    'client' => '',
                    'index' => '2',
                ];
            }
        }
        $count = count($data);

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        //   debug($data);
        $clients = $this->fetchTable('Clients')->find('list', ['keyField' => 'id', 'valueField' => 'Raison_Sociale']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Paiements.id' => '2']);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('reglements', 'fournisseurs', 'piecereglements', 'data', 'count', 'etats', 'agences', 'comptes', 'modes', 'clients', 'echance', 'modeid', 'clientid', 'compteid', 'modes', 'datereg', 'fournisseurid'));
    }
    public function indexengclient()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Comptes');
        if ($this->request->getQuery()) {

            $cond1 = '';
            $cond2 = '';
            //  $cond3 = '';
            $cond4 = '';
            $cond5 = '';
            $cond6 = '';
            $cond7 = '';

            $modeid = $this->request->getQuery('paiement_id');
            if (!empty($modeid)) {

                $cond1 = 'Piecereglementclients.paiement_id =' . $modeid;
            }
            // debug($modeid);

            $clientid = $this->request->getQuery('client_id');
            if (!empty($clientid)) {
                //$conditions2['Reglementachats.fournisseur_id'] = $fournisseurid;
                $cond2 = 'Reglementclients.client_id =' . $clientid;
            }

            // $compteid = $this->request->getQuery('compte_id');
            // if (!empty($compteid)) {
            //     $cond3 = 'Piecereglementclients.compte_id =' . $compteid;

            // }
            // debug($compteid);
            $echance = $this->request->getQuery('echance');
            // debug($echance);

            if (!empty($echance)) {
                //$conditions1['Piecereglementachats.echance'] = $echance;
                $cond4 = 'date(Piecereglementclients.echance) >=  ' . "'" . $echance . "'";
                // debug($cond4);die;
                //$cond5 = 'Ticketventes.date  <= ' . "'" . $date2 . " 23:59:59'";


            }
            $echance2 = $this->request->getQuery('echance2');

            if (!empty($echance2)) {
                //$conditions1['Piecereglementachats.echance'] = $echance;
                $cond7 = 'date(Piecereglementclients.echance2) >=  ' . "'" . $echance2 . "'";
                // debug($cond4);die;
                //$cond5 = 'Ticketventes.date  <= ' . "'" . $date2 . " 23:59:59'";

            }
            //// debug($echance);

            $datereg = $this->request->getQuery('date');
            // debug($datereg);
            if (!empty($datereg)) {
                $cond5 = 'date(Reglementclients.date) >=  ' . "'" . $datereg . "'";

                //$cond5 = 'Reglementachats.date >=  ' . $datereg . " '";

                // $conditions2['Reglementachats.date >='] = $datereg . " 00:00:00";
                // $conditions2['Reglementachats.date <='] = $datereg . " 23:59:59";

            }
            $endosse = $this->request->getQuery('endosse');
            // debug($endosse);
            if (!empty($endosse)) {
                // $cond6 = "Piecereglementclients.endosse like '" . $endosse . "'";
                $cond6 = "Piecereglementclients.endosse  like  '%" . $endosse . "%' ";
            }

            //  debug($cond6);
            $reglements = $this->fetchTable('Reglementclients')->find('all', [
                'contain' => ['Clients'],
            ])
                ->where([$cond2, $cond5])
                ->toArray(); // Fetch results as an array

            $piecereglements = $this->Piecereglementclients->find('all')
                ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
                ->where([$cond1, $cond4, $cond2, $cond5, $cond6, $cond7, 'Paiements.id' => '2'])
                ->toArray(); // Fetch results as an array



        }
        $etatpieceregelemntt = $this->fetchTable('Etatreglementclients')->newEmptyEntity();

        if ($this->request->is('post')) {
            $etatpieceregelemnt = $this->fetchTable('Etatreglementclients')->patchEntity($etatpieceregelemntt, $this->request->getData());

            //// mise ajour solde compte
            if ($etatpieceregelemnt['etat_id'] == 2) {
                $compte = $this->Comptes->get($etatpieceregelemnt['compte_id'], [
                    'contain' => []
                ]);

                $pv = $etatpieceregelemnt['montant'];
                $compte->montant += $pv;
                $this->fetchTable('Comptes')->save($compte);
            }

            //// mise ajour etat piece
            $piece = $this->Piecereglementclients->get($etatpieceregelemnt['piecereglementclient_id'], [
                'contain' => []
            ]);

            $piece->etat_id = $this->request->getData('etat_id');
            // $piece->compte_id = $this->request->getData('compte_id');

            // debug($piece->toArray());die;

            if ($this->fetchTable('Piecereglementclients')->save($piece)) {
                if ($this->fetchTable('Etatreglementclients')->save($etatpieceregelemnt)) {
                    return $this->redirect(['action' => 'indexengclient']);
                } else {
                    // debug($etatpieceregelemnt->getErrors());
                }
            } else {
                // debug($piece->getErrors());
            }
        }


        $reglements = $this->fetchTable('Reglementclients')->find('all', [
            'contain' => ['Clients'],
        ])->where([$cond2, $cond5])

            // ->where([$cond2, $cond5])
            ->toArray(); // Fetch results as an array

        $piecereglements = $this->Piecereglementclients->find('all')
            ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
            // ->where(['Paiements.id' => '2'])
            ->where([$cond1, $cond4, $cond2, $cond5, $cond6, $cond7, 'Paiements.id' => '2'])

            ->toarray();

        $count = count($piecereglements);  // Utilisation de count() pour compter les résultats

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $clients = $this->fetchTable('Clients')->find('list', ['keyField' => 'id', 'valueField' => 'Raison_Sociale']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Paiements.id' => '2']);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('reglements', 'endosse', 'echance2', 'piecereglements', 'count', 'etats', 'agences', 'comptes', 'modes', 'clients', 'echance', 'modeid', 'clientid', 'compteid', 'modes', 'datereg', 'fournisseurid'));
    }
    public function imprimereng()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Comptes');
        if ($this->request->getQuery()) {

            $cond1 = '';
            $cond2 = '';
            //  $cond3 = '';
            $cond4 = '';
            $cond5 = '';
            $cond6 = '';
            $cond7 = '';

            $modeid = $this->request->getQuery('paiement_id');
            if (!empty($modeid)) {

                $cond1 = 'Piecereglementclients.paiement_id =' . $modeid;
            }
            // debug($modeid);

            $clientid = $this->request->getQuery('client_id');
            if (!empty($clientid)) {
                //$conditions2['Reglementachats.fournisseur_id'] = $fournisseurid;
                $cond2 = 'Reglementclients.client_id =' . $clientid;
            }

            // $compteid = $this->request->getQuery('compte_id');
            // if (!empty($compteid)) {
            //     $cond3 = 'Piecereglementclients.compte_id =' . $compteid;

            // }
            // debug($compteid);
            $echance = $this->request->getQuery('echance');
            // debug($echance);

            if (!empty($echance)) {
                //$conditions1['Piecereglementachats.echance'] = $echance;
                $cond4 = 'date(Piecereglementclients.echance) >=  ' . "'" . $echance . "'";
                // debug($cond4);die;
                //$cond5 = 'Ticketventes.date  <= ' . "'" . $date2 . " 23:59:59'";

            }
            $echance2 = $this->request->getQuery('echance2');

            if (!empty($echance2)) {
                //$conditions1['Piecereglementachats.echance'] = $echance;
                $cond7 = 'date(Piecereglementclients.echance2) >=  ' . "'" . $echance2 . "'";
                // debug($cond4);die;
                //$cond5 = 'Ticketventes.date  <= ' . "'" . $date2 . " 23:59:59'";

            }
            //// debug($echance);

            $datereg = $this->request->getQuery('date');
            // debug($datereg);
            if (!empty($datereg)) {
                $cond5 = 'date(Reglementclients.date) >=  ' . "'" . $datereg . "'";

                //$cond5 = 'Reglementachats.date >=  ' . $datereg . " '";

                // $conditions2['Reglementachats.date >='] = $datereg . " 00:00:00";
                // $conditions2['Reglementachats.date <='] = $datereg . " 23:59:59";

            }

            $endosse = $this->request->getQuery('endosse');

            if (!empty($endosse)) {
                // $cond6 = 'Piecereglementclients.endosse like ' . "'" . $endosse . "'";
                $cond6 = "Piecereglementclients.endosse  like  '%" . $endosse . "%' ";
            }
            $reglements = $this->fetchTable('Reglementclients')->find('all', [
                'contain' => ['Clients'],
            ])
                ->where([$cond2, $cond5])
                ->toArray(); // Fetch results as an array

            $piecereglements = $this->Piecereglementclients->find('all')
                ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
                ->where([$cond1, $cond4, $cond2, $cond5, $cond6, $cond7, 'Paiements.id' => '2'])
                ->toArray(); // Fetch results as an array



        }
        $etatpieceregelemntt = $this->fetchTable('Etatreglementclients')->newEmptyEntity();

        if ($this->request->is('post')) {
            // debug($this->request->getData());die;
            //  debug($etatpieceregelemntt);
            $etatpieceregelemnt = $this->fetchTable('Etatreglementclients')->patchEntity($etatpieceregelemntt, $this->request->getData());
            // $etatpiecereglement = $this->fetchTable('Etatpieceregelemnts')->newEntity($data);
            // debug($etatpieceregelemnt);


            //// mise ajour solde compte
            if ($etatpieceregelemnt['etat_id'] == 2) {
                $compte = $this->Comptes->get($etatpieceregelemnt['compte_id'], [
                    'contain' => []
                ]);

                $m = $compte['montant'];

                $pv = $etatpieceregelemnt['montant'];
                // debug($pv);
                // $compte->montant = $pv;
                $compte->montant += $pv;
                $this->fetchTable('Comptes')->save($compte);
            }



            //// mise ajour etat piece
            $piece = $this->Piecereglementclients->get($etatpieceregelemnt['piecereglementclient_id'], [
                'contain' => []
            ]);


            $pv = $etatpieceregelemnt['etat_id'];
            // debug()
            $piece->etat_id = $pv;
            $this->fetchTable('Piecereglementclients')->save($piece);

            ////// mise ajour compte sur piece 
            //// mise ajour etat piece
            $piece = $this->Piecereglementclients->get($etatpieceregelemnt['piecereglementclient_id'], [
                'contain' => []
            ]);


            $pv = $etatpieceregelemnt['compte_id'];
            // debug()
            $piece->compte_id = $pv;
            $this->fetchTable('Piecereglementclients')->save($piece);


            if ($this->fetchTable('Etatreglementclients')->save($etatpieceregelemnt)) {

                return $this->redirect(['action' => 'indexengclient']);
            }
        }
        $reglements = $this->fetchTable('Reglementclients')->find('all', [
            'contain' => ['Clients'],
        ])->where([$cond2, $cond5])

            // ->where([$cond2, $cond5])
            ->toArray(); // Fetch results as an array

        $piecereglements = $this->Piecereglementclients->find('all')
            ->contain(['Paiements', 'Etats', 'Reglementclients' => ['Clients']])
            // ->where(['Paiements.id' => '2'])
            ->where([$cond1, $cond4, $cond2, $cond5, $cond6, $cond7, 'Paiements.id' => '2'])

            ->toarray();

        $count = count($piecereglements);  // Utilisation de count() pour compter les résultats

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $clients = $this->fetchTable('Clients')->find('list', ['keyField' => 'id', 'valueField' => 'Raison_Sociale']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Paiements.id' => '2']);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('reglements', 'endosse', 'echance2', 'piecereglements', 'count', 'etats', 'agences', 'comptes', 'modes', 'clients', 'echance', 'modeid', 'clientid', 'compteid', 'modes', 'datereg', 'fournisseurid'));
    }


    public function etatreglementbl()
    {
        error_reporting(E_ERROR | E_PARSE);

        // Load necessary models
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Clients');
        $this->loadModel('Paiements');

        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $clientData = [];
        $conditionsBonlivraison = [];
        // $conditionsFactureclient = [];
        if ($client_id) {
            $conditionsBonlivraison['Bonlivraisons.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) <= '" . $au . "'"];
        }
        $conditionsBonlivraison['Bonlivraisons.typebl'] = 1;
        $conditionsBonlivraison['Bonlivraisons.Montant_Regler !='] = 0;


        $bonlivraisons = $this->Bonlivraisons->find('all')
            ->where($conditionsBonlivraison)
            ->contain(['Users', 'Clients', 'Factureclients'])
            ->all();
        foreach ($bonlivraisons as $bonlivraison) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $bonlivraison->client_id])
                ->first();

            if ($client && $bonlivraison->date) {
                $connection = ConnectionManager::get('default');

                if ($bonlivraison->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $bonlivraison->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }

                $nameee = $client->id != 12 ? $client->Raison_Sociale : $bonlivraison->nomprenom;

                if ($bonlivraison->totalttc ==  $bonlivraison->Montant_Regler) {
                    $payer = 'Oui';
                } else if ($bonlivraison->totalttc > $bonlivraison->Montant_Regler) {
                    $payer = 'NON';
                }


                $clientData[] = [
                    'idbl' => $bonlivraison->id,

                    'bl' => 'BL : ' . $bonlivraison->numero,
                    'code' => $bonlivraison->client->Code,
                    'name' => $nameee,
                    'date' => $bonlivraison->date->format('Y-m-d'),
                    'credit' => $bonlivraison->totalttc,
                    'debit' => '',
                    'personnel' => $mm,
                    'num' => $bonlivraison->numero,
                    'factureclient_id' => $bonlivraison->factureclient_id,

                    'fac' => $bonlivraison->factureclient->numero,
                    'type' => 'Bon de Livraison',
                    'index' => '1',
                    'observation' => $bonlivraison->observation,
                    'payerbl' => 'Rl : ' . $payer,
                    'Montant_Regler' => $bonlivraison->Montant_Regler,
                    'totalttc' => $bonlivraison->totalttc,

                ];
            }
        }

        // Fetch Paiements data
        $paiements = $this->Paiements->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ]);


        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'paiements', 'client_id'));
    }


    public function etatretenusfin()
    {
        error_reporting(E_ERROR | E_PARSE);

        // Load necessary models
        $this->loadModel('Factureclients');
        $this->loadModel('Retenus');
        $this->loadModel('Clients');
        $this->loadModel('Paiements');
        $this->loadModel('Ligneretenus');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $clientData = [];
        $conditionsreg = [];

        if ($client_id) {
            $conditionsreg['Reglementclients.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsreg[] = ["date(Reglementclients.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsreg[] = ["date(Reglementclients.date) <= '" . $au . "'"];
        }
        $conditionsreg[] = ["Reglementclients.retenu_id IS NOT NULL"];

        // Fetch reglements
        $reglements = $this->Reglementclients->find('all')
            ->where($conditionsreg)
            ->contain(['Clients', 'Retenus'])
            ->all();

        // Grouping data by client_id
        foreach ($reglements as $reg) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'Code', 'id'])
                ->where(['id' => $reg->client_id])
                ->first();

            $lignereglements = $this->Lignereglementclients->find()
                ->where(['reglementclient_id' => $reg->id])
                ->contain('Factureclients')
                ->toArray();

            $pieces = $this->Piecereglementclients->find()
                ->where(['reglementclient_id' => $reg->id])
                ->select(['montant'])
                ->toArray();

            if ($client && $reg->date) {
                $totalPiecesMontant = array_sum(array_column($pieces, 'montant'));

                // Group by client_id
                if (!isset($clientData[$reg->client_id])) {
                    $clientData[$reg->client_id] = [
                        'client_name' => $client->Raison_Sociale,
                        'client_code' => $client->Code,
                        'reglements' => []
                    ];
                }

                foreach ($lignereglements as $ligne) {
                    $clientData[$reg->client_id]['reglements'][] = [
                        'dateretenu' => $reg->retenu ? $reg->retenu->date->format('Y-m-d') : null,
                        'Fac' => $ligne->factureclient->numero,
                        'date' => $reg->date->format('Y-m-d'),
                        'montant' => $totalPiecesMontant,
                        'totalttc' => $ligne->factureclient->totalttc
                    ];
                }
            }
        }

        // Fetch Paiements data
        $paiements = $this->Paiements->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
        $clients = $this->Clients->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ])->toArray();

        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'paiements', 'client_id'));
    }

    public function etatretenusdd()
    {
        error_reporting(E_ERROR | E_PARSE);

        // Load necessary models
        $this->loadModel('Factureclients');
        $this->loadModel('Retenus');
        $this->loadModel('Clients');
        $this->loadModel('Paiements');
        $this->loadModel('Ligneretenus');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $clientData = [];
        $conditionsreg = [];

        if ($client_id) {
            $conditionsreg['Reglementclients.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsreg[] = ["date(Reglementclients.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsreg[] = ["date(Reglementclients.date) <= '" . $au . "'"];
        }
        $conditionsreg[] = ["Reglementclients.retenu_id IS NOT NULL"];

        // Fetch reglements
        $reglements = $this->Reglementclients->find('all')
            ->where($conditionsreg)
            ->contain(['Clients', 'Retenus'])
            ->all();

        foreach ($reglements as $reg) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'Code', 'id'])
                ->where(['id' => $reg->client_id])
                ->first();

            $lignereglements = $this->Lignereglementclients->find()
                ->where(['reglementclient_id' => $reg->id])
                ->contain('Factureclients')
                ->toArray();

            $pieces = $this->Piecereglementclients->find()
                ->where(['reglementclient_id' => $reg->id])
                ->select(['montant'])
                ->toArray();

            if ($client && $reg->date) {
                foreach ($lignereglements as $ligne) {
                    $totalPiecesMontant = array_sum(array_column($pieces, 'montant'));

                    $clientData[] = [
                        'dateretenu' =>  $reg->retenu->date, //->format('Y-m-d'),

                        'Fac' => $ligne->factureclient->numero,
                        'code' => $reg->client->Code,
                        'name' => $reg->client->Raison_Sociale,
                        'date' => $reg->date->format('Y-m-d'),
                        'montant' => $totalPiecesMontant,

                        'totalttc' => $ligne->factureclient->totalttc,
                    ];
                }
            }
        }

        // Fetch Paiements data
        $paiements = $this->Paiements->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
        $clients = $this->Clients->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ])->toArray();

        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'paiements', 'client_id'));
    }
    public function etatretenus()
    {
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Reglementclients');
        $this->loadModel('Retenus');
        $this->loadModel('Clients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');



        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');

        //  $conditionsreg = ['Reglementclients.retenu_id IS NOT NULL'];

        if (!empty($client_id)) {
            $conditionsreg['Retenus.client_id'] = $client_id;
        }
        if (!empty($historiquede)) {
            $conditionsreg[] = ["date(Retenus.date) >= '" . $historiquede . "'"];
        }
        if (!empty($au)) {
            $conditionsreg[] = ["date(Retenus.date) <= '" . $au . "'"];
        }

        $retenu = $this->Retenus->find('all')
            ->contain(['Clients'])
            ->where($conditionsreg)
            ->all();
        //   debug($retenu->toarray());
        $clientData = [];
        $totalPiecesMontant = 0;
        foreach ($retenu as $ret) {
            // debug($reg->retenus);
            $totalPiecesMontant += $ret->total;
            // var_dump($reg->rete$tnus->date);
            $clientData[] = [
                'client_code' => $ret->client->Code,
                'client_name' => $ret->client->Raison_Sociale,
                'date_retenu' => $ret->date ? $ret->date->format('Y-m-d') : null,
                'numero' => $ret->numero,
                'total_piece_montant' => $totalPiecesMontant,
            ];
        }

        $clients = $this->Clients->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ])->toArray();

        // Pass data to the view
        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'client_id'));
    }


    public function etatretenusdaprespiecereg24122024()
    {
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Reglementclients');
        $this->loadModel('Retenus');
        $this->loadModel('Clients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');



        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');

        //  $conditionsreg = ['Reglementclients.retenu_id IS NOT NULL'];

        if (!empty($client_id)) {
            $conditionsreg['Reglementclients.client_id'] = $client_id;
        }
        if (!empty($historiquede)) {
            $conditionsreg[] = ["date(Reglementclients.date) >= '" . $historiquede . "'"];
        }
        if (!empty($au)) {
            $conditionsreg[] = ["date(Reglementclients.date) <= '" . $au . "'"];
        }

        $reglements = $this->Reglementclients->find('all')
            ->contain(['Clients', 'Retenus'])
            ->where($conditionsreg)
            ->all();
        debug($reglements->toarray());
        $clientData = [];
        foreach ($reglements as $reg) {
            // debug($reg->retenus);
            $totalPiecesMontant = $this->Piecereglementclients->find()
                ->where(['reglementclient_id' => $reg->id])
                ->select(['montant'])
                ->sumOf('montant');
            // var_dump($reg->retenus->date);
            $clientData[] = [
                'client_code' => $reg->client->Code,
                'client_name' => $reg->client->Raison_Sociale,
                'date_reglement' => $reg->date ? $reg->date->format('Y-m-d') : null,
                'date_retenu' => $reg->retenus ? $reg->retenus->date->format('Y-m-d') : null,
                'numero' => $reg->retenu->numero,
                'total_piece_montant' => $totalPiecesMontant,
            ];
        }

        $clients = $this->Clients->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ])->toArray();

        // Pass data to the view
        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'client_id'));
    }
    public function impetatretenus()

    {
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Reglementclients');
        $this->loadModel('Retenus');
        $this->loadModel('Clients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');



        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');

        //  $conditionsreg = ['Reglementclients.retenu_id IS NOT NULL'];

        if (!empty($client_id)) {
            $conditionsreg['Retenus.client_id'] = $client_id;
        }
        if (!empty($historiquede)) {
            $conditionsreg[] = ["date(Retenus.date) >= '" . $historiquede . "'"];
        }
        if (!empty($au)) {
            $conditionsreg[] = ["date(Retenus.date) <= '" . $au . "'"];
        }

        $retenu = $this->Retenus->find('all')
            ->contain(['Clients'])
            ->where($conditionsreg)
            ->all();
        //   debug($retenu->toarray());
        $clientData = [];
        $totalPiecesMontant = 0;
        foreach ($retenu as $ret) {
            // debug($reg->retenus);
            $totalPiecesMontant += $ret->total;
            // var_dump($reg->rete$tnus->date);
            $clientData[] = [
                'client_code' => $ret->client->Code,
                'client_name' => $ret->client->Raison_Sociale,
                'date_retenu' => $ret->date ? $ret->date->format('Y-m-d') : null,
                'numero' => $ret->numero,
                'total_piece_montant' => $totalPiecesMontant,
            ];
        }

        $clients = $this->Clients->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ])->toArray();

        // Pass data to the view
        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'client_id'));
    }

    public function impetatregbl()
    {
        error_reporting(E_ERROR | E_PARSE);

        // Load necessary models
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Clients');
        $this->loadModel('Paiements');

        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $clientData = [];
        $conditionsBonlivraison = [];
        // $conditionsFactureclient = [];
        if ($client_id) {
            $conditionsBonlivraison['Bonlivraisons.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) <= '" . $au . "'"];
        }
        $conditionsBonlivraison['Bonlivraisons.typebl'] = 1;
        $conditionsBonlivraison['Bonlivraisons.Montant_Regler !='] = 0;


        $bonlivraisons = $this->Bonlivraisons->find('all')
            ->where($conditionsBonlivraison)
            ->contain(['Users', 'Clients', 'Factureclients'])
            ->all();
        foreach ($bonlivraisons as $bonlivraison) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $bonlivraison->client_id])
                ->first();

            if ($client && $bonlivraison->date) {
                $connection = ConnectionManager::get('default');

                if ($bonlivraison->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $bonlivraison->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }

                $nameee = $client->id != 12 ? $client->Raison_Sociale : $bonlivraison->nomprenom;

                if ($bonlivraison->totalttc ==  $bonlivraison->Montant_Regler) {
                    $payer = 'Oui';
                } else if ($bonlivraison->totalttc > $bonlivraison->Montant_Regler) {
                    $payer = 'NON';
                }


                $clientData[] = [
                    'idbl' => $bonlivraison->id,

                    'bl' => 'BL : ' . $bonlivraison->numero,
                    'code' => $bonlivraison->client->Code,
                    'name' => $nameee,
                    'date' => $bonlivraison->date->format('Y-m-d'),
                    'credit' => $bonlivraison->totalttc,
                    'debit' => '',
                    'personnel' => $mm,
                    'num' => $bonlivraison->numero,
                    'factureclient_id' => $bonlivraison->factureclient_id,

                    'fac' => $bonlivraison->factureclient->numero,
                    'type' => 'Bon de Livraison',
                    'index' => '1',
                    'observation' => $bonlivraison->observation,
                    'payerbl' => 'Rl : ' . $payer,
                    'Montant_Regler' => $bonlivraison->Montant_Regler,
                    'totalttc' => $bonlivraison->totalttc,

                ];
            }
        }

        // Fetch Paiements data
        $paiements = $this->Paiements->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ]);


        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'paiements', 'client_id'));
    }
    public function modepaie($id = null)
    {
        $this->viewBuilder()->setLayout('def');
        $this->loadModel('Piecereglementclients');

        $pieces = $this->Piecereglementclients->find()->where(['Piecereglementclients.reglementclient_id' => $id])->contain(['Paiements'])->all();
        $this->set(compact('pieces'));
    }

    public function imprimstb($id = null)
    {
        // $this->viewBuilder()->setLayout('');
        $this->loadModel('Piecereglementclients');

        $pieces = $this->Piecereglementclients->get($id);
        $reglementclient = $this->fetchTable('Reglementclients')->find()->where('Reglementclients.id=' . $pieces->reglementclient_id)->first();
        $client = [];
        if ($reglementclient->client_id != null) {
            $client = $this->fetchTable('Clients')->find('all')->where('Clients.id=' . $reglementclient->client_id)->first();
            //  debug
        }

        $this->set(compact('pieces', 'reglementclient', 'client'));
    }
    public function imprimret($id = NULL)
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_vente' . $abrv);
        // //   debug($liendd);
        // $com1 = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'reglementclients') {
        //         $com1 = $liens['imprimer'];
        //     }
        // }
        // // debug($com1);die;
        // if (($com1 <> 1)) {    
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));            
        // }                  
        $this->loadModel('Piecereglementclients');
        $pieces = $this->Piecereglementclients->get($id);
        $reglement = $this->fetchTable('Reglementclients')->get($pieces->reglementclient_id);
        //debug( $reglement);die;
        $societe = $this->fetchTable('Societes')->find('all')->first();
        $client = $this->fetchTable('Clients')->find()->where('Clients.id=' . $reglement->client_id)->first();
        $ligne = $this->fetchTable('Lignereglementclients')->find('all')->where('Lignereglementclients.reglementclient_id=' . $reglement->id)->contain('Factureclients')->first();

        $this->set(compact('pieces', 'societe', 'client', 'reglement', 'ligne'));
    }
    public function imprimretdalanda($id = null)
    {
        //$this->viewBuilder()->setLayout('');
        $this->loadModel('Piecereglementclients');
        $societes = $this->fetchTable('Societes')->find('all', ['keyfield' => 'id', 'valueField' => 'codetva'])->first();
        // var_dump($societes->codetva);
        $pieces = $this->Piecereglementclients->get($id);
        $this->set(compact('pieces', 'societes'));
    }
    public function imprimtr($id = null)
    {

        $this->loadModel('Piecereglementclients');
        $pieces = $this->Piecereglementclients->get($id);
        $banque = [];
        if ($pieces->banque_id != null) {
            $banque = $this->fetchTable('Banques')->find()->where('Banques.id=' . $pieces->banque_id)->first();
        }
        if ($pieces->compte_id != null) {
            $compte = $this->fetchTable('Comptes')->find()->where('Comptes.id=' . $pieces->compte_id)->first();
        }
        $societe = $this->fetchTable('Societes')->find()->where('Societes.id=1')->first();

        $reglement = $this->fetchTable('Reglementclients')->find()->where('Reglementclients.id=' . $pieces->reglementclient_id)->first();
        $client = [];
        if ($reglement->client_id != null) {
            $client = $this->fetchTable('Clients')->find()->where('Clients.id=' . $reglement->client_id)->first();
        }

        $this->set(compact('pieces', 'reglement', 'client', 'societe', 'banque', 'compte'));
    }

    public function imprimvir($id = null)
    {
        $this->loadModel('Piecereglementclients');

        $pieces = $this->Piecereglementclients->get($id);
        $reglement = $this->fetchTable('Reglementclients')->find()->where('Reglementclients.id=' . $pieces->reglementclient_id)->first();
        $this->set(compact('pieces', 'reglement'));
    }
    public function imprimeview1902($type = null, $id = null)
    {

        error_reporting(E_ERROR | E_PARSE);

        // debug($id);die;
        $this->loadModel('Factureclients');
        $this->loadModel('Factureavoirs');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        $reglement = $this->Reglementclients->get($id, [
            'contain' => ['Clients'],
        ]);

        $cli = $reglement->client_id;


        $lignesreg = $this->Lignereglementclients->find('all', [
            'contain' => ['Factureclients', 'Bonlivraisons'],
        ])->where(['Lignereglementclients.reglementclient_id =' . $id]);
        //debug(($lignesreg->toArray())) ;die;

        $l = '(0';
        $lb = '(0';
        $la = '(0';
        foreach ($lignesreg as  $li) {


            if ($li['factureclient_id'] != 0) {
                $l = $l . ',' . $li['factureclient_id'];
            } else if ($li['bonlivraison_id'] != 0) {
                $lb = $lb . ',' . $li['bonlivraison_id'];
            } else if ($li['factureavoir_id'] != 0) {
                $la = $la . ',' . $li['factureavoir_id'];
            }
        }
        $l = $l . ',0)';
        $lb = $lb . ',0)';
        $la = $la . ',0)';





        $piecereglementclients = $this->Piecereglementclients->find('all', [
            'contain' => ['Paiements', 'Banques'],
        ])->where(['Piecereglementclients.reglementclient_id =' . $id]);
        //debug($piecereglementclients->toarray());
        $mtbon = 0.000;
        $mtfact = 0.000;




        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['factureclient_id'] != null) {
                $facreg[$ligne['factureclient_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else if ($ligne['factureavoir_id'] != null) {
                $facreg[$ligne['factureavoir_id']] = 1;
                $mtfact = $mtfact - $ligne['Montant'];
            } else {
                $facreg[$ligne['bonlivraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
        }

        if ($cli != null) {
            $this->loadModel('Factureclients');
            $this->loadModel('Bonlivraisons');

            $connection = ConnectionManager::get('default');

            // $factures = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $cli , 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            $factures = $connection->execute("select * from factureclients where (factureclients.client_id=" . $cli . " ) and (( factureclients.totalttc > factureclients.Montant_Regler) OR (factureclients.id in" . $l . "));");
            $factureavoirs = $connection->execute("select * from factureavoirs where (factureavoirs.client_id=" . $cli . ") and ((factureavoirs.totalttc > factureavoirs.montant_regle) OR (factureavoirs.id in" . $la . "));")->fetchAll('assoc');

            $livraisons = $connection->execute("select * from bonlivraisons where (bonlivraisons.client_id=" . $cli . " and bonlivraisons.typebl=1 and bonlivraisons.bl= 1 and bonlivraisons.totalttc > bonlivraisons.Montant_Regler) OR (bonlivraisons.id in" . $lb . ");")->fetchAll('assoc');
            // debug($factures);
        }


        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])->where(['Paiements.id not in (6,7,8,9)'])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all');
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->loadModel('Banques');
        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $facturesav = $this->fetchTable('Factureavoirs')->find('all');


        $this->set(compact('factureavoirs', 'timbre', 'banques', 'type', 's', 'id', 'mtfact', 'mtbon', 'facreg', 'piecereglementclients', 'lignesreg', 'valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients', 'facturesav'));
    }
    public function imprimeview($type = null, $id = null)
    {

        error_reporting(E_ERROR | E_PARSE);

        // debug($id);die;
        $this->loadModel('Factureclients');
        $this->loadModel('Factureavoirs');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        $reglement = $this->Reglementclients->get($id, [
            'contain' => ['Clients'],
        ]);

        $cli = $reglement->client_id;


        $lignesreg = $this->Lignereglementclients->find('all', [
            'contain' => ['Factureclients', 'Bonlivraisons'],
        ])->where(['Lignereglementclients.reglementclient_id =' . $id]);
        //debug(($lignesreg->toArray())) ;die;

        $l = '(0';
        $lb = '(0';
        $la = '(0';
        foreach ($lignesreg as  $li) {


            if ($li['factureclient_id'] != 0) {
                $l = $l . ',' . $li['factureclient_id'];
            } else if ($li['bonlivraison_id'] != 0) {
                $lb = $lb . ',' . $li['bonlivraison_id'];
            } else if ($li['factureavoir_id'] != 0) {
                $la = $la . ',' . $li['factureavoir_id'];
            }
        }
        $l = $l . ',0)';
        $lb = $lb . ',0)';
        $la = $la . ',0)';





        $piecereglementclients = $this->Piecereglementclients->find('all', [
            'contain' => ['Paiements', 'Banques', 'Tos'],
        ])->where(['Piecereglementclients.reglementclient_id =' . $id, 'Piecereglementclients.paiement_id NOT IN' => [6, 7, 8, 9, 5]]);
        //debug($piecereglementclients->toarray());
        $mtbon = 0.000;
        $mtfact = 0.000;




        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['factureclient_id'] != null) {
                $facreg[$ligne['factureclient_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else if ($ligne['factureavoir_id'] != null) {
                $facreg[$ligne['factureavoir_id']] = 1;
                $mtfact = $mtfact - $ligne['Montant'];
            } else {
                $facreg[$ligne['bonlivraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
        }

        if ($cli != null) {
            $this->loadModel('Factureclients');
            $this->loadModel('Bonlivraisons');

            $connection = ConnectionManager::get('default');

            // $factures = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $cli , 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            $factures = $connection->execute("select * from factureclients where (factureclients.client_id=" . $cli . " ) and (( factureclients.totalttc > factureclients.Montant_Regler) OR (factureclients.id in" . $l . "));");
            $factureavoirs = $connection->execute("select * from factureavoirs where (factureavoirs.client_id=" . $cli . ") and ((factureavoirs.totalttc > factureavoirs.montant_regle) OR (factureavoirs.id in" . $la . "));")->fetchAll('assoc');

            $livraisons = $connection->execute("select * from bonlivraisons where (bonlivraisons.client_id=" . $cli . " and bonlivraisons.typebl=1 and bonlivraisons.bl= 1 and bonlivraisons.totalttc > bonlivraisons.Montant_Regler) OR (bonlivraisons.id in" . $lb . ");")->fetchAll('assoc');
            // debug($factures);
        }


        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])->where(['Paiements.id not in (6,7,8,9,5)'])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all');
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->loadModel('Banques');
        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $facturesav = $this->fetchTable('Factureavoirs')->find('all');


        $this->set(compact('factureavoirs', 'timbre', 'banques', 'type', 's', 'id', 'mtfact', 'mtbon', 'facreg', 'piecereglementclients', 'lignesreg', 'valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients', 'facturesav'));
    }
    /**
     * View method
     *
     * @param string|null $id Reglementclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($type = null, $id = null)
    {

        // error_reporting(E_ERROR | E_PARSE);
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_vente' . $abrv);

        // //   debug($liendd);
        // $user = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'reglementsclients') {
        //         $user = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($user <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }

        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        $reglement = $this->Reglementclients->get($id, [
            'contain' => [],
        ]);
        ///debug($reglement);

        if ($this->request->is(['patch', 'post', 'put'])) {

            //debug($this->request->getData());//die;
            $data['numeroconca'] = $this->request->getData('numeroconca');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['Montant'] = $this->request->getData('data')['Reglementclients']['Montant'];
            $data['ttpayer'] = $this->request->getData('data')['Reglementclients']['ttpayer'];
            $data['dif'] = $this->request->getData('diff');
            $data['differance'] = $this->request->getData('differance');

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
                    if ($item['factureclientav_id'] != null) {
                        $mtg = $this->Factureavoirs->find()->select(["mtreg" =>
                        'Factureavoirs.montant_regle'])->where(['Factureavoirs.id =' . $item['factureclientav_id']])->first();
                        $MontantRegler = $mtg->mtreg;
                        $fact = $this->Factureavoirs->get($item['factureclientav_id']);
                        $fact->montant_regle = $MontantRegler - $item['Montant'];
                        $this->Factureavoirs->save($fact);
                    }
                    if ($item['Bonlivraison_id'] != null) {
                        $mtg = $this->Bonlivraisons->find()->select(["mtreg" =>
                        'Bonlivraisons.Montant_Regler'])->where(['Bonlivraisons.id =' . $item['bonlivraison_id']])->first();
                        $MontantRegler = $mtg->mtreg;
                        $fact = $this->Bonlivraisons->get($item['bonlivraison_id']);
                        $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                        $this->Bonlivraisons->save($fact);
                        //  debug($fact);
                    }

                    if ($item['client_id'] != null) {
                        $mtgg = $this->fetchTable('Clients')->find()->select(["soldedebut" =>
                        'Clients.soldedebut'])->where(['Clients.id =' . $item['client_id']])->first();
                        $solde_debut = $mtgg->soldedebut;
                        $dd = $this->fetchTable('Clients')->get($item['client_id']);
                        $dd->Montant_Regler = $dd->Montant_Regler - $item['Montant'];
                        //   debug($dd);die;
                        $this->fetchTable('Clients')->save($dd);
                        //  debug($fact);die;
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
                            $ta['Montant'] = (float)$l['Montanttt'];
                            $mtg = $this->Factureclients->find()->select(["mtreg" =>
                            'Factureclients.Montant_Regler'])->where(['Factureclients.id =' . $l['factureclient_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factureclients->get($l['factureclient_id']);
                            $fact->Montant_Regler = $MontantRegler + (float)$l['Montanttt'];
                            $this->Factureclients->save($fact);

                            $this->fetchTable('Lignereglementclients')->save($ta);
                        }

                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabb['reglementclient_id'] = $id;
                            $tabb['bonlivraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = (float)$l['Montanttt'];

                            $mtg = $this->Bonlivraisons->find()->select(["mtreg" =>
                            'Bonlivraisons.Montant_Regler'])->where(['Bonlivraisons.id =' . $l['bonreception_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Bonlivraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler = $MontantRegler + (float)$l['Montanttt']; /*ttc*/

                            $this->Bonlivraisons->save($fact);
                            //debug($fact);
                            $this->fetchTable('Lignereglementclients')->save($tabb);
                            //debug($tabb);die;
                        }
                        if (isset($l['client_id'])) {

                            $tabbbb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabbbb['reglementclient_id'] = $id;
                            $tabbbb['client_id'] = $l['client_id'];
                            $tabbbb['Montant'] = (float)$l['Montanttt'];

                            $dd = $this->fetchTable('Clients')->get($l['client_id']);
                            $dd->Montant_Regler = $dd->Montant_Regler + (float)$l['Montanttt'];
                            $this->fetchTable('Clients')->save($dd);
                            $this->fetchTable('Lignereglementclients')->save($tabbbb);
                            // debug($tabbbb);die;

                        }
                    }
                }



                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglementclients')->newEmptyEntity();
                            // $tab['reglementclient_id'] = $id;
                            // $tab['paiement_id'] = $p['paiement_id'];
                            // $tab['montant'] = $p['montant'];
                            // $tab['to_id'] = $p['taux'];
                            // $tab['montant_net'] = $p['montantnet'];
                            // $tab['echance'] = $p['echance'];
                            // $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                            // $tab['num'] = $p['num_piece'];
                            // $tab['banque_id'] = $p['banque_id'];
                            // $this->fetchTable('Piecereglementclients')->save($tab);
                            if ($p['paiement_id'] == 5) {
                                // debug($tab);

                                $tab['reglementclient_id'] = $id;
                                $tab['to_id'] = $p['taux'];
                                $tab['montant_net'] = $p['montantnet'];
                                $tab['montant_brut'] = $p['montant_brut'];
                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];
                                //  $tab['echance'] = $p['echance'];
                                //  $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                                $tab['num'] = $p['num_piece'];
                                //  $tab['banque_id'] = $p['banque'];

                                // $tab['factureavoir_id'] = $p['fac_id'];
                                // if ($p['fac_id']) {
                                //     $avoir = $this->Factureavoirs->get($p['fac_id']);
                                //     $avoir->valide = '1';
                                //     $this->Factureavoirs->save($avoir);
                                // }
                            } elseif ($p['paiement_id'] == 2) {
                                $tab['reglementclient_id'] = $id;
                                // $tab['to_id'] = $p['taux'];
                                // $tab['montant_net'] = $p['montantnet'];
                                // $tab['montant_brut'] = $p['montantbrut'];
                                $tab['endosse'] = $p['endosse'];
                                $tab['echance2'] = $p['echance2'];
                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];
                                $tab['echance'] = $p['echance'];
                                // $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                                $tab['num'] = $p['num_piece'];
                                // $tab['banque'] = $p['banque'];
                                $tab['banque_id'] = $p['banque_id'];

                                $tab['compte'] = $p['compte'];
                                $tab['etat_id'] = 1;

                                // $tab['factureavoir_id'] = $p['fac_id'];
                                // if ($p['fac_id']) {
                                //     $avoir = $this->Factureavoirs->get($p['fac_id']);
                                //     $avoir->valide = '1';
                                //     $this->Factureavoirs->save($avoir);
                                // }
                            } elseif ($p['paiement_id'] == 3 ||  $p['paiement_id'] == 4) {
                                $tab['reglementclient_id'] = $id;
                                // $tab['to_id'] = $p['taux'];
                                // $tab['montant_net'] = $p['montantnet'];
                                // $tab['montant_brut'] = $p['montantbrut'];
                                $tab['endosse'] = $p['endosse'];
                                $tab['echance2'] = $p['echance2'];
                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];
                                $tab['echance'] = $p['echance'];
                                // $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                                $tab['num'] = $p['num_piece'];
                                // $tab['banque'] = $p['banque'];
                                $tab['banque_id'] = $p['banque_id'];

                                $tab['compte'] = $p['compte'];


                                // $tab['factureavoir_id'] = $p['fac_id'];
                                // if ($p['fac_id']) {
                                //     $avoir = $this->Factureavoirs->get($p['fac_id']);
                                //     $avoir->valide = '1';
                                //     $this->Factureavoirs->save($avoir);
                                // }

                            } elseif ($p['paiement_id'] == 6) {
                                $tab['reglementclient_id'] = $id;

                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];

                                // $tab['banque'] = $p['banque'];
                                $tab['banque_id'] = $p['banque_id'];

                                // $tab['factureavoir_id'] = $p['fac_id'];
                                // if ($p['fac_id']) {
                                //     $avoir = $this->Factureavoirs->get($p['fac_id']);
                                //     $avoir->valide = '1';
                                //     $this->Factureavoirs->save($avoir);
                                // }
                            } else {
                                $tab['reglementclient_id'] = $id;

                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];


                                // $tab['factureavoir_id'] = $p['fac_id'];
                                // if ($p['fac_id']) {
                                //     $avoir = $this->Factureavoirs->get($p['fac_id']);
                                //     $avoir->valide = '1';
                                //     $this->Factureavoirs->save($avoir);
                                // }
                            }
                            $this->fetchTable('Piecereglementclients')->save($tab);
                        }
                    }
                }
                $diff = $this->request->getData('diff');
                $difference = $this->request->getData('differance');

                if (isset($diff) && $diff == 1) {



                    if ($difference) {
                        $tabb = $this->fetchTable('Piecereglementclients')->newEmptyEntity();

                        $tabb['reglementclient_id'] = $id;
                        $tabb['montant'] = -$difference;
                        $tabb['paiement_id'] = 9;
                        $this->fetchTable('Piecereglementclients')->save($tabb);
                    }
                    // }

                    // if ($difference > 0) {
                    //     $tabb['reglementclient_id'] = $id;
                    //     $tabb['montant'] = $difference;
                    //     $tabb['paiement_id'] = 9;
                    // }


                    //   
                }
                return $this->redirect(['action' => 'index/' . $type]);
            }
        }



        $cli = $reglement->client_id;
        //debug($id);

        $lignesreg = $this->Lignereglementclients->find('all')->where(['Lignereglementclients.reglementclient_id =' . $id]);
        //debug(($lignesreg->toArray())) ;die;


        foreach ($lignesreg as $l => $li) {
            $l = '(0';


            if ($li['factureclient_id'] != 0) {
                $l .= ',' . $li['factureclient_id'];
            } else if ($li['bonlivraison_id'] != 0) {
                $l .= ',' . $li['bonlivraison_id'];
            } else if ($li['factureavoir_id'] != 0) {
                $l .= ',' . $li['factureavoir_id'];
            }
            $l .= ',0)';
        } //debug($l);




        foreach ($lignesreg as $s => $si) {

            if ($si['factureclient_id'] != 0) {
                $s = $si['reglementclient_id'];
            } else if ($si['bonlivraison_id'] != 0) {
                $s = $si['reglementclient_id'];
            }
        }
        $piecereglementclients = $this->Piecereglementclients->find('all')->where(['Piecereglementclients.reglementclient_id =' . $id, 'Piecereglementclients.paiement_id not in(6,7,8,9,5)']);
        $mtbon = 0.000;
        $mtfact = 0.000;




        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['factureclient_id'] != null) {
                $facreg[$ligne['factureclient_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else if ($ligne['bonlivraison_id'] != null) {
                $facreg[$ligne['bonlivraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            } else if ($ligne['client_id'] != null) {
                $facreg[$ligne['client_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            }
        }

        if ($cli != null) {
            $this->loadModel('Factureclients');
            $this->loadModel('Bonlivraisons');
            $this->loadModel('Clients');
            $connection = ConnectionManager::get('default');
            $compte = $this->Clients->find('all')->where(['Clients.id =' . $cli])->first();
            // debug($compte->soldedebut);
            $c = $compte['Code'];
            //debug($c);

            // $factures = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $cli , 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            $factures = $connection->execute("select * from factureclients where (factureclients.client_id=" . $cli . " and factureclients.totalttc > factureclients.Montant_Regler) OR (factureclients.id in" . $l . ");")->fetchAll('assoc');

            $livraisons = $connection->execute("select * from bonlivraisons where (bonlivraisons.client_id=" . $cli . " and bonlivraisons.typebl=1 and bonlivraisons.bl= 1 and bonlivraisons.totalttc > bonlivraisons.Montant_Regler) OR (bonlivraisons.id in" . $l . ");")->fetchAll('assoc');
            //debug($livraisons->toArray());
            $compte = $this->Clients->find('all')->where(['Clients.id =' . $cli, 'Clients.soldedebut - Clients.Montant_Regler !=0'])->first();

            // $compte = $this->fetchTable('Clients')->find('all')->where(['Clients.id =' . $cli])->first();
            // $factureavoirs = $this->fetchTable('Factureavoirs')->find('all')->where(['Factureavoirs.client_id =' . $cli,'Factureavoirs.factureclient_id=0', 'Factureavoirs.totalttc > Factureavoirs.Montant_Regler']);
            $factureavoirs = $connection->execute("select * from factureavoirs where (factureavoirs.client_id=" . $cli . " and factureavoirs.factureclient_id=0 and  factureavoirs.totalttc > factureavoirs.Montant_Regler) OR (factureavoirs.id in" . $l . ");")->fetchAll('assoc');
        }




        $idd = $reglement->id;


        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        if ($type == 1) {
            $paiements = $this->fetchTable('Paiements')->find('list')->where(['id NOT IN' => [ 4, 5, 6, 7, 8, 9]]);
        } else {
            $paiements = $this->Paiements->find('list', ['limit' => 200])->where(['Paiements.id not in (6,7,8,9,5)'])->all();
        }
        // $paiements = $this->fetchTable('Paiements')->find('list')->where(['Paiements.id not in (6,7,8,9,5)']);
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all')->where(['id !=12']);
        //debug($clients->toArray());
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->loadModel('Banques');
        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $facturesav = $this->fetchTable('Factureavoirs')->find('all');

        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('Comptes')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $this->set(compact('factureavoirs', 'idd', 'timbre', 'compte', 'comptes', 'banques', 'type', 's', 'id', 'mtfact', 'mtbon', 'facreg', 'piecereglementclients', 'lignesreg', 'valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients', 'facturesav'));
    }
    public function view06112024($type = null, $id = null)
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


        foreach ($lignesreg as $l => $li) {
            $l = '(0';


            if ($li['factureclient_id'] != 0) {
                $l .= ',' . $li['factureclient_id'];
            } else if ($li['bonlivraison_id'] != 0) {
                $l .= ',' . $li['bonlivraison_id'];
            } elseif ($li['factureavoir_id'] != 0) {
                $l .= ',' . $li['factureavoir_id'];
            }
            $l .= ',0)';
        } //debug($l);




        foreach ($lignesreg as $s => $si) {

            if ($si['factureclient_id'] != 0) {
                $s = $si['reglementclient_id'];
            } else if ($si['bonlivraison_id'] != 0) {
                $s = $si['reglementclient_id'];
            }
        }
        $piecereglementclients = $this->Piecereglementclients->find('all')->where(['Piecereglementclients.reglementclient_id =' . $id, 'Piecereglementclients.paiement_id not in(6,7)']);
        $mtbon = 0.000;
        $mtfact = 0.000;




        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['factureclient_id'] != null) {
                $facreg[$ligne['factureclient_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else if ($ligne['bonlivraison_id'] != null) {
                $facreg[$ligne['bonlivraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            } else if ($ligne['client_id'] != null) {
                $facreg[$ligne['client_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            }
        }

        if ($cli != null) {
            $this->loadModel('Factureclients');
            $this->loadModel('Bonlivraisons');
            $this->loadModel('Clients');
            $connection = ConnectionManager::get('default');
            $compte = $this->Clients->find('all')->where(['Clients.id =' . $cli])->first();
            // debug($compte->soldedebut);
            $c = $compte['Code'];
            //debug($c);

            // $factures = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $cli , 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            $factures = $connection->execute("select * from factureclients where (factureclients.client_id=" . $cli . " and factureclients.totalttc > factureclients.Montant_Regler) OR (factureclients.id in" . $l . ");")->fetchAll('assoc');

            $livraisons = $connection->execute("select * from bonlivraisons where (bonlivraisons.client_id=" . $cli . " and bonlivraisons.typebl=1 and bonlivraisons.bl= 1 and bonlivraisons.totalttc > bonlivraisons.Montant_Regler) OR (bonlivraisons.id in" . $l . ");")->fetchAll('assoc');
            //debug($livraisons->toArray());
            $compte = $this->Clients->find('all')->where(['Clients.id =' . $cli, 'Clients.soldedebut - Clients.Montant_Regler !=0'])->first();

            // $compte = $this->fetchTable('Clients')->find('all')->where(['Clients.id =' . $cli])->first();
            // $factureavoirs = $this->fetchTable('Factureavoirs')->find('all')->where(['Factureavoirs.client_id =' . $cli,'Factureavoirs.factureclient_id=0', 'Factureavoirs.totalttc > Factureavoirs.Montant_Regler']);
            $factureavoirs = $connection->execute("select * from factureavoirs where (factureavoirs.client_id=" . $cli . " and  factureavoirs.totalttc > factureavoirs.Montant_Regler) OR (factureavoirs.id in" . $l . ");")->fetchAll('assoc');
        }



        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->fetchTable('Paiements')->find('list'); //->where(['Paiements.id not in (6,7,8,9)']);
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all');
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->loadModel('Banques');
        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('Comptes')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $idd = $reglement->id;

        $this->set(compact('timbre', 'idd', 'banques', 'comptes', 'type', 'compte', 's', 'id', 'mtfact', 'mtbon', 'facreg', 'piecereglementclients', 'lignesreg', 'valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($type = null, $client_id = null)
    {

        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_vente' . $abrv);

        // //   debug($liendd);   
        // $user = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'reglementsclients') {
        //         $user = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($user <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }

        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Factureavoirs');


        $reglementclient = $this->Reglementclients->newEmptyEntity();
        //debug($reglementclient);
        $result = $this->request->getAttribute('authentication')->getIdentity();

        if ($this->request->is('post')) {

            // debug($this->request->getData()); die;

            $data['user_id'] = $result['id'];
            if (empty($this->request->getData('date'))) {
                $data['date'] = date('Y-m-d'); // Si aucune date n'est fournie dans la requête, utilisez la date d'aujourd'hui
            } else {
                $data['date'] = $this->request->getData('date'); // Sinon, utilisez la date fournie dans la requête
            }

            $data['client_id'] = $this->request->getData('client_id');
            $data['Montant'] = $this->request->getData('data')['Reglementclient']['Montant'];
            $data['ttpayer'] = $this->request->getData('data')['Reglementclient']['ttpayer'];
            $data['differance'] = $this->request->getData('differance');
            // $data['dif'] = $this->request->getData('diff');
            $data['dif']  = $this->request->getData('diff');
            $data['type'] = $this->request->getData('type');


            //
            //            if ($type == 1) {
            //                $data['type'] = 0;
            //            } else if ($type == 2) {
            //                $data['type'] = 1;       
            //            }

            $numeroobj = $this->Reglementclients->find()->select(["numero" =>
            'MAX(Reglementclients.numeroconca)'])->where(['Reglementclients.type=' . $type])->first();
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
            //   debug($data);//die;

            $reglement = $this->Reglementclients->patchEntity($reglementclient, $data);
            //debug($reglement);
            if ($this->Reglementclients->save($reglement)) {
                // debug($reglement);
                $reglement_id = $reglement->id;
                //  debug($this->request->getData('data')['Lignereglementclient']);die;
                if (isset($this->request->getData('data')['Lignereglementclient']) && (!empty($this->request->getData('data')['Lignereglementclient']))) {
                    foreach ($this->request->getData('data')['Lignereglementclient'] as $i => $l) {

                        if (isset($l['factureclient_id'])) {

                            $ta = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $ta['reglementclient_id'] = $reglement_id;
                            $ta['factureclient_id'] = $l['factureclient_id'];

                            $ta['Montant'] = $l['Montanttt'];

                            $fact = $this->Factureclients->get($l['factureclient_id']);
                            $fact->Montant_Regler = $fact->Montant_Regler + $l['Montanttt'];
                            $this->Factureclients->save($fact);
                            $this->fetchTable('Lignereglementclients')->save($ta);
                            // debug($ta);die;
                        } else if (isset($l['factureclientav_id'])) {

                            $taa = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $taa['reglementclient_id'] = $reglement_id;
                            $taa['factureavoir_id'] = $l['factureclientav_id'];

                            $taa['Montant'] = -$l['Montanttt'];

                            $factav = $this->Factureavoirs->get($l['factureclientav_id']);
                            $factav->montant_regle = $factav->montant_regle + $l['Montanttt'];
                            $factav->valide = '1';
                            $this->Factureavoirs->save($factav);
                            $this->fetchTable('Lignereglementclients')->save($taa);
                            // debug($ta);die;
                        }

                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabb['reglementclient_id'] = $reglement_id;
                            $tabb['bonlivraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = $l['Montanttt'];


                            $fact = $this->Bonlivraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler = $fact->Montant_Regler + $l['Montanttt'];
                            $this->Bonlivraisons->save($fact);
                            $this->fetchTable('Lignereglementclients')->save($tabb);
                            //debug($tabb);die;

                        }

                        if (isset($l['client_id'])) {
                            $tabbbb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabbbb['reglementclient_id'] = $reglement_id;
                            $tabbbb['client_id'] = $l['client_id'];
                            $tabbbb['Montant'] = $l['Montanttt'];

                            $dd = $this->fetchTable('Clients')->get($l['client_id']);
                            $dd->Montant_Regler = $dd->Montant_Regler + $l['Montanttt'];
                            $this->fetchTable('Clients')->save($dd);
                            $this->fetchTable('Lignereglementclients')->save($tabbbb);
                            // debug($tabbbb);die;

                        }
                    }
                }



                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    //debug($this->request->getData('data')['pieceregelemnt']);
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {

                        //  debug($p);die;

                        // debug( $p['fac_id']);
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglementclients')->newEmptyEntity();
                            if ($p['paiement_id'] == 5) {
                                // debug($tab);

                                $tab['reglementclient_id'] = $reglement_id;
                                $tab['to_id'] = $p['taux'];
                                $tab['montant_net'] = $p['montantnet'];
                                $tab['montant_brut'] = $p['montantbrut'];
                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];
                                //  $tab['echance'] = $p['echance'];
                                //  $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                                $tab['num'] = $p['num_piece'];
                                //  $tab['banque_id'] = $p['banque'];

                                $tab['factureavoir_id'] = $p['fac_id'];
                                if ($p['fac_id']) {
                                    $avoir = $this->Factureavoirs->get($p['fac_id']);
                                    $avoir->valide = '1';
                                    $this->Factureavoirs->save($avoir);
                                }
                            } elseif ($p['paiement_id'] == 2) {
                                $tab['reglementclient_id'] = $reglement_id;
                                // $tab['to_id'] = $p['taux'];
                                // $tab['montant_net'] = $p['montantnet'];
                                // $tab['montant_brut'] = $p['montantbrut'];
                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];
                                $tab['echance'] = $p['echance'];
                                $tab['etat_id'] = 1;


                                // $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                                $tab['num'] = $p['num_piece'];
                                $tab['banque_id'] = $p['banque_id'];
                                // $tab['banque'] = $p['banque'];
                                $tab['compte'] = $p['compte'];
                                $tab['endosse'] = $p['endosse'];

                                $tab['factureavoir_id'] = $p['fac_id'];
                                if ($p['fac_id']) {
                                    $avoir = $this->Factureavoirs->get($p['fac_id']);
                                    $avoir->valide = '1';
                                    $this->Factureavoirs->save($avoir);
                                }
                            } elseif ($p['paiement_id'] == 3 ||  $p['paiement_id'] == 4) {
                                $tab['reglementclient_id'] = $reglement_id;
                                // $tab['to_id'] = $p['taux'];
                                // $tab['montant_net'] = $p['montantnet'];
                                // $tab['montant_brut'] = $p['montantbrut'];
                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];
                                $tab['echance'] = $p['echance'];
                                $tab['etat_id'] = 1;


                                // $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                                $tab['num'] = $p['num_piece'];
                                // $tab['banque'] = $p['banque'];
                                $tab['banque_id'] = $p['banque_id'];

                                $tab['compte'] = $p['compte'];
                                $tab['endosse'] = $p['endosse'];

                                $tab['factureavoir_id'] = $p['fac_id'];
                                if ($p['fac_id']) {
                                    $avoir = $this->Factureavoirs->get($p['fac_id']);
                                    $avoir->valide = '1';
                                    $this->Factureavoirs->save($avoir);
                                }
                            } elseif ($p['paiement_id'] == 6) {
                                $tab['reglementclient_id'] = $reglement_id;

                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];

                                $tab['banque_id'] = $p['banque_id'];

                                $tab['factureavoir_id'] = $p['fac_id'];
                                if ($p['fac_id']) {
                                    $avoir = $this->Factureavoirs->get($p['fac_id']);
                                    $avoir->valide = '1';
                                    $this->Factureavoirs->save($avoir);
                                }
                            } else {
                                $tab['reglementclient_id'] = $reglement_id;

                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];
                                $tab['echance'] = date('d/m/Y');

                                $tab['factureavoir_id'] = $p['fac_id'];
                                if ($p['fac_id']) {
                                    $avoir = $this->Factureavoirs->get($p['fac_id']);
                                    $avoir->valide = '1';
                                    $this->Factureavoirs->save($avoir);
                                }
                            }
                            //    debug($tab);die;

                            $this->fetchTable('Piecereglementclients')->save($tab);

                            // debug($tab);
                        }
                    }
                }

                // $diff = $this->request->getData('diff');
                // $difference = $this->request->getData('data')['Reglementclient']['differance'];

                // if (isset($diff) && $diff == 1) {

                //     $tabb = $this->fetchTable('Piecereglementclients')->newEmptyEntity();


                //     if ($difference < 0) {
                //         $tabb['reglementclient_id'] = $reglement_id;
                //         $tabb['montant'] = -$difference;
                //         $tabb['paiement_id'] = 7;
                //     }

                //     if ($difference > 0) {
                //         $tabb['reglementclient_id'] = $reglement_id;
                //         $tabb['montant'] = $difference;
                //         $tabb['paiement_id'] = 6;
                //     }


                //     $this->fetchTable('Piecereglementclients')->save($tabb);
                //     //   
                // }

                $diff = $this->request->getData('diff');

                if ($diff == 1) {
                    $difference = $this->request->getData('differance');

                    if ($difference != 0) {

                        if ($difference) {
                            $tabb = $this->fetchTable('Piecereglementclients')->newEmptyEntity();

                            //     $tabb['reglementclient_id'] = $reglement_id;
                            //     $tabb['montant'] = abs($difference);
                            //     $tabb['paiement_id'] = 9; // Règlement négatif
                            // } else {
                            $tabb['reglementclient_id'] = $reglement_id;
                            $tabb['montant'] = $difference;
                            $tabb['paiement_id'] = 9; // Règlement positif
                            // }

                            $this->fetchTable('Piecereglementclients')->save($tabb);
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
            $this->loadModel('Clients');

            //debug($client_id);
            $compte = $this->Clients->find('all')->where(['Clients.id =' . $client_id, 'Clients.soldedebut - Clients.Montant_Regler !=0'])->first();
            // debug($compte);
            $c = $compte['Code'];
            //debug($c);
            $cherche = $this->Clients->find('all')->where("Clients.compteclient like '" . $c . "'");


            $list = '(0';
            foreach ($cherche as $cher) {
                $list = $list . "," . $cher['id'];
            }
            $list = $list . ",0)";

            $factureclients = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $client_id, 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            // debug($factureclients->toarray());
            // $factureclients = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.client_id =' . $client_id,'Bonlivraisons.factureclient_id=0' , 'Bonlivraisons.totalttc > Bonlivraisons.Montant_Regler']);

            $livraisons = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.client_id =' . $client_id, 'Bonlivraisons.typebl=1',  'Bonlivraisons.factureclient_id=0', 'Bonlivraisons.totalttc > Bonlivraisons.Montant_Regler']);
            //  debug($livraisons->toarray());

            $factureavoirs = $this->fetchTable('Factureavoirs')->find('all')->where(['Factureavoirs.client_id =' . $client_id, 'Factureavoirs.factureclient_id=0', 'Factureavoirs.totalttc > Factureavoirs.Montant_Regler']);
        } else {

            // $factureclients = $this->Factureclients->find('all')->where(['Factureclients.client_id in' . $list, 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            // $livraisons = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.client_id in' . $list, 'Bonlivraisons.typebl=1', 'Bonlivraisons.totalttc > Bonlivraisons.Montant_Regler']);
            // $factureavoirs = $this->fetchTable('Factureavoirs')->find('all')->where(['Factureavoirs.client_id in ' . $list]);


        }

        // debug($compte);


        $numeroobj = $this->Reglementclients->find()->select(["numero" =>
        'MAX(Reglementclients.numeroconca)'])->where(['Reglementclients.type=' . $type])->first();

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
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        if ($type == 1) {
            $paiements = $this->fetchTable('Paiements')->find('list')->where(['id NOT IN' => [4, 5, 6, 7, 8, 9]]);
        } else {
            $paiements = $this->Paiements->find('list', ['limit' => 200])->where(['Paiements.id not in (6,7,8,9,5)'])->all();
        }
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $this->loadModel('Banques');
        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $piece = $this->Piecereglementclients->find('all', ['']);
        //debug($piece->toArray());
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all')->where(['id !=12']);
        // debug($clients);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        $facturesav = $this->fetchTable('Factureavoirs')->find('all');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('Comptes')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $this->set(compact('factureavoirs', 'facturesav', 'banques', 'comptes', 'compte', 'timbre', 'type', 'valeurs', 'carnetcheques', 'paiements', 'livraisons', 'factureclients', 'client_id',  'code', 'reglementclient', 'clients'));
    }
    public function addreg($type = null, $client_id = null, $idbl = null)
    {

        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_vente' . $abrv);

        // //   debug($liendd);   
        // $user = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'reglementsclients') {
        //         $user = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($user <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }

        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Factureavoirs');


        $reglementclient = $this->Reglementclients->newEmptyEntity();
        //debug($reglementclient);
        $result = $this->request->getAttribute('authentication')->getIdentity();

        if ($this->request->is('post')) {

            // debug($this->request->getData()); die;

            $data['user_id'] = $result['id'];
            if (empty($this->request->getData('date'))) {
                $data['date'] = date('Y-m-d'); // Si aucune date n'est fournie dans la requête, utilisez la date d'aujourd'hui
            } else {
                $data['date'] = $this->request->getData('date'); // Sinon, utilisez la date fournie dans la requête
            }

            $data['client_id'] = $this->request->getData('client_id');
            $data['Montant'] = $this->request->getData('data')['Reglementclient']['Montant'];
            $data['ttpayer'] = $this->request->getData('data')['Reglementclient']['ttpayer'];
            $data['differance'] = $this->request->getData('differance');
            // $data['dif'] = $this->request->getData('diff');
            $data['dif']  = $this->request->getData('diff');
            $data['type'] = $this->request->getData('type');
            $data['nomprenom']  = $this->request->getData('nomprenom');
            $data['numeroidentite'] = $this->request->getData('numeroidentite');
            $data['adressediv'] = $this->request->getData('adressediv');

            //
            //            if ($type == 1) {
            //                $data['type'] = 0;
            //            } else if ($type == 2) {
            //                $data['type'] = 1;       
            //            }

            $numeroobj = $this->Reglementclients->find()->select(["numero" =>
            'MAX(Reglementclients.numeroconca)'])->where(['Reglementclients.type=' . $type])->first();
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
            //   debug($data);//die;

            $reglement = $this->Reglementclients->patchEntity($reglementclient, $data);
            //debug($reglement);
            if ($this->Reglementclients->save($reglement)) {
                // debug($reglement);
                $reglement_id = $reglement->id;
                //  debug($this->request->getData('data')['Lignereglementclient']);die;
                if (isset($this->request->getData('data')['Lignereglementclient']) && (!empty($this->request->getData('data')['Lignereglementclient']))) {
                    foreach ($this->request->getData('data')['Lignereglementclient'] as $i => $l) {

                        if (isset($l['factureclient_id'])) {

                            $ta = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $ta['reglementclient_id'] = $reglement_id;
                            $ta['factureclient_id'] = $l['factureclient_id'];

                            $ta['Montant'] = $l['Montanttt'];

                            $fact = $this->Factureclients->get($l['factureclient_id']);
                            $fact->Montant_Regler = $fact->Montant_Regler + $l['Montanttt'];
                            $this->Factureclients->save($fact);
                            $this->fetchTable('Lignereglementclients')->save($ta);
                            // debug($ta);die;
                        } else if (isset($l['factureclientav_id'])) {

                            $taa = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $taa['reglementclient_id'] = $reglement_id;
                            $taa['factureavoir_id'] = $l['factureclientav_id'];

                            $taa['Montant'] = -$l['Montanttt'];

                            $factav = $this->Factureavoirs->get($l['factureclientav_id']);
                            $factav->montant_regle = $factav->montant_regle + $l['Montanttt'];
                            $factav->valide = '1';
                            $this->Factureavoirs->save($factav);
                            $this->fetchTable('Lignereglementclients')->save($taa);
                            // debug($ta);die;
                        }

                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabb['reglementclient_id'] = $reglement_id;
                            $tabb['bonlivraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = $l['Montanttt'];


                            $fact = $this->Bonlivraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler = $fact->Montant_Regler + $l['Montanttt'];
                            $this->Bonlivraisons->save($fact);
                            $this->fetchTable('Lignereglementclients')->save($tabb);
                            //debug($tabb);die;

                        }

                        if (isset($l['client_id'])) {
                            $tabbbb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabbbb['reglementclient_id'] = $reglement_id;
                            $tabbbb['client_id'] = $l['client_id'];
                            $tabbbb['Montant'] = $l['Montanttt'];

                            $dd = $this->fetchTable('Clients')->get($l['client_id']);
                            $dd->Montant_Regler = $dd->Montant_Regler + $l['Montanttt'];
                            $this->fetchTable('Clients')->save($dd);
                            $this->fetchTable('Lignereglementclients')->save($tabbbb);
                            // debug($tabbbb);die;

                        }
                    }
                }



                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    //debug($this->request->getData('data')['pieceregelemnt']);
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {

                        //  debug($p);die;

                        // debug( $p['fac_id']);
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglementclients')->newEmptyEntity();
                            if ($p['paiement_id'] == 5) {
                                // debug($tab);

                                $tab['reglementclient_id'] = $reglement_id;
                                $tab['to_id'] = $p['taux'];
                                $tab['montant_net'] = $p['montantnet'];
                                $tab['montant_brut'] = $p['montantbrut'];
                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];
                                //  $tab['echance'] = $p['echance'];
                                //  $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                                $tab['num'] = $p['num_piece'];
                                //  $tab['banque_id'] = $p['banque'];

                                $tab['factureavoir_id'] = $p['fac_id'];
                                if ($p['fac_id']) {
                                    $avoir = $this->Factureavoirs->get($p['fac_id']);
                                    $avoir->valide = '1';
                                    $this->Factureavoirs->save($avoir);
                                }
                            } elseif ($p['paiement_id'] == 2) {
                                $tab['reglementclient_id'] = $reglement_id;
                                // $tab['to_id'] = $p['taux'];
                                // $tab['montant_net'] = $p['montantnet'];
                                // $tab['montant_brut'] = $p['montantbrut'];
                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];
                                $tab['echance'] = $p['echance'];
                                $tab['etat_id'] = 1;


                                // $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                                $tab['num'] = $p['num_piece'];
                                $tab['banque_id'] = $p['banque_id'];
                                // $tab['banque'] = $p['banque'];
                                $tab['compte'] = $p['compte'];
                                $tab['endosse'] = $p['endosse'];

                                $tab['factureavoir_id'] = $p['fac_id'];
                                if ($p['fac_id']) {
                                    $avoir = $this->Factureavoirs->get($p['fac_id']);
                                    $avoir->valide = '1';
                                    $this->Factureavoirs->save($avoir);
                                }
                            } elseif ($p['paiement_id'] == 3 ||  $p['paiement_id'] == 4) {
                                $tab['reglementclient_id'] = $reglement_id;
                                // $tab['to_id'] = $p['taux'];
                                // $tab['montant_net'] = $p['montantnet'];
                                // $tab['montant_brut'] = $p['montantbrut'];
                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];
                                $tab['echance'] = $p['echance'];
                                $tab['etat_id'] = 1;


                                // $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                                $tab['num'] = $p['num_piece'];
                                // $tab['banque'] = $p['banque'];
                                $tab['banque_id'] = $p['banque_id'];

                                $tab['compte'] = $p['compte'];
                                $tab['endosse'] = $p['endosse'];

                                $tab['factureavoir_id'] = $p['fac_id'];
                                if ($p['fac_id']) {
                                    $avoir = $this->Factureavoirs->get($p['fac_id']);
                                    $avoir->valide = '1';
                                    $this->Factureavoirs->save($avoir);
                                }
                            } elseif ($p['paiement_id'] == 6) {
                                $tab['reglementclient_id'] = $reglement_id;

                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];

                                $tab['banque_id'] = $p['banque_id'];

                                $tab['factureavoir_id'] = $p['fac_id'];
                                if ($p['fac_id']) {
                                    $avoir = $this->Factureavoirs->get($p['fac_id']);
                                    $avoir->valide = '1';
                                    $this->Factureavoirs->save($avoir);
                                }
                            } else {
                                $tab['reglementclient_id'] = $reglement_id;

                                $tab['montant'] = $p['montant'];
                                $tab['paiement_id'] = $p['paiement_id'];
                                $tab['echance'] = date('d/m/Y');

                                $tab['factureavoir_id'] = $p['fac_id'];
                                if ($p['fac_id']) {
                                    $avoir = $this->Factureavoirs->get($p['fac_id']);
                                    $avoir->valide = '1';
                                    $this->Factureavoirs->save($avoir);
                                }
                            }
                            //    debug($tab);die;

                            $this->fetchTable('Piecereglementclients')->save($tab);

                            // debug($tab);
                        }
                    }
                }

                // $diff = $this->request->getData('diff');
                // $difference = $this->request->getData('data')['Reglementclient']['differance'];

                // if (isset($diff) && $diff == 1) {

                //     $tabb = $this->fetchTable('Piecereglementclients')->newEmptyEntity();


                //     if ($difference < 0) {
                //         $tabb['reglementclient_id'] = $reglement_id;
                //         $tabb['montant'] = -$difference;
                //         $tabb['paiement_id'] = 7;
                //     }

                //     if ($difference > 0) {
                //         $tabb['reglementclient_id'] = $reglement_id;
                //         $tabb['montant'] = $difference;
                //         $tabb['paiement_id'] = 6;
                //     }


                //     $this->fetchTable('Piecereglementclients')->save($tabb);
                //     //   
                // }

                $diff = $this->request->getData('diff');

                if ($diff == 1) {
                    $difference = $this->request->getData('differance');

                    if ($difference != 0) {

                        if ($difference) {
                            $tabb = $this->fetchTable('Piecereglementclients')->newEmptyEntity();

                            //     $tabb['reglementclient_id'] = $reglement_id;
                            //     $tabb['montant'] = abs($difference);
                            //     $tabb['paiement_id'] = 9; // Règlement négatif
                            // } else {
                            $tabb['reglementclient_id'] = $reglement_id;
                            $tabb['montant'] = $difference;
                            $tabb['paiement_id'] = 9; // Règlement positif
                            // }

                            $this->fetchTable('Piecereglementclients')->save($tabb);
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
            $this->loadModel('Clients');

            //debug($client_id);
            $compte = $this->Clients->find('all')->where(['Clients.id =' . $client_id, 'Clients.soldedebut - Clients.Montant_Regler !=0'])->first();
            // debug($compte);
            $c = $compte['Code'];
            //debug($c);
            $cherche = $this->Clients->find('all')->where("Clients.compteclient like '" . $c . "'");


            $list = '(0';
            foreach ($cherche as $cher) {
                $list = $list . "," . $cher['id'];
            }
            $list = $list . ",0)";

            $factureclients = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $client_id, 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            // debug($factureclients->toarray());
            // $factureclients = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.client_id =' . $client_id,'Bonlivraisons.factureclient_id=0' , 'Bonlivraisons.totalttc > Bonlivraisons.Montant_Regler']);

            $livraisons = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.client_id =' . $client_id, 'Bonlivraisons.id =' . $idbl, 'Bonlivraisons.typebl=1',  'Bonlivraisons.factureclient_id=0', 'Bonlivraisons.totalttc > Bonlivraisons.Montant_Regler']);
            //  debug($livraisons->toarray());

            $factureavoirs = $this->fetchTable('Factureavoirs')->find('all')->where(['Factureavoirs.client_id =' . $client_id, 'Factureavoirs.factureclient_id=0', 'Factureavoirs.totalttc > Factureavoirs.Montant_Regler']);
        } else {

            // $factureclients = $this->Factureclients->find('all')->where(['Factureclients.client_id in' . $list, 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            // $livraisons = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.client_id in' . $list, 'Bonlivraisons.typebl=1', 'Bonlivraisons.totalttc > Bonlivraisons.Montant_Regler']);
            // $factureavoirs = $this->fetchTable('Factureavoirs')->find('all')->where(['Factureavoirs.client_id in ' . $list]);


        }

        // debug($compte);

        $bonlivraisonsinf = $this->fetchTable('Bonlivraisons')->find('all')->where(['Bonlivraisons.client_id =' . $client_id, 'Bonlivraisons.id =' . $idbl])->first();

        $numeroobj = $this->Reglementclients->find()->select(["numero" =>
        'MAX(Reglementclients.numeroconca)'])->where(['Reglementclients.type=' . $type])->first();

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
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        if ($type == 1) {
            $paiements = $this->fetchTable('Paiements')->find('list')->where(['id NOT IN' => [4, 5, 6, 7, 8, 9]]);
        } else {
            $paiements = $this->Paiements->find('list', ['limit' => 200])->where(['Paiements.id not in (6,7,8,9,5)'])->all();
        }
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $this->loadModel('Banques');
        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $piece = $this->Piecereglementclients->find('all', ['']);
        //debug($piece->toArray());
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all'); //->where(['id !=12']);
        // debug($clients);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        $facturesav = $this->fetchTable('Factureavoirs')->find('all');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('Comptes')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $this->set(compact('factureavoirs', 'bonlivraisonsinf', 'facturesav', 'banques', 'comptes', 'compte', 'timbre', 'type', 'valeurs', 'carnetcheques', 'paiements', 'livraisons', 'factureclients', 'client_id',  'code', 'reglementclient', 'clients'));
    }
    public function getcompte()
    {
        $id = $this->request->getQuery('banque_id');
        // debug($id);
        $ind = $this->request->getQuery('ind');

        $compte = $this->fetchTable('Comptes')->find('all')->where(['Comptes.banque_id' => $id]);
        //debug($famille->toArray());
        $select1 = "<br>
        <select name='data[pieceregelemnt][" . $ind . "][compte_id]' champ='compte_id' id='compte_id" . $ind . "' class='form-control '    >
                    <option value=''  selected='selected' disabled>Veuillez choisir</option> ";
        foreach ($compte as $q) {
            //  debug($q);
            $select1 = $select1 . " <option value ='" . $q['id'] . "'";
            $select1 = $select1 . " >" . $q['numero'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select1 = $select1 . "</select> <script>  $('.select2').select2() </script> ";
        echo json_encode(array('select1' => $select1));
        die;
    }
    /**
     * Edit method
     *
     * @param string|null $id Reglementclient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($type = null, $id = null)
    {

        // error_reporting(E_ERROR | E_PARSE);
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_vente' . $abrv);

        // //   debug($liendd);
        // $user = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'reglementsclients') {
        //         $user = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($user <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }

        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        $reglement = $this->Reglementclients->get($id, [
            'contain' => [],
        ]);
        ///debug($reglement);




        $cli = $reglement->client_id;
        //debug($id);

        $lignesreg = $this->Lignereglementclients->find('all')->where(['Lignereglementclients.reglementclient_id =' . $id]);
        //debug(($lignesreg->toArray())) ;die;


        foreach ($lignesreg as $l => $li) {
            $l = '(0';


            if ($li['factureclient_id'] != 0) {
                $l .= ',' . $li['factureclient_id'];
            } else if ($li['bonlivraison_id'] != 0) {
                $l .= ',' . $li['bonlivraison_id'];
            } else if ($li['factureavoir_id'] != 0) {
                $l .= ',' . $li['factureavoir_id'];
            }
            $l .= ',0)';
        } //debug($l);




        foreach ($lignesreg as $s => $si) {

            if ($si['factureclient_id'] != 0) {
                $s = $si['reglementclient_id'];
            } else if ($si['bonlivraison_id'] != 0) {
                $s = $si['reglementclient_id'];
            }
        }
        $piecereglementclients = $this->Piecereglementclients->find('all')->where(['Piecereglementclients.reglementclient_id =' . $id, 'Piecereglementclients.paiement_id not in(6,7,8,9,5)']);
        $mtbon = 0.000;
        $mtfact = 0.000;




        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['factureclient_id'] != null) {
                $facreg[$ligne['factureclient_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else if ($ligne['bonlivraison_id'] != null) {
                $facreg[$ligne['bonlivraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            } else if ($ligne['client_id'] != null) {
                $facreg[$ligne['client_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            }
        }

        if ($cli != null) {
            $this->loadModel('Factureclients');
            $this->loadModel('Bonlivraisons');
            $this->loadModel('Clients');
            $connection = ConnectionManager::get('default');
            $compte = $this->Clients->find('all')->where(['Clients.id =' . $cli])->first();
            // debug($compte->soldedebut);
            $c = $compte['Code'];
            //debug($c);

            // $factures = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $cli , 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            $factures = $connection->execute("select * from factureclients where (factureclients.client_id=" . $cli . " and factureclients.totalttc > factureclients.Montant_Regler) OR (factureclients.id in" . $l . ");")->fetchAll('assoc');

            $livraisons = $connection->execute("select * from bonlivraisons where (bonlivraisons.client_id=" . $cli . " and bonlivraisons.typebl=1 and bonlivraisons.bl= 1 and bonlivraisons.totalttc > bonlivraisons.Montant_Regler) OR (bonlivraisons.id in" . $l . ");")->fetchAll('assoc');
            //debug($livraisons->toArray());
            $compte = $this->Clients->find('all')->where(['Clients.id =' . $cli, 'Clients.soldedebut - Clients.Montant_Regler !=0'])->first();

            // $compte = $this->fetchTable('Clients')->find('all')->where(['Clients.id =' . $cli])->first();
            // $factureavoirs = $this->fetchTable('Factureavoirs')->find('all')->where(['Factureavoirs.client_id =' . $cli,'Factureavoirs.factureclient_id=0', 'Factureavoirs.totalttc > Factureavoirs.Montant_Regler']);
            $factureavoirs = $connection->execute("select * from factureavoirs where (factureavoirs.client_id=" . $cli . " and factureavoirs.factureclient_id=0  and  factureavoirs.totalttc > factureavoirs.Montant_Regler) OR (factureavoirs.id in" . $l . ");")->fetchAll('assoc');
        }




        $idd = $reglement->id;


        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->fetchTable('Paiements')->find('list')->where(['Paiements.id not in (6,7,8,9,5)']);
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all')->where(['id !=12']);
        //debug($clients->toArray());
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->loadModel('Banques');
        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $facturesav = $this->fetchTable('Factureavoirs')->find('all');

        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('Comptes')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $this->set(compact('factureavoirs', 'idd', 'timbre', 'compte', 'comptes', 'banques', 'type', 's', 'id', 'mtfact', 'mtbon', 'facreg', 'piecereglementclients', 'lignesreg', 'valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients', 'facturesav'));
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
        $this->loadModel('Livraisons');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Factureavoirs');
        $this->loadModel('Clients');

        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_vente' . $abrv);

        // //   debug($liendd);
        // $user = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'reglementsclients') {
        //         $user = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($user <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }

        $this->request->allowMethod(['post', 'delete']);

        $lignes = $this->Lignereglementclients->find('all', [])->where(['Lignereglementclients.reglementclient_id =' . $id]);
        // foreach ($lignes as $item) {
        //     /// debug($item);die;
        //     if ($item['factureclient_id'] != null) {

        //         $mtg = $this->Factureclients->find('all')->select(["mtreg" => 'Factureclients.Montant_Regler'])->where(['Factureclients.id =' . $item['factureclient_id']])->first();
        //         $MontantRegler = $mtg->mtreg;
        //         $fact = $this->Factureclients->get($item['factureclient_id']);
        //         $fact->Montant_Regler = $MontantRegler - $item['Montant'];
        //         $this->Factureclients->save($fact);
        //     }
        //     if ($item['bonlivraison_id'] != null) {
        //         $mtg = $this->Bonlivraisons->find()->select(["mtreg" =>
        //         'Bonlivraisons.Montant_Regler'])->where(['Bonlivraisons.id =' . $item['bonlivraison_id']])->first();
        //         $MontantRegler = $mtg->mtreg;
        //         $fact = $this->fetchTable('Bonlivraisons')->get($item['bonlivraison_id']);
        //         $fact->Montant_Regler = $MontantRegler - $item['Montant'];

        //         $this->Bonlivraisons->save($fact);

        //         ///debug($fact);
        //     }

        //     $this->Lignereglementclients->delete($item);
        // }
        foreach ($lignes as $item) {
            if ($item['factureclient_id'] != null) {
                $mtg = $this->Factureclients->find('all')
                    ->select(["mtreg" => 'Factureclients.Montant_Regler'])
                    ->where(['Factureclients.id' => $item['factureclient_id']])
                    ->first();
                if ($mtg) {
                    $MontantRegler = $mtg->mtreg;
                    $fact = $this->Factureclients->get($item['factureclient_id']);
                    $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                    $this->Factureclients->save($fact);
                }
            }
            if ($item['bonlivraison_id'] != null) {
                $mtg = $this->Bonlivraisons->find()
                    ->select(["mtreg" => 'Bonlivraisons.Montant_Regler'])
                    ->where(['Bonlivraisons.id' => $item['bonlivraison_id']])
                    ->first();
                if ($mtg) {
                    $MontantRegler = $mtg->mtreg;
                    $fact = $this->Bonlivraisons->get($item['bonlivraison_id']);
                    $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                    $this->Bonlivraisons->save($fact);
                }
            }
            ///////////////////
            if ($item['client_id'] != null) {
                $this->loadModel('Clients');
                $mtg = $this->Clients->find()->select(["mtreg" =>
                'Clients.Montant_Regler'])->where(['Clients.id =' . $item['client_id']])->first();
                $MontantRegler = $mtg->mtreg;
                $clt = $this->Clients->get($item['client_id']);
                $clt->Montant_Regler = $MontantRegler - $item['Montant'];

                $this->Clients->save($clt);

                ///debug($fact);
            }
            $this->Lignereglementclients->delete($item);
        }

        $lignes2 = $this->Piecereglementclients->find()->where(["Piecereglementclients.reglementclient_id=" . $id])->all();
        foreach ($lignes2 as $item) {
            ///debug($item) ;
            if ($item['factureavoir_id'] != null) {
                $avoir = $this->Factureavoirs->find()->where(['Factureavoirs.id =' . $item['factureavoir_id']])->first();
                $avoir->valide = '0';
                $this->Factureavoirs->save($avoir);
                //  debug($avoir) ;        

            }
            $this->Piecereglementclients->delete($item);
        }


        $reglementclient = $this->Reglementclients->get($id);

        ////  debug($reglementclient) ;
        if ($this->Reglementclients->delete($reglementclient)) {
            // $this->Flash->success(__('The reglementclient has been deleted.'));
        } else {
            // $this->Flash->error(__('The reglementclient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index/' . $type]);
    }

    public function getFac($id = null)
    {

        $id = $this->request->getQuery('id');
        $client = $this->request->getQuery('client');


        if ($id == 8) {
            $query = $this->fetchTable('Factureavoirs')->find('all')
                ->where(['Factureavoirs.client_id =' . $client])
                ->where(['Factureavoirs.typef = 1'])
                ->where(['Factureavoirs.valide = 0']);




            ///// debug($query);

        }

        if ($id == 9) {
            $query = $this->fetchTable('Factureavoirs')->find('all')
                ->where(['Factureavoirs.client_id =' . $client])
                ->where(['Factureavoirs.typef = 2'])
                ->where(['Factureavoirs.valide = 0']);



            ///debug($query);

        }


        $select = "
   
    <select name='' id='' class='form-control select2'  '>
                <option  >Choisir facture !!</option>";
        foreach ($query as $q) {
            $select =  $select . "  <option value ='" . $q['id'] . "'";
            $select =  $select . " >" . $q['numero'] . '-' . $q['totalttc'] . "</option>";
        }
        $select = $select . "</select> </div> </div> ";
        echo json_encode(array('select' => $select));
        die;
    }
}

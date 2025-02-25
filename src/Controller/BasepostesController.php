<?php 
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;

/**
 * Gouvernorats Controller
 *
 * @property \App\Model\Table\BasepostesTable $Gouvernorats
 * @method \App\Model\Entity\Gouvernorat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */



class BasepostesController extends AppController {



    public function view($id = null)
    {
        $basepostes = $this->Basepostes->get($id, [
            'contain' => ['Delegations','Gouvernorats','Localites'],
        ]);
       ///debug($basepostes) ; 

        $this->set(compact('basepostes'));
    }


    public function index()
    {

        $codepostal = $this->request->getQuery('codepostale');
        $gouv_id = $this->request->getQuery('gouv_id');
        $deleg_id = $this->request->getQuery('delegation_id');
        $loc_id = $this->request->getQuery('localite_id');


        $cond1 = '' ; 
        $cond2 = '' ; 
        $cond3 = '' ; 
        $cond4 = '' ; 


        if ($codepostal) {
            $cond1 = "Basepostes.codepostale like  '%" . $codepostal . "%' ";
        }
        if ($gouv_id) {
            $cond2 = "Basepostes.id_gouv  =  '" . $gouv_id . "' ";
        }
        if ($deleg_id) {
            $cond3 = "Basepostes.id_deleg  =  '" . $deleg_id . "' ";
        }
        if ($loc_id) {
            $cond4 = "Basepostes.id_loc  =  '" . $loc_id . "' ";
        }
        $query = $this->Basepostes->find('all')->where([$cond1,$cond2,$cond3,$cond4]) ; 


        $this->paginate = [
            'contain' => ['Delegations','Gouvernorats','Localites'],
        ];
        $basepostes = $this->paginate($query);

        $this->loadModel('Basepostes');
        $this->loadModel('Delegations');

   $this->loadModel('Localites');
        $gouvernorats=$this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $localites=$this->fetchTable('Localites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $delegations=$this->fetchTable('Delegations')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('delegations','localites','localites','basepostes','gouvernorats'));
    }



    
    
    public function add() {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        $basepostes = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'basepostes') {
                $basepostes = $liens['ajout'];
            }
        }
        if (($basepostes <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'logout'));
        }



        $basepostes = $this->fetchTable('Basepostes')->newEmptyEntity();
        if ($this->request->is('post')) {
          //  debug($this->request->getData()) ; die ;

            $tab['codepostale']=$this->request->getData('codepostale');
            $tab['id_gouv']=$this->request->getData('id_gouv');
            $tab['id_deleg']=$this->request->getData('delegation_id');
            $tab['id_loc']=$this->request->getData('localite_id');

            $basepostes = $this->Basepostes->patchEntity($basepostes, $tab);
           //debug($basepostes) ; 


            if ($this->Basepostes->save($basepostes)) {

                
                return $this->redirect(['action' => 'index']);
            }



        }
        $this->loadModel('Gouvernorats');
        $this->loadModel('Basepostes');

        $gouvernorats = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name']) ;

        $this->loadModel('Basepostes');
        $this->loadModel('Delegations');

        // delegations
        $del = $this->Basepostes->find()->select(["id_deleg" => '(Basepostes.id_deleg)']);

        $dgg = '0' ; 
        foreach ($del as $j => $l) {
            $dgg = $dgg .  ','. $l->id_deleg;
             //debug($locc) ; 
        }
  
        
        if ($dgg != '') {
            $cond00 = 'Delegations.id not in (' . $dgg . ')';
        }
        //
  
  
  
        $delegations = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
              ->where($cond00);


        ///localites

         $localitesss = $this->Basepostes->find()->select(["id_loc" => '(Basepostes.id_loc)']);
         $locc = '0' ; 
        foreach ($localitesss as $j => $l) {
            $locc = $locc .  ','. $l->id_loc;
             //debug($locc) ; 
        }

        
        if ($locc != '') {
            $cond = 'Localites.id not in (' . $locc . ')';
        }

        $localites = $this->fetchTable('Localites')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
        ->where([$cond]);
        


        $this->set(compact('basepostes','gouvernorats','delegations','localites')); 

    }



    public function edit($id = null) {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        $basepostes = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'basepostes') {
                $basepostes = $liens['modif'];
            }
        }
        if (($basepostes <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'logout'));
        }

       
        $baseposte = $this->Basepostes->get($id, [
            'contain' => ['Delegations','Gouvernorats','Localites'],
        ]);

        $gouvernorats = $this->Basepostes->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $delegations = $this->Basepostes->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $localites = $this->Basepostes->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        if ($this->request->is(['patch', 'post', 'put'])) {

            //debug($this->request->getData());die;

            $tab['codepostale']=$this->request->getData('codepostale');
            $tab['id_gouv']=$this->request->getData('id_gouv');
            $tab['id_deleg']=$this->request->getData('delegation_id');
            $tab['id_loc']=$this->request->getData('localite_id');

            $baseposte = $this->Basepostes->patchEntity($baseposte, $tab);
            if ($this->Basepostes->save($baseposte)) {

                
                return $this->redirect(['action' => 'index']);
            }





        }




        $this->set(compact('baseposte','gouvernorats','delegations','localites'));
    }




    
    public function getdelegation()
    {

        $this->loadModel('Basepostes');
        $this->loadModel('Delegations');
        $id = $this->request->getQuery('idgouv');
        $ligne = $this->fetchTable('Gouvernorats')->get($id, [
            'contain' => [],
        ]);

        $del = $this->Basepostes->find()->select(["id_deleg" => '(Basepostes.id_deleg)'])->where(['id_gouv  ="' . $id . '"']);
        //debug($del);

        $i = 0;
        $tab = array();
        foreach ($del as $i => $tab) {
            $tab = $del;
        }
        $deleg = $this->Delegations->find()//->select(["namedeleg" => '(Delegations.name)'])
                ->where(['Delegations.id  in (' . $tab . ')']);

        $query = $this->fetchTable('Gouvernorats')->find();
        $query->where(['Gouvernorats.id  ="' . $id . '"']);
        //debug($query);
        foreach ($query as $qr) {
            //   debug($qr);
            $code = $qr['codepostale'];
            $name = $qr['name'];
            $c = $qr['code'];
        }







        // debug($c);die;
//  $queryyy = $this->Clients->find()->select(["code" =>
//                    'MAX(Clients.Code)']) ->first();
        $queryyy = $this->fetchTable('Clients')->find()->select(["code" => '(Clients.Code)'])->where(['Clients.Code like' . "'" . $c . "%'"]);
        $i = 0;
        $res = array();
        foreach ($queryyy as $i => $q) {
            $res[$i] = intval(substr($q['code'], 1, 9));
        }
        $p = max($res);

        if (!empty($p)) {
            $f = $c . ($p + 1);
        } else {
            $f = $c . "001";
        }



//            $t=$p+1;
//            $cc = str_pad("$t", 4, '0', STR_PAD_LEFT);
//            $f= str_pad("$cc", 5,$c, STR_PAD_LEFT); 





        $select = "

        <label class='control-label' for=''>Delegation</label>
        <select name='delegation_id' id='deleg' class='form-control select2 ' Onchange='getlocalites(this.value)'  >
		<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($deleg as $q) {
            //  debug($q); die;
            $select = $select . "	<option value ='" . $q->id . "'";
            $select = $select . " >" . $q->name . "</option>";
        }
        $select = $select . "</select> <script> $('.select2').select2()</script> </div> </div> ";

        echo json_encode(array("query" => $code, "queryyy" => $f, "queryy" => $c, "select" => $select, "name" => $name, "success" => true));
        die;


       
    }

    public function getloc($id = null) {
        $this->loadModel('Localites');
        $this->loadModel('Basepostes');
        $id = $this->request->getQuery('idDeleg');
        $ligne = $this->fetchTable('Delegations')->get($id, [
            'contain' => [],
        ]);

        //$del=$this->fetchTable('Base_postes')->find()->where(['gouvernorats.id  ="' .$id.'"']);


        $query = $this->fetchTable('Delegations')->find();
        $query->where(['Delegations.id  ="' . $id . '"']);
        foreach ($query as $qr) {
            //     debug($qr)
            $code = $qr['codepostale'];
            $name = $qr['name'];
        }
        // debug($name);



        $loc = $this->Basepostes->find()->select(["id_loc" => '(Basepostes.id_loc)'])->where(['id_deleg  ="' . $id . '"']);
        $j = 0;
        $tab1 = array();
        foreach ($loc as $j => $tab1) {
            $tab1 = $loc;
        }

        $localite = $this->Localites->find()//->select(["namedeleg" => '(Delegations.name)'])
                ->where(['Localites.id  in (' . $tab1 . ')']);
        //debug($localite);





        $select = "
        <label class='control-label' for='sousfamille1-id'>Localite</label>
        <select name='localite_id'  class='form-control select2' Onchange='localite(this.value)'>
					<option value=''  selected='selected'>Veuillez choisir</option>";
        foreach ($localite as $q) {
            //  debug($q); die;
            $select = $select . "	<option value ='" . $q->id . "'";
            $select = $select . " >" . $q->name . "</option>";
        }
        $select = $select . "</select> <script> $('.select2').select2()</script>  ";
        echo json_encode(array("name" => $name, "query" => $code, "select" => $select, "success" => true));

//        echo json_encode(array('select' => $select));
        //echo json_encode(array('select' => $select, 'ligne' => $ligne));
        die;
        //  $this->set(compact('query'));
    }


    public function delete($id = null) {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        $basepostes = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'basepostes') {
                $basepostes = $liens['supp'];
            }
        }
        if (($basepostes <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'logout'));
        }

       
        $baseposte = $this->Basepostes->get($id);
        if ($this->Basepostes->delete($baseposte)) {
        } else {
            
        }

        return $this->redirect(['action' => 'index']);
    }



}

































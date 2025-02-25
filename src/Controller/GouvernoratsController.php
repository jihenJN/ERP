<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Gouvernorats Controller
 *
 * @property \App\Model\Table\GouvernoratsTable $Gouvernorats
 * @method \App\Model\Entity\Gouvernorat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GouvernoratsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $cond1 ='' ;
        $cond2 ='' ;
        $cond3 ='' ;
        $cond4 ='' ; 

        $code = $this->request->getQuery('Code');
        $nom = $this->request->getQuery('name');
        $codepostale = $this->request->getQuery('codepostale');
        $pay_id = $this->request->getQuery('pay_id');

        if ($code) {
            $cond1 = "Gouvernorats.Code like  '%" . $code . "%' ";
        }
        if ($nom) {
            $cond2 = "Gouvernorats.name like  '%" . $nom . "%' ";
        }
        if ($codepostale) {
            $cond3 = "Gouvernorats.codepostale like  '%" . $codepostale . "%' ";
        }
        if ($pay_id) {
            $cond4 = "Gouvernorats.pay_id  =  '" . $pay_id . "' ";
        }

        $query = $this->Gouvernorats->find('all')->where([$cond1, $cond2,$cond3,$cond4]) ; 


        $this->paginate = [
            'contain' => ['Pays'],
        ];
        $gouvernorats = $this->paginate($query);

        $pays = $this->Gouvernorats->Pays->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $this->set(compact('gouvernorats','pays'));
    }

    /**
     * View method
     *
     * @param string|null $id Gouvernorat id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gouvernorat = $this->Gouvernorats->get($id, [
            'contain' => ['Pays'],
        ]);

        //debug($gouvernorat) ; 

        $pays = $this->Gouvernorats->Pays->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $this->set(compact('gouvernorat','pays'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         $this->loadModel('Accueils');
         $session = $this->request->getSession();
         $acc = $this->Accueils->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        foreach ($acc as $ac) {

            $abrv = $ac['name'];    //debug($abrv);die;
         }

         $lien = $session->read('lien_parametrage' . $abrv);
        $gouvernorat = 0;
         if (!empty($lien)) {
             foreach ($lien as $k => $liens) {
                 if (@$liens['lien'] == 'gouvernorats') {
                     $gouvernorat = $liens['ajout'];
                 }
             }
         }
        if (($gouvernorat <> 1) || (empty($lien))) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
         }
        $gouvernorat = $this->Gouvernorats->newEmptyEntity();
        if ($this->request->is('post')) {



       // debug($this->request->getData());die;
            $tab['code']=$this->request->getData('code');
            $tab['codepostale']=$this->request->getData('codepostale');
            $tab['name']=$this->request->getData('name');
            $tab['pay_id']=$this->request->getData('pay_id');



            $gouvernorat = $this->Gouvernorats->patchEntity($gouvernorat, $tab);
            // debug($gouvernorat);


            if ($this->Gouvernorats->save($gouvernorat)) {

                

                $gouv_id = ($this->Gouvernorats->save($gouvernorat)->id);
                $this->misejour("Gouvernorats", "add", $gouv_id);
                
                return $this->redirect(['action' => 'index']);
            }
        
        }

        $pays = $this->Gouvernorats->Pays->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('gouvernorat','pays'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Gouvernorat id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Accueils');
         $session = $this->request->getSession();
         $acc = $this->Accueils->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        foreach ($acc as $ac) {

            $abrv = $ac['name'];    //debug($abrv);die;
         }

         $lien = $session->read('lien_parametrage' . $abrv);
        $gouvernorat = 0;
         if (!empty($lien)) {
             foreach ($lien as $k => $liens) {
                 if (@$liens['lien'] == 'gouvernorats') {
                     $gouvernorat = $liens['modif'];
                 }
             }
         }
        if (($gouvernorat <> 1) || (empty($lien))) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
         }
        $gouvernorat = $this->Gouvernorats->get($id, [
            'contain' => ['Pays'],
        ]);
       //debug($gouvernorat) ; 

        if ($this->request->is(['patch', 'post', 'put'])) {
            $tab['code']=$this->request->getData('code');
            $tab['codepostale']=$this->request->getData('codepostale');
            $tab['name']=$this->request->getData('name');
            $tab['pay_id']=$this->request->getData('pay_id');


            $gouvernorat = $this->Gouvernorats->patchEntity($gouvernorat, $tab);
               debug($gouvernorat) ; 
            if ($this->Gouvernorats->save($gouvernorat)) {

                //debug($gouvernorat) ; 
                
                $gouv_id = ($this->Gouvernorats->save($gouvernorat)->id);
                $this->misejour("Gouvernorats", "edit", $gouv_id);
              

                return $this->redirect(['action' => 'index']);
            }
          
        }
        $pays = $this->Gouvernorats->Pays->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('gouvernorat','pays'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Gouvernorat id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
      $this->loadModel('Accueils');
         $session = $this->request->getSession();
         $acc = $this->Accueils->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        foreach ($acc as $ac) {

            $abrv = $ac['name'];    //debug($abrv);die;
         }

         $lien = $session->read('lien_parametrage' . $abrv);
        $gouvernorat = 0;
         if (!empty($lien)) {
             foreach ($lien as $k => $liens) {
                 if (@$liens['lien'] == 'gouvernorats') {
                     $gouvernorat = $liens['supp'];
                 }
             }
         }
        if (($gouvernorat <> 1) || (empty($lien))) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
         }


       // $this->request->allowMethod(['post', 'delete']);
        $gouvernorat = $this->Gouvernorats->get($id);
        // debug($gouvernorat) ;
        if ($this->Gouvernorats->delete($gouvernorat)) {

            $gouv_id = ($this->Gouvernorats->save($gouvernorat)->id);
                $this->misejour("Gouvernorats", "delete", $gouv_id);
        
        } else {
          
        }

        return $this->redirect(['action' => 'index']);
    }


    public function getgvbase($id = null) {
        $this->loadModel('Basepostes');
        $id = $this->request->getQuery('idGouv');
        $gouvbase = $this->fetchTable('Basepostes')->find('all')->where(['Basepostes.id_gouv=' . $id])->count();
        echo json_encode(array("query" => $gouvbase, "success" => true));
        die;
    }



}



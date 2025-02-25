<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Delegations Controller
 *
 * @property \App\Model\Table\DelegationsTable $Delegations
 * @method \App\Model\Entity\Delegation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DelegationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {


        $nom = $this->request->getQuery('name');
        $codepostale = $this->request->getQuery('codepostale');

        $cond1 = '' ; 
        $cond11= '' ; 


        if ($nom) {
            $cond1 = "Delegations.name like  '%" . $nom . "%' ";
        }
        if ($codepostale) {
            $cond11 = "Delegations.codepostale like  '%" . $codepostale . "%' ";
        }

        $query = $this->Delegations->find('all')->where([$cond1, $cond11]) ; 

        $this->paginate = [
            'contain' => [],
        ];
        $delegations = $this->paginate($query);

       


        $this->set(compact('delegations'));
    }

    /**
     * View method
     *
     * @param string|null $id Delegation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $delegation = $this->Delegations->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('delegation'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $user = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'delegations') {
                $user = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($user <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $delegation = $this->Delegations->newEmptyEntity();
        if ($this->request->is('post')) {
            $delegation = $this->Delegations->patchEntity($delegation, $this->request->getData());
            if ($this->Delegations->save($delegation)) {

                $deleg_id = ($this->Delegations->save($delegation)->id);
                $this->misejour("Delegations", "add", $deleg_id);
               // $this->Flash->success(__('The delegation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The delegation could not be saved. Please, try again.'));
        }
        $this->set(compact('delegation'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Delegation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
         $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $user = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'delegations') {
                $user = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($user <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $delegation = $this->Delegations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $delegation = $this->Delegations->patchEntity($delegation, $this->request->getData());
            if ($this->Delegations->save($delegation)) {

                $deleg_id = ($this->Delegations->save($delegation)->id);
                $this->misejour("Delegations", "edit", $deleg_id);
               // $this->Flash->success(__('The delegation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The delegation could not be saved. Please, try again.'));
        }
        $this->set(compact('delegation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Delegation id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $user = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'delegations') {
                $user = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($user <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
      ///  $this->request->allowMethod(['post', 'delete']);
        $delegation = $this->Delegations->get($id);
        if ($this->Delegations->delete($delegation)) {

            $deleg_id = ($this->Delegations->save($delegation)->id);
            $this->misejour("Delegations", "delete", $deleg_id);
            
         //   $this->Flash->success(__('The delegation has been deleted.'));
        } else {
        //    $this->Flash->error(__('The delegation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function getdgbase($id = null) {
        $this->loadModel('Basepostes');
        $id = $this->request->getQuery('idDg');
        $delegbase = $this->fetchTable('Basepostes')->find('all')->where(['Basepostes.id_deleg=' . $id])->count();
        echo json_encode(array("query" => $delegbase, "success" => true));
        die;
    }
}

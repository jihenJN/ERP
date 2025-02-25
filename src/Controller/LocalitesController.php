<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Localites Controller
 *
 * @property \App\Model\Table\LocalitesTable $Localites
 * @method \App\Model\Entity\Localite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LocalitesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $nom = $this->request->getQuery('name');


        $cond = '' ; 
        
        if ($nom) {
            $cond = "Localites.name like  '%" . $nom . "%' ";
        }
       

        $query = $this->Localites->find('all')->where([$cond]) ; 

        $this->paginate = [
            'contain' => [],
        ];
        $localites = $this->paginate($query);

        $this->set(compact('localites'));
    }

    /**
     * View method
     *
     * @param string|null $id Localite id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $localite = $this->Localites->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('localite'));
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
            if (@$liens['lien'] == 'localites') {
                $user = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($user <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $localite = $this->Localites->newEmptyEntity();
        if ($this->request->is('post')) {
            $localite = $this->Localites->patchEntity($localite, $this->request->getData());
            if ($this->Localites->save($localite)) {

                $loc_id = ($this->Localites->save($localite)->id);
                $this->misejour("Localites", "add", $loc_id);
                
               // $this->Flash->success(__('The localite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
         //   $this->Flash->error(__('The localite could not be saved. Please, try again.'));
        }
        $this->set(compact('localite'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Localite id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {$session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $user = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'localites') {
                $user = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($user <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $localite = $this->Localites->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $localite = $this->Localites->patchEntity($localite, $this->request->getData());
            if ($this->Localites->save($localite)) {

                $loc_id = ($this->Localites->save($localite)->id);
                $this->misejour("Localites", "edit", $loc_id);
              //  $this->Flash->success(__('The localite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The localite could not be saved. Please, try again.'));
        }
        $this->set(compact('localite'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Localite id.
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
            if (@$liens['lien'] == 'localites') {
                $user = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($user <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
       // $this->request->allowMethod(['post', 'delete']);
        $localite = $this->Localites->get($id);
        if ($this->Localites->delete($localite)) {

            $loc_id = ($this->Localites->save($localite)->id);
            $this->misejour("Localites", "delete", $loc_id);
            //$this->Flash->success(__('The localite has been deleted.'));
        } else {
          //  $this->Flash->error(__('The localite could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function getlocbase($id = null) {
        $this->loadModel('Basepostes');
        $id = $this->request->getQuery('idLoc');
        $loccbase = $this->fetchTable('Basepostes')->find('all')->where(['Basepostes.id_loc=' . $id])->count();
        echo json_encode(array("query" => $loccbase, "success" => true));
        die;
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Agences Controller
 *
 * @property \App\Model\Table\AgencesTable $Agences
 * @method \App\Model\Entity\Agence[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AgencesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $agences = $this->paginate($this->Agences);

        $this->set(compact('agences'));
    }

    /**
     * View method
     *
     * @param string|null $id Agence id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $agence = $this->Agences->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('agence'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_finance' . $abrv);
        //  /// debug($liendd);die;
        // $f = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'agences') {
        //         $f = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($f <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // } 

        $agence = $this->Agences->newEmptyEntity();
        if ($this->request->is('post')) {
            $agence = $this->Agences->patchEntity($agence, $this->request->getData());
            if ($this->Agences->save($agence)) {
                //$this->Flash->success(__('The agence has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The agence could not be saved. Please, try again.'));
        }
        $this->set(compact('agence'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Agence id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {




        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_finance' . $abrv);
        // //   debug($liendd);
        // $ff = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'agences') {
        //         $ff = $liens['modif'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }    

        $agence = $this->Agences->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $agence = $this->Agences->patchEntity($agence, $this->request->getData());
            if ($this->Agences->save($agence)) {
               // $this->Flash->success(__('The agence has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The agence could not be saved. Please, try again.'));
        }
        $this->set(compact('agence'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Agence id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_finance' . $abrv);
        // //   debug($liendd);
        // $ff = 0;
        // foreach ($liendd as $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'agences') {
        //         $ff = $liens['delete'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // } 
      //  $this->request->allowMethod(['post', 'delete']);
        $agence = $this->Agences->get($id);
     $this->Agences->delete($agence);
   

        return $this->redirect(['action' => 'index']);
    }
}

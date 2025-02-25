<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Frequences Controller
 *
 * @property \App\Model\Table\FrequencesTable $Frequences
 * @method \App\Model\Entity\Frequence[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FrequencesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $frequences = $this->paginate($this->Frequences);

        $this->set(compact('frequences'));
    }

    /**
     * View method
     *
     * @param string|null $id Frequence id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $frequence = $this->Frequences->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('frequence'));
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
        //     if (@$liens['lien'] == 'frequences') {
        //         $f = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($f <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // } 
        $frequence = $this->Frequences->newEmptyEntity();
        if ($this->request->is('post')) {
            $frequence = $this->Frequences->patchEntity($frequence, $this->request->getData());
            if ($this->Frequences->save($frequence)) {
               // $this->Flash->success(__('The frequence has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
          //  $this->Flash->error(__('The frequence could not be saved. Please, try again.'));
        }
        $this->set(compact('frequence'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Frequence id.
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
        //     if (@$liens['lien'] == 'frequences') {
        //         $ff = $liens['modif'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }    

        $frequence = $this->Frequences->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $frequence = $this->Frequences->patchEntity($frequence, $this->request->getData());
            if ($this->Frequences->save($frequence)) {
                //$this->Flash->success(__('The frequence has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
          //  $this->Flash->error(__('The frequence could not be saved. Please, try again.'));
        }
        $this->set(compact('frequence'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Frequence id.
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
        //     if (@$liens['lien'] == 'frequence') {
        //         $ff = $liens['delete'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // } 
       /// $this->request->allowMethod(['post', 'delete']);
        $frequence = $this->Frequences->get($id);
       $this->Frequences->delete($frequence);

        return $this->redirect(['action' => 'index']);
    }
}

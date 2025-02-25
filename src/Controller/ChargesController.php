<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Charges Controller
 *
 * @property \App\Model\Table\ChargesTable $Charges
 * @method \App\Model\Entity\Charge[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChargesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => [],
        ];
        $charges = $this->paginate($this->Charges);

        $this->set(compact('charges'));
    }

    /**
     * View method
     *
     * @param string|null $id Charge id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $charge = $this->Charges->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('charge'));
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
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'charges') {
                $societe = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $charge = $this->Charges->newEmptyEntity();
        if ($this->request->is('post')) {
          //  debug($this->request->getData());//die;
            $charge = $this->Charges->patchEntity($charge, $this->request->getData());
            //  debug($charge);die;
            if ($this->Charges->save($charge)) {
             //   $this->Flash->success(__('The charge has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
          //  $this->Flash->error(__('The charge could not be saved. Please, try again.'));
        }
//        $fraisdivers = $this->Charges->Fraisdivers->find('list', ['limit' => 200])->all();
//        $materieltransports = $this->Charges->Materieltransports->find('list', ['limit' => 200])->all();
        $this->set(compact('charge'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Charge id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
         $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'charges') {
                $societe = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $charge = $this->Charges->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $charge = $this->Charges->patchEntity($charge, $this->request->getData());
            if ($this->Charges->save($charge)) {
              //  $this->Flash->success(__('The charge has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The charge could not be saved. Please, try again.'));
        }
       // $fraisdivers = $this->Charges->Fraisdivers->find('list', ['limit' => 200])->all();
       // $materieltransports = $this->Charges->Materieltransports->find('list', ['limit' => 200])->all();
        $this->set(compact('charge'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Charge id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
            $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'charges') {
                $societe = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $charge = $this->Charges->get($id);
        if ($this->Charges->delete($charge)) {
          //  $this->Flash->success(__('The charge has been deleted.'));
        } else {
         //   $this->Flash->error(__('The charge could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

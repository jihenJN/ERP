<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Devises Controller
 *
 * @property \App\Model\Table\DevisesTable $Devises
 * @method \App\Model\Entity\Devise[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DevisesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
             $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'devises') {
                $societe = 1;
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $cond = '';

        $nom = $this->request->getQuery('name');

        if ($nom) {
            $cond = "Devises.name  like  '%" . $nom . "%' ";
           
        }

        $query = $this->Devises->find('all')->where([$cond]);
        $devises = $this->paginate($query);

        $this->set(compact('devises'));
    }

    /**
     * View method
     *
     * @param string|null $id Devise id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $devise = $this->Devises->get($id, [
            'contain' => ['Fournisseurs'],
        ]);

        $this->set(compact('devise'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
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
            if (@$liens['lien'] == 'devises') {
                $societe = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $devise = $this->Devises->newEmptyEntity();
        if ($this->request->is('post')) {
            $devise = $this->Devises->patchEntity($devise, $this->request->getData());
            if ($this->Devises->save($devise)) {
              //  $this->Flash->success(__('The {0} has been saved.', 'Devise'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Devise'));
        }
        $this->set(compact('devise'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Devise id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {  $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'devises') {
                $societe = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $devise = $this->Devises->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $devise = $this->Devises->patchEntity($devise, $this->request->getData());
            if ($this->Devises->save($devise)) {
              //  $this->Flash->success(__('The {0} has been saved.', 'Devise'));

                return $this->redirect(['action' => 'index']);
            }
          //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Devise'));
        }
        $this->set(compact('devise'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Devise id.
     * @return \Cake\Http\Response|null Redirects to index.
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
            if (@$liens['lien'] == 'devises') {
                $societe = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $devise = $this->Devises->get($id);
        if ($this->Devises->delete($devise)) {
            //$this->Flash->success(__('The {0} has been deleted.', 'Devise'));
        } else {
           // $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Devise'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

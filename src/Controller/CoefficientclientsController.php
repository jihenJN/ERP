<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Coefficientclients Controller
 *
 * @property \App\Model\Table\CoefficientclientsTable $Coefficientclients
 * @method \App\Model\Entity\Coefficientclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoefficientclientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $coefficientclients = $this->paginate($this->Coefficientclients);

        $this->set(compact('coefficientclients'));
    }

    /**
     * View method
     *
     * @param string|null $id Coefficientclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coefficientclient = $this->Coefficientclients->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('coefficientclient'));
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

        //debug($liendd);
        $coefficientclient = 0;
        foreach ($liendd as $k => $liens) {
            //debug($liens);die;
            if (@$liens['lien'] == 'coefficientclients') {
                $coefficientclient = $liens['ajout'];
            }
        }
        // debug($Coefficientclient);die;
        if (($coefficientclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $coefficientclient = $this->Coefficientclients->newEmptyEntity();
        if ($this->request->is('post')) {
            $coefficientclient = $this->Coefficientclients->patchEntity($coefficientclient, $this->request->getData());
            if ($this->Coefficientclients->save($coefficientclient)) {
                $coefficientclient_id = ($this->Coefficientclients->save($coefficientclient)->id);
                $this->misejour("Coefficientclients", "add", $coefficientclient_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('coefficientclient'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Coefficientclient id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $coefficientclient = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'coefficientclients') {
                $coefficientclient = $liens['modif'];
            }
        }
        // debug($Coefficientclient);die;
        if (($coefficientclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $coefficientclient = $this->Coefficientclients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coefficientclient = $this->Coefficientclients->patchEntity($coefficientclient, $this->request->getData());
            if ($this->Coefficientclients->save($coefficientclient)) {
                $coefficientclient_id = ($this->Coefficientclients->save($coefficientclient)->id);
                $this->misejour("Coefficientclients", "edit", $coefficientclient_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('coefficientclient'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Coefficientclient id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $coefficientclient = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'coefficientclients') {
                $coefficientclient = $liens['supp'];
            }
        }
        // debug($Coefficientclient);die;
        if (($coefficientclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $coefficientclient = $this->Coefficientclients->get($id);
        if ($this->Coefficientclients->delete($coefficientclient)) {
            $coefficientclient_id = ($this->Coefficientclients->save($coefficientclient)->id);
            $this->misejour("Coefficientclients", "delete", $coefficientclient_id);
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Coefficientclient'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

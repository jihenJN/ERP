<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Nombrecommandes Controller
 *
 * @property \App\Model\Table\NombrecommandesTable $Nombrecommandes
 * @method \App\Model\Entity\Nombrecommande[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NombrecommandesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Nombrecommandes->find('all')->order(["Nombrecommandes.id" => 'desc']);
        $this->paginate = [
            'contain' => [],
        ];
        $nombrecommandes = $this->paginate($query);
        $this->set(compact('nombrecommandes'));
    }

    /**
     * View method
     *
     * @param string|null $id Nombrecommande id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nombrecommande = $this->Nombrecommandes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('nombrecommande'));
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
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $nombrecommande = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'nombrecommandes') {
                $nombrecommande = $liens['ajout'];
            }
        }
        // debug($nombrecommande);die;
        if (($nombrecommande <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $nombrecommande = $this->Nombrecommandes->newEmptyEntity();
        if ($this->request->is('post')) {
            $nombrecommande = $this->Nombrecommandes->patchEntity($nombrecommande, $this->request->getData());
            if ($this->Nombrecommandes->save($nombrecommande)) {
                $nombrecommande_id = ($this->Nombrecommandes->save($nombrecommande)->id);
                $this->misejour("Nombrecommandes", "add", $nombrecommande_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('nombrecommande'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Nombrecommande id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $nombrecommande = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'nombrecommandes') {
                $nombrecommande = $liens['modif'];
            }
        }
        // debug($nombrecommande);die;
        if (($nombrecommande <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $nombrecommande = $this->Nombrecommandes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nombrecommande = $this->Nombrecommandes->patchEntity($nombrecommande, $this->request->getData());
            if ($this->Nombrecommandes->save($nombrecommande)) {
                $nombrecommande_id = ($this->Nombrecommandes->save($nombrecommande)->id);
                $this->misejour("Nombrecommandes", "edit", $nombrecommande_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('nombrecommande'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Nombrecommande id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $nombrecommande = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'nombrecommandes') {
                $nombrecommande = $liens['supp'];
            }
        }
        // debug($nombrecommande);die;
        if (($nombrecommande <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $nombrecommande = $this->Nombrecommandes->get($id);
        if ($this->Nombrecommandes->delete($nombrecommande)) {
            $nombrecommande_id = ($this->Nombrecommandes->save($nombrecommande)->id);
            $this->misejour("Nombrecommandes", "delete", $nombrecommande_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

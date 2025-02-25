<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Fonctions Controller
 *
 * @property \App\Model\Table\FonctionsTable $Fonctions
 * @method \App\Model\Entity\Fonction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FonctionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Fonctions->find('all')->order(["Fonctions.id" => 'desc']);
        $this->paginate = [
            'contain' => [],
        ];
        $fonctions = $this->paginate($query);
        //$fonctions = $this->paginate($this->Fonctions);

        $this->set(compact('fonctions'));
    }

    /**
     * View method
     *
     * @param string|null $id Fonction id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fonction = $this->Fonctions->get($id, [
            'contain' => ['Personnels'],
        ]);

        $this->set(compact('fonction'));
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
        $fonction = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'fonctions') {
                $fonction = $liens['ajout'];
            }
        }
        // debug($fonction);die;
        if (($fonction <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }




        $fonction = $this->Fonctions->newEmptyEntity();
        if ($this->request->is('post')) {
            $fonction = $this->Fonctions->patchEntity($fonction, $this->request->getData());
            if ($this->Fonctions->save($fonction)) {
                $fonction_id = ($this->Fonctions->save($fonction)->id);
                $this->misejour("Fonctions", "add", $fonction_id);


                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('fonction'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Fonction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $fonction = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'fonctions') {
                $fonction = $liens['modif'];
            }
        }
        // debug($fonction);die;
        if (($fonction <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $fonction = $this->Fonctions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fonction = $this->Fonctions->patchEntity($fonction, $this->request->getData());
            if ($this->Fonctions->save($fonction)) {
                $fonction_id = ($this->Fonctions->save($fonction)->id);
                $this->misejour("Fonctions", "edit", $fonction_id);


                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('fonction'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Fonction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $fonction = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'fonctions') {
                $fonction = $liens['supp'];
            }
        }
        // debug($fonction);die;
        if (($fonction <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $fonction = $this->Fonctions->get($id);
        if ($this->Fonctions->delete($fonction)) {
            $fonction_id = ($this->Fonctions->save($fonction)->id);
            $this->misejour("Fonctions", "delete", $fonction_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

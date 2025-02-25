<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Activites Controller
 *
 * @property \App\Model\Table\ActivitesTable $Activites
 * @method \App\Model\Entity\Activite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivitesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $query = $this->Activites->find('all')->order(["Activites.id" => 'desc']);
        $this->paginate = [
            'contain' => [],
        ];
        $activites = $this->paginate($query);

        $this->set(compact('activites'));
    }

    /**
     * View method
     *
     * @param string|null $id Activite id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activite = $this->Activites->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('activite'));
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
        $activite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'activites') {
                $activite = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($activite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $activite = $this->Activites->newEmptyEntity();
        if ($this->request->is('post')) {
            $activite = $this->Activites->patchEntity($activite, $this->request->getData());
            if ($this->Activites->save($activite)) {
                $activite_id = ($this->Activites->save($activite)->id);
                $this->misejour("Activites", "add", $activite_id);


                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('activite'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Activite id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $activite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'activites') {
                $activite = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($activite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $activite = $this->Activites->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activite = $this->Activites->patchEntity($activite, $this->request->getData());
            if ($this->Activites->save($activite)) {
                $activite_id = ($this->Activites->save($activite)->id);
                $this->misejour("Activites", "edit", $activite_id);


                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('activite'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Activite id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $activite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'activites') {
                $activite = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($activite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $activite = $this->Activites->get($id);
        if ($this->Activites->delete($activite)) {
            $activite_id = ($this->Activites->save($activite)->id);
            $this->misejour("Activites", "delete", $activite_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

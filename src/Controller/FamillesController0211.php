<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Familles Controller
 *
 * @property \App\Model\Table\FamillesTable $Familles
 * @method \App\Model\Entity\Famille[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FamillesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $cond1 = '';
        $name = $this->request->getQuery('name');
        if ($name) {
            $cond1 = "Familles.Nom like  '%" . $name . "%' ";
        }
        $query = $this->Familles->find('all')->where([$cond1])->order(["Familles.id" => 'desc']);
        $familles = $this->paginate($this->Familles);
        $familles = $this->paginate($query);
        $this->set(compact('familles'));
    }

    /**
     * View method
     *
     * @param string|null $id Famille id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $famille = $this->Familles->get($id, [
            'contain' => ['Articles', 'Sousfamille1s'],
        ]);

        $this->set(compact('famille'));
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
        $famille = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'familles') {
                $famille = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($famille <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $famille = $this->Familles->newEmptyEntity();
        if ($this->request->is('post')) {
            $famille = $this->Familles->patchEntity($famille, $this->request->getData());
            if ($this->Familles->save($famille)) {
                $famille_id = ($this->Familles->save($famille)->id);
                $this->misejour("Familles", "add", $famille_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('famille'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Famille id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $famille = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'familles') {
                $famille = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($famille <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $famille = $this->Familles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $famille = $this->Familles->patchEntity($famille, $this->request->getData());
            if ($this->Familles->save($famille)) {
                $famille_id = ($this->Familles->save($famille)->id);
                $this->misejour("Familles", "edit", $famille_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('famille'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Famille id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $famille = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'familles') {
                $famille = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($famille <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $famille = $this->Familles->get($id);
        if ($this->Familles->delete($famille)) {
            $famille_id = ($this->Familles->save($famille)->id);
            $this->misejour("Familles", "delete", $famille_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

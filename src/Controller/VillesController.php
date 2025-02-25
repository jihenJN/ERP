<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Villes Controller
 *
 * @property \App\Model\Table\VillesTable $Villes
 * @method \App\Model\Entity\Ville[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VillesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $name = $this->request->getQuery('name');
        $pay_id = $this->request->getQuery('pay_id');
        $cond1 = '';
        $cond2 = '';
        if ($name) {
            $cond1 = "Villes.name like  '%" . $name . "%' ";
        }
        if ($pay_id) {
            $cond2 = "Villes.pay_id like  '%" . $pay_id . "%' ";
        }
        $query = $this->Villes->find('all')->where([$cond1, $cond2])->order(["Villes.id" => 'desc']);
        $this->paginate = [
            'contain' => ['Pays'],
        ];
        $pays = $this->Villes->Pays->find('list', ['limit' => 200]);
        $villes = $this->paginate($query);
        $this->set(compact('villes', 'pays'));
    }

    /**
     * View method
     *
     * @param string|null $id Ville id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ville = $this->Villes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ville = $this->Villes->patchEntity($ville, $this->request->getData());
        }
        $pays = $this->Villes->Pays->find('list', ['limit' => 200]);
        $this->set(compact('ville', 'pays'));
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
        $ville = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'villes') {
                $ville = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($ville <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }



        $ville = $this->Villes->newEmptyEntity();
        if ($this->request->is('post')) {
            $ville = $this->Villes->patchEntity($ville, $this->request->getData());
            if ($this->Villes->save($ville)) {
                $ville_id = ($this->Villes->save($ville)->id);
                $this->misejour("Villes", "add", $ville_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $pays = $this->Villes->Pays->find('list', ['limit' => 200]);
        $this->set(compact('ville', 'pays'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Ville id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $ville = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'villes') {
                $ville = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($ville <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $ville = $this->Villes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ville = $this->Villes->patchEntity($ville, $this->request->getData());
            if ($this->Villes->save($ville)) {
                $ville_id = ($this->Villes->save($ville)->id);
                $this->misejour("Villes", "edit", $ville_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $pays = $this->Villes->Pays->find('list', ['limit' => 200]);
        $this->set(compact('ville', 'pays'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Ville id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $ville = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'villes') {
                $ville = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($ville <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->request->allowMethod(['post', 'delete']);
        $ville = $this->Villes->get($id);
        if ($this->Villes->delete($ville)) {
            $ville_id = ($this->Villes->save($ville)->id);
            $this->misejour("Villes", "delete", $ville_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

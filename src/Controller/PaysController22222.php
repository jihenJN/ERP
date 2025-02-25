<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Pays Controller
 *
 * @property \App\Model\Table\PaysTable $Pays
 * @method \App\Model\Entity\Pay[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaysController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $name = $this->request->getQuery('name');
        $cond1 = '';
        if ($name) {
            $cond1 = "Pays.name like  '%" . $name . "%' ";
        }
        $query = $this->Pays->find('all')->where([$cond1])->order(["Pays.id" => 'desc']);
        // $this->paginate = [
        //     'contain' => [''],
        // ];
        $pays = $this->paginate($query);
        $this->set(compact('pays'));
    }

    /**
     * View method
     *
     * @param string|null $id Pay id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pay = $this->Pays->get($id, [
            'contain' => ['Fournisseurs', 'Villes'],
        ]);

        $this->set(compact('pay'));
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
        $pay = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'pays') {
                $pay = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($pay <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $pay = $this->Pays->newEmptyEntity();
        if ($this->request->is('post')) {
            $pay = $this->Pays->patchEntity($pay, $this->request->getData());
            if ($this->Pays->save($pay)) {
                $pay_id = ($this->Pays->save($pay)->id);
                $this->misejour("Pays", "add", $pay_id);


                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('pay'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Pay id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $pay = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'pays') {
                $pay = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($pay <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $pay = $this->Pays->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pay = $this->Pays->patchEntity($pay, $this->request->getData());
            if ($this->Pays->save($pay)) {
                $pay_id = ($this->Pays->save($pay)->id);
                $this->misejour("Pays", "edit", $pay_id);


                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('pay'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Pay id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $pay = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'pays') {
                $pay = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($pay <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->request->allowMethod(['post', 'delete']);
        $pay = $this->Pays->get($id);
        if ($this->Pays->delete($pay)) {
            $pay_id = ($this->Pays->save($pay)->id);
            $this->misejour("Pays", "delete", $pay_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

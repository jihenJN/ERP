<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Cartecarburants Controller
 *
 * @property \App\Model\Table\CartecarburantsTable $Cartecarburants
 * @method \App\Model\Entity\Cartecarburant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CartecarburantsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view 
     */
    public function index()
    {
        $num = $this->request->getQuery('num');
        $typekiosque = $this->request->getQuery('typekiosque');
        $cond1 = '';
        $cond2 = '';
        if ($num) {
            $cond1 = "Cartecarburants.num like  '%" . $num . "%' ";
        }
        if ($typekiosque) {
            $cond2 = "Cartecarburants.typekiosque like  '%" . $typekiosque . "%' ";
        }
        $query = $this->Cartecarburants->find('all')->where([$cond1, $cond2])->order(["Cartecarburants.id" => 'desc']);
        $cartecarburants = $this->paginate($query);
        $this->paginate = [
            'contain' => ['Typecartecarburants'],
        ];
        $this->set(compact('cartecarburants'));
    }

    /**
     * View method
     *
     * @param string|null $id Cartecarburant id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cartecarburant = $this->Cartecarburants->get($id, [
            'contain' => []
        ]);
        $typecartecarburants = $this->Cartecarburants->Typecartecarburants->find('list', ['limit' => 200]);
        $this->set(compact('cartecarburant', 'typecartecarburants'));
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
        $cartecarburant = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'cartecarburants') {
                $cartecarburant = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($cartecarburant <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $cartecarburant = $this->Cartecarburants->newEmptyEntity();
        if ($this->request->is('post')) {
            $cartecarburant = $this->Cartecarburants->patchEntity($cartecarburant, $this->request->getData());
            if ($this->Cartecarburants->save($cartecarburant)) {
                $cartecarburant_id = ($this->Cartecarburants->save($cartecarburant)->id);
                $this->misejour("Cartecarburants", "add", $cartecarburant_id);


                return $this->redirect(['action' => 'index']);
            }
        }
        $typecartecarburants = $this->Cartecarburants->Typecartecarburants->find('list', ['limit' => 200]);
        $this->set(compact('cartecarburant', 'typecartecarburants'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Cartecarburant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $cartecarburant = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'cartecarburants') {
                $cartecarburant = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($cartecarburant <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $cartecarburant = $this->Cartecarburants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cartecarburant = $this->Cartecarburants->patchEntity($cartecarburant, $this->request->getData());
            if ($this->Cartecarburants->save($cartecarburant)) {
                $cartecarburant_id = ($this->Cartecarburants->save($cartecarburant)->id);
                $this->misejour("Cartecarburants", "edit", $cartecarburant_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $typecartecarburants = $this->Cartecarburants->Typecartecarburants->find('list', ['limit' => 200]);
        $this->set(compact('cartecarburant', 'typecartecarburants'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Cartecarburant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $cartecarburant = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'cartecarburants') {
                $cartecarburant = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($cartecarburant <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $cartecarburant = $this->Cartecarburants->get($id);
        if ($this->Cartecarburants->delete($cartecarburant)) {
            $cartecarburant_id = ($this->Cartecarburants->save($cartecarburant)->id);
            $this->misejour("Cartecarburants", "delete", $cartecarburant_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

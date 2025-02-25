<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Typecartecarburants Controller
 *
 * @property \App\Model\Table\TypecartecarburantsTable $Typecartecarburants
 * @method \App\Model\Entity\Typecartecarburant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypecartecarburantsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Typecartecarburants->find('all')->order(["Typecartecarburants.id" => 'desc']);
        $this->paginate = [
            'contain' => [],
        ];
        $typecartecarburants = $this->paginate($query);

        $this->set(compact('typecartecarburants'));
    }

    /**
     * View method
     *
     * @param string|null $id Typecartecarburant id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typecartecarburant = $this->Typecartecarburants->get($id, [
            'contain' => ['Cartecarburants'],
        ]);

        $this->set(compact('typecartecarburant'));
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
        $typecartecarburant = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'typecartecarburants') {
                $typecartecarburant = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($typecartecarburant <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $typecartecarburant = $this->Typecartecarburants->newEmptyEntity();
        if ($this->request->is('post')) {
            $typecartecarburant = $this->Typecartecarburants->patchEntity($typecartecarburant, $this->request->getData());
            if ($this->Typecartecarburants->save($typecartecarburant)) {
                $typecartecarburant_id = ($this->Typecartecarburants->save($typecartecarburant)->id);
                $this->misejour("Typecartecarburants", "add", $typecartecarburant_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('typecartecarburant'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Typecartecarburant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $typecartecarburant = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'typecartecarburants') {
                $typecartecarburant = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($typecartecarburant <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $typecartecarburant = $this->Typecartecarburants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typecartecarburant = $this->Typecartecarburants->patchEntity($typecartecarburant, $this->request->getData());
            if ($this->Typecartecarburants->save($typecartecarburant)) {
                $typecartecarburant_id = ($this->Typecartecarburants->save($typecartecarburant)->id);
                $this->misejour("Typecartecarburants", "edit", $typecartecarburant_id);


                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('typecartecarburant'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Typecartecarburant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $typecartecarburant = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'typecartecarburants') {
                $typecartecarburant = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($typecartecarburant <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->request->allowMethod(['post', 'delete']);
        $typecartecarburant = $this->Typecartecarburants->get($id);
        if ($this->Typecartecarburants->delete($typecartecarburant)) {
            $typecartecarburant_id = ($this->Typecartecarburants->save($typecartecarburant)->id);
            $this->misejour("Typecartecarburants", "delete", $typecartecarburant_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

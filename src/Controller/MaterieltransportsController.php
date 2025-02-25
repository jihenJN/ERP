<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Materieltransports Controller
 *
 * @property \App\Model\Table\MaterieltransportsTable $Materieltransports
 * @method \App\Model\Entity\Materieltransport[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MaterieltransportsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $matricule = $this->request->getQuery('matricule');
        $designation = $this->request->getQuery('designation');
        $cond1 = '';
        $cond2 = '';
        if ($matricule) {
            $cond1 = "Materieltransports.matricule like  '%" . $matricule . "%' ";
        }
        if ($designation) {
            $cond2 = "Materieltransports.designation like  '%" . $designation . "%' ";
        }
        $query = $this->Materieltransports->find('all')->where([$cond1, $cond2])->order(["Materieltransports.id" => 'desc']);
        $materieltransports = $this->paginate($query);
        $this->set(compact('materieltransports'));
    }

    /**
     * View method
     *
     * @param string|null $id Materieltransport id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $materieltransport = $this->Materieltransports->get($id, [
            'contain' => []
        ]);
        $this->set(compact('materieltransport'));
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
        $materieltransport = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'materieltransports') {
                $materieltransport = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($materieltransport <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $materieltransport = $this->Materieltransports->newEmptyEntity();
        if ($this->request->is('post')) {
            $materieltransport = $this->Materieltransports->patchEntity($materieltransport, $this->request->getData());
           // debug($materieltransport);die;
            if ($this->Materieltransports->save($materieltransport)) {
                $materieltransport_id = ($this->Materieltransports->save($materieltransport)->id);
                $this->misejour("Materieltransports", "add", $materieltransport_id);


                return $this->redirect(['action' => 'index']);
            }
        }
        $numeroobj = $this->Materieltransports->find()->select(["numerox" =>
        'MAX(Materieltransports.code)'])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
            //debug($code);die;

        } else {
            $code = "00001";
        }
        // debug($code)   ;die;  
        $this->set(compact('numero'));
        $this->set(compact('materieltransport', 'code'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Materieltransport id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $materieltransport = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'materieltransports') {
                $materieltransport = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($materieltransport <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $materieltransport = $this->Materieltransports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $materieltransport = $this->Materieltransports->patchEntity($materieltransport, $this->request->getData());
            if ($this->Materieltransports->save($materieltransport)) {
                $materieltransport_id = ($this->Materieltransports->save($materieltransport)->id);
                $this->misejour("Materieltransports", "edit", $materieltransport_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('materieltransport'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Materieltransport id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $materieltransport = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'materieltransports') {
                $materieltransport = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($materieltransport <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->request->allowMethod(['post', 'delete']);
        $materieltransport = $this->Materieltransports->get($id);
        if ($this->Materieltransports->delete($materieltransport)) {
            $materieltransport_id = ($this->Materieltransports->save($materieltransport)->id);
            $this->misejour("Materieltransports", "delete", "code");
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

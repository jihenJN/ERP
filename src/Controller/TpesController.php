<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tpes Controller
 *
 * @property \App\Model\Table\TpesTable $Tpes
 * @method \App\Model\Entity\Tpe[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TpesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tpes = $this->paginate($this->Tpes);

        $this->set(compact('tpes'));
    }

    /**
     * View method
     *
     * @param string|null $id Tpe id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tpe = $this->Tpes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('tpe'));
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
        $tpe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'tpes') {
                $tpe = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($tpe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $tpe = $this->Tpes->newEmptyEntity();
        if ($this->request->is('post')) {
            $tpe = $this->Tpes->patchEntity($tpe, $this->request->getData());
            if ($this->Tpes->save($tpe)) {
                $tpe_id = ($this->Tpes->save($tpe)->id);
                $this->misejour("Tpes", "add", $tpe_id);

                return $this->redirect(['action' => 'index']);
            }
           
        }
        $this->set(compact('tpe'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Tpe id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $tpe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'tpes') {
                $tpe = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($tpe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $tpe = $this->Tpes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tpe = $this->Tpes->patchEntity($tpe, $this->request->getData());
            if ($this->Tpes->save($tpe)) {
                $tpe_id = ($this->Tpes->save($tpe)->id);
                $this->misejour("Tpes", "edit", $tpe_id);

                return $this->redirect(['action' => 'index']);
            }
            
        }
        $this->set(compact('tpe'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Tpe id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $tpe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'tpes') {
                $tpe = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($tpe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $tpe = $this->Tpes->get($id);
        if ($this->Tpes->delete($tpe)) {
            $tpe_id = ($this->Tpes->save($tpe)->id);
                $this->misejour("Tpes", "delete", $tpe_id);
        } else {
            
        }

        return $this->redirect(['action' => 'index']);
    }
}

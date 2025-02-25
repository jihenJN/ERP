<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tvas Controller
 *
 * @property \App\Model\Table\TvasTable $Tvas
 * @method \App\Model\Entity\Tva[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TvasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tvas = $this->paginate($this->Tvas);
//debug($tvas);die;
        $this->set(compact('tvas'));
    }

    /**
     * View method
     *
     * @param string|null $id Tva id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tva = $this->Tvas->get($id, [
            'contain' => ['Articles'],
        ]);

        $this->set(compact('tva'));
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
        $tva = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'tvas') {
                $tva = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($tva <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $tva = $this->Tvas->newEmptyEntity();
        if ($this->request->is('post')) {
         //   debug($this->request->getData());die;
            $tva = $this->Tvas->patchEntity($tva, $this->request->getData());
            if ($this->Tvas->save($tva)) {
                $tva_id = ($this->Tvas->save($tva)->id);
                $this->misejour("Tvas", "add", $tva_id);

                

                return $this->redirect(['action' => 'index']);
            }
            
        }
        $this->set(compact('tva'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Tva id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $tva = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'tvas') {
                $tva = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($tva <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $tva = $this->Tvas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tva = $this->Tvas->patchEntity($tva, $this->request->getData());
            if ($this->Tvas->save($tva)) {
                $tva_id = ($this->Tvas->save($tva)->id);
                $this->misejour("Tvas", "edit", $tva_id);

                return $this->redirect(['action' => 'index']);
            }
           
        }
        $this->set(compact('tva'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Tva id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $tva = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'tvas') {
                $tva = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($tva <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->request->allowMethod(['post', 'delete']);
        $tva = $this->Tvas->get($id);
        if ($this->Tvas->delete($tva)) {
            $tva_id = ($this->Tvas->save($tva)->id);
            $this->misejour("Tvas", "delete", $tva_id);
        } else {
           
        }

        return $this->redirect(['action' => 'index']);
    }
}

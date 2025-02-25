<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fodecs Controller
 *
 * @property \App\Model\Table\FodecsTable $Fodecs
 * @method \App\Model\Entity\Fodec[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FodecsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $fodecs = $this->paginate($this->Fodecs);

        $this->set(compact('fodecs'));
    }

    /**
     * View method
     *
     * @param string|null $id Fodec id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fodec = $this->Fodecs->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('fodec'));
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
        $fodec = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'fodecs') {
                $fodec = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($fodec <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $fodec = $this->Fodecs->newEmptyEntity();
        if ($this->request->is('post')) {
            $fodec = $this->Fodecs->patchEntity($fodec, $this->request->getData());
            if ($this->Fodecs->save($fodec)) {
                $fodec_id = ($this->Fodecs->save($fodec)->id);
                $this->misejour("Fodecs", "add", $fodec_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('fodec'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Fodec id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $fodec = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'fodecs') {
                $fodec = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($fodec <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $fodec = $this->Fodecs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fodec = $this->Fodecs->patchEntity($fodec, $this->request->getData());
            if ($this->Fodecs->save($fodec)) {
                $fodec_id = ($this->Fodecs->save($fodec)->id);
                $this->misejour("Fodecs", "edit", $fodec_id);
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('fodec'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Fodec id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $fodec = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'fodecs') {
                $fodec = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($fodec <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $fodec = $this->Fodecs->get($id);
        if ($this->Fodecs->delete($fodec)) {
            $fodec_id = ($this->Fodecs->save($fodec)->id);
                $this->misejour("Fodecs", "delete", $fodec_id);
        } else {
            
        }

        return $this->redirect(['action' => 'index']);
    }
}

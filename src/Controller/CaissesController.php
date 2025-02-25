<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Caisses Controller
 *
 * @property \App\Model\Table\CaissesTable $Caisses
 * @method \App\Model\Entity\Caisse[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CaissesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $caisses = $this->paginate($this->Caisses);

        $this->set(compact('caisses'));
    }

    /**
     * View method
     *
     * @param string|null $id Caisse id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $caiss = $this->Caisses->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('caiss'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $caiss = $this->Caisses->newEmptyEntity();
        if ($this->request->is('post')) {
            $caiss = $this->Caisses->patchEntity($caiss, $this->request->getData());
            if ($this->Caisses->save($caiss)) {
                $caisse_id = ($this->Caisses->save($caiss)->id);
                $this->misejour("Caisse", "add", $caisse_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('caiss'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Caisse id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $caiss = $this->Caisses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $caiss = $this->Caisses->patchEntity($caiss, $this->request->getData());
            if ($this->Caisses->save($caiss)) {
                $caisse_id = ($this->Caisses->save($caiss)->id);
                $this->misejour("Caisse", "edit", $caisse_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('caiss'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Caisse id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $caiss = $this->Caisses->get($id);
        if ($this->Caisses->delete($caiss)) {
            $caisse_id = ($this->Caisses->save($caiss)->id);
            $this->misejour("Caisse", "delete", $caisse_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

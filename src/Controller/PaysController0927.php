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
        $query = $this->Pays->find('all')->where([$cond1]);
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
        $pay = $this->Pays->newEmptyEntity();
        if ($this->request->is('post')) {
            $pay = $this->Pays->patchEntity($pay, $this->request->getData());
            if ($this->Pays->save($pay)) {
                $pay_id = ($this->Pays->save($pay)->id);
                $this->misejour("Pays", "add", $pay_id);
                $this->Flash->success(__('The {0} has been saved.', 'Pay'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Pay'));
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
        $pay = $this->Pays->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pay = $this->Pays->patchEntity($pay, $this->request->getData());
            if ($this->Pays->save($pay)) {
                $pay_id = ($this->Pays->save($pay)->id);
                $this->misejour("Pays", "edit", $pay_id);
                $this->Flash->success(__('The {0} has been saved.', 'Pay'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Pay'));
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
        $this->request->allowMethod(['post', 'delete']);
        $pay = $this->Pays->get($id);
        if ($this->Pays->delete($pay)) {
            $pay_id = ($this->Pays->save($pay)->id);
            $this->misejour("Pays", "delete", $pay_id);
            $this->Flash->success(__('The {0} has been deleted.', 'Pay'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Pay'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

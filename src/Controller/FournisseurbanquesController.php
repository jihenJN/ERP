<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fournisseurbanques Controller
 *
 * @property \App\Model\Table\FournisseurbanquesTable $Fournisseurbanques
 * @method \App\Model\Entity\Fournisseurbanque[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FournisseurbanquesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Banques', 'Fournisseurs'],
        ];
        $fournisseurbanques = $this->paginate($this->Fournisseurbanques);

        $this->set(compact('fournisseurbanques'));
    }

    /**
     * View method
     *
     * @param string|null $id Fournisseurbanque id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fournisseurbanque = $this->Fournisseurbanques->get($id, [
            'contain' => ['Banques', 'Fournisseurs'],
        ]);

        $this->set(compact('fournisseurbanque'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fournisseurbanque = $this->Fournisseurbanques->newEmptyEntity();
        if ($this->request->is('post')) {
            $fournisseurbanque = $this->Fournisseurbanques->patchEntity($fournisseurbanque, $this->request->getData());
            if ($this->Fournisseurbanques->save($fournisseurbanque)) {
                $this->Flash->success(__('The {0} has been saved.', 'Fournisseurbanque'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fournisseurbanque'));
        }
        $banques = $this->Fournisseurbanques->Banques->find('list', ['limit' => 200]);
        $fournisseurs = $this->Fournisseurbanques->Fournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('fournisseurbanque', 'banques', 'fournisseurs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Fournisseurbanque id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fournisseurbanque = $this->Fournisseurbanques->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fournisseurbanque = $this->Fournisseurbanques->patchEntity($fournisseurbanque, $this->request->getData());
            if ($this->Fournisseurbanques->save($fournisseurbanque)) {
                $this->Flash->success(__('The {0} has been saved.', 'Fournisseurbanque'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fournisseurbanque'));
        }
        $banques = $this->Fournisseurbanques->Banques->find('list', ['limit' => 200]);
        $fournisseurs = $this->Fournisseurbanques->Fournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('fournisseurbanque', 'banques', 'fournisseurs'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Fournisseurbanque id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fournisseurbanque = $this->Fournisseurbanques->get($id);
        if ($this->Fournisseurbanques->delete($fournisseurbanque)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Fournisseurbanque'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Fournisseurbanque'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

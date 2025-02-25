<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fournisseurresponsables Controller
 *
 * @property \App\Model\Table\FournisseurresponsablesTable $Fournisseurresponsables
 * @method \App\Model\Entity\Fournisseurresponsable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FournisseurresponsablesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Fournisseurs'],
        ];
        $fournisseurresponsables = $this->paginate($this->Fournisseurresponsables);

        $this->set(compact('fournisseurresponsables'));
    }

    /**
     * View method
     *
     * @param string|null $id Fournisseurresponsable id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fournisseurresponsable = $this->Fournisseurresponsables->get($id, [
            'contain' => ['Fournisseurs'],
        ]);

        $this->set(compact('fournisseurresponsable'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fournisseurresponsable = $this->Fournisseurresponsables->newEmptyEntity();
        if ($this->request->is('post')) {
            $fournisseurresponsable = $this->Fournisseurresponsables->patchEntity($fournisseurresponsable, $this->request->getData());
            if ($this->Fournisseurresponsables->save($fournisseurresponsable)) {
                $this->Flash->success(__('The {0} has been saved.', 'Fournisseurresponsable'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fournisseurresponsable'));
        }
        $fournisseurs = $this->Fournisseurresponsables->Fournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('fournisseurresponsable', 'fournisseurs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Fournisseurresponsable id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fournisseurresponsable = $this->Fournisseurresponsables->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fournisseurresponsable = $this->Fournisseurresponsables->patchEntity($fournisseurresponsable, $this->request->getData());
            if ($this->Fournisseurresponsables->save($fournisseurresponsable)) {
                $this->Flash->success(__('The {0} has been saved.', 'Fournisseurresponsable'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fournisseurresponsable'));
        }
        $fournisseurs = $this->Fournisseurresponsables->Fournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('fournisseurresponsable', 'fournisseurs'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Fournisseurresponsable id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fournisseurresponsable = $this->Fournisseurresponsables->get($id);
        if ($this->Fournisseurresponsables->delete($fournisseurresponsable)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Fournisseurresponsable'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Fournisseurresponsable'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Familles Controller
 *
 * @property \App\Model\Table\FamillesTable $Familles
 * @method \App\Model\Entity\Famille[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FamillesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $familles = $this->paginate($this->Familles);

        $this->set(compact('familles'));
    }

    /**
     * View method
     *
     * @param string|null $id Famille id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $famille = $this->Familles->get($id, [
            'contain' => ['Articles', 'Sousfamille1s'],
        ]);

        $this->set(compact('famille'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $famille = $this->Familles->newEmptyEntity();
        if ($this->request->is('post')) {
            $famille = $this->Familles->patchEntity($famille, $this->request->getData());
            if ($this->Familles->save($famille)) {
                $this->Flash->success(__('The {0} has been saved.', 'Famille'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Famille'));
        }
        $this->set(compact('famille'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Famille id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $famille = $this->Familles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $famille = $this->Familles->patchEntity($famille, $this->request->getData());
            if ($this->Familles->save($famille)) {
                $this->Flash->success(__('The {0} has been saved.', 'Famille'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Famille'));
        }
        $this->set(compact('famille'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Famille id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $famille = $this->Familles->get($id);
        if ($this->Familles->delete($famille)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Famille'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Famille'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

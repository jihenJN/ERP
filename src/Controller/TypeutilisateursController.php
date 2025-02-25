<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typeutilisateurs Controller
 *
 * @property \App\Model\Table\TypeutilisateursTable $Typeutilisateurs
 * @method \App\Model\Entity\Typeutilisateur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypeutilisateursController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typeutilisateurs = $this->paginate($this->Typeutilisateurs);

        $this->set(compact('typeutilisateurs'));
    }

    /**
     * View method
     *
     * @param string|null $id Typeutilisateur id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeutilisateur = $this->Typeutilisateurs->get($id, [
            'contain' => ['Clients', 'Fournisseurs'],
        ]);

        $this->set(compact('typeutilisateur'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typeutilisateur = $this->Typeutilisateurs->newEmptyEntity();
        if ($this->request->is('post')) {
            $typeutilisateur = $this->Typeutilisateurs->patchEntity($typeutilisateur, $this->request->getData());
            if ($this->Typeutilisateurs->save($typeutilisateur)) {
                $this->Flash->success(__('The {0} has been saved.', 'Typeutilisateur'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typeutilisateur'));
        }
        $this->set(compact('typeutilisateur'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Typeutilisateur id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typeutilisateur = $this->Typeutilisateurs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typeutilisateur = $this->Typeutilisateurs->patchEntity($typeutilisateur, $this->request->getData());
            if ($this->Typeutilisateurs->save($typeutilisateur)) {
                $this->Flash->success(__('The {0} has been saved.', 'Typeutilisateur'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typeutilisateur'));
        }
        $this->set(compact('typeutilisateur'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Typeutilisateur id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typeutilisateur = $this->Typeutilisateurs->get($id);
        if ($this->Typeutilisateurs->delete($typeutilisateur)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Typeutilisateur'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Typeutilisateur'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

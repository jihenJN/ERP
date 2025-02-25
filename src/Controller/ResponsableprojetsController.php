<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Responsableprojets Controller
 *
 * @property \App\Model\Table\ResponsableprojetsTable $Responsableprojets
 * @method \App\Model\Entity\Responsableprojet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResponsableprojetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Personnels'],
        ];
        $responsableprojets = $this->paginate($this->Responsableprojets);

        $this->set(compact('responsableprojets'));
    }

    /**
     * View method
     *
     * @param string|null $id Responsableprojet id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $responsableprojet = $this->Responsableprojets->get($id, [
            'contain' => ['Personnels'],
        ]);

        $this->set(compact('responsableprojet'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $responsableprojet = $this->Responsableprojets->newEmptyEntity();
        if ($this->request->is('post')) {
            $responsableprojet = $this->Responsableprojets->patchEntity($responsableprojet, $this->request->getData());
            if ($this->Responsableprojets->save($responsableprojet)) {
                $this->Flash->success(__('The responsableprojet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The responsableprojet could not be saved. Please, try again.'));
        }
        $personnels = $this->Responsableprojets->Personnels->find('list', ['limit' => 200])->all();
        $this->set(compact('responsableprojet', 'personnels'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Responsableprojet id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $responsableprojet = $this->Responsableprojets->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $responsableprojet = $this->Responsableprojets->patchEntity($responsableprojet, $this->request->getData());
            if ($this->Responsableprojets->save($responsableprojet)) {
                $this->Flash->success(__('The responsableprojet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The responsableprojet could not be saved. Please, try again.'));
        }
        $personnels = $this->Responsableprojets->Personnels->find('list', ['limit' => 200])->all();
        $this->set(compact('responsableprojet', 'personnels'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Responsableprojet id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $responsableprojet = $this->Responsableprojets->get($id);
        if ($this->Responsableprojets->delete($responsableprojet)) {
            $this->Flash->success(__('The responsableprojet has been deleted.'));
        } else {
            $this->Flash->error(__('The responsableprojet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Importations Controller
 *
 * @property \App\Model\Table\ImportationsTable $Importations
 * @method \App\Model\Entity\Importation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ImportationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Fournisseurs', 'Devises', 'Situations'],
        ];
        $importations = $this->paginate($this->Importations);

        $this->set(compact('importations'));
    }

    /**
     * View method
     *
     * @param string|null $id Importation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $importation = $this->Importations->get($id, [
            'contain' => ['Fournisseurs', 'Devises', 'Situations', 'Piecereglements', 'Reglements'],
        ]);

        $this->set(compact('importation'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $importation = $this->Importations->newEmptyEntity();
        if ($this->request->is('post')) {
            $importation = $this->Importations->patchEntity($importation, $this->request->getData());
            if ($this->Importations->save($importation)) {
                $this->Flash->success(__('The importation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The importation could not be saved. Please, try again.'));
        }
        $fournisseurs = $this->Importations->Fournisseurs->find('list', ['limit' => 200])->all();
        $devises = $this->Importations->Devises->find('list', ['limit' => 200])->all();
        $situations = $this->Importations->Situations->find('list', ['limit' => 200])->all();
        $this->set(compact('importation', 'fournisseurs', 'devises', 'situations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Importation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $importation = $this->Importations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $importation = $this->Importations->patchEntity($importation, $this->request->getData());
            if ($this->Importations->save($importation)) {
                $this->Flash->success(__('The importation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The importation could not be saved. Please, try again.'));
        }
        $fournisseurs = $this->Importations->Fournisseurs->find('list', ['limit' => 200])->all();
        $devises = $this->Importations->Devises->find('list', ['limit' => 200])->all();
        $situations = $this->Importations->Situations->find('list', ['limit' => 200])->all();
        $this->set(compact('importation', 'fournisseurs', 'devises', 'situations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Importation id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $importation = $this->Importations->get($id);
        if ($this->Importations->delete($importation)) {
            $this->Flash->success(__('The importation has been deleted.'));
        } else {
            $this->Flash->error(__('The importation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

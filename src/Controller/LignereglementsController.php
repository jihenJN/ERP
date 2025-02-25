<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignereglements Controller
 *
 * @property \App\Model\Table\LignereglementsTable $Lignereglements
 * @method \App\Model\Entity\Lignereglement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignereglementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Reglements', 'Factures', 'Piecereglements'],
        ];
        $lignereglements = $this->paginate($this->Lignereglements);

        $this->set(compact('lignereglements'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignereglement id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignereglement = $this->Lignereglements->get($id, [
            'contain' => ['Reglements', 'Factures', 'Piecereglements'],
        ]);

        $this->set(compact('lignereglement'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignereglement = $this->Lignereglements->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignereglement = $this->Lignereglements->patchEntity($lignereglement, $this->request->getData());
            if ($this->Lignereglements->save($lignereglement)) {
                $this->Flash->success(__('The lignereglement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignereglement could not be saved. Please, try again.'));
        }
        $reglements = $this->Lignereglements->Reglements->find('list', ['limit' => 200])->all();
        $factures = $this->Lignereglements->Factures->find('list', ['limit' => 200])->all();
        $piecereglements = $this->Lignereglements->Piecereglements->find('list', ['limit' => 200])->all();
        $this->set(compact('lignereglement', 'reglements', 'factures', 'piecereglements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lignereglement id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignereglement = $this->Lignereglements->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignereglement = $this->Lignereglements->patchEntity($lignereglement, $this->request->getData());
            if ($this->Lignereglements->save($lignereglement)) {
                $this->Flash->success(__('The lignereglement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignereglement could not be saved. Please, try again.'));
        }
        $reglements = $this->Lignereglements->Reglements->find('list', ['limit' => 200])->all();
        $factures = $this->Lignereglements->Factures->find('list', ['limit' => 200])->all();
        $piecereglements = $this->Lignereglements->Piecereglements->find('list', ['limit' => 200])->all();
        $this->set(compact('lignereglement', 'reglements', 'factures', 'piecereglements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lignereglement id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignereglement = $this->Lignereglements->get($id);
        if ($this->Lignereglements->delete($lignereglement)) {
            $this->Flash->success(__('The lignereglement has been deleted.'));
        } else {
            $this->Flash->error(__('The lignereglement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

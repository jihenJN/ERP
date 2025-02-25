<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ligneplancommercials Controller
 *
 * @property \App\Model\Table\LigneplancommercialsTable $Ligneplancommercials
 * @method \App\Model\Entity\Ligneplancommercial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LigneplancommercialsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Plancommercialindustriels', 'Articles'],
        ];
        $ligneplancommercials = $this->paginate($this->Ligneplancommercials);

        $this->set(compact('ligneplancommercials'));
    }

    /**
     * View method
     *
     * @param string|null $id Ligneplancommercial id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ligneplancommercial = $this->Ligneplancommercials->get($id, [
            'contain' => ['Plancommercialindustriels', 'Articles'],
        ]);

        $this->set(compact('ligneplancommercial'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ligneplancommercial = $this->Ligneplancommercials->newEmptyEntity();
        if ($this->request->is('post')) {
            $ligneplancommercial = $this->Ligneplancommercials->patchEntity($ligneplancommercial, $this->request->getData());
            if ($this->Ligneplancommercials->save($ligneplancommercial)) {
                $this->Flash->success(__('The ligneplancommercial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ligneplancommercial could not be saved. Please, try again.'));
        }
        $plancommercialindustriels = $this->Ligneplancommercials->Plancommercialindustriels->find('list', ['limit' => 200])->all();
        $articles = $this->Ligneplancommercials->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('ligneplancommercial', 'plancommercialindustriels', 'articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ligneplancommercial id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ligneplancommercial = $this->Ligneplancommercials->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ligneplancommercial = $this->Ligneplancommercials->patchEntity($ligneplancommercial, $this->request->getData());
            if ($this->Ligneplancommercials->save($ligneplancommercial)) {
                $this->Flash->success(__('The ligneplancommercial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ligneplancommercial could not be saved. Please, try again.'));
        }
        $plancommercialindustriels = $this->Ligneplancommercials->Plancommercialindustriels->find('list', ['limit' => 200])->all();
        $articles = $this->Ligneplancommercials->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('ligneplancommercial', 'plancommercialindustriels', 'articles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ligneplancommercial id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ligneplancommercial = $this->Ligneplancommercials->get($id);
        if ($this->Ligneplancommercials->delete($ligneplancommercial)) {
            $this->Flash->success(__('The ligneplancommercial has been deleted.'));
        } else {
            $this->Flash->error(__('The ligneplancommercial could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

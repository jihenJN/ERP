<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Gouvernoratcommercials Controller
 *
 * @property \App\Model\Table\GouvernoratcommercialsTable $Gouvernoratcommercials
 * @method \App\Model\Entity\Gouvernoratcommercial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GouvernoratcommercialsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Commercials', 'Gouvernorats'],
        ];
        $gouvernoratcommercials = $this->paginate($this->Gouvernoratcommercials);

        $this->set(compact('gouvernoratcommercials'));
    }

    /**
     * View method
     *
     * @param string|null $id Gouvernoratcommercial id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gouvernoratcommercial = $this->Gouvernoratcommercials->get($id, [
            'contain' => ['Commercials', 'Gouvernorats'],
        ]);

        $this->set(compact('gouvernoratcommercial'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $gouvernoratcommercial = $this->Gouvernoratcommercials->newEmptyEntity();
        if ($this->request->is('post')) {
            $gouvernoratcommercial = $this->Gouvernoratcommercials->patchEntity($gouvernoratcommercial, $this->request->getData());
            if ($this->Gouvernoratcommercials->save($gouvernoratcommercial)) {
                $this->Flash->success(__('The gouvernoratcommercial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gouvernoratcommercial could not be saved. Please, try again.'));
        }
        $commercials = $this->Gouvernoratcommercials->Commercials->find('list', ['limit' => 200])->all();
        $gouvernorats = $this->Gouvernoratcommercials->Gouvernorats->find('list', ['limit' => 200])->all();
        $this->set(compact('gouvernoratcommercial', 'commercials', 'gouvernorats'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Gouvernoratcommercial id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gouvernoratcommercial = $this->Gouvernoratcommercials->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gouvernoratcommercial = $this->Gouvernoratcommercials->patchEntity($gouvernoratcommercial, $this->request->getData());
            if ($this->Gouvernoratcommercials->save($gouvernoratcommercial)) {
                $this->Flash->success(__('The gouvernoratcommercial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gouvernoratcommercial could not be saved. Please, try again.'));
        }
        $commercials = $this->Gouvernoratcommercials->Commercials->find('list', ['limit' => 200])->all();
        $gouvernorats = $this->Gouvernoratcommercials->Gouvernorats->find('list', ['limit' => 200])->all();
        $this->set(compact('gouvernoratcommercial', 'commercials', 'gouvernorats'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Gouvernoratcommercial id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gouvernoratcommercial = $this->Gouvernoratcommercials->get($id);
        if ($this->Gouvernoratcommercials->delete($gouvernoratcommercial)) {
            $this->Flash->success(__('The gouvernoratcommercial has been deleted.'));
        } else {
            $this->Flash->error(__('The gouvernoratcommercial could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

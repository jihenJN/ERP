<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fourches Controller
 *
 * @property \App\Model\Table\FourchesTable $Fourches
 * @method \App\Model\Entity\Fourch[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FourchesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $fourches = $this->paginate($this->Fourches);

        $this->set(compact('fourches'));
    }

    /**
     * View method
     *
     * @param string|null $id Fourch id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fourch = $this->Fourches->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('fourch'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fourch = $this->Fourches->newEmptyEntity();
        if ($this->request->is('post')) {
            $fourch = $this->Fourches->patchEntity($fourch, $this->request->getData());
            if ($this->Fourches->save($fourch)) {
                $this->Flash->success(__('The {0} has been saved.', 'Fourch'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fourch'));
        }
        $this->set(compact('fourch'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Fourch id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fourch = $this->Fourches->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fourch = $this->Fourches->patchEntity($fourch, $this->request->getData());
            if ($this->Fourches->save($fourch)) {
                $this->Flash->success(__('The {0} has been saved.', 'Fourch'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fourch'));
        }
        $this->set(compact('fourch'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Fourch id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fourch = $this->Fourches->get($id);
        if ($this->Fourches->delete($fourch)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Fourch'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Fourch'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

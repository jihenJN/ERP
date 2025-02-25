<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typereceptions Controller
 *
 * @property \App\Model\Table\TypereceptionsTable $Typereceptions
 * @method \App\Model\Entity\Typereception[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypereceptionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typereceptions = $this->paginate($this->Typereceptions);

        $this->set(compact('typereceptions'));
    }

    /**
     * View method
     *
     * @param string|null $id Typereception id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typereception = $this->Typereceptions->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('typereception'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typereception = $this->Typereceptions->newEmptyEntity();
        if ($this->request->is('post')) {
            $typereception = $this->Typereceptions->patchEntity($typereception, $this->request->getData());
            if ($this->Typereceptions->save($typereception)) {
               /// $this->Flash->success(__('The {0} has been saved.', 'Typereception'));

                return $this->redirect(['action' => 'index']);
            }
         //   $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typereception'));
        }
        $this->set(compact('typereception'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Typereception id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typereception = $this->Typereceptions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typereception = $this->Typereceptions->patchEntity($typereception, $this->request->getData());
            if ($this->Typereceptions->save($typereception)) {
              //  $this->Flash->success(__('The {0} has been saved.', 'Typereception'));

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typereception'));
        }
        $this->set(compact('typereception'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Typereception id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typereception = $this->Typereceptions->get($id);
        if ($this->Typereceptions->delete($typereception)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Typereception'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Typereception'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

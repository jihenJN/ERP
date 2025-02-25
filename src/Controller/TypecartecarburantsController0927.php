<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typecartecarburants Controller
 *
 * @property \App\Model\Table\TypecartecarburantsTable $Typecartecarburants
 * @method \App\Model\Entity\Typecartecarburant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypecartecarburantsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typecartecarburants = $this->paginate($this->Typecartecarburants);

        $this->set(compact('typecartecarburants'));
    }

    /**
     * View method
     *
     * @param string|null $id Typecartecarburant id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typecartecarburant = $this->Typecartecarburants->get($id, [
            'contain' => ['Cartecarburants'],
        ]);

        $this->set(compact('typecartecarburant'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typecartecarburant = $this->Typecartecarburants->newEmptyEntity();
        if ($this->request->is('post')) {
            $typecartecarburant = $this->Typecartecarburants->patchEntity($typecartecarburant, $this->request->getData());
            if ($this->Typecartecarburants->save($typecartecarburant)) {
                $typecartecarburant_id = ($this->Typecartecarburants->save($typecartecarburant)->id);
                $this->misejour("Typecartecarburants", "add", $typecartecarburant_id);
                $this->Flash->success(__('The {0} has been saved.', 'Typecartecarburant'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typecartecarburant'));
        }
        $this->set(compact('typecartecarburant'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Typecartecarburant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typecartecarburant = $this->Typecartecarburants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typecartecarburant = $this->Typecartecarburants->patchEntity($typecartecarburant, $this->request->getData());
            if ($this->Typecartecarburants->save($typecartecarburant)) {
                $typecartecarburant_id = ($this->Typecartecarburants->save($typecartecarburant)->id);
                $this->misejour("Typecartecarburants", "edit", $typecartecarburant_id);
                $this->Flash->success(__('The {0} has been saved.', 'Typecartecarburant'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typecartecarburant'));
        }
        $this->set(compact('typecartecarburant'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Typecartecarburant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typecartecarburant = $this->Typecartecarburants->get($id);
        if ($this->Typecartecarburants->delete($typecartecarburant)) {
            $typecartecarburant_id = ($this->Typecartecarburants->save($typecartecarburant)->id);
            $this->misejour("Typecartecarburants", "delete", $typecartecarburant_id);
            $this->Flash->success(__('The {0} has been deleted.', 'Typecartecarburant'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Typecartecarburant'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

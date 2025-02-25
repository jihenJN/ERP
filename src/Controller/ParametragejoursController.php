<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Parametragejours Controller
 *
 * @property \App\Model\Table\ParametragejoursTable $Parametragejours
 * @method \App\Model\Entity\Parametragejour[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ParametragejoursController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $parametragejours = $this->paginate($this->Parametragejours);

        $this->set(compact('parametragejours'));
    }

    /**
     * View method
     *
     * @param string|null $id Parametragejour id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parametragejour = $this->Parametragejours->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('parametragejour'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $parametragejour = $this->Parametragejours->newEmptyEntity();
        if ($this->request->is('post')) {
            $parametragejour = $this->Parametragejours->patchEntity($parametragejour, $this->request->getData());
            if ($this->Parametragejours->save($parametragejour)) {

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('parametragejour'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Parametragejour id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $parametragejour = $this->Parametragejours->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parametragejour = $this->Parametragejours->patchEntity($parametragejour, $this->request->getData());
            if ($this->Parametragejours->save($parametragejour)) {

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('parametragejour'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Parametragejour id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parametragejour = $this->Parametragejours->get($id);
        if ($this->Parametragejours->delete($parametragejour)) {
        }

        return $this->redirect(['action' => 'index']);
    }
}

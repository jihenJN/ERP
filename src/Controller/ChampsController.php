<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Champs Controller
 *
 * @property \App\Model\Table\ChampsTable $Champs
 * @method \App\Model\Entity\Champ[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChampsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $champs = $this->paginate($this->Champs);

        $this->set(compact('champs'));
    }

    /**
     * View method
     *
     * @param string|null $id Champ id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $champ = $this->Champs->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('champ'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $champ = $this->Champs->newEmptyEntity();
        if ($this->request->is('post')) {
            $champ = $this->Champs->patchEntity($champ, $this->request->getData());
            if ($this->Champs->save($champ)) {
                $this->Flash->success(__('The {0} has been saved.', 'Champ'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Champ'));
        }
        $this->set(compact('champ'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Champ id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $champ = $this->Champs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $champ = $this->Champs->patchEntity($champ, $this->request->getData());
            if ($this->Champs->save($champ)) {
                $this->Flash->success(__('The {0} has been saved.', 'Champ'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Champ'));
        }
        $this->set(compact('champ'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Champ id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $champ = $this->Champs->get($id);
        if ($this->Champs->delete($champ)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Champ'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Champ'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

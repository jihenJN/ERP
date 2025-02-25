<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Activites Controller
 *
 * @property \App\Model\Table\ActivitesTable $Activites
 * @method \App\Model\Entity\Activite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivitesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $activites = $this->paginate($this->Activites);

        $this->set(compact('activites'));
    }

    /**
     * View method
     *
     * @param string|null $id Activite id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activite = $this->Activites->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('activite'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $activite = $this->Activites->newEmptyEntity();
        if ($this->request->is('post')) {
            $activite = $this->Activites->patchEntity($activite, $this->request->getData());
            if ($this->Activites->save($activite)) {
                $activite_id = ($this->Activites->save($activite)->id);
                $this->misejour("Activites", "add", $activite_id);
                $this->Flash->success(__('The {0} has been saved.', 'Activite'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Activite'));
        }
        $this->set(compact('activite'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Activite id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activite = $this->Activites->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activite = $this->Activites->patchEntity($activite, $this->request->getData());
            if ($this->Activites->save($activite)) {
                $activite_id = ($this->Activites->save($activite)->id);
                $this->misejour("Activites", "edit", $activite_id);
                $this->Flash->success(__('The {0} has been saved.', 'Activite'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Activite'));
        }
        $this->set(compact('activite'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Activite id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activite = $this->Activites->get($id);
        if ($this->Activites->delete($activite)) {
            $activite_id = ($this->Activites->save($activite)->id);
                $this->misejour("Activites", "delete", $activite_id);
            $this->Flash->success(__('The {0} has been deleted.', 'Activite'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Activite'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

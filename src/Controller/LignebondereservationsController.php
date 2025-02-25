<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignebondereservations Controller
 *
 * @property \App\Model\Table\LignebondereservationsTable $Lignebondereservations
 * @method \App\Model\Entity\Lignebondereservation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignebondereservationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Articles', 'Bondereservations'],
        ];
        $lignebondereservations = $this->paginate($this->Lignebondereservations);

        $this->set(compact('lignebondereservations'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignebondereservation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignebondereservation = $this->Lignebondereservations->get($id, [
            'contain' => ['Articles', 'Bondereservations'],
        ]);

        $this->set(compact('lignebondereservation'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignebondereservation = $this->Lignebondereservations->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignebondereservation = $this->Lignebondereservations->patchEntity($lignebondereservation, $this->request->getData());
            if ($this->Lignebondereservations->save($lignebondereservation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignebondereservation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignebondereservation'));
        }
        $articles = $this->Lignebondereservations->Articles->find('list', ['limit' => 200]);
        $bondereservations = $this->Lignebondereservations->Bondereservations->find('list', ['limit' => 200]);
        $this->set(compact('lignebondereservation', 'articles', 'bondereservations'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Lignebondereservation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignebondereservation = $this->Lignebondereservations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignebondereservation = $this->Lignebondereservations->patchEntity($lignebondereservation, $this->request->getData());
            if ($this->Lignebondereservations->save($lignebondereservation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignebondereservation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignebondereservation'));
        }
        $articles = $this->Lignebondereservations->Articles->find('list', ['limit' => 200]);
        $bondereservations = $this->Lignebondereservations->Bondereservations->find('list', ['limit' => 200]);
        $this->set(compact('lignebondereservation', 'articles', 'bondereservations'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Lignebondereservation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignebondereservation = $this->Lignebondereservations->get($id);
        if ($this->Lignebondereservations->delete($lignebondereservation)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Lignebondereservation'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Lignebondereservation'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

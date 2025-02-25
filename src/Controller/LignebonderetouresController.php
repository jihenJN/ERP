<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignebonderetoures Controller
 *
 * @property \App\Model\Table\LignebonderetouresTable $Lignebonderetoures
 * @method \App\Model\Entity\Lignebonderetoure[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignebonderetouresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bonderetoures'],
        ];
        $lignebonderetoures = $this->paginate($this->Lignebonderetoures);

        $this->set(compact('lignebonderetoures'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignebonderetoure id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignebonderetoure = $this->Lignebonderetoures->get($id, [
            'contain' => ['Bonderetoures'],
        ]);

        $this->set(compact('lignebonderetoure'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignebonderetoure = $this->Lignebonderetoures->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignebonderetoure = $this->Lignebonderetoures->patchEntity($lignebonderetoure, $this->request->getData());
            if ($this->Lignebonderetoures->save($lignebonderetoure)) {
                $this->Flash->success(__('The lignebonderetoure has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignebonderetoure could not be saved. Please, try again.'));
        }
        $bonderetoures = $this->Lignebonderetoures->Bonderetoures->find('list', ['limit' => 200])->all();
        $this->set(compact('lignebonderetoure', 'bonderetoures'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lignebonderetoure id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignebonderetoure = $this->Lignebonderetoures->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignebonderetoure = $this->Lignebonderetoures->patchEntity($lignebonderetoure, $this->request->getData());
            if ($this->Lignebonderetoures->save($lignebonderetoure)) {
                $this->Flash->success(__('The lignebonderetoure has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignebonderetoure could not be saved. Please, try again.'));
        }
        $bonderetoures = $this->Lignebonderetoures->Bonderetoures->find('list', ['limit' => 200])->all();
        $this->set(compact('lignebonderetoure', 'bonderetoures'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lignebonderetoure id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignebonderetoure = $this->Lignebonderetoures->get($id);
        if ($this->Lignebonderetoures->delete($lignebonderetoure)) {
            $this->Flash->success(__('The lignebonderetoure has been deleted.'));
        } else {
            $this->Flash->error(__('The lignebonderetoure could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

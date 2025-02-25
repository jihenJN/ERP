<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Journals Controller
 *
 * @property \App\Model\Table\JournalsTable $Journals
 * @method \App\Model\Entity\Journal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JournalsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $journals = $this->paginate($this->Journals);

        $this->set(compact('journals'));
    }

    /**
     * View method
     *
     * @param string|null $id Journal id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $journal = $this->Journals->get($id, [
            'contain' => ['Parmetreintegrations'],
        ]);

        $this->set(compact('journal'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $journal = $this->Journals->newEmptyEntity();
        if ($this->request->is('post')) {
            $journal = $this->Journals->patchEntity($journal, $this->request->getData());
            if ($this->Journals->save($journal)) {
                $this->Flash->success(__('The {0} has been saved.', 'Journal'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Journal'));
        }
        $this->set(compact('journal'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Journal id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $journal = $this->Journals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $journal = $this->Journals->patchEntity($journal, $this->request->getData());
            if ($this->Journals->save($journal)) {
                $this->Flash->success(__('The {0} has been saved.', 'Journal'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Journal'));
        }
        $this->set(compact('journal'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Journal id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $journal = $this->Journals->get($id);
        if ($this->Journals->delete($journal)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Journal'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Journal'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignebondetransferts Controller
 *
 * @property \App\Model\Table\LignebondetransfertsTable $Lignebondetransferts
 * @method \App\Model\Entity\Lignebondetransfert[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignebondetransfertsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bondetransferts', 'Articles', 'Bondechargements'],
        ];
        $lignebondetransferts = $this->paginate($this->Lignebondetransferts);

        $this->set(compact('lignebondetransferts'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignebondetransfert id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignebondetransfert = $this->Lignebondetransferts->get($id, [
            'contain' => ['Bondetransferts', 'Articles', 'Bondechargements'],
        ]);

        $this->set(compact('lignebondetransfert'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignebondetransfert = $this->Lignebondetransferts->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignebondetransfert = $this->Lignebondetransferts->patchEntity($lignebondetransfert, $this->request->getData());
            if ($this->Lignebondetransferts->save($lignebondetransfert)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignebondetransfert'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignebondetransfert'));
        }
        $bondetransferts = $this->Lignebondetransferts->Bondetransferts->find('list', ['limit' => 200]);
        $articles = $this->Lignebondetransferts->Articles->find('list', ['limit' => 200]);
        $bondechargements = $this->Lignebondetransferts->Bondechargements->find('list', ['limit' => 200]);
        $this->set(compact('lignebondetransfert', 'bondetransferts', 'articles', 'bondechargements'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Lignebondetransfert id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignebondetransfert = $this->Lignebondetransferts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignebondetransfert = $this->Lignebondetransferts->patchEntity($lignebondetransfert, $this->request->getData());
            if ($this->Lignebondetransferts->save($lignebondetransfert)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignebondetransfert'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignebondetransfert'));
        }
        $bondetransferts = $this->Lignebondetransferts->Bondetransferts->find('list', ['limit' => 200]);
        $articles = $this->Lignebondetransferts->Articles->find('list', ['limit' => 200]);
        $bondechargements = $this->Lignebondetransferts->Bondechargements->find('list', ['limit' => 200]);
        $this->set(compact('lignebondetransfert', 'bondetransferts', 'articles', 'bondechargements'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Lignebondetransfert id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignebondetransfert = $this->Lignebondetransferts->get($id);
        if ($this->Lignebondetransferts->delete($lignebondetransfert)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Lignebondetransfert'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Lignebondetransfert'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

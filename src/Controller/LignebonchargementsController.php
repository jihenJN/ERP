<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignebonchargements Controller
 *
 * @property \App\Model\Table\LignebonchargementsTable $Lignebonchargements
 * @method \App\Model\Entity\Lignebonchargement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignebonchargementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bondechargements', 'Articles'],
        ];
        $lignebonchargements = $this->paginate($this->Lignebonchargements);

        $this->set(compact('lignebonchargements'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignebonchargement id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignebonchargement = $this->Lignebonchargements->get($id, [
            'contain' => ['Bondechargements', 'Articles'],
        ]);

        $this->set(compact('lignebonchargement'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignebonchargement = $this->Lignebonchargements->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignebonchargement = $this->Lignebonchargements->patchEntity($lignebonchargement, $this->request->getData());
            if ($this->Lignebonchargements->save($lignebonchargement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignebonchargement'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignebonchargement'));
        }
        $bondechargements = $this->Lignebonchargements->Bondechargements->find('list', ['limit' => 200]);
        $articles = $this->Lignebonchargements->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignebonchargement', 'bondechargements', 'articles'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Lignebonchargement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignebonchargement = $this->Lignebonchargements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignebonchargement = $this->Lignebonchargements->patchEntity($lignebonchargement, $this->request->getData());
            if ($this->Lignebonchargements->save($lignebonchargement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignebonchargement'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignebonchargement'));
        }
        $bondechargements = $this->Lignebonchargements->Bondechargements->find('list', ['limit' => 200]);
        $articles = $this->Lignebonchargements->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignebonchargement', 'bondechargements', 'articles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Lignebonchargement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignebonchargement = $this->Lignebonchargements->get($id);
        if ($this->Lignebonchargements->delete($lignebonchargement)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Lignebonchargement'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Lignebonchargement'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

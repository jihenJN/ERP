<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ligneinventaires Controller
 *
 * @property \App\Model\Table\LigneinventairesTable $Ligneinventaires
 * @method \App\Model\Entity\Ligneinventaire[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LigneinventairesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Inventaires', 'Articles'],
        ];
        $ligneinventaires = $this->paginate($this->Ligneinventaires);

        $this->set(compact('ligneinventaires'));
    }

    /**
     * View method
     *
     * @param string|null $id Ligneinventaire id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ligneinventaire = $this->Ligneinventaires->get($id, [
            'contain' => ['Inventaires', 'Articles'],
        ]);

        $this->set(compact('ligneinventaire'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ligneinventaire = $this->Ligneinventaires->newEmptyEntity();
        if ($this->request->is('post')) {
            $ligneinventaire = $this->Ligneinventaires->patchEntity($ligneinventaire, $this->request->getData());
            if ($this->Ligneinventaires->save($ligneinventaire)) {
                $this->Flash->success(__('The {0} has been saved.', 'Ligneinventaire'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ligneinventaire'));
        }
        $inventaires = $this->Ligneinventaires->Inventaires->find('list', ['limit' => 200]);
        $articles = $this->Ligneinventaires->Articles->find('list', ['limit' => 200]);
        $this->set(compact('ligneinventaire', 'inventaires', 'articles'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Ligneinventaire id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ligneinventaire = $this->Ligneinventaires->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ligneinventaire = $this->Ligneinventaires->patchEntity($ligneinventaire, $this->request->getData());
            if ($this->Ligneinventaires->save($ligneinventaire)) {
                $this->Flash->success(__('The {0} has been saved.', 'Ligneinventaire'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ligneinventaire'));
        }
        $inventaires = $this->Ligneinventaires->Inventaires->find('list', ['limit' => 200]);
        $articles = $this->Ligneinventaires->Articles->find('list', ['limit' => 200]);
        $this->set(compact('ligneinventaire', 'inventaires', 'articles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Ligneinventaire id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ligneinventaire = $this->Ligneinventaires->get($id);
        if ($this->Ligneinventaires->delete($ligneinventaire)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Ligneinventaire'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Ligneinventaire'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

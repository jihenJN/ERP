<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignebonlivraisons Controller
 *
 * @property \App\Model\Table\LignebonlivraisonsTable $Lignebonlivraisons
 * @method \App\Model\Entity\Lignebonlivraison[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignebonlivraisonsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bonlivraisons', 'Articles'],
        ];
        $lignebonlivraisons = $this->paginate($this->Lignebonlivraisons);

        $this->set(compact('lignebonlivraisons'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignebonlivraison id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignebonlivraison = $this->Lignebonlivraisons->get($id, [
            'contain' => ['Bonlivraisons', 'Articles'],
        ]);

        $this->set(compact('lignebonlivraison'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignebonlivraison = $this->Lignebonlivraisons->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignebonlivraison = $this->Lignebonlivraisons->patchEntity($lignebonlivraison, $this->request->getData());
            if ($this->Lignebonlivraisons->save($lignebonlivraison)) {
                $this->Flash->success(__('The lignebonlivraison has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignebonlivraison could not be saved. Please, try again.'));
        }
        $bonlivraisons = $this->Lignebonlivraisons->Bonlivraisons->find('list', ['limit' => 200])->all();
        $articles = $this->Lignebonlivraisons->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('lignebonlivraison', 'bonlivraisons', 'articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lignebonlivraison id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignebonlivraison = $this->Lignebonlivraisons->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignebonlivraison = $this->Lignebonlivraisons->patchEntity($lignebonlivraison, $this->request->getData());
            if ($this->Lignebonlivraisons->save($lignebonlivraison)) {
                $this->Flash->success(__('The lignebonlivraison has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignebonlivraison could not be saved. Please, try again.'));
        }
        $bonlivraisons = $this->Lignebonlivraisons->Bonlivraisons->find('list', ['limit' => 200])->all();
        $articles = $this->Lignebonlivraisons->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('lignebonlivraison', 'bonlivraisons', 'articles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lignebonlivraison id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignebonlivraison = $this->Lignebonlivraisons->get($id);
        if ($this->Lignebonlivraisons->delete($lignebonlivraison)) {
            $this->Flash->success(__('The lignebonlivraison has been deleted.'));
        } else {
            $this->Flash->error(__('The lignebonlivraison could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

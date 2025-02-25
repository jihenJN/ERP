<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignebonreceptionstocks Controller
 *
 * @property \App\Model\Table\LignebonreceptionstocksTable $Lignebonreceptionstocks
 * @method \App\Model\Entity\Lignebonreceptionstock[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignebonreceptionstocksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bonreceptionstocks', 'Articles'],
        ];
        $lignebonreceptionstocks = $this->paginate($this->Lignebonreceptionstocks);

        $this->set(compact('lignebonreceptionstocks'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignebonreceptionstock id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignebonreceptionstock = $this->Lignebonreceptionstocks->get($id, [
            'contain' => ['Bonreceptionstocks', 'Articles'],
        ]);

        $this->set(compact('lignebonreceptionstock'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignebonreceptionstock = $this->Lignebonreceptionstocks->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignebonreceptionstock = $this->Lignebonreceptionstocks->patchEntity($lignebonreceptionstock, $this->request->getData());
            if ($this->Lignebonreceptionstocks->save($lignebonreceptionstock)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignebonreceptionstock'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignebonreceptionstock'));
        }
        $bonreceptionstocks = $this->Lignebonreceptionstocks->Bonreceptionstocks->find('list', ['limit' => 200]);
        $articles = $this->Lignebonreceptionstocks->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignebonreceptionstock', 'bonreceptionstocks', 'articles'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Lignebonreceptionstock id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignebonreceptionstock = $this->Lignebonreceptionstocks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignebonreceptionstock = $this->Lignebonreceptionstocks->patchEntity($lignebonreceptionstock, $this->request->getData());
            if ($this->Lignebonreceptionstocks->save($lignebonreceptionstock)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignebonreceptionstock'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignebonreceptionstock'));
        }
        $bonreceptionstocks = $this->Lignebonreceptionstocks->Bonreceptionstocks->find('list', ['limit' => 200]);
        $articles = $this->Lignebonreceptionstocks->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignebonreceptionstock', 'bonreceptionstocks', 'articles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Lignebonreceptionstock id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignebonreceptionstock = $this->Lignebonreceptionstocks->get($id);
        if ($this->Lignebonreceptionstocks->delete($lignebonreceptionstock)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Lignebonreceptionstock'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Lignebonreceptionstock'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

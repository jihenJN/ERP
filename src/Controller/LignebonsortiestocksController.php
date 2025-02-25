<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignebonsortiestocks Controller
 *
 * @property \App\Model\Table\LignebonsortiestocksTable $Lignebonsortiestocks
 * @method \App\Model\Entity\Lignebonsortiestock[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignebonsortiestocksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bonsortiestocks', 'Articles'],
        ];
        $lignebonsortiestocks = $this->paginate($this->Lignebonsortiestocks);

        $this->set(compact('lignebonsortiestocks'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignebonsortiestock id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignebonsortiestock = $this->Lignebonsortiestocks->get($id, [
            'contain' => ['Bonsortiestocks', 'Articles'],
        ]);

        $this->set(compact('lignebonsortiestock'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignebonsortiestock = $this->Lignebonsortiestocks->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignebonsortiestock = $this->Lignebonsortiestocks->patchEntity($lignebonsortiestock, $this->request->getData());
            if ($this->Lignebonsortiestocks->save($lignebonsortiestock)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignebonsortiestock'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignebonsortiestock'));
        }
        $bonsortiestocks = $this->Lignebonsortiestocks->Bonsortiestocks->find('list', ['limit' => 200]);
        $articles = $this->Lignebonsortiestocks->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignebonsortiestock', 'bonsortiestocks', 'articles'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Lignebonsortiestock id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignebonsortiestock = $this->Lignebonsortiestocks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignebonsortiestock = $this->Lignebonsortiestocks->patchEntity($lignebonsortiestock, $this->request->getData());
            if ($this->Lignebonsortiestocks->save($lignebonsortiestock)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignebonsortiestock'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignebonsortiestock'));
        }
        $bonsortiestocks = $this->Lignebonsortiestocks->Bonsortiestocks->find('list', ['limit' => 200]);
        $articles = $this->Lignebonsortiestocks->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignebonsortiestock', 'bonsortiestocks', 'articles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Lignebonsortiestock id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignebonsortiestock = $this->Lignebonsortiestocks->get($id);
        if ($this->Lignebonsortiestocks->delete($lignebonsortiestock)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Lignebonsortiestock'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Lignebonsortiestock'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

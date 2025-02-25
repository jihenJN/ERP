<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignecommandeclients Controller
 *
 * @property \App\Model\Table\LignecommandeclientsTable $Lignecommandeclients
 * @method \App\Model\Entity\Lignecommandeclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignecommandeclientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Commandeclients', 'Articles'],
        ];
        $lignecommandeclients = $this->paginate($this->Lignecommandeclients);

        $this->set(compact('lignecommandeclients'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignecommandeclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignecommandeclient = $this->Lignecommandeclients->get($id, [
            'contain' => ['Commandeclients', 'Articles'],
        ]);

        $this->set(compact('lignecommandeclient'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignecommandeclient = $this->Lignecommandeclients->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignecommandeclient = $this->Lignecommandeclients->patchEntity($lignecommandeclient, $this->request->getData());
            if ($this->Lignecommandeclients->save($lignecommandeclient)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignecommandeclient'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignecommandeclient'));
        }
        $commandeclients = $this->Lignecommandeclients->Commandeclients->find('list', ['limit' => 200]);
        $articles = $this->Lignecommandeclients->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignecommandeclient', 'commandeclients', 'articles'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Lignecommandeclient id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignecommandeclient = $this->Lignecommandeclients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignecommandeclient = $this->Lignecommandeclients->patchEntity($lignecommandeclient, $this->request->getData());
            if ($this->Lignecommandeclients->save($lignecommandeclient)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignecommandeclient'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignecommandeclient'));
        }
        $commandeclients = $this->Lignecommandeclients->Commandeclients->find('list', ['limit' => 200]);
        $articles = $this->Lignecommandeclients->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignecommandeclient', 'commandeclients', 'articles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Lignecommandeclient id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignecommandeclient = $this->Lignecommandeclients->get($id);
        if ($this->Lignecommandeclients->delete($lignecommandeclient)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Lignecommandeclient'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Lignecommandeclient'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

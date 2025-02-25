<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignedemandeclients Controller
 *
 * @property \App\Model\Table\LignedemandeclientsTable $Lignedemandeclients
 * @method \App\Model\Entity\Lignedemandeclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignedemandeclientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Demandeclients', 'Familles', 'Sousfamille1s', 'Articles', 'Unites'],
        ];
        $lignedemandeclients = $this->paginate($this->Lignedemandeclients);

        $this->set(compact('lignedemandeclients'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignedemandeclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignedemandeclient = $this->Lignedemandeclients->get($id, [
            'contain' => ['Demandeclients', 'Familles', 'Sousfamille1s', 'Articles', 'Unites'],
        ]);

        $this->set(compact('lignedemandeclient'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignedemandeclient = $this->Lignedemandeclients->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignedemandeclient = $this->Lignedemandeclients->patchEntity($lignedemandeclient, $this->request->getData());
            if ($this->Lignedemandeclients->save($lignedemandeclient)) {
                $this->Flash->success(__('The lignedemandeclient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignedemandeclient could not be saved. Please, try again.'));
        }
        $demandeclients = $this->Lignedemandeclients->Demandeclients->find('list', ['limit' => 200])->all();
        $familles = $this->Lignedemandeclients->Familles->find('list', ['limit' => 200])->all();
        $sousfamille1s = $this->Lignedemandeclients->Sousfamille1s->find('list', ['limit' => 200])->all();
        $articles = $this->Lignedemandeclients->Articles->find('list', ['limit' => 200])->all();
        $unites = $this->Lignedemandeclients->Unites->find('list', ['limit' => 200])->all();
        $this->set(compact('lignedemandeclient', 'demandeclients', 'familles', 'sousfamille1s', 'articles', 'unites'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lignedemandeclient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignedemandeclient = $this->Lignedemandeclients->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignedemandeclient = $this->Lignedemandeclients->patchEntity($lignedemandeclient, $this->request->getData());
            if ($this->Lignedemandeclients->save($lignedemandeclient)) {
                $this->Flash->success(__('The lignedemandeclient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignedemandeclient could not be saved. Please, try again.'));
        }
        $demandeclients = $this->Lignedemandeclients->Demandeclients->find('list', ['limit' => 200])->all();
        $familles = $this->Lignedemandeclients->Familles->find('list', ['limit' => 200])->all();
        $sousfamille1s = $this->Lignedemandeclients->Sousfamille1s->find('list', ['limit' => 200])->all();
        $articles = $this->Lignedemandeclients->Articles->find('list', ['limit' => 200])->all();
        $unites = $this->Lignedemandeclients->Unites->find('list', ['limit' => 200])->all();
        $this->set(compact('lignedemandeclient', 'demandeclients', 'familles', 'sousfamille1s', 'articles', 'unites'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lignedemandeclient id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignedemandeclient = $this->Lignedemandeclients->get($id);
        if ($this->Lignedemandeclients->delete($lignedemandeclient)) {
            $this->Flash->success(__('The lignedemandeclient has been deleted.'));
        } else {
            $this->Flash->error(__('The lignedemandeclient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

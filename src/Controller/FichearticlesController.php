<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fichearticles Controller
 *
 * @property \App\Model\Table\FichearticlesTable $Fichearticles
 * @method \App\Model\Entity\Fichearticle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FichearticlesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Articles'],
        ];
        $fichearticles = $this->paginate($this->Fichearticles);

        $this->set(compact('fichearticles'));
    }

    /**
     * View method
     *
     * @param string|null $id Fichearticle id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fichearticle = $this->Fichearticles->get($id, [
            'contain' => ['Articles'],
        ]);

        $this->set(compact('fichearticle'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fichearticle = $this->Fichearticles->newEmptyEntity();
        if ($this->request->is('post')) {
            $fichearticle = $this->Fichearticles->patchEntity($fichearticle, $this->request->getData());
            if ($this->Fichearticles->save($fichearticle)) {
                $this->Flash->success(__('The fichearticle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fichearticle could not be saved. Please, try again.'));
        }
        $articles = $this->Fichearticles->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('fichearticle', 'articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fichearticle id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fichearticle = $this->Fichearticles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fichearticle = $this->Fichearticles->patchEntity($fichearticle, $this->request->getData());
            if ($this->Fichearticles->save($fichearticle)) {
                $this->Flash->success(__('The fichearticle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fichearticle could not be saved. Please, try again.'));
        }
        $articles = $this->Fichearticles->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('fichearticle', 'articles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fichearticle id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fichearticle = $this->Fichearticles->get($id);
        if ($this->Fichearticles->delete($fichearticle)) {
            $this->Flash->success(__('The fichearticle has been deleted.'));
        } else {
            $this->Flash->error(__('The fichearticle could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

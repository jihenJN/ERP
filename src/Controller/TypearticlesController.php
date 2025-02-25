<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typearticles Controller
 *
 * @property \App\Model\Table\TypearticlesTable $Typearticles
 * @method \App\Model\Entity\Typearticle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypearticlesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typearticles = $this->paginate($this->Typearticles);

        $this->set(compact('typearticles'));
    }

    /**
     * View method
     *
     * @param string|null $id Typearticle id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typearticle = $this->Typearticles->get($id, [
            'contain' => ['Articles'],
        ]);

        $this->set(compact('typearticle'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typearticle = $this->Typearticles->newEmptyEntity();
        if ($this->request->is('post')) {
            $typearticle = $this->Typearticles->patchEntity($typearticle, $this->request->getData());
            if ($this->Typearticles->save($typearticle)) {
                $this->Flash->success(__('The typearticle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The typearticle could not be saved. Please, try again.'));
        }
        $this->set(compact('typearticle'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Typearticle id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typearticle = $this->Typearticles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typearticle = $this->Typearticles->patchEntity($typearticle, $this->request->getData());
            if ($this->Typearticles->save($typearticle)) {
                $this->Flash->success(__('The typearticle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The typearticle could not be saved. Please, try again.'));
        }
        $this->set(compact('typearticle'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Typearticle id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typearticle = $this->Typearticles->get($id);
        if ($this->Typearticles->delete($typearticle)) {
            $this->Flash->success(__('The typearticle has been deleted.'));
        } else {
            $this->Flash->error(__('The typearticle could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

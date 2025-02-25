<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Liens Controller
 *
 * @property \App\Model\Table\LiensTable $Liens
 * @method \App\Model\Entity\Lien[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LiensController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Utilisateurmenus'],
        ];
        $liens = $this->paginate($this->Liens);

        $this->set(compact('liens'));
    }

    /**
     * View method
     *
     * @param string|null $id Lien id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lien = $this->Liens->get($id, [
            'contain' => ['Utilisateurmenus'],
        ]);

        $this->set(compact('lien'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lien = $this->Liens->newEmptyEntity();
        if ($this->request->is('post')) {
            $lien = $this->Liens->patchEntity($lien, $this->request->getData());
            if ($this->Liens->save($lien)) {
                $this->Flash->success(__('The lien has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lien could not be saved. Please, try again.'));
        }
        $utilisateurmenus = $this->Liens->Utilisateurmenus->find('list', ['limit' => 200])->all();
        $this->set(compact('lien', 'utilisateurmenus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lien id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lien = $this->Liens->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lien = $this->Liens->patchEntity($lien, $this->request->getData());
            if ($this->Liens->save($lien)) {
                $this->Flash->success(__('The lien has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lien could not be saved. Please, try again.'));
        }
        $utilisateurmenus = $this->Liens->Utilisateurmenus->find('list', ['limit' => 200])->all();
        $this->set(compact('lien', 'utilisateurmenus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lien id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lien = $this->Liens->get($id);
        if ($this->Liens->delete($lien)) {
            $this->Flash->success(__('The lien has been deleted.'));
        } else {
            $this->Flash->error(__('The lien could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

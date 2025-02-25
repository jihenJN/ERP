<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Visiteurs Controller
 *
 * @property \App\Model\Table\VisiteursTable $Visiteurs
 * @method \App\Model\Entity\Visiteur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VisiteursController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $visiteurs = $this->paginate($this->Visiteurs);

        $this->set(compact('visiteurs'));
    }

    /**
     * View method
     *
     * @param string|null $id Visiteur id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $visiteur = $this->Visiteurs->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('visiteur'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $visiteur = $this->Visiteurs->newEmptyEntity();
        if ($this->request->is('post')) {
            $visiteur = $this->Visiteurs->patchEntity($visiteur, $this->request->getData());
            if ($this->Visiteurs->save($visiteur)) {
                $this->Flash->success(__('The visiteur has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visiteur could not be saved. Please, try again.'));
        }
        $this->set(compact('visiteur'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Visiteur id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $visiteur = $this->Visiteurs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $visiteur = $this->Visiteurs->patchEntity($visiteur, $this->request->getData());
            if ($this->Visiteurs->save($visiteur)) {
                $this->Flash->success(__('The visiteur has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visiteur could not be saved. Please, try again.'));
        }
        $this->set(compact('visiteur'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Visiteur id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $visiteur = $this->Visiteurs->get($id);
        if ($this->Visiteurs->delete($visiteur)) {
            $this->Flash->success(__('The visiteur has been deleted.'));
        } else {
            $this->Flash->error(__('The visiteur could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

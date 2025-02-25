<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Exonerations Controller
 *
 * @property \App\Model\Table\ExonerationsTable $Exonerations
 * @method \App\Model\Entity\Exoneration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExonerationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Typeexons', 'Fournisseurs'],
        ];
        $exonerations = $this->paginate($this->Exonerations);

        $this->set(compact('exonerations'));
    }

    /**
     * View method
     *
     * @param string|null $id Exoneration id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exoneration = $this->Exonerations->get($id, [
            'contain' => ['Typeexons', 'Fournisseurs'],
        ]);

        $this->set(compact('exoneration'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exoneration = $this->Exonerations->newEmptyEntity();
        if ($this->request->is('post')) {
            $exoneration = $this->Exonerations->patchEntity($exoneration, $this->request->getData());
            if ($this->Exonerations->save($exoneration)) {
                $this->Flash->success(__('The {0} has been saved.', 'Exoneration'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Exoneration'));
        }
        $typeexons = $this->Exonerations->Typeexons->find('list', ['limit' => 200]);
        $fournisseurs = $this->Exonerations->Fournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('exoneration', 'typeexons', 'fournisseurs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Exoneration id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exoneration = $this->Exonerations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exoneration = $this->Exonerations->patchEntity($exoneration, $this->request->getData());
            if ($this->Exonerations->save($exoneration)) {
                $this->Flash->success(__('The {0} has been saved.', 'Exoneration'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Exoneration'));
        }
        $typeexons = $this->Exonerations->Typeexons->find('list', ['limit' => 200]);
        $fournisseurs = $this->Exonerations->Fournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('exoneration', 'typeexons', 'fournisseurs'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Exoneration id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exoneration = $this->Exonerations->get($id);
        if ($this->Exonerations->delete($exoneration)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Exoneration'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Exoneration'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

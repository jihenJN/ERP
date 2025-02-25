<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Bandeconsultations Controller
 *
 * @property \App\Model\Table\BandeconsultationsTable $Bandeconsultations
 * @method \App\Model\Entity\Bandeconsultation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BandeconsultationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Demandeoffredeprixes', 'Fournisseurs', 'Articles'],
        ];
        $bandeconsultations = $this->paginate($this->Bandeconsultations);

        $this->set(compact('bandeconsultations'));
    }

    /**
     * View method
     *
     * @param string|null $id Bandeconsultation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bandeconsultation = $this->Bandeconsultations->get($id, [
            'contain' => ['Demandeoffredeprixes', 'Fournisseurs', 'Articles', 'Lignebandeconsultations'],
        ]);

        $this->set(compact('bandeconsultation'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bandeconsultation = $this->Bandeconsultations->newEmptyEntity();
        if ($this->request->is('post')) {
            $bandeconsultation = $this->Bandeconsultations->patchEntity($bandeconsultation, $this->request->getData());
            if ($this->Bandeconsultations->save($bandeconsultation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Bandeconsultation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bandeconsultation'));
        }
        $demandeoffredeprixes = $this->Bandeconsultations->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Bandeconsultations->Fournisseurs->find('list', ['limit' => 200]);
        $articles = $this->Bandeconsultations->Articles->find('list', ['limit' => 200]);
        $this->set(compact('bandeconsultation', 'demandeoffredeprixes', 'fournisseurs', 'articles'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Bandeconsultation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bandeconsultation = $this->Bandeconsultations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bandeconsultation = $this->Bandeconsultations->patchEntity($bandeconsultation, $this->request->getData());
            if ($this->Bandeconsultations->save($bandeconsultation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Bandeconsultation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bandeconsultation'));
        }
        $demandeoffredeprixes = $this->Bandeconsultations->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Bandeconsultations->Fournisseurs->find('list', ['limit' => 200]);
        $articles = $this->Bandeconsultations->Articles->find('list', ['limit' => 200]);
        $this->set(compact('bandeconsultation', 'demandeoffredeprixes', 'fournisseurs', 'articles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Bandeconsultation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bandeconsultation = $this->Bandeconsultations->get($id);
        if ($this->Bandeconsultations->delete($bandeconsultation)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Bandeconsultation'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Bandeconsultation'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignebandeconsultations Controller
 *
 * @property \App\Model\Table\LignebandeconsultationsTable $Lignebandeconsultations
 * @method \App\Model\Entity\Lignebandeconsultation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignebandeconsultationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Demandeoffredeprixes', 'Bandeconsultations', 'Lignedemandeoffredeprixes', 'Fournisseurs', 'Articles'],
        ];
        $lignebandeconsultations = $this->paginate($this->Lignebandeconsultations);

        $this->set(compact('lignebandeconsultations'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignebandeconsultation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignebandeconsultation = $this->Lignebandeconsultations->get($id, [
            'contain' => ['Demandeoffredeprixes', 'Bandeconsultations', 'Lignedemandeoffredeprixes', 'Fournisseurs', 'Articles'],
        ]);

        $this->set(compact('lignebandeconsultation'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignebandeconsultation = $this->Lignebandeconsultations->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignebandeconsultation = $this->Lignebandeconsultations->patchEntity($lignebandeconsultation, $this->request->getData());
            if ($this->Lignebandeconsultations->save($lignebandeconsultation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignebandeconsultation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignebandeconsultation'));
        }
        $demandeoffredeprixes = $this->Lignebandeconsultations->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $bandeconsultations = $this->Lignebandeconsultations->Bandeconsultations->find('list', ['limit' => 200]);
        $lignedemandeoffredeprixes = $this->Lignebandeconsultations->Lignedemandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Lignebandeconsultations->Fournisseurs->find('list', ['limit' => 200]);
        $articles = $this->Lignebandeconsultations->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignebandeconsultation', 'demandeoffredeprixes', 'bandeconsultations', 'lignedemandeoffredeprixes', 'fournisseurs', 'articles'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Lignebandeconsultation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignebandeconsultation = $this->Lignebandeconsultations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignebandeconsultation = $this->Lignebandeconsultations->patchEntity($lignebandeconsultation, $this->request->getData());
            if ($this->Lignebandeconsultations->save($lignebandeconsultation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignebandeconsultation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignebandeconsultation'));
        }
        $demandeoffredeprixes = $this->Lignebandeconsultations->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $bandeconsultations = $this->Lignebandeconsultations->Bandeconsultations->find('list', ['limit' => 200]);
        $lignedemandeoffredeprixes = $this->Lignebandeconsultations->Lignedemandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Lignebandeconsultations->Fournisseurs->find('list', ['limit' => 200]);
        $articles = $this->Lignebandeconsultations->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignebandeconsultation', 'demandeoffredeprixes', 'bandeconsultations', 'lignedemandeoffredeprixes', 'fournisseurs', 'articles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Lignebandeconsultation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignebandeconsultation = $this->Lignebandeconsultations->get($id);
        if ($this->Lignebandeconsultations->delete($lignebandeconsultation)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Lignebandeconsultation'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Lignebandeconsultation'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

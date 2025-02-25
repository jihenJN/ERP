<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignelignebandeconsultations Controller
 *
 * @property \App\Model\Table\LignelignebandeconsultationsTable $Lignelignebandeconsultations
 * @method \App\Model\Entity\Lignelignebandeconsultation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignelignebandeconsultationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Demandeoffredeprixes', 'Fournisseurs'],
        ];
        $lignelignebandeconsultations = $this->paginate($this->Lignelignebandeconsultations);

        $this->set(compact('lignelignebandeconsultations'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignelignebandeconsultation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignelignebandeconsultation = $this->Lignelignebandeconsultations->get($id, [
            'contain' => ['Demandeoffredeprixes', 'Fournisseurs'],
        ]);

        $this->set(compact('lignelignebandeconsultation'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignelignebandeconsultation = $this->Lignelignebandeconsultations->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignelignebandeconsultation = $this->Lignelignebandeconsultations->patchEntity($lignelignebandeconsultation, $this->request->getData());
            if ($this->Lignelignebandeconsultations->save($lignelignebandeconsultation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignelignebandeconsultation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignelignebandeconsultation'));
        }
        $demandeoffredeprixes = $this->Lignelignebandeconsultations->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Lignelignebandeconsultations->Fournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('lignelignebandeconsultation', 'demandeoffredeprixes', 'fournisseurs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Lignelignebandeconsultation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignelignebandeconsultation = $this->Lignelignebandeconsultations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignelignebandeconsultation = $this->Lignelignebandeconsultations->patchEntity($lignelignebandeconsultation, $this->request->getData());
            if ($this->Lignelignebandeconsultations->save($lignelignebandeconsultation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignelignebandeconsultation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignelignebandeconsultation'));
        }
        $demandeoffredeprixes = $this->Lignelignebandeconsultations->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Lignelignebandeconsultations->Fournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('lignelignebandeconsultation', 'demandeoffredeprixes', 'fournisseurs'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Lignelignebandeconsultation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignelignebandeconsultation = $this->Lignelignebandeconsultations->get($id);
        if ($this->Lignelignebandeconsultations->delete($lignelignebandeconsultation)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Lignelignebandeconsultation'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Lignelignebandeconsultation'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

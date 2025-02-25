<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignefactures Controller
 *
 * @property \App\Model\Table\LignefacturesTable $Lignefactures
 * @method \App\Model\Entity\Lignefacture[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignefacturesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Factures', 'Fournisseurs', 'Articles'],
        ];
        $lignefactures = $this->paginate($this->Lignefactures);

        $this->set(compact('lignefactures'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignefacture id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignefacture = $this->Lignefactures->get($id, [
            'contain' => ['Factures', 'Fournisseurs', 'Articles'],
        ]);

        $this->set(compact('lignefacture'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignefacture = $this->Lignefactures->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignefacture = $this->Lignefactures->patchEntity($lignefacture, $this->request->getData());
            if ($this->Lignefactures->save($lignefacture)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignefacture'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignefacture'));
        }
        $factures = $this->Lignefactures->Factures->find('list', ['limit' => 200]);
        $fournisseurs = $this->Lignefactures->Fournisseurs->find('list', ['limit' => 200]);
        $articles = $this->Lignefactures->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignefacture', 'factures', 'fournisseurs', 'articles'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Lignefacture id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignefacture = $this->Lignefactures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignefacture = $this->Lignefactures->patchEntity($lignefacture, $this->request->getData());
            if ($this->Lignefactures->save($lignefacture)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignefacture'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignefacture'));
        }
        $factures = $this->Lignefactures->Factures->find('list', ['limit' => 200]);
        $fournisseurs = $this->Lignefactures->Fournisseurs->find('list', ['limit' => 200]);
        $articles = $this->Lignefactures->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignefacture', 'factures', 'fournisseurs', 'articles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Lignefacture id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignefacture = $this->Lignefactures->get($id);
        if ($this->Lignefactures->delete($lignefacture)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Lignefacture'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Lignefacture'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

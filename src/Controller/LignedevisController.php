<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignedevis Controller
 *
 * @property \App\Model\Table\LignedevisTable $Lignedevis
 * @method \App\Model\Entity\Lignedevi[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignedevisController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Articles', 'Devis'],
        ];
        $lignedevis = $this->paginate($this->Lignedevis);

        $this->set(compact('lignedevis'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignedevi id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignedevi = $this->Lignedevis->get($id, [
            'contain' => ['Articles', 'Devis'],
        ]);

        $this->set(compact('lignedevi'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignedevi = $this->Lignedevis->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignedevi = $this->Lignedevis->patchEntity($lignedevi, $this->request->getData());
            if ($this->Lignedevis->save($lignedevi)) {
                $this->Flash->success(__('The lignedevi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignedevi could not be saved. Please, try again.'));
        }
        $articles = $this->Lignedevis->Articles->find('list', ['limit' => 200])->all();
        $devis = $this->Lignedevis->Devis->find('list', ['limit' => 200])->all();
        $this->set(compact('lignedevi', 'articles', 'devis'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lignedevi id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignedevi = $this->Lignedevis->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignedevi = $this->Lignedevis->patchEntity($lignedevi, $this->request->getData());
            if ($this->Lignedevis->save($lignedevi)) {
                $this->Flash->success(__('The lignedevi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignedevi could not be saved. Please, try again.'));
        }
        $articles = $this->Lignedevis->Articles->find('list', ['limit' => 200])->all();
        $devis = $this->Lignedevis->Devis->find('list', ['limit' => 200])->all();
        $this->set(compact('lignedevi', 'articles', 'devis'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lignedevi id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignedevi = $this->Lignedevis->get($id);
        if ($this->Lignedevis->delete($lignedevi)) {
            $this->Flash->success(__('The lignedevi has been deleted.'));
        } else {
            $this->Flash->error(__('The lignedevi could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Pcis Controller
 *
 * @property \App\Model\Table\PcisTable $Pcis
 * @method \App\Model\Entity\Pci[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PcisController extends AppController
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
        $pcis = $this->paginate($this->Pcis);

        $this->set(compact('pcis'));
    }

    /**
     * View method
     *
     * @param string|null $id Pci id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pci = $this->Pcis->get($id, [
            'contain' => ['Articles'],
        ]);

        $this->set(compact('pci'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pci = $this->Pcis->newEmptyEntity();
        if ($this->request->is('post')) {
            $pci = $this->Pcis->patchEntity($pci, $this->request->getData());
            if ($this->Pcis->save($pci)) {
                $this->Flash->success(__('The pci has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pci could not be saved. Please, try again.'));
        }
        $articles = $this->Pcis->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('pci', 'articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pci id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pci = $this->Pcis->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pci = $this->Pcis->patchEntity($pci, $this->request->getData());
            if ($this->Pcis->save($pci)) {
                $this->Flash->success(__('The pci has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pci could not be saved. Please, try again.'));
        }
        $articles = $this->Pcis->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('pci', 'articles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pci id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pci = $this->Pcis->get($id);
        if ($this->Pcis->delete($pci)) {
            $this->Flash->success(__('The pci has been deleted.'));
        } else {
            $this->Flash->error(__('The pci could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

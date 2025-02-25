<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ligneplans Controller
 *
 * @property \App\Model\Table\LigneplansTable $Ligneplans
 * @method \App\Model\Entity\Ligneplan[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LigneplansController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $ligneplans = $this->paginate($this->Ligneplans);

        $this->set(compact('ligneplans'));
    }

    /**
     * View method
     *
     * @param string|null $id Ligneplan id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ligneplan = $this->Ligneplans->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('ligneplan'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ligneplan = $this->Ligneplans->newEmptyEntity();
        if ($this->request->is('post')) {
            $ligneplan = $this->Ligneplans->patchEntity($ligneplan, $this->request->getData());
            if ($this->Ligneplans->save($ligneplan)) {
                $this->Flash->success(__('The {0} has been saved.', 'Ligneplan'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ligneplan'));
        }
        $this->set(compact('ligneplan'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Ligneplan id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ligneplan = $this->Ligneplans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ligneplan = $this->Ligneplans->patchEntity($ligneplan, $this->request->getData());
            if ($this->Ligneplans->save($ligneplan)) {
                $this->Flash->success(__('The {0} has been saved.', 'Ligneplan'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ligneplan'));
        }
        $this->set(compact('ligneplan'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Ligneplan id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ligneplan = $this->Ligneplans->get($id);
        if ($this->Ligneplans->delete($ligneplan)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Ligneplan'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Ligneplan'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

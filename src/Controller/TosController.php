<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tos Controller
 *
 * @property \App\Model\Table\TosTable $Tos
 * @method \App\Model\Entity\To[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tos = $this->paginate($this->Tos);

        $this->set(compact('tos'));
    }

    /**
     * View method
     *
     * @param string|null $id To id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $to = $this->Tos->get($id, [
            'contain' => ['Piecereglements'],
        ]);

        $this->set(compact('to'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $to = $this->Tos->newEmptyEntity();
        if ($this->request->is('post')) {
            $to = $this->Tos->patchEntity($to, $this->request->getData());
            if ($this->Tos->save($to)) {
                $this->Flash->success(__('The to has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The to could not be saved. Please, try again.'));
        }
        $this->set(compact('to'));
    }

    /**
     * Edit method
     *
     * @param string|null $id To id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $to = $this->Tos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $to = $this->Tos->patchEntity($to, $this->request->getData());
            if ($this->Tos->save($to)) {
                $this->Flash->success(__('The to has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The to could not be saved. Please, try again.'));
        }
        $this->set(compact('to'));
    }

    /**
     * Delete method
     *
     * @param string|null $id To id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $to = $this->Tos->get($id);
        if ($this->Tos->delete($to)) {
            $this->Flash->success(__('The to has been deleted.'));
        } else {
            $this->Flash->error(__('The to could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

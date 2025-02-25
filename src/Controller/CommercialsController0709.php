<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Commercials Controller
 *
 * @property \App\Model\Table\CommercialsTable $Commercials
 * @method \App\Model\Entity\Commercial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommercialsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $commercials = $this->paginate($this->Commercials);

        $this->set(compact('commercials'));
    }

    /**
     * View method
     *
     * @param string|null $id Commercial id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commercial = $this->Commercials->get($id, [
            'contain' => ['Commandes'],
        ]);
       
        $this->set(compact('commercial')); 
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $commercial = $this->Commercials->newEmptyEntity();
        if ($this->request->is('post')) {
            $commercial = $this->Commercials->patchEntity($commercial, $this->request->getData());
            if ($this->Commercials->save($commercial)) {
                $this->Flash->success(__('The {0} has been saved.', 'Commercial'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commercial'));
        }
        $gouvernorats = $this->Commercials->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'Description']);
        $this->set(compact('commercial','gouvernorats'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Commercial id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commercial = $this->Commercials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commercial = $this->Commercials->patchEntity($commercial, $this->request->getData());
            if ($this->Commercials->save($commercial)) {
                $this->Flash->success(__('The {0} has been saved.', 'Commercial'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commercial'));
        }
        $gouvernorats = $this->Commercials->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'Description']);
        $this->set(compact('commercial','gouvernorats'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Commercial id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commercial = $this->Commercials->get($id);
        if ($this->Commercials->delete($commercial)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Commercial'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Commercial'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

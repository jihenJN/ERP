<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Sousfamille3s Controller
 *
 * @property \App\Model\Table\Sousfamille3sTable $Sousfamille3s
 * @method \App\Model\Entity\Sousfamille3[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class Sousfamille3sController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sousfamille2s'],
        ];
        $sousfamille3s = $this->paginate($this->Sousfamille3s);

        $this->set(compact('sousfamille3s'));
    }

    /**
     * View method
     *
     * @param string|null $id Sousfamille3 id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sousfamille3 = $this->Sousfamille3s->get($id, [
            'contain' => ['Sousfamille2s', 'Articles'],
        ]);

        $this->set(compact('sousfamille3'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sousfamille3 = $this->Sousfamille3s->newEmptyEntity();
        if ($this->request->is('post')) {
            $sousfamille3 = $this->Sousfamille3s->patchEntity($sousfamille3, $this->request->getData());
            if ($this->Sousfamille3s->save($sousfamille3)) {
                $this->Flash->success(__('The {0} has been saved.', 'Sousfamille3'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Sousfamille3'));
        }
        $sousfamille2s = $this->Sousfamille3s->Sousfamille2s->find('list', ['limit' => 200]);
        $this->set(compact('sousfamille3', 'sousfamille2s'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Sousfamille3 id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sousfamille3 = $this->Sousfamille3s->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sousfamille3 = $this->Sousfamille3s->patchEntity($sousfamille3, $this->request->getData());
            if ($this->Sousfamille3s->save($sousfamille3)) {
                $this->Flash->success(__('The {0} has been saved.', 'Sousfamille3'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Sousfamille3'));
        }
        $sousfamille2s = $this->Sousfamille3s->Sousfamille2s->find('list', ['limit' => 200]);
        $this->set(compact('sousfamille3', 'sousfamille2s'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Sousfamille3 id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sousfamille3 = $this->Sousfamille3s->get($id);
        if ($this->Sousfamille3s->delete($sousfamille3)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Sousfamille3'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Sousfamille3'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

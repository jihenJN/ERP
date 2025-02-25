<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Sousfamille1s Controller
 *
 * @property \App\Model\Table\Sousfamille1sTable $Sousfamille1s
 * @method \App\Model\Entity\Sousfamille1[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class Sousfamille1sController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Familles'],
        ];
        $sousfamille1s = $this->paginate($this->Sousfamille1s);

        $this->set(compact('sousfamille1s'));
    }

    /**
     * View method
     *
     * @param string|null $id Sousfamille1 id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sousfamille1 = $this->Sousfamille1s->get($id, [
            'contain' => ['Familles', 'Articles', 'Sousfamille2s'],
        ]);

        $this->set(compact('sousfamille1'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sousfamille1 = $this->Sousfamille1s->newEmptyEntity();
        if ($this->request->is('post')) {
            $sousfamille1 = $this->Sousfamille1s->patchEntity($sousfamille1, $this->request->getData());
            if ($this->Sousfamille1s->save($sousfamille1)) {
                $this->Flash->success(__('The {0} has been saved.', 'Sousfamille1'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Sousfamille1'));
        }
        $familles = $this->Sousfamille1s->Familles->find('list', ['limit' => 200]);
        $this->set(compact('sousfamille1', 'familles'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Sousfamille1 id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sousfamille1 = $this->Sousfamille1s->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            debug($this->request->getData());die;
            $sousfamille1 = $this->Sousfamille1s->patchEntity($sousfamille1, $this->request->getData());
            if ($this->Sousfamille1s->save($sousfamille1)) {
                $this->Flash->success(__('The {0} has been saved.', 'Sousfamille1'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Sousfamille1'));
        }
        $familles = $this->Sousfamille1s->Familles->find('list', ['limit' => 200]);
        $this->set(compact('sousfamille1', 'familles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Sousfamille1 id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sousfamille1 = $this->Sousfamille1s->get($id);
        if ($this->Sousfamille1s->delete($sousfamille1)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Sousfamille1'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Sousfamille1'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

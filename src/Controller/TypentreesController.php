<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typentrees Controller
 *
 * @property \App\Model\Table\TypentreesTable $Typentrees
 * @method \App\Model\Entity\Typentree[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypentreesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typentrees = $this->paginate($this->Typentrees);

        $this->set(compact('typentrees'));
    }

    /**
     * View method
     *
     * @param string|null $id Typentree id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typentree = $this->Typentrees->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('typentree'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typentree = $this->Typentrees->newEmptyEntity();
        if ($this->request->is('post')) {
            $typentree = $this->Typentrees->patchEntity($typentree, $this->request->getData());
            if ($this->Typentrees->save($typentree)) {
              ///  $this->Flash->success(__('The {0} has been saved.', 'Typentree'));

                return $this->redirect(['action' => 'index']);
            }
           /// $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typentree'));
        }
        $this->set(compact('typentree'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Typentree id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typentree = $this->Typentrees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typentree = $this->Typentrees->patchEntity($typentree, $this->request->getData());
            if ($this->Typentrees->save($typentree)) {
                $this->Flash->success(__('The {0} has been saved.', 'Typentree'));

              ///  return $this->redirect(['action' => 'index']);
            }
          ////  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typentree'));
        }
        $this->set(compact('typentree'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Typentree id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typentree = $this->Typentrees->get($id);
        if ($this->Typentrees->delete($typentree)) {
          ///  $this->Flash->success(__('The {0} has been deleted.', 'Typentree'));
        } else {
          ///  $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Typentree'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

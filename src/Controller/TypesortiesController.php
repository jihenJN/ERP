<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typesorties Controller
 *
 * @property \App\Model\Table\TypesortiesTable $Typesorties
 * @method \App\Model\Entity\Typesorty[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypesortiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typesorties = $this->paginate($this->Typesorties);

        $this->set(compact('typesorties'));
    }

    /**
     * View method
     *
     * @param string|null $id Typesorty id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typesorty = $this->Typesorties->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('typesorty'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typesorty = $this->Typesorties->newEmptyEntity();
        if ($this->request->is('post')) {
            $typesorty = $this->Typesorties->patchEntity($typesorty, $this->request->getData());
            if ($this->Typesorties->save($typesorty)) {
              ////  $this->Flash->success(__('The {0} has been saved.', 'Typesorty'));

                return $this->redirect(['action' => 'index']);
            }
           //// $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typesorty'));
        }
        $this->set(compact('typesorty'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Typesorty id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typesorty = $this->Typesorties->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typesorty = $this->Typesorties->patchEntity($typesorty, $this->request->getData());
            if ($this->Typesorties->save($typesorty)) {
            ////    $this->Flash->success(__('The {0} has been saved.', 'Typesorty'));

                return $this->redirect(['action' => 'index']);
            }
           //// $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typesorty'));
        }
        $this->set(compact('typesorty'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Typesorty id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typesorty = $this->Typesorties->get($id);
        if ($this->Typesorties->delete($typesorty)) {
          ///  $this->Flash->success(__('The {0} has been deleted.', 'Typesorty'));
        } else {
            ///$this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Typesorty'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

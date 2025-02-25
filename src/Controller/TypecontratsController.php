<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typecontrats Controller
 *
 * @property \App\Model\Table\TypecontratsTable $Typecontrats
 * @method \App\Model\Entity\Typecontrat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypecontratsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typecontrats = $this->paginate($this->Typecontrats);

        $this->set(compact('typecontrats'));
    }

    /**
     * View method
     *
     * @param string|null $id Typecontrat id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typecontrat = $this->Typecontrats->get($id, [
            'contain' => ['Personnels'],
        ]);

        $this->set(compact('typecontrat'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typecontrat = $this->Typecontrats->newEmptyEntity();
        if ($this->request->is('post')) {
            $typecontrat = $this->Typecontrats->patchEntity($typecontrat, $this->request->getData());
            if ($this->Typecontrats->save($typecontrat)) {
                $this->Flash->success(__('The {0} has been saved.', 'Typecontrat'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typecontrat'));
        }
        $this->set(compact('typecontrat'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Typecontrat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typecontrat = $this->Typecontrats->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typecontrat = $this->Typecontrats->patchEntity($typecontrat, $this->request->getData());
            if ($this->Typecontrats->save($typecontrat)) {
                $this->Flash->success(__('The {0} has been saved.', 'Typecontrat'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typecontrat'));
        }
        $this->set(compact('typecontrat'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Typecontrat id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typecontrat = $this->Typecontrats->get($id);
        if ($this->Typecontrats->delete($typecontrat)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Typecontrat'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Typecontrat'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

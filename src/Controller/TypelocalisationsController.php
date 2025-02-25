<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typelocalisations Controller
 *
 * @property \App\Model\Table\TypelocalisationsTable $Typelocalisations
 * @method \App\Model\Entity\Typelocalisation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypelocalisationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typelocalisations = $this->paginate($this->Typelocalisations);

        $this->set(compact('typelocalisations'));
    }

    /**
     * View method
     *
     * @param string|null $id Typelocalisation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typelocalisation = $this->Typelocalisations->get($id, [
            'contain' => ['Fournisseurs'],
        ]);

        $this->set(compact('typelocalisation'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typelocalisation = $this->Typelocalisations->newEmptyEntity();
        if ($this->request->is('post')) {
            $typelocalisation = $this->Typelocalisations->patchEntity($typelocalisation, $this->request->getData());
            if ($this->Typelocalisations->save($typelocalisation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Typelocalisation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typelocalisation'));
        }
        $this->set(compact('typelocalisation'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Typelocalisation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typelocalisation = $this->Typelocalisations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typelocalisation = $this->Typelocalisations->patchEntity($typelocalisation, $this->request->getData());
            if ($this->Typelocalisations->save($typelocalisation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Typelocalisation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typelocalisation'));
        }
        $this->set(compact('typelocalisation'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Typelocalisation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typelocalisation = $this->Typelocalisations->get($id);
        if ($this->Typelocalisations->delete($typelocalisation)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Typelocalisation'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Typelocalisation'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typevaleurs Controller
 *
 * @property \App\Model\Table\TypevaleursTable $Typevaleurs
 * @method \App\Model\Entity\Typevaleur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypevaleursController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typevaleurs = $this->paginate($this->Typevaleurs);

        $this->set(compact('typevaleurs'));
    }

    /**
     * View method
     *
     * @param string|null $id Typevaleur id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typevaleur = $this->Typevaleurs->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('typevaleur'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typevaleur = $this->Typevaleurs->newEmptyEntity();
        if ($this->request->is('post')) {
            $typevaleur = $this->Typevaleurs->patchEntity($typevaleur, $this->request->getData());
            if ($this->Typevaleurs->save($typevaleur)) {
                $this->Flash->success(__('The {0} has been saved.', 'Typevaleur'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typevaleur'));
        }
        $this->set(compact('typevaleur'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Typevaleur id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typevaleur = $this->Typevaleurs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typevaleur = $this->Typevaleurs->patchEntity($typevaleur, $this->request->getData());
            if ($this->Typevaleurs->save($typevaleur)) {
                $this->Flash->success(__('The {0} has been saved.', 'Typevaleur'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typevaleur'));
        }
        $this->set(compact('typevaleur'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Typevaleur id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typevaleur = $this->Typevaleurs->get($id);
        if ($this->Typevaleurs->delete($typevaleur)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Typevaleur'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Typevaleur'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

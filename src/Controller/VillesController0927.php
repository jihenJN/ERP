<?php
declare(strict_types=1);

namespace App\Controller; 

/**
 * Villes Controller
 *
 * @property \App\Model\Table\VillesTable $Villes
 * @method \App\Model\Entity\Ville[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VillesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {  
        $name= $this->request->getQuery('name');
        $pay_id= $this->request->getQuery('pay_id');
        $cond1 = '';
        $cond2 = '';
        if ($name) {
            $cond1 = "Villes.name like  '%" . $name . "%' ";
        }
        if ($pay_id) {
            $cond2 = "Villes.pay_id like  '%" . $pay_id . "%' ";
        }
        $query = $this->Villes->find('all')->where([$cond1,$cond2]);
        $this->paginate = [
            'contain' => ['Pays'],
        ];
        $pays = $this->Villes->Pays->find('list', ['limit' => 200]);
        $villes = $this->paginate($query);
        $this->set(compact('villes','pays'));
    }

    /**
     * View method
     *
     * @param string|null $id Ville id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ville = $this->Villes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ville = $this->Villes->patchEntity($ville, $this->request->getData());
        }
        $pays = $this->Villes->Pays->find('list', ['limit' => 200]);
        $this->set(compact('ville', 'pays'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ville = $this->Villes->newEmptyEntity();
        if ($this->request->is('post')) {
            $ville = $this->Villes->patchEntity($ville, $this->request->getData());
            if ($this->Villes->save($ville)) {
                $ville_id = ($this->Villes->save($ville)->id);
                $this->misejour("Villes", "add", $ville_id);
                $this->Flash->success(__('The {0} has been saved.', 'Ville'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ville'));
        }
        $pays = $this->Villes->Pays->find('list', ['limit' => 200]);
        $this->set(compact('ville', 'pays'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Ville id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ville = $this->Villes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ville = $this->Villes->patchEntity($ville, $this->request->getData());
            if ($this->Villes->save($ville)) {
                $ville_id = ($this->Villes->save($ville)->id);
                $this->misejour("Villes", "edit", $ville_id);
                $this->Flash->success(__('The {0} has been saved.', 'Ville'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ville'));
        }
        $pays = $this->Villes->Pays->find('list', ['limit' => 200]);
        $this->set(compact('ville', 'pays'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Ville id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ville = $this->Villes->get($id);
        if ($this->Villes->delete($ville)) {
            $ville_id = ($this->Villes->save($ville)->id);
                $this->misejour("Villes", "delete", $ville_id);
            $this->Flash->success(__('The {0} has been deleted.', 'Ville'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Ville'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Cartecarburants Controller
 *
 * @property \App\Model\Table\CartecarburantsTable $Cartecarburants
 * @method \App\Model\Entity\Cartecarburant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CartecarburantsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view 
     */
    public function index()
    {
        $num= $this->request->getQuery('num');
        $typekiosque= $this->request->getQuery('typekiosque');
        $cond1 = '';
        $cond2 = '';
        if ($num) {
            $cond1 = "Cartecarburants.num like  '%" . $num . "%' ";
        }
        if ($typekiosque) {
            $cond2 = "Cartecarburants.typekiosque like  '%" . $typekiosque . "%' ";
        }
        $query = $this->Cartecarburants->find('all')->where([$cond1,$cond2]);
        $cartecarburants = $this->paginate($query);
        $this->paginate = [
            'contain' => ['Typecartecarburants'],
        ];
        $this->set(compact('cartecarburants'));
    }

    /**
     * View method
     *
     * @param string|null $id Cartecarburant id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cartecarburant = $this->Cartecarburants->get($id, [
            'contain' => []
        ]);
        $typecartecarburants = $this->Cartecarburants->Typecartecarburants->find('list', ['limit' => 200]);
        $this->set(compact('cartecarburant', 'typecartecarburants'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cartecarburant = $this->Cartecarburants->newEmptyEntity();
        if ($this->request->is('post')) {
            $cartecarburant = $this->Cartecarburants->patchEntity($cartecarburant, $this->request->getData());
            if ($this->Cartecarburants->save($cartecarburant)) {
                $cartecarburant_id = ($this->Cartecarburants->save($cartecarburant)->id);
                $this->misejour("Cartecarburants", "add", $cartecarburant_id);
                $this->Flash->success(__('The {0} has been saved.', 'Cartecarburant'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Cartecarburant'));
        }
        $typecartecarburants = $this->Cartecarburants->Typecartecarburants->find('list', ['limit' => 200]);
        $this->set(compact('cartecarburant', 'typecartecarburants'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Cartecarburant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cartecarburant = $this->Cartecarburants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cartecarburant = $this->Cartecarburants->patchEntity($cartecarburant, $this->request->getData());
            if ($this->Cartecarburants->save($cartecarburant)) {
                $cartecarburant_id = ($this->Cartecarburants->save($cartecarburant)->id);
                $this->misejour("Cartecarburants", "edit", $cartecarburant_id);
                $this->Flash->success(__('The {0} has been saved.', 'Cartecarburant'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Cartecarburant'));
        }
        $typecartecarburants = $this->Cartecarburants->Typecartecarburants->find('list', ['limit' => 200]);
        $this->set(compact('cartecarburant', 'typecartecarburants'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Cartecarburant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cartecarburant = $this->Cartecarburants->get($id);
        if ($this->Cartecarburants->delete($cartecarburant)) {
            $cartecarburant_id = ($this->Cartecarburants->save($cartecarburant)->id);
            $this->misejour("Cartecarburants", "delete", $cartecarburant_id);
            $this->Flash->success(__('The {0} has been deleted.', 'Cartecarburant'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Cartecarburant'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Regions Controller
 *
 * @property \App\Model\Table\RegionsTable $Regions
 * @method \App\Model\Entity\Region[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $name= $this->request->getQuery('name');
        $ville_id= $this->request->getQuery('ville_id');
        $cond1 = '';
        $cond2 = '';
        if ($name) {
            $cond1 = "Regions.name like  '%" . $name . "%' ";
        }
        if ($ville_id) {
            $cond2 = "Regions.ville_id like  '%" . $ville_id . "%' ";
        }
        $query = $this->Regions->find('all')->where([$cond1,$cond2]);
        $this->paginate = [
            'contain' => ['Villes'],
        ];
        
        $villes = $this->Regions->Villes->find('list', ['limit' => 200]);
        $regions = $this->paginate($query);

        $this->set(compact('villes','regions'));
    }

    /**
     * View method
     *
     * @param string|null $id Region id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $region = $this->Regions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $region = $this->Regions->patchEntity($region, $this->request->getData());
            if ($this->Regions->save($region)) {
                $this->Flash->success(__('The {0} has been saved.', 'Region'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Region'));
        }
        $villes = $this->Regions->Villes->find('list', ['limit' => 200]);
        $this->set(compact('region', 'villes'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $region = $this->Regions->newEmptyEntity();
        if ($this->request->is('post')) {
            $region = $this->Regions->patchEntity($region, $this->request->getData());
            if ($this->Regions->save($region)) {
                $region_id = ($this->Regions->save($region)->id);
                $this->misejour("Regions", "add", $region_id);
                $this->Flash->success(__('The {0} has been saved.', 'Region'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Region'));
        }
        $villes = $this->Regions->Villes->find('list', ['limit' => 200]);
        $this->set(compact('region', 'villes'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Region id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $region = $this->Regions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $region = $this->Regions->patchEntity($region, $this->request->getData());
            if ($this->Regions->save($region)) {
                $region_id = ($this->Regions->save($region)->id);
                $this->misejour("Regions", "edit", $region_id);
                $this->Flash->success(__('The {0} has been saved.', 'Region'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Region'));
        }
        $villes = $this->Regions->Villes->find('list', ['limit' => 200]);
        $this->set(compact('region', 'villes'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Region id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $region = $this->Regions->get($id);
        if ($this->Regions->delete($region)) {
            $region_id = ($this->Regions->save($region)->id);
                $this->misejour("Regions", "delete", $region_id);
            $this->Flash->success(__('The {0} has been deleted.', 'Region'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Region'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

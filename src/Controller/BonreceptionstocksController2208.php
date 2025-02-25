<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Bonreceptionstocks Controller
 *
 * @property \App\Model\Table\BonreceptionstocksTable $Bonreceptionstocks
 * @method \App\Model\Entity\Bonreceptionstock[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BonreceptionstocksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants', 'Personnels'],
        ];
        $bonreceptionstocks = $this->paginate($this->Bonreceptionstocks);

        $this->set(compact('bonreceptionstocks'));
    }

    /**
     * View method
     *
     * @param string|null $id Bonreceptionstock id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bonreceptionstock = $this->Bonreceptionstocks->get($id, [
            'contain' => ['Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants', 'Personnels', 'Conffaieurs', 'Chauffeurs', 'Bondetransferts', 'Lignebonreceptionstocks'],
        ]);

        $this->set(compact('bonreceptionstock'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bonreceptionstock = $this->Bonreceptionstocks->newEmptyEntity();
        if ($this->request->is('post')) {
            $bonreceptionstock = $this->Bonreceptionstocks->patchEntity($bonreceptionstock, $this->request->getData());
            if ($this->Bonreceptionstocks->save($bonreceptionstock)) {
                $this->Flash->success(__('The {0} has been saved.', 'Bonreceptionstock'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonreceptionstock'));
        }
        $pointdeventes = $this->Bonreceptionstocks->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonreceptionstocks->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonreceptionstocks->Materieltransports->find('list', ['limit' => 200]);
        $cartecarburants = $this->Bonreceptionstocks->Cartecarburants->find('list', ['limit' => 200]);
        $personnels = $this->Bonreceptionstocks->Personnels->find('list', ['limit' => 200]);
        $conffaieurs = $this->Bonreceptionstocks->Conffaieurs->find('list', ['limit' => 200]);
        $chauffeurs = $this->Bonreceptionstocks->Chauffeurs->find('list', ['limit' => 200]);
        $this->set(compact('bonreceptionstock', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'personnels', 'conffaieurs', 'chauffeurs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Bonreceptionstock id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bonreceptionstock = $this->Bonreceptionstocks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bonreceptionstock = $this->Bonreceptionstocks->patchEntity($bonreceptionstock, $this->request->getData());
            if ($this->Bonreceptionstocks->save($bonreceptionstock)) {
                $this->Flash->success(__('The {0} has been saved.', 'Bonreceptionstock'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonreceptionstock'));
        }
        $pointdeventes = $this->Bonreceptionstocks->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonreceptionstocks->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonreceptionstocks->Materieltransports->find('list', ['limit' => 200]);
        $cartecarburants = $this->Bonreceptionstocks->Cartecarburants->find('list', ['limit' => 200]);
        $personnels = $this->Bonreceptionstocks->Personnels->find('list', ['limit' => 200]);
        $conffaieurs = $this->Bonreceptionstocks->Conffaieurs->find('list', ['limit' => 200]);
        $chauffeurs = $this->Bonreceptionstocks->Chauffeurs->find('list', ['limit' => 200]);
        $this->set(compact('bonreceptionstock', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'personnels', 'conffaieurs', 'chauffeurs'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Bonreceptionstock id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bonreceptionstock = $this->Bonreceptionstocks->get($id);
        if ($this->Bonreceptionstocks->delete($bonreceptionstock)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Bonreceptionstock'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Bonreceptionstock'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

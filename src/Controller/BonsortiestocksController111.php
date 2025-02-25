<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Bonsortiestocks Controller
 *
 * @property \App\Model\Table\BonsortiestocksTable $Bonsortiestocks
 * @method \App\Model\Entity\Bonsortiestock[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BonsortiestocksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Pointdeventes', 'Materieltransports', 'Cartecarburants'],
        ];
        $bonsortiestocks = $this->paginate($this->Bonsortiestocks);

        $this->set(compact('bonsortiestocks'));
    }

    /**
     * View method
     *
     * @param string|null $id Bonsortiestock id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bonsortiestock = $this->Bonsortiestocks->get($id, [
            'contain' => ['Pointdeventes', 'Depotarrives', 'Depotdeparts', 'Materieltransports', 'Cartecarburants', 'Conffaieurs', 'Chauffeurs', 'Lignebonsortiestocks'],
        ]);

        $this->set(compact('bonsortiestock'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bonsortiestock = $this->Bonsortiestocks->newEmptyEntity();
        if ($this->request->is('post')) {
            $bonsortiestock = $this->Bonsortiestocks->patchEntity($bonsortiestock, $this->request->getData());
            if ($this->Bonsortiestocks->save($bonsortiestock)) {
                $this->Flash->success(__('The {0} has been saved.', 'Bonsortiestock'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonsortiestock'));
        }
        $pointdeventes = $this->Bonsortiestocks->Pointdeventes->find('list', ['limit' => 200]);
        $depotarrives = $this->Bonsortiestocks->Depotarrives->find('list', ['limit' => 200]);
        $depotdeparts = $this->Bonsortiestocks->Depotdeparts->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonsortiestocks->Materieltransports->find('list', ['limit' => 200]);
        $cartecarburants = $this->Bonsortiestocks->Cartecarburants->find('list', ['limit' => 200]);
        $conffaieurs = $this->Bonsortiestocks->Conffaieurs->find('list', ['limit' => 200]);
        $chauffeurs = $this->Bonsortiestocks->Chauffeurs->find('list', ['limit' => 200]);
        $this->set(compact('bonsortiestock', 'pointdeventes', 'depotarrives', 'depotdeparts', 'materieltransports', 'cartecarburants', 'conffaieurs', 'chauffeurs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Bonsortiestock id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bonsortiestock = $this->Bonsortiestocks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bonsortiestock = $this->Bonsortiestocks->patchEntity($bonsortiestock, $this->request->getData());
            if ($this->Bonsortiestocks->save($bonsortiestock)) {
                $this->Flash->success(__('The {0} has been saved.', 'Bonsortiestock'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonsortiestock'));
        }
        $pointdeventes = $this->Bonsortiestocks->Pointdeventes->find('list', ['limit' => 200]);
        $depotarrives = $this->Bonsortiestocks->Depotarrives->find('list', ['limit' => 200]);
        $depotdeparts = $this->Bonsortiestocks->Depotdeparts->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonsortiestocks->Materieltransports->find('list', ['limit' => 200]);
        $cartecarburants = $this->Bonsortiestocks->Cartecarburants->find('list', ['limit' => 200]);
        $conffaieurs = $this->Bonsortiestocks->Conffaieurs->find('list', ['limit' => 200]);
        $chauffeurs = $this->Bonsortiestocks->Chauffeurs->find('list', ['limit' => 200]);
        $this->set(compact('bonsortiestock', 'pointdeventes', 'depotarrives', 'depotdeparts', 'materieltransports', 'cartecarburants', 'conffaieurs', 'chauffeurs'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Bonsortiestock id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bonsortiestock = $this->Bonsortiestocks->get($id);
        if ($this->Bonsortiestocks->delete($bonsortiestock)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Bonsortiestock'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Bonsortiestock'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

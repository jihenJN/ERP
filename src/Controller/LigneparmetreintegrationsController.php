<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ligneparmetreintegrations Controller
 *
 * @property \App\Model\Table\LigneparmetreintegrationsTable $Ligneparmetreintegrations
 * @method \App\Model\Entity\Ligneparmetreintegration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LigneparmetreintegrationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($type = null)
    {

        $parmetreintegrations = $this->fetchTable('Parmetreintegrations')->find('all')->contain(['Journals']);
       
       // debug($parmetreintegrations);

        $this->paginate = [
            'contain' => [],
        ];

        $condtyp = "Ligneparmetreintegrations.type=" . $type;

        $ligneparmetreintegrations = $this->Ligneparmetreintegrations->find('all')->where([$condtyp])
        ->order(['Ligneparmetreintegrations.id' => 'DESC'])
        ->contain(['Journals']);

        $this->set(compact('ligneparmetreintegrations','parmetreintegrations'));
    }

    /**
     * View method
     *
     * @param string|null $id Ligneparmetreintegration id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ligneparmetreintegration = $this->Ligneparmetreintegrations->get($id, [
            'contain' => ['Natures'],
        ]);

        $this->set(compact('ligneparmetreintegration'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ligneparmetreintegration = $this->Ligneparmetreintegrations->newEmptyEntity();
        if ($this->request->is('post')) {
            $ligneparmetreintegration = $this->Ligneparmetreintegrations->patchEntity($ligneparmetreintegration, $this->request->getData());
            if ($this->Ligneparmetreintegrations->save($ligneparmetreintegration)) {
               /// $this->Flash->success(__('The {0} has been saved.', 'Ligneparmetreintegration'));

                return $this->redirect(['action' => 'index']);
            }
          ///  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ligneparmetreintegration'));
        }
        $natures = $this->Ligneparmetreintegrations->Natures->find('list', ['limit' => 200]);
        $this->set(compact('ligneparmetreintegration', 'natures'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Ligneparmetreintegration id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ligneparmetreintegration = $this->Ligneparmetreintegrations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ligneparmetreintegration = $this->Ligneparmetreintegrations->patchEntity($ligneparmetreintegration, $this->request->getData());
            if ($this->Ligneparmetreintegrations->save($ligneparmetreintegration)) {
                $this->Flash->success(__('The {0} has been saved.', 'Ligneparmetreintegration'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ligneparmetreintegration'));
        }
        $natures = $this->Ligneparmetreintegrations->Natures->find('list', ['limit' => 200]);
        $this->set(compact('ligneparmetreintegration', 'natures'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Ligneparmetreintegration id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ligneparmetreintegration = $this->Ligneparmetreintegrations->get($id);
        if ($this->Ligneparmetreintegrations->delete($ligneparmetreintegration)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Ligneparmetreintegration'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Ligneparmetreintegration'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

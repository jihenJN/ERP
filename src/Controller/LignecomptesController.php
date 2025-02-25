<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignecomptes Controller
 *
 * @property \App\Model\Table\LignecomptesTable $Lignecomptes
 * @method \App\Model\Entity\Lignecompte[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignecomptesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Typecredits', 'Comptes'],
        ];
        $lignecomptes = $this->paginate($this->Lignecomptes);

        $this->set(compact('lignecomptes'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignecompte id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignecompte = $this->Lignecomptes->get($id, [
            'contain' => ['Typecredits', 'Comptes'],
        ]);

        $this->set(compact('lignecompte'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignecompte = $this->Lignecomptes->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignecompte = $this->Lignecomptes->patchEntity($lignecompte, $this->request->getData());
            if ($this->Lignecomptes->save($lignecompte)) {
                $this->Flash->success(__('The lignecompte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignecompte could not be saved. Please, try again.'));
        }
        $typecredits = $this->Lignecomptes->Typecredits->find('list', ['limit' => 200])->all();
        $comptes = $this->Lignecomptes->Comptes->find('list', ['limit' => 200])->all();
        $this->set(compact('lignecompte', 'typecredits', 'comptes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lignecompte id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignecompte = $this->Lignecomptes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignecompte = $this->Lignecomptes->patchEntity($lignecompte, $this->request->getData());
            if ($this->Lignecomptes->save($lignecompte)) {
                $this->Flash->success(__('The lignecompte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignecompte could not be saved. Please, try again.'));
        }
        $typecredits = $this->Lignecomptes->Typecredits->find('list', ['limit' => 200])->all();
        $comptes = $this->Lignecomptes->Comptes->find('list', ['limit' => 200])->all();
        $this->set(compact('lignecompte', 'typecredits', 'comptes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lignecompte id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignecompte = $this->Lignecomptes->get($id);
        if ($this->Lignecomptes->delete($lignecompte)) {
            $this->Flash->success(__('The lignecompte has been deleted.'));
        } else {
            $this->Flash->error(__('The lignecompte could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function verif()
    {
        $id = $this->request->getQuery('id');
       
    
        // $Lignetickets = $this->fetchTable('Lignetickets')->find('all')->where(['Lignetickets.ticketvente_id =' . $id])->count();
       //  $Ticketventes1 = $this->fetchTable('Factureclients')->find('list')->where(['Factureclients.ticketvente_id=' .$id])->count();
       if($id){
         $Types = $this->fetchTable('Lignecomptes')->find('all')->where(['Lignecomptes.typecredit_id='.$id])->count();
       }
        echo json_encode(array('Types' =>  $Types));
        die;
    
    }


  
    
}

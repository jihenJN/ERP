<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Banques Controller
 *
 * @property \App\Model\Table\BanquesTable $Banques
 * @method \App\Model\Entity\Banque[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BanquesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $banques = $this->paginate($this->Banques);

        $this->set(compact('banques'));
    }

    /**
     * View method
     *
     * @param string|null $id Banque id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $banque = $this->Banques->get($id, [
            'contain' => ['Clientbanques', 'Fournisseurbanques'],
        ]);

        $this->set(compact('banque'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $banque = $this->Banques->newEmptyEntity();
        if ($this->request->is('post')) {
            $banque = $this->Banques->patchEntity($banque, $this->request->getData());
            if ($this->Banques->save($banque)) {
                // $this->Flash->success(__('The {0} has been saved.', 'Banque'));

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Banque'));
        }
        $this->set(compact('banque'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Banque id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $banque = $this->Banques->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $banque = $this->Banques->patchEntity($banque, $this->request->getData());
            if ($this->Banques->save($banque)) {
                // $this->Flash->success(__('The {0} has been saved.', 'Banque'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Banque'));
        }
        $this->set(compact('banque'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Banque id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $banque = $this->Banques->get($id);
        if ($this->Banques->delete($banque)) {
            //$this->Flash->success(__('The {0} has been deleted.', 'Banque'));
        } else {
            //  $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Banque'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // public function getbanque($id = null)
    // {
    //     $this->loadModel('Clientbanques');
    //     $this->loadModel('Comptes');
    //     $id = $this->request->getQuery('idbanque');
        
    //     $clientBanquesCount = $this->Clientbanques->find()->where(['Clientbanques.banque_id' => $id])->count();
    //     $comptesCount = $this->Comptes->find()->where(['Comptes.banque_id' => $id])->count();
        
    //     $totalCount = $clientBanquesCount + $comptesCount;
        
    //     echo json_encode(array("query" => $totalCount, "success" => true));
    //     die;
    // }

    public function verifbanquesup()
    {
        $id = $this->request->getQuery('id');

        // Initialize the total count
        $totalArticles = 0;

        // Sum counts from different tables
        
        $totalArticles += $this->fetchTable('Clientbanques')->find('all')->where(['Clientbanques.banque_id' => $id])->count();

        $totalArticles += $this->fetchTable('Comptes')->find('all')->where(['Comptes.banque_id' => $id])->count();
       
        echo json_encode(['Comptes' => $totalArticles]);
        die;
    }
    
}

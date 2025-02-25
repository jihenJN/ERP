<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tracemisejours Controller
 *
 * @property \App\Model\Table\TracemisejoursTable $Tracemisejours
 * @method \App\Model\Entity\Tracemisejour[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TracemisejoursController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        
        $model = $this->request->getQuery('model');
        $operation = $this->request->getQuery('operation');
        $user_id = $this->request->getQuery('user_id');
        $historiquede=$this->request->getQuery('historiquede');
        $au=$this->request->getQuery('au');
    
        $cond1 = '';
		$cond2 = '';
        $cond3 = '';
		$cond4 = '';
        $cond5 = '';
        if ($model) {
            $cond1 = "Tracemisejours.model like  '%" . $model . "%' ";
        }
        if ($operation) {
            $cond2 = "Tracemisejours.operation   like  '%" . $operation . "%' ";
        }
        if ($user_id) {
            $cond3 = "Tracemisejours.user_id   =  '" . $user_id . "' ";
        } 
        if ($historiquede) {
            $cond2="Tracemisejours.date >= '".$historiquede."'";
        }
       if ($au) {
           $cond3= "Tracemisejours.date <='".$au."'";
       }

        $query = $this->Tracemisejours->find('all')->where([$cond1, $cond2,$cond3,$cond4,$cond5])->contain(['Utilisateurs','Users'])->order(["Tracemisejours.id" => 'desc']);
        $tracemisejours = $this->paginate($query);
        $recherches = $this->paginate($query);
        $utilisateurs = $this->Tracemisejours->Utilisateurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $users=$this->Tracemisejours->Users->find('list', ['keyfield' => 'id', 'valueField' => 'login']);
        //debug($utilisateurs);
        $this->paginate = [
            'contain' => ['Utilisateurs','Users'],
        ];
        $this->set(compact('users','utilisateurs','tracemisejours','recherches')); 
    }

    /**
     * View method
     *
     * @param string|null $id Tracemisejour id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tracemisejour = $this->Tracemisejours->get($id, [
            'contain' => ['Utilisateurs'],
        ]);

        $this->set(compact('tracemisejour'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tracemisejour = $this->Tracemisejours->newEmptyEntity();
        if ($this->request->is('post')) {
            $tracemisejour = $this->Tracemisejours->patchEntity($tracemisejour, $this->request->getData());
            if ($this->Tracemisejours->save($tracemisejour)) {
                $this->Flash->success(__('The {0} has been saved.', 'Tracemisejour'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Tracemisejour'));
        }
        $utilisateurs = $this->Tracemisejours->Utilisateurs->find('list', ['limit' => 200]);
        $this->set(compact('tracemisejour', 'utilisateurs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Tracemisejour id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tracemisejour = $this->Tracemisejours->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tracemisejour = $this->Tracemisejours->patchEntity($tracemisejour, $this->request->getData());
            if ($this->Tracemisejours->save($tracemisejour)) {
                $this->Flash->success(__('The {0} has been saved.', 'Tracemisejour'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Tracemisejour'));
        }
        $utilisateurs = $this->Tracemisejours->Utilisateurs->find('list', ['limit' => 200]);
        $this->set(compact('tracemisejour', 'utilisateurs'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Tracemisejour id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tracemisejour = $this->Tracemisejours->get($id);
        if ($this->Tracemisejours->delete($tracemisejour)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Tracemisejour'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Tracemisejour'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

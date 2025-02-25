<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Operations Controller
 *
 * @property \App\Model\Table\OperationsTable $Operations
 * @method \App\Model\Entity\Operation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OperationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Typeoperations'],
        ];
        $operations = $this->paginate($this->Operations);
        $typeoperations = $this->fetchTable('Typeoperations')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('operations','typeoperations'));
    }

    /**
     * View method
     *
     * @param string|null $id Operation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $operation = $this->Operations->get($id, [
            'contain' => [],
        ]);
        $typeoperations = $this->fetchTable('Typeoperations')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('operation','typeoperations'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_finance' . $abrv);
        //  /// debug($liendd);die;
        // $f = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'operations') {
        //         $f = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($f <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // } 
        $operation = $this->Operations->newEmptyEntity();
        if ($this->request->is('post')) {
            $operation = $this->Operations->patchEntity($operation, $this->request->getData());
            if ($this->Operations->save($operation)) {
                //$this->Flash->success(__('The operation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The operation could not be saved. Please, try again.'));
        }
        $typeoperations = $this->fetchTable('Typeoperations')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('operation','typeoperations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Operation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_finance' . $abrv);
        // //   debug($liendd);
        // $ff = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'operations') {
        //         $ff = $liens['modif'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }    
        $operation = $this->Operations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $operation = $this->Operations->patchEntity($operation, $this->request->getData());
            if ($this->Operations->save($operation)) {
               // $this->Flash->success(__('The operation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
          //  $this->Flash->error(__('The operation could not be saved. Please, try again.'));
        }
        $typeoperations = $this->fetchTable('Typeoperations')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('operation','typeoperations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Operation id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_finance' . $abrv);
        // //   debug($liendd);
        // $ff = 0;
        // foreach ($liendd as $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'operations') {
        //         $ff = $liens['delete'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // } 
        //$this->request->allowMethod(['post', 'delete']);
        $operation = $this->Operations->get($id);
       $this->Operations->delete($operation);

        return $this->redirect(['action' => 'index']);
    }

    public function verif()
    {
        $id = $this->request->getQuery('id');
       
    
        // $Lignetickets = $this->fetchTable('Lignetickets')->find('all')->where(['Lignetickets.ticketvente_id =' . $id])->count();
       //  $Ticketventes1 = $this->fetchTable('Factureclients')->find('list')->where(['Factureclients.ticketvente_id=' .$id])->count();
       if($id){
         $Types = $this->fetchTable('Operations')->find('all')->where(['Operations.typeoperation_id='.$id])->count();
       }
    
        echo json_encode(array('Types' =>  $Types));
        die;
    
    }


    
}

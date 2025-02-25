<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typeoperations Controller
 *
 * @property \App\Model\Table\TypeoperationsTable $Typeoperations
 * @method \App\Model\Entity\Typeoperation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypeoperationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typeoperations = $this->paginate($this->Typeoperations);

        $this->set(compact('typeoperations'));
    }

    /**
     * View method
     *
     * @param string|null $id Typeoperation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeoperation = $this->Typeoperations->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('typeoperation'));
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
        //     if (@$liens['lien'] == 'typeoperations') {
        //         $f = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($f <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // } 
        $typeoperation = $this->Typeoperations->newEmptyEntity();
        if ($this->request->is('post')) {
            $typeoperation = $this->Typeoperations->patchEntity($typeoperation, $this->request->getData());
            if ($this->Typeoperations->save($typeoperation)) {
               // $this->Flash->success(__('The typeoperation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            ///$this->Flash->error(__('The typeoperation could not be saved. Please, try again.'));
        }
        $this->set(compact('typeoperation'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Typeoperation id.
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
        //     if (@$liens['lien'] == 'typeoperations') {
        //         $ff = $liens['modif'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }  
        $typeoperation = $this->Typeoperations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typeoperation = $this->Typeoperations->patchEntity($typeoperation, $this->request->getData());
            if ($this->Typeoperations->save($typeoperation)) {
                $this->Flash->success(__('The typeoperation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The typeoperation could not be saved. Please, try again.'));
        }
        $this->set(compact('typeoperation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Typeoperation id.
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
        //     if (@$liens['lien'] == 'typeoperations') {
        //         $ff = $liens['delete'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // } 
       // $this->request->allowMethod(['post', 'delete']);
        $typeoperation = $this->Typeoperations->get($id);
        $this->Typeoperations->delete($typeoperation);

        return $this->redirect(['action' => 'index']);
    }
}

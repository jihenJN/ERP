<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typecredits Controller
 *
 * @property \App\Model\Table\TypecreditsTable $Typecredits
 * @method \App\Model\Entity\Typecredit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypecreditsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    { $this->paginate = [
        'contain' => ['Frequences'],
    ];
        $typecredits = $this->paginate($this->Typecredits);
        $frequences = $this->fetchTable('Frequences')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('typecredits','frequences'));
    }

    /**
     * View method
     *
     * @param string|null $id Typecredit id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typecredit = $this->Typecredits->get($id, [
            'contain' => ['Frequences'],
        ]);
        $frequences = $this->fetchTable('Frequences')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('typecredit','frequences'));
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
        //     if (@$liens['lien'] == 'typecredits') {
        //         $f = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($f <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // } 
        $typecredit = $this->Typecredits->newEmptyEntity();
        if ($this->request->is('post')) {
            $typecredit = $this->Typecredits->patchEntity($typecredit, $this->request->getData());
            if ($this->Typecredits->save($typecredit)) {
               // $this->Flash->success(__('The typecredit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
          //  $this->Flash->error(__('The typecredit could not be saved. Please, try again.'));
        }
        $frequences = $this->fetchTable('Frequences')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('typecredit','frequences'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Typecredit id.
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
        //     if (@$liens['lien'] == 'typecredits') {
        //         $ff = $liens['modif'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }    

        $typecredit = $this->Typecredits->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typecredit = $this->Typecredits->patchEntity($typecredit, $this->request->getData());
            if ($this->Typecredits->save($typecredit)) {
             //   $this->Flash->success(__('The typecredit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
          //  $this->Flash->error(__('The typecredit could not be saved. Please, try again.'));
        }
        $frequences = $this->fetchTable('Frequences')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('typecredit','frequences'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Typecredit id.
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
        //     if (@$liens['lien'] == 'typecredits') {
        //         $ff = $liens['delete'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // } 
        //$this->request->allowMethod(['post', 'delete']);
        $typecredit = $this->Typecredits->get($id);
        $this->Typecredits->delete($typecredit);
           

        return $this->redirect(['action' => 'index']);
    }


    public function verif()
    {
        $id = $this->request->getQuery('id');
       
    
        // $Lignetickets = $this->fetchTable('Lignetickets')->find('all')->where(['Lignetickets.ticketvente_id =' . $id])->count();
       //  $Ticketventes1 = $this->fetchTable('Factureclients')->find('list')->where(['Factureclients.ticketvente_id=' .$id])->count();
       if($id){
         $Frequences = $this->fetchTable('Typecredits')->find('all')->where(['Typecredits.frequence_id='.$id])->count();
       }
        echo json_encode(array('Frequences' =>  $Frequences));
        die;
    
    }
}
 
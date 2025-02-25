<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Etapes Controller
 *
 * @property \App\Model\Table\EtapesTable $Etapes
 * @method \App\Model\Entity\Etape[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EtapesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
     public function index()
    {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        
        
        $personnel_id = $this->request->getQuery('personnel_id');
        $machine_id = $this->request->getQuery('machine_id');
        $rang = $this->request->getQuery('rang');



        if ($personnel_id) {
            $cond1 = "Etapes.personnel_id  =  '" .     $personnel_id . "' ";
        }
        if ($machine_id) {
            $cond2 = "Etapes.machine_id  =  '" .     $machine_id . "' ";
        }
         if ($rang) {
            $cond2 = "Etapes.rang  =  '" .     $rang . "' ";
        }
        $query = $this->Etapes->find('all')->where([$cond1, $cond2, $cond3])->order(["Etapes.id" => 'desc']);
       // dd($query);
        $this->paginate = [
            'contain' => ['Personnels', 'Machines'],
        ];
        $etapes = $this->paginate($query);
           //debug($etapes);


        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->set(compact('etapes', 'machines', 'personnels','personnel_id','machine_id','rang'));
    }
  

    /**
     * View method
     *
     * @param string|null $id Etape id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {$num = $this->Etapes->find()->select(["num" =>
        'MAX(Etapes.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        $etape = $this->Etapes->get($id, [
            'contain' => ['Personnels', 'Machines'],
        ]);
  $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->set(compact('etape','personnels','machines','mm'));
    }
    
    
    
    
    
    

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
          $num = $this->Etapes->find()->select(["num" =>
        'MAX(Etapes.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        $etape = $this->Etapes->newEmptyEntity();
        if ($this->request->is('post')) {
            $etape = $this->Etapes->patchEntity($etape, $this->request->getData());
            if ($this->Etapes->save($etape)) {
               

                return $this->redirect(['action' => 'index']);
            }
           
        }
         $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->set(compact('etape', 'personnels', 'machines','mm'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Etape id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    { $num = $this->Etapes->find()->select(["num" =>
        'MAX(Etapes.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        $etape = $this->Etapes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $etape = $this->Etapes->patchEntity($etape, $this->request->getData());
            if ($this->Etapes->save($etape)) {
              //  $this->Flash->success(__('The etape has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The etape could not be saved. Please, try again.'));
        }
         $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->set(compact('etape', 'personnels', 'machines','mm'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Etape id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $etape = $this->Etapes->get($id);
        if ($this->Etapes->delete($etape)) {
           // $this->Flash->success(__('The etape has been deleted.'));
    } 
    //else {
//            $this->Flash->error(__('The etape could not be deleted. Please, try again.'));
//        }

        return $this->redirect(['action' => 'index']);
    }
}

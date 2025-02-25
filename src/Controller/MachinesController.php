<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Machines Controller
 *
 * @property \App\Model\Table\MachinesTable $Machines
 * @method \App\Model\Entity\Machine[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MachinesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        
       $cond1 = '';
      
        $name = $this->request->getQuery('name');
        


       
        if ($name) {
            $cond1 = "Machines.name  like '%" .     $name . "%' ";
        }


      

        $query = $this->Machines->find('all')->where([$cond1]);
        
        $machines = $this->paginate($query);



        $this->set(compact('machines','name'));
    }  
        
        
  

    /**
     * View method
     *
     * @param string|null $id Machine id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $machine = $this->Machines->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('machine'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {  
        
        $num = $this->Machines->find()->select(["num" =>
        'MAX(Machines.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        //debug($c);
        //debug($code);
        //die;
        $machine = $this->Machines->newEmptyEntity();
       if ($this->request->is('post')) {
            $machine = $this->Machines->patchEntity($machine, $this->request->getData());
            $num = $this->Machines->find()->select(["num" =>
            'MAX(Machines.numero)'])->first();
            // debug($num);
            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            //debug($in);
            $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
            //debug($c);
            $machine->numero==$mm;
            //debug($this->request->getData());die;
            if ($this->Machines->save($machine)) {
                $machine_id = ($this->Machines->save($machine)->id);
                $this->misejour("Machine", "add", $machine_id);

               // debug($this->Machines->save($machine));die;
              //  $this->Flash->success(__('The machine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The machine could not be saved. Please, try again.'));
        }
           
     $this->set(compact('machine','mm'));    }

        
    /**
     * Edit method
     *
     * @param string|null $id Machine id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $machine = $this->Machines->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $machine = $this->Machines->patchEntity($machine, $this->request->getData());
            if ($this->Machines->save($machine)) {
                $machine_id = ($this->Machines->save($machine)->id);
                $this->misejour("Machine", "edit", $machine_id);

              //  $this->Flash->success(__('The machine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The machine could not be saved. Please, try again.'));
        }
        $this->set(compact('machine'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Machine id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $machine = $this->Machines->get($id);
        if ($this->Machines->delete($machine)) {
            $machine_id = ($this->Machines->save($machine)->id);
            $this->misejour("Machine", "delete", $machine_id);

           // $this->Flash->success(__('The machine has been deleted.'));
        } else {
           // $this->Flash->error(__('The machine could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

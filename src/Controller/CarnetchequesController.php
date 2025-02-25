<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Carnetcheques Controller
 *
 * @property \App\Model\Table\CarnetchequesTable $Carnetcheques
 * @method \App\Model\Entity\Carnetcheque[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CarnetchequesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Comptes'],
        ];
        $carnetcheques = $this->paginate($this->Carnetcheques);
        $comptes = $this->Carnetcheques->Comptes->find('list', ['keyField' => 'id', 'valueField' => 'numero'])->all();
        $comptes = $this->Carnetcheques->Comptes->find('list', ['contain'=>['Agences'],
            'keyField' => 'id',
            'valueField' => function ($compte) {
                return "{$compte->numero} {$compte->agence->name} ";
            }
        ]);
        $this->set(compact('carnetcheques','comptes'));
    }

    /**
     * View method
     *
     * @param string|null $id Carnetcheque id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $carnetcheque = $this->Carnetcheques->get($id, [
            'contain' => ['Comptes', 'Piecereglements'],
        ]);
        //$comptes = $this->Carnetcheques->Comptes->find('list', ['keyField' => 'id', 'valueField' => 'numero'])->all();
        $comptes = $this->Carnetcheques->Comptes->find('list', ['contain'=>['Agences'],
        'keyField' => 'id',
        'valueField' => function ($compte) {
            return "{$compte->numero} {$compte->agence->name} ";
        }
    ]);
        $this->set(compact('carnetcheque','comptes'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
                 $num = $this->Carnetcheques->find()->select(["num" =>
           'MAX(Carnetcheques.numero)'])->first();
           // debug($num);
           $n = $num->num;
           // $int=intval($n);
           $in = intval($n) + 1;
           //debug($in);
           $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        $carnetcheque = $this->Carnetcheques->newEmptyEntity();
        if ($this->request->is('post')) {
            $carnetcheque = $this->Carnetcheques->patchEntity($carnetcheque, $this->request->getData());
            if ($this->Carnetcheques->save($carnetcheque)) {
               // $this->Flash->success(__('The carnetcheque has been saved.'));
               $id=$carnetcheque->id; 
               $debut=$carnetcheque->debut;
               $taille=$carnetcheque->taille;
               $nombre=$carnetcheque->nombre;
               for ($i = $debut; $i <  ((float)$debut+(float)$nombre); $i++) {
                   
                    $cheque['carnetcheque_id']=$id;
                    $cheque['numero']=str_pad(strval($i), $taille , "0", STR_PAD_LEFT);
                         $chequee=$this->fetchTable('Cheques')->newEmptyEntity();
                         $chequee=$this->fetchTable('Cheques')->patchEntity($chequee,$cheque);
                         $this->fetchTable('Cheques')->save($chequee); 
                         
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The carnetcheque could not be saved. Please, try again.'));
        }
        $comptes = $this->Carnetcheques->Comptes->find('list', ['keyField' => 'id', 'valueField' => 'numero'])->all();
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $comptes = $this->Carnetcheques->Comptes->find('list', ['contain'=>['Agences'],
        'keyField' => 'id',
        'valueField' => function ($compte) {
            return "{$compte->numero} {$compte->agence->name} ";
        }
    ]);
        $this->set(compact('carnetcheque', 'comptes','banques','mm'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Carnetcheque id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $carnetcheque = $this->Carnetcheques->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $carnetcheque = $this->Carnetcheques->patchEntity($carnetcheque, $this->request->getData());
            if ($this->Carnetcheques->save($carnetcheque)) {
                $id=$carnetcheque->id; 
                $debut=$carnetcheque->debut;
                $taille=$carnetcheque->taille;
                $nombre=$carnetcheque->nombre;
                 $lignecheques = $this->FetchTable('Cheques')->find('all')->where(['Cheques.carnetcheque_id'=>$id]);
        $this->fetchTable('Cheques')->deleteMany($lignecheques);
                for ($i = $debut; $i <  ((float)$debut+(float)$nombre); $i++) {
                    
                     $cheque['carnetcheque_id']=$id;
                     $cheque['numero']=str_pad(strval($i), $taille , "0", STR_PAD_LEFT);
                          $chequee=$this->fetchTable('Cheques')->newEmptyEntity();
                          $chequee=$this->fetchTable('Cheques')->patchEntity($chequee,$cheque);
                          $this->fetchTable('Cheques')->save($chequee); 
                          
                 }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The carnetcheque could not be saved. Please, try again.'));
        }
        $comptes = $this->Carnetcheques->Comptes->find('list', ['keyField' => 'id', 'valueField' => 'numero'])->all();
        $comptes = $this->Carnetcheques->Comptes->find('list', ['contain'=>['Agences'],
        'keyField' => 'id',
        'valueField' => function ($compte) {
            return "{$compte->numero} {$compte->agence->name} ";
        }
    ]);
        $this->set(compact('carnetcheque', 'comptes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Carnetcheque id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $carnetcheque = $this->Carnetcheques->get($id);
      
        if ($this->Carnetcheques->delete($carnetcheque)) {
            $lignecheques = $this->FetchTable('Cheques')->find('all')->where(['Cheques.carnetcheque_id'=>$id]);
            $this->fetchTable('Cheques')->deleteMany($lignecheques);
          //  $this->Flash->success(__('The carnetcheque has been deleted.'));
        } else {
          //  $this->Flash->error(__('The carnetcheque could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

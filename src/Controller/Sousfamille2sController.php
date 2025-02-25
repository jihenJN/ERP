<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Sousfamille2s Controller
 *
 * @property \App\Model\Table\Sousfamille2sTable $Sousfamille2s
 * @method \App\Model\Entity\Sousfamille2[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class Sousfamille2sController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $name = $this->request->getQuery('name');
        $sousfamille1_id = $this->request->getQuery('sousfamille1_id');
        $famille_id = $this->request->getQuery('famille_id');
       // debug($sousfamille1_id);


        if ($name) {

            $cond1 = "Sousfamille2s.name  =  '" . $name . "' ";
        }
        if ($sousfamille1_id) {
            $cond2 = "Sousfamille2s.sousfamille1_id  = '" . $sousfamille1_id . "' ";
        }
      if ($famille_id) 
        {
          $condfam = "Sousfamille1s.famille_id= '" . $famille_id . "' ";
      $familles=$this->fetchTable('Sousfamille1s')->find('all')->where([@$condfam]);
    $det1 = '';
           foreach ($familles as $i=>$fam){

                $det1 = $det1 . ',' . $fam->id;
            }
$dett= substr($det1,1);
    
            $cond3 = 'Sousfamille2s.sousfamille1_id in(' . $dett . ')';
        }
        
  //    debug($cond3)  ;die;
        
        
        
        $query = $this->Sousfamille2s->find('all')->where([$cond1, $cond2,$cond3 ])->order(["Sousfamille2s.id" => 'desc']);
        // debug($query);
        $this->paginate = [
            'contain' => ['Sousfamille1s'],
        ];


        $sousfamille2s = $this->paginate($query);


        $sousfamille1s = $this->Sousfamille2s->Sousfamille1s->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $familles=$this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);

        $this->set(compact('sousfamille1s', 'sousfamille2s','familles'));



        // $this->paginate = [
        //     'contain' => ['Sousfamille1s'],
        // ];
        // $sousfamille2s = $this->paginate($this->Sousfamille2s);
        // $sousfamille1s = $this->Sousfamille2s->Sousfamille1s->find('list', ['limit' => 200]);
        // $this->set(compact('sousfamille2s', 'sousfamille1s'));
    }

    /**
     * View method
     *
     * @param string|null $id Sousfamille2 id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $sousfamille2 = $this->Sousfamille2s->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sousfamille2 = $this->Sousfamille2s->patchEntity($sousfamille2, $this->request->getData());
            if ($this->Sousfamille2s->save($sousfamille2)) {
                $this->Flash->success(__('The {0} has been saved.', 'Sousfamille2'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Sousfamille2'));
        }
        $sousfamille1s = $this->Sousfamille2s->Sousfamille1s->find('list', ['limit' => 200]);
        $this->set(compact('sousfamille2', 'sousfamille1s'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
       $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'sousousfamille') {
                $societe = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $sousfamille2 = $this->Sousfamille2s->newEmptyEntity();
        if ($this->request->is('post')) {
            $sousfamille2 = $this->Sousfamille2s->patchEntity($sousfamille2, $this->request->getData());
            if ($this->Sousfamille2s->save($sousfamille2)) {
                $sousfamille2_id = ($this->Sousfamille2s->save($sousfamille2)->id);
                $this->misejour("Sousfamille2s", "add", $sousfamille2_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $sousfamille1s = $this->Sousfamille2s->Sousfamille1s->find('list', ['limit' => 200]);
        $this->set(compact('sousfamille2', 'sousfamille1s'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sousfamille2 id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'sousousfamille') {
                $societe = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $sousfamille2 = $this->Sousfamille2s->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sousfamille2 = $this->Sousfamille2s->patchEntity($sousfamille2, $this->request->getData());
            if ($this->Sousfamille2s->save($sousfamille2)) {
                $sousfamille2_id = ($this->Sousfamille2s->save($sousfamille2)->id);
                $this->misejour("Sousfamille2s", "edit", $sousfamille2_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $sousfamille1s = $this->Sousfamille2s->Sousfamille1s->find('list', ['limit' => 200]);
        $this->set(compact('sousfamille2', 'sousfamille1s'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sousfamille2 id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
         $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'sousousfamille') {
                $societe = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
       // $this->request->allowMethod(['post', 'delete']);
        $sousfamille2 = $this->Sousfamille2s->get($id);
        if ($this->Sousfamille2s->delete($sousfamille2)) {
            $sousfamille2_id = ($this->Sousfamille2s->save($sousfamille2)->id);
            $this->misejour("Sousfamille2s", "delete", $sousfamille2_id);
        } else {
            
        }

        return $this->redirect(['action' => 'index']);
    }

    public function verif() {
        $id = $this->request->getQuery('idfam');
        $familles = $this->fetchTable('Articles')->find('all')->where(['Articles.sousfamille2_id=' . $id])->count();
        echo json_encode(array('familles' => $familles));
        die;
    }

}

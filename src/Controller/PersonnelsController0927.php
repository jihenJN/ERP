<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Personnels Controller
 *
 * @property \App\Model\Table\PersonnelsTable $Personnels
 * @method \App\Model\Entity\Personnel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PersonnelsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $fonction_id = $this->request->getQuery('fonction_id');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $nom = $this->request->getQuery('nom');
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        if ($fonction_id) {
            $cond1 = "Personnels.fonction_id like  '%" . $fonction_id . "%' ";
        }
        if ($pointdevente_id) {
            $cond2 = "Personnels.pointdevente_id   like  '%" . $pointdevente_id . "%' ";
        }
        if ($nom) {
            $cond3 = "Personnels.nom   like  '%" . $nom . "%' ";
        }
        $query = $this->Personnels->find('all')->where([$cond1, $cond2, $cond3]);
        $this->paginate = [
            'contain' => ['Fonctions', 'Sexes', 'Situationfamiliales', 'Typecontrats', 'Pointdeventes'],
        ];
        $personnel = $this->paginate($query);
        $fonctions = $this->Personnels->Fonctions->find('list', ['limit' => 200]);
        $sexes = $this->Personnels->Sexes->find('list', ['limit' => 200]);
        $situationfamiliales = $this->Personnels->Situationfamiliales->find('list', ['limit' => 200]);
        $typecontrats = $this->Personnels->Typecontrats->find('list', ['limit' => 200]);
        $pointdeventes = $this->Personnels->Pointdeventes->find('list', ['limit' => 200]);
        $this->set(compact('personnel', 'fonctions', 'pointdeventes'));
    }

    /**
     * View method
     *
     * @param string|null $id Personnel id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personnel = $this->Personnels->get($id, [
            'contain' => ['Fonctions', 'Sexes', 'Situationfamiliales', 'Typecontrats', 'Pointdeventes', 'Bonreceptionstocks', 'Users', 'Utilisateurs'],
        ]);
        $fonctions = $this->Personnels->Fonctions->find('list', ['limit' => 200]);
        $sexes = $this->Personnels->Sexes->find('list', ['limit' => 200]);
        $situationfamiliales = $this->Personnels->Situationfamiliales->find('list', ['limit' => 200]);
        $typecontrats = $this->Personnels->Typecontrats->find('list', ['limit' => 200]);
        $pointdeventes = $this->Personnels->Pointdeventes->find('list', ['limit' => 200]);
        $this->set(compact('personnel', 'fonctions', 'sexes', 'situationfamiliales', 'typecontrats', 'pointdeventes'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $personnel = $this->Personnels->newEmptyEntity();
        if ($this->request->is('post')) {
            $personnel = $this->Personnels->patchEntity($personnel, $this->request->getData());
            if ($this->Personnels->save($personnel)) {
                $personnel_id = ($this->Personnels->save($personnel)->id);
                $this->misejour("Personnels", "add", $personnel_id);
                $this->Flash->success(__('The {0} has been saved.', 'Personnel'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Personnel'));
        }
        $fonctions = $this->Personnels->Fonctions->find('list', ['limit' => 200]);
        $sexes = $this->Personnels->Sexes->find('list', ['limit' => 200]);
        $situationfamiliales = $this->Personnels->Situationfamiliales->find('list', ['limit' => 200]);
        $typecontrats = $this->Personnels->Typecontrats->find('list', ['limit' => 200]);
        $pointdeventes = $this->Personnels->Pointdeventes->find('list', ['limit' => 200]);
        
        $numeroobj = $this->Personnels->find()->select (["numerox"=>
            'MAX(Personnels.code)'])->first();
        $numero=$numeroobj->numerox;
        if($numero!=null){
           // debug($numero);
           
                $n = $numero;
              
                    $lastnum = $n;
                    $nume = intval($lastnum) + 1;
                    $nn=(string)$nume;
                 
                    $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
                 //debug($code);die;
            
        }
        else {
            $code = "00001";
        }
          // debug($code)   ;die;  
                
        //debug($numeroobj->numerox);die();             
        $this->set(compact('personnel', 'fonctions', 'sexes', 'situationfamiliales', 'typecontrats', 'pointdeventes','code'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Personnel id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $personnel = $this->Personnels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $personnel = $this->Personnels->patchEntity($personnel, $this->request->getData());
            if ($this->Personnels->save($personnel)) {
                $personnel_id = ($this->Personnels->save($personnel)->id);
                $this->misejour("Personnels", "edit", $personnel_id);
                $this->Flash->success(__('The {0} has been saved.', 'Personnel'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Personnel'));
        }
        $fonctions = $this->Personnels->Fonctions->find('list', ['limit' => 200]);
        $sexes = $this->Personnels->Sexes->find('list', ['limit' => 200]);
        $situationfamiliales = $this->Personnels->Situationfamiliales->find('list', ['limit' => 200]);
        $typecontrats = $this->Personnels->Typecontrats->find('list', ['limit' => 200]);
        $pointdeventes = $this->Personnels->Pointdeventes->find('list', ['limit' => 200]);
        $this->set(compact('personnel', 'fonctions', 'sexes', 'situationfamiliales', 'typecontrats', 'pointdeventes'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Personnel id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $personnel = $this->Personnels->get($id);
        if ($this->Personnels->delete($personnel)) {
            $personnel_id = ($this->Personnels->save($personnel)->id);
                $this->misejour("Personnels", "delete", "code");
            $this->Flash->success(__('The {0} has been deleted.', 'Personnel'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Personnel'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

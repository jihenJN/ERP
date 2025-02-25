<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Pointdeventes Controller
 *
 * @property \App\Model\Table\PointdeventesTable $Pointdeventes
 * @method \App\Model\Entity\Pointdevente[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PointdeventesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $code = $this->request->getQuery('code');
        $name = $this->request->getQuery('name');
        $adresse = $this->request->getQuery('adresse');
        $ville_id = $this->request->getQuery('ville_id');
        $matriclefiscale = $this->request->getQuery('matriclefiscale');
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        if ($code) {
            $cond1 = "Pointdeventes.code like  '%" . $code . "%' ";
        }
        if ($name) {
            $cond2 = "Pointdeventes.name   like  '%" . $name . "%' ";
        }
        if ($adresse) {
            $cond3 = "Pointdeventes.adresse   like  '%" . $adresse . "%' ";
        }
        if ($ville_id) {
            $cond4 = "Pointdeventes.ville_id   like  '%" . $ville_id . "%' ";
        }
        if ($matriclefiscale) {
            $cond5 = "Pointdeventes.matriclefiscale   like  '%" . $matriclefiscale . "%' ";
        }
        $query = $this->Pointdeventes->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5])->order(["Pointdeventes.id" => 'desc']);
        $this->paginate = [
            'contain' => [],
        ];
        $pointdeventes = $this->paginate($query);
        //$villes = $this->Pointdeventes->Villes->find('list', ['limit' => 200]);
        $this->set(compact('pointdeventes'));
    }

    /**
     * View method
     *
     * @param string|null $id Pointdevente id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pointdevente = $this->Pointdeventes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pointdevente = $this->Pointdeventes->patchEntity($pointdevente, $this->request->getData());
            if ($this->Pointdeventes->save($pointdevente)) {
                $pointdevente_id = ($this->Pointdeventes->save($pointdevente)->id);
                $this->misejour("Pointdeventes", "edit", $pointdevente_id);


                return $this->redirect(['action' => 'index']);
            }
        }
       // $villes = $this->Pointdeventes->Villes->find('list', ['limit' => 200]);
        $this->set(compact('pointdevente', 'villes'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_parametrage' . $abrv);

        // //   debug($liendd);
        // $pointdevente = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'pointdeventes') {
        //         $pointdevente = $liens['ajout'];
        //     }
        // }
        // if (($pointdevente <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }


        $pointdevente = $this->Pointdeventes->newEmptyEntity();
        if ($this->request->is('post')) {
            $pointdevente = $this->Pointdeventes->patchEntity($pointdevente, $this->request->getData());
            if ($this->Pointdeventes->save($pointdevente)) {
                $pointdevente_id = ($this->Pointdeventes->save($pointdevente)->id);
                $this->misejour("Pointdeventes", "add", $pointdevente_id);


                return $this->redirect(['action' => 'index']);
            }
        }

       /// $villes = $this->Pointdeventes->Villes->find('list', ['limit' => 200]);
        $numeroobj = $this->Pointdeventes->find()->select(["numerox" =>
        'MAX(Pointdeventes.code)'])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            // debug($numero);
            $n = $numero;
            $lastnum = $n;

            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
        } else {
            $code = "00001";
        }
        // debug($code)   ;die;  


        $this->set(compact('pointdevente',  'code'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Pointdevente id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_parametrage' . $abrv);

        // //   debug($liendd);
        // $pointdevente = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'pointdeventes') {
        //         $pointdevente = $liens['modif'];
        //     }
        // }
        // if (($pointdevente <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        $pointdevente = $this->Pointdeventes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pointdevente = $this->Pointdeventes->patchEntity($pointdevente, $this->request->getData());
            if ($this->Pointdeventes->save($pointdevente)) {
                $pointdevente_id = ($this->Pointdeventes->save($pointdevente)->id);
                $this->misejour("Pointdeventes", "edit", $pointdevente_id);


                return $this->redirect(['action' => 'index']);
            }
        }
       /// $villes = $this->Pointdeventes->Villes->find('list', ['limit' => 200]);
        $this->set(compact('pointdevente'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Pointdevente id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_parametrage' . $abrv);

        // //   debug($liendd);
        // $pointdevente = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'pointdeventes') {
        //         $pointdevente = $liens['supp'];
        //     }
        // }
        // if (($pointdevente <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        $this->request->allowMethod(['post', 'delete']);
        $pointdevente = $this->Pointdeventes->get($id);
        if ($this->Pointdeventes->delete($pointdevente)) {
            $pointdevente_id = ($this->Pointdeventes->save($pointdevente)->id);
            $this->misejour("Pointdeventes", "delete", "code");
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

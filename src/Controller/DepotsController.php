<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Depots Controller
 *
 * @property \App\Model\Table\DepotsTable $Depots
 * @method \App\Model\Entity\Depot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DepotsController extends AppController
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
        $cond4 = '';
        $cond5 = '';
        $code = $this->request->getQuery('code');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $name = $this->request->getQuery('name');
        $matriclefiscale = $this->request->getQuery('matriclefiscale');
        $adresse = $this->request->getQuery('adresse');


        if ($code) {
            $cond1 = "Depots.name =  '" . $code . "' ";
        }
        if ($pointdevente_id) {
            $cond3 = "Depots.pointdevente_id  =  '" .     $pointdevente_id . "' ";
        }


        if ($name) {
            $cond4 = "Depots.name  = '" . $name . "' ";
        }


        if ($matriclefiscale) {
            $cond2 = "Depots.matriclefiscale =  '" .  $matriclefiscale . "' ";
        }
        if ($adresse) {
            $cond5 = "Depots.adresse   =  '" . $adresse . "' ";
        }

        $query = $this->Depots->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5])->order(["Depots.id" => 'desc']);
        $this->paginate = [
            'contain' => ['Pointdeventes'],
        ];
        $depots = $this->paginate($query);


        $pointdeventes = $this->Depots->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('depots', 'pointdeventes'));
    }

    /**
     * View method
     *
     * @param string|null $id Depot id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $depot = $this->Depots->get($id, [
            'contain' => ['Pointdeventes', 'Bondechargements', 'Bondereservations', 'Bonlivraisons', 'Bonreceptionstocks', 'Commandeclients', 'Commandes', 'Factureclients', 'Factures', 'Inventaires','Livraisons', 'Livraisonsanc', 'Users', 'Utilisateurs'],
        ]);
        $pointdeventes = $this->Depots->Pointdeventes->find('list', ['limit' => 200]);


        $this->set(compact('depot', 'pointdeventes'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //  $session = $this->request->getSession();
        //  $abrv = $session->read('abrvv');
        //  $liendd = $session->read('lien_stock' . $abrv);

        // //    debug($liendd);
        // $depot = 0;
        //  foreach ($liendd as $k => $liens) {
        // //     //  debug($liens);
        //     if (@$liens['lien'] == 'depots') {
        //         $depot = $liens['ajout'];
        //      }
        //  }
        // // debug($societe);die;
        //  if (($depot <> 1)) {
        //      $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }


        $depot = $this->Depots->newEmptyEntity();
        $num = $this->Depots->find()->select(["numdepot" =>
        'MAX(Depots.code)'])->first();

        $numero = $num->numdepot;
        if ($numero !== null) {
        $inc = intval(substr($numero, 1, 5)) + 1;
        $c = str_pad("$inc", 5, '0', STR_PAD_LEFT);
        //debug($c);
        $code = str_pad($c, 6, 'D', STR_PAD_LEFT);
        } else{
            $code = 'D00001';
        }
        //debug($code);
        //die;
        if ($this->request->is('post')) {
            // debug($this->request->getData());
            // die;
            $depot = $this->Depots->patchEntity($depot, $this->request->getData());
            ///debug($depot);
            if ($this->Depots->save($depot)) {
                $depot = $this->Depots->newEmptyEntity();
                $num = $this->Depots->find()->select(["numdepot" =>
                'MAX(Depots.code)'])->first();
        
                $numero = $num->numdepot;
                if ($numero !== null) {
                $inc = intval(substr($numero, 1, 5)) + 1;
                $c = str_pad("$inc", 5, '0', STR_PAD_LEFT);
                //debug($c);
                $code = str_pad($c, 6, 'D', STR_PAD_LEFT);
                } else{
                    $code = 'D00001';
                }
                $depot_id = $depot->id;
                $this->misejour("Depots", "add", $depot_id);

                return $this->redirect(['action' => 'index']);
            }
    
        }
        $pointdeventes = $this->Depots->Pointdeventes->find('list', ['limit' => 200]);
        $this->set(compact('depot', 'pointdeventes', 'code'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Depot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
         $abrv = $session->read('abrvv');
         $liendd = $session->read('lien_stock' . $abrv);

        //    debug($liendd);
        $depot = 0;
         foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
            if (@$liens['lien'] == 'depots') {
                $depot = $liens['modif'];
             }
         }
        // debug($societe);die;
         if (($depot <> 1)) {
             $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $depot = $this->Depots->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $depot = $this->Depots->patchEntity($depot, $this->request->getData());
            if ($this->Depots->save($depot)) {
                $depot_id = ($this->Depots->save($depot)->id);
                $this->misejour("Depots", "edit", $depot_id);

                return $this->redirect(['action' => 'index']);
            }
            
        }
        $pointdeventes = $this->Depots->Pointdeventes->find('list', ['limit' => 200]);
        $this->set(compact('depot', 'pointdeventes'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Depot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
       $session = $this->request->getSession();
         $abrv = $session->read('abrvv');
         $liendd = $session->read('lien_stock' . $abrv);

        //    debug($liendd);
        $depot = 0;
         foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
            if (@$liens['lien'] == 'depots') {
                $depot = $liens['supp'];
             }
         }
        // debug($societe);die;
         if (($depot <> 1)) {
             $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $depot = $this->Depots->get($id);
        if ($this->Depots->delete($depot)) {
            $depot_id = ($this->Depots->save($depot)->id);
            $this->misejour("Depots", "delete", $depot_id);
        } else {
            
        }

        return $this->redirect(['action' => 'index']);
    }
}

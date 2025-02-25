<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Previsionachats Controller
 *
 * @property \App\Model\Table\PrevisionachatsTable $Previsionachats
 * @method \App\Model\Entity\Previsionachat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrevisionachatsController extends AppController
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


        $numero = $this->request->getQuery('numero');
        $depot = $this->request->getQuery('depot_id');

        if ($numero) {
            $cond1 = "Previsionachats.numero like '%" . $numero . "%' ";
        }

        if ($depot) {
            $cond2 = "Previsionachats.depot_id = '" . $depot . "' ";
        }
        $query = $this->Previsionachats->find('all')->where([$cond1, $cond2])->order(['Previsionachats.id' => 'DESC']);

        $this->paginate = [
            'contain' => ['Depots'],
        ];
        $previsionachats = $this->paginate($query);

        $depots = $this->Previsionachats->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('previsionachats','depots'));
    }

    /**
     * View method
     *
     * @param string|null $id Previsionachat id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $previsionachat = $this->Previsionachats->get($id, [
            'contain' => ['Depots']
        ]);

        $this->loadModel('Ligneprevisionachats');
        $this->loadModel('Articles');


        $lignepv = $this->Ligneprevisionachats->find('all', [
            'contain' => []

        ])->where(['previsionachat_id =' . $id])->distinct(['article_id']);

        $list ='0' ; 
        foreach ($lignepv as $i => $lv) {
            $list = $list .  ','. $lv->article_id;
            //debug($tab) ; 
        }
       
        $articless = $this->Articles->find('all')
        ->where(['Articles.id  in (' . $list . ')']) ; 
        $this->loadModel('Articles');
        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);

        foreach ($articless as $art) {
            foreach ($mois as $moi) {
                $quantites = $this->fetchTable('Ligneprevisionachats')->find('all', [])
                        ->where(["Ligneprevisionachats.previsionachat_id = " . $id . "", "Ligneprevisionachats.article_id = " . $art->id . "", "Ligneprevisionachats.moi_id = " . $moi->id . "",]);
                    //    debug($quantites) ; 
                      //  echo(json_encode($quantites)) ;
                if (!empty($quantites)) {
                    foreach ($quantites as $q) {
                           // debug($q) ;

                        $tab[$art->id][$moi->id] = $q->qte;
                        $tabb[$art->id][$moi->id] = $q->id;
                        // debug($tab) ;   
                    }
                   
                } else
                    $tab[$art->id][$moi->id] = 0;
            }
        }

        $this->loadModel('Articles');
        $articles = $this->fetchTable('Articles')->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
       //echo(json_encode($articles)) ; 

         $depots = $this->Previsionachats->Depots->find('list', ['limit' => 200]);

        $this->set(compact('previsionachat','mois','articles','lignepv','tab','tabb','depots'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
//        $session = $this->request->getSession();
//        $abrv = $session->read('abrvv');
//        $liendd = $session->read('lien_achat' . $abrv);
//
//     
//        $previsionachat = 0;
//        foreach ($liendd as $k => $liens) {
//            //  debug($liens);
//            if (@$liens['lien'] == 'previsionachats') {
//                $previsionachat = $liens['ajout'];
//            }
//        }
//        // debug($societe);die;
//        if (($previsionachat <> 1)) {
//            $this->redirect(array('controller' => 'users', 'action' => 'login'));
//        }


        $previsionachat = $this->Previsionachats->newEmptyEntity();

        $num = $this->Previsionachats->find()->select(["num" =>
        'MAX(Previsionachats.numero)'])->first();


        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mmm = str_pad("$in", 6, "0", STR_PAD_LEFT);

        if ($this->request->is('post')) {

            $pv['numero'] = $mmm;
            $pv['depot_id'] = $this->request->getData('depot_id');
            $pv['date'] = $this->request->getData('date');

            $previsionachat = $this->Previsionachats->patchEntity($previsionachat, $pv);
            if ($this->Previsionachats->save($previsionachat)) {

                $pv_id = ($this->Previsionachats->save($previsionachat)->id);
                $this->misejour("Previsionachats", "add", $pv_id);

                $prev_id = $previsionachat->id;

                if (isset($this->request->getData('data')['achat']) && (!empty($this->request->getData('data')['achat']))) {
                  //debug($this->request->getData('data')) ; die ;
                      foreach ($this->request->getData('data')['achat'] as $i => $c) {
                       
                        if ($c['suppv'] != 1) {

                          $this->loadModel('Ligneprevisionachats');

                          for (    $j=0;   $j < 12 ;    $j++      ) {
                            $ligneprev = $this->fetchTable('Ligneprevisionachats')->newEmptyEntity();
                 
                     if (  ( !empty($c["qte$j"]) )   &&  ( !empty($c["moi_id$j"]) )    ) {
                          
                          $data['moi_id'] = $c["moi_id$j"];
                          $data['qte'] =  $c["qte$j"];
                          $data['previsionachat_id'] = $prev_id;
                          $data['article_id'] = $c['article_id'];

                          $ligneprev = $this->fetchTable('Ligneprevisionachats')->patchEntity($ligneprev, $data);
                        
                        $this->fetchTable('Ligneprevisionachats')->save($ligneprev);
                            //debug($ligneprev) ; 
                         // }
                        }
                    }
                }
                      }
                  }
  

                ///$this->Flash->success(__('The {0} has been saved.', 'Previsionachat'));

                return $this->redirect(['action' => 'index']);
            }
          /////  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Previsionachat'));
        }

        $this->loadModel('Mois');
        $this->loadModel('Articles');
        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        $condd = 'Articles.famille_id = 1 ';

        $articles = $this->fetchTable('Articles')->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation'])
        ->where([$condd]);
       //echo(json_encode($articles)) ; 

       $depots = $this->fetchTable('Depots')->find('list', ['limit' => 200]);



        $this->set(compact('previsionachat','mois','articles','depots','mmm'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Previsionachat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
//        $session = $this->request->getSession();
//        $abrv = $session->read('abrvv');
//        $liendd = $session->read('lien_achat' . $abrv);
//
//     
//        $previsionachat = 0;
//        foreach ($liendd as $k => $liens) {
//            //  debug($liens);
//            if (@$liens['lien'] == 'previsionachats') {
//                $previsionachat = $liens['modif'];
//            }
//        }
//        // debug($societe);die;
//        if (($previsionachat <> 1)) {
//            $this->redirect(array('controller' => 'users', 'action' => 'login'));
//        }


        
        $previsionachat = $this->Previsionachats->get($id, [
            'contain' => ['Depots']
        ]);
     

        $this->loadModel('Ligneprevisionachats');
        $this->loadModel('Articles');


        $lignepv = $this->Ligneprevisionachats->find('all', [
            'contain' => []

        ])->where(['previsionachat_id =' . $id])->distinct(['article_id']);

        $list ='0' ; 
        foreach ($lignepv as $i => $lv) {
            $list = $list .  ','. $lv->article_id;
            //debug($tab) ; 
        }
       
        $articless = $this->Articles->find('all')
        ->where(['Articles.id  in (' . $list . ')']) ; 
        $this->loadModel('Articles');
        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);

        foreach ($articless as $art) {
            foreach ($mois as $moi) {
                $quantites = $this->fetchTable('Ligneprevisionachats')->find('all', [])
                        ->where(["Ligneprevisionachats.previsionachat_id = " . $id . "", "Ligneprevisionachats.article_id = " . $art->id . "", "Ligneprevisionachats.moi_id = " . $moi->id . "",]);
                    //    debug($quantites) ; 
                      //  echo(json_encode($quantites)) ;
                if (!empty($quantites)) {
                    foreach ($quantites as $q) {
                           // debug($q) ;

                        $tab[$art->id][$moi->id] = $q->qte;
                        $tabb[$art->id][$moi->id] = $q->id;
                        // debug($tab) ;   
                    }
                   
                } else
                    $tab[$art->id][$moi->id] = 0;
            }
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
          
            $previsionachat = $this->Previsionachats->patchEntity($previsionachat, $this->request->getData());
            if ($this->Previsionachats->save($previsionachat)) {

   
                $ligneprev = $this->fetchTable('Ligneprevisionachats')->find('all')
                ->where(['Ligneprevisionachats.previsionachat_id=' . $id]); //debug($lignezd);//die;
                foreach($ligneprev as $l){
               $this->fetchTable('Ligneprevisionachats')->delete($l);}
   
                
               $prev_id = $previsionachat->id;

               if (isset($this->request->getData('data')['achat']) && (!empty($this->request->getData('data')['achat']))) {
                  // debug($this->request->getData('data')) ; die ;
                     foreach ($this->request->getData('data')['achat'] as $i => $c) {
                        if ($c['suppv'] != 1) {

                         $this->loadModel('Ligneprevisionachats');

                         for ($j=0; $j < 12 ; $j++) {
                           $ligneprev = $this->fetchTable('Ligneprevisionachats')->newEmptyEntity();
                     if (   (!empty($c["qte$j"]))   &&    (!empty($c["moi_id$j"]))    ) {
                         $data['moi_id'] = $c["moi_id$j"];
                         $data['qte'] =  $c["qte$j"];
                         $data['previsionachat_id'] = $prev_id;
                         $data['article_id'] = $c['article_id'];

                         $ligneprev = $this->fetchTable('Ligneprevisionachats')->patchEntity($ligneprev, $data);
                       
                             $this->fetchTable('Ligneprevisionachats')->save($ligneprev);
                           //debug($ligneprev) ; 
                        // }
                       }
                   }
                }
                     }
                 }
 
               
                 $pv_id = ($this->Previsionachats->save($previsionachat)->id);
                 $this->misejour("Previsionachats", "edit", $pv_id);
               
               return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Previsionachat'));
        }


        $this->loadModel('Articles');
        $articles = $this->fetchTable('Articles')->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
       //echo(json_encode($articles)) ; 

       $depots = $this->Previsionachats->Depots->find('list', ['limit' => 200]);

        $this->set(compact('previsionachat','mois','articles','lignepv','tab','tabb','depots'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Previsionachat id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
//        $session = $this->request->getSession();
//        $abrv = $session->read('abrvv');
//        $liendd = $session->read('lien_achat' . $abrv);
//
//     
//        $previsionachat = 0;
//        foreach ($liendd as $k => $liens) {
//            //  debug($liens);
//            if (@$liens['lien'] == 'previsionachats') {
//                $previsionachat = $liens['supp'];
//            }
//        }
//        // debug($societe);die;
//        if (($previsionachat <> 1)) {
//            $this->redirect(array('controller' => 'users', 'action' => 'login'));
//        }


        $this->request->allowMethod(['post', 'delete']);
        $previsionachat = $this->Previsionachats->get($id);
      
        $lignepv = $this->fetchTable('Ligneprevisionachats')->find('all', [])
        ->where(['Ligneprevisionachats.previsionachat_id=' . $id]);
            if ($this->Previsionachats->delete($previsionachat)) {

                $pv_id = ($this->Previsionachats->save($previsionachat)->id);
                $this->misejour("Previsionachats", "delete", $pv_id);

                foreach ($lignepv as $l) {
                    $this->fetchTable('Ligneprevisionachats')->delete($l);
                }
            } else {
                
}
        return $this->redirect(['action' => 'index']);
    }
}

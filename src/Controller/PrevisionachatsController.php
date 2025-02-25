<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Previsionachats Controller
 *
 * @property \App\Model\Table\PrevisionachatsTable $Previsionachats
 * @method \App\Model\Entity\Previsionachat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

use Cake\I18n\Time;

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
            'contain' => [],
        ];
        $previsionachats = $this->paginate($query);

        $count =  $this->Previsionachats->find('all')->count();
        //debug($prev) ;         

        // $depots = $this->Previsionachats->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('previsionachats','count'));
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
            'contain' => []
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

         //$depots = $this->Previsionachats->Depots->find('list', ['limit' => 200]);

        $this->set(compact('previsionachat','mois','articles','lignepv','tab','tabb'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $previsionachat = $this->Previsionachats->newEmptyEntity();

        $num = $this->Previsionachats->find()->select(["num" =>
        'MAX(Previsionachats.numero)'])->first();
         // debug($);

        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mmm = str_pad("$in", 6, "0", STR_PAD_LEFT);

        if ($this->request->is('post')) {

            $pv['numero'] = $mmm;
            // $pv['depot_id'] = $this->request->getData('depot_id');
            $pv['date'] = $this->request->getData('date');



            $previsionachat = $this->Previsionachats->patchEntity($previsionachat, $pv);
            if ($this->Previsionachats->save($previsionachat)) {
                $prev_id = $previsionachat->id;

                if (isset($this->request->getData('data')['achat']) && (!empty($this->request->getData('data')['achat']))) {
                  //debug($this->request->getData('data')) ; die ;
                      foreach ($this->request->getData('data')['achat'] as $i => $c) {
                       
                        if ($c['suppv'] != 1) {

                          $this->loadModel('Ligneprevisionachats');

                          for (    $j = 0;   $j < 12 ;    $j++      ) {

                            $ligneprev = $this->fetchTable('Ligneprevisionachats')->newEmptyEntity();

                  if (  (!empty($c["qte$j"]))  &&  (!empty($c["moi_id$j"]))  ) {
                    
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
        $articles = $this->fetchTable('Articles')->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
       //echo(json_encode($articles)) ; 

    //    $depots = $this->fetchTable('Depots')->find('list', ['limit' => 200]);



        $this->set(compact('previsionachat','mois','articles','mmm'));
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
        $previsionachat = $this->Previsionachats->get($id, [
            'contain' => []
        ]);
       // echo(json_encode($previsionachat)) ;

        $this->loadModel('Ligneprevisionachats');
        $this->loadModel('Articles');


        $lignepv = $this->Ligneprevisionachats->find('all', [
            'contain' => []

        ])->where(['previsionachat_id =' . $id])->distinct(['article_id']);

    //debug($lignepv);die;
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
                         //   debug($q) ;

                        $tab[$art->id][$moi->id] = $q->qte;
                        $tabb[$art->id][$moi->id] = $q->id;
                        // debug($tabb) ;   
                    }
                   
                } else
                    $tab[$art->id][$moi->id] = 0;
            }
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
          
            $previsionachat = $this->Previsionachats->patchEntity($previsionachat, $this->request->getData());
            if ($this->Previsionachats->save($previsionachat)) {
                     
               $prev_id = $previsionachat->id;

               if (isset($this->request->getData('data')['achat']) && (!empty($this->request->getData('data')['achat']))) {
                   //debug($this->request->getData('data')) ; die ;
                     foreach ($this->request->getData('data')['achat'] as $i => $c) {
                      
                         $this->loadModel('Ligneprevisionachats');

                         for ($j=0; $j < 12 ; $j++) {
                            
                            if ($c['suppv'] != 1) {
                                
                  if (      (!empty($c["qte$j"]))   &&    (!empty($c["moi_id$j"]))      ) {

                         $data['moi_id'] = $c["moi_id$j"];
                         $data['qte'] =  $c["qte$j"];
                         $data['previsionachat_id'] = $prev_id;
                         $data['article_id'] = $c['article_id'];
                         $data['id'] =  $c["qte_id$j"];


                         if (isset($c["qte_id$j"]) && (!empty($c["qte_id$j"]))) {
                            $ligneprev = $this->fetchTable('Ligneprevisionachats')->get($c["qte_id$j"], [
                                'contain' => []
                            ]);
                            //debug($ligneprev);
                        } else {
                            $ligneprev = $this->fetchTable('Ligneprevisionachats')->newEmptyEntity();
                           // debug($ligneprev) ;
                        }
                        if (!empty($c["qte$j"])) {
                            $ligneprev = $this->fetchTable('Ligneprevisionachats')->patchEntity($ligneprev, $data);
                            //debug($ligneprev) ;
                        }

                        $this->fetchTable('Ligneprevisionachats')->save($ligneprev);

                        // }
                       }
                      
                    }
                    else if (!empty($c["qte_id$j"])){

                        $ligneprev = $this->fetchTable('Ligneprevisionachats')->get($c["qte_id$j"]);
    
                         $this->fetchTable('Ligneprevisionachats')->delete($ligneprev);
                   }
                
                      
                     }
                 }
                }
               
                 
               return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Previsionachat'));
        }


        $this->loadModel('Articles');
        $articles = $this->fetchTable('Articles')->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
       //echo(json_encode($articles)) ; 

    //    $depots = $this->Previsionachats->Depots->find('list', ['limit' => 200]);

        $this->set(compact('previsionachat','mois','articles','lignepv','tab','tabb'));
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
        $this->request->allowMethod(['post', 'delete']);
        $previsionachat = $this->Previsionachats->get($id);
        $lignepv = $this->fetchTable('Ligneprevisionachats')->find('all', [])
        ->where(['Ligneprevisionachats.previsionachat_id=' . $id]);
            if ($this->Previsionachats->delete($previsionachat)) {
                $this->misejour("Previsionachats", "delete", $id);
                foreach ($lignepv as $l) {
                    $this->fetchTable('Ligneprevisionachats')->delete($l);
                }
            } else {
                
}
        return $this->redirect(['action' => 'index']);
    }





    public function indexprod()
    {

        error_reporting(E_ERROR | E_PARSE);
        $cond = 'Articles.famille_id = 1 ';
        $cond0 = 'Familles.id = 1 ';
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        

        $this->loadModel('Articles');
        $articles = $this->fetchTable('Articles')->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation'])->where([$cond]);
      
        $this->loadModel('Mois');

        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']) ;

        $this->loadModel('Familles');
        $famillespf = $this->fetchTable('Familles')->find('all', ['keyfield' => 'id', 'valueField' => 'Nom']);


        $query ='' ;
        $article_id = $this->request->getQuery('article_id');
        $famille_id = $this->request->getQuery('famille_id');
        $S_famille_id = $this->request->getQuery('sousfamille1_id');
        $Ss_famille_id = $this->request->getQuery('sousfamille2_id');
        $moi_debut = $this->request->getQuery('moi_debut');
        $moi_fin = $this->request->getQuery('moi_fin');


        if ($article_id) {
            $cond1 = "Articles.id =  '" . $article_id . "' ";
        }
        if ($famille_id) {
            $cond2 = "Articles.famille_id  =  '" . $famille_id . "' ";
        }
        if ($S_famille_id) {
            $cond3 = "Articles.sousfamille1_id  =  '" . $S_famille_id . "' ";
        }
        if ($Ss_famille_id) {
            $cond4 = "Articles.sousfamille2_id  =  '" . $Ss_famille_id . "' ";
        }

        



     if ($article_id  != 0  ) {
        $query = $this->fetchTable('Articles')->find('all')->where([$cond1] ) ;
      
        $this->paginate = [
            'contain' => [],
        ];
        $listart = $this->paginate($query);
    }


     if  ($article_id  == '' && $query != '' ) {
        $query = $this->fetchTable('Articles')->find('all')->where([$cond2,$cond3,$cond4]) ; 
        $this->paginate = [
            'contain' => [],
        ];
        $listart = $this->paginate($query);
    }

   
   



   // $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
    $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
    $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

       
    $this->set(compact( 'count', 'sousfamille1s', 'sousfamille2s' , 'articles' , 'mois','famillespf' ,'listart' , 'famille_id' , 'article_id','moi_debut' ,'moi_fin' ));

 
 
    }




    public function impprod() {

        

        $famille_id = $this->request->getQuery('famille_id');
        $article_id = $this->request->getQuery('article_id');
        $moi_debut = $this->request->getQuery('moi_debut');
        $moi_fin = $this->request->getQuery('moi_fin');


        //debug($moi_debut) ;
       // debug($moi_fin) ;

        $this->loadModel('Articles');


        $cond1 = 'Articles.famille_id =' . $famille_id;
        $cond2 = 'Articles.id=' . $article_id;

       
        if (    $article_id == ''    ) {
            $articles = $this->fetchTable('Articles')->find('all', [
                'contain' => []
            ])->where([$cond1]);
        }
        if (    $article_id != ''    ) {
            $articles = $this->fetchTable('Articles')->find('all', [
                'contain' => []
            ])->where([$cond2]);
        }

     

      //  debug($articles) ;

      


        $this->set(compact('articles' ,'moi_debut' ,'moi_fin'  ));

    }

}

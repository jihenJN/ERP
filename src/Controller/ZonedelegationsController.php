<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Zonedelegations Controller
 *
 * @property \App\Model\Table\ZonedelegationsTable $Zonedelegations
 * @method \App\Model\Entity\Zonedelegation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ZonedelegationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {


        $numero = $this->request->getQuery('numero');
        $zone_id = $this->request->getQuery('zone_id');

        $cond1 = '' ; 
        $cond2 = '' ; 

        if ($numero) {
            $cond1 = "Zonedelegations.numero like  '%" . $numero . "%' ";
        }
        if ($zone_id) {
            $cond2 = "Zonedelegations.zone_id  =  '" . $zone_id . "' ";
        }
        $query = $this->Zonedelegations->find('all')->where([$cond1, $cond2]) ; 

        $this->paginate = [
            'contain' => ['Zones'],
        ];
        $zonedelegations = $this->paginate($query);

    
        $zones = $this->Zonedelegations->Zones->find('list', ['keyfield' => 'id', 'valueField' => 'name']);



        $this->set(compact('zonedelegations', 'zones'));
    }

    /**
     * View method
     *
     * @param string|null $id Zonedelegation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    
    {
        $zonedelegation = $this->Zonedelegations->get($id, [
            'contain' => ['Zones'],
        ]);

        $this->loadModel('Lignezonedelegations');

        $gouv = $this->Lignezonedelegations->find('all', [
            'contain' => ['Gouvernorats']

        ])->where(['zonedelegation_id =' . $id])->distinct(['gouvernorat_id']);
        
        foreach ($gouv as $g) {

            $lignezonedelegation = $this->Lignezonedelegations->find('all', [
                'contain' => ['Gouvernorats','Delegations']

            ])->where(['zonedelegation_id =' . $id])
            ->where(['gouvernorat_id =' . $g->gouvernorat_id]);

            foreach($lignezonedelegation as $i=> $l){
               
            $tab[$g->gouvernorat_id][$i] = ['deleg'=>$l->delegation->name];
            }
        }




        $this->set(compact('zonedelegation', 'lignezonedelegation', 'gouv','tab' ));
    }



    /**
     * Add method
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_zones = $session->read('lien_zones' . $abrv); 

        //   debug($liendd);
        $zonedelegation = 0;
        foreach ($lien_zones as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'souszones') {
                $zonedelegation = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($zonedelegation <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $num = $this->Zonedelegations->find()->select(["num" =>
        'MAX(Zonedelegations.numero)'])->first();
        // debug($num);

        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        // debug($n);
        $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);

        $this->loadModel('Gouvernorats');
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        $zonedelegation = $this->fetchTable('Zonedelegations')->newEmptyEntity();

        if ($this->request->is('post')) {
            // debug($zonedelegation) ; die ;

           // debug($this->request->getData());
            $zd['numero'] = $mm;
            $zd['zone_id'] = $this->request->getData('zone_id');
            //  debug($zd) ; die ; 

            $zonedelegation = $this->Zonedelegations->patchEntity($zonedelegation, $zd);

            //debug($zonedelegation) ; die ; 
            if ($this->Zonedelegations->save($zonedelegation)) {
                //debug($zonedelegation) ; die ;

                $zonedelegation_id = $zonedelegation->id;
                //debug($zonedelegation_id) ; die ; 

                if (isset($this->request->getData('data')['Gouvernorat']) && (!empty($this->request->getData('data')['Gouvernorat']))) {

                    foreach ($this->request->getData('data')['Gouvernorat'] as $j => $gouv) {

                       if ($gouv['sup'] != 1) {

                        foreach ($gouv['Delegation'] as $j => $dl) {

                            if (isset($dl['checkdelegation']) && (!empty($dl['checkdelegation'])) && $dl['checkdelegation'] == 1) {
                                $lignezd = $this->fetchTable('Lignezonedelegations')->newEmptyEntity();
                                

                                $data['delegation_id'] = $dl['deleg_id'];
                                $data['zonedelegation_id'] = $zonedelegation_id;
                                $data['gouvernorat_id'] = $gouv['gouvernorat_id'];

                                $lignezd = $this->fetchTable('Lignezonedelegations')->patchEntity($lignezd, $data);
                                $this->fetchTable('Lignezonedelegations')->save($lignezd);
                                //debug($lignezd) ; 
                                }
                            }
                       }
                    }
                }



                return $this->redirect(['action' => 'index']);
            }
        }
        $zones = $this->Zonedelegations->Zones->find('list', ['limit' => 200]);
        $this->set(compact('zonedelegation', 'zones', 'gouvernorats', 'mm'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Zonedelegation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_zones = $session->read('lien_zones' . $abrv); 

        //   debug($liendd);
        $zonedelegation = 0;
        foreach ($lien_zones as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'souszones') {
                $zonedelegation = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($zonedelegation <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $zonedelegation = $this->Zonedelegations->get($id, [
            'contain' => ['Zones']
        ]);

       // debug($zonedelegation) ; 

        $this->loadModel('Lignezonedelegations');

        $gouv = $this->Lignezonedelegations->find('all', [
            'contain' => ['Gouvernorats']

        ])->where(['zonedelegation_id =' . $id])->distinct(['gouvernorat_id']);

        //echo(json_encode($gouv)) ; 
        // $gv = '0' ; 
        foreach ($gouv as $g) {
            //debug($g) ; 

            $gv = $g->gouvernorat->id;

            //debug($gv) ; 
        

            $this->loadModel('Basepostes');
            $this->loadModel('Delegations');
            $del = $this->Basepostes->find('all')->select(["id_deleg" => '(Basepostes.id_deleg)'])->where(['id_gouv = (' . $gv . ')']) ;
         
           
           //   debug($del) ; 
            $i = 0;
            $tabb = array();
            foreach ($del as $i => $tabb) {
                //debug($tabb) ; 
                $tabb = $del;
            }
            //debug($tabb) ; 
            $deleg = $this->Delegations->find('all')
                ->where(['Delegations.id  in (' . $tabb . ')']) ; 
             
                
           // debug($deleg) ; 
          
            $lignezonedelegation = $this->Lignezonedelegations->find('all', [
                'contain' => ['Gouvernorats','Delegations']

            ])->where(['zonedelegation_id =' . $id])
            ->where(['gouvernorat_id =' . $g->gouvernorat_id]);
           
            foreach($lignezonedelegation as $k=> $l){
                // debug($l) ; 
               
                  $delegs = $l->delegation->name ;     
                 $tab[$g->gouvernorat_id][$k] = ['deleg'=>$l->delegation->name   , 'deleg_id' => $l->delegation->id , 'ligne' => $l->id  ];
            
            }

            foreach($deleg as $j=> $dl){
             $tab2[$g->gouvernorat_id][$j] = ['deleg'=>$dl->name  , 'deleg_id' =>$dl->id       ];
            
                }
           
        }

        $this->loadModel('Gouvernorats');
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);

        if ($this->request->is(['patch', 'post', 'put'])) {
           //debug($this->request->getData()); 
            $zonedelegation = $this->Zonedelegations->patchEntity($zonedelegation, $this->request->getData());
            if ($this->Zonedelegations->save($zonedelegation)) {

            $lignezd = $this->fetchTable('Lignezonedelegations')->find('all')
             ->where(['Lignezonedelegations.zonedelegation_id=' . $id]); //debug($lignezd);//die;
             foreach($lignezd as $l){
            $this->fetchTable('Lignezonedelegations')->delete($l);}

              //debug($lignezd) ; 

        
                $zonedelegation_id = $zonedelegation->id;

                if (isset($this->request->getData('data')['Gouvernorat']) && (!empty($this->request->getData('data')['Gouvernorat']))) {
                   

                    foreach ($this->request->getData('data')['Gouvernorat'] as $j => $gouv) {
                       
                       if ($gouv['sup'] != 1) {

                        foreach ($gouv['Delegation'] as $j => $dl) {
                            //debug($dl) ;

                            if (isset($dl['checkdelegation']) && (!empty($dl['checkdelegation'])) && $dl['checkdelegation'] == 1) {
                               
                                $lignezd = $this->fetchTable('Lignezonedelegations')->newEmptyEntity();


                                $data['delegation_id'] = $dl['deleg_id'];
                                $data['zonedelegation_id'] = $zonedelegation_id;
                                $data['gouvernorat_id'] = $gouv['gouvernorat_id'];

                                $lignezd = $this->fetchTable('Lignezonedelegations')->patchEntity($lignezd, $data);
                                $this->fetchTable('Lignezonedelegations')->save($lignezd);
                                }
                              
                       }
                    }
                }
            }

                
            //     if (isset($this->request->getData('data')['Gouvernorat']) && (!empty($this->request->getData('data')['Gouvernorat']))) {
            //      //debug($this->request->getData()) ; die ;
            //         foreach ($this->request->getData('data')['Gouvernorat'] as $j => $gouv) {
                      
            //             foreach ($gouv['Delegation'] as $j => $dl) {
            //                // debug($dl) ; 
                        
            //                 if (isset($dl['checkdelegation']) && (!empty($dl['checkdelegation'])) && $dl['checkdelegation'] == 1) {


            //                     $data['delegation_id'] = $dl['deleg_id'];
            //                     $data['id'] = $dl['ligne'];
            //                     $data['zonedelegation_id'] = $zonedelegation_id;
            //                     $data['gouvernorat_id'] = $gouv['gouvernorat_id'];
                             
                            
            //                    if (isset($dl['ligne']) && (!empty($dl['ligne']))   ) {
            //                     $lignezd = $this->fetchTable('Lignezonedelegations')->get($dl['ligne'], [
            //                             'contain' => []
            //                         ]);
                                   
            //                     } 
            //                     else {
            //                         $lignezd = $this->fetchTable('Lignezonedelegations')->newEmptyEntity();
            //                     }
                                
            //                     $lignezd = $this->fetchTable('Lignezonedelegations')->patchEntity($lignezd, $data);

                          
                                 
            //                     $this->fetchTable('Lignezonedelegations')->save($lignezd) ;
                            
                         
            //         }
                    
            //         if (!empty($dl['ligne']) && (empty($dl['checkdelegation']))) {
            //             $lignezd = $this->fetchTable('Lignezonedelegations')->get($dl['ligne']);
            //        $this->fetchTable('Lignezonedelegations')->deleteAll(array('Lignezonedelegations.id'=> $dl['ligne']));
            //             //debug($lignezd) ; 

            //         }
                     
                   
                  
            //     }
            //     }
            // }



                return $this->redirect(['action' => 'index']);
            }
        }
        $zones = $this->Zonedelegations->Zones->find('list', ['limit' => 200]);
        $this->set(compact('delegs' ,'zonedelegation', 'zones','lignezonedelegation', 'gouv','tab' , 'tab2' ,'gouvernorats','deleg' ));
    }


    /**
     * Delete method
     *
     * @param string|null $id Zonedelegation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_zones = $session->read('lien_zones' . $abrv); 

        //   debug($liendd);
        $zonedelegation = 0;
        foreach ($lien_zones as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'souszones') {
                $zonedelegation = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($zonedelegation <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $zonedelegation = $this->Zonedelegations->get($id);
        $lignezonedelegation = $this->fetchTable('Lignezonedelegations')->find('all', [])
                ->where(['Lignezonedelegations.zonedelegation_id=' . $id]);
        if ($this->Zonedelegations->delete($zonedelegation)) {
            $this->misejour("Zonedelegations", "delete", $id);
            foreach ($lignezonedelegation as $l) {
                $this->fetchTable('Lignezonedelegations')->delete($l);
            }
        } else {
            
        }

        return $this->redirect(['action' => 'index']) ; 
    }

    public function getdeleg($id = null)
    {

        $id = $this->request->getQuery('idGouver');
        $ind = $this->request->getQuery('Index');
        //debug($i);die;


        $this->loadModel('Basepostes');
        $this->loadModel('Delegations');


        $ligne = $this->fetchTable('Gouvernorats')->get($id, [
            'contain' => [],
        ]);
        $del = $this->Basepostes->find()->select(["id_deleg" => '(Basepostes.id_deleg)'])->where(['id_gouv  ="' . $id . '"']);
        //debug($del);

        $i = 0;
        $tab = array();
        foreach ($del as $i => $tab) {
            $tab = $del;
        }
        $deleg = $this->Delegations->find()
            ->where(['Delegations.id  in (' . $tab . ')']);

        // echo(json_encode($index)) ; die ; 



        $this->set(compact('deleg', 'ind', 'id'));
    }



    
}

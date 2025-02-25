<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Zonedelegations Controller
 *
 * @property \App\Model\Table\ZonedelegationsTable $Zonedelegations
 * @method \App\Model\Entity\Zonedelegation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ZonedelegationsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Zones'],
        ];
        $zonedelegations = $this->paginate($this->Zonedelegations);
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
    public function view($id = null) {
        $zonedelegation = $this->Zonedelegations->get($id, [
            'contain' => ['Zones'],
        ]);
        // echo(json_encode($zonedelegation)) ; die ;


        $this->loadModel('Lignezonedelegations');

        $gouv = $this->Lignezonedelegations->find('all', [
                    'contain' => ['Gouvernorats']
                ])->where(['zonedelegation_id =' . $id])->distinct(['gouvernorat_id']);

        //echo(json_encode($gouv)) ; die ;


        foreach ($gouv as $g) {



            $lignezonedelegation = $this->Lignezonedelegations->find('all', [
                        'contain' => ['Gouvernorats', 'Delegations']
                    ])->where(['zonedelegation_id =' . $id])
                    ->where(['gouvernorat_id =' . $g->gouvernorat_id]);



            // debug($lignezonedelegation);
            foreach ($lignezonedelegation as $i => $l) {

                $tab[$g->gouvernorat_id][$i] = ['deleg' => $l->delegation->name];
            }
        }









        $this->set(compact('zonedelegation', 'lignezonedelegation', 'gouvernorats', 'gouv', 'tab'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {


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
            //debug($this->request->getData());
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

                        //   if ($gouv['sup'] != 1) {

                        foreach ($gouv['Delegation'] as $j => $dl) {

                            if (isset($dl['checkdelegation']) && (!empty($dl['checkdelegation'])) && $dl['checkdelegation'] == 1) {
                                $lignezd = $this->fetchTable('Lignezonedelegations')->newEmptyEntity();


                                $data['delegation_id'] = $dl['delegation_id'];
                                $data['zonedelegation_id'] = $zonedelegation_id;
                                $data['gouvernorat_id'] = $gouv['gouvernorat_id'];

                                $lignezd = $this->fetchTable('Lignezonedelegations')->patchEntity($lignezd, $data);
                                //debug($lignezd);die;
                                $this->fetchTable('Lignezonedelegations')->save($lignezd);
                            }
                        }
                        //  }
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
    public function edit($id = null) {
        $zonedelegation = $this->Zonedelegations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $zonedelegation = $this->Zonedelegations->patchEntity($zonedelegation, $this->request->getData());
            if ($this->Zonedelegations->save($zonedelegation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Zonedelegation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Zonedelegation'));
        }
        $zones = $this->Zonedelegations->Zones->find('list', ['limit' => 200]);
        $this->set(compact('zonedelegation', 'zones'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Zonedelegation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $zonedelegation = $this->Zonedelegations->get($id);
        $lignezonedelegation = $this->fetchTable('Lignezonedelegations')->find('all')
                ->where(['Lignezonedelegations.zonedelegation_id=' . $id]);
        foreach ($lignezonedelegation as $l) {
            $this->fetchTable('Lignezonedelegations')->delete($l);
        }
        if ($this->Zonedelegations->delete($zonedelegation)) {
            $this->misejour("Zonedelegations", "delete", $id);
        } else {
            
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getdeleg($id = null) {

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

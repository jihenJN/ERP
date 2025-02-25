<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Parmetreintegrations Controller
 *
 * @property \App\Model\Table\ParmetreintegrationsTable $Parmetreintegrations
 * @method \App\Model\Entity\Parmetreintegration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ParmetreintegrationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($type = null)
    {
        $this->paginate = [
            'contain' => [],
        ];

        $condtyp = "Parmetreintegrations.integration_id=" . $type;

        $parmetreintegrations = $this->Parmetreintegrations->find('all')->where([$condtyp])
            ->order(['Parmetreintegrations.id' => 'DESC'])
            ->contain(['Journals']);
        $integrations = $this->fetchTable('Integrations')->find('all');

        // debug($type);

        $count = $this->Parmetreintegrations->find('all')->where([$condtyp])->count();


        $this->set(compact('parmetreintegrations', 'type', 'integrations','count'));
    }

    /**
     * View method
     *
     * @param string|null $id Parmetreintegration id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parmetreintegration = $this->Parmetreintegrations->get($id, [
            'contain' => ['Journals'],
        ]);
        $lignefactures = $this->Parmetreintegrations->Ligneparmetreintegrations->find('all', [
            'contain' => ['Natures']
        ])->where(['parmetreintegration_id' => $id]);


        $type = $parmetreintegration->integration_id ;
        $lignefactures = $this->Parmetreintegrations->Ligneparmetreintegrations->find('all', [
            'contain' => ['Natures']
        ])->where(['parmetreintegration_id' => $id]);

        // debug($lignefactures->toarray());



        $journals = $this->Parmetreintegrations->Journals->find('all');
        $this->loadModel('Natures');
        $natures = $this->Natures->find('all');
        $this->loadModel('Typeexons');
        $taxs = $this->Typeexons->find('all');
        $this->loadModel('Ligneplans');
        $ligneplans = $this->Ligneplans->find('all');
        $this->loadModel('Champs');
        $champs = $this->Champs->find('all');
        //debug($natures);
        $this->set(compact('parmetreintegration', 'journals', 'natures', 'taxs', 'type','lignefactures','champs','ligneplans'));    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($type = null)
    {
        $parmetreintegration = $this->Parmetreintegrations->newEmptyEntity();

        // debug($parmetreintegration);


        if ($this->request->is('post')) {
           // debug($this->request->getData());
            $parmetreintegration = $this->Parmetreintegrations->patchEntity($parmetreintegration, $this->request->getData());
            $parmetreintegration->integration_id =$type ;
            if ($this->Parmetreintegrations->save($parmetreintegration)) {

                if (isset($this->request->getData('data')['lignefac']) && (!empty($this->request->getData('data')['lignefac']))) {
                    foreach ($this->request->getData('data')['lignefac'] as $i => $l) {

                        if ($l['sup'] != 1) {

                            $lignefacture = $this->fetchTable('Ligneparmetreintegrations')->newEmptyEntity();


                            $tab['parmetreintegration_id'] = $parmetreintegration->id;
                            $tab['libelle'] = $l['libelle'];
                            $tab['nature_id'] = $l['nature_id'];
                            $tab['typeexon_id'] = $l['taxe_id'];
                            $tab['ligneplan_id'] = $l['ligneplan_id'];
                            $tab['champ_id'] = $l['champ_id'];
                            $tab['auto'] = $l['auto'];

                            $lignefacture = $this->fetchTable('Ligneparmetreintegrations')->patchEntity($lignefacture, $tab);

                            $this->fetchTable('Ligneparmetreintegrations')->save($lignefacture);

                             debug($lignefacture);

                        }
                    }
                }

                return $this->redirect(['action' => 'index/' . $type]);
            }
        }
        $journals = $this->Parmetreintegrations->Journals->find('list', ['limit' => 200]);

       // $journals = $this->Parmetreintegrations->Journals->find('all');
        $this->loadModel('Natures');
        $natures = $this->Natures->find('all');
        $this->loadModel('Typeexons');
        $taxs = $this->Typeexons->find('all');
        $this->loadModel('Ligneplans');
        $ligneplans = $this->Ligneplans->find('all');
        $this->loadModel('Champs');
        $champs = $this->Champs->find('all');

        $this->set(compact('parmetreintegration', 'journals','type','ligneplans','champs','natures','taxs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Parmetreintegration id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $parmetreintegration = $this->Parmetreintegrations->get($id, [
            'contain' => ['Journals']
        ]);
        ///debug($parmetreintegration->toArray()) ;
        $type = $parmetreintegration->integration_id;

        $lignefactures = $this->Parmetreintegrations->Ligneparmetreintegrations->find('all', [
            'contain' => ['Natures']
        ])->where(['parmetreintegration_id' => $id]);

        //debug($lignefactures->toarray());

        if ($this->request->is(['patch', 'post', 'put'])) {

          //  debug($this->request->getData());

            $parmetreintegration = $this->Parmetreintegrations->patchEntity($parmetreintegration, $this->request->getData());

           /// debug($parmetreintegration);


            if ($this->Parmetreintegrations->save($parmetreintegration)) {

                if (isset($this->request->getData('data')['lignefac']) && (!empty($this->request->getData('data')['lignefac']))) {
                    foreach ($this->request->getData('data')['lignefac'] as $i => $l) {

                        if ($l['sup'] != 1) {

                            $tab['parmetreintegration_id'] = $parmetreintegration->id;
                            $tab['libelle'] = $l['libelle'];
                            $tab['nature_id'] = $l['nature_id'];
                            $tab['typeexon_id'] = $l['taxe_id'];
                            $tab['ligneplan_id'] = $l['ligneplan_id'];
                            $tab['champ_id'] = $l['champ_id'];
                            $tab['auto'] = $l['auto'];
                          

                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignefacture = $this->fetchTable('Ligneparmetreintegrations')->get($l['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $lignefacture = $this->fetchTable('Ligneparmetreintegrations')->newEmptyEntity();
                            }

                            $lignefacture = $this->fetchTable('Ligneparmetreintegrations')->patchEntity($lignefacture, $tab);

                            $this->fetchTable('Ligneparmetreintegrations')->save($lignefacture);
                        } else if (!empty($l['id'])) {
                            $lignefacture = $this->fetchTable('Ligneparmetreintegrations')->get($l['id']);
                            $this->fetchTable('Ligneparmetreintegrations')->delete($lignefacture);
                          //  debug($lignefacture);
                        }
                    }
                }
            }


            return $this->redirect(['action' => 'index/' . $type]);
        }

        $journals = $this->Parmetreintegrations->Journals->find('all');
        $this->loadModel('Natures');
        $natures = $this->Natures->find('all');
        $this->loadModel('Typeexons');
        $taxs = $this->Typeexons->find('all');
        $this->loadModel('Ligneplans');
        $ligneplans = $this->Ligneplans->find('all');
        $this->loadModel('Champs');
        $champs = $this->Champs->find('all');
        //debug($natures);
        $this->set(compact('parmetreintegration', 'journals', 'natures', 'taxs', 'type','lignefactures','champs','ligneplans'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Parmetreintegration id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parmetreintegration = $this->Parmetreintegrations->get($id);
        $type = $parmetreintegration->integration_id;

        $ligneint = $this->fetchTable('Ligneparmetreintegrations')->find('all', [])
        ->where(['Ligneparmetreintegrations.parmetreintegration_id=' . $id]);
        if ($this->Parmetreintegrations->delete($parmetreintegration)) {

            foreach ($ligneint as $l) {
                $this->fetchTable('Ligneparmetreintegrations')->delete($l);
            }

        } else {
        }

        return $this->redirect(['action' => 'index/' . $type]);
    }
}

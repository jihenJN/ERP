<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Zones Controller
 *
 * @property \App\Model\Table\ZonesTable $Zones
 * @method \App\Model\Entity\Zone[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ZonesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $cond = '';

        $nom = $this->request->getQuery('name');

        if ($nom) {
            $cond = "Zones.name  like  '%" . $nom . "%' ";
           
        }

        $query = $this->Zones->find('all')->where([$cond]);
        $zones = $this->paginate($query);


        $this->set(compact('zones'));
    }

    /**
     * View method
     *
     * @param string|null $id Zone id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $zone = $this->Zones->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('zone'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_zones = $session->read('lien_zones' . $abrv); 

        //   debug($liendd);
        $zone = 0;
        foreach ($lien_zones as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'zones') {
                $zone = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($zone <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->loadModel('Gouvernorats');
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
       
        $zone = $this->Zones->newEmptyEntity();
       
        if ($this->request->is('post')) {

            $zone = $this->Zones->patchEntity($zone, $this->request->getData());
            if ($this->Zones->save($zone)) {





                
            

                return $this->redirect(['action' => 'index']);
            }
        }


        

        $this->set(compact('zone','gouvernorats'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Zone id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_zones = $session->read('lien_zones' . $abrv); 

        //   debug($liendd);
        $zone = 0;
        foreach ($lien_zones as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'zones') {
                $zone = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($zone <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $zone = $this->Zones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $zone = $this->Zones->patchEntity($zone, $this->request->getData());
            if ($this->Zones->save($zone)) {
              //  $this->Flash->success(__('The {0} has been saved.', 'Zone'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Zone'));
        }
        $this->set(compact('zone'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Zone id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_zones = $session->read('lien_zones' . $abrv); 

        //   debug($liendd);
        $zone = 0;
        foreach ($lien_zones as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'zones') {
                $zone = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($zone <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $zone = $this->Zones->get($id);
        $zonedelegation = $this->fetchTable('Zonedelegations')->find('all', [])
            ->where(['Zonedelegations.zone_id=' . $id]);

       
        
        if ($this->Zones->delete($zone)) {
         
            foreach ($zonedelegation as $l) {
               if ($this->fetchTable('Zonedelegations')->delete($l)) {
                
                $lignezonedelegation = $this->fetchTable('Lignezonedelegations')->find('all', [])
                ->where(['Lignezonedelegations.zonedelegation_id=' . $l['id']]);

                foreach ($lignezonedelegation as $ligne) {
                    if ($this->fetchTable('Lignezonedelegations')->delete($ligne)) {
                    }
                    else{

                    }
    
                }


               }
            }
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }






    
}

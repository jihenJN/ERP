<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Groupes Controller
 *
 * @property \App\Model\Table\GroupesTable $Groupes
 * @method \App\Model\Entity\Groupe[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GroupesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $client_id = $this->request->getQuery('client_id');
        $cond1 = '';
        if ($client_id) {
            $cond1 = 'Groupes.client_id ="' . $client_id . '"';
        }
        $query = $this->Groupes->find('all')->where([$cond1]);

        $this->paginate = [
            'contain' => ['Clients'],
        ];
        $cha = "TRUE";

        $clients = $this->Groupes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale'])->where(["Clients.etat='$cha'"]);

        $groupes = $this->paginate($query);
        $this->set(compact('groupes','clients'));
    }

    /**
     * View method
     *
     * @param string|null $id Groupe id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $groupe = $this->Groupes->get($id, [
            'contain' => ['Clients'],
        ]);
        $clients = $this->Groupes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $lignegroupes = $this->fetchTable('Lignegroupes')->find('all', [
            'contain' => []
        ])
            ->where(['groupe_id' => $id]);
            $clientsl = $this->fetchTable('Clients')->find('all') ;

        $this->set(compact('groupe','clients','lignegroupes','clientsl'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $groupe = $this->Groupes->newEmptyEntity();
        if ($this->request->is('post')) {
/*             dd($this->request->getData()) ;
 */            $groupe = $this->Groupes->patchEntity($groupe, $this->request->getData());
            if ($this->Groupes->save($groupe)) {
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {

                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                            if (($l['supp'] == '' ) && ($l['personnel_id'] != ''))

                            {
                            $tab = $this->fetchTable('Lignegroupes')->newEmptyEntity();


                            $tab['groupe_id'] = $groupe->id;

                            $tab['client_id'] =$l['personnel_id'];





                            //    $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();



                            // $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
                            // debug($lignecommande);
                            $this->fetchTable('Lignegroupes')->save($tab);
                        }


                    }
                }

                $this->Flash->success(__('The {0} has been saved.', 'Groupe'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Groupe'));
        }
        $cha = "TRUE";
       /*  $clients = $this->Groupes->Clients->find('all')
        ->where(["Clients.etat='$cha'"]); */
       $clients = $this->Groupes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale'])->where(["Clients.etat='$cha'"]);
     $clientsl = $this->Groupes->Clients->find('all')
        ->where(["Clients.etat='$cha'"]);

        $this->set(compact('groupe', 'clients','clientsl'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Groupe id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $groupe = $this->Groupes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $groupe = $this->Groupes->patchEntity($groupe, $this->request->getData());
            if ($this->Groupes->save($groupe)) {
                $lignegroupes = $this->fetchTable('Lignegroupes')->find('all', [
                    'contain' => []
                ])
                    ->where(['groupe_id' => $id]);
                        $this->fetchTable('Lignegroupes')->deleteMany($lignegroupes);
                        foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                            if (($l['supp'] == '' ) && ($l['personnel_id'] != ''))

                            {
                            $tab = $this->fetchTable('Lignegroupes')->newEmptyEntity();


                            $tab['groupe_id'] = $groupe->id;

                            $tab['client_id'] =$l['personnel_id'];





                            //    $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();



                            // $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
                            // debug($lignecommande);
                            $this->fetchTable('Lignegroupes')->save($tab);
                        }


                    }

                $this->Flash->success(__('The {0} has been saved.', 'Groupe'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Groupe'));
        }
        $lignegroupes = $this->fetchTable('Lignegroupes')->find('all', [
            'contain' => []
        ])
            ->where(['groupe_id' => $id]);
            $cha = "TRUE";
            $clients = $this->Groupes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale'])->where(["Clients.etat='$cha'"]);
            $clientsl = $this->Groupes->Clients->find('all')
               ->where(["Clients.etat='$cha'"]);
        $this->set(compact('groupe', 'clients','lignegroupes','clientsl'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Groupe id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $groupe = $this->Groupes->get($id);
        if ($this->Groupes->delete($groupe)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Groupe'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Groupe'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

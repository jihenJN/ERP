<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Commandes Controller
 *
 * @property \App\Model\Table\CommandesTable $Commandes
 * @method \App\Model\Entity\Commande[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommandesController extends AppController
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
        $cond6 = '';
        
        $clientsoptions = $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $commercialsoptions = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $commercial_id = $this->request->getQuery('commercial_id');
        $client_id = $this->request->getQuery('client_id');
        $numero = $this->request->getQuery('numero');  
        $total = $this->request->getQuery('total');
        if ($au) {
             $cond6 = "Commandes.date like  '%" . $au . "%' ";
        }
        if ($historiquede) {
             $cond2 = "Commandes.date like  '%" . $historiquede . "%' ";
        }
        if ($total) {
            $cond1 = "Commandes.total like  '%" . $total . "%' ";
        }
        if ($commercial_id) {
            $cond3 = "Commandes.commercial_id like  '%" . $commercial_id . "%' ";
        }
        if ($client_id) {
            $cond4 = "Commandes.client_id like  '%" . $client_id . "%' ";
        }
        if ($numero) {
            $cond5 = "Commandes.numero like  '%" . $numero . "%' ";
        }
        
        $query = $this->Commandes->find('all')->where([$cond1,$cond2, $cond3, $cond4, $cond5, $cond6]);
        $this->paginate = [
            'contain' => ['Clients'],
        ];
        $commandes = $this->paginate($query);
        $clients =  $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('clients', 'commandes', 'commercials', 'clientsoptions', 'commercialsoptions','numero','total','client_id','commercial_id'));
    
    }
    public function imprimeview($id = null)
    {
    //     $commande = $this->Commandes->get($id, [
    //         'contain' => ['Lignecommandes'],
    //     ]);
    //     $clients =  $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
    //    $this->loadModel('Lignecommandes');
    //     $lignecommandes = $this->Commandes->Lignecommandes->find('all')->where(["Lignecommandes.commande_id=" . $id . " "]);
    //     //->where(["Lignecommandes.commandeclient_id=" . $id . " "])
    //     //debug($lignecommandeclients);
    //     $this->loadModel('articles');
    //     $articles = $this->articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
    //     $commercials = $this->Commandes->Commercials->find('list', ['limit' => 200]);
    //     $commandes = $this->Commandes->find();
    //     $this->set(compact('lignecommandes','commandes', 'articles', 'clients','commercials'));
    $commandes = $this->Commandes->get($id, [
        'contain' => ['Lignecommandes']
    ]);
    $clients = $this->Commandes->Clients->find('list', ['limit' => 200]);
    $commercials = $this->Commandes->Commercials->find('list', ['limit' => 200]);
    // $this->set(compact('commande','commercials','clients'));
    if ($this->request->is(['patch', 'post', 'put'])) {
        $commande = $this->Commandes->patchEntity($commandes, $this->request->getData(), ['associated' => ['Lignecommandes' => ['validate' => false]]]);
        if ($this->Commandes->save($commande)) {
            if (isset($this->request->getData('data')['Lignecommandes']) && (!empty($this->request->getData('data')['Lignecommandes']))) {
                foreach ($this->request->getData('data')['Lignecommandes'] as $i => $res) {
                    // debug($res);
                    //  die;

                    if ($res['sup0'] != 1) {
                        $dat['article_id'] = $res['article_id'];
                        $dat['qte'] = $res['qte'];
                        $dat['prix'] = $res['prix'];
                        $dat['total'] = $res['total'];
                        $dat['commandeclient_id'] = $id;
                        //debug($dat);
                        if (isset($res['id']) && (!empty($res['id']))) {

                            $lignecommande = $this->fetchTable('lignecommandes')->get($res['id'], [
                                'contain' => []
                            ]);
                        } else {
                            $lignecommande = $this->fetchTable('lignecommandes')->newEmptyEntity();
                        };
                        $lignecommande = $this->fetchTable('lignecommandes')->patchEntity($lignecommande, $dat);
                        //debug($lignecommandeclient);

                        if ($this->fetchTable('lignecommandes')->save($lignecommande)) {
                            // debug($lignecommandeclient);
                            $this->Flash->success("lignecommande has been edited successfully");
                        } else {
                            $this->Flash->error("Failed to edit");
                        }
                    }

                    $this->set(compact("lignecommande"));
                }
            }
            $this->Flash->success(__('The {0} has been saved.', 'Commande'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commandeclient'));

    }
   $clients = $this->Commandes->Clients->find('list', ['limit' => 200]);
   
    $this->loadModel('Lignecommandes');
    $lignecommandes = $this->Commandes->Lignecommandes->find('all')->where(["Lignecommandes.commande_id=" . $id . " "]);
    //debug($lignecommandeclients);
    $this->loadModel('articles');
    $articles = $this->articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
    $commandes = $this->Commandes->find();
    $this->set(compact('lignecommandes','articles', 'commandes', 'clients'));   
}
    


    public function imprimerrecherche($id = null)
    {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        
        $clientsoptions = $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $commercialsoptions = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $commercial_id = $this->request->getQuery('commercial_id');
        $client_id = $this->request->getQuery('client_id');
        $numero = $this->request->getQuery('numero');  
        $total = $this->request->getQuery('total');
        if ($au) {
            // $cond6 = "Commandes.date like  '%" . $au . "%' ";
        }
        if ($historiquede) {
            // $cond2 = "Commandes.date like  '%" . $historiquede . "%' ";
        }
        if ($total) {
            $cond1 = "Commandes.total like  '%" . $total . "%' ";
        }
        if ($commercial_id) {
            $cond3 = "Commandes.commercial_id like  '%" . $commercial_id . "%' ";
        }
        if ($client_id) {
            $cond4 = "Commandes.client_id like  '%" . $client_id . "%' ";
        }
        if ($numero) {
            $cond5 = "Commandes.numero like  '%" . $numero . "%' ";
        }
        
        $query = $this->Commandes->find('all')->where([$cond1,$cond2, $cond3, $cond4, $cond5, $cond6]);
        $this->paginate = [
            'contain' => ['Clients'],
        ];
        $commandes = $this->paginate($query);
        $clients =  $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('clients', 'commandes', 'commercials', 'clientsoptions', 'commercialsoptions','numero','total','client_id','commercial_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commande = $this->Commandes->get($id, [
            'contain' => ['Lignecommandes']
        ]);
        $clients = $this->Commandes->Clients->find('list', ['limit' => 200]);
        $commercialsoptions = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        // $this->set(compact('commande','commercials','clients'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commande = $this->Commandes->patchEntity($commande, $this->request->getData(), ['associated' => ['Lignecommandes' => ['validate' => false]]]);
            if ($this->Commandes->save($commande)) {
                if (isset($this->request->getData('data')['Lignecommandes']) && (!empty($this->request->getData('data')['Lignecommandes']))) {
                    foreach ($this->request->getData('data')['Lignecommandes'] as $i => $res) {
                        // debug($res);
                        //  die;

                        if ($res['sup0'] != 1) {
                            $dat['article_id'] = $res['article_id'];
                            $dat['qte'] = $res['qte'];
                            $dat['prix'] = $res['prix'];
                            $dat['total'] = $res['total'];
                            $dat['commandeclient_id'] = $id;
                            //debug($dat);
                            if (isset($res['id']) && (!empty($res['id']))) {

                                $lignecommande = $this->fetchTable('lignecommandes')->get($res['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $lignecommande = $this->fetchTable('lignecommandes')->newEmptyEntity();
                            };
                            $lignecommande = $this->fetchTable('lignecommandes')->patchEntity($lignecommande, $dat);
                            //debug($lignecommandeclient);

                            if ($this->fetchTable('lignecommandes')->save($lignecommande)) {
                                // debug($lignecommandeclient);
                                $this->Flash->success("lignecommande has been edited successfully");
                            } else {
                                $this->Flash->error("Failed to edit");
                            }
                        }

                        $this->set(compact("lignecommande"));
                    }
                }
                $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commandeclient'));

        }
       $clients = $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
       
        $this->loadModel('Lignecommandes');
        $lignecommandes = $this->Commandes->Lignecommandes->find('all')->where(["Lignecommandes.commande_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('Articles');
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $this->set(compact('lignecommandes', 'articles', 'commande', 'clients','commercials','commercialsoptions'));   }


    /**
     * Edit method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commande = $this->Commandes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commande = $this->Commandes->patchEntity($commande, $this->request->getData());
            if ($this->Commandes->save($commande)) {
                $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }
        $demandeoffredeprixes = $this->Commandes->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Commandes->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Commandes->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandes->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandes->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandes->Materieltransports->find('list', ['limit' => 200]);
        $this->set(compact('commande', 'demandeoffredeprixes', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commande = $this->Commandes->get($id);
        if ($this->Commandes->delete($commande)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Commande'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Commande'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

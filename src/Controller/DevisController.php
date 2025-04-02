<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Devis Controller
 *
 * @property \App\Model\Table\DevisTable $Devis
 * @method \App\Model\Entity\Devi[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DevisController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
       

        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        $client_id = $this->request->getQuery('client_id');
        

        if ($datedebut) {
            $cond2 = "date(Devis.date)   >= '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "date(Devis.date ) <=  '" . $datefin . "' ";
        }

       
        if ($client_id) {
            $cond4 = "Devis.client_id = '" . $client_id . "' ";
        }
      
        
       
        $query = $this->Devis->find('all')->where([$cond2, $cond3, $cond4])


        ->order(['Devis.id' => 'DESC']);

        $this->paginate = [
            'contain' => ['Clients'],
            'order' => ['Devis.id' => 'DESC'],
        ];
        $devis = $this->paginate( $query);
        $count = $query->count();

        $clients = $this->Devis->Clients->find('all');
    
        $this->set(compact('devis', 'count','clients', 'datefin', 'client_id', 'datedebut'));
    }

    /**
     * View method
     *
     * @param string|null $id Devi id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
  /*  public function view($id = null)
    {
        $devi = $this->Devis->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->set(compact('devi'));
    }*/





    public function view($id = null)
    {
        $devi = $this->Devis->get($id, [
            'contain' => ['Clients'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $devi = $this->Devis->patchEntity($devi, $this->request->getData());

            if ($this->Devis->save($devi)) {
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                   
                   
                    foreach ($this->request->getData('data')['ligner'] as $j => $p) {
                  
                        if ($p['sup'] != 1) {
                            $L_devi = $this->fetchTable('Lignedevis')->newEmptyEntity();
                            $data['devis_id'] = $devi->id;
                            $data['article_id'] = $p['article_id'];
                            $data['qte'] = $p['qte'];
                            $data['prix'] = $p['prix'];
                            $data['remise'] = $p['remise'];
                            $data['ht'] = $p['ht'];
                      

                            if (isset($p['id']) && (!empty($p['id']))) {
                               

                                $L_devi = $this->fetchTable('Lignedevis')->get($p['id'], [
                                    'contain' => []
                                ]);

                              
                            } else {
                                $L_devi = $this->fetchTable('Lignedevis')->newEmptyEntity();
                             //   debug($L_devi);die;
                            }

                            $lignedevis = $this->fetchTable('Lignedevis')->patchEntity($L_devi, $data);
                            $this->fetchTable('Lignedevis')->save($lignedevis);
                        } else if ($p['sup'] == 1 && !empty($p['id'])) {

                            $lignedevis = $this->fetchTable('Lignedevis')->get($p['id'], [
                                'contain' => []
                            ]);

                            $this->fetchTable('Lignedevis')->delete($lignedevis);
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The devi could not be saved. Please, try again.'));
        }

   
        if (!empty($devi->id)) {
            $lignedevis = $this->fetchTable('Lignedevis')->find('all')->where(['Lignedevis.devis_id'=>$devi->id])->toArray();
        }
      
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row->Code . '  ' . $row->Raison_Sociale; // Concatenate Raison_Sociale and code
            }
        ]);
        $articles = $this->fetchTable('Articles')->find('all');

        $this->set(compact('devi', 'clients','lignedevis','articles'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Clients');
        $devi = $this->Devis->newEmptyEntity();
        $devi['numero'] = $this->Devis->getNextNumero();
        if ($this->request->is('post')) {
            $devi = $this->Devis->patchEntity($devi, $this->request->getData());
            if ($this->Devis->save($devi)) {
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $j => $p) {
                        if ($p['sup'] != 1) {
                            $L_devi = $this->fetchTable('Lignedevis')->newEmptyEntity();
                            $data['devis_id'] = $devi->id;
                            $data['article_id'] = $p['article_id'];
                            $data['qte'] = $p['qte'];
                            $data['prix'] = $p['prix'];
                            $data['remise'] = $p['remise'];
                            $data['ht'] = $p['ht'];
                            $data['tva'] = $p['tva'];
                            $data['ttc'] = $p['ttc'];
                            $lignedevi = $this->fetchTable('Lignedevis')->patchEntity($L_devi, $data);
                            $this->fetchTable('Lignedevis')->save($lignedevi);
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row->Code . '  ' . $row->Raison_Sociale; // Concatenate Raison_Sociale and code
            }
        ]);
        $articles = $this->fetchTable('Articles')->find('all');
        $this->set(compact('devi', 'clients', 'articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Devi id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $devi = $this->Devis->get($id, [
            'contain' => ['Clients'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $devi = $this->Devis->patchEntity($devi, $this->request->getData());

            if ($this->Devis->save($devi)) {
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                   
                   
                    foreach ($this->request->getData('data')['ligner'] as $j => $p) {
                  
                        if ($p['sup'] != 1) {
                            $L_devi = $this->fetchTable('Lignedevis')->newEmptyEntity();
                            $data['devis_id'] = $devi->id;
                            $data['article_id'] = $p['article_id'];
                            $data['qte'] = $p['qte'];
                            $data['prix'] = $p['prix'];
                            $data['remise'] = $p['remise'];
                            $data['ht'] = $p['ht'];
                            $data['ttc'] = $p['ttc'];
                            $data['tva'] = $p['tva'];

                            if (isset($p['id']) && (!empty($p['id']))) {
                               

                                $L_devi = $this->fetchTable('Lignedevis')->get($p['id'], [
                                    'contain' => []
                                ]);

                              
                            } else {
                                $L_devi = $this->fetchTable('Lignedevis')->newEmptyEntity();
                             //   debug($L_devi);die;
                            }

                            $lignedevis = $this->fetchTable('Lignedevis')->patchEntity($L_devi, $data);
                            $this->fetchTable('Lignedevis')->save($lignedevis);
                        } else if ($p['sup'] == 1 && !empty($p['id'])) {

                            $lignedevis = $this->fetchTable('Lignedevis')->get($p['id'], [
                                'contain' => []
                            ]);

                            $this->fetchTable('Lignedevis')->delete($lignedevis);
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The devi could not be saved. Please, try again.'));
        }

   
        if (!empty($devi->id)) {
            $lignedevis = $this->fetchTable('Lignedevis')->find('all')->where(['Lignedevis.devis_id'=>$devi->id])->toArray();
        }
      
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row->Code . '  ' . $row->Raison_Sociale; // Concatenate Raison_Sociale and code
            }
        ]);
        $articles = $this->fetchTable('Articles')->find('all');

        $this->set(compact('devi', 'clients','lignedevis','articles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Devi id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $devi = $this->Devis->get($id);
        if ($this->Devis->delete($devi)) {
         //   $this->Flash->success(__('The devi has been deleted.'));
        } else {
          //  $this->Flash->error(__('The devi could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getArticleDetails()
    {
        $articleId = $this->request->getQuery('id'); // Get ID from AJAX request
        $article = $this->fetchTable('Articles')->find()
        ->select(['id', 'prixachat']) // Fetch necessary data
        ->where(['id' => $articleId])
        ->first();
        echo json_encode(['prixachat' => $article->prixachat]);
        exit;
       
    }
    

    }

<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Bonreceptionstocks Controller
 *
 * @property \App\Model\Table\BonreceptionstocksTable $Bonreceptionstocks
 * @method \App\Model\Entity\Bonreceptionstock[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BonreceptionstocksController extends AppController
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
        $cond7 = '';
        $cond8 = '';
        $cond9 = '';
        $cond10 = '';
        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');

        //$pointdevente_id = $this->request->getQuery('pointdevente_id');
        $depot_id = $this->request->getQuery('depot_id');
        $client_id = $this->request->getQuery('client_id');
        $typentree_id = $this->request->getQuery('typentree_id');
        $typereception_id = $this->request->getQuery('typereception_id');
        if ($datedebut) {
            $cond1 = "Bonreceptionstocks.date >=  '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond2 = "Bonreceptionstocks.date >=  '" . $datefin . "' ";
        }
        // if ($pointdevente_id) {
        //     $cond3 = "Bonreceptionstocks.pointdevente_id  =  '" .     $pointdevente_id . "' ";
        // }

          if ($client_id) {
            $cond3 = "Bonreceptionstocks.client_id  =  '" .     $client_id . "' ";
        }


        if ($typereception_id) {
            $cond9 = "Bonreceptionstocks.typereception_id   =  '" . $typereception_id . "' ";
        }
        if ($typentree_id) {
            $cond10 = "Bonreceptionstocks.typentree_id   =  '" . $typentree_id . "' ";
        }

        $query = $this->Bonreceptionstocks->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $cond9, $cond10])->order(['Bonreceptionstocks.id' => 'DESC']);
        $this->paginate = [
            'contain' => ['Depots', 'Typereceptions', 'Typentrees','Clients'],
        ];
        /// debug($query->toarray());
        $bonreceptionstocks = $this->paginate($query);
        // debug($bonreceptionstocks);
        $pointdeventes = $this->Bonreceptionstocks->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonreceptionstocks->Depots->find('list');
        $typentrees = $this->Bonreceptionstocks->Typentrees->find('list', ['limit' => 200]);
        $typereceptions = $this->Bonreceptionstocks->Typereceptions->find('list', ['limit' => 200]);

        $clients = $this->Bonreceptionstocks->Clients->find('all') ;





        $this->set(compact('bonreceptionstocks', 'pointdeventes', 'typereceptions', 'depots', 'personnels', 'typentrees', 'conffaieurs', 'clients','client_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Bonreceptionstock id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bonreceptionstock = $this->Bonreceptionstocks->get($id, [
            'contain' => ['Depots', 'Lignebonreceptionstocks'],
        ]);

        debug($bonreceptionstock) ;
        $this->loadModel('Lignebonreceptionstocks');

        $lignes = $this->Lignebonreceptionstocks->find('all')->where(["bonreceptionstock_id" => $id])->contain(['Articles']);

        $this->loadModel('Articles');

        $articles = $this->Articles->find('all');
        $pointdeventes = $this->Bonreceptionstocks->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonreceptionstocks->Depots->find('list', ['limit' => 200]);


        $typereceptions = $this->Bonreceptionstocks->Typereceptions->find('list', ['limit' => 200]);
        $typentrees = $this->Bonreceptionstocks->Typentrees->find('list', ['limit' => 200]);

        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        $this->loadModel('Clients');
        $clients = $this->Clients->find('all');
        $this->set(compact('bonreceptionstock', 'lignes', 'articles', 'depots', 'clients', 'typereceptions', 'typentrees'));
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
        $liendd = $session->read('lien_stock' . $abrv);

        //   debug($liendd);
        $unite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bonreceptionstocks') {
                $unite = $liens['ajout'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $bonreceptionstock = $this->Bonreceptionstocks->newEmptyEntity();
        $num = $this->Bonreceptionstocks->find()->select(["num" =>
        'MAX(Bonreceptionstocks.numero)'])->first();
        // debug($);

        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $numero = str_pad("$in", 6, "0", STR_PAD_LEFT);

        if ($this->request->is('post')) {

               
        ///  debug($this->request->getData());die;
            $bonreceptionstock = $this->Bonreceptionstocks->patchEntity($bonreceptionstock, $this->request->getData());

            //debug($bonreceptionstock);

            $typeR = $bonreceptionstock->typereception_id;
           /// $bonreceptionstock->observation = $this->request->getData('observation') ;

            //debug($bonreceptionstock) ;
            


            if ($this->Bonreceptionstocks->save($bonreceptionstock)) {
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    $this->loadModel('Lignebonreceptionstocks');

                    foreach ($this->request->getData('data')['ligner'] as $i => $li) {


                        if ($li['sup'] != 1) {



                                $data1['bonreceptionstock_id'] = $bonreceptionstock->id;
                                $data1['article_id'] = $li['article_id'];
                                // $data1['qtestock'] = $li['qtestock'];
                                $data1['qte'] = $li['qte'];
                                $data1['prix'] = $li['prix'];
                                $data1['total'] = $li['total'];
                            


                            $lignebs = $this->fetchTable('Lignebonreceptionstocks')->newEmptyEntity();
                            $lignebs = $this->Lignebonreceptionstocks->patchEntity($lignebs, $data1);
                           /// debug($lignebs);

                            if ($this->Lignebonreceptionstocks->save($lignebs)) {
                            } else {
                            }
                        }
                    }
                }
                $this->Lignebonreceptionstocks->save($lignebs);
            }
            $this->misejour("Bonreceptionstocks", "add", $bonreceptionstock->id);

            ///$this->Flash->success(__('The {0} has been saved.', 'Bonreceptionstock'));

            return $this->redirect(['action' => 'index']);
        }
        ///  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonreceptionstock'));

        $poindeventes = $this->Bonreceptionstocks->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonreceptionstocks->Depots->find('list', ['limit' => 200])->where(['id' => 49]);
        $typereceptions = $this->Bonreceptionstocks->Typereceptions->find('list', ['limit' => 200]);
        $typentrees = $this->Bonreceptionstocks->Typentrees->find('list', ['limit' => 200]);

        // $materieltransports = $this->Bonreceptionstocks->Materieltransports->find('list', ['limit' => 200]);
        // $cartecarburants = $this->Bonreceptionstocks->Cartecarburants->find('list', ['limit' => 200]);
        // $personnels = $this->Bonreceptionstocks->Personnels->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonreceptionstocks->Personnels->find('list', ['limit' => 200])->where(['fonction_id'=>1]);
        // $conffaieurs = $this->Bonreceptionstocks->Personnels->find('list', ['limit' => 200])->where(['fonction_id'=>5]);;
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        $this->loadModel('Clients');
        $clients = $this->Clients->find('all')->where(["Clients.etat = 'TRUE'"]);

        ///debug($clients);

        $this->set(compact('numero', 'bonreceptionstock', 'depots', 'articles', 'typentrees', 'clients', 'typereceptions', 'poindeventes'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Bonreceptionstock id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        error_reporting(E_ERROR | E_PARSE);

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_stock' . $abrv);

        //   debug($liendd);
        $unite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bonreceptionstocks') {
                $unite = $liens['modif'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $bonreceptionstock = $this->Bonreceptionstocks->get($id, [
            'contain' => []
        ]);
        debug($bonreceptionstock);
        $type = $bonreceptionstock->typereception_id ; 
       // debug($type);
        $this->loadModel('Lignebonreceptionstocks');
        if ($this->request->is(['patch', 'post', 'put'])) {
            /// debug($this->request->getData());
            $bonreceptionstock = $this->Bonreceptionstocks->patchEntity($bonreceptionstock, $this->request->getData());
            /// debug($bonreceptionstock);
            if ($this->Bonreceptionstocks->save($bonreceptionstock)) {
                $lignes = $this->Lignebonreceptionstocks->find()->where(["bonreceptionstock_id" => $id])->all();
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $li) {
                        if ($li['sup'] != 1) {

                            $data1['bonreceptionstock_id'] = $bonreceptionstock->id;
                            $data1['article_id'] = $li['article_id'];
                            $data1['qte'] = $li['qte'];
                            $data1['prix'] = $li['prix'];
                            $data1['total'] = $li['total'];

                            //debug($data1);die;
                            if (isset($li['id']) && (!empty($li['id']))) {

                                $lignest = $this->fetchTable('Lignebonreceptionstocks')->get($li['id'], [
                                    'contain' => []
                                ]);

                                //debug('rrr');

                            } else {
                                //debug('uuu');
                                $lignest  = $this->fetchTable('Lignebonreceptionstocks')->newEmptyEntity();
                            };
                            $lignest = $this->fetchTable('Lignebonreceptionstocks')->patchEntity($lignest, $data1);

                            if ($this->fetchTable('Lignebonreceptionstocks')->save($lignest)) {
                                // $this->Flash->success("Fournisseurbanques has been modified successfully");
                            } else {
                                // $this->Flash->error("Failed to modify fournisseurbanques");
                            }
                        } else {
                            if (!empty($li['id'])) {


                                // $this->request->allowMethod(['post', 'delete']);
                                $lignest = $this->fetchTable('Lignebonreceptionstocks')->get($li['id']);
                                $this->fetchTable('Lignebonreceptionstocks')->delete($lignest);
                            }
                        }
                    }
                }
                $this->misejour("Bonreceptionstocks", "edit", $id);

                // $this->Flash->success(__('The {0} has been saved.', 'Bonreceptionstock'));

                return $this->redirect(['action' => 'index']);
            }
            ///  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonreceptionstock'));
        }
        $pointdeventes = $this->Bonreceptionstocks->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonreceptionstocks->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonreceptionstocks->Materieltransports->find('list', ['limit' => 200]);
        $cartecarburants = $this->Bonreceptionstocks->Cartecarburants->find('list', ['limit' => 200]);
        $personnels = $this->Bonreceptionstocks->Personnels->find('list', ['limit' => 200]);
        $chauffeurs = $this->Bonreceptionstocks->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 1]);
        $conffaieurs = $this->Bonreceptionstocks->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 5]);;
        $lignes = $this->Lignebonreceptionstocks->find('all')->where(["bonreceptionstock_id" => $id])->contain(['Articles']);
        ////  debug($lignes->toarray());
        $count = $this->Lignebonreceptionstocks->find()->where(["bonreceptionstock_id" => $id])->count();
        $typereceptions = $this->Bonreceptionstocks->Typereceptions->find('list', ['limit' => 200]);
        $typentrees = $this->Bonreceptionstocks->Typentrees->find('list', ['limit' => 200]);

        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        $this->loadModel('Clients');
        $clients = $this->Clients->find('all');
        $this->set(compact('bonreceptionstock', 'pointdeventes', 'depots', 'typereceptions', 'typentrees', 'clients', 'conffaieurs', 'chauffeurs', 'lignes', 'articles', 'count','type'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Bonreceptionstock id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_stock' . $abrv);

        //   debug($liendd);
        $unite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bonreceptionstocks') {
                $unite = $liens['supp'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $bn = $this->Bonreceptionstocks->get($id);
        $lignes = $this->fetchTable('Lignebonreceptionstocks')->find('all', [])
            ->where(['Lignebonreceptionstocks.bonreceptionstock_id=' . $id]);
        if ($this->Bonreceptionstocks->delete($bn)) {
            $this->misejour("Bonreceptionstocks", "delete", $id);
            foreach ($lignes as $l) {
                $this->fetchTable('Lignebonreceptionstocks')->delete($l);
            }
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

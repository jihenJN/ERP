<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Bondetransferts Controller
 *
 * @property \App\Model\Table\BondetransfertsTable $Bondetransferts
 * @method \App\Model\Entity\Bondetransfert[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BondetransfertsController extends AppController
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
        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');

        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $materieltransport_id = $this->request->getQuery('materieltransport_id');
        $depot_id_arrive = $this->request->getQuery('depot_id_arrive');
        $depot_id_sortie = $this->request->getQuery('depot_id_sortie');
        $pointdeventeentree_id = $this->request->getQuery('pointdeventeentree_id');
        $pointdeventesortie_id = $this->request->getQuery('pointdeventesortie_id');


        $conffaieur_id = $this->request->getQuery('conffaieur_id');
        $cartecarburant_id = $this->request->getQuery('cartecarburant_id');
        $chauffeur_id = $this->request->getQuery('chauffeur_id');
        if ($datedebut) {
            $cond1 = "Bondetransferts.date >=  '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond2 = "Bondetransferts.date >=  '" . $datefin . "' ";
        }
        // if ($pointdevente_id) {
        //     $cond3 = "Bondetransferts.pointdevente_id  =  '" .     $pointdevente_id . "' ";
        // }


        if ($pointdeventeentree_id) {
            $cond4 = "Bondetransferts.pointdeventeentree_id  = '" . $pointdeventeentree_id . "' ";
        }
        if ($pointdeventesortie_id) {
            $cond4 = "Bondetransferts.pointdeventesortie_id  = '" . $pointdeventesortie_id . "' ";
        }


        if ($depot_id_arrive) {
            $cond5 = "Bondetransferts.depotarrive_id =  '" .  $depot_id_arrive . "' ";
        }
        if ($depot_id_sortie) {
            $cond6 = "Bondetransferts.depotsortie_id   =  '" . $depot_id_sortie . "' ";
        }
        // if ($conffaieur_id) {
        //     $cond7 = "Bondetransferts.conffaieur_id   =  '" . $conffaieur_id . "' ";
        // }
        // if ($cartecarburant_id) {
        //     $cond8 = "Bondetransferts.cartecarburant_id   =  '" . $cartecarburant_id . "' ";
        // }
        // if ($chauffeur_id) {
        //     $cond9 = "Bondetransferts.chauffeur_id   =  '" . $chauffeur_id . "' ";
        // }

        $this->paginate = [
            'contain' => ['Pointdeventes', 'Depots'],
        ];
        $query = $this->Bondetransferts->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $cond9])->order(['Bondetransferts.id' => "DESC"]) ;

        $bondetransferts = $this->paginate($query);
        $pointdeventes = $this->Bondetransferts->Pointdeventes->find('list', ['limit' => 200]);
        $pointdeventess = $this->Bondetransferts->Pointdeventes->find('all');
        $materieltransports = $this->Bondetransferts->Materieltransports->find('all');
        $depots = $this->Bondetransferts->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotss = $this->Bondetransferts->Depots->find('all');
        $cartecarburants = $this->Bondetransferts->Cartecarburants->find('all');
        $chauffeurs = $this->Bondetransferts->Personnels->find('all')->where(['fonction_id' => 1]);
        $conffaieurs = $this->Bondetransferts->Personnels->find('all')->where(['fonction_id' => 5]);;

        $this->set(compact('bondetransferts', 'pointdeventes', 'materieltransports', 'depots', 'depotss', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'pointdeventess'));
    }

    /**
     * View method
     *
     * @param string|null $id Bondetransfert id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bondetransfert = $this->Bondetransferts->get($id, [
            'contain' => ['Pointdeventes', 'Depots', 'Lignebondetransferts'],
        ]);
        $this->loadModel('Lignebondetransferts');

        $lignes = $this->Lignebondetransferts->find()->where(["bondetransfert_id" => $id])->all();
        $count = $this->Lignebondetransferts->find()->where(["bondetransfert_id" => $id])->count();

        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        $pointdeventes = $this->Bondetransferts->Pointdeventes->find('list', ['limit' => 200]);
        $depotarrives = $this->Bondetransferts->Depots->find('list', ['limit' => 200]);
        $depotdeparts = $this->Bondetransferts->Depots->find('list', ['limit' => 200]);
        $this->set(compact('bondetransfert', 'lignes', 'articles', 'pointdeventes', 'depotdeparts', 'depotarrives'));
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
            if (@$liens['lien'] == 'bondetransferts') {
                $unite = $liens['ajout'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $bondetransfert = $this->Bondetransferts->newEmptyEntity();

        if ($this->request->is('post')) {
            $bondetransfert = $this->Bondetransferts->patchEntity($bondetransfert, $this->request->getData());
            // debug($bondetransfert);
            if ($this->Bondetransferts->save($bondetransfert)) {
                $this->loadModel('Lignebondetransferts');
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {

                    foreach ($this->request->getData('data')['ligner'] as $i => $li) {
                        if ($li['sup'] != 1) {
                            //debug($dep['sup1']);
                            $data1['bondetransfert_id'] = $bondetransfert->id;
                            $data1['article_id'] = $li['article_id'];
                            $data1['qteliv'] = $li['qteliv'];
                            $data1['qte'] = $li['qte'];

                            $lignetr = $this->fetchTable('Lignebondetransferts')->newEmptyEntity();
                            $lignetr = $this->Lignebondetransferts->patchEntity($lignetr, $data1);
                            // debug($lignetr);

                            if ($this->Lignebondetransferts->save($lignetr)) {
                            } else {
                            }
                        }
                    }
                }
                $this->Lignebondetransferts->save($lignetr);
                $this->misejour("BondeTransferts", "add", $bondetransfert->id);

                /// $this->Flash->success(__('The {0} has been saved.', 'Bondetransfert'));

                return $this->redirect(['action' => 'index']);
            }
            /// $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bondetransfert'));
        }
        $poindeventes = $this->Bondetransferts->Pointdeventes->find('list', ['limit' => 200]);
        $depotarrives = $this->Bondetransferts->Depots->find('list', ['limit' => 200]);
        $depotdeparts = $this->Bondetransferts->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Bondetransferts->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Bondetransferts->Materieltransports->find('list', ['limit' => 200]);
        $chauffeurs = $this->Bondetransferts->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 1]);
        $conffaieurs = $this->Bondetransferts->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 5]);;
        $bonreceptionstocks = $this->Bondetransferts->Bonreceptionstocks->find('list', ['limit' => 200]);
        $last_bondetransfert = $this->Bondetransferts->find()->order(['id' => "desc"])->first();
        $num = $this->Bondetransferts->find()->select(["num" =>
        'MAX(Bondetransferts.numero)'])->first();
        // debug($);

        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $numero = str_pad("$in", 6, "0", STR_PAD_LEFT);

        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        $this->set(compact('numero', 'chauffeurs', 'conffaieurs', 'articles', 'bondetransfert', 'poindeventes', 'cartecarburants', 'materieltransports', 'chauffeurs', 'conffaieurs', 'bonreceptionstocks'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Bondetransfert id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_stock' . $abrv);

        //   debug($liendd);
        $unite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bondetransferts') {
                $unite = $liens['modif'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $bondetransfert = $this->Bondetransferts->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Lignebondetransferts');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $bondetransfert = $this->Bondetransferts->patchEntity($bondetransfert, $this->request->getData());
            if ($this->Bondetransferts->save($bondetransfert)) {
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $li) {
                        if ($li['sup'] != 1) {

                            $data1['bondetransfert_id'] = $bondetransfert->id;
                            $data1['article_id'] = $li['article_id'];
                            //  $data1['qtestock'] = $li['qtestock'];
                            $data1['qte'] = $li['qte'];
                            $data1['qteliv'] = $li['qteliv'];


                            //debug($data1);die;
                            if (isset($li['id']) && (!empty($li['id']))) {

                                $lignest = $this->fetchTable('Lignebondetransferts')->get($li['id'], [
                                    'contain' => []
                                ]);

                                //debug('rrr');

                            } else {
                                //debug('uuu');
                                $lignest  = $this->fetchTable('Lignebondetransferts')->newEmptyEntity();
                            };
                            $lignest = $this->fetchTable('Lignebondetransferts')->patchEntity($lignest, $data1);

                            if ($this->fetchTable('Lignebondetransferts')->save($lignest)) {
                                // $this->Flash->success("Fournisseurbanques has been modified successfully");
                            } else {
                                // $this->Flash->error("Failed to modify fournisseurbanques");
                            }
                        } else {
                            if (!empty($li['id'])) {


                                // $this->request->allowMethod(['post', 'delete']);
                                $lignest = $this->fetchTable('Lignebondetransferts')->get($li['id']);
                                $this->fetchTable('Lignebondetransferts')->delete($lignest);
                            }
                        }
                    }
                }
                $this->misejour("BondeTransferts", "edit", $id);

                /// $this->Flash->success(__('The {0} has been saved.', 'Bondetransfert'));

                return $this->redirect(['action' => 'index']);
            }
            /// $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bondetransfert'));
        }
        $pointdeventes = $this->Bondetransferts->Pointdeventes->find('list', ['limit' => 200]);
        $depotarrives = $this->Bondetransferts->Depots->find('list', ['limit' => 200]);
        $depotdeparts = $this->Bondetransferts->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Bondetransferts->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Bondetransferts->Materieltransports->find('list', ['limit' => 200]);
        $chauffeurs = $this->Bondetransferts->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 1]);
        $conffaieurs = $this->Bondetransferts->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 5]);;
        $bonreceptionstocks = $this->Bondetransferts->Bonreceptionstocks->find('list', ['limit' => 200]);
        $lignes = $this->Lignebondetransferts->find()->where(["bondetransfert_id" => $id])->all();
        $count = $this->Lignebondetransferts->find()->where(["bondetransfert_id" => $id])->count();

        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        $this->set(compact('lignes', 'count', 'articles', 'bondetransfert', 'pointdeventes', 'depotarrives', 'depotdeparts', 'cartecarburants', 'materieltransports', 'chauffeurs', 'conffaieurs', 'bonreceptionstocks'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Bondetransfert id.
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
            if (@$liens['lien'] == 'bondetransferts') {
                $unite = $liens['supp'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $bn = $this->Bondetransferts->get($id);
        $lignes = $this->fetchTable('Lignebondetransferts')->find('all', [])
            ->where(['Lignebondetransferts.bondetransfert_id=' . $id]);
        if ($this->Bondetransferts->delete($bn)) {
            $this->misejour("Bondetransferts", "delete", $id);
            foreach ($lignes as $l) {
                $this->fetchTable('Lignebondetransferts')->delete($l);
            }
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

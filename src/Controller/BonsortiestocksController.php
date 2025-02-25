<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;

/**
 * Bonsortiestocks Controller
 *
 * @property \App\Model\Table\BonsortiestocksTable $Bonsortiestocks
 * @method \App\Model\Entity\Bonsortiestock[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BonsortiestocksController extends AppController
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
        $depot_id = $this->request->getQuery('depot_id');

        $conffaieur_id = $this->request->getQuery('conffaieur_id');
        $cartecarburant_id = $this->request->getQuery('cartecarburant_id');
        $chauffeur_id = $this->request->getQuery('chauffeur_id');
        if ($datedebut) {
            $cond1 = "Bonsortiestocks.date >=  '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond2 = "Bonsortiestocks.date >=  '" . $datefin . "' ";
        }
        if ($pointdevente_id) {
            $cond3 = "Bonsortiestocks.pointdevente_id  =  '" .     $pointdevente_id . "' ";
        }


        if ($materieltransport_id) {
            $cond4 = "Bonsortiestocks.materieltransport_id  = '" . $materieltransport_id . "' ";
        }


        if ($depot_id) {
            $cond5 = "Bonsortiestocks.depot_id =  '" .  $depot_id . "' ";
        }

        if ($conffaieur_id) {
            $cond7 = "Bonsortiestocks.conffaieur_id   =  '" . $conffaieur_id . "' ";
        }
        if ($cartecarburant_id) {
            $cond8 = "Bonsortiestocks.cartecarburant_id   =  '" . $cartecarburant_id . "' ";
        }
        if ($chauffeur_id) {
            $cond9 = "Bonsortiestocks.chauffeur_id   =  '" . $chauffeur_id . "' ";
        }

        $this->paginate = [
            'contain' => ['Pointdeventes', 'Materieltransports', 'Depots'],
        ];
        $query = $this->Bonsortiestocks->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $cond9])->order(['Bonsortiestocks.id' => 'DESC']);

        $bonsortiestocks = $this->paginate($query);
        $pointdeventes = $this->Bonsortiestocks->Pointdeventes->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonsortiestocks->Materieltransports->find('all');
        $depots = $this->Bonsortiestocks->Depots->find('list');
        $cartecarburants = $this->Bonsortiestocks->Cartecarburants->find('all');
        $chauffeurs = $this->Bonsortiestocks->Personnels->find('all')->where(['fonction_id' => 1]);
        $conffaieurs = $this->Bonsortiestocks->Personnels->find('all')->where(['fonction_id' => 5]);;
        $this->set(compact('bonsortiestocks', 'pointdeventes', 'materieltransports', 'depots', 'cartecarburants', 'chauffeurs', 'conffaieurs'));
    }

    /**
     * View method
     *
     * @param string|null $id Bonsortiestock id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bonsortiestock = $this->Bonsortiestocks->get($id, [
            'contain' => ['Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants', 'Lignebonsortiestocks', 'Personnels'],
        ]);
        $depots = $this->Bonsortiestocks->Depots->find('all');

        $this->loadModel('Lignebonsortiestocks');

        $lignes = $this->Lignebonsortiestocks->find()->where(["bonsortiestock_id" => $id])->contain(['Articles'])->all();

        $this->loadModel('Articles');

        $articles = $this->Articles->find('all');
        $pointdeventes = $this->Bonsortiestocks->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonsortiestocks->Depots->find('list', ['limit' => 200]);
        $lignes = $this->Lignebonsortiestocks->find()->where(["bonsortiestock_id" => $id])->all();
        $count = $this->Lignebonsortiestocks->find()->where(["bonsortiestock_id" => $id])->count();
        $typesorties = $this->Bonsortiestocks->Typesorties->find('list', ['limit' => 200]);


        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('machines','bonsortiestock', 'pointdeventes', 'depots', 'lignes', 'count', 'articles','typesorties'));
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
            if (@$liens['lien'] == 'bonsortiestocks') {
                $unite = $liens['ajout'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $bonsortiestock = $this->Bonsortiestocks->newEmptyEntity();
        $num = $this->Bonsortiestocks->find()->select(["num" =>
        'MAX(Bonsortiestocks.numero)'])->first();
        // debug($);

        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $numero = str_pad("$in", 6, "0", STR_PAD_LEFT);

        if ($this->request->is('post')) {
            // debug($this->request->getData()) ;
            $bonsortiestock = $this->Bonsortiestocks->patchEntity($bonsortiestock, $this->request->getData());

            ///  debug( $bonsortiestock);

            if ($this->Bonsortiestocks->save($bonsortiestock)) {

                $this->loadModel('Lignebonsortiestocks');
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {


                    foreach ($this->request->getData('data')['ligner'] as $i => $li) {
                        if ($li['sup'] != 1) {
                            //debug($dep['sup1']);
                            $data1['bonsortiestock_id'] = $bonsortiestock->id;
                            $data1['article_id'] = $li['article_id'];
                            $data1['qtestock'] = $li['qtestock'];
                            $data1['qte'] = $li['qte'];
                            $data1['prix'] = $li['prix'];
                            $data1['total'] = $li['total'];

                            $lignebs = $this->fetchTable('Lignebonsortiestocks')->newEmptyEntity();
                            $lignebs = $this->Lignebonsortiestocks->patchEntity($lignebs, $data1);
                            // debug($lignebs);

                            if ($this->Lignebonsortiestocks->save($lignebs)) {
                            } else {
                            }
                        }
                    }
                }
                $this->misejour("Bonsortiestocks", "add", $bonsortiestock->id);

                ///  $this->Flash->success(__('The {0} has been saved.', 'Bonsortiestock'));

                return $this->redirect(['action' => 'index']);
            }
            ///   $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonsortiestock'));
        }
        $poindeventes = $this->Bonsortiestocks->Pointdeventes->find('list', ['limit' => 200]);
        $typesorties = $this->Bonsortiestocks->Typesorties->find('list', ['limit' => 200]);
        //debug($typedesorties->toarray());
        $depotarrives = $this->Bonsortiestocks->Depots->find('list', ['limit' => 200]);
        $depotdeparts = $this->Bonsortiestocks->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonsortiestocks->Materieltransports->find('list', ['limit' => 200]);
        $cartecarburants = $this->Bonsortiestocks->Cartecarburants->find('list', ['limit' => 200]);
        $chauffeurs = $this->Bonsortiestocks->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 1]);
        $conffaieurs = $this->Bonsortiestocks->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 5]);;
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
         $depots = $this->fetchTable('Depots')->find('list');

        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $this->set(compact('machines','depots','numero', 'bonsortiestock', 'articles', 'poindeventes', 'depotarrives', 'depotdeparts', 'materieltransports', 'cartecarburants', 'conffaieurs', 'chauffeurs','typesorties'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Bonsortiestock id.
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
            if (@$liens['lien'] == 'bonsortiestocks') {
                $unite = $liens['modif'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $bonsortiestock = $this->Bonsortiestocks->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Lignebonsortiestocks');
        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData()) ;
            $bonsortiestock = $this->Bonsortiestocks->patchEntity($bonsortiestock, $this->request->getData());

            if ($this->Bonsortiestocks->save($bonsortiestock)) {
                $lignes = $this->Lignebonsortiestocks->find()->where(["bonsortiestock_id" => $id])->all();
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $li) {
                        $this->loadModel('Lignebonsortiestocks');
                        if ($li['sup'] != 1) {

                            $data1['bonsortiestock_id'] = $bonsortiestock->id;
                            $data1['article_id'] = $li['article_id'];
                            $data1['qtestock'] = $li['qtestock'];
                            $data1['qte'] = $li['qte'];
                            $data1['prix'] = $li['prix'];
                            $data1['total'] = $li['total'];

                            //debug($data1);die;
                            if (isset($li['id']) && (!empty($li['id']))) {

                                $lignest = $this->fetchTable('Lignebonsortiestocks')->get($li['id'], [
                                    'contain' => []
                                ]);

                                //debug('rrr');

                            } else {
                                //debug('uuu');
                                $lignest  = $this->fetchTable('Lignebonsortiestocks')->newEmptyEntity();
                            };
                            $lignest = $this->fetchTable('Lignebonsortiestocks')->patchEntity($lignest, $data1);




                            if ($this->fetchTable('Lignebonsortiestocks')->save($lignest)) {
                                // $this->Flash->success("Fournisseurbanques has been modified successfully");
                            } else {
                                // $this->Flash->error("Failed to modify fournisseurbanques");
                            }
                        } else {
                            if (!empty($li['id'])) {


                                // $this->request->allowMethod(['post', 'delete']);
                                $lignest = $this->fetchTable('Lignebonsortiestocks')->get($li['id']);
                                $this->fetchTable('Lignebonsortiestocks')->delete($lignest);
                            }
                        }
                    }
                }
                $this->misejour("Bonsortiestocks", "edit", $bonsortiestock->id);

                // $this->Flash->success(__('The {0} has been saved.', 'Bonsortiestock'));

                return $this->redirect(['action' => 'index']);
            }
            /// $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonsortiestock'));
        }
        $pointdeventes = $this->Bonsortiestocks->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonsortiestocks->Depots->find('list', ['limit' => 200]);
        $typesorties = $this->Bonsortiestocks->Typesorties->find('list', ['limit' => 200]);
        $lignes = $this->Lignebonsortiestocks->find()->where(["bonsortiestock_id" => $id])->all();
        $count = $this->Lignebonsortiestocks->find()->where(["bonsortiestock_id" => $id])->count();
        $depots = $this->fetchTable('Depots')->find('list');

        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('machines','bonsortiestock', 'pointdeventes', 'depots', 'lignes', 'count', 'articles','typesorties'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Bonsortiestock id.
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
            if (@$liens['lien'] == 'bonsortiestocks') {
                $unite = $liens['supp'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
      //  $this->request->allowMethod(['post', 'delete']);
        $bonsortiestock = $this->Bonsortiestocks->get($id);
        $lignes = $this->fetchTable('Lignebonsortiestocks')->find('all', [])
            ->where(['Lignebonsortiestocks.bonsortiestock_id=' . $id]);
        if ($this->Bonsortiestocks->delete($bonsortiestock)) {
            $this->misejour("Bonsortiestocks", "delete", $id);
            foreach ($lignes as $l) {
                $this->fetchTable('Lignebonsortiestocks')->delete($l);
            }
        } else {
        }
        return $this->redirect(['action' => 'index']);
    }





    public function getquantite()

    {

        date_default_timezone_set('Africa/Tunis');
        $articleid = $this->request->getQuery('idarticle');
      //  $date = $this->request->getQuery('date');
        $date = date('Y-m-d H:i:s'); // Obtient la date et l'heure au format 'YYYY-MM-DD HH:MM:SS'

         ///debug($date);
        $depotid = $this->request->getQuery('depot');
        //$client = $this->request->getQuery('client');


        


        $donnearticle = $this->fetchTable('Articles')->get($articleid, [
            'contain' => [],
        ]);
        ///debug($donnearticle);
        // if ($client){
        //     $clientt = $this->fetchTable('Clients')->get($client, [
        //         'contain' => [],
        //     ]);
    
        //     $remise = $clientt->remise ;

        //     $ligne = $this->prixspeciale($client, $articleid);
        //     //debug($ligne);
           

        // }
      
       /// debug($remise);

        $p = $donnearticle['Prix_LastInput'];
        $fod = $donnearticle['fodec'];
        $remiseart = $donnearticle['remise'];
        $tva_id = $donnearticle['tva_id'];

        ///($fod);
        $tv = $this->fetchTable('Tvas')->get($tva_id, [
            'contain' => [],
        ]);
        $val = $tv->valeur ;
        ///debug($val);
    
        $connection = ConnectionManager::get('default');
        $inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
        $inv = $inventaires[0]['v'] ;

        //debug($inv);
      

        echo json_encode(array('qtes' => $inv, 'prix' => $p, 'tva' => $val, 'fodec' => $fod, 'remiseart' => $remiseart, 'remise' => $remiseart,  "success" => true));
       die ;
        
       
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Besionachats Controller
 *
 * @property \App\Model\Table\BesionachatsTable $Besionachats
 * @method \App\Model\Entity\Besionachat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BesionachatsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    { {

            $numero = $this->request->getQuery('numero');
            $date = $this->request->getQuery('date');
            $personnel_id = $this->request->getQuery('personnel_id');
            $cond1 = '';
            $cond2 = '';
            $cond3 = '';
            if ($numero) {
                $cond1 = "Besionachats.numero  like  '%" . $numero . "%' ";
            }
            if ($date) {
                // $cond2 = "Besionachats.date  like  '%" . $date . "%' ";
                $cond2 = "Besionachats.date >= '" . $date . " 00:00:00'";
            }
            if ($personnel_id) {
                $cond3 = "Besionachats.personnel_id  like  '%" . $personnel_id . "%' ";
            }
            $query = $this->Besionachats->find('all')->where([$cond1, $cond2, $cond3])->order(["Besionachats.id" => 'desc']);
            $this->paginate = [
                'contain' => ['Personnels'],
            ];
            $besionachats = $this->paginate($query);
            $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
            $this->set(compact('besionachats', 'personnels'));
        }
    }

    /**
     * 
     * 
     * View method
     *
     * @param string|null $id Besionachat id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view2011($id = null)
    {
        $besionachat = $this->Besionachats->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('besionachat'));
    }
    public function view($id = null)
    {
        $besionachat = $this->Besionachats->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $besionachat = $this->Besionachats->patchEntity($besionachat, $this->request->getData());
            if ($this->Besionachats->save($besionachat)) {
                $besionachat_id = $besionachat->id;
                $besionachat_id = ($this->Besionachats->save($besionachat)->id);
                $this->misejour("Besionachats", "edit", $besionachat_id);
                if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
                    $fournisseurbanques = $this->fetchTable('Lignebesionachats')->find('all')->where(["Lignebesionachats.article_id =" . $id]);
                    foreach ($this->request->getData('data')['lignea'] as $i => $art) {
                        if ($art['sup2'] != '1') {
                            $tab3['besionachat_id'] = $besionachat_id;
                            if ($art['desginationA'] == "") {
                                $tab3['article_id'] = $art['article_id'];
                            } else {
                                $tab3['article_id'] = "";
                            }
                            $tab3['qte'] = $art['qte'];
                            if (isset($art['id']) && (!empty($art['id']))) {
                                $lignes2 = $this->fetchTable('Lignebesionachats')->get($art['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $lignes2 = $this->fetchTable('Lignebesionachats')->newEmptyEntity();
                                $lignes2['besionachat_id'] = $besionachat_id;
                            }
                            $lignes2 = $this->fetchTable('Lignebesionachats')->patchEntity($lignes2, $tab3);

                            if ($this->fetchTable('Lignebesionachats')->save($lignes2)) {
                            } else {
                            }
                        } else {
                            if (!empty($art['id'])) {
                                $lignes2 = $this->fetchTable('Lignebesionachats')->get($art['id']);
                                $this->fetchTable('Lignebesionachats')->delete($lignes2);
                            }
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
        }

        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $art = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']); //->where(['Articles.famille_id = 2']);
        $lignebesionachats = $this->fetchTable('Lignebesionachats')->find('all')->where(['Lignebesionachats.besionachat_id' => $id]);
        $articles = $this->fetchTable('Articles')->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation']); //->where(['Articles.famille_id = 2']);;
        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $this->set(compact('machines', 'besionachat', 'lignebesionachats', 'art', 'personnels', 'articles', 'services'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {


        $besionachat = $this->Besionachats->newEmptyEntity();

        if ($this->request->is('post')) {

            $num = $this->Besionachats->find()
                ->select(["num" => 'MAX(Besionachats.numero)'])
                ->where(['Besionachats.date' => $this->Besionachats->find()->select(['max_date' => 'MAX(Besionachats.date)'])])
                ->first();


            $n = $num->num;

            $in = intval($n) + 1;

            $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);

            $besionachat = $this->Besionachats->patchEntity($besionachat, $this->request->getData());
            $besionachat->numero = $mm;
            if ($this->Besionachats->save($besionachat)) {
                $besionachat_id = $besionachat->id;

                if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {

                    foreach ($this->request->getData('data')['lignes'] as $i => $l) {

                        if ($l['sup2'] != '1') {

                            $tab = $this->fetchTable('Lignebesionachats')->newEmptyEntity();
                            $tab['besionachat_id'] = $besionachat_id;;
                            $tab['article_id'] = $l['article_id'];
                            $tab['desginationA'] = $l['desginationA'];

                            $tab['qte'] = $l['qte'];
                            $this->fetchTable('Lignebesionachats')->save($tab);
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
        }
        $num = $this->Besionachats->find()
            ->select(["num" => 'MAX(Besionachats.numero)'])
            ->where(['Besionachats.date' => $this->Besionachats->find()->select(['max_date' => 'MAX(Besionachats.date)'])])
            ->first();


        $n = $num->num;

        $in = intval($n) + 1;

        $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);
        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);



        $articles = $this->fetchTable('Articles')->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation']); //->where(['Articles.famille_id = 2']);

        $this->set(compact('machines', 'services', 'besionachat', 'mm', 'articles', 'personnels'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Besionachat id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    public function edit($id = null)
    {
        $besionachat = $this->Besionachats->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $besionachat = $this->Besionachats->patchEntity($besionachat, $this->request->getData());
            //debug($this->request->getData());
            if ($this->Besionachats->save($besionachat)) {
                $besionachat_id = $besionachat->id;
                $besionachat_id = ($this->Besionachats->save($besionachat)->id);
                $this->misejour("Besionachats", "edit", $besionachat_id);
                if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
                    $fournisseurbanques = $this->fetchTable('Lignebesionachats')->find('all')->where(["Lignebesionachats.article_id =" . $id]);
                    foreach ($this->request->getData('data')['lignea'] as $i => $art) {
                        if ($art['sup2'] != '1') {
                            $tab3['besionachat_id'] = $besionachat_id;


                            $tab3['article_id'] = $art['article_id'];
                            $tab3['desginationA'] = $art['desginationA'];

                            $tab3['qte'] = $art['qte'];
                            if (isset($art['id']) && (!empty($art['id']))) {
                                $lignes2 = $this->fetchTable('Lignebesionachats')->get($art['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $lignes2 = $this->fetchTable('Lignebesionachats')->newEmptyEntity();
                                $lignes2['besionachat_id'] = $besionachat_id;
                            }
                            $lignes2 = $this->fetchTable('Lignebesionachats')->patchEntity($lignes2, $tab3);

                            if ($this->fetchTable('Lignebesionachats')->save($lignes2)) {
                            } else {
                            }
                        } else {
                            if (!empty($art['id'])) {
                                $lignes2 = $this->fetchTable('Lignebesionachats')->get($art['id']);
                                $this->fetchTable('Lignebesionachats')->delete($lignes2);
                            }
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
        }

        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $art = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']); //->where(['Articles.famille_id = 2']);
        $lignebesionachats = $this->fetchTable('Lignebesionachats')->find('all')->where(['Lignebesionachats.besionachat_id' => $id]);
        $articles = $this->fetchTable('Articles')->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation']); //->where(['Articles.famille_id = 2']);
        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $this->set(compact('machines', 'besionachat', 'lignebesionachats', 'art', 'personnels', 'articles', 'services'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Besionachat id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete22042024($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $besionachat = $this->Besionachats->get($id);
        if ($this->Besionachats->delete($besionachat)) {
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $besionachat = $this->Besionachats->get($id);

        $lignebesoin = $this->fetchTable('Lignebesionachats')->find('all')
            ->where(["Lignebesionachats.besionachat_id  ='" . $id . "'"]);
        foreach ($lignebesoin as $c) {
            $this->fetchTable('Lignebesionachats')->delete($c);
        }
        if ($this->Besionachats->delete($besionachat)) {
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }


    public function imprimeview($id = null)
    {
        $besionachat = $this->Besionachats->get($id, [
            'contain' => ['Personnels'],
        ]);
    

        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $art = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']); //->where(['Articles.famille_id = 2']);
        $lignebesionachats = $this->fetchTable('Lignebesionachats')->find('all',[
            'contain' => ['Articles'],
        ])->where(['Lignebesionachats.besionachat_id' => $id]);
        $articles = $this->fetchTable('Articles')->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation']); //->where(['Articles.famille_id = 2']);;
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $services = $this->fetchTable('Services')->find();
        $count = $this->fetchTable('Services')->find()->count();


        $this->set(compact('count','machines', 'besionachat', 'lignebesionachats', 'art', 'personnels', 'articles', 'services'));
    }
}

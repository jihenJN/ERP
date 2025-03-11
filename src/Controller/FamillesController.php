<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Familles Controller
 *
 * @property \App\Model\Table\FamillesTable $Familles
 * @method \App\Model\Entity\Famille[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FamillesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    // public function editarticles($id = null) {
    //     $id = $this->request->getQuery('idFamille');
    //     $famille = $this->Familles->find('all', [
    //         'contain' => ['Articles']
    //         ])
    //         ->where(['Familles.id' => $id]);
    // }

    public function index()
    {

        $cond1 = '';
        $cond2 = '';
        $name = $this->request->getQuery('name');
        $marque_id = $this->request->getQuery('marque_id');

        if ($name) {
            $cond1 = "Familles.Nom like  '%" . $name . "%' ";
        }
        if ($marque_id) {
            $cond2 = "Familles.marque_id  like  '%" . $marque_id . "%' ";
        }

        $query = $this->Familles->find('all')->where([$cond1, $cond2])->contain('Marques')->order(["Familles.id" => 'desc']);
        $familles = $this->paginate($this->Familles);
        $familles = $this->paginate($query);
        $marques = $this->fetchTable('Marques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('familles', 'marques'));
    }

    /**
     * View method
     *
     * @param string|null $id Famille id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $famille = $this->Familles->get($id, [
            'contain' => ['Articles', 'Sousfamille1s'],
        ]);
        $marques = $this->fetchTable('Marques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']) ;

        $this->set(compact('famille','marques'));
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
        $liendd = $session->read('lien_articles' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'famille') {
                $societe = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $famille = $this->Familles->newEmptyEntity();



        
        $numeroobj = $this->Familles->find()->select(["numerox" =>
        'MAX(Familles.code)'])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 2, "0", STR_PAD_LEFT);
            // debug($code);die;

        } else {
            $code = "01";
        }


        if ($this->request->is('post')) {


            
        $numeroobj = $this->Familles->find()->select(["numerox" =>
        'MAX(Familles.code)'])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 2, "0", STR_PAD_LEFT);
            // debug($code);die;

        } else {
            $code = "01";
        }


            $famille = $this->Familles->patchEntity($famille, $this->request->getData());
            $famille->code=$code;
            if ($this->Familles->save($famille)) {
                $famille_id = ($this->Familles->save($famille)->id);
                $this->misejour("Familles", "add", $famille_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $marques = $this->fetchTable('Marques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('code','famille', 'marques'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Famille id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'famille') {
                $societe = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $famille = $this->Familles->get($id, [
            'contain' => []
        ]);
        //debug($famille) ; die ;

        $this->loadModel('Articles');

        //echo(json_encode($articles)) ; die ;
        $articles = $this->Articles->find('all')->where(['Articles.famille_id' => $id]);




        if ($this->request->is(['patch', 'post', 'put'])) {

            // $v = $this->request->getData('ventee');

            //  debug($v) ; die ;


            $famille = $this->Familles->patchEntity($famille, $this->request->getData());
            if ($this->Familles->save($famille)) {
                //     if ($v == 1) {
                //     foreach ($articles as $i => $art) {
                //         $data['id'] = $art['id'];
                //         $this->Articles->updateAll(
                //                 array('Articles.vente' => 0),
                //                 array('Articles.id' => $art['id'])
                //         );
                //     }
                // }



                $famille_id = ($this->Familles->save($famille)->id);
                $this->misejour("Familles", "edit", $famille_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $marques = $this->fetchTable('Marques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']) ;

        $this->set(compact('famille', 'articles','marques'));
    }
    public function getfamillecmd($id = null)
    {
        $id = $this->request->getQuery('familleid');
        $familles = 0;
        
        $familles += $this->fetchTable('Articles')->find()->where(['Articles.famille_id' => $id])->count();
        $familles += $this->fetchTable('Sousfamille1s')->find()->where(['Sousfamille1s.famille_id' => $id])->count();

        echo json_encode(['familles' => $familles]);
        die;
    }
    /**
     * Delete method
     *
     * @param string|null $id Famille id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'famille') {
                $societe = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        // $this->request->allowMethod(['post', 'delete']);
        $famille = $this->Familles->get($id);
        if ($this->Familles->delete($famille)) {
            $famille_id = ($this->Familles->save($famille)->id);
            $this->misejour("Familles", "delete", $famille_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }

    public function verif()
    {
        $id = $this->request->getQuery('idfam');
        $familles = $this->fetchTable('Articles')->find('all')->where(['Articles.famille_id=' . $id])->count();
        echo json_encode(array('familles' => $familles));
        die;
    }
}

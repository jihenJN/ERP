<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Sousfamille1s Controller
 *
 * @property \App\Model\Table\Sousfamille1sTable $Sousfamille1s
 * @method \App\Model\Entity\Sousfamille1[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class Sousfamille1sController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $cond1 = '';
        $cond2 = '';

        $name = $this->request->getQuery('name');
        $famille_id = $this->request->getQuery('famille_id');
        //debug($famille_id);


        if ($name) {

            $cond1 = "Sousfamille1s.name  =  '" . $name . "' ";
        }
        if ($famille_id) {
            $cond2 = "Sousfamille1s.famille_id  = '" . $famille_id . "' ";
        }

        $query = $this->Sousfamille1s->find('all')->where([$cond1, $cond2])->order(["Sousfamille1s.id" => 'desc']);
        // debug($query);
        $this->paginate = [
            'contain' => ['Familles'],
        ];


        $sousfamille1s = $this->paginate($query);


        $familles = $this->Sousfamille1s->Familles->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);


        $this->set(compact('sousfamille1s', 'familles'));
    }

    /**
     * View method
     *
     * @param string|null $id Sousfamille1 id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $sousfamille1 = $this->Sousfamille1s->get($id, [
            'contain' => ['Familles'],
        ]);
        $familles = $this->Sousfamille1s->Familles->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);

        $this->set(compact('sousfamille1', 'familles'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'sousfamille') {
                $societe = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $sousfamille1 = $this->Sousfamille1s->newEmptyEntity();
        if ($this->request->is('post')) {
            $sousfamille1 = $this->Sousfamille1s->patchEntity($sousfamille1, $this->request->getData());
            if ($this->Sousfamille1s->save($sousfamille1)) {
                $sousfamille1_id = ($this->Sousfamille1s->save($sousfamille1)->id);
                $this->misejour("Sousfamille1s", "add", $sousfamille1_id);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Veuillez réessayer '));
        }
        $familles = $this->Sousfamille1s->Familles->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $this->set(compact('sousfamille1', 'familles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sousfamille1 id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
      $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'sousfamille') {
                $societe = $liens['modif'];
            }
        }
        // debug($societe);die;
         if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
       
        $sousfamille1 = $this->Sousfamille1s->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sousfamille1 = $this->Sousfamille1s->patchEntity($sousfamille1, $this->request->getData());
            if ($this->Sousfamille1s->save($sousfamille1)) {
                $sousfamille1_id = ($this->Sousfamille1s->save($sousfamille1)->id);
                $this->misejour("Sousfamille1s", "edit", $sousfamille1_id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Veuillez réessayer '));
        }
        $familles = $this->Sousfamille1s->Familles->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $articles = $this->fetchTable('Articles')->find('all')->where(['Articles.sousfamille1_id' => $id]);
        $this->set(compact('sousfamille1', 'familles', 'articles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sousfamille1 id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);

        //   debug($liendd);
        $sousfamille1 = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'sousfamille') {
                $sousfamille1 = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($sousfamille1 <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        // $this->request->allowMethod(['post', 'delete']);
        $sousfamille1 = $this->Sousfamille1s->get($id);
        if ($this->Sousfamille1s->delete($sousfamille1)) {
            $sousfamille1_id = ($this->Sousfamille1s->save($sousfamille1)->id);
            $this->misejour("Sousfamille1s", "delete", $sousfamille1_id);
        } else {
            
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getsousfamille1() {
        //$this->request->allowMethod('ajax');
        //$id = $this->request->data['id'];
        //debug($id);
        $id = $this->request->getData('id');

        //debug($id);
        // $ligne = $this->fetchTable('Articles')->get($id);

        echo $t = (json_encode($id));
        //debug("aaa");
        die;
    }

    public function verif() {
        $id = $this->request->getQuery('idfam');
        $familles = $this->fetchTable('Articles')->find('all')->where(['Articles.sousfamille1_id=' . $id])->count();
        echo json_encode(array('familles' => $familles));
        die;
    }

}

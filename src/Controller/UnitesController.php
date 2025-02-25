<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Unites Controller
 *
 * @property \App\Model\Table\UnitesTable $Unites
 * @method \App\Model\Entity\Unite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UnitesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {

        $cond1 = '';

        $name = $this->request->getQuery('name');



        if ($name) {
            $cond1 = "Unites.name =  '" . $name . "' ";
        }




        $query = $this->Unites->find('all')->where([$cond1])->order(["Unites.id" => 'desc']);

        $unites = $this->paginate($query);




        $this->set(compact('unites'));












        // $unites = $this->paginate($this->Unites);
        // $this->set(compact('unites'));
    }

    /**
     * View method
     *
     * @param string|null $id Unite id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $unite = $this->Unites->get($id, [
            'contain' => ['Articles', 'Articleunites'],
        ]);

        $this->set(compact('unite'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);

        //   debug($liendd);
        $unite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'unitecontenance') {
                $unite = $liens['ajout'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $unite = $this->Unites->newEmptyEntity();
        if ($this->request->is('post')) {
            // debug($this->request->getData());die;
            $unite = $this->Unites->patchEntity($unite, $this->request->getData());
            if ($this->Unites->save($unite)) {
                $unite_id = ($this->Unites->save($unite)->id);
                $this->misejour("Unites", "add", $unite_id);


                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('unite'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Unite id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);

        //   debug($liendd);
        $unite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'unitecontenance') {
                $unite = $liens['modif'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $unite = $this->Unites->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $unite = $this->Unites->patchEntity($unite, $this->request->getData());
            if ($this->Unites->save($unite)) {
                $unite_id = ($this->Unites->save($unite)->id);
                $this->misejour("Unites", "edit", $unite_id);
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('unite'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Unite id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);

        //   debug($liendd);
        $unite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'unitecontenance') {
                $unite = $liens['supp'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        // $this->request->allowMethod(['post', 'delete']);
        $unite = $this->Unites->get($id);
        if ($this->Unites->delete($unite)) {
            $unite_id = ($this->Unites->save($unite)->id);
            $this->misejour("Unites", "delete", $unite_id);
        } else {
            
        }

        return $this->redirect(['action' => 'index']);
    }

    public function verif() {
        $id = $this->request->getQuery('idfam');

        $articles = $this->fetchTable('Articles')->find('all')->where(['Articles.unite_id=' . $id])->count();
        // debug($articles);
        echo json_encode(array('articles' => $articles));
        die;
    }

}

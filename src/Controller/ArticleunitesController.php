<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Articleunites Controller
 *
 * @property \App\Model\Table\ArticleunitesTable $Articleunites
 * @method \App\Model\Entity\Articleunite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticleunitesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Articles', 'Unites'],
        ];
        $articleunites = $this->paginate($this->Articleunites);
        $articles = $this->Articleunites->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $unites = $this->Articleunites->Unites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('unites', 'articles', 'articleunites'));
    }

    /**
     * View method
     *
     * @param string|null $id Articleunite id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $articleunite = $this->Articleunites->get($id, [
            'contain' => ['Articles', 'Unites'],
        ]);

        $articles = $this->Articleunites->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $unites = $this->Articleunites->Unites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('unites', 'articles', 'articleunite'));
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
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $articleunite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'articleunites') {
                $articleunite = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($articleunite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $articleunite = $this->Articleunites->newEmptyEntity();
        if ($this->request->is('post')) {
            $articleunite = $this->Articleunites->patchEntity($articleunite, $this->request->getData());
            if ($this->Articleunites->save($articleunite)) {
                $articleunite_id = ($this->Articleunites->save($articleunite)->id);
                $this->misejour("Articleunites", "add", $articleunite_id);

                return $this->redirect(['action' => 'index']);
            }
            
        }
        $articles = $this->Articleunites->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $unites = $this->Articleunites->Unites->find('list', ['limit' => 200]);
        $this->set(compact('articleunite', 'articles', 'unites'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Articleunite id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $articleunite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'articleunites') {
                $articleunite = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($articleunite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $articleunite = $this->Articleunites->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $articleunite = $this->Articleunites->patchEntity($articleunite, $this->request->getData());
            if ($this->Articleunites->save($articleunite)) {
                $articleunite_id = ($this->Articleunites->save($articleunite)->id);
                $this->misejour("Articleunites", "edit", $articleunite_id);

                return $this->redirect(['action' => 'index']);
            }
           
        }
        $articles = $this->Articleunites->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $unites = $this->Articleunites->Unites->find('list', ['limit' => 200]);
        $this->set(compact('articleunite', 'articles', 'unites'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Articleunite id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $articleunite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'articleunites') {
                $articleunite = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($articleunite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $articleunite = $this->Articleunites->get($id);
        if ($this->Articleunites->delete($articleunite)) {
            $articleunite_id = ($this->Articleunites->save($articleunite)->id);
            $this->misejour("Articleunites", "delete", $articleunite_id);
        } else {
            
        }

        return $this->redirect(['action' => 'index']);
    }
}

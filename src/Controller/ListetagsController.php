<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Listetags Controller
 *
 * @property \App\Model\Table\ListetagsTable $Listetags
 * @method \App\Model\Entity\Listetag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListetagsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $cond1 = '';
        $tag = $this->request->getQuery('tag');
        if ($tag) {
            $cond1 = 'Listetags.tag LIKE "%' . $tag . '%"';
        }

        $query = $this->Listetags->find('all')->where([$cond1]);
        $listetags = $this->paginate($query);


        $this->set(compact('listetags'));
    }

    /**
     * View method
     *
     * @param string|null $id Listetag id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $listetag = $this->Listetags->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('listetag'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $liste = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'listetags') {
                $liste = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($liste <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }




        $listetag = $this->Listetags->newEmptyEntity();
        if ($this->request->is('post')) {
            $listetag = $this->Listetags->patchEntity($listetag, $this->request->getData());
            if ($this->Listetags->save($listetag)) {

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('listetag'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Listetag id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {$session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $liste = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'listetags') {
                $liste = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($liste <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }





        $listetag = $this->Listetags->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $listetag = $this->Listetags->patchEntity($listetag, $this->request->getData());
            if ($this->Listetags->save($listetag)) {

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('listetag'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Listetag id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $liste = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'listetags') {
                $liste = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($liste <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $this->request->allowMethod(['post', 'delete']);
        $listetag = $this->Listetags->get($id);
        if ($this->Listetags->delete($listetag)) {
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

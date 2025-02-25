<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Bonusnouvclients Controller
 *
 * @property \App\Model\Table\BonusnouvclientsTable $Bonusnouvclients
 * @method \App\Model\Entity\Bonusnouvclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BonusnouvclientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $query = $this->Bonusnouvclients->find('all')->order(["Bonusnouvclients.id" => 'desc']);
        $this->paginate = [
            'contain' => [],
        ];
        $bonusnouvclients = $this->paginate($query);
        $this->set(compact('bonusnouvclients'));
    }

    /**
     * View method
     *
     * @param string|null $id Bonusnouvclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bonusnouvclient = $this->Bonusnouvclients->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('bonusnouvclient'));
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
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $bonusnouvclient = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bonusnouvclients') {
                $bonusnouvclient = $liens['ajout'];
            }
        }

        if (($bonusnouvclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $bonusnouvclient = $this->Bonusnouvclients->newEmptyEntity();
        if ($this->request->is('post')) {
           // debug($this->request->getData());die;
            $bonusnouvclient = $this->Bonusnouvclients->patchEntity($bonusnouvclient, $this->request->getData());
            if ($this->Bonusnouvclients->save($bonusnouvclient)) {
                $bonusnouvclient_id = ($this->Bonusnouvclients->save($bonusnouvclient)->id);
                $this->misejour("Bonusnouvclients", "add", $bonusnouvclient_id);
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('bonusnouvclient'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Bonusnouvclient id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $bonusnouvclient = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bonusnouvclients') {
                $bonusnouvclient = $liens['modif'];
            }
        }

        if (($bonusnouvclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $bonusnouvclient = $this->Bonusnouvclients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bonusnouvclient = $this->Bonusnouvclients->patchEntity($bonusnouvclient, $this->request->getData());
            if ($this->Bonusnouvclients->save($bonusnouvclient)) {
                $bonusnouvclient_id = ($this->Bonusnouvclients->save($bonusnouvclient)->id);
                $this->misejour("Bonusnouvclients", "edit", $bonusnouvclient_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('bonusnouvclient'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Bonusnouvclient id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $bonusnouvclient = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bonusnouvclients') {
                $bonusnouvclient = $liens['supp'];
            }
        }

        if (($bonusnouvclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $bonusnouvclient = $this->Bonusnouvclients->get($id);
        if ($this->Bonusnouvclients->delete($bonusnouvclient)) {
            $bonusnouvclient_id = ($this->Bonusnouvclients->save($bonusnouvclient)->id);
            $this->misejour("Bonusnouvclients", "add", $bonusnouvclient_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

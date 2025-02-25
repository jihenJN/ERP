<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Unitearticles Controller
 *
 * @property \App\Model\Table\UnitearticlesTable $Unitearticles
 * @method \App\Model\Entity\Unitearticle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UnitearticlesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $unitearticles = $this->paginate($this->Unitearticles);

        $this->set(compact('unitearticles'));
    }

    /**
     * View method
     *
     * @param string|null $id Unitearticle id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $unitearticle = $this->Unitearticles->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('unitearticle'));
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
            if (@$liens['lien'] == 'unitearticle') {
                $unite = $liens['ajout'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $unitearticle = $this->Unitearticles->newEmptyEntity();
        if ($this->request->is('post')) {
            $unitearticle = $this->Unitearticles->patchEntity($unitearticle, $this->request->getData());
            if ($this->Unitearticles->save($unitearticle)) {
                //    $this->Flash->success(__('The {0} has been saved.', 'Unitearticle'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Unitearticle'));
        }
        $this->set(compact('unitearticle'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Unitearticle id.
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
            if (@$liens['lien'] == 'unitearticle') {
                $unite = $liens['modif'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $unitearticle = $this->Unitearticles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $unitearticle = $this->Unitearticles->patchEntity($unitearticle, $this->request->getData());
            if ($this->Unitearticles->save($unitearticle)) {
                //  $this->Flash->success(__('The {0} has been saved.', 'Unitearticle'));

                return $this->redirect(['action' => 'index']);
            }
            //   $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Unitearticle'));
        }
        $this->set(compact('unitearticle'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Unitearticle id.
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
            if (@$liens['lien'] == 'unitearticle') {
                $unite = $liens['supp'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
      //  $this->request->allowMethod(['post', 'delete']);
        $unitearticle = $this->Unitearticles->get($id);
        if ($this->Unitearticles->delete($unitearticle)) {
            //  $this->Flash->success(__('The {0} has been deleted.', 'Unitearticle'));
        } else {
            //   $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Unitearticle'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function verif() {
        $id = $this->request->getQuery('idfam');

        $articles = $this->fetchTable('Articles')->find('all')->where(['Articles.unitearticle_id=' . $id])->count();
        // debug($articles);
        echo json_encode(array('articles' => $articles));
        die;
    }

}

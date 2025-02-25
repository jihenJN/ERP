<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Societes Controller
 *
 * @property \App\Model\Table\SocietesTable $Societes
 * @method \App\Model\Entity\Societe[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SocietesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cond1 = "";
        $cond2 = "";
        $cond3 = "";
        $cond4 = "";
        $nom = $this->request->getQuery('nom');
        $rc = $this->request->getQuery('rc');
        $site = $this->request->getQuery('site');
        $codetva = $this->request->getQuery('codetva');
        // debug($this->request->getQuery());
        if ($nom) {
            $cond1 = "Societes.nom like  '%" . $nom . "%' ";
        }
        if ($rc) {
            $cond2 = "Societes.rc   like  '%" . $rc . "%' ";
        }
        if ($site) {
            $cond3 = "Societes.site   like  '%" . $site . "%' ";
        }
        if ($codetva) {
            $cond4 = "Societes.codetva   like  '%" . $codetva . "%' ";
        }
        $query = $this->Societes->find('all')->where([$cond1, $cond2, $cond3, $cond4])->order(["Societes.id" => 'desc']);
        $this->paginate = [
            'contain' => [],
        ];
        $societes = $this->paginate($query);
        // $this->Societes->find('all', array(
        //     'order' => array('societe.id' => 'desc')
        // ));
        $this->set(compact('societes'));
    }

    /**
     * View method
     *
     * @param string|null $id Societe id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $societe = $this->Societes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('societe'));
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
        $societe = 0;
        foreach ($liendd as $k => $liens) {
       debug($liens);
            if (@$liens['lien'] == 'societes') {
                $societe = $liens['ajout'];
            }
        }
      debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'logout'));
        }


        $societe = $this->Societes->newEmptyEntity();
        if ($this->request->is('post')) {
            //  debug($this->request->getData());
            $societee = $this->Societes->patchEntity($societe, $this->request->getData());

            $logo = $this->request->getData('logoo');
            //debug($image);die;
            $name = $logo->getClientFilename();
            $targetPath = WWW_ROOT . 'img' . DS . 'logo' . DS . $name;
            if ($name) {
                $logo->moveTo($targetPath);
                $societe->logo = $name;
            }
            //debug($societe);die;
            if ($this->Societes->save($societee)) {
                $societe_id = ($this->Societes->save($societe)->id);
                $this->misejour("Societes", "add", $societe_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('societe'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Societe id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'societes') {
                $societe = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'logout'));
        }
        $societe = $this->Societes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //   debug($this->request->getData());die;
            $societe = $this->Societes->patchEntity($societe, $this->request->getData());
            $logo = $this->request->getData('logoo');
            $name = $logo->getClientFilename();
            $targetPath = WWW_ROOT . 'img' . DS . 'logo' . DS . $name;
            //  debug($logo);die;

            if (!empty($name)) {
                $logo->moveTo($targetPath);
                $societe->logo = $name;
            }

            if ($this->Societes->save($societe)) {
                $societe_id = ($this->Societes->save($societe)->id);
                $this->misejour("Societes", "edit", $societe_id);
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('societe'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Societe id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'societes') {
                $societe = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'logout'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $societe = $this->Societes->get($id);
        if ($this->Societes->delete($societe)) {
            $societe_id = ($this->Societes->save($societe)->id);
            $this->misejour("Societes", "delete", $societe_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Remiseqtes Controller
 *
 * @property \App\Model\Table\RemiseqtesTable $Remiseqtes
 * @method \App\Model\Entity\Remiseqte[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RemiseqtesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cond1 = "";
        $article_id = $this->request->getQuery('article_id');
        if ($article_id) {
            $cond1 = "Remiseqtes.article_id =  '" . $article_id . "' ";
        }
        $query = $this->Remiseqtes->find('all')->where([$cond1])->order(["Remiseqtes.id" => 'desc'])->group(["Remiseqtes.code"]);
        $this->paginate = [
            'contain' => [],
        ];
        $remiseqtes = $this->paginate($query);
        // $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $this->set(compact('remiseqtes'));
    }

    /**
     * View method
     *
     * @param string|null $id Remiseqte id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $remise = $this->Remiseqtes->get($id, [
            'contain' => []
        ]);
        $query = $this->Remiseqtes->find('all')->where(("Remiseqtes.code ='" . $remise["code"] . "' "));
        $this->paginate = [
            'contain' => [],
        ];
        $remiseqtes = $this->paginate($query);

        //debug($remiseqtes);
        //$articles = $this->Remiseqtes->Articles->find('list', ['limit' => 200]);
        $this->set(compact('remiseqtes'));
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
        $remiseqte = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'remiseqtes') {
                $remiseqte = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($remiseqte <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $numeroobj = $this->Remiseqtes->find()->select(["numerox" =>
        'MAX(Remiseqtes.code)'])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
            //debug($code);die;

        } else {
            $code = "00001";
        }
        $remiseqte = $this->Remiseqtes->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData()); die;

            if (isset($this->request->getData('data')['remiseqtes1']) && (!empty($this->request->getData('data')['remiseqtes1']))) {
                //$remiseqte = $this->Remiseqtes->newEmptyEntity();
                foreach ($this->request->getData('data')['remiseqtes1']  as  $rem) {
                    //debug($rem);
                    $remiseqte = $this->fetchTable('Remiseqtes')->newEmptyEntity();
                    // $remiseqte = $this->Remiseqtes->patchEntity($remiseqte, $rem);
                    $remiseqte->qtemin = $rem['qtemin'];
                    $remiseqte->qtemax = $rem['qtemax'];
                    $remiseqte->pourcentage = $rem['pourcentage'];
                    $remiseqte->code = $this->request->getData('code');
                    //debug($remiseqte);die;
                    if ($this->Remiseqtes->save($remiseqte)) {
                        $remiseqte_id = ($this->Remiseqtes->save($remiseqte)->id);
                        $this->misejour("Remiseqtes", "add", $remiseqte_id);
                    }
                }
                // $remiseqte = $this->Remiseqtes->patchEntity($rem, $this->request->getData());
            }
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('remiseqte', 'code'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Remiseqte id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);
        //   debug($liendd);
        $remiseqte = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'remiseqtes') {
                $remiseqte = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($remiseqte <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $remise = $this->Remiseqtes->get($id, [
            'contain' => []
        ]);
        $query = $this->Remiseqtes->find('all')->where(("Remiseqtes.code ='" . $remise["code"] . "' "));
        $this->paginate = [
            'contain' => [],
        ];
        $remiseqtes = $this->paginate($query);

        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());
            // die;
            // $remiseqte = $this->Remiseqtes->patchEntity($remiseqte, $this->request->getData());
            if (isset($this->request->getData('data')['remiseqtes1']) && (!empty($this->request->getData('data')['remiseqtes1']))) {
                //$remiseqte = $this->Remiseqtes->newEmptyEntity();
                foreach ($this->request->getData('data')['remiseqtes1']  as  $rem) {
                    // debug($rem);

                    $remiseqtes->qtemin = $rem['qtemin'];
                    $remiseqtes->qtemax = $rem['qtemax'];
                    $remiseqtes->pourcentage = $rem['pourcentage'];
                    $remiseqtes->code = $this->request->getData('code');
                    // debug($remiseqte);die;
                    $remiseqtes = $this->fetchTable('Remiseqtes')->newEmptyEntity();
                    // $remiseqte = $this->Remiseqtes->patchEntity($remiseqte, $rem);

                    if ($this->Remiseqtes->save($remiseqtes)) {
                        $remiseqte_id = ($this->Remiseqtes->save($remiseqtes)->id);
                        $this->misejour("Remiseqtes", "edit", $remiseqte_id);
                    }
                }
                // $remiseqte = $this->Remiseqtes->patchEntity($rem, $this->request->getData());
            }
            return $this->redirect(['action' => 'index']);
        }

        //$articles = $this->Remiseqtes->Articles->find('list', ['limit' => 200]);
        $this->set(compact('remiseqtes', 'remise'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Remiseqte id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);
        //   debug($liendd);
        $remiseqte = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'remiseqtes') {
                $remiseqte = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($remiseqte <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $remiseqte = $this->Remiseqtes->get($id);
        if ($this->Remiseqtes->delete($remiseqte)) {
            $remiseqte_id = ($this->Remiseqtes->save($remiseqte)->id);
            $this->misejour("Remiseqtes", "delete", $remiseqte_id);
        } else {
        }
        return $this->redirect(['action' => 'index']);
    }
}

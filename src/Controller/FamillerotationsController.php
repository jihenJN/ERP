<?php
declare(strict_types=1);
namespace App\Controller;
/**
 * Famillerotations Controller
 *
 * @property \App\Model\Table\FamillerotationsTable $Famillerotations
 * @method \App\Model\Entity\Famillerotation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FamillerotationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $code = $this->request->getQuery('code');
        $name = $this->request->getQuery('name');
        $cond1 = '';
        $cond2 = '';
        if ($code) {
            $cond1 = "Famillerotations.code like  '%" . $code . "%' ";
        }
        if ($name) {
            $cond2 = "Famillerotations.name   like  '%" . $name . "%' ";
        }
        $query = $this->Famillerotations->find('all')->where([$cond1, $cond2])->order(["Famillerotations.code" => 'asc']);
        $this->paginate = [
            'contain' => [],
        ];
        $famillerotations = $this->paginate($query);
        $this->set(compact('famillerotations'));
    }
    /**
     * View method
     *
     * @param string|null $id Famillerotation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $famillerotation = $this->Famillerotations->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('famillerotation'));
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
        $famillerotation = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'famillerotation') {
                $famillerotation = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($famillerotation <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $famillerotation = $this->Famillerotations->newEmptyEntity();
        if ($this->request->is('post')) {
            $famillerotation = $this->Famillerotations->patchEntity($famillerotation, $this->request->getData());
            if ($this->Famillerotations->save($famillerotation)) {
                $famillerotation_id = ($this->Famillerotations->save($famillerotation)->id);
                $this->misejour("Famillerotations", "add", $famillerotation_id);
                return $this->redirect(['action' => 'index']);
            }
        }
        $numeroobj = $this->Famillerotations->find()->select(["numerox" =>
        'MAX(Famillerotations.code)'])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            //debug($numero);
            $n = $numero;
            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;
            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
            //debug($code);die;
        } else {
            $code = "00001";
        }
        $this->set(compact('famillerotation', 'code'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Famillerotation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);
        //   debug($liendd);
        $famillerotation = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'famillerotation') {
                $famillerotation = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($famillerotation <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $famillerotation = $this->Famillerotations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $famillerotation = $this->Famillerotations->patchEntity($famillerotation, $this->request->getData());
            if ($this->Famillerotations->save($famillerotation)) {
                $famillerotation_id = ($this->Famillerotations->save($famillerotation)->id);
                $this->misejour("Famillerotations", "edit", $famillerotation_id);
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('famillerotation'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Famillerotation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);
        //   debug($liendd);
        $famillerotation = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'famillerotation') {
                $famillerotation = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($famillerotation <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $famillerotation = $this->Famillerotations->get($id);
        if ($this->Famillerotations->delete($famillerotation)) {
            $famillerotation_id = ($this->Famillerotations->save($famillerotation)->id);
            $this->misejour("Famillerotations", "delete", $famillerotation_id);
        } else {
        }
        return $this->redirect(['action' => 'index']);
    }
}





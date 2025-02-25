<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Tachedesignations Controller
 *
 * @property \App\Model\Table\TachedesignationsTable $Tachedesignations
 * @method \App\Model\Entity\Tachedesignation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TachedesignationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cond1 = '';
        $designation = $this->request->getQuery('designation');
        if ($designation) {
            $cond1 = 'Tachedesignations.designation LIKE "%' . ($designation) . '%"';
        }
        $query = $this->Tachedesignations->find('all')->where([$cond1]);
        $tachedesignations = $this->paginate($query);
        // $tachedesignations = $this->paginate($this->Tachedesignations);
        $this->set(compact('tachedesignations'));
    }

    /**
     * View method
     *
     * @param string|null $id Tachedesignation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tachedesignation = $this->Tachedesignations->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('tachedesignation'));
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
        $tachedesignation = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'tachedesignations') {
                $tachedesignation = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($tachedesignation <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }



        $num = $this->Tachedesignations->find()->select([
            "num" =>
            'MAX(Tachedesignations.num)'
        ])->first();
        $numero = $num->num;
        if ($numero != null) {
            $currentNumber = intval(substr($numero, 1, 5));
            $newNumber = $currentNumber + 1;
            $formattedNumber = str_pad((string) $newNumber, 5, '0', STR_PAD_LEFT);
            $code = 'T' . $formattedNumber;
        } else {
            $code = "T00001";
        }
        $tachedesignation = $this->Tachedesignations->newEmptyEntity();
        if ($this->request->is('post')) {
            $tachedesignation = $this->Tachedesignations->patchEntity($tachedesignation, $this->request->getData());
            if ($this->Tachedesignations->save($tachedesignation)) {
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('tachedesignation', 'code'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tachedesignation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {



        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $tachedesignation = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'tachedesignations') {
                $tachedesignation = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($tachedesignation <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $tachedesignation = $this->Tachedesignations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tachedesignation = $this->Tachedesignations->patchEntity($tachedesignation, $this->request->getData());
            if ($this->Tachedesignations->save($tachedesignation)) {

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('tachedesignation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tachedesignation id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $tachedesignation = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'tachedesignations') {
                $tachedesignation = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($tachedesignation <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $tachedesignation = $this->Tachedesignations->get($id);
        if ($this->Tachedesignations->delete($tachedesignation)) {
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

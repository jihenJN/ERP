<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Bonderetoures Controller
 *
 * @property \App\Model\Table\BonderetouresTable $Bonderetoures
 * @method \App\Model\Entity\Bonderetoure[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BonderetouresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $bonderetoures = $this->paginate($this->Bonderetoures);

        $this->set(compact('bonderetoures'));
    }

    /**
     * View method
     *
     * @param string|null $id Bonderetoure id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bonderetoure = $this->Bonderetoures->get($id, [
            'contain' => ['Lignebonderetoures'],
        ]);

        $this->set(compact('bonderetoure'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bonderetoure = $this->Bonderetoures->newEmptyEntity();
        if ($this->request->is('post')) {
            $bonderetoure = $this->Bonderetoures->patchEntity($bonderetoure, $this->request->getData());
            if ($this->Bonderetoures->save($bonderetoure)) {
                //$this->Flash->success(__('The bonderetoure has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The bonderetoure could not be saved. Please, try again.'));
        }


        $numeroobj = $this->Bonderetoures->find()->select(["numero" =>
        'MAX(Bonderetoures.numero)'])->first();
        $numero = $numeroobj->numero;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);

        } else {
            $code = "00001";
        }
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        //debug($articles->toArray());
        $this->set(compact('bonderetoure','code','fournisseurs','depots','articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bonderetoure id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bonderetoure = $this->Bonderetoures->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bonderetoure = $this->Bonderetoures->patchEntity($bonderetoure, $this->request->getData());
            if ($this->Bonderetoures->save($bonderetoure)) {
                $this->Flash->success(__('The bonderetoure has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bonderetoure could not be saved. Please, try again.'));
        }
        $this->set(compact('bonderetoure'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bonderetoure id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bonderetoure = $this->Bonderetoures->get($id);
        if ($this->Bonderetoures->delete($bonderetoure)) {
            $this->Flash->success(__('The bonderetoure has been deleted.'));
        } else {
            $this->Flash->error(__('The bonderetoure could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

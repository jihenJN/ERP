<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Lignebanques Controller
 *
 * @property \App\Model\Table\LignebanquesTable $Lignebanques
 * @method \App\Model\Entity\Lignebanque[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignebanquesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Comptes'],
        ];
        $lignebanques = $this->paginate($this->Lignebanques);

        $this->set(compact('lignebanques'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignebanque id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignebanque = $this->Lignebanques->get($id, [
            'contain' => ['Comptes'],
        ]);

        $this->set(compact('lignebanque'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignebanque = $this->Lignebanques->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignebanque = $this->Lignebanques->patchEntity($lignebanque, $this->request->getData());
            if ($this->Lignebanques->save($lignebanque)) {
                $this->Flash->success(__('The lignebanque has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignebanque could not be saved. Please, try again.'));
        }
        $comptes = $this->Lignebanques->Comptes->find('list', ['limit' => 200])->all();
        $this->set(compact('lignebanque', 'comptes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lignebanque id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignebanque = $this->Lignebanques->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignebanque = $this->Lignebanques->patchEntity($lignebanque, $this->request->getData());
            if ($this->Lignebanques->save($lignebanque)) {
                $this->Flash->success(__('The lignebanque has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignebanque could not be saved. Please, try again.'));
        }
        $comptes = $this->Lignebanques->Comptes->find('list', ['limit' => 200])->all();
        $this->set(compact('lignebanque', 'comptes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lignebanque id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignebanque = $this->Lignebanques->get($id);
        if ($this->Lignebanques->delete($lignebanque)) {
            $this->Flash->success(__('The lignebanque has been deleted.'));
        } else {
            $this->Flash->error(__('The lignebanque could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function getcompte()
    {
        $banque_id = $this->request->getQuery('banque_id');
        $comptes = $this->fetchTable('Lignebanques')
            ->find('all')
            ->where(['Lignebanques.banque_id' => $banque_id])
            ->contain(['Comptes']);

        $select = '<label>Compte</label>
        <select name="compte_id" class="form-control" id="compte_id">
            <option value="0" selected="selected" disabled>Veuillez choisir !!</option>';

        foreach ($comptes as $lignecompte) {
            $select .= '<option value="' . $lignecompte->compte->id . '">' . $lignecompte->compte->numero . '</option>';
        }

        $select .= '</select>';

        echo json_encode(array('select' => $select));
        die;
    }
    public function getcomptes()
    {
        $banque_id = $this->request->getQuery('banque_id');
        $comptes = $this->fetchTable('Lignebanques')
            ->find('all')
            ->where(['Lignebanques.banque_id' => $banque_id])
            ->contain(['Comptes']);

        $select = '
        <select table="pieceregelemnt" name = "data[pieceregelemnt][0][compte_id]" champ="compte_id" index=""  id="compte_id" class="form-control" onchange="getcarnet(this.value)">
            <option value="0" selected="selected" disabled>Veuillez choisir !!</option> ';

        foreach ($comptes as $lignecompte) {
            $select .= '<option value="' . $lignecompte->compte->id . '">' . $lignecompte->compte->numero . '</option>';
        }

        $select .= '</select>';
        //debug($select);
        echo json_encode(array('select' => $select));
        die;
    }
    public function verif()
    {
        $id = $this->request->getQuery('id');


        // $Lignetickets = $this->fetchTable('Lignetickets')->find('all')->where(['Lignetickets.ticketvente_id =' . $id])->count();
        //  $Ticketventes1 = $this->fetchTable('Factureclients')->find('list')->where(['Factureclients.ticketvente_id=' .$id])->count();
        if ($id) {
            $Comptes = $this->fetchTable('Lignebanques')->find('all')->where(['Lignebanques.compte_id=' . $id])->count();
        }

        echo json_encode(array('Comptes' =>  $Comptes));
        die;
    }

    public function getcomptes1()
    {
        $banque_id = $this->request->getQuery('banque_id');
        // debug($banque_id);die;
        $comptes = $this->fetchTable('Lignebanques')
            ->find('all')
            ->where(['Lignebanques.banque_id' => $banque_id])
            ->contain(['Comptes']);

        $select = '
    <select table="pieceregelemnt" champ="compte_id"  index=""  id="compte_id" class="form-control" onchange="getcarnet(this.value)">
        <option value="0" selected="selected" disabled>Veuillez choisir !!</option> ';

        foreach ($comptes as $lignecompte) {
            $select .= '<option value="' . $lignecompte->compte->id . '">' . $lignecompte->compte->numero . '</option>';
        }

        $select .= '</select>';
        //debug($select);
        echo json_encode(array('select' => $select));
        die;
    }
}

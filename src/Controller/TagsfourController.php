<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Tagsfour Controller
 *
 * @property \App\Model\Table\TagsfourTable $Tagsfour
 * @method \App\Model\Entity\Tagsfour[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagsfourController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        error_reporting(E_ERROR | E_PARSE);

        $cond1 = '';
        $cond2 = '';
        $fournisseurs_id = $this->request->getQuery('fournisseurs_id');
        $listetag_id = $this->request->getQuery('listetag_id');
        if ($fournisseurs_id) {
            $cond1 = 'Tagsfour.fournisseurs_id LIKE "%' . $fournisseurs_id . '%"';
        }
        if ($listetag_id) {
            $cond2 = 'Tagsfour.listetag_id LIKE "%' . $listetag_id . '%"';
        }

        $query = $this->Tagsfour->find('all')->where([$cond1, $cond2]);

        $this->paginate = ['contain' => ['Listetags', 'Fournisseurs'],];

        $tagsfour = $this->paginate($query);

        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();

        // $this->paginate = [
        //     'contain' => ['Listetags'],
        // ];
        // $tagsfour = $this->paginate($this->Tagsfour);

        $this->set(compact('tagsfour', 'fournisseurs', 'listetags'));
    }

    /**
     * View method
     *
     * @param string|null $id Tagsfour id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tagsfour = $this->Tagsfour->get($id, [
            'contain' => ['Listetags'],
        ]);

        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();

        $this->set(compact('tagsfour', 'fournisseurs', 'listetags'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tagsfour = $this->Tagsfour->newEmptyEntity();
        if ($this->request->is('post')) {
            $tagsfour = $this->Tagsfour->patchEntity($tagsfour, $this->request->getData());
            if ($this->Tagsfour->save($tagsfour)) {
                $this->misejour("Tagsfour", "add", $tagsfour->id);
                return $this->redirect(['action' => 'index']);
            }
        }
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();

        $this->set(compact('tagsfour', 'fournisseurs', 'listetags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tagsfour id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tagsfour = $this->Tagsfour->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tagsfour = $this->Tagsfour->patchEntity($tagsfour, $this->request->getData());
            if ($this->Tagsfour->save($tagsfour)) {
                $this->misejour("Tagsfour", "edit", $tagsfour->id);
                return $this->redirect(['action' => 'index']);
            }
        }
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();
        $this->set(compact('fournisseurs', 'tagsfour', 'listetags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tagsfour id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tagsfour = $this->Tagsfour->get($id);
        if ($this->Tagsfour->delete($tagsfour)) {
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

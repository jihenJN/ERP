<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Personnel;

/**
 * Tagspersonnels Controller
 *
 * @property \App\Model\Table\TagspersonnelsTable $Tagspersonnels
 * @method \App\Model\Entity\Tagspersonnel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagspersonnelsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cond1 = '';
        $cond2 = '';
        $personnel_id = $this->request->getQuery('personnel_id');
        $listetag_id = $this->request->getQuery('listetag_id');
        if ($personnel_id) {
            $cond1 = 'Tagspersonnels.personnel_id LIKE "%' . $personnel_id . '%"';
        }
        if ($listetag_id) {
            $cond2 = 'Tagspersonnels.listetag_id LIKE "%' . $listetag_id . '%"';
        }
        $query = $this->Tagspersonnels->find('all')->where([$cond1, $cond2]);
        $this->paginate = ['contain' => ['Personnels', 'Listetags'],];
        $tagspersonnels = $this->paginate($query);

        $this->paginate = [
            'contain' => ['Personnels', 'Listetags'],
        ];
        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();

        $this->set(compact('tagspersonnels', 'personnels', 'listetags'));
    }

    /**
     * View method
     *
     * @param string|null $id Tagspersonnel id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tagspersonnel = $this->Tagspersonnels->get($id, [
            'contain' => ['Personnels', 'Listetags'],
        ]);
        $personnels = $this->Tagspersonnels->Personnels->find('list', ['limit' => 200])->all();
        // $listetags = $this->Tagspersonnels->Listetags->find('list', ['limit' => 200])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();

        $this->set(compact('tagspersonnel', 'personnels', 'listetags'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tagspersonnel = $this->Tagspersonnels->newEmptyEntity();
        if ($this->request->is('post')) {
            $tagspersonnel = $this->Tagspersonnels->patchEntity($tagspersonnel, $this->request->getData());
            if ($this->Tagspersonnels->save($tagspersonnel)) {
                $this->misejour("Tagspersonnels", "add", $tagspersonnel->id);
                return $this->redirect(['action' => 'index']);
            }
        }
        $personnels = $this->Tagspersonnels->Personnels->find('list', ['limit' => 200])->all();
        // $listetags = $this->Tagspersonnels->Listetags->find('list', ['limit' => 200])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();

        $this->set(compact('tagspersonnel', 'personnels', 'listetags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tagspersonnel id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tagspersonnel = $this->Tagspersonnels->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tagspersonnel = $this->Tagspersonnels->patchEntity($tagspersonnel, $this->request->getData());
            if ($this->Tagspersonnels->save($tagspersonnel)) {
                $this->misejour("Tagspersonnels", "edit", $tagspersonnel->id);
                return $this->redirect(['action' => 'index']);
            }
        }
        $personnels = $this->Tagspersonnels->Personnels->find('list', ['limit' => 200])->all();
        // $listetags = $this->Tagspersonnels->Listetags->find('list', ['limit' => 200])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();

        $this->set(compact('tagspersonnel', 'personnels', 'listetags'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tagspersonnel = $this->Tagspersonnels->get($id);
        if ($this->Tagspersonnels->delete($tagspersonnel)) {
            $this->misejour("Tagspersonnels", "delete", $tagspersonnel->id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

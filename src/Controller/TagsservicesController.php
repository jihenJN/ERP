<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Tagsservices Controller
 *
 * @property \App\Model\Table\TagsservicesTable $Tagsservices
 * @method \App\Model\Entity\Tagsservice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagsservicesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function inddex()
    {
        $this->paginate = [
            'contain' => ['Listetags'],
        ];
        $tagsservices = $this->paginate($this->Tagsservices);

        $this->set(compact('tagsservices'));
    }

    public function index()
    {
        $cond1 = '';
        $cond2 = '';
        $service_id = $this->request->getQuery('service_id');
        $listetag_id = $this->request->getQuery('listetag_id');
        if ($service_id) {
            $cond1 = 'Tagsservices.article_id LIKE "%' . $service_id . '%"';
        }
        if ($listetag_id) {
            $cond2 = 'Tagsservices.listetag_id LIKE "%' . $listetag_id . '%"';
        }
        $query = $this->Tagsservices->find('all')->where([$cond1, $cond2]);
        $this->paginate = ['contain' => ['Services', 'Listetags'],];
        $tagsservices = $this->paginate($query);
        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'libelle'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();
        $this->set(compact('tagsservices', 'services', 'listetags'));
    }

    /**
     * View method
     *
     * @param string|null $id Tagsservice id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tagsservice = $this->Tagsservices->get($id, [
            'contain' => ['Listetags'],
        ]);

        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'libelle'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();
        $this->set(compact('tagsservice', 'services', 'listetags'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tagsservice = $this->Tagsservices->newEmptyEntity();
        if ($this->request->is('post')) {
            $tagsservice = $this->Tagsservices->patchEntity($tagsservice, $this->request->getData());
            if ($this->Tagsservices->save($tagsservice)) {

                return $this->redirect(['action' => 'index']);
            }
        }
        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'libelle'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();
        $this->set(compact('tagsservice', 'services', 'listetags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tagsservice id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tagsservices = $this->Tagsservices->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tagsservices = $this->Tagsservices->patchEntity($tagsservices, $this->request->getData());
            if ($this->Tagsservices->save($tagsservices)) {
                return $this->redirect(['action' => 'index']);
            }
        }

        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'libelle'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();
        $this->set(compact('tagsservices', 'services', 'listetags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tagsservice id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tagsservice = $this->Tagsservices->get($id);
        if ($this->Tagsservices->delete($tagsservice)) {
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

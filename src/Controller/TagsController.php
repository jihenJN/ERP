<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 * @method \App\Model\Entity\Tag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagsController extends AppController
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
        $client_id = $this->request->getQuery('client_id');
        $listetag_id = $this->request->getQuery('listetag_id');
        if ($client_id) {
            $cond1 = 'Tags.client_id LIKE "%' . $client_id . '%"';
        }
        if ($listetag_id) {
            $cond2 = 'Tags.listetag_id LIKE "%' . $listetag_id . '%"';
        }
        $query = $this->Tags->find('all')->where([$cond1, $cond2]);
        $this->paginate = ['contain' => ['Clients', 'Listetags'],];
        $tags = $this->paginate($query);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();
        $this->set(compact('tags', 'clients', 'listetags'));
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => ['Listetags', 'Clients'],
        ]);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();

        $this->set(compact('tag', 'clients', 'listetags'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tag = $this->Tags->newEmptyEntity();
        if ($this->request->is('post')) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->misejour("Tags", "add", $tag->id);
               

                return $this->redirect(['action' => 'index']);
            }
        }

        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();
        $this->set(compact('tag', 'listetags', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->misejour("Tags", "edit", $tag->id);
                return $this->redirect(['action' => 'index']);
            }
        }
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->all();
        $listetags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();

        $this->set(compact('tag', 'listetags', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

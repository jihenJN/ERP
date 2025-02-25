<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignefactureclients Controller
 *
 * @property \App\Model\Table\LignefactureclientsTable $Lignefactureclients
 * @method \App\Model\Entity\Lignefactureclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignefactureclientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Factureclients', 'Articles'],
        ];
        $lignefactureclients = $this->paginate($this->Lignefactureclients);

        $this->set(compact('lignefactureclients'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignefactureclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignefactureclient = $this->Lignefactureclients->get($id, [
            'contain' => ['Factureclients', 'Articles'],
        ]);

        $this->set(compact('lignefactureclient'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignefactureclient = $this->Lignefactureclients->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignefactureclient = $this->Lignefactureclients->patchEntity($lignefactureclient, $this->request->getData());
            if ($this->Lignefactureclients->save($lignefactureclient)) {
                $this->Flash->success(__('The lignefactureclient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignefactureclient could not be saved. Please, try again.'));
        }
        $factureclients = $this->Lignefactureclients->Factureclients->find('list', ['limit' => 200])->all();
        $articles = $this->Lignefactureclients->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('lignefactureclient', 'factureclients', 'articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lignefactureclient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignefactureclient = $this->Lignefactureclients->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignefactureclient = $this->Lignefactureclients->patchEntity($lignefactureclient, $this->request->getData());
            if ($this->Lignefactureclients->save($lignefactureclient)) {
                $this->Flash->success(__('The lignefactureclient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignefactureclient could not be saved. Please, try again.'));
        }
        $factureclients = $this->Lignefactureclients->Factureclients->find('list', ['limit' => 200])->all();
        $articles = $this->Lignefactureclients->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('lignefactureclient', 'factureclients', 'articles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lignefactureclient id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignefactureclient = $this->Lignefactureclients->get($id);
        if ($this->Lignefactureclients->delete($lignefactureclient)) {
            $this->Flash->success(__('The lignefactureclient has been deleted.'));
        } else {
            $this->Flash->error(__('The lignefactureclient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

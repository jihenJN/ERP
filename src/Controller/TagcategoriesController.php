<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tagcategories Controller
 *
 * @property \App\Model\Table\TagcategoriesTable $Tagcategories
 * @method \App\Model\Entity\Tagcategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagcategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tagcategories = $this->paginate($this->Tagcategories);

        $this->set(compact('tagcategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Tagcategory id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function test()
    {}
    public function view($id = null)
    {
        $tagcategory = $this->Tagcategories->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('tagcategory'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tagcategory = $this->Tagcategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $tagcategory = $this->Tagcategories->patchEntity($tagcategory, $this->request->getData());
            if ($this->Tagcategories->save($tagcategory)) {

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('tagcategory'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Tagcategory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tagcategory = $this->Tagcategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tagcategory = $this->Tagcategories->patchEntity($tagcategory, $this->request->getData());
            if ($this->Tagcategories->save($tagcategory)) {

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('tagcategory'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Tagcategory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tagcategory = $this->Tagcategories->get($id);
        if ($this->Tagcategories->delete($tagcategory)) {
        } 

        return $this->redirect(['action' => 'index']);
    }
}

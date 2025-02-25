<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $categories = $this->fetchTable('Categories')->find('all')->order(["Categories.id" => 'desc']);

        $this->set(compact('categories'));
    }

    /**x
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('category'));
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
        $liendd = $session->read('lien_commercialmenus' . $abrv);

        //   debug($liendd);
        $categorie = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'categories') {
                $categorie = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($categorie <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $category = $this->Categories->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $category_id = ($this->Categories->save($category)->id);
                $this->misejour("Categories", "add", $category_id);

                return $this->redirect(['action' => 'index']);
            }
           
        }
        $this->set(compact('category'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_commercialmenus' . $abrv);

        //   debug($liendd);
        $categorie = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'categories') {
                $categorie = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($categorie <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $category = $this->Categories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $category_id = ($this->Categories->save($category)->id);
                $this->misejour("Categories", "edit", $category_id);
                return $this->redirect(['action' => 'index']);
            }
            
        }
        $this->set(compact('category'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_commercialmenus' . $abrv);

        //   debug($liendd);
        $categorie = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'categories') {
                $categorie = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($categorie <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $category_id = ($this->Categories->save($category)->id);
                $this->misejour("Categories", "delete", $category_id);
        } else {
           
        }

        return $this->redirect(['action' => 'index']);
    }
}

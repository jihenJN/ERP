<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typefournisseurs Controller
 *
 * @property \App\Model\Table\TypefournisseursTable $Typefournisseurs
 * @method \App\Model\Entity\Typefournisseur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypefournisseursController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {



        $cond = '';

        $nom = $this->request->getQuery('name');

        if ($nom) {
            $cond = "Typefournisseurs.name  like  '%" . $nom . "%' ";
           
        }

        $query = $this->Typefournisseurs->find('all')->where([$cond]);
        $typefournisseurs = $this->paginate($query);

        $this->set(compact('typefournisseurs'));
    }

    /**
     * View method
     *
     * @param string|null $id Typefournisseur id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typefournisseur = $this->Typefournisseurs->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('typefournisseur'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typefournisseur = $this->Typefournisseurs->newEmptyEntity();
        if ($this->request->is('post')) {
            $typefournisseur = $this->Typefournisseurs->patchEntity($typefournisseur, $this->request->getData());
            if ($this->Typefournisseurs->save($typefournisseur)) {
               //// $this->Flash->success(__('The {0} has been saved.', 'Typefournisseur'));

                return $this->redirect(['action' => 'index']);
            }
            ///$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typefournisseur'));
        }
        $this->set(compact('typefournisseur'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Typefournisseur id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typefournisseur = $this->Typefournisseurs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typefournisseur = $this->Typefournisseurs->patchEntity($typefournisseur, $this->request->getData());
            if ($this->Typefournisseurs->save($typefournisseur)) {
               /// $this->Flash->success(__('The {0} has been saved.', 'Typefournisseur'));

                return $this->redirect(['action' => 'index']);
            }
           /// $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Typefournisseur'));
        }
        $this->set(compact('typefournisseur'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Typefournisseur id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typefournisseur = $this->Typefournisseurs->get($id);
        if ($this->Typefournisseurs->delete($typefournisseur)) {
            ///$this->Flash->success(__('The {0} has been deleted.', 'Typefournisseur'));
        } else {
          ///  $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Typefournisseur'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

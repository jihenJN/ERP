<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typecontacts Controller
 *
 * @property \App\Model\Table\TypecontactsTable $Typecontacts
 * @method \App\Model\Entity\Typecontact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypecontactsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typecontacts = $this->paginate($this->Typecontacts);

        $this->set(compact('typecontacts'));
    }

    /**
     * View method
     *
     * @param string|null $id Typecontact id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typecontact = $this->Typecontacts->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('typecontact'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typecontact = $this->Typecontacts->newEmptyEntity();
        if ($this->request->is('post')) {
            $typecontact = $this->Typecontacts->patchEntity($typecontact, $this->request->getData());
            if ($this->Typecontacts->save($typecontact)) {
              //  $this->Flash->success(__('The typecontact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The typecontact could not be saved. Please, try again.'));
        }
        $this->set(compact('typecontact'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Typecontact id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typecontact = $this->Typecontacts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typecontact = $this->Typecontacts->patchEntity($typecontact, $this->request->getData());
            if ($this->Typecontacts->save($typecontact)) {
             //   $this->Flash->success(__('The typecontact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
          //  $this->Flash->error(__('The typecontact could not be saved. Please, try again.'));
        }
        $this->set(compact('typecontact'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Typecontact id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typecontact = $this->Typecontacts->get($id);

        // Vérifier si le typecontact est lié à une visite
        $visiteCount = $this->Typecontacts->Visites->find()
        ->where(['type_contact_id' => $id])
        ->count();
       

        if ($visiteCount > 0) {
            // S'il y a des visites associées, afficher un message d'erreur
            $this->Flash->error("Ce type de contact ne peut pas être supprimé car il est associé à des visites.");
            return $this->redirect(['action' => 'index']);  // ou la page appropriée
        }

        if ($this->Typecontacts->delete($typecontact)) {
          //  $this->Flash->success(__('The typecontact has been deleted.'));
        } else {
           // $this->Flash->error(__('The typecontact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}

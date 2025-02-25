<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typeclients Controller
 *
 * @property \App\Model\Table\TypeclientsTable $Typeclients
 * @method \App\Model\Entity\Typeclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypeclientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typeclients = $this->paginate($this->Typeclients);

        $this->set(compact('typeclients'));
    }

    /**
     * View method
     *
     * @param string|null $id Typeclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeclient = $this->Typeclients->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->set(compact('typeclient'));
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
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $typeclient = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'typeclients') {
                $typeclient = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($typeclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $typeclient = $this->Typeclients->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());
            $typeclient = $this->Typeclients->patchEntity($typeclient, $this->request->getData());
            if ($this->Typeclients->save($typeclient)) {
                $typeclient_id = ($this->Typeclients->save($typeclient)->id);
                $this->misejour("Typeclients", "add", $typeclient_id);

                return $this->redirect(['action' => 'index']);
            }
           
        }
        $this->set(compact('typeclient'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Typeclient id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $typeclient = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'typeclients') {
                $typeclient = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($typeclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $typeclient = $this->Typeclients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
          
            $typeclient = $this->Typeclients->patchEntity($typeclient, $this->request->getData());
            if ($this->Typeclients->save($typeclient)) {
                $typeclient_id = ($this->Typeclients->save($typeclient)->id);
                $this->misejour("Typeclients", "edit", $typeclient_id);

                return $this->redirect(['action' => 'index']);
            }
           
        }
        $this->set(compact('typeclient'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Typeclient id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $typeclient = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'typeclients') {
                $typeclient = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($typeclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
       // $this->request->allowMethod(['post', 'delete']);
        $typeclient = $this->Typeclients->get($id);
        if ($this->Typeclients->delete($typeclient)) {
            $typeclient_id = ($this->Typeclients->save($typeclient)->id);
            $this->misejour("Typeclients", "add", $typeclient_id);
        } else {
           
        }

        return $this->redirect(['action' => 'index']);
    }

    public function verif()
    {
        $id = $this->request->getQuery('id');
        $typeclient = $this->fetchTable('Clients')->find('all')->where(['Clients.typeclient_id='.$id])->count();
        echo json_encode(array('Typeclients' =>  $typeclient));
        die;
    }

}

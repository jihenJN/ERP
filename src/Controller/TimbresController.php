<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Timbres Controller
 *
 * @property \App\Model\Table\TimbresTable $Timbres
 * @method \App\Model\Entity\Timbre[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TimbresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $timbres = $this->paginate($this->Timbres);

        $this->set(compact('timbres'));
    }

    /**
     * View method
     *
     * @param string|null $id Timbre id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $timbre = $this->Timbres->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('timbre'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         $this->loadModel('Accueils');
        $session = $this->request->getSession();
         $acc = $this->Accueils->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
         foreach ($acc as $ac) {

            $abrv = $ac['name'];    //debug($abrv);die;
         }

         $lien = $session->read('lien_parametrage' . $abrv);
         $timbre = 0;
         if (!empty($lien)) {
            foreach ($lien as $k => $liens) {
                if (@$liens['lien'] == 'timbres') {
                     $timbre = $liens['ajout'];
                }
            }
         }
         if (($timbre <> 1) || (empty($lien))) {
             $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $timbre = $this->Timbres->newEmptyEntity();
        if ($this->request->is('post')) {
            $timbre = $this->Timbres->patchEntity($timbre, $this->request->getData());
            if ($this->Timbres->save($timbre)) {
                $this->Flash->success(__('The {0} has been saved.', 'Timbre'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Timbre'));
        }
        $this->set(compact('timbre'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Timbre id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $timbre = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'timbres') {
                $timbre = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($timbre <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $timbre = $this->Timbres->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timbre = $this->Timbres->patchEntity($timbre, $this->request->getData());
            if ($this->Timbres->save($timbre)) {
                $this->Flash->success(__('The {0} has been saved.', 'Timbre'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Timbre'));
        }
        $this->set(compact('timbre'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Timbre id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
       $this->loadModel('Accueils');
        $session = $this->request->getSession();
         $acc = $this->Accueils->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
         foreach ($acc as $ac) {

            $abrv = $ac['name'];    //debug($abrv);die;
         }

         $lien = $session->read('lien_parametrage' . $abrv);
         $timbre = 0;
         if (!empty($lien)) {
            foreach ($lien as $k => $liens) {
                if (@$liens['lien'] == 'timbres') {
                     $timbre = $liens['supp'];
                }
            }
         }
         if (($timbre <> 1) || (empty($lien))) {
             $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $timbre = $this->Timbres->get($id);
        if ($this->Timbres->delete($timbre)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Timbre'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Timbre'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

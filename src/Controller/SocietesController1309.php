<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Societes Controller
 *
 * @property \App\Model\Table\SocietesTable $Societes
 * @method \App\Model\Entity\Societe[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SocietesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cond1 = "";
        $cond2 = "";
        $cond3 = "";
        $cond4 = "";
        $nom = $this->request->getQuery('nom');
        $rc = $this->request->getQuery('rc');
        $site = $this->request->getQuery('site');
        $codetva = $this->request->getQuery('codetva');
        // debug($this->request->getQuery());
        if ($nom) {
            $cond1 = "Societes.nom like  '%" . $nom . "%' ";
        }
        if ($rc) {
            $cond2 = "Societes.rc   like  '%" . $rc . "%' ";
        }
        if ($site) {
            $cond3 = "Societes.site   like  '%" . $site . "%' ";
        } 
        if ($codetva) {
            $cond4 = "Societes.codetva   like  '%" . $codetva . "%' ";
        }
        $query = $this->Societes->find('all')->where([$cond1, $cond2,$cond3,$cond4]);
        $this->paginate = [
            'contain' => [],
        ];
        $societes = $this->paginate($query);
        $this->set(compact('societes'));
    }

    /**
     * View method
     *
     * @param string|null $id Societe id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $societe = $this->Societes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('societe'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $societe = $this->Societes->newEmptyEntity();
        if ($this->request->is('post')) {
            $societe = $this->Societes->patchEntity($societe, $this->request->getData());
          //   debug($societe);
            
            $logo = $this->request->getData('logo');
            //  debug($image);die;
            $name = $logo->getClientFilename();
            $targetPath = WWW_ROOT.'img'.DS.'logo'.DS.$name;
            if ($name) {
                $logo->moveTo($targetPath);
                $societe->logo=$name;
            }
//debug($societe);die;
            if ($this->Societes->save($societe)) {
                $this->Flash->success(__('The {0} has been saved.', 'Societe'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Societe'));
        }
        $this->set(compact('societe'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Societe id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $societe = $this->Societes->get($id, [
            'contain' => []
        ]);
         
       
        if ($this->request->is(['patch', 'post', 'put'])) {
             $societe = $this->Societes->patchEntity($societe, $this->request->getData());
             $logo = $this->request->getData('logo');
        
         if($logo != ''){
        $name = $logo->getClientFilename();
        
        $targetPath = WWW_ROOT.'img'.DS.'logo'.DS.$name;
       
        if ($name) {
            $logo->moveTo($targetPath);
            $societe->logo=$name;
         }}
        
           
            //  debug($societe);die;
            if ($this->Societes->save($societe)) {
                $this->Flash->success(__('The {0} has been saved.', 'Societe'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Societe'));
        }
        $this->set(compact('societe'));
    }
    public function imprimeview($id = null)
    {
        $societes = $this->Societes->get($id, [
            // 'contain' => ['Commanddes'],
        ]);
        $this->set(compact('societes'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Societe id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $societe = $this->Societes->get($id);
        if ($this->Societes->delete($societe)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Societe'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Societe'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

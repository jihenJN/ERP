<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Commercials Controller
 *
 * @property \App\Model\Table\CommercialsTable $Commercials
 * @method \App\Model\Entity\Commercial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommercialsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $commercials = $this->paginate($this->Commercials);

        $this->set(compact('commercials'));
    }

    /**
     * View method
     *
     * @param string|null $id Commercial id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commercial = $this->Commercials->get($id, [
            'contain' => ['Commandes'],
        ]);
          $this->loadModel('Gouvernoratcommercials');
   $gouv = $this->Gouvernoratcommercials->find('all',array('conditions'=>array("Gouvernoratcommercials.commercial_id =". $id ),'fields'=>array('Gouvernoratcommercials.gouvernorat_id')));

                $gg=[];
                 foreach ($gouv as $i=>$g) {
                    
                 array_push($gg,$g['gouvernorat_id']);
                   
                     
                 }
                         $gouvernorats = $this->Commercials->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'Description']);

        $this->set(compact('commercial','gg','gouvernorats'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Objectifrepresentants');
        $this->loadModel('Mois');
        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Tarifs');
        $this->loadModel('Articles');
        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
        //echo(json_encode($fam)) ; die ;
       
        $dett = '0';
        foreach ($fam as $f) {
         
            $dett = $dett . ',' . $f->id;
        }
        
        if ($dett != '') {
            $cond100 = 'Articles.famille_id in (' . $dett . ')';
        }
     
        $articles = $this->Tarifs->Articles->find('all')->where([$cond100]);
      
        $commercial = $this->Commercials->newEmptyEntity();

        if ($this->request->is('post')) {
            //debug($this->request->getData()['gouvernorats_id']);die;
            $this->loadModel('Gouvernoratcommercials');
            $commercial = $this->Commercials->patchEntity($commercial, $this->request->getData());
            if ($this->Commercials->save($commercial)) {
              //  debug($this->request->getData()) ; die ;
                $commercial_id = $commercial->id;
                //debug($commercial_id) ; die ;
                if (isset($this->request->getData('data')['objectifrep']) && (!empty($this->request->getData('data')['objectifrep']))) {
                  //debug($this->request->getData()) ; die ;
                    foreach ($this->request->getData('data')['objectifrep'] as $i => $c) {
                      //  foreach ($this->request->getData('data')['objectifrep'] as $i => $c) {
                        
                        
                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->newEmptyEntity();
                        $dataobj['commercial_id'] = $commercial_id;
                        $dataobj['objectif'] = $c['objectif'];
                        $dataobj['article_id'] = $c['article'];
                        $dataobj['moi_id'] = $c['mois'];
                       
                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                        $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                        //debug($seuil);
                    }
                }


                if (isset($this->request->getData()['gouvernorats_id']) && (!empty($this->request->getData()['gouvernorats_id']))) {
                   

                    foreach ($this->request->getData()['gouvernorats_id'] as $i => $per) {
                        $data = $this->fetchTable('Gouvernoratcommercials')->newEmptyEntity();
                        $data['commercial_id'] = $commercial_id;
                        $data['gouvernorat_id'] = $per;
                      $this->fetchTable('Gouvernoratcommercials')->save($data);
                        // debug($data);die;
                        //$this->Commercials->execute("INSERT INTO `gouvernoratcommercials` (`id`, `commercial_id`, `gouvernorat_id`) VALUES (NULL, NULL, NULL)");
                    }
                }
                 
                $this->Flash->success(__('The {0} has been saved.', 'Commercial'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commercial'));
        }

        
       
       


    
        $gouvernorats = $this->Commercials->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'Description']);
        $categories = $this->Commercials->Categories->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('articles', 'commercial', 'gouvernorats' ,'categories','mois'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Commercial id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Gouvernoratcommercials');
        $commercial = $this->Commercials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commercial = $this->Commercials->patchEntity($commercial, $this->request->getData());
            if ($this->Commercials->save($commercial)) {
                $commercial_id = $commercial->id;


                // $this->Gouvernoratcommercials->deleteAll(array('Gouvernoratcommercials.commercial_id' => $commercial_id), false);
                //  if ($this->request->data('data')['gouvernorat_id'] != array()) {
                $gouvcom = $this->Gouvernoratcommercials->find('all',array('conditions'=>array("Gouvernoratcommercials.commercial_id =". $id )));
  foreach ($gouvcom as $com) {
      $this->Gouvernoratcommercials->delete($com);
  }
                if (isset($this->request->getData()['gouvernorats_id']) && (!empty($this->request->getData()['gouvernorats_id']))) {
                    

                    foreach ($this->request->getData()['gouvernorats_id'] as $i => $per) {
                        $data = $this->fetchTable('Gouvernoratcommercials')->newEmptyEntity();
                        $data['commercial_id'] = $commercial_id;
                        $data['gouvernorat_id'] = $per;
                        // debug($data);die;
                        $this->Gouvernoratcommercials->save($data);
                    }
                }
                //}
                $this->Flash->success(__('The {0} has been saved.', 'Commercial'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commercial'));
        }
                $gouv = $this->Gouvernoratcommercials->find('all',array('conditions'=>array("Gouvernoratcommercials.commercial_id =". $id ),'fields'=>array('Gouvernoratcommercials.gouvernorat_id')));

                $gg=[];
                 foreach ($gouv as $i=>$g) {
                    
                 array_push($gg,$g['gouvernorat_id']);
                   
                     
                 }
                
               // debug($gg);
        $gouvernorats = $this->Commercials->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'Description']);
        $this->set(compact('gg','commercial', 'gouvernorats','gouv'));
    }



    /**
     * Delete method
     *
     * @param string|null $id Commercial id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->loadModel('Gouvernoratcommercials');
        $this->request->allowMethod(['post', 'delete']);
        $commercial = $this->Commercials->get($id);
        $gouvernoratcommercials = $this->Gouvernoratcommercials->find('all', [])
            ->where(['commercial_id' => $id]);
        foreach ($gouvernoratcommercials as $c) {

            $this->Gouvernoratcommercials->delete($c);
        }
        if ($this->Commercials->delete($commercial)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Commercial'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Commercial'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

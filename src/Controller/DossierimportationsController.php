<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Dossierimportations Controller
 *
 * @property \App\Model\Table\DossierimportationsTable $Dossierimportations
 * @method \App\Model\Entity\Dossierimportation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DossierimportationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $numero = $this->request->getQuery('numero');
        $fournisseur_id = $this->request->getQuery('fournisseur_id');
        $banque_id = $this->request->getQuery('banque_id');
    
        $cond1 = '' ; 
        $cond2 = '' ; 
        $cond3 = '' ; 
      

        if ($numero) {
            $cond1 = "Dossierimportations.numero like  '%" . $numero . "%' ";
        }
        if ($fournisseur_id) {
            $cond2 = "Dossierimportations.fournisseur_id  =  '" . $fournisseur_id . "' ";
        }
        if ($banque_id) {
            $cond3 = "Dossierimportations.banque_id  =  '" . $banque_id . "' ";
        }

        $query = $this->Dossierimportations->find('all')->where([$cond1, $cond2,$cond3]) ; 

        $this->paginate = [
            'contain' => ['Fournisseurs','Banques'],
        ];
        $dossierimportations = $this->paginate($query);

   
        $fournisseurs = $this->Dossierimportations->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $banques = $this->Dossierimportations->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $this->set(compact('dossierimportations','fournisseurs','banques'));
    }

    /**
     * View method
     *
     * @param string|null $id Dossierimportation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dossierimportation = $this->Dossierimportations->get($id, [
            'contain' => [],
        ]);
        $banques = $this->Dossierimportations->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $fournisseurs = $this->Dossierimportations->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('dossierimportation','banques','fournisseurs'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dossierimportation = $this->Dossierimportations->newEmptyEntity();

        $num = $this->Dossierimportations->find()->select(["num" =>
        'MAX(Dossierimportations.numero)'])->first();
        //debug($num);

        $n = $num->num;
        $in = intval($n) + 1;
        $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);

        if ($this->request->is('post')) {

            $imp['numero'] = $mm;
            $imp['date'] = $this->request->getData('date');
            $imp['etat'] = $this->request->getData('etat');
            $imp['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $imp['banque_id'] = $this->request->getData('banque_id');

            $dossierimportation = $this->Dossierimportations->patchEntity($dossierimportation, $imp);

            if ($this->Dossierimportations->save($dossierimportation)) {


                return $this->redirect(['action' => 'index']);
            }
        }

        $banques = $this->Dossierimportations->Banques->find('list', ['limit' => 200]);
        $fournisseurs = $this->Dossierimportations->Fournisseurs->find('list', ['limit' => 200]);


        $this->set(compact('dossierimportation','mm','banques','fournisseurs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Dossierimportation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dossierimportation = $this->Dossierimportations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dossierimportation = $this->Dossierimportations->patchEntity($dossierimportation, $this->request->getData());
            if ($this->Dossierimportations->save($dossierimportation)) {
               // $this->Flash->success(__('The {0} has been saved.', 'Dossierimportation'));

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Dossierimportation'));
        }

        $banques = $this->Dossierimportations->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $fournisseurs = $this->Dossierimportations->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $this->set(compact('dossierimportation','banques','fournisseurs'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Dossierimportation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dossierimportation = $this->Dossierimportations->get($id);
        if ($this->Dossierimportations->delete($dossierimportation)) {
            //$this->Flash->success(__('The {0} has been deleted.', 'Dossierimportation'));
        } else {
           // $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Dossierimportation'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

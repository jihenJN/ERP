<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Transporteurs Controller
 *
 * @property \App\Model\Table\TransporteursTable $Transporteurs
 * @method \App\Model\Entity\Transporteur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransporteursController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {


        $cond1 = '';
        $cond2 = '';

        $name = $this->request->getQuery('name');
        $matricule = $this->request->getQuery('matricule');
        //debug($famille_id);


        if ($name) {
            $cond1 = "Transporteurs.name LIKE '%" . $name . "%' ";
        }
        if ($matricule) {
            $cond2 = "Transporteurs.matricule LIKE '%" . $matricule . "%' ";
        }
        

        $query = $this->Transporteurs->find('all')->where([$cond1, $cond2])->order(["Transporteurs.id" => 'desc']);
        // debug($query);
     
        $transporteurs = $this->paginate($query);

        $this->set(compact('transporteurs'));
    }

    /**
     * View method
     *
     * @param string|null $id Transporteur id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transporteur = $this->Transporteurs->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('transporteur'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'transporteurs') {
                $societe = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $transporteur = $this->Transporteurs->newEmptyEntity();
        $num = $this->Transporteurs->find()->select(["numdepot" =>
        'MAX(Transporteurs.code)'])->first();

        $numero = $num->numdepot;
        if ($numero !== null) {
        $inc = intval(substr($numero, 1, 5)) + 1;
        $c = str_pad("$inc", 5, '0', STR_PAD_LEFT);
        //debug($c);
        $code = str_pad($c, 6, 'D', STR_PAD_LEFT);
        } else{
            $code = 'T00001';
        }
        if ($this->request->is('post')) {
            $num = $this->Transporteurs->find()->select(["numdepot" =>
            'MAX(Transporteurs.code)'])->first();
    
            $numero = $num->numdepot;
            if ($numero !== null) {
            $inc = intval(substr($numero, 1, 5)) + 1;
            $c = str_pad("$inc", 5, '0', STR_PAD_LEFT);
            //debug($c);
            $code = str_pad($c, 6, 'D', STR_PAD_LEFT);
            } else{
                $code = 'T00001';
            }
            
            $transporteur = $this->Transporteurs->patchEntity($transporteur, $this->request->getData());
            if ($this->Transporteurs->save($transporteur)) {
               // $this->Flash->success(__('The transporteur has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The transporteur could not be saved. Please, try again.'));
        }
        $this->set(compact('transporteur','code'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Transporteur id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'transporteurs') {
                $societe = $liens['modif'];
            }
        }
        // debug($societe);die;
         if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
       
        $transporteur = $this->Transporteurs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transporteur = $this->Transporteurs->patchEntity($transporteur, $this->request->getData());
            if ($this->Transporteurs->save($transporteur)) {
               // $this->Flash->success(__('The transporteur has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
          //  $this->Flash->error(__('The transporteur could not be saved. Please, try again.'));
        }
        $this->set(compact('transporteur'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Transporteur id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $sousfamille1 = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'transporteurs') {
                $sousfamille1 = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($sousfamille1 <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        //$this->request->allowMethod(['post', 'delete']);
        $transporteur = $this->Transporteurs->get($id);
        if ($this->Transporteurs->delete($transporteur)) {
          //  $this->Flash->success(__('The transporteur has been deleted.'));
        } else {
           // $this->Flash->error(__('The transporteur could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

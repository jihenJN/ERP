<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\Datasource\ConnectionManager;


/**
 * Reglementclients Controller
 *
 * @property \App\Model\Table\ReglementclientsTable $Reglementclients
 * @method \App\Model\Entity\Reglementclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReglementclientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($type = null)
    {

        $this->paginate = [
            'contain' => ['Utilisateurs','Clients'],
        ];
        $reglementclients = $this->paginate($this->Reglementclients);
   
            $factures = $this->Reglementclients->find('all')->where(['Reglementclients.type = 1'])->contain(['Clients']);
        
            $bonlivraisons = $this->Reglementclients->find('all')->where(['Reglementclients.type = 0'])->contain(['Clients']);

        $this->set(compact('reglementclients','type','factures','bonlivraisons'));
    }

    /**
     * View method
     *
     * @param string|null $id Reglementclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reglementclient = $this->Reglementclients->get($id, [
            'contain' => ['Utilisateurs', 'Lignereglementclients', 'Piecereglementclients'],
        ]);

        $this->set(compact('reglementclient'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($type=null,$client_id = null)
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        $reglementclient = $this->Reglementclients->newEmptyEntity();
        //debug($reglementclient);
        if ($this->request->is('post')) {
         
           
            $data['Date'] = $this->request->getData('Date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['Montant'] = $this->request->getData('data')['Reglementclient']['Montant'];
            $data['ttpayer'] = $this->request->getData('data')['Reglementclient']['ttpayer'];

            if ($type == 1) {
                $data['type']= 0;
            }else if ($type == 2) {
                $data['type']= 1;
            }
            
            $numeroobj = $this->Reglementclients->find()->select(["numero" =>
            'MAX(Reglementclients.numeroconca)'])->first();
            $numero = $numeroobj->numero;
            if ($numero != null) {

                $n = $numero;
                $lastnum = $n;
                $nume = intval($lastnum) + 1;
                $nn = (string)$nume;
                $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
    
            } else {
                $code = "00001";
            }

            $data['numeroconca'] = $code ;


            $reglement = $this->Reglementclients->patchEntity($reglementclient, $data);
            if ($this->Reglementclients->save($reglement)) {
               // debug($reglement);
                $reglement_id = $reglement->id;
                if (isset($this->request->getData('data')['Lignereglementclient']) && (!empty($this->request->getData('data')['Lignereglementclient']))) {
                    foreach ($this->request->getData('data')['Lignereglementclient'] as $i => $l) {

                        if (isset($l['factureclient_id'])) {

                            $ta = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $ta['reglementclient_id'] = $reglement_id;
                            $ta['factureclient_id'] = $l['factureclient_id'];
                            $ta['Montant'] = $l['Montanttt'];

                            $fact = $this->Factureclients->get($l['factureclient_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Factureclients->save($fact);
                            $this->fetchTable('Lignereglementclients')->save($ta);
                           // debug($ta);die;
                        }

                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabb['reglementclient_id'] = $reglement_id;
                            $tabb['bonlivraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = $l['Montanttt'];
                           

                            $fact = $this->Bonlivraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Bonlivraisons->save($fact);
                            $this->fetchTable('Lignereglementclients')->save($tabb);
                            //debug($tabb);die;

                        }
                    }
                }

                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                     //debug($this->request->getData('data')['pieceregelemnt']);
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglementclients')->newEmptyEntity();
                            $tab['reglementclient_id'] = $reglement_id;
                            $tab['paiement_id'] = $p['paiement_id'];
                            $tab['montant'] = $p['montant'];
                            $tab['to_id'] = $p['taux'];
                            $tab['montant_net'] = $p['montantnet'];
                            $tab['echance'] = $p['echance'];
                            $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                            $tab['num'] = $p['num_piece'];
                            $tab['banque_id'] = $p['banque'];
                            
                            $this->fetchTable('Piecereglementclients')->save($tab);
                            //debug($tab);die;

                        }
                    }
                }
                //  $this->Flash->success(__('The reglement has been saved.'));

                return $this->redirect(['action' => 'index/'.$type]);
            }
            // $this->Flash->error(__('The reglement could not be saved. Please, try again.'));
        }

        $factureclients = '';
        $livraisons = '';

        if ($client_id != null ) {
            $this->loadModel('Factureclients');
            $this->loadModel('Bonlivraisons');
        $factureclients = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $client_id , 'Factureclients.totalttc > Factureclients.Montant_Regler']);
        $livraisons = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.client_id =' . $client_id , 'Bonlivraisons.typebl=1', 'Bonlivraisons.bl= 1', 'Bonlivraisons.totalttc > Bonlivraisons.Montant_Regler']);
       // debug($livraisons->toArray());
        //debug($factureclients->toArray());
        }
       
        $numeroobj = $this->Reglementclients->find()->select(["numero" =>
        'MAX(Reglementclients.numeroconca)'])->first();
        $numero = $numeroobj->numero;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);

        } else {
            $code = "00001";
        }
        
       
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $this->loadModel('Banques');
        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
       // $piece = $this->Piecereglementclients->find('all', ['']);
        //debug($piece->toArray());
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all')->where(["Clients.etat='$cha'"]);

        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        $this->set(compact('banques','timbre','type','valeurs', 'carnetcheques', 'paiements', 'livraisons', 'factureclients', 'client_id',  'code', 'reglementclient','clients', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reglementclient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($type=null,$id = null)
    {

        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        $reglement = $this->Reglementclients->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
                      
             
            $data['numeroconca'] = $this->request->getData('numeroconca'); ;
            $data['Date'] = date('Y-m-d',strtotime($this->request->getData('date')));
            $data['client_id'] = $this->request->getData('client_id');
            $data['Montant'] = $this->request->getData('data')['Reglementclients']['Montant'];
            $data['ttpayer'] = $this->request->getData('data')['Reglementclients']['ttpayer'];
            $reglement = $this->Reglementclients->patchEntity($reglement, $data);
            if ($this->Reglementclients->save($reglement)) {
                //debug($reglement);die;
                $lignes = $this->Lignereglementclients->find()->where(["Lignereglementclients.reglementclient_id=".$id])->all();

                //debug($lignes);die;
                
                foreach ($lignes as $item) {
                    
                    if ($item['factureclient_id'] != null) {
                        $mtg = $this->Factureclients->find()->select(["mtreg" =>
                        'Factureclients.Montant_Regler'])->where(['Factureclients.id ='.$item['factureclient_id']])->first();
                        $MontantRegler = $mtg->mtreg;
                        $fact = $this->Factureclients->get($item['factureclient_id']);
                        $fact->Montant_Regler = $MontantRegler - $item['Montanttt'];
                        $this->Factureclients->save($fact);
                    }
                    if ($item['Bonlivraison_id'] != null) {
                        $mtg = $this->Bonlivraisons->find()->select(["mtreg" =>
                        'Bonlivraisons.Montant_Regler'])->where(['Bonlivraisons.id =' . $item['bonlivraison_id']])->first();
                        $MontantRegler = $mtg->mtreg;
                        $fact = $this->Bonlivraisons->get($item['bonlivraison_id']);
                        $fact->Montant_Regler = $MontantRegler - $item['Montanttt'];
                        $this->Bonlivraisons->save($fact);
                    }

                    $this->Lignereglementclients->delete($item);
                }
                       $lignes2 = $this->Piecereglementclients->find()->where(["Piecereglementclients.reglementclient_id =" .$id])->all();
                 foreach ($lignes2 as $item) {
                     $this->Piecereglementclients->delete($item);
                 }
                if (isset($this->request->getData('data')['Lignereglementclient']) && (!empty($this->request->getData('data')['Lignereglementclient']))) {
               
                    foreach ($this->request->getData('data')['Lignereglementclient'] as $i => $l) {
                        if (isset($l['factureclient_id'])) {

                            $ta = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $ta['reglementclient_id'] = $id;
                            $ta['factureclient_id'] = $l['factureclient_id'];
                            $ta['Montant'] = $l['Montanttt'];
                        $mtg = $this->Factureclients->find()->select(["mtreg" =>
                            'Factureclients.Montant_Regler'])->where(['Factureclients.id =' . $l['factureclient_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factureclients->get($l['factureclient_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Factureclients->save($fact);

                            $this->fetchTable('Lignereglementclients')->save($ta);
                        }

                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $tabb['reglementclient_id'] = $id;
                            $tabb['bonlivraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = $l['Montanttt'];
                           
                            $mtg = $this->Bonlivraisons->find()->select(["mtreg" =>
                            'Bonlivraisons.Montant_Regler'])->where(['Bonlivraisons.id =' . $l['bonreception_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Bonlivraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt']; /*ttc*/

                            $this->Bonlivraisons->save($fact);
                            //debug($fact);
                            $this->fetchTable('Lignereglementclients')->save($tabb);
                            //debug($tabb);die;
                        }
                    }
                }



                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglementclients')->newEmptyEntity();
                            $tab['reglementclient_id'] = $id;
                            $tab['paiement_id'] = $p['paiement_id'];
                            $tab['montant'] = $p['montant'];
                            $tab['to_id'] = $p['taux'];
                            $tab['montant_net'] = $p['montantnet'];
                            $tab['echance'] = $p['echance'];
                            $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                            $tab['num'] = $p['num_piece'];
                            $tab['banque_id'] = $p['banque_id'];
                            $this->fetchTable('Piecereglementclients')->save($tab);

                        }
                    }
                }

                return $this->redirect(['action' => 'index/' . $type]);
            }
        }
        $cli = $reglement->client_id;
        //debug($id);
      
        $lignesreg = $this->Lignereglementclients->find('all')->where(['Lignereglementclients.reglementclient_id ='.$id]);
        //debug(($lignesreg->toArray())) ;die;

        
        foreach ($lignesreg as $l => $li) {
            $l = '(0';
            
           
            if ($li['factureclient_id'] != 0) {
                $l.=',' . $li['factureclient_id'];
            }
           
            else if($li['bonlivraison_id'] != 0){
               $l.=',' . $li['bonlivraison_id'];
            }
            $l.=',0)';
        } debug($l);




        foreach ($lignesreg as $s => $si) {
           
            if ($si['factureclient_id'] != 0) {
                $s=$si['reglementclient_id'];
           
        }
            else if($si['bonlivraison_id'] != 0){
                $s=$si['reglementclient_id'];
              
        }


           
        }
        $piecereglementclients = $this->Piecereglementclients->find('all')->where(['Piecereglementclients.reglementclient_id =' . $id]);
        $mtbon = 0.000;
        $mtfact = 0.000;

       


        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['factureclient_id'] != null) {
                $facreg[$ligne['factureclient_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else {
                $facreg[$ligne['bonlivraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
        }

        if ($cli != null) {
            $this->loadModel('Factureclients');
            $this->loadModel('Bonlivraisons');
            $connection = ConnectionManager::get('default');

           // $factures = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $cli , 'Factureclients.totalttc > Factureclients.Montant_Regler']);
           $factures= $connection->execute("select * from factureclients where (factureclients.client_id=".$cli." and factureclients.totalttc > factureclients.Montant_Regler) OR (factureclients.id in".$l.");")->fetchAll('assoc');
           
           $livraisons= $connection->execute("select * from bonlivraisons where (bonlivraisons.client_id=".$cli." and bonlivraisons.typebl=1 and bonlivraisons.bl= 1 and bonlivraisons.totalttc > bonlivraisons.Montant_Regler) OR (bonlivraisons.id in".$l.");")->fetchAll('assoc');
           //debug($livraisons->toArray());
        }


        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all')->where(["Clients.etat='$cha'"]);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->loadModel('Banques');
        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('timbre','banques','type','s','id','mtfact', 'mtbon', 'facreg', 'piecereglementclients', 'lignesreg','valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Reglementclient id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($type=null , $id = null)
    {
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');
        
        $this->request->allowMethod(['post', 'delete']);

         $ligne1 = $this->Lignereglementclients->find('all', [])->where(['Lignereglementclients.reglementclient_id =' . $id]);
        //  dd(JSON_encode($ligne1)) ;

        //debug($lignereglementclient->toArray());die;
        foreach ($ligne1 as $l) {
           
            $this->Lignereglementclients->delete($l);
        }

        $lignes2 = $this->Piecereglementclients->find()->where(["Piecereglementclients.reglementclient_id=".$id])->all();
        foreach ($lignes2 as $item) {
            $this->Piecereglementclients->delete($item);
        }


        $reglementclient = $this->Reglementclients->get($id);
        if ($this->Reglementclients->delete($reglementclient)) {
           // $this->Flash->success(__('The reglementclient has been deleted.'));
        } else {
           // $this->Flash->error(__('The reglementclient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index/'.$type]);
    }
}

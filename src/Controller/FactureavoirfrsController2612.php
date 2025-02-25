<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Factureavoirfrs Controller
 *
 * @property \App\Model\Table\FactureavoirfrsTable $Factureavoirfrs
 * @method \App\Model\Entity\Factureavoirfr[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FactureavoirfrsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($type = null)
    {
        $this->paginate = [
            'contain' => ['Utilisateurs'],
        ];
		$con = 'Factureavoirfrs.type="' . $type . '"';
        $factureavoirfrs = $this->paginate($this->Factureavoirfrs);

        $this->set(compact('factureavoirfrs','type'));
    }

    /**
     * View method
     *
     * @param string|null $id Factureavoirfr id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $factureavoirfr = $this->Factureavoirfrs->get($id, [
            'contain' => ['Utilisateurs', 'Lignefactureavoirfrs'],
        ]);

        $this->set(compact('factureavoirfr'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($type = null)
	{
		$this->loadModel('Factureavoirfrs');
		$this->loadModel('Articles');
		$this->loadModel('Depots');
		$this->loadModel('Utilisateurs');
		$this->loadModel('Lignefactureavoirfrs');
		$this->loadModel('Lignefactures');
		$this->loadModel('Factures');
		$this->loadModel('Pointdeventes');
		$this->loadModel('Fournisseurs');
		$this->loadModel('Tvas');

		$factureavoirfrs = $this->Factureavoirfrs->newEmptyEntity();

		if ($this->request->is('post')) {
			//debug($this->request->getdata());
			$data=$this->Factureavoirfrs->newEmptyEntity();
			
			$data['model'] = 'avoir';
			$data['date'] =  $this->request->getdata('date');
			$data['facture_id'] =  $this->request->getdata('facture_id');
			$data['fournisseur_id'] =  $this->request->getdata('fournisseur_id');
			$data['typefacture_id'] = 1;
			$data['etat'] = 1;
			$data['depot_id'] = $this->request->getdata('depot_id');
			$data['totalht'] = $this->request->getdata('totalht');
			$data['tauxtva'] = $this->request->getdata('tauxtva');
			$data['tva_id'] = $this->request->getdata('tvaa');
			$data['totalttc'] = $this->request->getdata('totalttc');

			$codeobj = $this->Factureavoirfrs->find()->select(["numero" =>
			'MAX(Factureavoirfrs.numeroconca)'])->first();
			$num = $codeobj->numero;
			if ($num != null) {
				//debug($num);
				$n = $num;
				$lastnum = $n;
				$numo = intval($lastnum) + 1;
				$cc = (string)$numo;
				$numero = str_pad($cc, 5, '0', STR_PAD_LEFT);
			} else {
				$numero = "00001";
				//debug($numero);die;
			}
	    	 $numspecial = "FACAV/" . $numero . "/" . date("Y");
			 $data['numero'] = $this->request->getdata('numero');

			if ($this->Factureavoirfrs->save($data)) {

				if ($type == 1) {
					return $this->redirect(['action' => 'index/1']);
				} else if ($type == 2) {
					return $this->redirect(['action' => 'index/2']);
				}
			} 
		}

		$codeobj = $this->Factureavoirfrs->find()->select(["numero" =>
			'MAX(Factureavoirfrs.numeroconca)'])->first();
			$num = $codeobj->numero;
			if ($num != null) {
				//debug($num);
				$n = $num;
				$lastnum = $n;
				$numo = intval($lastnum) + 1;
				$cc = (string)$numo;
				$numero = str_pad($cc, 5, '0', STR_PAD_LEFT);
			} else {
				$numero = "00001";
				//debug($numero);die;
			}
			$numspecial = "FACAV/" . $numero . "/" . date("Y");

		$tvas = $this->Tvas->find('list',['keyfield' => 'id', 'valueField' => 'valeur']);
		if ($type == 1) {
			$factures = $this->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])->where('Factures.typef = 1');
        } else if ($type == 2) {
			$factures = $this->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])->where('Factures.typef = 2');
		}
		$depots = $this->Depots->find('list',['keyfield' => 'id', 'valueField' => 'name']);
		if ($type == 1) {
			$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list', array('conditions' => array('Fournisseurs.devise_id =1')));
		} else if ($type == 2) {
			$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list', array('conditions' => array('Fournisseurs.devise_id != 1')));
		}
		$this->set(compact('depots','factureavoirfrs','numspecial', 'fournisseurs', 'factures', 'type'));
	}

    /**
     * Edit method
     *
     * @param string|null $id Factureavoirfr id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	public function edit($type = null, $id = null)
	{

		$this->loadModel('Factureavoirfrs');
		$this->loadModel('Articles');
		$this->loadModel('Depots');
		$this->loadModel('Lignefactureavoirfrs');
		$this->loadModel('Lignefactures');
		$this->loadModel('Factures');
		$this->loadModel('Fournisseurs');
		$this->loadModel('Tvas');

		$factureavoirfrs = $this->Factureavoirfrs->get($id, [
            'contain' => [],
        ]);
		//debug($factureavoirfrs);
		
		if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData());die;
		
			$factureavoirfrs = $this->Factureavoirfrs->patchEntity($factureavoirfrs, $this->request->getData());
			if ($this->Factureavoirfrs->save($factureavoirfrs)) {
				$id = $factureavoirfrs->id;


				 if (isset($this->request->getdata('data')['Lignefacture'])){
					foreach ($this->request->getdata('data')['Lignefacture'] as $numl => $f) {
//debug($this->request->getdata());die;
						if (!empty($f['article_id']) && !empty($f['quantite'])) {
							//debug($f);
							if ($f['quantite'] != 0) {
								$Lignefactureavoirfrs=$this->Lignefactureavoirfrs->newEmptyEntity();
								$Lignefactureavoirfrs['factureavoirfr_id'] = $id;
								$Lignefactureavoirfrs['depot_id'] =$this->request->getdata('depot_id');
								$Lignefactureavoirfrs['article_id'] = $f['article_id'];
								$Lignefactureavoirfrs['lignefacture_id'] = $f['id'];
								$Lignefactureavoirfrs['quantite'] = $f['quantite'];
								$Lignefactureavoirfrs['remise'] = $f['remise'];
								$Lignefactureavoirfrs['tva'] = $f['tva_id'];
								$Lignefactureavoirfrs['prix'] = $f['prix'];
								$Lignefactureavoirfrs['fodec'] = $f['fodec'];
								$Lignefactureavoirfrs['totalht'] = $f['totalht'];
								$Lignefactureavoirfrs['totalttc'] = $f['totalttc'];
								$this->Lignefactureavoirfrs->save($Lignefactureavoirfrs);
							}
						}
					}
				}
			
				if ($type == 1) {
					return $this->redirect(['action' => 'index/1']);
				} else if ($type == 2) {
					return $this->redirect(['action' => 'index/2']);
				}
			} 
		} 
		

		$lignefactureavoirfrs = $this->Lignefactureavoirfrs->find('all', [])->where(['Lignefactureavoirfrs.factureavoirfr_id='. $id]);

		if ($type == 1) {
			$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list', array('conditions' => array('Fournisseurs.devise_id =1')));
		} else if ($type == 2) {
			$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list', array('conditions' => array('Fournisseurs.devise_id != 1')));
		}

		if ($type == 1) {
			$factures = $this->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])->where('Factures.typef = 1');
        } else if ($type == 2) {
			$factures = $this->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])->where('Factures.typef = 2');
		}
		$tvas = $this->Tvas->find('list',['keyfield' => 'id', 'valueField' => 'valeur']);
		$articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designation']);
		$art = $this->Articles->find('list',['keyfield' => 'id', 'valueField' => 'Dsignation']);
		$depots = $this->Depots->find('list',['keyfield' => 'id', 'valueField' => 'name']);

		$this->set(compact('factureavoirfrs','tvas','type', 'art', 'articles', 'lignefactureavoirfrs',  'fournisseurs',  'factures',  'typefactures','depots'));
	}

	public function addfactureavoir($type = null, $idfc = null)
	{

		$this->loadModel('Factureavoirfrs');
		$this->loadModel('Articles');
		$this->loadModel('Timbres');
		$this->loadModel('Depots');
		$this->loadModel('Utilisateurs');
		$this->loadModel('Lignefactureavoirfrs');
		$this->loadModel('Lignefactures');
		$this->loadModel('Factures');
		$this->loadModel('Pointdeventes');
		$this->loadModel('Fournisseurs');
		$this->loadModel('Tvas');
		$this->loadModel('Devises');

		$model = 'Factures';
		$ligne_model = 'Lignefactures';
		$attr = 'facture_id';
		$factureavoirfrs = $this->Factureavoirfrs->newEmptyEntity();
		
		if ($this->request->is(['post'])) {


			$data=$this->Factureavoirfrs->newEmptyEntity();

			//debug($this->request->getdata());die;
			$data['model'] = 'avoir';
			$data['date'] =  date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getdata('date'))));
			$data['facture_id'] = $idfc;
			$data['typefacture_id'] = 1;
			$data['type'] = $type;

			$codeobj = $this->Factureavoirfrs->find()->select(["numero" =>
			'MAX(Factureavoirfrs.numeroconca)'])->first();
			$num = $codeobj->numero;
			if ($num != null) {
				//debug($num);
				$n = $num;
				$lastnum = $n;
				$numo = intval($lastnum) + 1;
				$cc = (string)$numo;
				$numero = str_pad($cc, 5, '0', STR_PAD_LEFT);
				
			} else {
				$numero = "00001";
				//debug($numero);die;
			}
	    	$numspecial = "FACAV/" . $numero . "/" . date("Y");
            // $data['numeroconca'] = $mm;
			$data['numero'] = $numspecial;
			
			$data['fournisseur_id'] = $this->request->getdata('fournisseur_id');
			$depot=$data['depot_id'] = $this->request->getdata('depot_id');
			$data['remise'] = $this->request->getdata('remise');
			$data['fodec'] = $this->request->getdata('fodec');
			$data['totalht'] = $this->request->getdata('totalht');
			$data['totalttc'] = $this->request->getdata('totalttc');
		
			if ($this->Factureavoirfrs->save($data)) {

				 $id = $data->id;

				//debug($this->request->getdata('data'));die;
				if (isset($this->request->getdata('data')['Lignefacture'])){
					foreach ($this->request->getdata('data')['Lignefacture'] as $numl => $f) {
//debug($this->request->getdata());die;
						if (!empty($f['article_id']) && !empty($f['quantite'])) {
							//debug($f);
							if ($f['quantite'] != 0) {
								$Lignefactureavoirfrs=$this->Lignefactureavoirfrs->newEmptyEntity();
								$Lignefactureavoirfrs['factureavoirfr_id'] = $id;
								$Lignefactureavoirfrs['depot_id'] = $depot;
								$Lignefactureavoirfrs['article_id'] = $f['article_id'];
								$Lignefactureavoirfrs['lignefacture_id'] = $f['id'];
								$Lignefactureavoirfrs['quantite'] = $f['quantite'];
								$Lignefactureavoirfrs['remise'] = $f['remise'];
								$Lignefactureavoirfrs['tva_id'] = $f['tva_id'];
								$Lignefactureavoirfrs['prix'] = $f['prix'];
								$Lignefactureavoirfrs['fodec'] = $f['fodec'];
								$Lignefactureavoirfrs['totalht'] = $f['totalht'];
								$Lignefactureavoirfrs['totalttc'] = $f['totalttc'];
									//debug($Lignefactureavoirfrs);die;
								$this->Lignefactureavoirfrs->save($Lignefactureavoirfrs);
								//debug($Lignefactureavoirfrs);die;
								
								$somqte = 0;
								$somqte = (int)$f['quantite'] + (int)$f['somqte'];
								if ($somqte < (int)$f['qtea']) {

									$test = 1;
								}
							}
						}
					} //die;
				}
				if ($type == 1) 
				{
					return $this->redirect(['action' => 'index/1']);
				} else if ($type == 2) {
					return $this->redirect(['action' => 'index/2']);
				}
			} 
		}

		$codeobj = $this->Factureavoirfrs->find()->select(["numero" =>
			'MAX(Factureavoirfrs.numeroconca)'])->first();
			$num = $codeobj->numero;
			if ($num != null) {
				//debug($num);
				$n = $num;
				$lastnum = $n;
				$numo = intval($lastnum) + 1;
				$cc = (string)$numo;
				$numero = str_pad($cc, 5, '0', STR_PAD_LEFT);
				
			} else {
				$numero = "00001";
				//debug($numero);die;
			}
	    	$numspecial = "FACAV/" . $numero . "/" . date("Y");

		$lignefactures = $this->$ligne_model->find('all',[])->where(['Lignefactures.facture_id='. $idfc])->order(['Lignefactures.id' => 'ASC']);
		$facture = $this->Factures->find('all', ['contain'=>'Lignefactures'])->where(['Factures.id ='. $idfc]);
		$fac = $this->Factures->get($idfc, [
            'contain' => [],
        ]);
		$facture=$facture->toArray();

		$dep= $this->Depots->find('list',['keyfield' => 'id', 'valueField' => 'name']);
		$fournisseurs = $this->Fournisseurs->find('list',['keyfield' => 'id', 'valueField' => 'name']);
		$depots = $this->Depots->find('list',['keyfield' => 'id', 'valueField' => 'name']);
		$art = $this->Articles->find('list',['keyfield' => 'id', 'valueField' => 'Dsignation']);

		$this->set(compact('fournisseurs','fac','factureavoirfrs','art','type',  'facture', 'lignefactures','numspecial', 'idfc', 'model', 'ligne_model', 'fournisseurs', 'depots'));
	}

	    /**
     * Delete method
     *
     * @param string|null $id Factureavoirfr id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($type=null,$id = null)
    {
		$this->loadModel('Lignefactureavoirfrs');
        $this->request->allowMethod(['post', 'delete']);
       
			
		
	$factureavoirfr = $this->Factureavoirfrs->get($id);
	//debug($factureavoirfr);die;
	
	if ($this->Factureavoirfrs->delete($factureavoirfr)) {
		// debug($factureavoirfr);die;
		$lignefactureavoirfr = $this->Lignefactureavoirfrs->find('all', [])->where(['Lignefactureavoirfrs.factureavoirfr_id =' . $id]);
		//debug($lignefactureavoirfr);die;
		foreach ($lignefactureavoirfr as $c) {

		$this->Lignefactureavoirfrs->delete($c);
	}
			if ($type == 1) {
				$this->redirect(array('action' => 'index/1'));
			} else if ($type == 2) {
				$this->redirect(array('action' => 'index/2'));
			}
	}

    }
}

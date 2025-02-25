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
	public function index()
	{
		$session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'factureavoirfrs') {
                $fournisseur = 1;
            }
        }
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
		$this->loadModel('Fournisseurs');
		//debug($type);
		$cond1 = '';
		$cond2 = '';
		$cond3 = '';
		$cond4 = '';


		$numero = $this->request->getQuery('numero');
		$date = $this->request->getQuery('date');
		$facture_id = $this->request->getQuery('facture_id');
		$fournisseur_id = $this->request->getQuery('fournisseur_id');


		if ($facture_id) {
			$cond1 = "Factureavoirfrs.facture_id ='" . $facture_id . "'";
		}
		if ($numero) {
			$cond2 = "Factureavoirfrs.numero =  '%" . $numero . "%' ";
		}
		if ($fournisseur_id) {
			$cond3 = "Factureavoirfrs.fournisseur_id =  '" . $fournisseur_id . "' ";
		}
		if ($date) {
			$cond4 = "Factureavoirfrs.date =  '%" . $date . "%' ";
		}

		//	$condtype = "Factureavoirfrs.type = " . $type;

		$query = $this->Factureavoirfrs->find('all')->where([$cond1, $cond2, $cond3, $cond4])->order(['Factureavoirfrs.id' => 'DESC']);
		//debug($query);die;
		//debug($query->toArray());die;['Factureavoirs.id' => 'DESC']

		$this->paginate = [
			'limit' => 10,
			'contain' => ['Utilisateurs', 'Fournisseurs', 'Factures']
		];

		$factureavoirfrs = $this->paginate($query);

		///debug($factureavoirfrs) ;


		$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


		//if ($type == 1) {
		$factures = $this->Factureavoirfrs->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
		//} else if ($type == 2) {
		// $factures = $this->Factureavoirfrs->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])->where('Factures.typef= 2');
		//}

		$this->set(compact('factures', 'fournisseurs', 'factureavoirfrs'));
	}

	/**
	 * View method
	 *
	 * @param string|null $id Factureavoirfr id.
	 * @return \Cake\Http\Response|null|void Renders view
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view2307($id = null)
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
			// debug($this->request->getData());
			// die;

			$factureavoirfrs = $this->Factureavoirfrs->patchEntity($factureavoirfrs, $this->request->getData());
			if ($this->Factureavoirfrs->save($factureavoirfrs)) {
				$id = $factureavoirfrs->id;


				if (isset($this->request->getdata('data')['Lignefacture'])) {
					$lignefactureavoirfr = $this->Lignefactureavoirfrs->find('all', [])->where(['Lignefactureavoirfrs.factureavoirfr_id =' . $id]);
					foreach ($lignefactureavoirfr as $c) {
						$this->Lignefactureavoirfrs->delete($c);
					}
					foreach ($this->request->getdata('data')['Lignefacture'] as $numl => $f) {
						//debug($this->request->getdata());die;
						if (!empty($f['article_id']) && !empty($f['quantite'])) {
							//debug($f);
							if ($f['quantite'] != 0) {
								$Lignefactureavoirfrs = $this->Lignefactureavoirfrs->newEmptyEntity();
								$Lignefactureavoirfrs['factureavoirfr_id'] = $id;
								$Lignefactureavoirfrs['depot_id'] = $this->request->getdata('depot_id');
								$Lignefactureavoirfrs['article_id'] = $f['article_id'];
								$Lignefactureavoirfrs['lignefacture_id'] = $f['id'];
								$Lignefactureavoirfrs['quantite'] = $f['quantite'];
								// $Lignefactureavoirfrs['qtea'] = $f['qtea'];
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

				//if ($type == 1) {
				return $this->redirect(['action' => 'index']);
				//} else if ($type == 2) {
				//return $this->redirect(['action' => 'index/2']);
				//}
			}
		}


		$lignefactureavoirfrs = $this->Lignefactureavoirfrs->find('all', [])->where(['Lignefactureavoirfrs.factureavoirfr_id=' . $id]);

		//	if ($type == 1) {
		$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list');
		//, array('conditions' => array('Fournisseurs.devise_id =1')));
		// } else if ($type == 2) {
		// 	$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list', array('conditions' => array('Fournisseurs.devise_id != 1')));
		// }

		//if ($type == 1) {
		$factures = $this->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
		//->where('Factures.typef = 1');
		// } else if ($type == 2) {
		// 	$factures = $this->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])->where('Factures.typef = 2');
		// }
		$tvas = $this->Tvas->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
		$articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designation']);
		$art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
		$depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

		$this->set(compact('factureavoirfrs', 'tvas', 'art', 'articles', 'lignefactureavoirfrs',  'fournisseurs',  'factures',  'typefactures', 'depots'));
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
	 */
	public function adddalanda()
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
		//debug($factureavoirfrs);die;

		if ($this->request->is('post')) {
			//debug($this->request->getdata());
			$data = $this->Factureavoirfrs->newEmptyEntity();

			$codeobj = $this->Factureavoirfrs->find()->select(["numero" =>
			'MAX(Factureavoirfrs.numero)'])->first();
			//debug($codeobj);
			$num = $codeobj->numero;
			if ($num != null) {

				$n = $num;
				$lastnum = $n;
				$numo = intval($lastnum) + 1;
				$nn = (string)$numo;
				$numero = str_pad($nn, 5, "0", STR_PAD_LEFT);
				//debug($numero);
			}
			//else {
			//	$numero = "00001";
			//}
			$data['model'] = 'avoir';
			$data['date'] =  $this->request->getdata('date');
			$data['facture_id'] =  $this->request->getdata('facture_id');
			$data['fournisseur_id'] =  $this->request->getdata('fournisseur_id');
			$data['typefacture_id'] = 1;
			//$data['type'] = $type;
			$data['etat'] = 1;
			$data['depot_id'] = $this->request->getdata('depot_id');
			$data['totalht'] = $this->request->getdata('totalht');
			$data['tauxtva'] = $this->request->getdata('tauxtva');
			//$data['tva_id'] = $this->request->getdata('tvaa');
			$data['totalttc'] = $this->request->getdata('totalttc');
			$data['numero'] = $this->request->getdata('numero');

			if ($this->Factureavoirfrs->save($data)) {

				// if ($type == 1) {
				// 	return $this->redirect(['action' => 'index/1']);
				// } else if ($type == 2) {
				return $this->redirect(['action' => 'index']);
				//}
			}
		}

		$codeobj = $this->Factureavoirfrs->find()->select(["numero" =>
		'MAX(Factureavoirfrs.numero)'])->first();
		$num = $codeobj->numero;
		if ($num != null) {
			//debug($num);
			$n = $num;
			$lastnum = $n;
			$numo = intval($lastnum) + 1;
			$nn = (string)$numo;
			$numero = str_pad($nn, 5, "0", STR_PAD_LEFT);
		}
		//else {
		//$numero = "00001";
		//}


		$tvas = $this->Tvas->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
		//if ($type == 1) {
		$factures = $this->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
		//->where('Factures.typef = 1');
		// } else if ($type == 2) {
		// 	$factures = $this->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])->where('Factures.typef = 2');
		// }
		$depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
		//if ($type == 1) {
		$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list');
		//, array('conditions' => array('Fournisseurs.typelocalisation_id =1')));
		// } else if ($type == 2) {
		// 	$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list', array('conditions' => array('Fournisseurs.typelocalisation_id = 2')));
		// }
		$this->set(compact('depots', 'factureavoirfrs', 'numero', 'fournisseurs', 'factures', 'type'));
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Factureavoirfr id.
	 * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'factureavoirfrs') {
                $fournisseur = $liens['modif'];
            }
        }
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
		$this->loadModel('Timbres');
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
			$data['fournisseur_id'] = $this->request->getdata('fournisseur_id');
			$depot = $data['depot_id'] = $this->request->getdata('depot_id');
			$data['remise'] = $this->request->getdata('remise');
			$data['fodec'] = $this->request->getdata('fodec');
			$data['totalht'] = $this->request->getdata('ht');
			$data['totalttc'] = $this->request->getdata('ttc');
			$data['tauxtva'] = $this->request->getdata('tva');
			$factureavoirfrs = $this->Factureavoirfrs->patchEntity($factureavoirfrs, $data);
			if ($this->Factureavoirfrs->save($factureavoirfrs)) {
				$id = $factureavoirfrs->id;


				if (isset($this->request->getdata('data')['Lignefacture'])) {
					$lignefactureavoirfr = $this->Lignefactureavoirfrs->find('all', [])->where(['Lignefactureavoirfrs.factureavoirfr_id =' . $id]);
					foreach ($lignefactureavoirfr as $c) {
						$this->Lignefactureavoirfrs->delete($c);
					}
					foreach ($this->request->getdata('data')['Lignefacture'] as $numl => $f) {
						//debug($this->request->getdata());die;
						if (!empty($f['article_id']) && !empty($f['quantite'])) {
							//debug($f);
							if ($f['quantite'] != 0) {
								$Lignefactureavoirfrs = $this->Lignefactureavoirfrs->newEmptyEntity();
								$Lignefactureavoirfrs['factureavoirfr_id'] = $id;
								$Lignefactureavoirfrs['depot_id'] = $this->request->getdata('depot_id');
								$Lignefactureavoirfrs['article_id'] = $f['article_id'];
								$Lignefactureavoirfrs['lignefacture_id'] = $f['id'];
								$Lignefactureavoirfrs['quantite'] = $f['quantite'];
								//$Lignefactureavoirfrs['qtea'] = $f['qtea'];
								$Lignefactureavoirfrs['remise'] = $f['remise'];
								$Lignefactureavoirfrs['tva'] = $f['tva'];
								$Lignefactureavoirfrs['prix'] = $f['prix'];
								$Lignefactureavoirfrs['fodec'] = $f['fodec'];
								$Lignefactureavoirfrs['totalht'] = $f['totalht'];
								$Lignefactureavoirfrs['totalttc'] = $f['totalttc'];
								$this->Lignefactureavoirfrs->save($Lignefactureavoirfrs);
							}
						}
					}
				}

				// if ($type == 1) {
				// 	return $this->redirect(['action' => 'index/1']);
				// } else if ($type == 2) {
				return $this->redirect(['action' => 'index']);
				//}
			}
		}


		$lignefactureavoirfrs = $this->Lignefactureavoirfrs->find('all', [])->where(['Lignefactureavoirfrs.factureavoirfr_id=' . $id]);

		$fournisseurs = $this->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

		//if ($type == 1) {
		$factures = $this->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
		//->where('Factures.typef = 1');
		// } else if ($type == 2) {
		// 	$factures = $this->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])->where('Factures.typef = 2');
		// }
		$tvas = $this->Tvas->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
		$articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designation']);
		$art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
		$depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
		$timbr = $this->Timbres->find('all', ['keyfield' => 'id', 'valueField' => 'timbre']);
		$tab1 = array();
		foreach ($timbr as $tab1); {
			// debug($tab1['timbre']);
		}
		$this->set(compact('tab1', 'factureavoirfrs', 'tvas', 'art', 'articles', 'lignefactureavoirfrs',  'fournisseurs',  'factures', 'depots'));
	}
	public function view($id = null)
	{


		$session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'factureavoirfrs') {
                $fournisseur = 1;
            }
        }
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
		$this->loadModel('Timbres');
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
			$data['fournisseur_id'] = $this->request->getdata('fournisseur_id');
			$depot = $data['depot_id'] = $this->request->getdata('depot_id');
			$data['remise'] = $this->request->getdata('remise');
			$data['fodec'] = $this->request->getdata('fodec');
			$data['totalht'] = $this->request->getdata('ht');
			$data['totalttc'] = $this->request->getdata('ttc');
			$data['tauxtva'] = $this->request->getdata('tva');
			$factureavoirfrs = $this->Factureavoirfrs->patchEntity($factureavoirfrs, $data);
			if ($this->Factureavoirfrs->save($factureavoirfrs)) {
				$id = $factureavoirfrs->id;


				if (isset($this->request->getdata('data')['Lignefacture'])) {
					$lignefactureavoirfr = $this->Lignefactureavoirfrs->find('all', [])->where(['Lignefactureavoirfrs.factureavoirfr_id =' . $id]);
					foreach ($lignefactureavoirfr as $c) {
						$this->Lignefactureavoirfrs->delete($c);
					}
					foreach ($this->request->getdata('data')['Lignefacture'] as $numl => $f) {
						//debug($this->request->getdata());die;
						if (!empty($f['article_id']) && !empty($f['quantite'])) {
							//debug($f);
							if ($f['quantite'] != 0) {
								$Lignefactureavoirfrs = $this->Lignefactureavoirfrs->newEmptyEntity();
								$Lignefactureavoirfrs['factureavoirfr_id'] = $id;
								$Lignefactureavoirfrs['depot_id'] = $this->request->getdata('depot_id');
								$Lignefactureavoirfrs['article_id'] = $f['article_id'];
								$Lignefactureavoirfrs['lignefacture_id'] = $f['id'];
								$Lignefactureavoirfrs['quantite'] = $f['quantite'];
								//$Lignefactureavoirfrs['qtea'] = $f['qtea'];
								$Lignefactureavoirfrs['remise'] = $f['remise'];
								$Lignefactureavoirfrs['tva_id'] = $f['tva_id'];
								$Lignefactureavoirfrs['prix'] = $f['prix'];
								$Lignefactureavoirfrs['fodec'] = $f['fodec'];
								$Lignefactureavoirfrs['totalht'] = $f['totalht'];
								$Lignefactureavoirfrs['totalttc'] = $f['totalttc'];
								$this->Lignefactureavoirfrs->save($Lignefactureavoirfrs);
							}
						}
					}
				}

				// if ($type == 1) {
				// 	return $this->redirect(['action' => 'index/1']);
				// } else if ($type == 2) {
				return $this->redirect(['action' => 'index']);
				//}
			}
		}


		$lignefactureavoirfrs = $this->Lignefactureavoirfrs->find('all', [])->where(['Lignefactureavoirfrs.factureavoirfr_id=' . $id]);

		$fournisseurs = $this->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

		//if ($type == 1) {
		$factures = $this->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
		//->where('Factures.typef = 1');
		// } else if ($type == 2) {
		// 	$factures = $this->Factures->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])->where('Factures.typef = 2');
		// }
		$tvas = $this->Tvas->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
		$articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designation']);
		$art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
		$depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
		$timbr = $this->Timbres->find('all', ['keyfield' => 'id', 'valueField' => 'timbre']);
		$tab1 = array();
		foreach ($timbr as $tab1); {
			// debug($tab1['timbre']);
		}
		$this->set(compact('tab1', 'factureavoirfrs', 'tvas', 'art', 'articles', 'lignefactureavoirfrs',  'fournisseurs',  'factures', 'depots'));
	}
	public function addfactureavoir($idfc = null)
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
		$this->loadModel('Factures');
		$model = 'Factures';
		$ligne_model = 'Lignefactures';
		$attr = 'facture_id';
		$factureavoirfrs = $this->Factureavoirfrs->newEmptyEntity();
		$facture = $this->fetchTable('Factures')->get($idfc);
		if ($this->request->is(['post'])) {

			//debug($this->request->getdata());die;
			$data = $this->Factureavoirfrs->newEmptyEntity();


			$data['model'] = 'avoir';
			$data['date'] =  $this->request->getdata('date'); // date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getdata('date'))));
			$data['facture_id'] = $idfc;
			$data['typefacture_id'] = 1;
			//$data['type'] = $type;


			$codeobj = $this->Factureavoirfrs->find()->select(["numero" => 'MAX(Factureavoirfrs.numero)'])->first();
			$num = $codeobj->numero;

			if ($num != null) {
				$n = $num;
				$lastnum = $n;
				$numo = intval($lastnum) + 1;
				$cc = (string) $numo;
				$numero = str_pad($cc, 5, '0', STR_PAD_LEFT);
			} else {
				//Handle the case when $num is null (e.g., first time generating the number)
				$numero = "00001"; // Initial value
			}
			$this->set(compact('numero'));
			//$numspecial = "FACAV/" . $numero . "/" . date("Y");
			// $data['numeroconca'] = $mm;
			$data['numero'] = $numero;
			$data['fournisseur_id'] = $this->request->getdata('fournisseur_id');
			$depot = $data['depot_id'] = $this->request->getdata('depot_id');
			$data['remise'] = $this->request->getdata('remise');
			$data['fodec'] = $this->request->getdata('fodec');
			$data['totalht'] = $this->request->getdata('ht');
			$data['totalttc'] = $this->request->getdata('ttc');
			$data['tauxtva'] = $this->request->getdata('tva');

			if ($this->Factureavoirfrs->save($data)) {

				$id = $data->id;

				//debug($this->request->getdata('data'));die;
				if (isset($this->request->getdata('data')['Lignefacture'])) {
					foreach ($this->request->getdata('data')['Lignefacture'] as $numl => $f) {
						//debug($this->request->getdata());die;
						if (!empty($f['article_id']) && !empty($f['quantite'])) {
							//debug($f);
							if ($f['quantite'] != 0) {
								$Lignefactureavoirfrs = $this->Lignefactureavoirfrs->newEmptyEntity();
								$Lignefactureavoirfrs['factureavoirfr_id'] = $id;
								$Lignefactureavoirfrs['depot_id'] = $depot;
								$Lignefactureavoirfrs['article_id'] = $f['article_id'];
								$Lignefactureavoirfrs['lignefacture_id'] = $f['id'];
								$Lignefactureavoirfrs['quantite'] = $f['quantite'];
								$Lignefactureavoirfrs['qtea'] = $f['qtea'];
								$Lignefactureavoirfrs['remise'] = $f['remise'];
								$Lignefactureavoirfrs['tva'] = $f['tva_id'];
								$Lignefactureavoirfrs['unitearticle_id'] = $f['unitearticle_id'];
								$Lignefactureavoirfrs['prix'] = $f['prix'];
								$Lignefactureavoirfrs['fodec'] = $f['fodec'];
								$Lignefactureavoirfrs['totalht'] = $f['totalht'];
								$Lignefactureavoirfrs['totalttc'] = $f['totalttc'];

								$this->Lignefactureavoirfrs->save($Lignefactureavoirfrs);

								$somqte = 0;
								$somqte = (int)$f['quantite'] + (int)$f['somqte'];
								//debug($f);
								//	debug($somqte);
								//debug($f['qtea']);die;


								if ($somqte <= (int)$f['qtea']) {

									$test = 1;
								}

								if ($test != 1) {
									$facture->typefac = 1;

									$this->fetchTable('Factures')->save($facture);
								}
							}
						}
					} //die;
				}
				//if ($type == 1) {
				return $this->redirect(['action' => 'index']);
				//} else if ($type == 2) {
				//return $this->redirect(['action' => 'index/2']);
				//}
			}
		}

		// $codeobj = $this->Factureavoirfrs->find()->select(["numero" =>
		// 'MAX(Factureavoirfrs.numero)'])->first();
		// $num = $codeobj->numero;
		// if ($num != null) {
		// 	//debug($num);
		// 	$n = $num;
		// 	$lastnum = $n;
		// 	$numo = intval($lastnum) + 1;
		// 	$cc = (string)$numo;
		// 	$numero = str_pad($cc, 5, '0', STR_PAD_LEFT);
		// 	$numspecial = "FACAV/" . $numero . "/" . date("Y");

		// } else {
		// 	$numspecial = "FACAV/00001/" . date("Y");
		// 	//debug($numero);die;
		// }
		$codeobj = $this->Factureavoirfrs->find()->select(["numero" => 'MAX(Factureavoirfrs.numero)'])->first();
		$num = $codeobj->numero;

		if ($num != null) {
			$n = $num;
			$lastnum = $n;
			$numo = intval($lastnum) + 1;
			$cc = (string) $numo;
			$numero = str_pad($cc, 5, '0', STR_PAD_LEFT);
		} else {
			//Handle the case when $num is null (e.g., first time generating the number)
			$numero = "00001"; // Initial value
		}

		$numspecial = "FACAV/" . $numero . "/" . date("Y");
		$lignefactures = $this->$ligne_model->find('all', [])->where(['Lignefactures.facture_id=' . $idfc])->order(['Lignefactures.id' => 'ASC']);
		$facture = $this->Factures->find('all', ['contain' => 'Lignefactures'])->where(['Factures.id =' . $idfc]);
		$fac = $this->Factures->get($idfc, [
			'contain' => [],
		]);
		$facture = $facture->toArray();

		$dep = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
		//	if ($type == 1) {
		$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list');
		//} else if ($type == 2) {
		//$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list', array('conditions' => array('Fournisseurs.typelocalisation_id = 2')));
		//}
		$depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
		$art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
		$unitearticles = $this->fetchTable('Unitearticles')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
		$timbr = $this->Timbres->find('all', ['keyfield' => 'id', 'valueField' => 'timbre']);
		$tab1 = array();
		foreach ($timbr as $tab1); {
			// debug($tab1['timbre']);
		}
		$this->set(compact('tab1', 'fournisseurs', 'unitearticles', 'fac', 'factureavoirfrs', 'art',  'facture', 'lignefactures', 'numero', 'idfc', 'model', 'ligne_model', 'fournisseurs', 'depots'));
	}
	public function add2907()
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
		$this->loadModel('Factures');
		$model = 'Factures';
		$ligne_model = 'Lignefactures';
		$attr = 'facture_id';
		$factureavoirfrs = $this->Factureavoirfrs->newEmptyEntity();
		// $facture = $this->fetchTable('Factures')->get($idfc);
		if ($this->request->is(['post'])) {

			//debug($this->request->getdata());die;
			$data = $this->Factureavoirfrs->newEmptyEntity();


			$data['model'] = 'avoir';
			$data['date'] =  date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getdata('date'))));
			// $data['facture_id'] = $idfc;
			$data['typefacture_id'] = 1;
			//$data['type'] = $type;


			$codeobj = $this->Factureavoirfrs->find()->select(["numero" => 'MAX(Factureavoirfrs.numero)'])->first();
			$num = $codeobj->numero;

			if ($num != null) {
				$n = $num;
				$lastnum = $n;
				$numo = intval($lastnum) + 1;
				$cc = (string) $numo;
				$numero = str_pad($cc, 5, '0', STR_PAD_LEFT);
			} else {
				//Handle the case when $num is null (e.g., first time generating the number)
				$numero = "00001"; // Initial value
			}
			$this->set(compact('numero'));
			//$numspecial = "FACAV/" . $numero . "/" . date("Y");
			// $data['numeroconca'] = $mm;
			$data['numero'] = $numero;
			$data['fournisseur_id'] = $this->request->getdata('fournisseur_id');
			$depot = $data['depot_id'] = $this->request->getdata('depot_id');
			$data['remise'] = $this->request->getdata('remise');
			$data['fodec'] = $this->request->getdata('fodec');
			$data['totalht'] = $this->request->getdata('ht');
			$data['totalttc'] = $this->request->getdata('ttc');
			$data['tauxtva'] = $this->request->getdata('tva');

			if ($this->Factureavoirfrs->save($data)) {

				$id = $data->id;

				//debug($this->request->getdata('data'));die;
				if (isset($this->request->getdata('data')['Lignefacture'])) {
					foreach ($this->request->getdata('data')['Lignefacture'] as $numl => $f) {
						//debug($this->request->getdata());die;
						if (!empty($f['article_id']) && !empty($f['quantite'])) {
							//debug($f);
							if ($f['quantite'] != 0) {
								$Lignefactureavoirfrs = $this->Lignefactureavoirfrs->newEmptyEntity();
								$Lignefactureavoirfrs['factureavoirfr_id'] = $id;
								$Lignefactureavoirfrs['depot_id'] = $depot;
								$Lignefactureavoirfrs['article_id'] = $f['article_id'];
								$Lignefactureavoirfrs['lignefacture_id'] = $f['id'];
								$Lignefactureavoirfrs['quantite'] = $f['quantite'];
								$Lignefactureavoirfrs['qtea'] = $f['qtea'];
								$Lignefactureavoirfrs['remise'] = $f['remise'];
								$Lignefactureavoirfrs['tva_id'] = $f['tva'];
								$Lignefactureavoirfrs['unitearticle_id'] = $f['unitearticle_id'];
								$Lignefactureavoirfrs['prix'] = $f['prix'];
								$Lignefactureavoirfrs['fodec'] = $f['fodec'];
								$Lignefactureavoirfrs['totalht'] = $f['totalht'];
								$Lignefactureavoirfrs['totalttc'] = $f['totalttc'];

								$this->Lignefactureavoirfrs->save($Lignefactureavoirfrs);
							}
						}
					} //die;
				}
				//if ($type == 1) {
				return $this->redirect(['action' => 'index']);
				//} else if ($type == 2) {
				//return $this->redirect(['action' => 'index/2']);
				//}
			}
		}

		// $codeobj = $this->Factureavoirfrs->find()->select(["numero" =>
		// 'MAX(Factureavoirfrs.numero)'])->first();
		// $num = $codeobj->numero;
		// if ($num != null) {
		// 	//debug($num);
		// 	$n = $num;
		// 	$lastnum = $n;
		// 	$numo = intval($lastnum) + 1;
		// 	$cc = (string)$numo;
		// 	$numero = str_pad($cc, 5, '0', STR_PAD_LEFT);
		// 	$numspecial = "FACAV/" . $numero . "/" . date("Y");

		// } else {
		// 	$numspecial = "FACAV/00001/" . date("Y");
		// 	//debug($numero);die;
		// }
		$codeobj = $this->Factureavoirfrs->find()->select(["numero" => 'MAX(Factureavoirfrs.numero)'])->first();
		$num = $codeobj->numero;

		if ($num != null) {
			$n = $num;
			$lastnum = $n;
			$numo = intval($lastnum) + 1;
			$cc = (string) $numo;
			$numero = str_pad($cc, 5, '0', STR_PAD_LEFT);
		} else {
			//Handle the case when $num is null (e.g., first time generating the number)
			$numero = "00001"; // Initial value
		}

		$numspecial = "FACAV/" . $numero . "/" . date("Y");
		// $lignefactures = $this->$ligne_model->find('all', [])->where(['Lignefactures.facture_id=' . $idfc])->order(['Lignefactures.id' => 'ASC']);
		// $facture = $this->Factures->find('all', ['contain' => 'Lignefactures'])->where(['Factures.id =' . $idfc]);
		// $fac = $this->Factures->get($idfc, [
		// 	'contain' => [],
		// ]);
		// $facture = $facture->toArray();

		$dep = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
		//	if ($type == 1) {
		$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list');
		//} else if ($type == 2) {
		//$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('list', array('conditions' => array('Fournisseurs.typelocalisation_id = 2')));
		//}
		$depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
		$art = $this->Articles->find('all', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
		$unitearticles = $this->fetchTable('Unitearticles')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
		$timbr = $this->Timbres->find('all', ['keyfield' => 'id', 'valueField' => 'timbre']);
		$tab1 = array();
		foreach ($timbr as $tab1); {
			// debug($tab1['timbre']);
		}
		$this->set(compact('tab1', 'fournisseurs', 'unitearticles', 'factureavoirfrs', 'art', 'numero',  'model', 'ligne_model', 'fournisseurs', 'depots'));
	}

	public function add()
	{
		$session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'factureavoirfrs') {
                $fournisseur = $liens['ajout'];
            }
        }
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
		$factureavoirfr = $this->Factureavoirfrs->newEmptyEntity();
		if ($this->request->is(['post'])) {

			$num = $this->Factureavoirfrs->find()->select(["num" =>
			'MAX(Factureavoirfrs.numero)'])->first();
			// debug($num);
			if (!empty($num)) {
				$n = $num->num;
				// $int=intval($n);
				$in = intval($n) + 1;
				//debug($in);
				$numspecial = str_pad("$in", 5, "0", STR_PAD_LEFT);
			} else {
				$numspecial = "00001";
			}


			$data = $this->Factureavoirfrs->patchEntity($factureavoirfr, $this->request->getdata());
			//  debug($factureavoir);


			//   $data['factureclient_id'] = $facture->id;



			$fac_id = $data->id;


			$data['model'] = 'avoir';
			$data['date'] = $this->request->getdata('date'); //  date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getdata('date'))));
			// $data['facture_id'] = $idfc;
			$data['typefacture_id'] = 1;
			$data['numero'] = $numspecial;;
			$data['fournisseur_id'] = $this->request->getdata('fournisseur_id');
			$depot = $data['depot_id'] = $this->request->getdata('depot_id');
			$data['totalremise'] = $this->request->getdata('remise');
			$data['remise'] = $this->request->getdata('remise');

			$data['depot_id'] = $this->request->getdata('depot_id');
			$data['fodec'] = $this->request->getdata('fodec');
			$data['tauxtva'] = $this->request->getdata('tva');
			$data['totalttc'] = $this->request->getdata('totalttc');
			$data['totalht'] = $this->request->getdata('totalht');


			//  $data['factureclient_id'] = $facture->id;
			if ($this->Factureavoirfrs->save($data)) {






				if (isset($this->request->getData('data')['Lignefacture']) && (!empty($this->request->getData('data')['Lignefacture']))) {
					foreach ($this->request->getData('data')['Lignefacture'] as $i => $f) {

						$lignef = $this->fetchTable('Lignefactureavoirfrs')->newEmptyEntity();
						if (!empty($f['article_id'])) {
							$Lignefac['factureavoirfr_id'] = $data->id;
							$Lignefac['article_id'] = $f['article_id'];
							// $Lignefac['lignefacture_id'] = $f['id'];

							$Lignefac['quantite'] = $f['qte'];
							// $Lignefac['qtekg'] = $f['qtekg'];
							// $Lignefac['qte'] = $f['qte'];
							// $Lignefac['qterlx'] = $f['qterlx'];
							$Lignefac['remise'] = $f['remise'];
							$Lignefac['tva'] = $f['tva'];
							$Lignefac['prix'] = $f['prix'];
							$Lignefac['fodec'] = $f['fodec'];
							$Lignefac['totalht'] = $f['ht'];
							$Lignefac['totalttc'] = $f['ttc'];
							// $Lignefac['unitearticle_id'] = $f['unitearticle_id'];
							$Lignefac['depot_id'] = $depot;



							$lignef = $this->fetchTable('Lignefactureavoirfrs')->patchEntity($lignef, $Lignefac);
							$this->fetchTable('Lignefactureavoirfrs')->save($lignef);

							// debug($lignef);
						}
					}
				}
				return $this->redirect(['action' => 'index']);
			}
		}

		$this->loadModel('Lignefactureclients');
		$this->loadModel('Commercials');
		$this->loadModel('Depots');
		$this->loadModel('Articles');
		$this->loadModel('Tvas');
		$this->loadModel('Fodecs');

		///debug($factureclient)  ;
		//$lignefactures = $this->fetchTable('Lignefactureclients')->find('all', [])->where(['Lignefactureclients.factureclient_id=' . $id]);
		//  debug($lignefactures->toarray());
		$num = $this->Factureavoirfrs->find()->select(["num" =>
		'MAX(Factureavoirfrs.numero)'])->first();
		// debug($num);
		$n = $num->num;
		// $int=intval($n);
		$in = intval($n) + 1;
		//debug($in);
		$numspecial = str_pad("$in", 5, "0", STR_PAD_LEFT);

		$art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
		$articles = $this->fetchTable('Articles')->find('all')
			->where(['Articles.typearticle_id =' => 1]);
		$commercials = $this->Commercials->find('all');


		$fournisseurs = $this->Factureavoirfrs->Fournisseurs->find('all');
		$typefactures = $this->fetchTable('Typefactures')->find('list', ['limit' => 200]);
		$depots = $this->fetchTable('Depots')->find('all')->where(['Depots.id=7']);

		$tvas = $this->Tvas->find('all');
		$fodecs = $this->Fodecs->find('all');

		$tv = $this->Tvas->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
		$fod = $this->Fodecs->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);







		$this->set(compact('factureavoirfr', 'fournisseurs', 'art', 'depots', 'numspecial', 'fournisseurs', 'articles'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Factureavoirfr id.
	 * @return \Cake\Http\Response|null|void Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{

		$session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'factureavoirfrs') {
                $fournisseur = $liens['supp'];
            }
        }
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
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
			// if ($type == 1) {
			// 	$this->redirect(array('action' => 'index/1'));
			// } else if ($type == 2) {
			$this->redirect(array('action' => 'index'));
			//}
		}
	}

	public function getfacture($id = null)
	{
		$id = $this->request->getQuery('id');
		$query = $this->fetchTable('Factures')->find();
		$query->where(['fournisseur_id' => $id]);
		$select = "
        <select name='import' id='facture' class='form-control select2'  '>
                    <option >Veuillez choisir !!</option>";
		foreach ($query as $q) {
			$select =  $select . "  <option value ='" . $q['id'] . "'";
			$select =  $select . " >" . $q['numero'] . "</option>";
		}
		$select = $select . "</select> </div> </div> ";
		echo json_encode(array('select' => $select));
		die;
	}



	public function rectype()
	{

		// if ($this->request->is('ajax')) {
		// $fournisseurId = $_GET['fournisseurId'];
		$fournisseurId = $this->request->getQuery('fournisseurId');
		//debug($fournisseurId);die;
		$this->loadModel('Typefournisseurs');


		$Fournisseur = $this->fetchTable('Fournisseurs')
			->find()
			->select(['id', 'name', 'typefournisseur_id'])
			->where(['id' => $fournisseurId])
			->first();

		if ($Fournisseur) {
			$this->set('typeFournisseurId', $Fournisseur->typefournisseur_id);
		} else {
			$this->set('typeFournisseurId', null);
		}

		$this->viewBuilder()->setOption('serialize', ['typeFournisseurId']);
	}
	// public function chargerArticles()
	// {
	//     $this->autoRender = false; // Empêche le rendu de la vue

	//     $typeFournisseurId = $this->request->getQuery('typeFournisseurId');
	//     $articles = [];

	//     if ($typeFournisseurId === '4') {
	//         $articles = $this->fetchTable('Articles')->find()
	//             ->select(['id', 'Code', 'Dsignation'])
	//             ->where(['typearticle_id' => 1])
	//             ->toArray();
	//     } elseif ($typeFournisseurId === '5') {
	//         $articles = $this->fetchTable('Articles')->find()
	//             ->select(['id', 'Code', 'Dsignation'])
	//             ->where(['typearticle_id' => 2])
	//             ->toArray();
	//     }
	//   //debug($articles);
	//     $this->response = $this->response->withType('json');
	//     $this->response = $this->response->withStringBody(json_encode(['articles' => $articles]));
	//     return $this->response;
	// }
}

<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Utilisateurs Controller
 *
 * @property \App\Model\Table\UtilisateursTable $Utilisateurs
 * @method \App\Model\Entity\Utilisateur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UtilisateursController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Utilisateurs->find('all')->order(["Utilisateurs.id" => 'desc']);
        $this->paginate = [
            'contain' => ['Personnels', 'Pointdeventes', 'Depots'],
        ];
        $utilisateurs = $this->paginate($query);
        $this->set(compact('utilisateurs'));
    }

    /**
     * View method
     *
     * @param string|null $id Utilisateur id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $utilisateur = $this->Utilisateurs->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Utilisateurmenus');
        $this->loadModel('Liens');
        $utilisateurmenus = $this->fetchTable('Utilisateurmenus')->find('all', [
            'contain' => ['Utilisateurs', 'Menus', 'Liens']
        ])
            ->where(['utilisateur_id' => $id]);
        //  debug($utilisateurmenus);
        foreach ($utilisateurmenus  as $menu) {
            // debug($menu);die;

            $liens = $this->fetchTable('Liens')->find('all', [
                'contain' => []
            ])
                ->where(['utilisateurmenu_id' => $menu->id]);

            foreach ($liens as $l) {
                // debug($l);die;
                $matrice[$menu->menu->name][$l->lien]['add'] = $l->ajout;
                $matrice[$menu->menu->name][$l->lien]['edit'] = $l->modif;
                $matrice[$menu->menu->name][$l->lien]['delete'] = $l->supp;
                $matrice[$menu->menu->name][$l->lien]['imprimer'] = $l->imprimer;
                $matrice[$menu->menu->name][$l->lien]['valide'] = $l->valide;
            }
        }
        //debug($matrice);die;
        $utilisateur = $this->Utilisateurs->patchEntity($utilisateur, $this->request->getData());
        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData('acces'));die;
            $utilisateur = $this->Utilisateurs->patchEntity($utilisateur, $this->request->getData());
            if ($this->Utilisateurs->save($utilisateur)) {
                $utilisateur_id = ($this->Utilisateurs->save($utilisateur)->id);
                //$this->misejour("Utilisateurs", "add", $utilisateur_id);

                //$this->Utilisateurs->getInsertId(); 
                $utilisateur_id = ($this->Utilisateurs->save($utilisateur)->id);

                if (isset($this->request->getData()['acces']) && !empty($this->request->getData()['acces'])) {

                    foreach ($this->request->getData()['acces'] as $ligne) {
                        // debug($ligne);
                        $data = $this->fetchTable('Utilisateurmenus')->newEmptyEntity();
                        $data->menu_id = $ligne;
                        $data->utilisateur_id = $utilisateur_id;
                        $idutili = ($this->fetchTable('Utilisateurmenus')->save($data)->id);
                        // $utilisateurmenu = $this->Utilisateurmenus->patchEntity($data, $data);
                        $idutili = ($this->fetchTable('Utilisateurmenus')->save($data)->id);
                        //  debug($idutili);die;
                        // debug($this->request->getData()['data'][$ligne]['Lien']);
                        // die;
                        if (isset($this->request->getData()['data'][$ligne]['Lien']) && !empty($this->request->getData()['data'][$ligne]['Lien'])) {
                            foreach ($this->request->getData()['data'][$ligne]['Lien'] as $lig) {

                                // debug($lig);die;
                                if ((!empty($lig['add'])) || (!empty($lig['edit'])) || (!empty($lig['delete'])) || (!empty($lig['valide']))  || (!empty($lig['imprimer']))) {
                                    //  debug($data->id);die;
                                    //$ligt = $this->fetchTable('Liens')->newEmptyEntity();
                                    if (!empty($lig['add'])) {
                                        $d['ajout'] = $lig['add'];
                                    } else {
                                        $d['ajout'] = 0;
                                    }
                                    if (!empty($lig['edit'])) {
                                        $d['modif'] = $lig['edit'];
                                    } else {
                                        $d['modif'] = 0;
                                    }
                                    if (!empty($lig['delete'])) {
                                        $d['supp'] = $lig['delete'];
                                    } else {
                                        $d['supp'] = 0;
                                    }
                                    if (!empty($lig['imprimer'])) {
                                        $d['imprimer'] = $lig['imprimer'];
                                    } else {
                                        $d['imprimer'] = 0;
                                    }
                                    if (!empty($lig['valide'])) {
                                        $d['valide'] = $lig['valide'];
                                    } else {
                                        $d['valide'] = 0;
                                    }
                                    $lien = $this->fetchTable('Liens')->newEmptyEntity();
                                    $d['utilisateurmenu_id'] = $data->id;
                                    // debug($lig);
                                    // die;
                                    $d['lien'] = $lig['lien'];
                                    // $d['ajout'] = $lig['add'];
                                    //  $d['modif'] = $lig['edit'];
                                    // $d['supp'] = $lig['delete'];
                                    // $d['imprimer'] = $lig['imprimer'];
                                    //debug($d);
                                    $lien = $this->fetchTable('Liens')->patchEntity($lien, $d);
                                    // debug($lien);
                                    //$this->loadModel('Liens');
                                    if ($this->fetchTable('Liens')->save($lien)) {
                                    } else {
                                    }
                                }
                            }
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->paginate = [
            'contain' => ['Lien', 'Utilisateurmenu'],
        ];


        $this->set(compact('matrice', 'utilisateur'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()

    {
//        $session = $this->request->getSession();
//        $abrv = $session->read('abrvv');
//        $liendd = $session->read('lien_parametrage' . $abrv);
//
//        //   debug($liendd);
//        $utilisateur = 0;
//        foreach ($liendd as $k => $liens) {
//            //  debug($liens);
//            if (@$liens['lien'] == 'utilisateurs') {
//                $utilisateur = $liens['ajout'];
//            }
//        }
//        //debug($utilisateur);die;
//        if (($utilisateur <> 1)) {
//            $this->redirect(array('controller' => 'users', 'action' => 'login'));
//        }


        $utilisateur = $this->Utilisateurs->newEmptyEntity();
        if ($this->request->is('post')) {
            //   debug($this->request->getData());die;
            $utilisateur = $this->Utilisateurs->patchEntity($utilisateur, $this->request->getData());
            if ($this->Utilisateurs->save($utilisateur)) {
                $utilisateur_id = ($this->Utilisateurs->save($utilisateur)->id);
                $this->misejour("Utilisateurs", "add", $utilisateur_id);

                //$this->Utilisateurs->getInsertId();
                $utilisateur_id = ($this->Utilisateurs->save($utilisateur)->id);
                if (isset($this->request->getData()['acces']) && !empty($this->request->getData()['acces'])) {
                    foreach ($this->request->getData()['acces'] as $ligne) {
                        // debug($ligne);
                        $data = $this->fetchTable('Utilisateurmenus')->newEmptyEntity();
                        $data->menu_id = $ligne;
                        $data->utilisateur_id = $utilisateur_id;
                        $idutili = ($this->fetchTable('Utilisateurmenus')->save($data)->id);
                        // $utilisateurmenu = $this->Utilisateurmenus->patchEntity($data, $data);
                        $idutili = ($this->fetchTable('Utilisateurmenus')->save($data)->id);
                        //  debug($idutili);die;
                        // debug($this->request->getData()['data'][$ligne]['Lien']);
                        // die;
                        if (isset($this->request->getData()['data'][$ligne]['Lien']) && !empty($this->request->getData()['data'][$ligne]['Lien'])) {
                            foreach ($this->request->getData()['data'][$ligne]['Lien'] as $lig) {
                                // debug($lig);die;
                                if ((!empty($lig['add'])) || (!empty($lig['edit'])) || (!empty($lig['delete'])) || (!empty($lig['valide']))  || (!empty($lig['imprimer']))) {
                                    //  debug($data->id);die;
                                    //$ligt = $this->fetchTable('Liens')->newEmptyEntity();
                                    if (!empty($lig['add'])) {
                                        $d['ajout'] = $lig['add'];
                                    } else {
                                        $d['ajout'] = 0;
                                    }
                                    if (!empty($lig['edit'])) {
                                        $d['modif'] = $lig['edit'];
                                    } else {
                                        $d['modif'] = 0;
                                    }
                                    if (!empty($lig['delete'])) {
                                        $d['supp'] = $lig['delete'];
                                    } else {
                                        $d['supp'] = 0;
                                    }
                                    if (!empty($lig['imprimer'])) {
                                        $d['imprimer'] = $lig['imprimer'];
                                    } else {
                                        $d['imprimer'] = 0;
                                    }
                                    if (!empty($lig['valide'])) {
                                        $d['valide'] = $lig['valide'];
                                    } else {
                                        $d['valide'] = 0;
                                    }
                                    $lien = $this->fetchTable('Liens')->newEmptyEntity();
                                    $d['utilisateurmenu_id'] = $data->id;
                                    $d['lien'] = $lig['lien'];
                                    //debug($d);
                                    $lien = $this->fetchTable('Liens')->patchEntity($lien, $d);
                                    // debug($lien);
                                    if ($this->fetchTable('Liens')->save($lien)) {
                                    } else {
                                    }
                                }
                            }
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->paginate = [
            'contain' => ['Lien', 'Utilisateurmenu'],
        ];
        $personnels = $this->Utilisateurs->Personnels->find('list', ['limit' => 200]);
        $pointdeventes = $this->Utilisateurs->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Utilisateurs->Depots->find('list', ['limit' => 200]);
        $this->set(compact('utilisateur', 'personnels', 'pointdeventes', 'depots'));
    }



    /**
     * Edit method
     *
     * @param string|null $id Utilisateur id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $utilisateur = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'utilisateurs') {
                $utilisateur = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($utilisateur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        // }
        $utilisateur = $this->Utilisateurs->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Utilisateurmenus');
        $this->loadModel('Liens');
        $utilisateurmenus = $this->fetchTable('Utilisateurmenus')->find('all', [
            'contain' => ['Utilisateurs', 'Menus', 'Liens']
        ])
            ->where(['utilisateur_id' => $id]);
        //  debug($utilisateurmenus);
        foreach ($utilisateurmenus  as $menu) {
            // debug($menu);die;

            $liens = $this->fetchTable('Liens')->find('all', [
                'contain' => []
            ])
                ->where(['utilisateurmenu_id' => $menu->id]);

            foreach ($liens as $l) {
                // debug($l);die;
                $matrice[$menu->menu->name][$l->lien]['add'] = $l->ajout;
                $matrice[$menu->menu->name][$l->lien]['edit'] = $l->modif;
                $matrice[$menu->menu->name][$l->lien]['delete'] = $l->supp;
                $matrice[$menu->menu->name][$l->lien]['imprimer'] = $l->imprimer;
                $matrice[$menu->menu->name][$l->lien]['valide'] = $l->valide;
            }
        }
        // debug($tab);die;
        $utilisateur = $this->Utilisateurs->patchEntity($utilisateur, $this->request->getData());
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData());die;
            $utilisateur = $this->Utilisateurs->patchEntity($utilisateur, $this->request->getData());
            if ($this->Utilisateurs->save($utilisateur)) {
                $utilisateur_id = ($this->Utilisateurs->save($utilisateur)->id);
                $this->misejour("Utilisateurs", "edit", $utilisateur_id);

                //$this->Utilisateurs->getInsertId(); 
                $utilisateur_id = ($this->Utilisateurs->save($utilisateur)->id);

                if (isset($this->request->getData()['acces']) && !empty($this->request->getData()['acces'])) {

                    foreach ($this->request->getData()['acces'] as $ligne) {
                        // debug($ligne);
                        $data = $this->fetchTable('Utilisateurmenus')->newEmptyEntity();
                        $data->menu_id = $ligne;
                        $data->utilisateur_id = $utilisateur_id;
                        $idutili = ($this->fetchTable('Utilisateurmenus')->save($data)->id);
                        // $utilisateurmenu = $this->Utilisateurmenus->patchEntity($data, $data);
                        $idutili = ($this->fetchTable('Utilisateurmenus')->save($data)->id);
                        //  debug($idutili);die;
                        // debug($this->request->getData()['data'][$ligne]['Lien']);
                        // die;
                        if (isset($this->request->getData()['data'][$ligne]['Lien']) && !empty($this->request->getData()['data'][$ligne]['Lien'])) {
                            foreach ($this->request->getData()['data'][$ligne]['Lien'] as $lig) {

                                // debug($lig);die;
                                if ((!empty($lig['add'])) || (!empty($lig['edit'])) || (!empty($lig['delete'])) || (!empty($lig['valide']))  || (!empty($lig['imprimer']))) {
                                    //  debug($data->id);die;
                                    //$ligt = $this->fetchTable('Liens')->newEmptyEntity();
                                    if (!empty($lig['add'])) {
                                        $d['ajout'] = $lig['add'];
                                    } else {
                                        $d['ajout'] = 0;
                                    }
                                    if (!empty($lig['edit'])) {
                                        $d['modif'] = $lig['edit'];
                                    } else {
                                        $d['modif'] = 0;
                                    }
                                    if (!empty($lig['delete'])) {
                                        $d['supp'] = $lig['delete'];
                                    } else {
                                        $d['supp'] = 0;
                                    }
                                    if (!empty($lig['imprimer'])) {
                                        $d['imprimer'] = $lig['imprimer'];
                                    } else {
                                        $d['imprimer'] = 0;
                                    }
                                    if (!empty($lig['valide'])) {
                                        $d['valide'] = $lig['valide'];
                                    } else {
                                        $d['valide'] = 0;
                                    }
                                    $lien = $this->fetchTable('Liens')->newEmptyEntity();
                                    $d['utilisateurmenu_id'] = $data->id;
                                    // debug($lig);
                                    // die;
                                    $d['lien'] = $lig['lien'];

                                    //debug($d);
                                    $lien = $this->fetchTable('Liens')->patchEntity($lien, $d);
                                    // debug($lien);

                                    if ($this->fetchTable('Liens')->save($lien)) {
                                    } else {
                                    }
                                }
                            }
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->paginate = [
            'contain' => ['Lien', 'Utilisateurmenu'],
        ];


        $this->set(compact('matrice', 'utilisateur'));
    }




    /**
     * Delete method
     *
     * @param string|null $id Utilisateur id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $utilisateur = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'utilisateurs') {
                $utilisateur = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($utilisateur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $utilisateur = $this->Utilisateurs->get($id);
        if ($this->Utilisateurs->delete($utilisateur)) {

            $utilisateur_id = ($this->Utilisateurs->save($utilisateur)->id);
            $this->misejour("Utilisateurs", "delete", $utilisateur_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

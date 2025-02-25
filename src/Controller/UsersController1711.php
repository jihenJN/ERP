<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function getlogin()
    {
        if ($this->request->is('ajax')) {
            $idlogin = $_GET['login'];
            //debug($idlogin);die;
            $ligne = $this->fetchTable('Users')->find('all')
                ->where(["Users.login  ='" . $idlogin . "'"]);
          
                foreach($ligne as $li){
                   // debug($li);die; 
                    $log=$li['login'];
                }
             
                $test=0;
                if($log!=''){
                    $test=1;
                }
               // debug($test);die;
            echo json_encode(array("ligne"=>$test, "success" => true));
            exit;
        }
        die;
    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configurez l'action de connexion pour ne pas exiger d'authentification,
        // أ©vitant ainsi le problأ¨me de la boucle de redirection infinie
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
        // $this->Authentication->addUnauthenticatedActions(['login']);
    }
    public function logout()
    {
        $result = $this->Authentication->getResult();
        // Qu'on soit en POST ou en GET, rediriger l'utilisateur s'il est d�j� connect�
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function login($origin = null)
    {
        $this->loadModel('Accueils');
        $this->loadModel('Users');
        $this->loadModel('Personnels');
        $this->loadModel('Societes');
        $this->loadModel('Liens');
        $this->loadModel('Menus');
        $this->loadModel('Utilisateurmenus');
        $acc = $this->Accueils->find('all', ['keyfield' => 'id', 'valueField' => 'name']);

        foreach ($acc as $ac) {

            $abrv = $ac['name'];
        }
        // $abrv = $acc['Accueil']['name'];
        $session = $this->request->getSession();

        $session->delete('lien_achat' . $abrv);
        $session->delete('lien_stock' . $abrv);
        $session->delete('lien_parametrage' . $abrv);
        $session->delete('lien_vente' . $abrv);
        $session->delete('lien_finance' . $abrv);
        $session->delete('lien_park' . $abrv);
        $session->delete('lien_pointage' . $abrv);
        $session->delete('lien_certificat' . $abrv);
        $session->delete('lien_stat' . $abrv);
        $session->delete('pointdevente' . $abrv);
        $session->delete('depot' . $abrv);
        $session->delete('users' . $abrv);
        $session->delete('fonct_id' . $abrv);
        $session->delete('stat' . $abrv);
        $session->delete('achat' . $abrv);
        $session->delete('stock' . $abrv);
        $session->delete('parametrage' . $abrv);
        $session->delete('vente' . $abrv);
        $session->delete('finance' . $abrv);
        $session->delete('park' . $abrv);
        $session->delete('pointage' . $abrv);
        $session->delete('certificat' . $abrv);
        $session->delete('modifpmp' . $abrv);
        $session->delete('stocknegatif' . $abrv);
        $session->delete('lien_compta' . $abrv);
        $session->delete('compta' . $abrv);
        $session->delete('MajNumero' . $abrv);
        $session->delete('notifdevis' . $abrv);
        $session->delete('notifbsstock' . $abrv);
        $session->delete('notifaffaire' . $abrv);
        $session->delete('notifvisite' . $abrv);
        $session->delete('notifartdevis' . $abrv);
        $session->delete('notifcaisse' . $abrv);
        $session->delete('notifcommandeclient' . $abrv);
        $session->delete('base' . $abrv);
        $this->layout = null;


        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        //debug($result);die;
        if ($result && $result->isValid()) {
            $identity = $this->Authentication->getIdentity();
            $user = $identity->getOriginalData();
            $session = $this->request->getSession();
            $session->write('user', $user->personnel_id);
            $session->write('poste', $user->poste);


            $us = $user['utilisateur_id'];
            $id = $user['id'];
            $this->loadModel('Utilisateurs');
           // debug($us);//die;
            $utilisateurr = $this->Utilisateurs->find('all', array('recursive' => 0, 'conditions' => array("Utilisateurs.id ='" . $us . "' ")));
    //   debug($utilisateurr);//die;
            foreach ($utilisateurr as $utilisateur) {
               // debug($utilisateur);//die;

                if ($utilisateur != array()) {
                    $session = $this->request->getSession();

                    //$session->write('base', $this->webroot);
                    $idutili = $utilisateur['id']; //debug($id); die;
                    $session->write('trans_vers_prod' . $abrv, $utilisateur['trans_vers_prod']);
                    $session->write('imp_val_inventaire' . $abrv, $utilisateur['imp_val_inventaire']);
                    $session->write('imp_val_bonecart' . $abrv, $utilisateur['imp_val_bonecart']);
                    $session->write('modifpmp' . $abrv, $utilisateur['modifpmp']);
                    $session->write('stocknegatif' . $abrv, $utilisateur['stocknegatif']);
                    $session->write('MajNumero' . $abrv, $utilisateur['MajNumero']);
                    $session->write('users' . $abrv, $idutili);
                    //$session->write('pointdevente' . $abrv, $poindevente);
                    $session->write('notifdevis' . $abrv, $utilisateur['notifdevis']);
                    $session->write('notifbsstock' . $abrv, $utilisateur['notifbsstock']);
                    $session->write('notifaffaire' . $abrv, $utilisateur['notifaffaire']);
                    $session->write('notifvisite' . $abrv, $utilisateur['notifvisite']);
                    $session->write('notifartdevis' . $abrv, $utilisateur['notifartdevis']);
                    $session->write('notifcaisse' . $abrv, $utilisateur['notifcaisse']);
                    $session->write('notifcommandeclient' . $abrv, $utilisateur['notifcommandeclient']);
                    $session->write('abrvv', $abrv);
                    //debug($utilisateur); die;
                    $this->loadModel('Utilisateurmenus');

                    $utilisateurmenu = $this->Utilisateurmenus->find('all')->where(["Utilisateurmenus.utilisateur_id=" . $idutili . " "]);
                    $var = '';
                 //   debug($utilisateurmenu);die;
                    foreach ($utilisateurmenu as $utili) {
                      // debug($utili);//die;
                        $idu = $utili['id'];
                       //    debug($idu);
                      
                     
                         //debug($pan); //die;
                        if ($utili['menu_id'] == 1) {
                              $menu1 = $this->Liens->find('all')->where(["Liens.utilisateurmenu_id=" . $idu . " "]);
                   
                               foreach ($menu1    as $m => $menu) {
                            $pan[$m] = $menu;
                        }
                            $var = 'stock' . $abrv;
                            $session->write('stock' . $abrv, 'stk');
                            $session->write('stock' . $abrv, 'stk');
                            $session->write('lien_stock' . $abrv, $pan);
                            //debug($pan);die;
                        }

                        if ($utili['menu_id'] == 2) {
                              $menu12 = $this->Liens->find('all')->where(["Liens.utilisateurmenu_id=" . $idu . " "]);
                       //debug($menu11);die;
                               foreach ($menu12    as $m => $menu) {
                            $pan2[$m] = $menu;
                        }
                        //  debug($pan1);die;
                            $var = 'parametrage' . $abrv;
                            $session->write('parametrage' . $abrv, 'par');
                            $session->write('parametrage' . $abrv, 'par');
                            $session->write('lien_parametrage' . $abrv, $pan2);
                          
                        }

//                        if ($utili['menu_id'] == 3) {
//                               $menu13 = $this->Liens->find('all')->where(["Liens.utilisateurmenu_id=" . $idu . " "]);
//                       
//                                foreach ($menu13    as $m => $menu) {
//                             $pan3[$m] = $menu;
//                        }
//                            $var = 'achat' . $abrv;
//                            $session->write('achat' . $abrv, 'ach');
//                            $session->write('achat' . $abrv, 'ach');
//                             $session->write('lien_achat' . $abrv, $pan3);
//                         }

                        if ($utili['menu_id'] == 4) {
                              $menu14 = $this->Liens->find('all')->where(["Liens.utilisateurmenu_id=" . $idu . " "]);
                    
                               foreach ($menu14    as $m => $menu) {
                            $pan4[$m] = $menu;
                        }
                            $var = 'lien_vente' . $abrv;
                            $session->write('vente' . $abrv, 'vnt');
                            $session->write('vente' . $abrv, 'vnt');
                            $session->write('lien_vente' . $abrv, $pan4);
                        }
                       
                        
                    }
                    $session->write('defaultmenu', $var);
                    if ($origin == 1) {
                    } else {
                        // debug($session);die();
                        $this->redirect(array('controller' => 'accueils', 'action' => 'index'));
                    }
               } 
//                else {
//                    $session->delete('lien_achat' . $abrv);
//                    $session->delete('lien_stock' . $abrv);
//                    $session->delete('lien_parametrage' . $abrv);
//                    $session->delete('lien_vente' . $abrv);
//                    $session->delete('lien_finance' . $abrv);
//                    $session->delete('lien_park' . $abrv);
//                    $session->delete('lien_certificat' . $abrv);
//
//                    $session->delete('lien_stat' . $abrv);
//                    $session->delete('lien_compta' . $abrv);
//                    $session->delete('compta' . $abrv);
//                    $session->delete('pointdevente' . $abrv);
//                    $session->delete('depot' . $abrv);
//                    $session->delete('users' . $abrv);
//                    $session->delete('fonct_id' . $abrv);
//                    $session->delete('stat' . $abrv);
//                    $session->delete('achat' . $abrv);
//                    $session->delete('stock' . $abrv);
//                    $session->delete('parametrage' . $abrv);
//                    $session->delete('vente' . $abrv);
//                    $session->delete('finance' . $abrv);
//                    $session->delete('park' . $abrv);
//                    $session->delete('certificat' . $abrv);
//                    $session->delete('pointage' . $abrv);
//
//                    $session->delete('modifpmp' . $abrv);
//                    $session->delete('stocknegatif' . $abrv);
//                    $session->delete('MajNumero' . $abrv);
//
//                    $session->delete('notifdevis' . $abrv);
//                    $session->delete('notifbsstock' . $abrv);
//                    $session->delete('notifaffaire' . $abrv);
//                    $session->delete('notifvisite' . $abrv);
//                    $session->delete('notifartdevis' . $abrv);
//                    $session->delete('notifcaisse' . $abrv);
//                    $session->delete('notifcommandeclient' . $abrv);
//                }
            }

            // rediriger vers /= aprأ¨s la connexion rأ©ussie
            $redirect = $this->request->getQuery('redirect', [
                'controller' => '/',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }


        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Votre identifiant ou votre mot de passe est incorrect.'));
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $utilisateur_id = $this->request->getQuery('utilisateur_id');
        $personnel_id = $this->request->getQuery('personnel_id');

        $cond1 = '';
        $cond2 = '';

        if ($utilisateur_id) {
            $cond1 = "Users.utilisateur_id like  '%" . $utilisateur_id . "%' ";
        }
        if ($personnel_id) {
            $cond2 = "Users.personnel_id like  '%" . $personnel_id . "%' ";
        }

        $query = $this->Users->find('all')->where([$cond1, $cond2]);

        $this->paginate = [
            'contain' => ['Personnels', 'Utilisateurs'],
        ];

        $users = $this->paginate($this->Users);
        $personnels = $this->Users->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $utilisateurs = $this->Users->Utilisateurs->find('list', ['limit' => 200]);
        $this->set(compact('users', 'personnels', 'utilisateurs'));








        $personnel_id = $this->request->getQuery('personnel_id');
        $utilisateur_id = $this->request->getQuery('utilisateur_id');

        $cond1 = '';
        $cond2 = '';

        if ($personnel_id) {
            $cond1 = "Users.personnel_id like  '%" . $personnel_id . "%' ";
        }
        if ($utilisateur_id) {
            $cond2 = "Users.utilisateur_id   like  '%" . $utilisateur_id . "%' ";
        }

        $query = $this->Users->find('all')->where([$cond1, $cond2])->order(["Users.id" => 'desc']);
        $users = $this->paginate($query);
        $personnels = $this->Users->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $utilisateurs = $this->Users->Utilisateurs->find('list', ['limit' => 200]);
        $this->paginate = [
            'contain' => ['Personnels', 'Utilisateurs'],
        ];
        $this->set(compact('users', 'personnels', 'utilisateurs'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Personnels', 'Utilisateurs', 'Pointdeventes', 'Depots'],
        ]);

        $this->set(compact('user'));
        $personnels = $this->Users->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $utilisateurs = $this->Users->Utilisateurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Users->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Users->Depots->find('list', ['limit' => 200]);
        $this->set(compact('user', 'personnels', 'utilisateurs', 'pointdeventes', 'depots'));
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
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $user = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'users') {
                $user = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($user <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {

            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $user_id = ($this->Users->save($user)->id);
                $this->misejour("Users", "add", $user_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $personnels = $this->Users->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $utilisateurs = $this->Users->Utilisateurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Users->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Users->Depots->find('list', ['limit' => 200]);
        $this->set(compact('user', 'personnels', 'utilisateurs', 'pointdeventes', 'depots'));
    }


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
//        $session = $this->request->getSession();
//        $abrv = $session->read('abrvv');
//        $liendd = $session->read('lien_parametrage' . $abrv);
//
//        //   debug($liendd);
//        $user = 0;
//        foreach ($liendd as $k => $liens) {
//            //  debug($liens);
//            if (@$liens['lien'] == 'users') {
//                $user = $liens['modif'];
//            }
//        }
//        // debug($societe);die;
//        if (($user <> 1)) {
//            $this->redirect(array('controller' => 'users', 'action' => 'login'));
//        }

        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //              debug($this->request->getData());
            //             die;
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $user_id = ($this->Users->save($user)->id);
                $this->misejour("Users", "edit", $user_id);

                return $this->redirect(['action' => 'index']);
            }
        }
        $personnels = $this->Users->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $utilisateurs = $this->Users->Utilisateurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Users->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Users->Depots->find('list', ['limit' => 200]);
        $this->set(compact('user', 'personnels', 'utilisateurs', 'pointdeventes', 'depots'));
    }


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $user = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'users') {
                $user = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($user <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $user_id = ($this->Users->save($user)->id);
            $this->misejour("Users", "delete", $user_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}

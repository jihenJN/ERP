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
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configurez l'action de connexion pour ne pas exiger d'authentification,
        // Ã©vitant ainsi le problÃ¨me de la boucle de redirection infinie
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
        // $this->Authentication->addUnauthenticatedActions(['login']);
    }
    
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        
        if ($result->isValid()) {
            // rediriger vers /= aprÃ¨s la connexion rÃ©ussie
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
    public function logout()
{
    $result = $this->Authentication->getResult();
    // Qu'on soit en POST ou en GET, rediriger l'utilisateur s'il est déjà connecté
    if ($result->isValid()) {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
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
        
        $query = $this->Users->find('all')->where([$cond1, $cond2]);
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
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            // debug($this->request->getData());
            // die;
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $user_id = ($this->Users->save($user)->id);
                $this->misejour("Users", "add", $user_id);
                $this->Flash->success(__('The {0} has been saved.', 'User'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User'));
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
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $user_id = ($this->Users->save($user)->id);
                $this->misejour("Users", "edit", $user_id);
                $this->Flash->success(__('The {0} has been saved.', 'User'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User'));
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
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $user_id = ($this->Users->save($user)->id);
                $this->misejour("Users", "delete", $user_id);
            $this->Flash->success(__('The {0} has been deleted.', 'User'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'User'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
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
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        $cond8 = '';
        $cond9 = '';

        $designation = $this->request->getQuery('designation');
        $famille_id = $this->request->getQuery('famille_id');
        $reference = $this->request->getQuery('reference');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $codeabarre = $this->request->getQuery('codeabarre');
        $etat = $this->request->getQuery('etat');
        $codeabarre = $this->request->getQuery('codeabarre');
        $codefrs = $this->request->getQuery('codefrs');
        $unite_id = $this->request->getQuery('unite_id');



        if ($designation) {
            $cond1 = "Articles.designiation =  '" . $designation . "' ";
        }
        if ($famille_id) {
            $cond3 = "Articles.famille_id  =  '" .     $famille_id . "' ";
        }


        if ($reference) {
            $cond4 = "Articles.reference  = '" . $reference . "' ";
        }


        if ($pointdevente_id) {
            $cond2 = "Articles.pointdevente_id =  '" .  $pointdevente_id . "' ";
        }
        if ($codeabarre) {
            $cond5 = "Articles.codeabarre   =  '" . $codeabarre . "' ";
        }
        if ($etat) {
            $cond6 = "Articles.etat   =  '" . $etat . "' ";
        }
        if ($codeabarre) {
            $cond7 = "Articles.codeabarre   =  '" . $codeabarre . "' ";
        }
        if ($codefrs) {
            $cond8 = "Articles.codefrs   =  '" . $codefrs . "' ";
        }
        if ($unite_id) {
            $cond9 = "Articles.unite_id   =  '" . $unite_id . "' ";
        }



        $query = $this->Articles->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $cond9]);
        $this->paginate = [
            'contain' => ['Pointdeventes', 'Familles', 'Categories', 'Sousfamille1s', 'Sousfamille2s', 'Sousfamille3s', 'Unites'],
        ];
        $depots = $this->paginate($query);
        $articles = $this->paginate($query);
        $pointdeventes = $this->Articles->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $familles = $this->Articles->Familles->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $categories = $this->Articles->Categories->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $unites = $this->Articles->Unites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);



        $this->set(compact('articles', 'pointdeventes', 'familles', 'categories', 'unites'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Pointdeventes', 'Familles', 'Categories', 'Sousfamille1s', 'Sousfamille2s', 'Sousfamille3s', 'Unites', 'Articlefournisseurs', 'Articleunites', 'Bandeconsultations', 'Fourchettes', 'Lignebandeconsultations', 'Lignebonchargements', 'Lignebondereservations', 'Lignebondetransferts', 'Lignebonlivraisons', 'Lignebonreceptionstocks', 'Lignebonsortiestocks', 'Lignecommandeclients', 'Lignecommandes', 'Lignedemandeoffredeprixes', 'Lignefactureclients', 'Lignefactures', 'Ligneinventaires', 'Lignelivraisons'],
        ]);
        $pointdeventes = $this->Articles->Pointdeventes->find('list', ['limit' => 200]);
        $familles = $this->Articles->Familles->find('list', ['limit' => 200]);
        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $sousfamille1s = $this->Articles->Sousfamille1s->find('list', ['limit' => 200]);
        $sousfamille2s = $this->Articles->Sousfamille2s->find('list', ['limit' => 200]);
        $sousfamille3s = $this->Articles->Sousfamille3s->find('list', ['limit' => 200]);
        $unites = $this->Articles->Unites->find('list', ['limit' => 200]);
        $this->set(compact('article', 'pointdeventes', 'familles', 'categories', 'sousfamille1s', 'sousfamille2s', 'sousfamille3s', 'unites'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            debug($this->request->getData());
            die;
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The {0} has been saved.', 'Article'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Article'));
        }





        $num = $this->Articles->find()->select(["codeArticle" =>
        'MAX(Articles.codeabarre)'])->first();
        
        $numero = ($num->codeArticle)+1;
      //  debug($numero);
       
   
        $pointdeventes = $this->Articles->Pointdeventes->find('list', ['limit' => 200]);
        $familles = $this->Articles->Familles->find('list', ['limit' => 200]);
        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $sousfamille1s = $this->Articles->Sousfamille1s->find('list', ['limit' => 200]);
        $sousfamille2s = $this->Articles->Sousfamille2s->find('list', ['limit' => 200]);
        $sousfamille3s = $this->Articles->Sousfamille3s->find('list', ['limit' => 200]);
        $unites = $this->Articles->Unites->find('list', ['limit' => 200]);
        $this->set(compact('article','numero','pointdeventes', 'familles', 'categories', 'sousfamille1s', 'sousfamille2s', 'sousfamille3s', 'unites'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The {0} has been saved.', 'Article'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Article'));
        }
        $pointdeventes = $this->Articles->Pointdeventes->find('list', ['limit' => 200]);
        $familles = $this->Articles->Familles->find('list', ['limit' => 200]);
        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $sousfamille1s = $this->Articles->Sousfamille1s->find('list', ['limit' => 200]);
        $sousfamille2s = $this->Articles->Sousfamille2s->find('list', ['limit' => 200]);
        $sousfamille3s = $this->Articles->Sousfamille3s->find('list', ['limit' => 200]);
        $unites = $this->Articles->Unites->find('list', ['limit' => 200]);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('article', 'fournisseurs', 'pointdeventes', 'familles', 'categories', 'sousfamille1s', 'sousfamille2s', 'sousfamille3s', 'unites'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Article'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Article'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

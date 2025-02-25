<?php

declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
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
    
    public function getquantite()
    {
        if ($this->request->is('ajax')) {
            $articleid = $_GET['idarticle'];
            $depotid = $_GET['idadepot'];
            $date = date("Y-m-d H:i:s");
            $connection = ConnectionManager::get('default');
            $inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
            $qtestock = $inventaires[0]['v'];
             $ligne = $this->fetchTable('Articles')->get($articleid,[
                'contain' => ['Tvas'],
            ]);
          // debug($ligne);
            echo json_encode(array("qtestockx" => $qtestock, "ligne" => $ligne, "success" => true));
//            echo json_encode(array("qtestockx" => $qtestock,  "success" => true));
            exit;
        }
        $this->loadModel('Articles');
        die;
    }
public function index()
    {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $Code = $this->request->getQuery('Code');
        $Dsignation = $this->request->getQuery('Dsignation');
        // debug($Dsignation);
        $famille_id = $this->request->getQuery('famille_id');
        //  debug($famille_id);
        if ($Code) {
         //   $cond1 = "Articles.Code like %'" . $Code . "' ";
             $cond1 = 'Articles.code like'  ."'%" . $Code ."%'"  ;
        }
        if ($Dsignation) {
            $cond2 = 'Articles.Dsignation like'  ."'%" . $Dsignation ."%'"  ;
        }
        if ($famille_id) {
            $cond3 = "Articles.famille_id  =  '" . $famille_id . "' ";
            /// $cond3 = "Articles.famille_id '%" . $famille_id . "%' ";
        }
        $query = $this->Articles->find('all')->where([$cond1, $cond2, $cond3]);
        //debug($query);
        $this->paginate = [
            'contain' => ['Familles', 'Tvas'],
        ];
        $articles = $this->paginate($query);
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'Taux']);
        $this->set(compact('articles', 'familles', 'tvas'));
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
      
      /*  if($this->request->is('ajax'))
        {
            $article = $this->Articles->get($id);
            $date=date("Y-m-d H:i:s");
            $connection = ConnectionManager::get('default');
            $inventaires = $connection->execute("select stockbassem(".$id.",'".$date."','0',".$_GET['depot_id'].") as v")->fetchAll('assoc');
            $qtestock= $inventaires[0]['v'];
            echo json_encode(array("qtestock"=>$qtestock,'article'=>$article,"success"=>true));   
            exit;  
        }*/
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
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Article ajouté avec succès'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Veuillez réessayer!!!'));
        }
        $familles = $this->Articles->Familles->find('list', ['limit' => 200])->all();
        $sousfamille1s = $this->Articles->Sousfamille1s->find('list', ['limit' => 200])->all();
        $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'familles', 'sousfamille1s', 'tvas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData());
            //  die;
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Modification effectuée'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Veuillez réessayer!!!'));
        }
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'Taux']);
        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'familles', 'sousfamille1s', 'tvas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('Veuillez réessayer!!!'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getsousfamille1($id = null)
    {
        $id = $this->request->getQuery('idfam');

        // debug($id);
        // die;


        // var_dump( $t['article_id']);
        // $prix = $ligne->prix->achat;
        //$this->set(compact('prix'));




        $query = $this->fetchTable('Sousfamille1s')->find();
        $query->where(['famille_id' => $id]);
        // debug($query);
        $select = "

        <label class='control-label' for='sousfamille1-id'>Sousfamille1</label>
        <select name='sous' id='sous' class='form-control select2'  onchange='getsousfamille2(this.value)'>
					<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
          //  debug($q); 
            $select =  $select . "	<option value ='" . $q['id'] . "'";
            $select =  $select . " >" . $q['name'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select = $select . "</select> </div> </div> ";
 
        echo json_encode(array('select' => $select));
die;
        //$this->set(compact('query'));





        /* foreach ($query as $q) { 
            json_encode($q);
            debug($q);
        }
     */
    }
      public function getArticle($id=null)
    {
 
            $article = $this->Articles->get($id);
            $date=date("Y-m-d H:i:s");
            $connection = ConnectionManager::get('default');
            $inventaires = $connection->execute("select stockbassem(".$id.",'".$date."','0',".$_GET['depot_id'].") as v")->fetchAll('assoc');
            $qtestock= $inventaires[0]['v'];
            echo json_encode(array("qtestock"=>$qtestock,'article'=>$article,"success"=>true));  
            exit; 
        
    }
      public function getAllArticles()
    {
        $articles = $this->Articles->find('all');
        echo json_encode(array("data"=>$articles,"success"=>true));   
        exit;  
    }
}

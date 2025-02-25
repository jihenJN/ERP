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


        $Code = $this->request->getQuery('Code');
        $Dsignation = $this->request->getQuery('Dsignation');
        // debug($Dsignation);
        $famille_id = $this->request->getQuery('famille_id');
        //  debug($famille_id);




        if ($Code) {
            $cond1 = "Articles.Code like  '%" . $Code . "%' ";
        }
        if ($Dsignation) {
            $cond2 = "Articles.Dsignation  =  '" .     $Dsignation . "' ";
        }


        if ($famille_id) {
            $cond3 = "Articles.famille_id  =  '" . $famille_id . "' ";

            /// $cond3 = "Articles.famille_id '%" . $famille_id . "%' ";
        }

        $query = $this->Articles->find('all')->where([$cond1, $cond2, $cond3]);
        //debug($query);

        $this->paginate = [
            'contain' => ['Familles', 'Tvas'], 'order' => ['id' => 'ASC']
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
        $article = $this->Articles->get($id, [
            'contain' => ['Familles', 'Sousfamille1s', 'Tvas', 'Articlefournisseurs', 'Articleunites', 'Bandeconsultations', 'Fourchettes', 'Lignebandeconsultations', 'Lignebonchargements', 'Lignebondereservations', 'Lignebondetransferts', 'Lignebonlivraisons', 'Lignebonreceptionstocks', 'Lignebonsortiestocks', 'Lignecommandeclients', 'Lignecommandes', 'Lignedemandeoffredeprixes', 'Lignefactureclients', 'Lignefactures', 'Ligneinventaires', 'Lignelivraisons'],
        ]);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'Taux']);
        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);




        $this->set(compact('article', 'tvas', 'sousfamille1s', 'familles', 'typearticles'));
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
            //  debug($this->request->getData());
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $image = $this->request->getData('image_file');
            //  debug($image);die;
            $name = $image->getClientFilename();
            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
                mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775);*/

            // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;

            if (!empty($name)) {
                $image->moveTo($targetPath);
                $article->image = $name;
            }








            if ($this->Articles->save($article)) {
                $this->misejour("Articles", "add", $article->id);
                //   debug($article);




                return $this->redirect(['action' => 'index']);
            }
        }
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'Taux']);
        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'familles', 'sousfamille1s', 'tvas', 'typearticles'));
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
            // debug($this->request->getData());
            //  die;
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            // debug($article);

            $image = $this->request->getData('image_file');
            //  debug($image);die;
            $name = $image->getClientFilename();
            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
                mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775);*/

            // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;

            if (!empty($name)) {
                $image->moveTo($targetPath);
                $article->image = $name;
            }
            //$article->image=$name;

            // if ($article_id=($this->Articles->save($article)->id)){
            if ($this->Articles->save($article)) {
                $this->misejour("Articles", "edit", $id);

                //  $this->Flash->success(__('Modification effectuée'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('Veuillez réessayer!!!'));
        }
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'Taux']);
        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'familles', 'sousfamille1s', 'tvas', 'typearticles'));
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
            $this->misejour("Articles", "delete", $id);
        } else {
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
        <select name='sousfamille1_id' id='sous' class='form-control select2'  onchange='getsousfamille2(this.value)'>
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
}

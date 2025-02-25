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
class ArticlesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {

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
            $cond2 = "Articles.Dsignation  =  '" . $Dsignation . "' ";
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
    public function view($id = null) {
        $article = $this->Articles->get($id, [
            'contain' => ['Familles', 'Sousfamille1s', 'Tvas', 'Articlefournisseurs', 'Articleunites', 'Bandeconsultations', 'Fourchettes', 'Lignebandeconsultations', 'Lignebonchargements', 'Lignebondereservations', 'Lignebondetransferts', 'Lignebonlivraisons', 'Lignebonreceptionstocks', 'Lignebonsortiestocks', 'Lignecommandeclients', 'Lignecommandes', 'Lignedemandeoffredeprixes', 'Lignefactureclients', 'Lignefactures', 'Ligneinventaires', 'Lignelivraisons'],
        ]);
        $tpes = $this->fetchTable('Tpes')->find()->select(["tpes" =>
                    'MAX(Tpes.valeur)'])->first();
        $tpe = $tpes->tpes;


        $fodecs = $this->fetchTable('Fodecs')->find()->select(["fodecs" =>
                    'MAX(Fodecs.valeur)'])->first();
        $fodec = $fodecs->fodecs;

        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
                    'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;
        $codeart = substr($article->codeabarre, -4);

        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
                    'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;







        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);



        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille1s.famille_id = " . $article->famille_id . ""]);

        $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille2s.Sousfamille1_id = " . $article->sousfamille1_id . ""]);

        $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $val = $codepays . ' ' . $codeproducteur;

        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($val);


        $seuil = $this->fetchTable('Seuilmois')->find('all', [])
                ->where(["Seuilmois.article_id = " . $id . ""]);




        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $this->set(compact('sousfamille2s', 'unites', 'tpe', 'seuil', 'codeart', 'article', 'familles', 'sousfamille1s', 'typearticles', 'codepays', 'codeproducteur', 'val', 'tvas', 'fodec'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {



        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
                    'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;


        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
                    'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;





        $fodecs = $this->fetchTable('Fodecs')->find()->select(["fodecs" =>
                    'MAX(Fodecs.valeur)'])->first();
        $fodec = $fodecs->fodecs;



        $tpes = $this->fetchTable('Tpes')->find()->select(["tpes" =>
                    'MAX(Tpes.valeur)'])->first();
        $tpe = $tpes->tpes;


        /*
          $session = $this->request->getSession();
          $abrv = $session->read('abrvv');
          $liendd = $session->read('lien_parametrage' . $abrv);

          //   debug($liendd);
          $article = 0;
          foreach ($liendd as $k => $liens) {
          //  debug($liens);
          if (@$liens['lien'] == 'articles') {
          $societe = $liens['ajout'];
          }
          }
          // debug($societe);die;
          if (($article <> 1)) {
          $this->redirect(array('controller' => 'users', 'action' => 'login'));
          }
         */



        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            //  debug($this->request->getData());
            $codearticle = $this->request->getData('codearticle');
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $codefinale = $codepays . $codeproducteur . $codearticle;

            // debug($codefinale);
            $article->codeabarre = $codefinale;







            $image = $this->request->getData('image_file');
            //  debug($image);die;
            $name = $image->getClientFilename();
            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
              mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775); */

            // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;

            if (!empty($name)) {
                $image->moveTo($targetPath);
                $article->image = $name;
            }








            if ($this->Articles->save($article)) {
                $this->misejour("Articles", "add", $article->id);
                // debug($article);






                if (isset($this->request->getData('data')['seuil']) && (!empty($this->request->getData('data')['seuil']))) {
                    foreach ($this->request->getData('data')['seuil'] as $i => $b) {
                        //debug($adresseliv);
                        //die;




                        $seuil = $this->fetchTable('Seuilmois')->newEmptyEntity();
                        $data['mois'] = $i;
                        $data['min'] = $b['minimum'];
                        $data['max'] = $b['maximum'];
                        $data['alert'] = $b['alert'];
                        $data['article_id'] = $article->id;

                        $seuil = $this->fetchTable('Seuilmois')->patchEntity($seuil, $data);


                        $this->fetchTable('Seuilmois')->save($seuil);
                        //debug($seuil);
                    }
                }




                if (isset($this->request->getData('data')['objectifrep']) && (!empty($this->request->getData('data')['objectifrep']))) {
                    foreach ($this->request->getData('data')['objectifrep'] as $i => $c) {
                        //debug($adresseliv);
                        //die;




                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->newEmptyEntity();
                        // $data['mois'] = $i;
                        $dataobj['objectif'] = $c['objectif'];

                        $dataobj['commercial_id'] = $c['commercial'];
                        $dataobj['moi_id'] = $c['mois'];
                        $dataobj['article_id'] = $article->id;

                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);


                        $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                        //debug($seuil);
                    }
                }



















                return $this->redirect(['action' => 'index']);
            }
        }
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);

        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $unitearticles = $this->fetchTable('Unitearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $val = $codepays . ' ' . $codeproducteur;
        //debug($val);
        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        
        $mois = $this->fetchTable('Mois')->find('all');
        $commercials = $this->fetchTable('Commercials')->find('all');

        $this->set(compact('commercials','mois','unitearticles', 'tpe', 'unites', 'article', 'familles', 'sousfamille1s', 'typearticles', 'codepays', 'codeproducteur', 'val', 'tvas', 'fodec'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {


        $tpes = $this->fetchTable('Tpes')->find()->select(["tpes" =>
                    'MAX(Tpes.valeur)'])->first();
        $tpe = $tpes->tpes;



        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
                    'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;


        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
                    'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;





        $fodecs = $this->fetchTable('Fodecs')->find()->select(["fodecs" =>
                    'MAX(Fodecs.valeur)'])->first();
        $fodec = $fodecs->fodecs;
        $article = $this->Articles->get($id, [
            'contain' => ['Tvas'],
        ]);



        $codeart = substr($article->codeabarre, -4);
        // debug($article->codeabarre);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());
            //  die;
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            // debug($article);
            $codearticle = $this->request->getData('codearticle');
            // debug($codearticle);



            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $codefinale = $codepays . $codeproducteur . $codearticle;

            //  debug($codefinale);
            $article->codeabarre = $codefinale;

            $image = $this->request->getData('image_file');
            //  debug($image);die;
            $name = $image->getClientFilename();
            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
              mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775); */

            // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;

            if (!empty($name)) {
                $image->moveTo($targetPath);
                $article->image = $name;
            }
            //$article->image=$name;
            // if ($article_id=($this->Articles->save($article)->id)){
            if ($this->Articles->save($article)) {
                //    debug($article);
                $this->misejour("Articles", "edit", $id);





                $seuilss = $this->fetchTable('Seuilmois')->find('all', [])
                        ->where(["Seuilmois.article_id = " . $id . ""]);

                foreach ($seuilss as $ss) {
                    $this->fetchTable('Seuilmois')->delete($ss);
                }



                if (isset($this->request->getData('data')['seuil']) && (!empty($this->request->getData('data')['seuil']))) {
                    foreach ($this->request->getData('data')['seuil'] as $i => $b) {
                        //debug($adresseliv);
                        //die;

                        $seuil = $this->fetchTable('Seuilmois')->newEmptyEntity();
                        $data['mois'] = $i;
                        $data['min'] = $b['minimum'];
                        $data['max'] = $b['maximum'];
                        $data['alert'] = $b['alert'];
                        $data['article_id'] = $article->id;

                        $seuil = $this->fetchTable('Seuilmois')->patchEntity($seuil, $data);


                        $this->fetchTable('Seuilmois')->save($seuil);
                        //debug($seuil);
                    }
                }

                //  $this->Flash->success(__('Modification effectuée'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('Veuillez réessayer!!!'));
        }
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);



        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille1s.famille_id = " . $article->famille_id . ""]);

        $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille2s.Sousfamille1_id = " . $article->sousfamille1_id . ""]);

        $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $val = $codepays . ' ' . $codeproducteur;

        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($val);


        $seuil = $this->fetchTable('Seuilmois')->find('all', [])
                ->where(["Seuilmois.article_id = " . $id . ""]);




        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $this->set(compact('sousfamille2s', 'unites', 'tpe', 'seuil', 'codeart', 'article', 'familles', 'sousfamille1s', 'typearticles', 'codepays', 'codeproducteur', 'val', 'tvas', 'fodec'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {



        /*  $session = $this->request->getSession();
          $abrv = $session->read('abrvv');
          $liendd = $session->read('lien_parametrage' . $abrv);

          //   debug($liendd);
          $article = 0;
          foreach ($liendd as $k => $liens) {
          //  debug($liens);
          if (@$liens['lien'] == 'articles') {
          $societe = $liens['supp'];
          }
          }
          // debug($societe);die;
          if (($article <> 1)) {
          $this->redirect(array('controller' => 'users', 'action' => 'login'));
          }
         */

        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->misejour("Articles", "delete", $id);
        } else {
            
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getsousfamille1($id = null) {
        $id = $this->request->getQuery('idfam');

        // debug($id);
        // die;
        // var_dump( $t['article_id']);
        // $prix = $ligne->prix->achat;
        //$this->set(compact('prix'));


        $select1 = "

        <label class='control-label' for='sousfamille1-id'>Sousfamille1</label>
        <select name='sousfamille1_id' id='divsous' class='form-control select2' onchange='getsousfamille2(this.value)'   >
					<option value=''  selected='selected' disabled>Veuillez choisir</option> </select> </div> </div> ";
        $query = $this->fetchTable('Sousfamille1s')->find();
        $query->where(['famille_id' => $id]);
        // debug($query);
        $select = "

        <label class='control-label' for='sousfamille1-id'>Sousfamille1</label>
        <select name='sousfamille1_id' id='sous' class='form-control select2' onchange='getsousfamille2(this.value)'   >
					<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
            //  debug($q); 
            $select = $select . "	<option value ='" . $q['id'] . "'";
            $select = $select . " >" . $q['name'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select = $select . "</select> </div> </div> ";

        echo json_encode(array('select' => $select, 'select1' => $select1));
        die;
        //$this->set(compact('query'));





        /* foreach ($query as $q) { 
          json_encode($q);
          debug($q);
          }
         */
    }

    public function getquantite() {
        if ($this->request->is('ajax')) {
            $articleid = $_GET['idarticle'];
            $depotid = $_GET['idadepot'];
            $date = date("Y-m-d H:i:s");
            $connection = ConnectionManager::get('default');
            $inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');

            //debug($inventaires);

            $qtestock = $inventaires[0]['v'];




            $ligne = $this->fetchTable('Articles')->get($articleid, [
                'contain' => ['Tvas'],
            ]);
            // debug($ligne);




            echo json_encode(array("qtestockx" => $qtestock, "ligne" => $ligne, "success" => true));
            //echo (json_encode($ligne));
            exit;
        }
    }

    public function getvaleurtva() {
        if ($this->request->is('ajax')) {
            $articleid = $_GET['idfam'];







            $l = $this->fetchTable('Tvas')->get($articleid);
            $ligne = $l->valeur;




            echo json_encode(array("ligne" => $ligne, "success" => true));
            //echo (json_encode($ligne));
            exit;
        }
    }

    public function getsousf($id = null) {
        $id = $this->request->getQuery('idfam');

        // debug($id);
        // die;
        // var_dump( $t['article_id']);
        // $prix = $ligne->prix->achat;
        //$this->set(compact('prix'));




        $query = $this->fetchTable('Sousfamille2s')->find();
        $query->where(['sousfamille1_id' => $id]);
        // debug($query);
        $select = "

        <label class='control-label' for='sousfamille1-id'>Sous sous famille  </label>
        <select name='sousfamille2_id' id='divsoussous' class='form-control select2 '>
					<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
            //  debug($q); 
            $select = $select . "	<option value ='" . $q['id'] . "'";
            $select = $select . " >" . $q['name'] . "</option>";
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

    public function verifcodearticle() {
        $id = $this->request->getQuery('idfam');



        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
                    'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;


        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
                    'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;


        $query = $this->fetchTable('Articles')->find();
        $query->where(['codeabarre' => $codepays . $codeproducteur . $id]);








        echo json_encode(array("codeexistant" => $query, "success" => true));
        //echo (json_encode($ligne));
        die;
    }

}

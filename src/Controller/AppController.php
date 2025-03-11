<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use App\Model\Entity\Gspromoarticle;
use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\Model\Datasource\CakeSession;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;


ini_set('memory_limit', '-1');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');

        $societesTable = TableRegistry::getTableLocator()->get('Societes');
        $societefirst = $societesTable->find()->where('id=1')->first();
        $this->set('societefirst', $societefirst); // Available in views
        $this->societefirst = $societefirst;
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    function misejour($model = null, $operation = null, $id = null, $idnv = null)
    {
        $this->loadModel('Accueils');
        $acc = $this->Accueils->find()->first();
        // $abrv=$acc['Accueil']['name'];
        $this->loadModel('Tracemisejours');
        $tab['model'] = $model;
        $tab['id_piece'] = $id;
        if (!in_array($operation, array("edit", "add"))) {
            $tab['numero'] = $operation;
            $operation = "delete";
        }
        $tab['operation'] = $operation;
        $tab['user_id'] = $this->request->getAttribute('identity')->id;

        $tab['date'] = date("Y-m-d");
        $tab['heure'] = date("H:i", time());
        $tab['poste'] = $_SERVER['REMOTE_ADDR'];
        //    $tab['id_piecenv']=$idnv;
        $tracemiseajour = $this->Tracemisejours->newEmptyEntity();
        $tracemiseajour = $this->Tracemisejours->patchEntity($tracemiseajour, $tab);
        //   dd($tracemiseajour);
        $this->Tracemisejours->save($tracemiseajour);
    }

    function prixspeciale($idclient = null, $idarticle = null)
    {


        $cond1 = "Clientarticles.article_id =" . $idarticle;
        //  debug($idarticle);

        $cond2 = "Clientarticles.client_id =" . $idclient;

        $query = $this->fetchTable('Clientarticles')->find('all')->where([$cond1, $cond2])->first();
        // debug($query);
        $ligneclient = $this->fetchTable('Clients')->get($idclient);
        // debug($ligneclient);die;
        //        debug($ligneclient->typeclient_id);
        if ($query == null && $ligneclient->typeclient_id != null) {


            $tarifs = $this->fetchTable('Tarifs')->find('all')->where(["Tarifs.typeclient_id =" . $ligneclient->typeclient_id])->first();

            if ($tarifs != null) {
                $cond11 = "Tarifclients.article_id =" . $idarticle;
                // debug($idarticle);

                $cond22 = "Tarifclients.tarif_id =" . $tarifs->id;

                $tarifclients = $this->fetchTable('Tarifclients')->find('all')->where([$cond11, $cond22])->first();
                // debug($tarifclients->prix);
                return ($tarifclients->prix);
            } else {
                $lignearticle = $this->fetchTable('Articles')->get($idarticle);
                return ($lignearticle->Prix_LastInput);
            }
            // debug($query);
        } else if ($query != null) {
            return ($query->prix);
        } else {
            $lignearticle = $this->fetchTable('Articles')->get($idarticle);
            return ($lignearticle->Prix_LastInput);
        }
    }
    // function promogs($date = null, $client_id = null, $article_id = null, $qte = null)
    // {

    //     $cond1 = "Gspromoarticles.datedebut <='" . $date . "' ";
    //     $cond2 = "Gspromoarticles.datefin >='" . $date . "' ";

    //     $gspromo = $this->fetchTable('Gspromoarticles')->find('all')->where([$cond1, $cond2])->first();
    //      ///debug($gspromo);
    //     if ($gspromo != null) {
    //         $cligspromo = $this->fetchTable('Clientgspromoarticles')->find('all')->where(["Clientgspromoarticles.gspromoarticle_id =" . $gspromo->id, "Clientgspromoarticles.checkk = 1", "Clientgspromoarticles.client_id = " . $client_id])->first();
    //       //  debug($cligspromo);
    //         if ($cligspromo != null) {
    //             $cond10 = "Lignegspromoarticles.article_id = " . $article_id;
    //             $lipromo = $this->fetchTable('Lignegspromoarticles')->find('all')->where(["Lignegspromoarticles.gspromoarticle_id =" . $gspromo->id, $cond10, "Lignegspromoarticles.qte <=" . $qte])->first();
    //             //debug($lipromo->value);
    //             return ($lipromo->value);
    //         } else {
    //             return (0);
    //         }
    //     } 
    //     else {
    //         return (0);
    //     }
    // }

    function promogs($date = null, $client_id = null, $article_id = null, $qte = null)
    {

        $cond1 = "Gspromoarticles.datedebut <='" . $date . "' ";
        $cond2 = "Gspromoarticles.datefin >='" . $date . "' ";
        $cond10 = "Lignegspromoarticles.article_id = " . $article_id;
        $cond11 = "Clientgspromoarticles.client_id = " . $client_id;
        $cond11cnd = "Clientgspromoarticles.checkk =1 ";

        $cli = $this->fetchtable('Clientgspromoarticles')->find('all')->where([$cond11, $cond11cnd])->group(['gspromoarticle_id']);
        // $n = $this->fetchtable('Clientgspromoarticles')->find('count')->where([$cond11,$cond11cnd])->group(['gspromoarticle_id']);
        ////  debug($cli->toarray());
        $tabb = $cli->toarray();

        /// debug($tabb);

        $li = $this->fetchtable('Lignegspromoarticles')->find('all')->where([$cond10])->group(['gspromoarticle_id']);
        // debug($li->toArray());//;die;
        // debug($cli->toArray());//;die;

        $list_id = "(0";
        if (!empty($tabb)) {
            if ($cli != array()) {
                foreach ($cli as $client) {

                    $list_id = $list_id . "," . $client['gspromoarticle_id'];
                }
            }

            if ($li != null) {
                if ($li != array()) {
                    foreach ($li as $ligne) {
                        $list_id = $list_id . "," . $ligne['gspromoarticle_id'];
                    }
                }
            }
            $list_id = $list_id . ",0)";

            // debug($list_id);//die;

            $condd = "Gspromoarticles.id in" . $list_id;


            // debug($condd);


            $gspromo = $this->fetchTable('Gspromoarticles')->find('all')->where([$cond1, $cond2, $condd]);
            // debug($gspromo->toArray());

            $variable = 0;

            if ($gspromo != null) {

                $resultat = 0;
                foreach ($gspromo as $i => $gs) {
                    $cligspromo = $this->fetchTable('Clientgspromoarticles')->find('all')->where(["Clientgspromoarticles.gspromoarticle_id =" . $gs['id'], "Clientgspromoarticles.checkk = 1", $cond11]);

                    // debug($cligspromo->toArray());

                    if ($cligspromo != null) {

                        $lipromo = $this->fetchTable('Lignegspromoarticles')->find('all')->where(["Lignegspromoarticles.gspromoarticle_id =" . $gs['id'], $cond10]);

                        // debug($lipromo->toArray());

                        if ($lipromo != null) {

                            foreach ($lipromo as $i => $l) {
                                $resultat = $l->value;
                                //  debug($resultat);
                                $variable = $resultat + $variable;
                                //debug($variable);

                            }


                            //return($variable); 
                        }
                    } else {
                        $variable = 0;
                    }
                } //debug($variable); 
                return ($variable);
            } else {
                return (0);
            }
        } else {

            return (0);
        }
    }









    function promonotgrandsurface($typeclient = null, $gouvernorat_id = null, $article_id = null, $date = null, $qte = null)
    {
        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
        $cond2 = "Promoarticles.datefin >='" . $date . "'";
        $cond3 = "Promoarticles.typeclient_id=" . $typeclient;
        $cond4 = "Natlignepromoarticles.article_id=" . $article_id;
        $cond5 = "Natlignepromoarticles.qte <=" . $qte;
        $cond6 = "Lignepromoarticles.min <=" . $qte;
        $cond7 = "Lignepromoarticles.max >=" . $qte;
        $cond8 = "Lignepromoarticles.article_id=" . $article_id;
        $cond9 = "Gouvpromoarticles.gouvernorat_id=" . $gouvernorat_id;
        $cond10 = "Gouvpromoarticles.toutgouv=1";
        $nat = $this->fetchtable('Natlignepromoarticles')->find('all')->where([$cond4])->group(['promoarticle_id']);
        $li = $this->fetchtable('Lignepromoarticles')->find('all')->where([$cond8])->group(['promoarticle_id']);

        //debug($nat);
        $list_id = "(0";
        if ($nat != null) {
            if ($nat != array()) {
                foreach ($nat as $natid) {
                    $list_id = $list_id . "," . $natid['promoarticle_id'];
                    // mb_eregi(",".$natid['promoarticle_id']."," ,$list_id)
                }
            }
        }
        if ($li != null) {
            if ($li != array()) {
                foreach ($li as $natid) {
                    $list_id = $list_id . "," . $natid['promoarticle_id'];
                    // mb_eregi(",".$natid['promoarticle_id']."," ,$list_id)
                }
            }
        }
        $list_id = $list_id . ",0)";

        //  debug($list_id);//die;
        $condd = "Promoarticles.id in " . $list_id;
        $type = $this->fetchtable('Promoarticles')->find('all')->where([$cond1, $cond2, $cond3, $condd])->first();
        // $type = $this->fetchtable('Promoarticles')->find('all')->where([$cond1, $cond2, $cond3])->first();
        //debug($type);die;
        if ($type != null) {
            //debug($type);die;
            if ($type['gouv'] == 0) {

                if ($type['type'] == 0) {
                    $tab = $this->fetchtable('Natlignepromoarticles')->find('all')->where([$cond4, $cond5, "Natlignepromoarticles.promoarticle_id =" . $type['id']])->order(["Natlignepromoarticles.qte" => 'DESC']);
                    //  debug($tab->toArray()) ;    

                    if ($tab != null) {
                        // debug($tab);
                        //$variable=[];
                        $resultat = 0;
                        foreach ($tab as $i => $v) {
                            //debug($v);
                            $val = (int)$v['qte'];
                            /// debug($val);
                            $value = (int)$v['value'];
                            //  debug($value);
                            $qte = (int)$qte;
                            // debug($qte);

                            $rest = (int)($qte / $val);
                            // debug($rest);

                            $qte = ($qte % $val);
                            // debug($qte);

                            $resultat = ($rest * $value) + $resultat;
                            // debug($resultat);
                            //$variable[$i]=$resultat;
                        }
                        // debug($variable);
                        return ($resultat);
                        // debug($resultat);

                    } else {
                        return 0;
                    }
                } else {
                    $tabb = $this->fetchtable('Lignepromoarticles')->find('all')->where([$cond6, $cond7, $cond8, "Lignepromoarticles.promoarticle_id =" . $type['id']])->first();

                    if ($tabb != null) {
                        // debug($tabb->value);
                        return ($tabb->value);
                    } else {
                        return 0;
                    }
                }
            } elseif ($type['gouv'] == 1) {
                $go = $this->fetchtable('Gouvpromoarticles')->find('all')->where([$cond9, $cond10, "Gouvpromoarticles.promoarticle_id =" . $type['id']])->first();
                if ($go != null) {
                    if ($type['type'] == 0) {
                        $tabs = $this->fetchtable('Natlignepromoarticles')->find('all')->where([$cond4, $cond5, "Natlignepromoarticles.promoarticle_id =" . $type['id']])->first();
                        if ($tabs != null) {
                            $resultat = 0;
                            foreach ($tabs as $i => $v) {
                                //debug($v);
                                $val = (int)$v['qte'];
                                $value = (int)$v['value'];
                                $qte = (int)$qte;
                                $rest = (int)($qte / $val);
                                $qte = ($qte % $val);
                                $resultat = ($rest * $value) + $resultat;
                            }

                            return ($resultat);
                        } else {
                            return 0;
                        }
                    } else {
                        $tabbs = $this->fetchtable('Lignepromoarticles')->find('all')->where([$cond6, $cond7, $cond8, "Lignepromoarticles.promoarticle_id =" . $type['id']])->first();
                        // debug($tabbs->value);
                        if ($tabbs != null) {
                            // debug($tabbs->value);
                            return ($tabbs->value);
                        } else {
                            return 0;
                        }
                    }
                } else {
                    return 0;
                }
            }
        } else {
            return 0;
        }
    }
    //    function promonotgrandsurface($typeclient = null, $gouvernorat_id = null, $article_id = null, $date = null, $qte = null)
    //    {
    ////        if($typeclient=='false'){
    ////            $typeclient=10;
    ////        }else{
    ////           $typeclient=1;  
    ////        }
    ////       debug($typeclient);
    ////        debug($gouvernorat_id);
    ////           debug($article_id);
    ////            debug($date);
    ////            debug($qte);
    //        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
    //        $cond2 = "Promoarticles.datefin >='" . $date . "'";
    //        $cond3 = "Promoarticles.typeclient_id=" . $typeclient;
    //        $cond4 = "Natlignepromoarticles.article_id=" . $article_id;
    //        $cond5 = "Natlignepromoarticles.qte <=" . $qte;
    //        $cond6 = "Lignepromoarticles.min <=" . $qte;
    //        $cond7 = "Lignepromoarticles.max >=" . $qte;
    //        $cond8 = "Lignepromoarticles.article_id=" . $article_id;
    //        $cond9 = "Gouvpromoarticles.gouvernorat_id=" . $gouvernorat_id;
    //        $cond10 = "Gouvpromoarticles.toutgouv=1";
    //       // debug($cond1);
    //        //  debug($cond2);
    //        //  debug($cond3);
    //        $type = $this->fetchtable('Promoarticles')->find('all')->where([$cond1, $cond2, $cond3])->first();
    //        // debug($type);die;
    //        // debug($type['gouv']);
    //        // debug($type['type']);
    //        if ($type != null) {
    //            //debug($type);die;
    //            if ($type['gouv'] == 0) {
    //
    //                if ($type['type'] == 0) {
    //                    $tab = $this->fetchtable('Natlignepromoarticles')->find('all')->where([$cond4, $cond5, "Natlignepromoarticles.promoarticle_id =" . $type['id']])->first();
    //                    if ($tab != null) {
    //                        return ($tab->value);
    //                    } else {
    //                        return 0;
    //                    }
    //                } else {
    //                    $tabb = $this->fetchtable('Lignepromoarticles')->find('all')->where([$cond6, $cond7, $cond8, "Lignepromoarticles.promoarticle_id =" . $type['id']])->first();
    //
    //                    if ($tabb != null) {
    //                        // debug($tabb->value);
    //                        return ($tabb->value);
    //                    } else {
    //                        return 0;
    //                    }
    //                }
    //            } elseif ($type['gouv'] == 1) {
    //                $go = $this->fetchtable('Gouvpromoarticles')->find('all')->where([$cond9, $cond10, "Gouvpromoarticles.promoarticle_id =" . $type['id']])->first();
    //                if ($go != null) {
    //                    if ($type['type'] == 0) {
    //                        $tabs = $this->fetchtable('Natlignepromoarticles')->find('all')->where([$cond4, $cond5, "Natlignepromoarticles.promoarticle_id =" . $type['id']])->first();
    //                        if ($tabs != null) {
    //
    //                            return ($tabs->value);
    //                        } else {
    //                            return 0;
    //                        }
    //                    } else {
    //                        $tabbs = $this->fetchtable('Lignepromoarticles')->find('all')->where([$cond6, $cond7, $cond8, "Lignepromoarticles.promoarticle_id =" . $type['id']])->first();
    //                        // debug($tabbs->value);
    //                        if ($tabbs != null) {
    //                            // debug($tabbs->value);
    //                            return ($tabbs->value);
    //                        } else {
    //                            return 0;
    //                        }
    //                    }
    //                } else {
    //                    return 0;
    //                }
    //            }
    //        } else {
    //            return 0;
    //        }
    //    }
    public function beforeRender(EventInterface $event)
    {
        $this->viewBuilder()->setTheme('AdminLTE');
    }


    public function getmax()
    {


        $connection = ConnectionManager::get('default');

        $m = $connection->execute('SELECT MAX(numero) as max
        FROM (
          SELECT numero FROM factureclients
          UNION ALL
          SELECT numero FROM factureavoirs
        ) combined_results; ')->fetchAll('assoc');

        $max = $m[0]['max'];

        return $max;

        echo ($max);
    }
}

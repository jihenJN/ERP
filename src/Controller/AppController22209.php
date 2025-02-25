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

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\Model\Datasource\CakeSession;
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
    public function beforeRender(EventInterface  $event)
    {
        $this->viewBuilder()->setTheme('AdminLTE');
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;

/**
 * Bonusmaluscommercials Controller
 *
 * @property \App\Model\Table\BonusmaluscommercialsTable $Bonusmaluscommercials
 * @method \App\Model\Entity\Bonusmaluscommercial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BonusmaluscommercialsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Commercials'],
        ];
        $bonusmaluscommercials = $this->paginate($this->Bonusmaluscommercials);

        $this->set(compact('bonusmaluscommercials'));
    }

    /**
     * View method
     *
     * @param string|null $id Bonusmaluscommercial id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $bonusmaluscommercial = $this->Bonusmaluscommercials->get($id);
        $commercials = $this->fetchTable('Commercials')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);



        $time = new FrozenTime($bonusmaluscommercial->datedebut);


        // debug($time->i18nFormat('MM'));


        $m = intval($time->i18nFormat('MM'));


        // debug($m);
        // $timee = new FrozenTime($bonusmaluscommercial->datefin);
        // $n = intval($timee->i18nFormat('MM'));
        // debug($time->i18nFormat('MM'));
        //  $m = intval($time->i18nFormat('MM'));




        $dmax = $this->fetchTable('Lignebonusmalus')->find()->select(["datemax" =>
                    'MAX(Lignebonusmalus.moi_id)'])->where(['Bonusmaluscommercial_id' => $id])->first();



        $condmois1 = "Mois.id <= '" . $dmax->datemax . "' ";
        $condmois2 = "Mois.id >= '" . $m . "' ";



        $mois = $this->fetchTable('Mois')->find('all')
                ->where([$condmois1, $condmois2]);





        $lignebonusmalus = $this->fetchTable('Lignebonusmalus')->find('all', [
                    'contain' => ['Articles']
                ])
                ->where(['Bonusmaluscommercial_id' => $id]);




        foreach ($lignebonusmalus as $a) {
            // debug($a);

            $tab[$a->article->Dsignation][$a->moi_id] = [
                'qteliv' => $a->qtelivre,
                'objectif' => $a->objectif,
                'ecart' => $a->ecart,
                'mon' => $a->montant,
                'article_id' => $a->article_id,
                'mois' => $a->moi_id,
            ];
        }
        //debug($tab);

        $this->set(compact('bonusmaluscommercial', 'commercials', 'lignebonusmalus', 'tab', 'mois'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_commercialmenus = $session->read('lien_commercialmenus' . $abrv);

        //   debug($liendd);
        $bonusmaluscommercial = 0;
        foreach ($lien_commercialmenus as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bonusmalus') {
                $bonusmaluscommercial = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($bonusmaluscommercial <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $bonusmaluscommercial = $this->Bonusmaluscommercials->newEmptyEntity();
        if ($this->request->is('post')) {
            $bonusmaluscommercial = $this->Bonusmaluscommercials->patchEntity($bonusmaluscommercial, $this->request->getData());
            if ($this->Bonusmaluscommercials->save($bonusmaluscommercial)) {

                $bonmal_id = ($this->Bonusmaluscommercials->save($bonusmaluscommercial)->id);
                $this->misejour("Bonusmaluscommercials", "add", $bonmal_id);
               // $this->Flash->success(__('The bonusmaluscommercial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The bonusmaluscommercial could not be saved. Please, try again.'));
        }
        $commercials = $this->Bonusmaluscommercials->Commercials->find('list', ['limit' => 200])->all();
        $this->set(compact('bonusmaluscommercial', 'commercials'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bonusmaluscommercial id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_commercialmenus = $session->read('lien_commercialmenus' . $abrv);

        //   debug($liendd);
        $bonusmaluscommercial = 0;
        foreach ($lien_commercialmenus as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bonusmalus') {
                $bonusmaluscommercial = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($bonusmaluscommercial <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $bonusmaluscommercial = $this->Bonusmaluscommercials->get($id, [
            'contain' => [],
        ]);
        // debug($bonusmaluscommercial);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bonusmaluscommercial = $this->Bonusmaluscommercials->patchEntity($bonusmaluscommercial, $this->request->getData());
            if ($this->Bonusmaluscommercials->save($bonusmaluscommercial)) {

                $bonmal_id = ($this->Bonusmaluscommercials->save($bonusmaluscommercial)->id);
                $this->misejour("Bonusmaluscommercials", "edit", $bonmal_id);
               // $this->Flash->success(__('The bonusmaluscommercial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
          //  $this->Flash->error(__('The bonusmaluscommercial could not be saved. Please, try again.'));
        }
        $commercials = $this->Bonusmaluscommercials->Commercials->find('list', ['limit' => 200])->all();
        $this->set(compact('bonusmaluscommercial', 'commercials'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bonusmaluscommercial id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_commercialmenus = $session->read('lien_commercialmenus' . $abrv);

        //   debug($liendd);
        $bonusmaluscommercial = 0;
        foreach ($lien_commercialmenus as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bonusmalus') {
                $bonusmaluscommercial = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($bonusmaluscommercial <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $this->request->allowMethod(['post', 'delete']);
        $bonusmaluscommercial = $this->Bonusmaluscommercials->get($id);


        //  lignebonusmalus


        $lignes = $this->fetchTable('Lignebonusmalus')->find('all', [])
                ->where(['bonusmaluscommercial_id' => $id]);
        foreach ($lignes as $l) {
            $this->fetchTable('Lignebonusmalus')->delete($l);
        }




        if ($this->Bonusmaluscommercials->delete($bonusmaluscommercial)) {

            $bonmal_id = ($this->Bonusmaluscommercials->save($bonusmaluscommercial)->id);
            $this->misejour("Bonusmaluscommercials", "delete", $bonmal_id);
          // $this->Flash->success(__('The bonusmaluscommercial has been deleted.'));
        } else {
          //  $this->Flash->error(__('The bonusmaluscommercial could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}

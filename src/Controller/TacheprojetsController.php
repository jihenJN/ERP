<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Tacheprojets Controller
 *
 * @property \App\Model\Table\TacheprojetsTable $Tacheprojets
 * @method \App\Model\Entity\Tacheprojet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TacheprojetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tachedesignations', 'Personnels'],
        ];
        $tacheprojets = $this->paginate($this->Tacheprojets);

        $this->set(compact('tacheprojets'));
    }

    /**
     * View method
     *
     * @param string|null $id Tacheprojet id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tacheprojet = $this->Tacheprojets->get($id, [
            'contain' => ['Tachedesignations', 'Personnels'],
        ]);

        $this->set(compact('tacheprojet'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($projet_id = null)
    {
        $num = $this->Tacheprojets->find()->select([
            "num" =>
            'MAX(Tacheprojets.num)'
        ])->first();
        $numero = $num->num;
        $projet = $this->fetchTable('Projets')->get($projet_id);
        if ($this->request->is('post')) {
            if (isset($this->request->getData('data')['tacheprojets']) && (!empty($this->request->getData('data')['tacheprojets']))) {
                $this->loadModel('Tacheprojets');
                foreach ($this->request->getData('data')['tacheprojets'] as $i => $tacheprojet) {
                    $data['num'] = $tacheprojet['num'];
                    $data['projet_id'] = $tacheprojet['projet_id'];
                    $data['tachedesignation_id'] = $tacheprojet['tachedesignation_id'];
                    $data['datedebut'] = $tacheprojet['datedebut'];
                    $data['datefin'] = $tacheprojet['datefin'];
                    $data['personnel_id'] = $tacheprojet['personnel_id'];
                    $tacheprojet = $this->fetchTable('Tacheprojets')->newEmptyEntity();
                    $tacheprojet = $this->Tacheprojets->patchEntity($tacheprojet, $data);
                    if ($this->Tacheprojets->save($tacheprojet)) {
                        $projet->etatTache = 1;
                        $projetData = $this->fetchTable('Projets')->patchEntity($projet, $projet->toArray());
                        $this->fetchTable('Projets')->save($projetData);
                    }
                }
            }
            return $this->redirect(['controller' => 'projets', 'action' => 'index']);
        }
        $tachedesignationall = $this->fetchTable('Tachedesignations')->find('all');
        $tachedesignations = $this->fetchTable('Tachedesignations')->find('list', ['keyfield' => 'id', 'valueField' => 'designation']);
        $personnels = $this->fetchTable('Personnels')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($personnel) {
                return $personnel->nom . ' (' . $personnel->prenom . ') ';
            }
        ]);
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'libelle']);
        $this->set(compact('tacheprojet', 'numero', 'projets', 'projet_id', 'tachedesignations', 'tachedesignationall', 'personnels'));
    }


    public function edit($projet_id = null)
    {
        $tacheprojetall = $this->fetchTable('Tacheprojets')->find('all')->where(['Tacheprojets.projet_id' => $projet_id]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (isset($this->request->getData('data')['tacheprojets']) && (!empty($this->request->getData('data')['tacheprojets']))) {
                $this->loadModel('Tacheprojets');
                foreach ($this->request->getData('data')['tacheprojets'] as $i => $tacheprojetData) {
                    $tacheprojetId = $tacheprojetData['id'];
                    $tacheprojet = $this->Tacheprojets->get($tacheprojetId);
                    $data['num'] = $tacheprojetData['num'];
                    $data['projet_id'] = $tacheprojetData['projet_id'];
                    $data['tachedesignation_id'] = $tacheprojetData['tachedesignation_id'];
                    $data['datedebut'] = $tacheprojetData['datedebut'];
                    $data['datefin'] = $tacheprojetData['datefin'];
                    $data['etat'] = $tacheprojetData['etat'];
                    $data['personnel_id'] = $tacheprojetData['personnel_id'];
                    $tacheprojet = $this->Tacheprojets->patchEntity($tacheprojet, $data);
                    $this->Tacheprojets->save($tacheprojet);
                }
            }
            return $this->redirect(['controller' => 'projets', 'action' => 'index']);
        }
        $tachedesignationall = $this->fetchTable('Tachedesignations')->find('all');
        $tachedesignations = $this->fetchTable('Tachedesignations')->find('list', ['keyfield' => 'id', 'valueField' => 'designation']);
        $personnels = $this->fetchTable('Personnels')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($personnel) {
                return $personnel->nom . ' (' . $personnel->prenom . ') ';
            }
        ]);
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'libelle']);
        $this->set(compact('numero', 'projets', 'tachedesignations', 'tachedesignationall', 'personnels',  'projet_id', 'tacheprojetall', 'tachedesignations'));
    }

    public function delete($projet_id = null)
    {

        $this->loadModel('Tacheprojets');
        $tacheprojetall = $this->fetchTable('Tacheprojets')->find('all')->where(['Tacheprojets.projet_id' => $projet_id]);
        foreach ($tacheprojetall as $ll) {
            $this->Tacheprojets->delete($ll);
        }
        $projet = $this->fetchTable('Projets')->get($projet_id);
        $projet->etatTache = 0;
        $projetData = $this->fetchTable('Projets')->patchEntity($projet, $projet->toArray());
        $this->fetchTable('Projets')->save($projetData);

        return $this->redirect(['controller' => 'projets', 'action' => 'index']);
    }
}

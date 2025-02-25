<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Piecereglements Controller
 *
 * @property \App\Model\Table\PiecereglementsTable $Piecereglements
 * @method \App\Model\Entity\Piecereglement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PiecereglementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Paiements', 'Reglements', 'Carnetcheques', 'Cheques', 'Comptes', 'Tos','Importations', 'Etatpiecereglements','Fournisseurs'],
        ];
        $piecereglements = $this->paginate($this->Piecereglements);

        $this->set(compact('piecereglements'));
    }

    /**
     * View method
     *
     * @param string|null $id Piecereglement id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $piecereglement = $this->Piecereglements->get($id, [
            'contain' => ['Paiements', 'Reglements', 'Carnetcheques', 'Cheques', 'Comptes', 'Tos', 'Societes', 'Importations', 'Etatpiecereglements', 'Traitecredits', 'Fournisseurs', 'Lignereglements'],
        ]);

        $this->set(compact('piecereglement'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $piecereglement = $this->Piecereglements->newEmptyEntity();
        if ($this->request->is('post')) {
            $piecereglement = $this->Piecereglements->patchEntity($piecereglement, $this->request->getData());
            if ($this->Piecereglements->save($piecereglement)) {
                $this->Flash->success(__('The piecereglement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The piecereglement could not be saved. Please, try again.'));
        }
        $paiements = $this->Piecereglements->Paiements->find('list', ['limit' => 200])->all();
        $reglements = $this->Piecereglements->Reglements->find('list', ['limit' => 200])->all();
        $carnetcheques = $this->Piecereglements->Carnetcheques->find('list', ['limit' => 200])->all();
        $cheques = $this->Piecereglements->Cheques->find('list', ['limit' => 200])->all();
        $comptes = $this->Piecereglements->Comptes->find('list', ['limit' => 200])->all();
        $tos = $this->Piecereglements->Tos->find('list', ['limit' => 200])->all();
        $societes = $this->Piecereglements->Societes->find('list', ['limit' => 200])->all();
        $importations = $this->Piecereglements->Importations->find('list', ['limit' => 200])->all();
        $etatpiecereglements = $this->Piecereglements->Etatpiecereglements->find('list', ['limit' => 200])->all();
        $traitecredits = $this->Piecereglements->Traitecredits->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Piecereglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $this->set(compact('piecereglement', 'paiements', 'reglements', 'carnetcheques', 'cheques', 'comptes', 'tos', 'societes', 'importations', 'etatpiecereglements', 'traitecredits', 'fournisseurs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Piecereglement id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $piecereglement = $this->Piecereglements->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $piecereglement = $this->Piecereglements->patchEntity($piecereglement, $this->request->getData());
            if ($this->Piecereglements->save($piecereglement)) {
                $this->Flash->success(__('The piecereglement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The piecereglement could not be saved. Please, try again.'));
        }
        $paiements = $this->Piecereglements->Paiements->find('list', ['limit' => 200])->all();
        $reglements = $this->Piecereglements->Reglements->find('list', ['limit' => 200])->all();
        $carnetcheques = $this->Piecereglements->Carnetcheques->find('list', ['limit' => 200])->all();
        $cheques = $this->Piecereglements->Cheques->find('list', ['limit' => 200])->all();
        $comptes = $this->Piecereglements->Comptes->find('list', ['limit' => 200])->all();
        $tos = $this->Piecereglements->Tos->find('list', ['limit' => 200])->all();
        $societes = $this->Piecereglements->Societes->find('list', ['limit' => 200])->all();
        $importations = $this->Piecereglements->Importations->find('list', ['limit' => 200])->all();
        $etatpiecereglements = $this->Piecereglements->Etatpiecereglements->find('list', ['limit' => 200])->all();
        $traitecredits = $this->Piecereglements->Traitecredits->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Piecereglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $this->set(compact('piecereglement', 'paiements', 'reglements', 'carnetcheques', 'cheques', 'comptes', 'tos', 'societes', 'importations', 'etatpiecereglements', 'traitecredits', 'fournisseurs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Piecereglement id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $piecereglement = $this->Piecereglements->get($id);
        if ($this->Piecereglements->delete($piecereglement)) {
            $this->Flash->success(__('The piecereglement has been deleted.'));
        } else {
            $this->Flash->error(__('The piecereglement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

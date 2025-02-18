<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Visites Controller
 *
 * @property \App\Model\Table\VisitesTable $Visites
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VisitesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients', 'Visiteurs', 'TypeContacts'],
        ];
        $visites = $this->paginate($this->Visites);

        $this->set(compact('visites'));
    }

    /**
     * View method
     *
     * @param string|null $id Visite id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $visite = $this->Visites->get($id, [
            'contain' => ['Clients', 'Visiteurs', 'TypeContacts'],
        ]);

        $this->set(compact('visite'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $visite = $this->Visites->newEmptyEntity();
        if ($this->request->is('post')) {
            $visite = $this->Visites->patchEntity($visite, $this->request->getData());
            if ($this->Visites->save($visite)) {
                $this->Flash->success(__('The visite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visite could not be saved. Please, try again.'));
        }
        $clients = $this->Visites->Clients->find('list', ['limit' => 200])->all();
        $visiteurs = $this->Visites->Visiteurs->find('list', ['limit' => 200])->all();
        $typeContacts = $this->Visites->TypeContacts->find('list', ['limit' => 200])->all();
        $this->set(compact('visite', 'clients', 'visiteurs', 'typeContacts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Visite id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $visite = $this->Visites->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $visite = $this->Visites->patchEntity($visite, $this->request->getData());
            if ($this->Visites->save($visite)) {
                $this->Flash->success(__('The visite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visite could not be saved. Please, try again.'));
        }
        $clients = $this->Visites->Clients->find('list', ['limit' => 200])->all();
        $visiteurs = $this->Visites->Visiteurs->find('list', ['limit' => 200])->all();
        $typeContacts = $this->Visites->TypeContacts->find('list', ['limit' => 200])->all();
        $this->set(compact('visite', 'clients', 'visiteurs', 'typeContacts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Visite id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $visite = $this->Visites->get($id);
        if ($this->Visites->delete($visite)) {
            $this->Flash->success(__('The visite has been deleted.'));
        } else {
            $this->Flash->error(__('The visite could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

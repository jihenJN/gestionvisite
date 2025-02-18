<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TypeContacts Controller
 *
 * @property \App\Model\Table\TypeContactsTable $TypeContacts
 * @method \App\Model\Entity\TypeContact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypeContactsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typeContacts = $this->paginate($this->TypeContacts);

        $this->set(compact('typeContacts'));
    }

    /**
     * View method
     *
     * @param string|null $id Type Contact id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeContact = $this->TypeContacts->get($id, [
            'contain' => ['Visites'],
        ]);

        $this->set(compact('typeContact'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typeContact = $this->TypeContacts->newEmptyEntity();
        if ($this->request->is('post')) {
            $typeContact = $this->TypeContacts->patchEntity($typeContact, $this->request->getData());
            if ($this->TypeContacts->save($typeContact)) {
                $this->Flash->success(__('The type contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type contact could not be saved. Please, try again.'));
        }
        $this->set(compact('typeContact'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Contact id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typeContact = $this->TypeContacts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typeContact = $this->TypeContacts->patchEntity($typeContact, $this->request->getData());
            if ($this->TypeContacts->save($typeContact)) {
                $this->Flash->success(__('The type contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type contact could not be saved. Please, try again.'));
        }
        $this->set(compact('typeContact'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Contact id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typeContact = $this->TypeContacts->get($id);
        if ($this->TypeContacts->delete($typeContact)) {
            $this->Flash->success(__('The type contact has been deleted.'));
        } else {
            $this->Flash->error(__('The type contact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

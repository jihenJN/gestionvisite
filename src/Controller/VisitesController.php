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

        $nbreJoursRestant =0;

        // Get the 'numero' query parameter
        $numero = $this->request->getQuery('numero');
        
        // Apply filter if 'numero' is provided
        if ($numero) {
            // Filter by exact match on 'numero'
            $visites = $this->Visites->find()
                ->contain(['Clients', 'Visiteurs', 'TypeContacts'])
                ->where(['Visites.numero' => $numero]);

                $visite = $visites->first(); // Get the first visit from the result

                if ($visite) {
                   
                    $currentDate = new \DateTime();
                    $datePrevu = $visite->date_prevu ? new \DateTime($visite->date_prevu->toDateString()) : null;
                    $dateVisite = $visite->date_visite ? new \DateTime($visite->date_visite->toDateString()) : null;
        
                    if ($datePrevu && $datePrevu >$currentDate && !$dateVisite) {
                        $interval = $datePrevu->diff($currentDate);
                        $nbreJoursRestant = $interval->days;
                    }
                }


        } else {
            // If no filter, get all visites
            $visites = $this->Visites->find()
            ->contain(['Clients', 'Visiteurs', 'TypeContacts']);
        }

        // Check if any visites are found
        if ($visites->isEmpty()) {
            // Set a message if no visites are found for the given 'numero'
            $this->Flash->error(__('There is no visit with number {0}', $numero));
        } else {
            // If visites are found, set the title
            $title = 'Nbre jour(s) Reste pour la visite N° ' . h($numero); 
        }


    
        // Apply pagination to the filtered query
        $visites = $this->paginate($visites);


        // Calculate total visits
        $totalVisites = $this->Visites->find()->count();

        // Calculate completed visits (where date_visite is not null)
        $completedVisites = $this->Visites->find()
            ->where(['date_visite IS NOT' => null])
            ->count();

        // Calculate pending visits (where date_visite is null)
        $pendingVisites = $totalVisites - $completedVisites;


        // Calculate delayed visits (where date_visite is later than date_prevu)
        $delayedVisites = $this->Visites->find()
        ->where(['date_visite > date_prevu'])
        ->count();

        // Calculate Taux de retard
        $tauxRetard = ($totalVisites > 0) ? ($delayedVisites / $totalVisites) * 100 : 0;

         // Calculate Taux de reponse
         $tauxReponse = ($totalVisites > 0 )? ($completedVisites / $totalVisites) * 100 : 0;


        // Fetch the list of TypeContacts
        $typeContacts = $this->Visites->TypeContacts->find('list', ['limit' => 200])->all();

        // Prepare data: Get visit counts grouped by type_contact_id
        $typeContactsCounts = $this->Visites->find()
            ->select(['type_contact_id', 'nbre_visites' => $this->Visites->find()->func()->count('*')])
            ->group('type_contact_id')
            ->toArray();

        // Convert counts to an associative array [type_contact_id => nbre_visites]
        $typeContactsCountsMap = [];
        foreach ($typeContactsCounts as $row) {
            $typeContactsCountsMap[$row->type_contact_id] = $row->nbre_visites;
        }

        // Prepare data array
        $typeContactsData = [];
        foreach ($typeContacts as $id => $name) {
            $typeContactsData[] = [
                'type_contact' => $name,
                'nbre_visites' => isset($typeContactsCountsMap[$id]) ? $typeContactsCountsMap[$id] : 0
            ];
        }


        $this->set(compact('visites', 'totalVisites', 'completedVisites', 'pendingVisites', 'tauxRetard','tauxReponse','nbreJoursRestant','typeContactsData'));
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

              // You can log the errors to debug them
              debug($visite->getErrors()); // This will show validation errors
            
              // Alternatively, log them to CakePHP's log file
              Log::error('Visite Save Failed: ' . print_r($visite->getErrors(), true));
              
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

    public function search()
{
    $this->request->allowMethod(['get']);

    // Get search parameters
    $clientSearch = $this->request->getQuery('client');
    $visiteurSearch = $this->request->getQuery('visiteur');
    $typeContactSearch = $this->request->getQuery('type_contact'); 
    $lieuSearch = $this->request->getQuery('lieu'); 
    $commentaireSearch = $this->request->getQuery('commentaire'); 

    // Build query dynamically
    $query = $this->Visites->find()
        ->contain(['Clients', 'Visiteurs', 'TypeContacts']);

    // Apply filters if they exist
    $conditions = [];
    if (!empty($clientSearch)) {
        $conditions['Clients.nom LIKE'] = "%$clientSearch%";
    }
    if (!empty($visiteurSearch)) {
        $conditions['Visiteurs.nom LIKE'] = "%$visiteurSearch%";
    }
    
    if (!empty($typeContactSearch)) {
        $conditions['TypeContacts.libelle LIKE'] = "%$typeContactSearch%";
    }

    if (!empty($lieuSearch)) {
        $conditions['lieu LIKE'] = "%$lieuSearch%";
    }

    if (!empty($commentaireSearch)) {
        $conditions['commentaire LIKE'] = "%$commentaireSearch%";
    }


    // Apply conditions to query
    if (!empty($conditions)) {
        $query->where($conditions);
    }

    // Fetch results
    $visites = $query->limit(50)->toArray();

    return $this->response->withType('application/json')
        ->withStringBody(json_encode($visites));
}

    

}

<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Visite> $visites
 */
?>
<div class="visites index content">
    <?= $this->Html->link(__('New Visite'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    
    <!-- Display Flash Messages -->
    <?= $this->Flash->render() ?>
    
    <h3><?= __('Visites') ?></h3>

    <!-- Filter Form -->
    <?= $this->Form->create(null, ['type' => 'get']) ?>
        <div class="filter-form">
            <?= $this->Form->control('numero', [ 'value' => $this->request->getQuery('numero')]) ?>
            <?= $this->Form->button(__('Visite N°')) ?>
        </div>
    <?= $this->Form->end() ?>

    <?php if (isset($nbreJoursRestant)): ?>
    <p><strong>Nombre de jours restants :</strong> <?= h($nbreJoursRestant) ?></p>
    <?php endif; ?>

 <div class="container">
    <div>
   <!-- Display total, completed, and pending visits , response ,delays -->
   <h6>Total des visites : <?= $totalVisites ?></h6>
    <h6>Visites Effectués : <?= $completedVisites ?></h6>
    <h6>Visites Non Effectués : <?= $pendingVisites ?></h6>
    <h6>Taux de Retard: <?= number_format($tauxRetard, 2) ?>%</h6>
    <h6>Taux de Reponse: <?= number_format($tauxReponse, 2) ?>%</h6>
    </div>
    <div>

    <h6>Type Contacts & Visit Counts</h6>
    <table >
        <thead>
            <tr>
                <th>Type de Contact</th>
                <th>Nbre Visites</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($typeContactsData as $row): ?>
                <tr>
                    <td><?= h($row['type_contact']) ?></td>
                    <td><?= h($row['nbre_visites']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
 </div>




    <!--div class="search-container">
        <input type="text" id="search" placeholder="Rechercher une visite par client..." class="form-control">
    </div-->

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('numero') ?></th>
                    <th><?= $this->Paginator->sort('commentaire') ?></th>
                    <th><?= $this->Paginator->sort('lieu') ?></th>
                    <th><?= $this->Paginator->sort('date_demande') ?></th>
                    <th><?= $this->Paginator->sort('date_prevu') ?></th>
                    <th><?= $this->Paginator->sort('date_visite') ?></th>
                    <th><?= $this->Paginator->sort('localisation') ?></th>
                    <th><?= $this->Paginator->sort('effectue') ?></th>
                    <th><?= $this->Paginator->sort('client_id') ?></th>
                    <th><?= $this->Paginator->sort('visiteur_id') ?></th>
                    <th><?= $this->Paginator->sort('type_contact_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <!-- Filter Row -->
                <tr>
                    <th></th>
                    <th></th>
                    <th><input type="text" class="filter" data-column="2"></th>
                    <th><input type="text" class="filter" data-column="3"></th>
                    <th><input type="text" class="filter" data-column="4"></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th> <!-- No filter for checkbox -->
                    <th><input type="text" class="filter" id="clientSearch"></th>
                    <th><input type="text" class="filter" id="visiteurSearch"></th>
                    <th><input type="text" class="filter" data-column="11"></th>
                    <th></th> <!-- No filter for actions -->
                </tr>

            </thead>
            <tbody  id="searchResults">
                <?php foreach ($visites as $visite): ?>
                <tr>
                    <td><?= $this->Number->format($visite->id) ?></td>
                    <td><?= $this->Number->format($visite->numero) ?></td>
                    <td><?= h($visite->commentaire) ?></td>
                    <td><?= h($visite->lieu) ?></td>
                    <td><?= h($visite->date_demande) ?></td>
                    <td><?= h($visite->date_prevu) ?></td>
                    <td><?= h($visite->date_visite) ?></td>
                    <td><?= h($visite->localisation) ?></td>
                    <td>
                        <?= $this->Form->checkbox('effectue', [
                            'checked' => !empty($visite->date_visite), // If date_visite is not empty, effectue will be set to true
                            'disabled' => true, // make the checkbox disabled
                            'class' => 'effectue-checkbox' // optional, for styling purposes
                        ]) ?>
                    </td>
                    <td><?= $visite->has('client') ? $this->Html->link($visite->client->nom, ['controller' => 'Clients', 'action' => 'view', $visite->client->id]) : '' ?></td>
                    <td><?= $visite->has('visiteur') ? $this->Html->link($visite->visiteur->nom, ['controller' => 'Visiteurs', 'action' => 'view', $visite->visiteur->id]) : '' ?></td>
                    <td><?= $visite->has('type_contact') ? $this->Html->link($visite->type_contact->libelle, ['controller' => 'TypeContacts', 'action' => 'view', $visite->type_contact->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $visite->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $visite->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $visite->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visite->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll("#clientSearch, #visiteurSearch, #dateVisiteSearch, #lieuSearch");

    inputs.forEach(input => {
        input.addEventListener("input", debounce(performSearch, 300)); // Debounce function added
    });

    function performSearch() {
        let client = document.getElementById("clientSearch").value;
        let visiteur = document.getElementById("visiteurSearch").value;
       
        let queryParams = new URLSearchParams();
        if (client) queryParams.append("client", client);
        if (visiteur) queryParams.append("visiteur", visiteur);
  

        fetch(`/visites/search?${queryParams.toString()}`)
            .then(response => response.json())
            .then(data => {
                let tableBody = document.getElementById("searchResults");
                tableBody.innerHTML = ""; // Clear previous results

                if (data.length === 0) {
                    tableBody.innerHTML = "<tr><td colspan='5'>No results found</td></tr>";
                    return;
                }

                data.forEach(visite => {
                    let row = `<tr>
                        <td>${visite.id}</td>
                        <td>${visite.client ? visite.client.nom : ''}</td>
                        <td>${visite.visiteur ? visite.visiteur.nom : ''}</td>
                        <td>${visite.date_visite || ''}</td>
                        <td>${visite.lieu || ''}</td>
                    </tr>`;
                    tableBody.innerHTML += row;
                });
            });
    }

    // Debounce function to prevent too many API calls
    function debounce(func, delay) {
        let timer;
        return function() {
            clearTimeout(timer);
            timer = setTimeout(func, delay);
        };
    }
});

</script>



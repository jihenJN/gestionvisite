<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visite $visite
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Visite'), ['action' => 'edit', $visite->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Visite'), ['action' => 'delete', $visite->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visite->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Visites'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Visite'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="visites view content">
            <h3><?= h($visite->commentaire) ?></h3>
            <table>
                <tr>
                    <th><?= __('Commentaire') ?></th>
                    <td><?= h($visite->commentaire) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lieu') ?></th>
                    <td><?= h($visite->lieu) ?></td>
                </tr>
                <tr>
                    <th><?= __('Localisation') ?></th>
                    <td><?= h($visite->localisation) ?></td>
                </tr>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $visite->has('client') ? $this->Html->link($visite->client->nom, ['controller' => 'Clients', 'action' => 'view', $visite->client->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Visiteur') ?></th>
                    <td><?= $visite->has('visiteur') ? $this->Html->link($visite->visiteur->nom, ['controller' => 'Visiteurs', 'action' => 'view', $visite->visiteur->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Type Contact') ?></th>
                    <td><?= $visite->has('type_contact') ? $this->Html->link($visite->type_contact->libelle, ['controller' => 'TypeContacts', 'action' => 'view', $visite->type_contact->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($visite->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Numero') ?></th>
                    <td><?= $this->Number->format($visite->numero) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Demande') ?></th>
                    <td><?= h($visite->date_demande) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Prevu') ?></th>
                    <td><?= h($visite->date_prevu) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Visite') ?></th>
                    <td><?= h($visite->date_visite) ?></td>
                </tr>
                <tr>
                    <th><?= __('Effectue') ?></th>
                    <td><?= $visite->effectue ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

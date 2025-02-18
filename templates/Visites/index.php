<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Visite> $visites
 */
?>
<div class="visites index content">
    <?= $this->Html->link(__('New Visite'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Visites') ?></h3>
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
            </thead>
            <tbody>
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

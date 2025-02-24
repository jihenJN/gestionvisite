<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Client'), ['action' => 'edit', $client->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Client'), ['action' => 'delete', $client->id], ['confirm' => __('Are you sure you want to delete # {0}?', $client->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Clients'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Client'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clients view content">
            <h3><?= h($client->nom) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($client->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telephone') ?></th>
                    <td><?= h($client->telephone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($client->email) ?></td>
                </tr>
                
            </table>
            <div class="related">
                <h4><?= __('Visites Associées') ?></h4>
                <?php if (!empty($client->visites)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            
                            <th><?= __('Numero') ?></th>
                            <th><?= __('Commentaire') ?></th>
                            <th><?= __('Lieu') ?></th>
                            <th><?= __('Date Demande') ?></th>
                            <th><?= __('Date Prevu') ?></th>
                            <th><?= __('Date Visite') ?></th>
                            <th><?= __('Localisation') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Client Id') ?></th>
                            <th><?= __('Visiteur Id') ?></th>
                            <th><?= __('Type Contact Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($client->visites as $visites) : ?>
                        <tr>
                           
                            <td><?= h($visites->numero) ?></td>
                            <td><?= h($visites->commentaire) ?></td>
                            <td><?= h($visites->lieu) ?></td>
                            <td><?= h($visites->date_demande) ?></td>
                            <td><?= h($visites->date_prevu) ?></td>
                            <td><?= h($visites->date_visite) ?></td>
                            <td><?= h($visites->localisation) ?></td>
                            <td><?= h($visites->status) ?></td>
                            <td><?= h($visites->client_id) ?></td>
                            <td><?= h($visites->visiteur_id) ?></td>
                            <td><?= h($visites->type_contact_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Visites', 'action' => 'view', $visites->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Visites', 'action' => 'edit', $visites->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Visites', 'action' => 'delete', $visites->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visites->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

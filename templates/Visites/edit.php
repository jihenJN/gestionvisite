<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visite $visite
 * @var string[]|\Cake\Collection\CollectionInterface $clients
 * @var string[]|\Cake\Collection\CollectionInterface $visiteurs
 * @var string[]|\Cake\Collection\CollectionInterface $typeContacts
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $visite->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $visite->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Visites'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="visites form content">
            <?= $this->Form->create($visite) ?>
            <fieldset>
                <legend><?= __('Edit Visite') ?></legend>
                <?php
                    echo $this->Form->control('numero');
                    echo $this->Form->control('commentaire');
                    echo $this->Form->control('lieu');
                    echo $this->Form->control('date_demande', ['empty' => true]);
                    echo $this->Form->control('date_prevu', ['empty' => true]);
                    echo $this->Form->control('date_visite', ['empty' => true]);
                    echo $this->Form->control('localisation');
                    echo $this->Form->control('effectue');
                    echo $this->Form->control('client_id', ['options' => $clients]);
                    echo $this->Form->control('visiteur_id', ['options' => $visiteurs]);
                    echo $this->Form->control('type_contact_id', ['options' => $typeContacts]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>


</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visite $visite
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 * @var \Cake\Collection\CollectionInterface|string[] $visiteurs
 * @var \Cake\Collection\CollectionInterface|string[] $typeContacts
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Visites'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="visites form content">
            <?= $this->Form->create($visite) ?>
            <fieldset>
                <legend><?= __('Add Visite') ?></legend>
                <?php
                    echo $this->Form->control('numero');
                    echo $this->Form->control('commentaire');
                    echo $this->Form->control('lieu');
                    echo $this->Form->control('date_demande', ['empty' => true]);
                    echo $this->Form->control('date_prevu', ['empty' => true]);
                    echo $this->Form->control('date_visite', ['empty' => true]);
                    echo $this->Form->control('localisation');
                    echo $this->Form->control('effectue');
                 
                   
                ?>
                  
                <!-- Client dropdown and "Add New Client" button in grid layout -->
              
                <div class="col-12">
                    <div >
                        <?= $this->Form->control('client_id', ['options' => $clients, 'label' => false, 'class' => 'form-control w-100']); ?>
                    </div>
                    <div >
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addClientModal">
                      Ajout Client
                    </button>
                    </div>
                </div>
                
                
                <?php
                 
                 echo $this->Form->control('visiteur_id', ['options' => $visiteurs]);
                 echo $this->Form->control('type_contact_id', ['options' => $typeContacts]);
                ?>

                  
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
 
    <!-- Bootstrap Modal for Adding Client -->
    <div class="modal fade bootstrap-modal" id="addClientModal" tabindex="-1" aria-labelledby="addClientLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addClientLabel">Add Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="addClientFormContainer">
                        <!-- Include the form or AJAX load it dynamically -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    
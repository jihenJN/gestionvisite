<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visite $visite
 * @var \App\Model\Entity\Client $client
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
                    echo $this->Form->control('date_prevu', ['empty' => true ,'min'=> date('Y-m-d')]);
                    echo $this->Form->control('date_visite', ['empty' => true ,'max'=> date('Y-m-d') ,'id' => 'date-visite']); // Restricts future dates
                    echo $this->Form->control('localisation');
                    echo $this->Form->control('effectue',['id' => 'effectue-checkbox']);
                ?>
                  
                <!-- Client dropdown and "Add New Client" button in grid layout -->
              
                <div class="col-12">
                    <div >
                        <?= $this->Form->control('client_id', ['options' => $clients,'id' => 'client-id','label' => false, 'class' => 'form-control w-100']); ?>
                    </div>
                    <div >
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addClientModal">
                     +
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
                <form id="addClientForm">
    <div class="mb-3">
        <label for="client-nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="client-nom" name="nom" required>
    </div>
    <div class="mb-3">
        <label for="client-telephone" class="form-label">Téléphone</label>
        <input type="text" class="form-control" id="client-telephone" name="telephone">
    </div>
    <div class="mb-3">
        <label for="client-email" class="form-label">Email</label>
        <input type="email" class="form-control" id="client-email" name="email">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

                </div>
            </div>
        </div>
    </div>
    

<script>
$(document).ready(function () {
    $('#addClientForm').submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        const submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true).text('Adding...');

        // Get CSRF token from meta tag
        const csrfToken = $('meta[name="csrfToken"]').attr('content');

        $.ajax({
            url: '<?= $this->Url->build(["controller" => "Clients", "action" => "addAjax"]) ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-Token': csrfToken // Add CSRF token in the request header
            },
            success: function (response) {
                if (response.status === 'success') {
                    

                    // Prepend the new client at the top of the dropdown
                    $('#client-id').append(new Option(response.client.nom, response.client.id));
                    
                    // Manually set the newly added client as selected
                    $('#client-id').val(response.client.id).trigger('change');

                    // Close modal
                    $('#addClientModal').modal('hide');

                    // Reset form fields
                    $('#addClientForm')[0].reset();


                } else {
                    // Display validation errors
                    let errorMessage = 'Error adding client:\n';
                    $.each(response.errors, function (field, messages) {
                        errorMessage += field + ': ' + messages.join(', ') + '\n';
                    });
                    alert(errorMessage);
                }
            },
            error: function () {
                alert('An error occurred. Please try again.');
            },
            complete: function () {
                // Re-enable submit button
                submitButton.prop('disabled', false).text('Submit');
            }
        });
    });
});


</script>

<script>
$(document).ready(function () {
    $('#date-visite').on('change', function () {
        let dateValue = $(this).val(); // Get selected date
        if (dateValue) {
            $('#effectue-checkbox').prop('checked', true);
        } else {
            $('#effectue-checkbox').prop('checked', false);
        }
    });
});
</script>

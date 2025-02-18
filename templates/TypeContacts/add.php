<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeContact $typeContact
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Type Contacts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="typeContacts form content">
            <?= $this->Form->create($typeContact) ?>
            <fieldset>
                <legend><?= __('Add Type Contact') ?></legend>
                <?php
                    echo $this->Form->control('libelle');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

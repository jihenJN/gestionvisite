<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Visite Entity
 *
 * @property int $id
 * @property int $numero
 * @property string $commentaire
 * @property string $lieu
 * @property \Cake\I18n\FrozenDate|null $date_demande
 * @property \Cake\I18n\FrozenDate|null $date_prevu
 * @property \Cake\I18n\FrozenDate|null $date_visite
 * @property string $localisation
 * @property bool $effectue
 * @property int $client_id
 * @property int $visiteur_id
 * @property int $type_contact_id
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Visiteur $visiteur
 * @property \App\Model\Entity\TypeContact $type_contact
 */
class Visite extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'numero' => true,
        'commentaire' => true,
        'lieu' => true,
        'date_demande' => true,
        'date_prevu' => true,
        'date_visite' => true,
        'localisation' => true,
        'effectue' => true,
        'client_id' => true,
        'visiteur_id' => true,
        'type_contact_id' => true,
        'client' => true,
        'visiteur' => true,
        'type_contact' => true,
    ];
}

<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VisitesFixture
 */
class VisitesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'numero' => 1,
                'commentaire' => 'Lorem ipsum dolor sit amet',
                'lieu' => 'Lorem ipsum dolor sit amet',
                'date_demande' => '2025-02-18',
                'date_prevu' => '2025-02-18',
                'date_visite' => '2025-02-18',
                'localisation' => 'Lorem ipsum dolor sit amet',
                'effectue' => 1,
                'client_id' => 1,
                'visiteur_id' => 1,
                'type_contact_id' => 1,
            ],
        ];
        parent::init();
    }
}

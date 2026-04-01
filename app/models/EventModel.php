<?php

class EventModel
{
    /**
     * Returns lineup artists data.
     */
    public function getLineup(): array
    {
        return [
            [
                'name'   => 'Marvvila',
                'genre'  => 'Live Act',
                'status' => 'status.confirmed',
            ],
            [
                'name'   => 'Samba de Dom',
                'genre'  => 'Live Act',
                'status' => 'status.confirmed',
            ],
            [
                'name'   => 'A Revelar',
                'genre'  => 'Samba',
                'status' => 'status.soon',
            ],
            [
                'name'   => 'A Revelar',
                'genre'  => 'Samba',
                'status' => 'status.soon',
            ],
        ];
    }

    /**
     * Returns event dates and locations.
     */
    public function getEvents(): array
    {
        return [
            [
                'id'      => 'luanda',
                'date'    => '2026-05-16',
                'city'    => 'city.luanda',
                'country' => 'Angola',
                'flag'    => '🇦🇴',
                'venue'   => 'status.confirmed',
                'status'  => 'status.soon',
                'artists' => ['Marvvila', '+ convidados'],
            ],
            [
                'id'      => 'lisboa',
                'date'    => '2026-05-17',
                'city'    => 'city.lisbon',
                'country' => 'Portugal',
                'flag'    => '🇵🇹',
                'venue'   => 'status.confirmed',
                'status'  => 'status.available',
                'artists' => ['Marvvila', 'Samba de Dom', '+ convidados'],
            ],
        ];
    }

    /**
     * Returns ticket lots / pricing for each event.
     */
    public function getTickets(): array
    {
        return [
            'luanda' => [
                [
                    'name'          => 'PANDEIRO',
                    'qty'           => 50,
                    'currency'      => 'Kz',
                    'price'         => 5000,
                    'group_price'   => 4000,
                ],
                [
                    'name'          => 'CAVAQUINHO',
                    'qty'           => 100,
                    'currency'      => 'Kz',
                    'price'         => 7500,
                    'group_price'   => 6000,
                ],
                [
                    'name'          => 'BATERIA',
                    'qty'           => 200,
                    'currency'      => 'Kz',
                    'price'         => 10000,
                    'group_price'   => 8000,
                ],
            ],
            'lisboa' => [
                [
                    'name'          => 'PANDEIRO',
                    'qty'           => 50,
                    'currency'      => '€',
                    'price'         => 25,
                    'group_price'   => 20,
                ],
                [
                    'name'          => 'CAVAQUINHO',
                    'qty'           => 100,
                    'currency'      => '€',
                    'price'         => 30,
                    'group_price'   => 25,
                ],
                [
                    'name'          => 'BATERIA',
                    'qty'           => 200,
                    'currency'      => '€',
                    'price'         => 35,
                    'group_price'   => 30,
                ],
            ],
        ];
    }

    /**
     * Returns countdown target date (next event).
     */
    public function getCountdownTarget(): string
    {
        return '2026-05-16T20:00:00';
    }
}

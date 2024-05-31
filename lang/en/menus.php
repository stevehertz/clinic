<?php
return [

    'admins' => [
        'sidebar' => [
            'dashboard' => 'Dashboard',
            'patients' => [
                'management' => 'Manage Patients',
                'title' => 'Patients',
                'create' => 'New Patient',
            ],

            'headers' => [
                'inventory' => 'Inventory',
                'users' => 'Users Access',
                'reports' => 'REPORTS',
                'settings' => 'SETTINGS'
            ],

            'inventory' => [
                'frames' => [
                    'title' => 'Frame Stocks',
                ],

                'cases' => [
                    'title' => 'Case Stocks',
                ],

                'lenses' => [
                    'title' => 'Lens Stocks',
                ],

            ],
            'reports' => [
                'main' => 'Main Report',
                'payments' => 'Payments Report',
                'orders' => 'Orders Report',
                'tat' => 'TAT Reports',
                'scheme_details' => 'Scheme Details Report',
                'claims' => 'Claims Report',
                'uncollected_ordrs' => 'Uncollected Orders Reports',
                'rejected' => 'Rejected Claims Report',
                'pending' => 'Pending Claims Report',
                'assets' => "Assets Report",
                "frames" => "Frame Consumption Report",
                "lens" => "Lens Consumption Report",
                "cases" => "Case Consumption Reports"
            ],
            'user_management' => [
                'admins' => 'Admins',
                'users' => 'Optometrists',
                'technicians' => 'Technicians'
            ],
            'payments' => [
                'payments' => 'Payments/ Billing',
                'closed' => 'Closed Bills',
                'billing' => 'Billing',
            ],
            'settings' => 'Settings',
        ],
    ],

    'users' => [

        'sidebar' => [
            'dashboard' => 'Dashboard',
            'patients' => [
                'management' => 'Manage Patients',
                'title' => 'Patients',
                'create' => 'New Patient',
            ],

            'headers' => [
                'inventory' => 'Inventory',
                'users' => 'Users Access',
            ],

            'inventory' => [
                'frames' => [
                    'title' => 'Frame Stocks',
                ],
                'cases' => [
                    'title' => 'Case Stocks',
                ],
            ]


        ]

    ],

    'technicians' => [
        'sidebar' => [
            'dashboard' => 'Dashboard',
            'patients' => [
                'management' => 'Manage Patients',
                'title' => 'Patients',
                'create' => 'New Patient',
            ],

            'headers' => [
                'inventory' => 'Inventory',
                'users' => 'Users Access',
            ],

            'inventory' => [
                'lens' => [
                    'title' => 'Lens Stocks',
                ],
                'cases' => [
                    'title' => 'Case Stocks',
                ],
            ],
        ],
    ],

];

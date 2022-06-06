<?php
return [
    [
        'label' => 'Dashboard',
        'route' => 'admin.dasboard',
        'icon' => 'icon-grid menu-icon',
    ], [
        'label' => 'Category',
        'route' => 'categories.index',
        'icon' => 'fa-solid fa-bars pr-3',
    ], [
        'label' => 'Product',
        'route' => 'products.index',
        'icon' => 'fa-solid fa-shop pr-3',
        'items' => [
            [
                'label' => 'Products',
                'route' => 'products.index',
                'icon' => 'icon-grid menu-icon',
            ], [
                'label' => 'Create Product',
                'route' => 'products.create',
                'icon' => 'icon-grid menu-icon',
            ]
        ]
    ], [
        'label' => 'File Manager',
        'route' => 'admin.file',
        'icon' => 'fa-solid fa-folder pr-3',
    ], [
        'label' => 'Account',
        'route' => 'account.index',
        'icon' => 'fa-solid fa-user pr-3',
    ],
];

<?php
    return [
        [
            'name' => 'Tài khoản quản trị',
            'icon' => 'ti-user',
            'route' => 'account.index',
            'items' => [
                [
                    'name' => 'Danh sách',
                    'route' => 'account.index'
                ],
                [
                    'name' => 'Thêm mới',
                    'route' => 'account.create'
                ]
            ]
        ],
        [
            'name' => 'Khách hàng',
            'icon' => 'ti-user',
            'route' => 'customer.index',
            'items' => [
                [
                    'name' => 'Danh sách',
                    'route' => 'customer.index'
                ],
                [
                    'name' => 'Thùng rác',
                    'route' => 'customer.trash'
                ]
            ]
        ],
        [
            'name' => 'Danh mục',
            'icon' => 'ti-list',
            'route' => 'category.index',
            'items' => [
                [
                    'name' => 'Danh sách',
                    'route' => 'category.index'
                ],
                [
                    'name' => 'Thêm mới',
                    'route' => 'category.create'
                ],
                [
                    'name' => 'Thùng rác',
                    'route' => 'category.trash'
                ]
            ]
        ],
        [
            'name' => 'Sản phẩm',
            'icon' => 'ti-shopping-cart',
            'route' => 'product.index',
            'items' => [
                [
                    'name' => 'Danh sách',
                    'route' => 'product.index'
                ],
                [
                    'name' => 'Thêm mới',
                    'route' => 'product.create'
                ],
                [
                    'name' => 'Thùng rác',
                    'route' => 'product.trash'
                ]
            ]
        ],
        [
            'name' => 'Đơn đặt hàng',
            'icon' => 'ti-layout-list-thumb',
            'route' => 'order.index',
            'items' => [
                [
                    'name' => 'Danh sách',
                    'route' => 'order.index'
                ]
            ]
        ]
    ]
?>
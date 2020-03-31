<?php

return [
    'url' => [
        'pre_admin' => 'admin123',
        'pre_news' => 'news123',
    ],

    'format_time' => [
        'long_time' => 'H:i:s d/m/Y',
        'short_time' => 'd/m/Y',
    ],
    
    'template' => [
        'form' => [
            'label' => [
                'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
            ],
            'element' => [
                'class' => 'form-control col-md-6 col-xs-12'
            ],
            'ckeditor' => [
                'class' => 'form-control col-md-6 col-xs-12 ckeditor'
            ]
        ],
        'status' => [
            'default'   => ['name' => 'Chưa xác định', 'class' => 'btn-info'],
            'all'       => ['name' => 'Tất cả', 'class' => 'btn-info'],
            'active'    => ['name' => 'Kích hoạt', 'class' => 'btn-info'],
            'inactive'  => ['name' => 'Chưa kích hoạt', 'class' => 'btn-info']
        ],
        'isHome' => [
            'yes' => ['name' => 'Hiển thị', 'class' => 'btn-success'],
            'no' => ['name' => 'Không hiển thi', 'class' => 'btn-info']
        ],
        'display' => [
            'list' => ['name' => 'Danh sách'],
            'grid' => ['name' => 'Lưới']
        ],
        'level' => [
            'admin' => ['name' => 'Quản trị viên'],
            'member' => ['name' => 'Thành viên']
        ],
        'type' => [
            'featured' => ['name' => 'Nổi bật'],
            'normal' => ['name' => 'Không nổi bật']
        ],
        'search' => [
            'all' => ['name' => 'Search by All'],
            'id' =>  ['name' => 'Search by Id'],
            'name' => ['name' => 'Search by Name'],
            'username' => ['name' => 'Search by Username'],
            'fullname' => ['name' => 'Search by Fullname'],
            'email' => ['name' => 'Search by Email'],
            'description' => ['name' => 'Search by Description'],
            'link' => ['name' => 'Search by Link'],
            'content' => ['name' => 'Search by Content'],
        ],
        'button' => [
            'edit'      => ['class' => 'btn-success', 'title' => 'Edit', 'icon' => 'fa-pencil', 'route-name' => '/form'],
            'delete'    => ['class' => 'btn-danger btn-delete', 'title' => 'Delete', 'icon' => 'fa-trash', 'route-name' => '/delete'],
            'info'      => ['class' => 'btn-info', 'title' => 'View', 'icon' => 'fa-eye', 'route-name' => '/delete']
        ]
    ],
    'config' => [
        'search' => [
            'default' => ['all', 'id'],
            'slider' => ['all', 'id', 'name', 'description'],
            'category' => ['all', 'id', 'name'],
            'article' => ['all', 'id', 'name'],
            'user' => ['all', 'id', 'username']
        ],
        'button' => [
            'default' => ['edit', 'delete'],
            'slider'  => ['edit', 'delete'],
            'category'  => ['edit', 'delete'],
            'article'  => ['edit', 'delete'],
            'user'  => ['edit', 'delete']
        ]
    ]
];

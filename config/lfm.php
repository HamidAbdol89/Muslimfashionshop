<?php

/*
|--------------------------------------------------------------------------
| Documentation for this config :
|--------------------------------------------------------------------------
| online  => http://unisharp.github.io/laravel-filemanager/config
| offline => vendor/unisharp/laravel-filemanager/docs/config.md
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
     */

    'use_package_routes' => true, // Sử dụng các route mặc định của package

    /*
    |--------------------------------------------------------------------------
    | Shared folder / Private folder
    |--------------------------------------------------------------------------
     */

    'allow_private_folder' => true, // Cho phép sử dụng thư mục riêng tư (private folder)
    'private_folder_name'  => UniSharp\LaravelFilemanager\Handlers\ConfigHandler::class, // Để sử dụng tên thư mục người dùng (dựa trên ID người dùng)

    'allow_shared_folder'  => true, // Cho phép sử dụng thư mục chia sẻ (shared folder)
    'shared_folder_name'   => 'shares', // Tên thư mục chia sẻ

    /*
    |--------------------------------------------------------------------------
    | Folder Names
    |--------------------------------------------------------------------------
     */

    'folder_categories' => [
        'file' => [
            'folder_name'  => 'files', // Thư mục cho các tệp tin
            'startup_view' => 'list', // Hiển thị dạng danh sách
            'max_size'     => 50000, // Kích thước tối đa tệp (KB)
            'thumb'        => true,  // Tạo ảnh thu nhỏ cho các tệp
            'thumb_width'  => 80,    // Chiều rộng ảnh thu nhỏ (px)
            'thumb_height' => 80,    // Chiều cao ảnh thu nhỏ (px)
            'valid_mime'   => [
                'image/jpeg',
                'image/pjpeg',
                'image/png',
                'image/gif',
                'application/pdf',
                'text/plain',
            ],
        ],
        'image' => [
            'folder_name'  => 'photos', // Thư mục cho ảnh
            'startup_view' => 'grid',   // Hiển thị dạng lưới
            'max_size'     => 50000,   // Kích thước tối đa ảnh (KB)
            'thumb'        => true,    // Tạo ảnh thu nhỏ
            'thumb_width'  => 80,      // Chiều rộng ảnh thu nhỏ (px)
            'thumb_height' => 80,      // Chiều cao ảnh thu nhỏ (px)
            'valid_mime'   => [
                'image/jpeg',
                'image/pjpeg',
                'image/png',
                'image/gif',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
     */

    'paginator' => [
        'perPage' => 30, // Số lượng mục mỗi trang
    ],

    /*
    |--------------------------------------------------------------------------
    | Upload / Validation
    |--------------------------------------------------------------------------
     */

    'disk' => 'public', // Đĩa lưu trữ tệp tin (bạn cần cấu hình trong `config/filesystems.php`)
    
    'rename_file'            => false, // Không tự động đổi tên file khi upload
    'rename_duplicates'      => false, // Không đổi tên tệp trùng
    'alphanumeric_filename'  => false, // Không giới hạn tên tệp là chuỗi alphanumeric
    'alphanumeric_directory' => false, // Không giới hạn tên thư mục là chuỗi alphanumeric
    'should_validate_size'   => false, // Không kiểm tra kích thước file
    'should_validate_mime'   => true,  // Kiểm tra mime type của file
    'over_write_on_duplicate' => false, // Không ghi đè file cũ khi trùng tên
    'disallowed_mimetypes'   => ['text/x-php', 'text/html', 'text/plain'], // Các mime type không được phép upload
    'disallowed_extensions'  => ['php', 'html'], // Các phần mở rộng không được phép upload

    // Cấu hình các cột của các tệp
    'item_columns' => ['name', 'url', 'time', 'icon', 'is_file', 'is_image', 'thumb_url'],

    /*
    |--------------------------------------------------------------------------
    | Thumbnail
    |--------------------------------------------------------------------------
     */

    'should_create_thumbnails' => true, // Tạo thumbnails cho ảnh
    'thumb_folder_name'        => 'thumbs', // Thư mục chứa thumbnails
    'raster_mimetypes'         => [
        'image/jpeg',
        'image/pjpeg',
        'image/png',
    ], // Các loại hình ảnh tạo thumbnails
    'thumb_img_width'          => 200, // Chiều rộng ảnh thu nhỏ (px)
    'thumb_img_height'         => 200, // Chiều cao ảnh thu nhỏ (px)

    /*
    |--------------------------------------------------------------------------
    | File Extension Information
    |--------------------------------------------------------------------------
     */

    'file_type_array' => [
        'pdf'  => 'Adobe Acrobat',
        'doc'  => 'Microsoft Word',
        'docx' => 'Microsoft Word',
        'xls'  => 'Microsoft Excel',
        'xlsx' => 'Microsoft Excel',
        'zip'  => 'Archive',
        'gif'  => 'GIF Image',
        'jpg'  => 'JPEG Image',
        'jpeg' => 'JPEG Image',
        'png'  => 'PNG Image',
        'ppt'  => 'Microsoft PowerPoint',
        'pptx' => 'Microsoft PowerPoint',
    ],

    /*
    |--------------------------------------------------------------------------
    | php.ini override
    |--------------------------------------------------------------------------
     */

    'php_ini_overrides' => [
        'memory_limit' => '256M', // Tăng giới hạn bộ nhớ nếu cần
    ],
];

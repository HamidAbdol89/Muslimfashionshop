<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hướng Dẫn Kích Thước Dành Cho Nam</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fb;
            color: #333;
            padding: 0;
            margin: 0;
            height: 100vh;
        }

        nav {
            position: fixed;
            /* Đảm bảo nav được cố định */
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            z-index: 1;
            /* Đặt nav dưới .container */
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            /* Đảm bảo phần tử này có vị trí để có thể điều chỉnh z-index */
            z-index: 10;
            /* Đặt chỉ số z-index cao hơn nav để hiển thị lên trên */
            margin-top: 60px;
            /* Đảm bảo phần content không bị ẩn sau nav */
        }

        h1,
        h2 {
            color: #2d3748;
        }

        .section-title {
            font-size: 1.5rem;
            margin-top: 20px;
            color: #4a5568;
            font-weight: 600;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f7fafc;
            font-weight: 600;
        }

        .btn-close {
            display: block;
            margin-top: 20px;
            background-color: #e53e3e;
            color: white;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-close:hover {
            background-color: #c53030;
        }

        .note {
            font-style: italic;
            color: #4a5568;
            margin-top: 20px;
        }


        /* Modal Styles */
        #sizeGuideModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
            padding: 20px;
        }

        #sizeGuideModal .modal-content {
            background-color: white;
            border-radius: 8px;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            overflow-y: auto;
            height: calc(100vh - 60px);
            /* Full height minus navbar */
        }

        #sizeGuideModal .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
            background-color: red;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            text-align: center;
            cursor: pointer;
        }

        /* Button Styles */
        #btnSizeGuide {
            background-color: #eee3e3;
            /* Màu nền nhẹ như màu da người */
            color: #000;
            /* Màu chữ đen */
            border: 1px solid #ccc;
            /* Viền mờ nhẹ */
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            /* Thêm hiệu ứng chuyển màu khi hover */
        }

        /* Hover effect */
        #btnSizeGuide:hover {
            background-color: #9b1c1c;
            /* Màu đỏ đô */
            color: #fff;
            /* Màu chữ trắng */
        }


        .guide-container {
            display: flex;
            flex-direction: column;
            /* Sắp xếp theo chiều dọc */
            gap: 20px;
            /* Khoảng cách giữa các phần tử */
            margin: 20px 0;
        }

        .guide-text {
            flex: 1;
            text-align: left;
        }

        .guide-image {
            display: flex;
            flex-direction: row;
            /* Ảnh và văn bản nằm ngang */
            justify-content: space-between;
            /* Giãn cách đều */
            gap: 20px;
            /* Khoảng cách giữa ảnh và văn bản */
        }

        .size-guide-image-right {
            max-width: 200px;
            height: auto;
            align-self: flex-start;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .size-guide-image-left {
            max-width: 20%;
            height: auto;
            margin-top: 20px;
            /* Khoảng cách với phần trên */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        #video-modal {
    z-index: 1000;
}

#video-modal video {
    max-height: 80vh;
    max-width: 100%;
}

.video-link {
    background-color: #800000; /* Màu đỏ đô */
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
    text-decoration: none;
    display: inline-block;
    transition: background-color 0.3s, transform 0.2s;
    cursor: pointer;
}

.video-link:hover {
    background-color: #a00000; /* Màu đỏ đô sáng hơn khi hover */
    transform: scale(1.05); /* Hiệu ứng phóng to nhẹ khi hover */
}

.video-link:active {
    transform: scale(0.95); /* Hiệu ứng nhấn khi click */
}


tr.custom-row {
    background-color: #000; /* Màu nền đen */
    color: #fff; /* Màu chữ trắng */
}


    </style>
</head>

<body>

    <!-- Nút để mở hướng dẫn kích thước -->
    <button id="btnSizeGuide" class="btn btn-primary">Hướng Dẫn Kích Thước</button>

    <!-- Modal Hiển Thị Hướng Dẫn Kích Thước -->
    <div id="sizeGuideModal">
        <div class="modal-content">
            <!-- Đóng Modal -->
            <button id="closeModal" class="close-btn">X</button>

            <h1>Hướng Dẫn Kích Thước Dành Cho Nam</h1>

            <p>HAKIMSHOP có 2 bảng kích thước để giúp bạn chọn đúng kích thước: 1) Bảng kích thước cơ thể chung và 2) Bảng
                số đo quần áo cho từng loại quần áo cụ thể. Vui lòng tham khảo cả hai bảng để đảm bảo chọn đúng kích
                thước của bạn. Sử dụng bảng kích thước cơ thể để lấy số đo cơ thể của bạn và bảng số đo quần áo để xem
                số đo của chính quần áo, sau đó bạn có thể so sánh với bất kỳ loại quần áo nào bạn đã sở hữu để xem
                chúng có giống nhau hay không.</p>

            <!-- Bảng Kích Thước Cơ Thể Nam -->
            <h2 class="section-title">Bảng Kích Thước Cơ Thể Nam Giới</h2>
            <p><strong>Số đo vòng ngực và vòng eo là tổng chu vi</strong></p>

            <table>
                <thead>
                    <tr class="custom-row">
                        <td></td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">S</font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">M</font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">L</font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">XL</font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">2XL</font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">3XL</font>
                            </font>
                        </td>
                    </tr>
                    
                    <tr class="hidden">
                        <td class="text-sm hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">TRONG</font>
                            </font>
                        </td>
                        <td class="text-sm table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">CM</font>
                            </font>
                        </td>
                        <td class="text-sm hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">TRONG</font>
                            </font>
                        </td>
                        <td class="text-sm table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">CM</font>
                            </font>
                        </td>
                        <td class="text-sm hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">TRONG</font>
                            </font>
                        </td>
                        <td class="text-sm table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">CM</font>
                            </font>
                        </td>
                        <td class="text-sm hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">TRONG</font>
                            </font>
                        </td>
                        <td class="text-sm table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">CM</font>
                            </font>
                        </td>
                        <td class="text-sm hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">TRONG</font>
                            </font>
                        </td>
                        <td class="text-sm table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">CM</font>
                            </font>
                        </td>
                        <td class="text-sm hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">TRONG</font>
                            </font>
                        </td>
                        <td class="text-sm table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">CM</font>
                            </font>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Chiều cao</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">5,5"-5,7"</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">165-170</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">5,8"-5,10"</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">173-178</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">5,11"-6,1"</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">180-185</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">6,2"-6,4"</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">188-193</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">6,2"-6,4"</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">188-193</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">6,2"-6,4"</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">188-193</font>
                            </font>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Ngực</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">35-37</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">89-94</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">38-40</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">97-102</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">41-43</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">104-109</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">44-46</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">112-117</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">47-49</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">119-127</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">50-52</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">127-132</font>
                            </font>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Thắt lưng</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">30-32</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">76-81</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">33-35</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">84-89</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">36-38</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">91-97</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">39-41</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">99-104</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">42-44</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">107-112</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">45-47</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">114-119</font>
                            </font>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Cái đầu</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">21,5-22</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">54,5-55,5</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">22-22,5</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">56-57</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">22,5-23</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">57,5-58,5</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">23-23,5</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">59-60</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">23,5-24</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">60,5-61,5</font>
                            </font>
                        </td>
                        <td class="text-xs hidden" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">24-24,5</font>
                            </font>
                        </td>
                        <td class="text-xs table-cell" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">62-63</font>
                            </font>
                        </td>
                    </tr>
                </tbody>
            </table>

       
            <!-- Hướng Dẫn Đo Lường Nam Giới -->
            <div class="guide-container">
                <div class="guide-image">
                    <div class="guide-text">
                        <h2 class="section-title">Hướng Dẫn Đo Lường Nam Giới</h2>
                        <p><strong>Chiều cao:</strong> Để có kết quả tốt nhất, hãy đứng chân trần cạnh khung cửa, sau đó
                            đo từ đỉnh
                            đầu đến lòng bàn chân. Tốt hơn nữa, hãy nhờ bạn bè hoặc thành viên gia đình đo giúp bạn.</p>
                        <p><strong>Ngực:</strong> Đặt thước dây dưới cánh tay và đo quanh phần đầy nhất của ngực và qua
                            xương bả vai
                            ở phía sau.</p>
                        <p><strong>Vòng eo:</strong> Đo quanh vòng eo tự nhiên của bạn, giữ cho thước dây hơi lỏng một
                            chút.</p>
                        <p><strong>Vòng đầu (đối với mũ):</strong> Đo chu vi vòng đầu của bạn qua trán và đến điểm sau
                            đầu nơi bạn
                            muốn đội mũ.</p>
                    </div>
                    <img src="https://cdn.shopify.com/s/files/1/0639/6189/1038/files/mens-body-size-chart-new.png?v=1697103376"
                        alt="Men's Body Size Chart" class="size-guide-image-right">
                </div>
                <img src="https://cdn.shopify.com/s/files/1/0639/6189/1038/files/popup-men-head-1.png?v=1662724370"
                    alt="Men's Body Size Guide" class="size-guide-image-left">
            </div>





            <!-- Bảng Số Đo Trang Phục -->
            <h2 class="section-title">Bảng Số Đo Trang Phục</h2>
            <p><strong>Số đo ngực, eo và hông là một nửa chu vi</strong></p>
            <table>
                <thead>

                    <tr class="custom-row">
                        <td></td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    X
                                </font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    S
                                </font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    M
                                </font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    L
                                </font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    XL
                                </font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    2XL
                                </font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    3XL
                                </font>
                            </font>
                        </td>
                    </tr>
                    
                    <tr class="hidden">
                        <td></td>

                        <td :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'" class="table-cell">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    TRONG
                                </font>
                            </font>
                        </td>
                        <td :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'" class="hidden">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    CM
                                </font>
                            </font>
                        </td>

                        <td :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'" class="table-cell">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    TRONG
                                </font>
                            </font>
                        </td>
                        <td :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'" class="hidden">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    CM
                                </font>
                            </font>
                        </td>

                        <td :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'" class="table-cell">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    TRONG
                                </font>
                            </font>
                        </td>
                        <td :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'" class="hidden">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    CM
                                </font>
                            </font>
                        </td>

                        <td :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'" class="table-cell">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    TRONG
                                </font>
                            </font>
                        </td>
                        <td :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'" class="hidden">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    CM
                                </font>
                            </font>
                        </td>

                        <td :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'" class="table-cell">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    TRONG
                                </font>
                            </font>
                        </td>
                        <td :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'" class="hidden">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    CM
                                </font>
                            </font>
                        </td>

                        <td :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'" class="table-cell">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    TRONG
                                </font>
                            </font>
                        </td>
                        <td :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'" class="hidden">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    CM
                                </font>
                            </font>
                        </td>

                        <td :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'" class="table-cell">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    TRONG
                                </font>
                            </font>
                        </td>
                        <td :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'" class="hidden">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    CM
                                </font>
                            </font>
                        </td>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Đường tròn</font>
                            </font>
                        </td>


                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">21,5</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">54,5</font>
                            </font>
                        </td>


                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">22.0</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">56</font>
                            </font>
                        </td>


                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">22,8</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">58</font>
                            </font>
                        </td>

                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">23.2</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">59</font>
                            </font>
                        </td>


                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">23,6</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">60</font>
                            </font>
                        </td>

                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">24,4</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">62</font>
                            </font>
                        </td>

                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">25.2</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">64</font>
                            </font>
                        </td>
                    </tr>

                    <tr>

                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Chiều cao</font>
                            </font>
                        </td>


                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">3.1</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">8</font>
                            </font>
                        </td>


                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">3.1</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">8</font>
                            </font>
                        </td>

                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">3.1</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">8</font>
                            </font>
                        </td>


                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">3.1</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">8</font>
                            </font>
                        </td>

                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">3.1</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">8</font>
                            </font>
                        </td>



                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">3.1</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">8</font>
                            </font>
                        </td>


                        <td class="text-[1rem] table-cell" :class="unitsShow == 'inch' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">3.1</font>
                            </font>
                        </td>
                        <td class="text-[1rem] hidden" :class="unitsShow == 'cm' ? 'table-cell' : 'hidden'">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">8</font>
                            </font>
                        </td>

                    </tr>

                </tbody>
            </table>
            <div class="content-image">
                <div class="content">
                    <h3>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">CÁCH ĐO SỐ ĐẠI QUẦN ÁO CỦA KUFIS</font>
                        </font>
                    </h3>
                    <p>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Lấy một chiếc mũ mà bạn đã sở hữu. Sử dụng một thước
                                dây mềm, đo các số đo sau: </font>
                        </font><br><br><strong>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Tổng chu vi: :</font>
                            </font>
                        </strong>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;"> Sử dụng một thước dây mềm, theo đường cong của mũ
                                xung quanh toàn bộ chu vi của nó </font>
                        </font><br>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">(tức là xung quanh mũ). Đảm bảo bạn giữ chặt thước
                                dây vào mũ. </font>
                        </font><br><br>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Các phép đo mũ rất chính xác. Chỉ có sự khác biệt
                                1,5 cm giữa mỗi kích thước SHUKR, vì vậy điều quan trọng là phải cẩn thận </font>
                        </font><br>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">khi đo mũ của bạn.</font>
                        </font>
                    </p>
                </div>
                <div class="image">
           
                
                    <!-- Hiển thị nút mở modal ở chế độ desktop -->
                    <span class="video-link hidden lg:block" id="open-video-modal">
                        Xem Video Hướng Dẫn
                    </span>
                
                    <!-- Hình ảnh -->
                    <img src="https://cdn.shopify.com/s/files/1/0639/6189/1038/files/garment-measurements-hats-no-border.jpg?v=1697105420"
                        alt="">
                
                    <!-- Modal Video -->
                    <div id="video-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <div class="bg-white p-4 rounded-lg w-11/12 max-w-3xl">
                            <button id="close-video-modal" class="absolute top-4 right-4 text-black text-xl font-bold">×</button>
                            <video controls class="w-full">
                                <source src="https://cdn.shopify.com/videos/c/o/v/48f197cb4e854b3fa1eb66fcd02ae7dd.mp4" type="video/mp4">
                                Trình duyệt của bạn không hỗ trợ phát video.
                            </video>
                        </div>
                    </div>
                </div>
                
            </div>

            <p class="note">Lưu ý: Nếu bạn không chắc chắn về kích thước của mình, vui lòng tham khảo thêm các thông
                số kỹ thuật của sản phẩm hoặc liên hệ với chúng tôi để được hỗ trợ thêm.</p>


        </div>
    </div>


    <script>
        // Lấy phần tử modal và nút đóng
        const modal = document.getElementById('sizeGuideModal');
        const btnSizeGuide = document.getElementById('btnSizeGuide');
        const closeModal = document.getElementById('closeModal');

        // Khi người dùng nhấn nút "Hướng Dẫn Kích Thước", modal sẽ hiện lên
        btnSizeGuide.onclick = function() {
            modal.style.display = 'flex'; // Hiển thị modal
        }

        // Khi người dùng nhấn vào nút đóng (X), modal sẽ ẩn đi
        closeModal.onclick = function() {
            modal.style.display = 'none'; // Ẩn modal
        }

        // Khi người dùng nhấn ra ngoài modal (background), modal cũng sẽ ẩn đi
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = 'none'; // Ẩn modal
            }
        }


        // Lấy các phần tử
const openModalBtn = document.getElementById('open-video-modal');
const closeModalBtn = document.getElementById('close-video-modal');
const videoModal = document.getElementById('video-modal');

// Mở modal
openModalBtn.addEventListener('click', () => {
    videoModal.classList.remove('hidden');
});

// Đóng modal
closeModalBtn.addEventListener('click', () => {
    videoModal.classList.add('hidden');
});

// Đóng modal khi click ra ngoài
videoModal.addEventListener('click', (e) => {
    if (e.target === videoModal) {
        videoModal.classList.add('hidden');
    }
});

    </script>

</body>

</html>

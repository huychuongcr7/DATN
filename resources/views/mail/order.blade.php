<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Simple Transactional Email</title>
    <style>
        /* -------------------------------------
            GLOBAL RESETS
        ------------------------------------- */

        /*All the styling goes here*/

        img {
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 100%;
        }

        body {
            background-color: #f6f6f6;
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%;
        }

        table td {
            font-family: sans-serif;
            font-size: 14px;
            vertical-align: top;
            line-height: 200%;
        }

        /* -------------------------------------
            BODY & CONTAINER
        ------------------------------------- */

        .body {
            background-color: #f6f6f6;
            width: 100%;
        }

        /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
        .container {
            display: block;
            margin: 0 auto !important;
            /* makes it centered */
            max-width: 580px;
            padding: 10px;
            width: 580px;
        }

        /* This should also be a block element, so that it will fill 100% of the .container */
        .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 580px;
            padding: 10px;
        }

        /* -------------------------------------
            HEADER, FOOTER, MAIN
        ------------------------------------- */
        .main {
            background: #ffffff;
            border-radius: 3px;
            width: 100%;
        }

        .wrapper {
            box-sizing: border-box;
            padding: 20px;
        }

        .content-block {
            padding-bottom: 10px;
            padding-top: 10px;
        }

        .footer {
            clear: both;
            margin-top: 10px;
            text-align: center;
            width: 100%;
        }

        .footer td,
        .footer p,
        .footer span,
        .footer a {
            color: #999999;
            font-size: 12px;
            text-align: center;
        }

        /* -------------------------------------
            TYPOGRAPHY
        ------------------------------------- */
        h1,
        h2,
        h3,
        h4 {
            color: #000000;
            font-family: sans-serif;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 35px;
            font-weight: 300;
            text-align: center;
            text-transform: capitalize;
        }

        p,
        ul,
        ol {
            font-family: sans-serif;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 15px;
        }

        p li,
        ul li,
        ol li {
            list-style-position: inside;
            margin-left: 5px;
        }

        a {
            color: #3498db;
            text-decoration: underline;
        }

        /* -------------------------------------
            BUTTONS
        ------------------------------------- */
        .btn {
            box-sizing: border-box;
            width: 100%;
        }

        .btn > tbody > tr > td {
            padding-bottom: 15px;
        }

        .btn table {
            width: auto;
        }

        .btn table td {
            background-color: #ffffff;
            border-radius: 5px;
            text-align: center;
        }

        .btn a {
            background-color: #ffffff;
            border: solid 1px #3498db;
            border-radius: 5px;
            box-sizing: border-box;
            color: #3498db;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            padding: 12px 25px;
            text-decoration: none;
            text-transform: capitalize;
        }

        .btn-primary table td {
        }

        .btn-primary a {
            background-color: #3498db;
            border-color: #3498db;
            color: #ffffff;
        }

        /* -------------------------------------
            OTHER STYLES THAT MIGHT BE USEFUL
        ------------------------------------- */
        .last {
            margin-bottom: 0;
        }

        .first {
            margin-top: 0;
        }

        .align-center {
            text-align: center;
        }

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .clear {
            clear: both;
        }

        .mt0 {
            margin-top: 0;
        }

        .mb0 {
            margin-bottom: 0;
        }

        .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0;
        }

        .powered-by a {
            text-decoration: none;
        }

        hr {
            border: 0;
            border-bottom: 1px solid #f6f6f6;
            margin: 20px 0;
        }

        /* -------------------------------------
            RESPONSIVE AND MOBILE FRIENDLY STYLES
        ------------------------------------- */
        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }

            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
                font-size: 16px !important;
            }

            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important;
            }

            table[class=body] .content {
                padding: 0 !important;
            }

            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
            }

            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }

            table[class=body] .btn table {
                width: 100% !important;
            }

            table[class=body] .btn a {
                width: 100% !important;
            }

            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }

        /* -------------------------------------
            PRESERVE THESE STYLES IN THE HEAD
        ------------------------------------- */
        @media all {
            .ExternalClass {
                width: 100%;
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }

            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }

            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }

            .btn-primary table td:hover {
                background-color: #adbac8 !important;
            }

            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }
        }

        body {
            margin: 0;
        }


        .img-container {
            text-align: center;
            display: block;
        }
    </style>
</head>
<body class="">
<span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td>&nbsp;</td>
        <td class="container">
            <div class="content">

                <!-- START CENTERED WHITE CONTAINER -->
                <table role="presentation" class="main">

                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                        <td class="wrapper">
                            <div>

                                <div style="text-align: left ; display: inline-block; display: inline;">

                                    <h1 style="font-size: 450%">
                                        <a href="https://www.facebook.com/chuong.dhcr7"><img src="https://i.ibb.co/m5cDQ8h/logo1.png" width="200px" style="width:75px; height:75px;" alt="logo1" border="0"></a>
                                        CR7 Store<br>
                                        <q style="font-size: 50%">realize your dream</q>
                                    </h1>
                                </div>
                            </div>
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <p>Xin chào {{ $order->customer->name }},</p>
                                        @if($order->status == 1)
                                            <p>Chúng tôi gửi thông tin đơn hàng mà bạn đã đặt tại cửa hàng chúng tôi.
                                                Xin hãy kiểm tra lại thông tin và báo lại cho quản trị viên nếu có bất kì điều gì sai lệch.</p>

                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                                                   class="btn btn-primary">
                                                <tbody>
                                                <tr>
                                                    <td align="left">
                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                            <tr>
                                                                <th align="left" width="50%">Tên khách hàng:</th>
                                                                <td align="left" width="50%">{{ $order->customer->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th align="left">Số điện thoại:</th>
                                                                <td align="left">{{ $order->customer->phone }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th align="left">Địa chỉ:</th>
                                                                <td align="left">{{ $order->customer->address }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th align="left">Ghi chú</th>
                                                                <td align="left">{{ $order->note }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th align="left">Trạng thái:</th>
                                                                <td align="left" style="@if($order->status == 1)  color: red @else color: #4F8A10 @endif">{{ \App\Models\Bill::$statuses[$order->status] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th align="left">Ngày đặt hàng:</th>
                                                                <td align="left">{{ $order->created_at }}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div>
                                                <h4>Đơn hàng chi tiết</h4>
                                            </div>
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th align="left">Tên sản phẩm</th>
                                                    <th align="center">Đơn giá</th>
                                                    <th align="center">Số lượng</th>
                                                    <th align="right">Thành tiền</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($order->billProducts()->get() as $key => $value)
                                                    <tr>
                                                        @php($product = $value->product)
                                                        <td>{{ $key + 1 }}</td>
                                                        <td align="left">{{ $product->name }}</td>
                                                        <td align="left">{{ App\Helper\Helper::formatMoney($product->sale_price) }} VNĐ</td>
                                                        <td align="center">{{ $value->quantity }}</td>
                                                        <td align="right">{{ App\Helper\Helper::formatMoney($value->quantity * $product->sale_price) }} VNĐ</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" align="left"><h3><b>Thanh toán: </b></h3></td>
                                                    <td colspan="3" align="right">
                                                        <h4><b>{{ App\Helper\Helper::formatMoney($order->total_money) }} VNĐ</b></h4>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @elseif($order->status == App\Models\Bill::STATUS_CONFIRM)
                                            <p>Đơn hàng của bạn đã được xác nhận và sẽ được chuyển cho người giao hàng. Vui lòng chờ đợi.</p>
                                        @elseif($order->status == App\Models\Bill::STATUS_DELIVERY)
                                            <p>Đơn hàng của bạn đang trong quá trình vận chuyển. Bạn sẽ nhận được hàng trong vòng 2 ngày tới.</p>
                                        @elseif($order->status == App\Models\Bill::STATUS_COMPLETE)
                                            <p>Đơn hàng của bạn đã hoàn tất. Cảm ơn bạn đã mua hàng tại CR7 Store. Rất mong bạn luôn ủng hộ của hàng.</p>
                                        @elseif($order->status == App\Models\Bill::STATUS_CANCEL)
                                            <div id="over" style="text-align: left; width: 100%">
                                                <h4 style="color: red;"><b>Đơn hàng của bạn đã bị hủy</b></h4>
                                                <p><b style="color: red;">Lí do: </b><u>{{ $reason }}</u></p>
                                            </div>
                                        @endif
                                        <p>Đây là thư gửi tự động, vui lòng không gửi thư đến địa chỉ này.</p>
                                        <p>Cảm ơn vì đã mua hàng của chúng tôi.</p>
                                    </td>
                                </tr>
                            </table>

                        </td>

                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>
                <!-- END CENTERED WHITE CONTAINER -->

                <!-- START FOOTER -->
                <div class="footer">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-block">
                                <span class="apple-link">288A Giải Phóng, Phương Liệt, Thanh Xuân, Hà Nội</span><br>
                                <span class="apple-link">0326175823</span>
                                <br> Don't like these emails? <a href="#">Unsubscribe</a>.
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block powered-by">
                                Powered by <a href="http://htmlemail.io">HTMLemail</a>.
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- END FOOTER -->

            </div>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html>

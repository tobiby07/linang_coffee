<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Linag Kopi</title>

    <style>
        @media print {
            .page-break {
                display: block;
                page-break-before: always;
            }
        }

        #invoice-POS {
            padding: 2mm;
            margin: 0 auto;
            width: 44mm;
        }

        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
        }

        #invoice-POS h2 {
            font-size: 0.9em;
        }

        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        #invoice-POS p {
            font-size: 0.7em;
            color: #666;
            line-height: 1.2em;
        }

        #invoice-POS #top,
        #invoice-POS #mid,
        #invoice-POS #bot {
            border-bottom: 1px solid #eee;
        }

        #invoice-POS #top {
            min-height: 50px;
        }

        #invoice-POS #mid {
            min-height: 0px;
        }

        #invoice-POS #bot {
            min-height: 50px;
        }

        #invoice-POS #top .logo {
            width: 40px;
            height: 40px;
            background-size: 40px 40px;
        }

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title {
            float: right;
        }

        #invoice-POS .title p {
            text-align: right;
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.7em;
        }

        #invoice-POS .tabletitle {
            font-size: 0.5em;
            background: #eee;
        }

        #invoice-POS .service {
            border-bottom: 1px solid #eee;
        }

        #invoice-POS .item {
            width: 18mm;
        }

        #invoice-POS .itemtext {
            font-size: 0.5em;
        }

        #invoice-POS .alamat {
            font-size: 0.6em;
        }

        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }
    </style>

    <script>
        window.console = window.console || function(t) {};
    </script>

    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }

        function redirectAfterPrint() {
            // Check if JavaScript is disabled
            if (typeof window.onafterprint !== 'function') {
                // If disabled, use a meta refresh tag for fallback
                const redirectMeta = document.createElement('meta');
                redirectMeta.httpEquiv = 'refresh';
                redirectMeta.content = '0;url={{ route('kasir') }}';
                document.head.appendChild(redirectMeta);
            } else {
                window.onafterprint = function() {
                    window.location.href = "{{ route('kasir') }}";
                };
            }
        }
    </script>
</head>

<body translate="no" onload="window.print()">
    <div class="">
        <div id="invoice-POS">
            <center id="top">
                <center><img src="assets/images/black.png" style="max-width: 3rem"></center>
                <div class="alamat">
                    <p>
                        Jl. DR. Sutomo No.3, Sananwetan, Kec. Sananwetan, Kota
                        Blitar, Jawa Timur 66137
                    </p>
                    <p>WA.0895-3664-98570</p>
                </div>
            </center>

            <div id="top">
                <div class="alamat">
                    <center>
                        <p>Bill</p>
                        <p>{{ $transaction->created_at }}</p>
                        <p style="text-transform: capitalize">Kasir : {{ $transaction->user->name }}</p>
                    </center>
                </div>
            </div>

            <div id="bot">
                <div id="table">
                    <table>
                        <tr class="tabletitle">
                            <td class="item">
                                <h2>Menu</h2>
                            </td>
                            <td class="Hours">
                                <h2>Qty</h2>
                            </td>
                            <td class="Rate">
                                <h2>Price</h2>
                            </td>
                            <td class="Rate">
                                <h2>Sub Total</h2>
                            </td>
                        </tr>
                        @foreach ($cart as $id => $details)
                            <tr class="service">
                                <td class="tableitem">
                                    <p class="itemtext">{{ $details['name'] }}</p>
                                </td>
                                <td class="tableitem">
                                    <p class="itemtext">{{ $details['quantity'] }}</p>
                                </td>
                                <td class="tableitem">
                                    <p class="itemtext">{{ $details['price'] }}</p>
                                </td>
                                <td class="tableitem">
                                    <p class="itemtext">{{ $details['price'] * $details['quantity'] }}</p>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td class="Rate">
                                <h2>Total</h2>
                            </td>
                            <td class="payment">
                                <h2>Rp. {{ $transaction->total }}</h2>
                            </td>
                            <p>Amount Paid: Rp.{{ $transaction->amount_paid }}</p>
                            <p>Change: Rp.{{ $transaction->change }}</p>
                        </tr>
                    </table>
                </div>
                <!--End Table-->
                <div class="alamat">
                    <center>
                        <p>
                            <strong>Terimakasih Telah Berbelanja!</strong>
                            Barang yang sudah dibeli tidak dapat dikembalikan.
                            Jangan lupa berkunjung kembali
                        </p>
                        <p>Password Wifi : temanpulang12</p>
                    </center>
                </div>
                <!--End Info-->
            </div>
            <!--End InvoiceBot-->
        </div>
    </div>
    <!--End Invoice-->
</body>

</html>

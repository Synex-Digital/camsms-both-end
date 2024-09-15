<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <img src="{{ asset('logo.jpg') }}" alt="Synex Digital" width="200" />
            </td>
            <td class="w-half">
                <h2>Data: {{ $data['invoice_date'] }}</h2>
                <h2>Invoice ID: {{ $data['invoice_number'] }}</h2>
            </td>
        </tr>
    </table>
 
    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><h4>To:</h4></div>
                    <div>{{ $invoice_download['contact_name'] }}</div>
                    <div>{{ $invoice_download['contact_number'] }}</div>
                    <div>{{ $invoice_download['contact_email'] }}</div>
                </td>
                <td class="w-half">
                    <div><h4>From:</h4></div>
                    <div>{{ $invoice_download['user_name'] }}</div>
                    <div>London</div>
                </td>
            </tr>
        </table>
    </div>
 
    <div class="margin-top">
        <table class="products">
            <tr>
                <th>Amount</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
            <tr class="items">
                @foreach($data as $item)
                    <td>
                        {{ $item['amount'] }}
                    </td>
                    <td>
                        {{ $item['note'] }}
                    </td>
                    <td>
                        {{ $item['status'] }}
                    </td>
                @endforeach
            </tr>
        </table>
    </div>
 
    <div class="total">
        Total: {{ $data['amount'] }} TK.
    </div>
 
    <div class="footer margin-top">
        <div>Thank you</div>
        <div>&copy; Synex Digital</div>
    </div>
</body>
</html>
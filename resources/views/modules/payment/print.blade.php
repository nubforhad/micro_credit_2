<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial, Helvetica, sans-serif;
            background:#f5f5f5;
            padding:20px;
        }

        .receipt{

            width:850px;
            margin:auto;
            background:#fff;
            border:2px solid #222;
            padding:30px;

        }

        .header{

            display:flex;
            justify-content:space-between;
            align-items:center;
            border-bottom:2px dashed #777;
            padding-bottom:20px;
            margin-bottom:20px;

        }

        .logo{

            width:80px;
            height:80px;
            border:2px solid #555;
            display:flex;
            justify-content:center;
            align-items:center;
            font-weight:bold;

        }

        .company{

            text-align:center;
            flex:1;

        }

        .company h2{

            margin-bottom:8px;

        }

        .company p{

            font-size:14px;
            color:#666;

        }

        .receipt-title{

            text-align:center;
            margin:20px 0;

        }

        .receipt-title h3{

            display:inline-block;
            border:1px solid #000;
            padding:8px 25px;

        }

        table{

            width:100%;
            border-collapse:collapse;
            margin-bottom:20px;

        }

        table td{

            border:1px solid #ddd;
            padding:10px;

        }

        .section{

            background:#f0f0f0;
            font-weight:bold;

        }

        .amount{

            text-align:center;
            padding:25px;
            background:#eef8ee;
            border:2px dashed green;
            margin:25px 0;

        }

        .amount h1{

            color:green;
            font-size:40px;

        }

        .footer{

            margin-top:60px;
            display:flex;
            justify-content:space-between;

        }

        .sign{

            width:220px;
            text-align:center;

        }

        .sign hr{

            margin-bottom:8px;

        }

        .print-btn{

            text-align:center;
            margin-top:25px;

        }

        .print-btn button{

            padding:10px 30px;
            background:#0d6efd;
            color:#fff;
            border:none;
            cursor:pointer;
            border-radius:5px;

        }

        @media print{

            body{

                background:#fff;
                padding:0;

            }

            .receipt{

                width:100%;
                border:none;

            }

            .print-btn{

                display:none;

            }

        }

    </style>

</head>

<body>

<div class="receipt">

    <div class="header">

        <div class="logo">

            LOGO

        </div>

        <div class="company">

            <h2>MICRO CREDIT ERP</h2>

            <p>Your Company Name</p>

            <p>Dhaka, Bangladesh</p>

            <p>Phone : 01XXXXXXXXX</p>

        </div>

        <div>

            <strong>Receipt</strong>

        </div>

    </div>

    <div class="receipt-title">

        <h3>LOAN PAYMENT RECEIPT</h3>

    </div>

    <table>

        <tr class="section">

            <td colspan="4">Receipt Information</td>
        </tr>

        <tr>

            <td><b>Receipt No</b></td>

            <td>{{ $payment->receipt_no }}</td>

            <td><b>Date</b></td>

            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</td>

        </tr>

    </table>


    <table>

        <tr class="section">

            <td colspan="4">Member Information</td>

        </tr>

        <tr>

            <td><b>Member No</b></td>

            <td>{{ $payment->member->member_no }}</td>

            <td><b>Name</b></td>

            <td>{{ $payment->member->name }}</td>

        </tr>

        <tr>

            <td><b>Loan No</b></td>

            <td>{{ $payment->loan->loan_no }}</td>

            <td><b>Installment</b></td>

            <td>#{{ $payment->installment->installment_no }}</td>

        </tr>

    </table>

    <table>

        <tr class="section">

            <td colspan="4">Payment Details</td>

        </tr>

        <tr>

            <td><b>Payment Method</b></td>

            <td>{{ $payment->payment_method }}</td>

            <td><b>Collected By</b></td>

            <td>{{ $payment->receiver->name ?? '-' }}</td>

        </tr>

        <tr>

            <td><b>Note</b></td>

            <td colspan="3">

                {{ $payment->note ?? 'N/A' }}

            </td>

        </tr>

    </table>

    <div class="amount">

        <p>Received Amount</p>

        <h1>

            ৳ {{ number_format($payment->amount,2) }}

        </h1>

    </div>

    <div class="footer">

        <div class="sign">

            <hr>

            Customer Signature

        </div>

        <div class="sign">

            <hr>

            Authorized Signature

        </div>

    </div>

</div>

<div class="print-btn">

    <button onclick="window.print()">

        Print Receipt

    </button>

</div>

<script>

window.onload=function(){

    window.print();

}

</script>

</body>

</html>
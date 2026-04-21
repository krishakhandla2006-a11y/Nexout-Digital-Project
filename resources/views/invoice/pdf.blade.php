<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice - {{ $invoice->invoice_no }}</title>
    <style>
        @page { margin: 15px; }
        body { 
            font-family: 'DejaVu Sans', sans-serif; 
            font-size: 11px; 
            margin: 0; 
            padding: 0; 
            color: #000; 
        }
        .invoice-box { 
            border: 1px solid #000; 
            width: 100%; 
            min-height: 980px; 
            position: relative;
        }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        td, th { border: 1px solid #000; padding: 6px; vertical-align: top; }

        /* Header Styles */
        .company-name { font-size: 13px; font-weight: bold; margin-bottom: 2px; }
        .company-details { font-size: 10px; line-height: 1.4; }
        .invoice-label { 
            font-size: 18px; 
            font-weight: bold; 
            text-align: center; 
            background-color: #f2f2f2;
            padding: 8px;
            border-bottom: 1px solid #000;
        }

        /* Buyer Section */
        .buyer-label { font-size: 10px; color: #555; font-style: italic; display: block; margin-bottom: 3px; }
        .buyer-name { font-size: 12px; font-weight: bold; text-transform: uppercase; }

        /* Items Table */
        .items-table th { background-color: #f9f9f9; font-size: 10px; text-align: center; }
        .items-table td { border-bottom: none; border-top: none; }
        .description-box { min-height: 550px; } /* આ ખાલી જગ્યા જાળવી રાખશે */

        /* Total Section */
        .total-row td { border-top: 1px solid #000; border-bottom: 1px solid #000; font-weight: bold; }
        
        /* Footer Section */
        .footer-table td { border: 1px solid #000; height: 80px; }
        .sign-area { text-align: center; vertical-align: bottom; padding-bottom: 10px; }
        .final-footer { 
            position: absolute; 
            bottom: -15px; 
            width: 100%; 
            text-align: center; 
            font-size: 9px; 
            color: #777; 
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <table>
        <tr>
            <td width="55%" style="border-top: none; border-left: none;">
                <div class="company-name">NEXOUT DIGITAL</div>
                <div class="company-details">
                    A-211, SUPATH-II, NR OLD WADAJ BUS STOP,<br>
                    ASHRAM ROAD, AHMEDABAD-380013<br>
                    <strong>Contact :</strong> 70413 83645<br>
                    <strong>E-Mail :</strong> info@nexoutdigital.com
                </div>
            </td>
            <td width="45%" style="padding: 0; border-top: none; border-right: none;">
                <div class="invoice-label">INVOICE</div>
                <table style="border: none;">
                    <tr>
                        <td style="border: none; font-weight: bold; width: 40%;">Invoice No.</td>
                        <td style="border: none; border-left: 1px solid #000;">{{ $invoice->invoice_no }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; border-top: 1px solid #000; font-weight: bold;">Dated</td>
                        <td style="border: none; border-left: 1px solid #000; border-top: 1px solid #000;">{{ date('d-M-y') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border-left: none; border-right: none; height: 60px;">
                <span class="buyer-label">Buyer (Bill to)</span>
                <div class="buyer-name">{{ $invoice->client->name }}</div>
                <div style="margin-top: 3px;">{{ $invoice->client->address ?? 'Address not provided' }}</div>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th width="8%">Sr. No.</th>
                <th width="72%">Particulars</th>
                <th width="20%">Amount (₹)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center" style="height: 550px; border-left: none;">1</td>
                <td>
                    <div style="font-weight: bold; margin-bottom: 5px;">{!! nl2br(e($invoice->description)) !!}</div>
                    <div style="font-size: 10px; color: #444;">
                        Being the Charges for services rendered<br>
                        <strong>Period:</strong> {{ date('M-Y') }}
                    </div>
                    <div class="description-box"></div>
                </td>
                <td align="right" style="font-weight: bold; border-right: none;">
                    ₹ {{ number_format($invoice->amount, 2) }} <br>
                    <span style="font-weight: normal; font-size: 9px;">Rupees Only</span>
                </td>
            </tr>
            <tr class="total-row">
                <td style="border-left: none;"></td>
                <td align="right">Total</td>
                <td align="right" style="border-right: none;">₹ {{ number_format($invoice->amount, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="footer-table" style="border: none;">
        <tr>
            <td width="60%" style="border-left: none; border-top: none;">
                <strong>Amount Chargeable (in words)</strong><br>
                <span style="text-transform: capitalize; font-style: italic; font-size: 10px;">
                    Indian Rupees {{ $invoice->total_in_words ?? 'As Per Total Amount' }} Only
                </span>
            </td>
            <td width="40%" rowspan="2" class="sign-area" style="border-right: none; border-top: none;">
                <span style="font-size: 10px;">for <strong>NEXOUT DIGITAL</strong></span><br><br><br><br>
                <strong>Authorised Signatory</strong>
            </td>
        </tr>
        <tr>
            <td style="border-left: none; border-bottom: none; vertical-align: bottom;">
                <span style="font-style: italic; color: #555;">Thank you for your business!</span>
            </td>
        </tr>
    </table>

    <div class="final-footer">This is a Computer Generated Invoice</div>
</div>

</body>
</html>
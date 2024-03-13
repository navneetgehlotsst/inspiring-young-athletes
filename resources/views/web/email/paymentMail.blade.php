<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;">
    <tbody>
        <tr>
            <td align="left" style="">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin:0;padding:0;width:100%">
                    <tbody>
                        <tr>
                            <td width="100%" cellpadding="0" cellspacing="0" style="">
                                <table align="left" cellpadding="0" cellspacing="0" role="presentation">
                                    <tbody>
                                        <tr align="left">
                                            <td align="left">
                                                @if($exists)
                                                    <p>Plan have been upgrade successfully.</p>
                                                @else
                                                    <p>Plan have been purchased successfully.</p>
                                                @endif
                                                <h5>Your plan detail is below:</h5>
                                                <p>Plan Name: {{$data['plan']}}</p>
                                                <p>Plan Price: {{ ($data['amount']) ? '$'.$data['amount'] : '' }}</p>
                                                <p>Total Offer: {{$data['total_offer']}}</p>
                                                <p>Plan Expiry Date: {{ date('d M,Y',strtotime($data['expiry_date'])) }}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
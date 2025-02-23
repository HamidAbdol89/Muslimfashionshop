<!DOCTYPE html> 
<html> 
 
<head> 
    <title>{{ config('app.name') }}</title> 
    <meta charset="utf-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
    <meta name="color-scheme" content="light" /> 
    <meta name="supported-color-schemes" content="light" /> 
    <style> 
        @media only screen and (max-width: 600px) { 
            .inner-body { 
                width: 98% !important; 
            } 
            .footer { 
                width: 98% !important; 
            } 
        } 
         
        @media only screen and (max-width: 500px) { 
            .button { 
                width: 100% !important; 
            } 
        } 
    </style> 
</head> 
 
<body> 
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation"> 
        <tr> 
            <td align="center"> 
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation"> 
                    {{ $header ?? '' }} 
                     
                    <!-- Email Body --> 
                    <tr> 
                        <td class="body" width="100%" cellpadding="0" cellspacing="0"> 
                            <table class="inner-body" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation"> 
                                <!-- Body content --> 
                                <tr> 
                                    <td class="content-cell"> 
                                        {{ Illuminate\Mail\Markdown::parse($slot) }} 
                                         
                                        {{ $subcopy ?? '' }} 
                                    </td> 
                                </tr> 
                            </table> 
                        </td> 
                    </tr> 
                     
                    {{ $footer ?? '' }} 
                </table> 
            </td> 
        </tr> 
    </table> 
</body> 
 
</html>
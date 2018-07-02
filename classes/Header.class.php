<?php

class Header{

    public static function addHeader($title,$body){

        $headerTitle = "<title>$title</title>";
        $closeeader = "</head>";

        $headerTitle = "<title>$title</title>";
        $closeheader = "</head>";
        $body = "<body class=\"$body\">";

        $header1 = "
            <!DOCTYPE html>
            <html lang=\"en\">
            <head>
                <meta charset=\"UTF-8\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        ";

        $header2 = "
                <link rel=\"shortcut icon\" href=\"favicon.ico\" type=\"image/x-icon\">
                <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
            
                <!-- Latest compiled and minified CSS -->
                <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" integrity=\"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u\" crossorigin=\"anonymous\">
            
                <!-- Optional theme -->
                <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css\" integrity=\"sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp\" crossorigin=\"anonymous\">
            
                <!-- Latest compiled and minified JavaScript -->
                <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\" integrity=\"sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa\" crossorigin=\"anonymous\"></script>
            
                <link href=\"https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=latin-ext\" rel=\"stylesheet\">
                <link rel=\"stylesheet\" href=\"css/style.css\" type=\"text/css\">
        ";


        echo $header1 . $headerTitle . $header2 . $closeheader . $body;
    }

}
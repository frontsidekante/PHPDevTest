<?php
// author: Vicky
// http://codular.com/curl-with-php
    if (!isset($_POST['submit'])) {
        ?>

        <html>
            <body>
                <form action="urlrequest.php" method="post">
            City: <input type="text" name="name"><br>
                <input type="submit" name="submit" value="Submit">
                </form>
            </body>
        </html>

    <?php
    } else {
        // returns a cURL resource, takes URL as parameter


        $curl = curl_init();
        // SETTING URL
        //curl_setopt($curl, CURLOPT_URL, 'http://api.goeuro.com/api/v2/position/suggest/en/berlin');

        // SETTING MORE VALUES
        curl_setopt_array($curl, array(
        // RETURNS RESPONSE AS STRING INSTEAD OF OUTPUTTING IT ON THE SCREEN
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://api.goeuro.com/api/v2/position/suggest/en/' . $_POST["name"]
        ));

        //echo $curl;

        // EXECUTES CURL-REQUEST
        $result = curl_exec($curl);


        // CREATES FILE
        $city = fopen(__DIR__ . "/.." . "/output/" . $_POST["name"] . ".txt", "w") or die("Unable to open file");

        // fwrite(RESOURCE, STRING)
        fwrite($city, $result);
        fclose($city);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=" . $_POST["name"] . ".csv");

        //echo $result;
        //echo gettype($result);

        // CLOSES CURL REQUEST
        curl_close($curl);
    }
?>
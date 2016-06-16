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
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=' . $_POST["name"] . '.csv');
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

        // EXECUTES CURL-REQUEST
        $result = curl_exec($curl); // type -> string

        $arrayResult = json_decode($result,true);

        // TURN RESULT INTO CSV RESULT
        $csvResult = "";
        $csvResult .= "_id;name;type;latitude;longitude" . ";" . "\n";
        foreach($arrayResult as $location) {

            $csvResult .= ($location["_id"] . ";");
            $csvResult .= ($location["name"] . ";");
            $csvResult .= ($location["type"] . ";");
            $csvResult .= ($location["geo_position"]["latitude"] . ";");
            $csvResult .= ($location["geo_position"]["longitude"] . ";" . "\n");
        }

        echo $csvResult;
        // CLOSES CURL REQUEST
        curl_close($curl);
    }
?>
<?php

function checkUrlSafety($apiKey, $url) {
    $apiUrl = "https://www.virustotal.com/vtapi/v2/url/report";
    $params = array(
        "apikey" => $apiKey,
        "resource" => $url
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiUrl . "?" . http_build_query($params));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $response = json_decode($response, true);

    if ($response && isset($response['positives']) && $response['positives'] > 0) {
        return false;
    } else {
        return true;
    }
}
//example of un-safe url === signin.eby.de.zukruygxctzmmqi.civpro.co.za,br-icloud.com.br
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'fraud_url_db';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$apiKey = "23d52d940ee164262196049d101622485429d6680bc6b1a8c791fdaf4771c399";
$url = $_POST['url'];
$des= $_POST['description'];
echo "<script>alert($url);</script>";
$sql = "SELECT * FROM fraud_urls1 WHERE url='$url'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo '<script>alert("The URL you entered may be fraudulent. Please double check and try again."); window.open("sample.html","_self");</script>';
} else {
    $isSafe = checkUrlSafety($apiKey, $url);
}
if ($isSafe) {
    echo '<script>alert("The URL you entered is safe."); window.open("sample.html","_self");</script>';
} else {
    $sql = "INSERT INTO fraud_urls1 (url, description) VALUES ('$url', '$des')";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("The URL you entered is unsafe."); window.open("sample.html","_self");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
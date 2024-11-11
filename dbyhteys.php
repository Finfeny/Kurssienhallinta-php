<?php     //                            jos haluu PDO
    // $host="localhost";
    // $user="root";
    // $password="";
    // $db="kurssienhallinta";
    

    // $conn = new mysqli($host, $user, $password, $db);
    
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
    // //                                                  //      fetchinki on mysqlissä fetch_all eikä fetchall
    // $opiskelijat = $conn->query("SELECT * FROM `opiskelijat`")->fetch_all(MYSQLI_ASSOC);
    // var_dump($opiskelijat);                             //      fetch_assoc() jos haluu fetchaa rivi kerrallaan
    
    // $result = $conn->query("SELECT * FROM `opiskelijat`");
    // $opiskelijat = $result->fetch_all(MYSQLI_ASSOC); // When you want all rows at once
    // // $opiskelijat = $result->fetch_assoc(); //        Use if you're handling large datasets and want to process rows one at a time to conserve memory.
    // var_dump($opiskelijat);
?>

<?php   //                           Jos haluu tehä PDO
    $host="localhost";
    $user="root";
    $password="";
    $db="kurssienhallinta";

    try {
        $conn = new PDO("mysql:host=$host; dbname=$db", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // var_dump($conn);

//      kompaktimpi tapa                                    //      fetchinki on PDOssa fetchAll eikä fetch_all
//      $opiskelijat = $conn->query("SELECT * FROM `opiskelijat`")->fetchAll();
//      var_dump($opiskelijat);                             //      fetch(PDO::FETCH_ASSOC); jos haluu fetchaa rivi kerrallaan

//      topin tapa
//      $query = $conn->prepare("SELECT * FROM `opiskelijat`");
//      $query->execute();    
//      var_dump($query->fetchAll())
    }
    catch (PDOException $e) {
        die("Virhe: " . $e->getMessage());
    }

?> 

<!--

Error Handling:

    MySQLi uses procedural or object-oriented style and does not throw exceptions by default unless you explicitly enable it. You typically check for errors manually.
    PDO uses exceptions (try-catch blocks), which makes it easier to handle database errors gracefully. 
    
Connection Handling:

    With MySQLi, you need to manually close the connection using $conn->close().
    With PDO, the connection is automatically closed when the script finishes or when you explicitly set the connection object to null ($conn = null;).
    
-->
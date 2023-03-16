<?php
$servername = "localhost";
$username ="root";
$password="";
$dbname="phptest";
$connect=mysqli_connect($servername,$username,$password,$dbname);
if(mysqli_connect_errno())
{
    echo "falied to connect";
}
echo "server connected";
// if(isset($_POST['name']) && $_POST['name']!='' && isset($_POST['email']) && $_POST['email']!='' && isset($_POST['password']) && $_POST['password']!='' && isset($_POST['mobile']) && $_POST['moblie']!='')
{
    $sql = "INSERT INTO contacts(name,email,password,mobile,age,dob) VALUES('".addslashes($_POST['name'])."' , '".addslashes($_POST['email'])."' , '".addslashes($_POST['password'])."' , '".addslashes($_POST['mobile'])."', '".addslashes($_POST['age'])."' , '".addslashes($_POST['dob'])."' )";
    $connect->query($sql);
}
$uri = 'mongodb+srv://balaji:1234@cluster0.6ywm1tz.mongodb.net/?retryWrites=true&w=majority';
$manager = new MongoDB\Driver\Manager($uri);
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$mobile=$_POST['mobile'];
$age=$_POST['age'];
$dob=$_POST['dob'];
$database = "guviproj";
$collection = "users";
$bulk = new MongoDB\Driver\BulkWrite;
$document = [
    'email' => $email,
    'dob' => $dob,
    'age' => $age,
    'contact'=>$mobile,
    'name'=>$name
];
$bulk = new MongoDB\Driver\BulkWrite;
// Add insert operation to bulk write object
$_id = $bulk->insert($document);
// Create MongoDB write concern object
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 10000);
// Execute bulk write operation
$result = $manager->executeBulkWrite("$database.$collection", $bulk, $writeConcern);
// Print result
printf("Inserted %d document(s)\n", $result->getInsertedCount());
$mongoId = (string)$_id;
printf($mongoId);

?>
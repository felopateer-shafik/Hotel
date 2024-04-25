<?php
class Guest {
    public $id;
    public $name;
    public $no_people;
    public $cont_number;
    public $check_in_date;
    public $check_out_date;
    public $email;
    public $comment;
}

$filename = 'guest_data'; // Changed filename to 'guest_data'

// Load the existing guests from the file
$myArray = file_exists($filename) ? unserialize(file_get_contents($filename)) : array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $check_in_date = $_POST["check_in_date"];
    $check_out_date = $_POST["check_out_date"];
    $email = $_POST["email"];
    $comment = $_POST["comment"];
    $cont_number = $_POST["cont_number"];
    $no_people = $_POST["no_people"];

    // Basic error handling
    if (empty($name) || empty($check_in_date) || empty($check_out_date) || empty($email) || empty($comment) || empty($cont_number) || empty($no_people)) {
        echo "All fields are required.";
        exit();
    }

    // Check if the guest already exists
    foreach ($myArray as $guest) {
        if ($guest->name == $name) {
            echo "Guest already exists.";
            exit();
        }
    }

    $guest = new Guest();
    $guest->name = $name;
    $guest->check_in_date = $check_in_date;
    $guest->check_out_date = $check_out_date;
    $guest->email = $email;
    $guest->comment = $comment;
    $guest->cont_number = $cont_number;
    $guest->no_people = $no_people;
    $guest->id = count($myArray) + 1; // Assign ID to the guest

    $myArray[] = $guest;

    // Save the updated array to the file
    file_put_contents($filename, serialize($myArray));

    echo "Guest added successfully.";
}
?>

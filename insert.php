<?php
$conn = mysqli_connect("localhost", "root", "", "image_view"); 
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}

// Insert image
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) 
{
    $fileName = $_FILES["image"]["name"];
    $tempName = $_FILES["image"]["tmp_name"];
    $folder = "upload/" . $fileName;

    if (move_uploaded_file($tempName, $folder)) 
    {
        $sql = "INSERT INTO gallery (image) VALUES ('$fileName')";

        if (mysqli_query($conn, $sql)) 
        {
            echo"<script>alert('Image uploaded and saved in database!');window.location ='show.php';</script>";
        } 
        else 
        {
            echo"<script>alert('Error:". mysqli_error($conn) ."');window.location ='show.php';</script>";
        }
    }
} 

mysqli_close($conn);
?>
<?php include('header.php'); 

$id = (int)$_GET['id'];

$sql = "SELECT *
FROM `bunnies` 
WHERE id=$id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $bunnyData = $result->fetch_assoc();
}

$errors = array();

if (empty($_POST) === false) {
        $name = $_POST['nameInput'];
        $city = $_POST['cityInput'];
        $email = $_POST['emailInput'];

    if (empty($name)) {
        array_push($errors, 'Please enter your name.');
    }

    if (empty($city)) {
        array_push($errors, 'Please enter your city.');
    }

    if (empty($email)) {
        array_push($errors, 'Please enter your email.');
    }

    if ($bunnyData['customers_id'] !== null) {
        array_push($errors, 'This bunny is already reserved.');
    }
 
}



?>

<div class="content">
    <div class="content-block">
        <h2>Reserve <?php echo $bunnyData['name']; ?></h2>
        <p>Leave your details below and we will get back to you as soon as possible!</p>
        <?php if (count($errors) > 0) { ?> 
                        <div class="errors">
                            <ul>
                                <?php
                                foreach($errors as $error) {
                                    echo "<li>$error</li>";
                                }
                                ?>
                                </ul>
                        </div>
                        <?php } ?>
            <form action="reserve.php?id=<?php echo $bunnyData['id']; ?>" method="post">
                <div class="form-input">
                    <label for="name">Your name:</label>
                    <input type="text" id="name" name="nameInput">
                </div>
                <div class="form-input">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="cityInput">             
                </div>
                <div class="form-input">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="emailInput">
                </div>
                <button class="form-button">Send</button>

                <?php
                if (empty($_POST) == false && count($errors) == 0) {
                    $sqlInsert = "INSERT INTO `customers` (`name`, `city`, `email`)
                    VALUES ('$name', '$city', '$email')";
                    $conn->query($sqlInsert);
                    $sqlIdCheck = "SELECT * FROM `customers` WHERE email = '$email'";
                    $result = $conn->query($sqlIdCheck);
                    if ($result->num_rows > 0) {
                        $customerData = $result->fetch_assoc();
                        $customerId = $customerData['id'];
                        $sqlInsert2 = "UPDATE bunnies
                        SET customers_id = '$customerId'
                        WHERE (`id` = $id)";
                        }
                        $conn->query($sqlInsert2);
  
                echo '<div class="success">Request successfully sent!</div>';
                }
                ?>
            </form>
    </div>
</div>

<?php include('footer.php');
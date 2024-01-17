<?php include('header.php');

$id = (int) $_GET['id'];

$sql = "SELECT *
FROM `bunnies` 
WHERE id=$id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $bunnyData = $result->fetch_assoc();
    ?>

    <div class="content">
        <div class="content-block">
            <h2>
                <?php echo $bunnyData['name'];
                if ($bunnyData['customers_id'] !== null) {
                    echo '<span class="reserved">RESERVED</span>';
                }
                ?>
            </h2>

            <div class="bunny-profile">
                <img src="<?php echo $bunnyData['picture']; ?>" alt="">
                <div>
                    <h4>Rescue story: </h4>
                    <p>
                        <?php echo $bunnyData['story']; ?>
                    </p>
                </div>
            </div>

            <h4>Details: </h4>

            <div class="details">
                <div class="detail">
                    <h4>Rescue date:</h4>
                    <p>
                        <?php echo $bunnyData['rescue_date']; ?>
                    </p>
                </div>
                <div class="detail">
                    <h4>Breed:</h4>
                    <p>
                        <?php echo $bunnyData['breed']; ?>
                    </p>
                </div>
                <div class="detail">
                    <h4>Gender:</h4>
                    <p>
                        <?php echo $bunnyData['gender']; ?>
                    </p>
                </div>
                <div class="detail">
                    <h4>Group:</h4>
                    <p>
                        <?php echo $bunnyData['group']; ?>
                    </p>
                </div>
                <div class="detail">
                    <h4>Neutered:</h4>
                    <p>
                        <?php
                        if ($bunnyData['neutered'] == 1) {
                            echo 'Yes';
                        } else {
                            echo 'No';
                        }
                        ?>
                    </p>
                </div>
                <div class="detail">
                    <h4>Colour:</h4>
                    <p>
                        <?php echo $bunnyData['colour']; ?>
                    </p>
                </div>
                <div class="detail">
                    <h4>Age (approximately):</h4>
                    <p>
                        <?php echo $bunnyData['age']; ?> years
                    </p>
                </div>
                <div class="detail">
                    <h4>Weight:</h4>
                    <p>
                        <?php echo $bunnyData['weight']; ?> kg
                    </p>
                </div>
                <div class="detail">
                    <h4>Ear length:</h4>
                    <p>
                        <?php echo $bunnyData['ear_length']; ?> cm
                    </p>
                </div>
                <div class="detail">
                    <h4>Level of fluffiness (1-10):</h4>
                    <p>
                        <?php echo $bunnyData['level_of_fluffiness']; ?>
                    </p>
                </div>
                <div class="detail">
                    <h4>Special abilities</h4>
                    <p>
                        <?php
                        $sql2 = 'SELECT 
                abilities.ability as ability,
                abilities.description as description
                FROM bunnies_abilities
                JOIN bunnies
                ON bunnies.id = bunnies_abilities.bunny_id
                JOIN abilities
                ON abilities.id = bunnies_abilities.ability_id
                WHERE bunnies.id =' . $id;

                        $result2 = $conn->query($sql2);
                        while ($row = mysqli_fetch_assoc($result2)) {
                            echo '<div>' . $row['ability'] . '</div>';
                        }
                        ;
                        ?>
                    </p>
                </div>
            </div>

            <p>Do you think
                <?php echo $bunnyData['name']; ?> could be your fluffy companion for life? Leave your details here and we
                will get back to you as soon as possible!
            </p>

            <?php
            if ($bunnyData['customers_id'] !== null) {
                echo '<p class="reserved-text">This bunny is already reserved.</p>';
            } else {
                ?>
                <a href="reserve.php?id=<?php echo $bunnyData['id']; ?>"><button>Reserve
                        <?php echo $bunnyData['name']; ?>
                    </button></a>
                <?php
            }
            ?>

        </div>

    </div>

<?php
} else {
    header("Location: index.php");
}

include('footer.php');


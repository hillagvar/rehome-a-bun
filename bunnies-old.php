<?php include('header.php'); 

// $sql = 'SELECT * FROM `bunnies`';

$sql = 'SELECT bunnies.id as bunnyId, bunnies.name as bunnyName, bunnies.breed, 
bunnies.gender, bunnies.group, bunnies.neutered, bunnies.colour, bunnies.rescue_date, bunnies.story, bunnies.picture,
customers.id as customerId, customers.name as customerName, customers.city as customerCity
FROM bunnies
JOIN customers
ON customers.id = bunnies.customers_id';

$result = $conn->query($sql);
while ($row = mysqli_fetch_assoc($result)) {
    $bunnyData[] = $row;
};

echo "<pre>";
print_r($bunnyData);
echo "</pre>";

?>

<div class="content">
    <div class="content-block">
        <h2>Our bunnies</h2>
        <p>Currently we have these bunnies in our shelter:</p>

        <?php if ($result->num_rows > 0) {
        ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Breed</th>
                <th>Gender</th>
                <th>Group</th>
                <th>Neutered</th>
                <th>Colour</th>
                <th>Reserved to</th>
                <th>Rescue date</th>
            </tr>
            <?php 
            foreach($bunnyData as $bunny) {
                $attributes = "class='bunny-block'";
                $attributes .= ' data-id="' . $bunny['bunnyId'] . '"';
        $attributes .= ' data-name="' . $bunny['bunnyName'] . '"';
        $attributes .= ' data-story="' . $bunny['story'] . '"';
        $attributes .= ' data-picture="' . $bunny['picture'] . '"';
                
                echo "<tr " . $attributes. ">";
                ?>
                <td class="bunny-name"><?php echo $bunny['bunnyName']; ?></td>
                <td><?php echo $bunny['breed']; ?></td>
                <td><?php echo $bunny['gender']; ?></td>
                <td><?php echo $bunny['group']; ?></td>
                <td><?php 
                if ($bunny['neutered'] == 1) {
                    echo 'Yes';
                } else {
                    echo 'No';
                }
                ?></td>
                <td><?php echo $bunny['colour']; ?></td>
                <td><?php echo $bunny['customerName'] . ', ' .$bunny['customerCity']; ?></td>
                <td><?php echo $bunny['rescue_date']; ?></td>
                <td><a href="view.php?id=<?php echo $bunny['bunnyId']; ?>"><button>More</button></a></td>
            </tr>
                <?php
            } ?>
            </table>
            <?php 
            } else {
                echo '<p>Currently there are no bunnies available.</p>';
            }
            ?>

<div class="modal-wrapper">
    <div class="modal">
        <div class="modal-left">
        <h2 class="modal-name"></h2>
        <img class="modal-img" alt="">
    </div>
    <div class="modal-right">
        <p>Rescue story:</p>
        <p class="modal-story"></p>
        <a class="modal-link"><button class="modal-button">More about <span></span></button></a>
    </div>
    </div>
</div>
    </div>
</div>

<script src="scripts/splide.min.js"></script>
<script src="scripts/script.js"></script>

<?php include('footer.php'); ?>
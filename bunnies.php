<?php include('header.php'); 

$sql1 = 'SELECT * FROM bunnies';

$result = $conn->query($sql1);
while ($row = mysqli_fetch_assoc($result)) {
    $bunnyData[] = $row;
};

?>

<div class="content">
    <div class="content-block">
        <h2>All our bunnies</h2>
        <p>Currently we have these bunnies in our shelter:</p>
        <ul>
            <li>Click on bunny name for photo and rescue story.</li>
            <li>Click on each special ability for explanation!</li>
        </ul>

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
                <th>Weight</th>
                <th>Special abilities</th>
                <th>Level of fluffiness (1-10)</th>
                <th>Rescue date</th>
            </tr>
            <?php 
            foreach($bunnyData as $bunny) {
                $attributes = "class='bunny-block'";
                $attributes .= ' data-id="' . $bunny['id'] . '"';
                $attributes .= ' data-name="' . $bunny['name'] . '"';
                $attributes .= ' data-story="' . $bunny['story'] . '"';
                $attributes .= ' data-picture="' . $bunny['picture'] . '"';
                echo "<tr " . $attributes. ">";
                ?>
                <td class="bunny-name"><?php echo $bunny['name']; 
                if ($bunny['customers_id'] !== null) {
                    echo '<div class="reserved-small">RESERVED</div>';
                } 
                ?></td>
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
                <td><?php echo $bunny['weight']; ?> kg</td>
                <td><?php 
                $id = $bunny['id'];
                
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
                $attributes = "class='ability'";
                $attributes .= ' data-ability="' . $row['ability'] . '"';
                $attributes .= ' data-description="' . $row['description'] . '"';
                echo '<div ' .$attributes. '>';
                echo $row['ability'];
                echo '</div>';
                };
                ?></td>
                <td><?php echo $bunny['level_of_fluffiness']; ?></td>
                <td><?php echo $bunny['rescue_date']; ?></td>
                <td><a href="view.php?id=<?php echo $bunny['id']; ?>"><button>More</button></a></td>
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

<div class="modal-wrapper-ability">
    <div class="modal-ability">
        <h2 class="ability-name"></h2>
        <p class="ability-description"></p>
    </div>
</div>

</div>
</div>

<?php include('footer.php'); ?>
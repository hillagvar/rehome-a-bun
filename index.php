<?php include('header.php');

$sql = 'SELECT * FROM `bunnies`
ORDER BY `rescue_date` ASC';
$result = $conn->query($sql);
$rowcount=mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
    $bunnyData[] = $row;
};

?>

<div class="content">
    <div class="content-block">
        <h2>
            Welcome!
        </h2>
        <p>Rehome a Bun, a 100% volunteer organization, has been rescuing rabbits in Norway since 2015. We place over 50 rabbits every year.</p>
        <p>Currently we have <?php echo $rowcount; ?> bunnies waiting for a new home.</p>
    </div>

    <div class="content-block">
        <h2>Our oldest bunnies</h2>
        <p>These bunnies have been in our shelter for the longest time. Maybe some of them could be your new loyal friends?</p>

        <section class="splide">
            <div class="splide__track">
		        <ul class="splide__list">
                <?php 
                for ($i = 0; $i < 10; $i++) {
                ?>
			        <li class="splide__slide">
                    <a href="view.php?id=<?php echo $bunnyData[$i]['id']; ?>"><img class="carousel-image" src="<?php echo $bunnyData[$i]['picture']; ?>" alt=""></a>
                        <h3><?php echo $bunnyData[$i]['name'];
                        if ($bunnyData[$i]['customers_id'] !== null) {
                            echo '<span class="reserved">RESERVED</span>';
                        } 
                        ?></h3>
                        <p>Rescue date: <?php echo $bunnyData[$i]['rescue_date'] ?></p>
                    </li>
			
                <?php
                }
                ?>
		        </ul>
            </div>
        </section>
    </div>

</div>

<?php include('footer.php');


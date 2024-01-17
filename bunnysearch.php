<?php include('header.php');

$sql1 = 'SELECT * FROM bunnies';
$result1 = $conn->query($sql1);
$rowcount=mysqli_num_rows($result1);
$randomId = rand(1, $rowcount);

$sql2 = 'SELECT breed, colour FROM bunnies';
$result2 = $conn->query($sql2);
$breedData = array();
$colourData = array();
while ($row = mysqli_fetch_assoc($result2)) {
    $allBreedData[] = $row['breed'];
    $allColourData[] = $row['colour'];
}

for ($i = 0; $i < count($allBreedData); $i++) {
    $breed_present = false;

    for ($j = 0; $j < count($breedData); $j++) {
        if ($allBreedData[$i] == $breedData[$j]) {
            $breed_present = true;
            break;
            }
        }

    if (!$breed_present) {
            $breed = $allBreedData[$i];
            array_push($breedData, $breed);
    }
}

for ($i = 0; $i < count($allColourData); $i++) {
    $colour_present = false;

    for ($j = 0; $j < count($colourData); $j++) {
        if ($allColourData[$i] == $colourData[$j]) {
            $colour_present = true;
            break;
            }
        }

    if (!$colour_present) {
            $colour = $allColourData[$i];
            array_push($colourData, $colour);
    }
}

$sql3 = 'SELECT id, ability FROM abilities';
$result3 = $conn->query($sql3);
while ($row = mysqli_fetch_assoc($result3)) {
    $abilityData[] = $row;
}

?>

<div class="content">
    <div class="content-block">
        <h2>Search for a bunny</h2>
        <p>You can search for bunnies based on everything from colour to level of flufiness.</p>
        <p>Or just click here to see a random bunny, because all of them are wonderful in their own ways!</p>
        <a href="view.php?id=<?php echo $randomId; ?>"><button>Show me a random bunny</button></a>
    </div>
    <div class="content-block">
        <form action="bunnysearch.php" method="GET">
        <h3>Search form</h3>
        <p class="search-cr">1. Breed</p>
        <div class="checkbox-container">
        <?php

        foreach ($breedData as $breed) {
            $breedLabel = strtolower(str_replace(' ', '', $breed));
            $breedId = $breedLabel;
            $breedValue = $breed;
            ?>
            <div>
            <label for="<?php echo $breedLabel; ?>"><?php echo $breedValue; ?></label>
            <input type="checkbox" id="<?php echo $breedId; ?>" name="breedInput[]" 
            <?php
            if (isset($_GET['breedInput'])) {
                if (in_array($breedValue, $_GET['breedInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="<?php echo $breedValue; ?>">
            </div>
        <?php
        }
        ?>
        </div>

        <p class="search-cr">2. Gender</p>
        <div class="checkbox-container">
            <div>
            <label for="male">male</label>
            <input type="checkbox" id="male" name="genderInput[]" 
            <?php
            if (isset($_GET['genderInput'])) {
                if (in_array('male', $_GET['genderInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="male">
            </div>
            <div>
            <label for="female">female</label>
            <input type="checkbox" id="female" name="genderInput[]" 
            <?php
            if (isset($_GET['genderInput'])) {
                if (in_array('female', $_GET['genderInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="female">
            </div>
        </div>

        <p class="search-cr">3. Group</p>
        <div class="checkbox-container">
            <div>
            <label for="lop">lop</label>
            <input type="checkbox" id="lop" name="groupInput[]" 
            <?php
            if (isset($_GET['groupInput'])) {
                if (in_array('lop', $_GET['groupInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="lop">
            </div>
            <div>
            <label for="non-lop">non-lop</label>
            <input type="checkbox" id="non-lop" name="groupInput[]" 
            <?php
            if (isset($_GET['groupInput'])) {
                if (in_array('non-lop', $_GET['groupInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="non-lop">
            </div>
        </div>

        <p class="search-cr">4. Neutered</p>
        <div class="checkbox-container">
            <div>
            <label for="neutered-yes">yes</label>
            <input type="checkbox" id="neutered-yes" name="neuteredInput[]" 
            <?php
            if (isset($_GET['neuteredInput'])) {
                if (in_array('1', $_GET['neuteredInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="1">
            </div>
            <div>
            <label for="neutered-no">no</label>
            <input type="checkbox" id="neutered-no" name="neuteredInput[]" 
            <?php
            if (isset($_GET['neuteredInput'])) {
                if (in_array('0', $_GET['neuteredInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="0">
            </div>
        </div>

        <p class="search-cr">5.Colour</p>
        <div class="checkbox-container">
        <?php
        foreach ($colourData as $colour) {
            ?>
            <div>
            <label for="<?php echo $colour; ?>"><?php echo $colour; ?></label>
            <input type="checkbox" id="<?php echo $colour; ?>" name="colourInput[]"
            <?php
            if (isset($_GET['colourInput'])) {
                if (in_array($colour, $_GET['colourInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="<?php echo $colour; ?>">
            </div>
        <?php
        }
        ?>
        </div>

        <p class="search-cr">6. Age</p>
        <div class="checkbox-container">
            <div>
            <label for="1-year">1 year</label>
            <input type="checkbox" id="1-year" name="ageInput[]"
            <?php
            if (isset($_GET['ageInput'])) {
                if (in_array('1', $_GET['ageInput'])) {
                    echo 'checked';
                }
            }
            ?> 
            value="1">
            </div>
            <div>
            <label for="2-years">2 years</label>
            <input type="checkbox" id="2-years" name="ageInput[]" 
            <?php
            if (isset($_GET['ageInput'])) {
                if (in_array('2', $_GET['ageInput'])) {
                    echo 'checked';
                }
            }
            ?> value="2">
            </div>
            <div>
            <label for="3-years">3 years</label>
            <input type="checkbox" id="3-years" name="ageInput[]" 
            <?php
            if (isset($_GET['ageInput'])) {
                if (in_array('3', $_GET['ageInput'])) {
                    echo 'checked';
                }
            }
            ?> value="3">
            </div>
            <div>
            <label for="4-years">4 years or more</label>
            <input type="checkbox" id="4-years" name="ageInput[]" 
            <?php
            if (isset($_GET['ageInput'])) {
                if (in_array('4', $_GET['ageInput'])) {
                    echo 'checked';
                }
            }
            ?> value="4">
            </div>
        </div>

        <p class="search-cr">7. Weight</p>
        <div class="checkbox-container">
            <div>
            <label for="weightRange1">less than 2 kg</label>
            <input type="checkbox" id="weightRange1" name="weightInput[]"
            <?php
            if (isset($_GET['weightInput'])) {
                if (in_array('weightRange1', $_GET['weightInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="weightRange1">
            </div>
            <div>
            <label for="weightRange2">2 - 4 kg</label>
            <input type="checkbox" id="weightRange2" name="weightInput[]"
            <?php
            if (isset($_GET['weightInput'])) {
                if (in_array('weightRange2', $_GET['weightInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="weightRange2">
            </div>
            <div>
            <label for="weightRange3">more than 4 kg</label>
            <input type="checkbox" id="weightRange3" name="weightInput[]"
            <?php
            if (isset($_GET['weightInput'])) {
                if (in_array('weightRange3', $_GET['weightInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="weightRange3">
            </div>
        </div>

        <p class="search-cr">8. Ear length</p>
        <div class="checkbox-container">
            <div>
            <label for="earLengthRange1">less than 10 cm</label>
            <input type="checkbox" id="earLengthRange1" name="earLengthInput[]"
            <?php
            if (isset($_GET['earLengthInput'])) {
                if (in_array('earLengthRange1', $_GET['earLengthInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="earLengthRange1">
            </div>
            <div>
            <label for="earLengthRange2">10 - 15 cm</label>
            <input type="checkbox" id="earLengthRange2" name="earLengthInput[]"
            <?php
            if (isset($_GET['earLengthInput'])) {
                if (in_array('earLengthRange2', $_GET['earLengthInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="earLengthRange2">
            </div>
            <div>
            <label for="earLengthRange3">more than 15 cm</label>
            <input type="checkbox" id="earLengthRange3" name="earLengthInput[]"
            <?php
            if (isset($_GET['earLengthInput'])) {
                if (in_array('earLengthRange3', $_GET['earLengthInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="earLengthRange3">
            </div>
        </div>

        <p class="search-cr">9. Level of fluffiness</p>
        <div class="checkbox-container">
            <div>
            <label for="fluffinessRange1">less than 4 (less than average fluffiness)</label>
            <input type="checkbox" id="fluffinessRange1" name="fluffinessInput[]"
            <?php
            if (isset($_GET['fluffinessInput'])) {
                if (in_array('fluffinessRange1', $_GET['fluffinessInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="fluffinessRange1">
            </div>
            <div>
            <label for="fluffinessRange2">4 - 6 (average fluffiness)</label>
            <input type="checkbox" id="fluffinessRange2" name="fluffinessInput[]"
            <?php
            if (isset($_GET['fluffinessInput'])) {
                if (in_array('fluffinessRange2', $_GET['fluffinessInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="fluffinessRange2">
            </div>
            <div>
            <label for="fluffinessRange3">more than 6 (extra fluffy)</label>
            <input type="checkbox" id="fluffinessRange3" name="fluffinessInput[]"
            <?php
            if (isset($_GET['fluffinessInput'])) {
                if (in_array('fluffinessRange3', $_GET['fluffinessInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="fluffinessRange3">
            </div>
        </div>

        <p class="search-cr">10. Special abilities</p>
        <div class="checkbox-container">
        <?php
        foreach ($abilityData as $ability) {
            ?>
            <div>
            <label for="<?php echo $ability['id']; ?>"><?php echo $ability['ability']; ?></label>
            <input type="checkbox" id="<?php echo $ability['id']; ?>" name="abilityInput[]"
            <?php
            if (isset($_GET['abilityInput'])) {
                if (in_array($ability['id'], $_GET['abilityInput'])) {
                    echo 'checked';
                }
            }
            ?>
            value="<?php echo $ability['id']; ?>">
            </div>
        <?php
        }
        ?>
        </div>
        <button class="bunnySearch">Search for bunnies</button>
    </form>
        
    </div>


<div class="content-block">
    <?php

        $sql4 = 'SELECT distinct `id`, `name`, `breed`, `gender`, `group`, `neutered`, `colour`, `age`, `weight`, `ear_length`, `level_of_fluffiness`, `rescue_date`, `picture`, `story`, `customers_id` 
        FROM bunnies
        JOIN bunnies_abilities
        ON bunnies.id = bunnies_abilities.bunny_id';

        if (isset($_GET['breedInput'])) {
            $breedInput = $_GET['breedInput'];
            // echo '<p>Selected breeds: ';
            // for($i = 0; $i < count($breedInput); $i++) {
            //     if ($i == count($breedInput) - 1) {
            //         echo $breedInput[$i]. '.';
            //     } else {
            //         echo $breedInput[$i]. ', ';
            //     }
            // }
            // echo '</p>';

            $breedSearchSql = '';

            foreach ($breedInput as $index => $breed) {
                if ($index == count($breedInput) - 1) {
                    $breedSearchSql .= "'$breed'";
                } else {
                    $breedSearchSql .= "'$breed'". ', ';
                } 
            }

            $sql4 .= " WHERE `breed` in ($breedSearchSql) ";
        }

        if (isset($_GET['genderInput'])) {
            $genderInput = $_GET['genderInput'];
            // echo '<p>Selected genders: ';
            // for($i = 0; $i < count($genderInput); $i++) {
            //     if ($i == count($genderInput) - 1) {
            //         echo $genderInput[$i]. '.';
            //     } else {
            //         echo $genderInput[$i]. ', ';
            //     }
            // }
            // echo '</p>';

            $genderSearchSql = '';

            foreach ($genderInput as $index => $gender) {
                if ($index == count($genderInput) - 1) {
                    $genderSearchSql .= "'$gender'";
                } else {
                    $genderSearchSql .= "'$gender'". ', ';
                } 
            }

            if (!isset($_GET['breedInput'])) {
                $sql4 .= " WHERE `gender` in ($genderSearchSql) ";
            } else {
                $sql4 .= " AND (`gender` in ($genderSearchSql))";
            }
        }

        if (isset($_GET['groupInput'])) {
            $groupInput = $_GET['groupInput'];
            // echo '<p>Selected groups: ';
            // for($i = 0; $i < count($groupInput); $i++) {
            //     if ($i == count($groupInput) - 1) {
            //         echo $groupInput[$i]. '.';
            //     } else {
            //         echo $groupInput[$i]. ', ';
            //     }
            // }
            // echo '</p>';

            $groupSearchSql = '';

            foreach ($groupInput as $index => $group) {
                if ($index == count($groupInput) - 1) {
                    $groupSearchSql .= "'$group'";
                } else {
                    $groupSearchSql .= "'$group'". ', ';
                } 
            }

            if (!isset($_GET['breedInput']) && !isset($_GET['genderInput'])) {
                $sql4 .= " WHERE `group` in ($groupSearchSql) ";
            } else {
                $sql4 .= " AND (`group` in ($groupSearchSql))";
            }
        }

        if (isset($_GET['neuteredInput'])) {
            $neuteredInput = $_GET['neuteredInput'];
            // echo '<p>Neutered: ';
            // for($i = 0; $i < count($neuteredInput); $i++) {
            //     if ($i == count($neuteredInput) - 1) {
            //         echo $neuteredInput[$i]. '.';
            //     } else {
            //         echo $neuteredInput[$i]. ', ';
            //     }
            // }
            // echo '</p>';

            $neuteredSearchSql = '';

            foreach ($neuteredInput as $index => $neutered) {
                if ($index == count($neuteredInput) - 1) {
                    $neuteredSearchSql .= "'$neutered'";
                } else {
                    $neuteredSearchSql .= "'$neutered'". ', ';
                } 
            }

            if (!isset($_GET['breedInput']) && !isset($_GET['genderInput']) && !isset($_GET['groupInput'])) {
                $sql4 .= " WHERE `neutered` in ($neuteredSearchSql) ";
            } else {
                $sql4 .= " AND (`neutered` in ($neuteredSearchSql)) ";
            }
        }

        if (isset($_GET['colourInput'])) {
            $colourInput = $_GET['colourInput'];
            // echo '<p>Colour: ';
            // for($i = 0; $i < count($colourInput); $i++) {
            //     if ($i == count($colourInput) - 1) {
            //         echo $colourInput[$i]. '.';
            //     } else {
            //         echo $colourInput[$i]. ', ';
            //     }
            // }
            // echo '</p>';

            $colourSearchSql = '';

            foreach ($colourInput as $index => $colour) {
                if ($index == count($colourInput) - 1) {
                    $colourSearchSql .= "'$colour'";
                } else {
                    $colourSearchSql .= "'$colour'". ', ';
                } 
            }

            if (!isset($_GET['breedInput']) && !isset($_GET['genderInput']) && !isset($_GET['groupInput']) && !isset($_GET['neuteredInput'])) {
                $sql4 .= " WHERE `colour` in ($colourSearchSql) ";
            } else {
                $sql4 .= " AND (`colour` in ($colourSearchSql)) ";
            }
        }

        if (isset($_GET['ageInput'])) {
            $ageInput = $_GET['ageInput'];
            $ageSearchArray = array();
            // echo '<p>Age: ';
            for($i = 0; $i < count($ageInput); $i++) {
                if ($i == count($ageInput) - 1) {
                    switch ($ageInput[$i]){
                        case 1:
                            // echo '1 year.';
                            array_push($ageSearchArray, '= 1');
                        break;
                        case 2:
                            // echo '2 years.';
                            array_push($ageSearchArray, '= 2');
                        break;
                        case 3:
                            // echo '3 years.';
                            array_push($ageSearchArray, '= 3');
                        break;
                        case 4:
                            // echo '4 years or more.';
                            array_push($ageSearchArray, '>= 4');
                        break;
                    }
                } else {
                    switch ($ageInput[$i]) {
                    case 1:
                        // echo '1 year, ';
                        array_push($ageSearchArray, '= 1');
                    break;
                    case 2:
                        // echo '2 years, ';
                        array_push($ageSearchArray, '= 2');
                    break;
                    case 3:
                        // echo '3 years, ';
                        array_push($ageSearchArray, '= 3');
                    break;
                    case 4:
                        // echo '4 years or more, ';
                        array_push($ageSearchArray, '>= 4');
                    break;
                }
            }
            }
            // echo '</p>';

            $ageSearchSql = '';

            if (count($ageSearchArray) > 1) {
                foreach ($ageSearchArray as $index => $ageRange) {
                    if ($index == count($ageSearchArray) - 1) {
                        $ageSearchSql .= $ageRange;
                    } else {
                        $ageSearchSql .= $ageRange. ' OR `age` ';
                    }
                }
            
            } else {
                $ageSearchSql = $ageSearchArray[0];
            }

            if (!isset($_GET['breedInput']) && !isset($_GET['genderInput']) && !isset($_GET['groupInput']) && !isset($_GET['neuteredInput']) && !isset($_GET['colourInput'])) {
                $sql4 .= " WHERE `age` $ageSearchSql ";
            } else {
                $sql4 .= " AND (`age` $ageSearchSql)";
            }
        }

        if (isset($_GET['weightInput'])) {
            $weightInput = $_GET['weightInput'];
            $weightSearchArray = array();
            // echo '<p>Weight: ';
            for($i = 0; $i < count($weightInput); $i++) {
                if ($i == count($weightInput) - 1) {
                    switch ($weightInput[$i]){
                        case 'weightRange1':
                            // echo 'less than 2 kg.';
                            array_push($weightSearchArray, '< 2');
                        break;
                        case 'weightRange2':
                            // echo '2-4 kg.';
                            array_push($weightSearchArray, '>= 2 AND `weight` <=4');
                        break;
                        case 'weightRange3':
                            // echo 'more than 4 kg.';
                            array_push($weightSearchArray, '> 4');
                        break;
                    }
                } else {
                    switch ($weightInput[$i]) {
                        case 'weightRange1':
                            // echo 'less than 2 kg, ';
                            array_push($weightSearchArray, '< 2');
                        break;
                        case 'weightRange2':
                            // echo '2-4 kg, ';
                            array_push($weightSearchArray, '>= 2 AND `weight` <=4');
                        break;
                        case 'weightRange3':
                            // echo 'more than 4 kg, ';
                            array_push($weightSearchArray, '> 4');
                        break;
                }
            }
            }
            // echo '</p>';

            $weightSearchSql = '';

            if (count($weightSearchArray) > 1) {
                foreach ($weightSearchArray as $index => $weightRange) {
                    if ($index == count($weightSearchArray) - 1) {
                        $weightSearchSql .= $weightRange;
                    } else {
                        $weightSearchSql .= $weightRange. ' OR `weight` ';
                    }
                }
            
            } else {
                $weightSearchSql = $weightSearchArray[0];
            }

            if (!isset($_GET['breedInput']) && !isset($_GET['genderInput']) && !isset($_GET['groupInput']) && !isset($_GET['neuteredInput']) && !isset($_GET['colourInput']) && !isset($_GET['ageInput'])) {
                $sql4 .= " WHERE `weight` $weightSearchSql ";
            } else {
                $sql4 .= " AND (`weight` $weightSearchSql)";
            }
        }

        if (isset($_GET['earLengthInput'])) {
            $earLengthInput = $_GET['earLengthInput'];
            $earLengthSearchArray = array();
            // echo '<p>Ear length: ';
            for($i = 0; $i < count($earLengthInput); $i++) {
                if ($i == count($earLengthInput) - 1) {
                    switch ($earLengthInput[$i]){
                        case 'earLengthRange1':
                            // echo 'less than 10 cm.';
                            array_push($earLengthSearchArray, '< 10');
                        break;
                        case 'earLengthRange2':
                            // echo '10-15 cm.';
                            array_push($earLengthSearchArray, '>=10 AND `ear_length` <= 15');
                        break;
                        case 'earLengthRange3':
                            // echo 'more than 15cm.';
                            array_push($earLengthSearchArray, '> 15');
                        break;
                    }
                } else {
                    switch ($earLengthInput[$i]) {
                        case 'earLengthRange1':
                            // echo 'less than 10 cm, ';
                            array_push($earLengthSearchArray, '< 10');
                        break;
                        case 'earLengthRange2':
                            // echo '10-15 cm, ';
                            array_push($earLengthSearchArray, '>=10 AND `ear_length` <= 15');
                        break;
                        case 'earLengthRange3':
                            // echo 'more than 15cm, ';
                            array_push($earLengthSearchArray, '> 15');
                        break;
                }
            }
            }
            // echo '</p>';

            $earLengthSearchSql = '';

            if (count($earLengthSearchArray) > 1) {
                foreach ($earLengthSearchArray as $index => $earLengthRange) {
                    if ($index == count($earLengthSearchArray) - 1) {
                        $earLengthSearchSql .= $earLengthRange;
                    } else {
                        $earLengthSearchSql .= $earLengthRange. ' OR `ear_length` ';
                    }
                }
            
            } else {
                $earLengthSearchSql = $earLengthSearchArray[0];
            }

            if (!isset($_GET['breedInput']) && !isset($_GET['genderInput']) && !isset($_GET['groupInput']) && !isset($_GET['neuteredInput']) && !isset($_GET['colourInput']) && !isset($_GET['ageInput']) && !isset($_GET['weightInput'])) {
                $sql4 .= " WHERE `ear_length` $earLengthSearchSql ";
            } else {
                $sql4 .= " AND (`ear_length` $earLengthSearchSql)";
            }
        }

        if (isset($_GET['fluffinessInput'])) {
            $fluffinessInput = $_GET['fluffinessInput'];
            $fluffinessSearchArray = array();
            // echo '<p>Level of fluffiness: ';
            for($i = 0; $i < count($fluffinessInput); $i++) {
                if ($i == count($fluffinessInput) - 1) {
                    switch ($fluffinessInput[$i]){
                        case 'fluffinessRange1':
                            // echo 'less than 4.';
                            array_push($fluffinessSearchArray, '< 4');
                        break;
                        case 'fluffinessRange2':
                            // echo '4-6.';
                            array_push($fluffinessSearchArray, '>= 4 AND `level_of_fluffiness` <= 6');
                        break;
                        case 'fluffinessRange3':
                            // echo 'more than 6.';
                            array_push($fluffinessSearchArray, '> 6');
                        break;
                    }
                } else {
                    switch ($fluffinessInput[$i]) {
                        case 'fluffinessRange1':
                            // echo 'less than 4, ';
                            array_push($fluffinessSearchArray, '< 4');
                        break;
                        case 'fluffinessRange2':
                            // echo '4-6, ';
                            array_push($fluffinessSearchArray, '>= 4 AND `level_of_fluffiness` <= 6');
                        break;
                        case 'fluffinessRange3':
                            // echo 'more than 6, ';
                            array_push($fluffinessSearchArray, '> 6');
                        break;
                }
            }
            }
            // echo '</p>';

            $fluffinessSearchSql = '';

            if (count($fluffinessSearchArray) > 1) {
                foreach ($fluffinessSearchArray as $index => $fluffinessRange) {
                    if ($index == count($fluffinessSearchArray) - 1) {
                        $fluffinessSearchSql .= $fluffinessRange;
                    } else {
                        $fluffinessSearchSql .= $fluffinessRange. ' OR `level_of_fluffiness` ';
                    }
                }
            
            } else {
                $fluffinessSearchSql = $fluffinessSearchArray[0];
            }

            if (!isset($_GET['breedInput']) && !isset($_GET['genderInput']) && !isset($_GET['groupInput']) && !isset($_GET['neuteredInput']) && !isset($_GET['colourInput']) && !isset($_GET['ageInput']) && !isset($_GET['weightInput']) && !isset($_GET['earLengthInput'])) {
                $sql4 .= " WHERE `level_of_fluffiness` $fluffinessSearchSql ";
            } else {
                $sql4 .= " AND (`level_of_fluffiness` $fluffinessSearchSql)";
            }
        }

        if (isset($_GET['abilityInput'])) {
            $abilities = $_GET['abilityInput'];
            // echo '<p>Special abilities: ';
            // for ($i = 0; $i < count($abilities); $i++) {
            //     foreach ($abilityData as $ability) {
            //         if ($i == count($abilities) - 1 && $abilities[$i] == $ability['id']) {
            //             echo $ability['ability']. '.';
            //         }
            //         if ($i < count($abilities) - 1 && $abilities[$i] == $ability['id']) {
            //             echo $ability['ability']. ', ';
            //         }
            //     }
            // }
            // echo '</p>';

            $abilitySearchSql = '';

            if (count($abilities) > 1) {
                foreach ($abilities as $index => $ability) {
                    if ($index == count($abilities) - 1) {
                        $abilitySearchSql .= $ability;
                    } else {
                        $abilitySearchSql .= $ability. ' OR bunnies_abilities.ability_id = ';
                    }
                }
            
            } else {
                $abilitySearchSql = $abilities[0];
            }

            if (!isset($_GET['breedInput']) && !isset($_GET['genderInput']) && !isset($_GET['groupInput']) && !isset($_GET['neuteredInput']) && !isset($_GET['colourInput']) && !isset($_GET['ageInput']) && !isset($_GET['weightInput']) && !isset($_GET['earLengthInput']) && !isset($_GET['fluffinessInput'])) {
                $sql4 .= " WHERE (bunnies_abilities.ability_id = $abilitySearchSql)";
            } else {
                $sql4 .= " AND (bunnies_abilities.ability_id = $abilitySearchSql)";
            }

        }

        if (empty($_GET) === false) {
            echo '<h3>Bunnies that match your criteria:</h3>';  
            
            // echo $sql4;

        $result4 = $conn->query($sql4);
        while ($row = mysqli_fetch_assoc($result4)) {
            $bunnyData[] = $row;
        };

        if ($result4->num_rows > 0) {
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
                    
                    $sql5 = 'SELECT 
                    abilities.ability as ability,
                    abilities.description as description
                    FROM bunnies_abilities
                    JOIN bunnies
                    ON bunnies.id = bunnies_abilities.bunny_id
                    JOIN abilities
                    ON abilities.id = bunnies_abilities.ability_id
                    WHERE bunnies.id =' . $id;
    
                    $result5 = $conn->query($sql5);
                    while ($row = mysqli_fetch_assoc($result5)) {
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
                    echo '<p>No bunnies match your search criteria.</p>';
                }
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


<?php

include('footer.php');
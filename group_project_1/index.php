<?php
// First, declare the variables
$unit_from = "";
$unit_to = "";
$unit_to_short = "";
$temp = "";
$result = "";
// Then, the error varaibles
$unit_from_error = "";
$unit_to_error = "";
$temp_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Only need to run this code if we have receieved POST data

    // First, we check the POST data to see if it exists for each value, and assign either an error
    // or set the variable to that value
    if (empty($_POST['unit_from'])) {
        $unit_from_error = "Please select a value you are converting from!";
    } else {
        $unit_from = $_POST['unit_from'];
    }

    if (empty($_POST['unit_to'])) {
        $unit_to_error = "Please select a value you are converting to!";
    } else {
        $unit_to = $_POST['unit_to'];
    }

    if (empty($_POST['temp'])) {
        $temp_error = "Please enter a temperature!";
    } elseif (!is_numeric($_POST['temp'])) {
        $temp_error = "Please enter a number for the temperature!";
    } else {
        $temp = $_POST['temp'];
    }

    if (
        isset( // These are only set if there are no errors above! If all this is true, then we give the answer!
        $_POST['unit_from'],
        $_POST['unit_to'],
        $_POST['temp']) &&
        is_numeric(
            $_POST['temp']
        )
    ) { // If these are all set, then we calculate the answer based on the temperature types
        if ($unit_from == 'fahrenheit') {
            if ($unit_to == 'fahrenheit') {
                $result = $temp;
            } elseif ($unit_to == 'celsius') {
                $result = (($temp - 32) * 0.5556);
            } elseif ($unit_to == 'kelvin') {
                $result = ((($temp - 32) * 0.5556) + 273.15);
            }
        } elseif ($unit_from == 'celsius') {
            if ($unit_to == 'fahrenheit') {
                $result = (($temp * 1.8) + 32);
            } elseif ($unit_to == 'celsius') {
                $result = $temp;
            } elseif ($unit_to == 'kelvin') {
                $result = $temp + 273.15;
            }
        } elseif ($unit_from == 'kelvin') {
            if ($unit_to == 'fahrenheit') {
                $result = ((($temp - 273.15) * 9) / 5);
            } elseif ($unit_to == 'celsius') {
                $result = $temp - 273.15;
            } elseif ($unit_to == 'kelvin') {
                $result = $temp;
            }
        } // end math if

        // Set the shorthand for the converted unit, for displaying the answer
        if ($unit_to === "fahrenheit") {
            $unit_to_short = 'F';
        } elseif ($unit_to === "celsius") {
            $unit_to_short = 'C';
        } elseif ($unit_to === "kelvin") {
            $unit_to_short = 'K';
        }
    } // end if isset
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperature Converter</title>

    <link rel="stylesheet" href="css/styles.css">
    <!-- Google font: Robot Slab -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

</head>

<body>
    <main>
        <form action="" method="POST">
            <h1>Temperature Converter</h1>

            <p><label for="temp">Enter Temperature: </label>
                <input type="text" name="temp" value="<?php if (isset($temp)) {
                                                            echo $temp;
                                                        } ?>">
            </p>
            <p class="error"><?php echo $temp_error; ?></p>
            <p><label for="unit_from">Select Unit</label></p>
            <select name="unit_from" id="unit_from">
                <option value="">Curent Unit:</option>
                <option value="fahrenheit" <?php if ($unit_from === 'fahrenheit') {
                                                echo 'selected = selected';
                                            } ?>>Fahrenheit</option>
                <option value="celsius" <?php if ($unit_from === 'celsius') {
                                            echo 'selected = selected';
                                        } ?>>Celsius</option>
                <option value="kelvin" <?php if ($unit_from === 'kelvin') {
                                            echo 'selected = selected';
                                        } ?>>Kelvin</option>
            </select>
            <p class="error"><?php echo $unit_from_error; ?></p>
            <p><label for="unit_to">Converting To</label></p>
            <select name="unit_to" id="unit_to">
                <option value="">Select Unit</option>
                <option value="fahrenheit" <?php if ($unit_to === 'fahrenheit') {
                                                echo 'selected = selected';
                                            } ?>>Fahrenheit</option>
                <option value="celsius" <?php if ($unit_to === 'celsius') {
                                            echo 'selected = selected';
                                        } ?>>Celsius</option>
                <option value="kelvin" <?php if ($unit_to === 'kelvin') {
                                            echo 'selected = selected';
                                        } ?>>Kelvin</option>
            </select>
            <p class="error"><?php echo $unit_to_error; ?></p>
            <section class="buttons">
                <input type="submit" value="CONVERT!">
                <!-- <input type="reset" value="Reset"> -->
                <input type="button" onclick="window.location = ''" value="Reset">
            </section>
        </form>
        <?php
        if ($result != "") { // If the result ISN'T "", then we know we have an answer and can display it!
            $result_f = number_format($result, 2); // Cut off the all but the first two decimal places
            echo "<article class='result_box'>";
            echo "<p>Starting Temperature: <em>{$temp}&deg; {$unit_from}</em></p>";
            echo "<p>Desired Unit: <em>{$unit_to}</em></p>";
            echo "<p class='answer'>The Answer is: {$result_f}&deg;{$unit_to_short}! </p>";
            echo "</article>";
        }
        ?>
    </main>
</body>

</html>

<!-- Work log!

Robin: Fiddled with form structure, added more CSS, 1 hour, 1/18/2021
Robin: Added form logic, started CSS, .5 hours, 1/14/2021
Robin: Wrote basic form, 2 hours 1/8/2021

-->
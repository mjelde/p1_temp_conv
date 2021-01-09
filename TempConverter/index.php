<?php 
// variable declerations to be used by form and isset checks
$userInput = ''; 
$userTemp=''; 
$tempChangeUser=''; 

$userInputErr = ''; 
$userTempErr='';
$err="";
$tempChangeUserErr='';
$convertedTemp=''; 


if($_SERVER['REQUEST_METHOD']=='POST'){ 
//start of check empty 
if(empty($_POST['temperature']) || is_numeric($_POST['temperature'])== FALSE){
    $userInputErr = 'enter a number'; 
}else{ 
    $userInput= $_POST['temperature'];
}


if(($_POST['tempTypes']=='Null')){ 
    $userTempErr = "<p>Error, Please enter a temperature</p>"; 
}else { 
    $userTemp = $_POST['tempTypes'];
}

if(($_POST['tempChange']=='Null')){ 
    $tempChangeUserErr = "<p>Error, Please enter a temperature you would like us to convert to</p>"; 
}else { 
    $tempChangeUser = $_POST['tempChange'];
}

} //end server


 



?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link rel="stylesheet" href="./css/index.css?v=<?php echo time(); ?>"> 
</head>
<body> 

<!-- start of wrapper --> 
<div id="wrapper">
    <!-- start of wrapper --><div class="form-container">
                                    <form id="temp-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">          
                                        <fieldset>

                                        <label>Whats your temperature</label> 
                                        <input type='text' name='temperature' value="<?php if(isset($_POST['temperature']))  echo htmlspecialchars($_POST['temperature']); //no need for curly brackets ?>""> 

                                        <label>Temperature type</label> 
                                                <select name='tempTypes'>
                                                <option value ='Null'> Null 
                                                    <?php if(isset($_POST['tempTypes']) && $_POST == 'NULL') { echo 'selected = "selected"';}  ?>    
                                                </option>
                                                <option value ='fahrenheit'> fahrenheit 
                                                    <?php if(isset($_POST['tempTypes']) && $_POST == 'fahrenheit') { echo 'selected = "selected"';}  ?>    
                                                </option>
                                                <option value ='celsius'> celsius 
                                                    <?php if(isset($_POST['tempTypes']) && $_POST == 'celsius') { echo 'selected = "selected"';}  ?>    
                                                </option>
                                                <option value ='kelvin'> kelvin 
                                                    <?php if(isset($_POST['tempTypes']) && $_POST == 'kelvin') { echo 'selected = "selected"';}  ?>    
                                                </option>
                                                
                                                </select>

                                        <!-- still need to add ifsets  -->
                                        <label>what temperature would you like it converted to? </label> 
                                                <select name='tempChange'>
                                                <option value ='Null'> Null 
                                                    <?php if(isset($_POST['tempChange']) && $_POST == 'NULL') { echo 'selected = "selected"';}  ?>    
                                                </option>
                                                <option value ='fahrenheit'> fahrenheit 
                                                    <?php if(isset($_POST['tempChange']) && $_POST == 'fahrenheit') { echo 'selected = "selected"';}  ?>    
                                                </option>
                                                <option value ='celsius'> celsius 
                                                    <?php if(isset($_POST['tempChange']) && $_POST == 'celsius') { echo 'selected = "selected"';}  ?>    
                                                </option>
                                                <option value ='kelvin'> kelvin 
                                                    <?php if(isset($_POST['tempChange']) && $_POST == 'kelvin') { echo 'selected = "selected"';}  ?>    
                                                </option>
                                                
                                                </select>

                                        <input type="submit" >
                                        <p class='inline' id='reset'><a href=''>Reset me!</a></p>
                                        </fieldset>
                                        
                                        <p><?php echo $userInput ?></P> 
                                        <p><?php echo $userTemp ?></p>
                                        <p><?php echo $tempChangeUser ?></p>
                                    </form>
                                </div> 
                            

        <!-- start of if isset -->
        <?php 
            if(isset($_POST['temperature'], 
                    $_POST['tempChange'], 
                    $_POST['tempTypes']) && 
                    is_numeric($_POST['temperature'])){ 
                        
                        $userInput = $_POST['temperature']; 
                        $userTemp = $_POST['tempTypes'];
                        $tempChangeUser = $_POST['tempChange'];
//NEEDED FOR DIV RIGHT BELOW ?>
                

                    <div class='box'> 
                     <?php           
                            echo '<div class="box2">';
                            echo '<h2>Calculator Results</h2>';
                            echo "<p>You input ".$userInput." °" .$userTemp."</p>";  
                            echo "</div>";
                      }  //elseif isset  

                        //start of calculations 
                        if($userTemp === 'celsius'  && $tempChangeUser === 'celsius') { 
                            $convertedTemp= $userInput . '°C'; 
                        }else if($userTemp === 'fahrenheit' && $tempChangeUser === 'fahrenheit') { 
                            $convertedTemp= $userInput . '°F'; 
                        }else if($userTemp ===  'fahrenheit' && $tempChangeUser === 'celsius') { 
                            $convertedTemp= round(($userInput-32)*5/9, 2) . '°C'; 
                        }else if($userTemp ==='celsius' && $tempChangeUser === 'fahrenheit'){ 
                            $convertedTemp= round(($userInput*9/5) + 32, 2) . '°F';
                        }
                        //finish if statements for k to c, k to f, f to k, c to k
                     ?>
                     </div>   <!--End of calculations box -->

        
        <!-- error messages based on form -->
        <span><?php echo '<div id="error-box">'?></span>
        <span><?php echo $userInputErr ?><span> 
        <span><?php echo $userTempErr ?><span>
        <span><?php echo $tempChangeUserErr?><span>
        <span><?php echo $convertedTemp ?></span>
       
        <span><?php echo '</div">'?></span>
        </div>



<p><?php echo 'this is converted temp ' . $convertedTemp ?></p>
                                     
                           

                                

</div>

    
</body>
</html> 

<!-- 


2. wrote php for handeling form using post method (josh 1 hours 1/8.)
1. wrote html for fomr and page body (josh .5 hours  1/9). 

 -->
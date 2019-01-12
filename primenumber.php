<?php

   if($_GET)  {
    
        if(is_numeric($_GET["number"]) && $_GET["number"] >0 && $_GET["number"] == round($_GET["number"],0)) {
            if($_GET["number"] == 1 || $_GET["number"] == 0)  {
                echo "<p>".$_GET["number"]." is not a prime number!</p>";
            }  else {
    
            
           $i = 2;
            $isPrime = true;
           while($i < $_GET["number"])  {
            if($_GET["number"] % $i == 0)  {
                //Number is not prime
    
                $isPrime = false;
            }
            $i++;
           } 
    
           if($isPrime)  {
               echo "<p>".$_GET["number"]." is a prime number!</p>";
           } else {
            echo "<p>".$_GET["number"]." is not a prime number!</p>";
           }
        }
        } else {
            echo "<p> Please Enter a valid number</p>"; 
        }

        
   }

?>

<p> Please enter a whole number</p>

<form>

    <input name ="number" type="text">
    <input type="submit" value="Go!">

</form>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/ccad_tp.css" type="text/css" rel="stylesheet">
        <link href="css/c3.css" type="text/css" rel="stylesheet">
        

    </head>
    <body>
        <div id="ccad_bod">
            <p>Java1班荣誉出品</p>
            <?php 
        include_once 'mysql.php';

        ?>
        <div id="ccad_bod">
            <?php
            $ccad_set = "SELECT * FROM `zuming`";
            $ccad_que = mysqli_query($con, $ccad_set);
            $ccad_a = 1;
            $ccad_t = 1;
            $ccad_r = 1;
            $ccad_tst = 1;
            ?>   
            <?php
            while ($ccad_fetc = mysqli_fetch_assoc($ccad_que)){
            ?>
            <div id="caseBlanche" class="<?php echo "bt".$ccad_a++; ?>">
              <div id="rond" class="<?php echo "br".$ccad_r++; ?>">
                <div id="test" class="<?php echo "btst".$ccad_tst++; ?>"></div>
              </div>
                  <input type="button" 
                  ccadps="<?php echo $ccad_fetc['id'] ?>" 
                  class="ccad_zum <?php echo "bc".$ccad_t++; ?>" 
                  value="<?php echo $ccad_fetc['zm']; ?>"
                  >
            </div>
            <?php } ?>
            
        </div>
        <?php mysqli_close($con); ?>
        </div>
    </body>
</html>
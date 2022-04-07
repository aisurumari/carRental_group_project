<?php
session_start();
include "../src/CarDescription.php";
include ('../src/Authorization.php');
//protect endpoint
$authorozation = new Authorization();
$authorozation->protect_endpoint(1);

 $description = new CarDescription();
 $cars = $description->noweSamochody();

?>

<!DOCTYPE html>
<html>

<?php include('header.php') ?>

<h4 class="center grey-text">Opisy samochodów</h4>

<div class="container">
    <div class="row">
        <?php foreach ($cars as $car): ?>
            <div class="col s12 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?php echo $car->getName();?></h6>
                        <p><?php echo $car->intro();?></p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>

    <?php include('footer.php') ?>

</html>

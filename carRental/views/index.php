<?php
session_start();
include '../src/DatabaseControllerMP.php';
include ('../src/Authorization.php');
//protect endpoint
$authorozation = new Authorization();
$authorozation->protect_endpoint(1);

$db_controller = new DatabaseControllerMP();
	//wszystkie samochody - query
    $cars = $db_controller->allCars();


?>

<!DOCTYPE html>
<html>

<?php include('header.php') ?>

<div class="container">
    <div class="row">
        <?php foreach ($cars as $car){ ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($car['marka']);?></h6>
                        <div><?php echo 'liczba drzwi: '; echo htmlspecialchars($car['liczbaDrzwi']); ?></div>
                        <div><?php echo 'pojemność silnika: ';
                            echo htmlspecialchars($car['pojemnoscSilnika']);
                            echo ' L' ?></div>
                        <div><?php echo 'cena za dzień: ';
                            echo htmlspecialchars($car['cena']);
                            echo ' zł'; ?></div>
                    </div>
                    <div class='card-action right-align'>
                        <a class='brand-text' href='details.php?id=<?php echo $car['idSamochodu'];?>'>więcej informacji</a>
                    </div>
                </div>
            </div>

        <?php } ?>


        <div class="col s12 md3 ">
            <?php $ile = count($cars);
            if($ile==1){ ?>
                <h6>W wypożyczalni mamy łącznie 1 samochód </h6>
            <?php } if(($ile>=2 && $ile<=4) || ($ile>=22 && $ile<=24)){ ?>
                <h6>W wypożyczalni mamy łącznie <?php echo ($ile); ?> samochody </h6>
            <?php } if($ile>=5 && $ile<=21){ ?>
                <h6>W wypożyczalni mamy łącznie <?php echo ($ile); ?> samochodów </h6>
            <?php } ?>
        </div>
        <a href="../index.php" target="_self">Menu</a>

    </div>


<?php include("footer.php"); ?>

</html>
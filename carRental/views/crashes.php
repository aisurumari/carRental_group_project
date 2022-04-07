<?php
session_start();
include('../src/Crash.php');
include('../src/DatabaseControllerMP.php');
include ('../src/Authorization.php');
//protect endpoint
$authorozation = new Authorization();
$authorozation->protect_endpoint(1);

$bazaDanych = new DatabaseControllerMP();


$wypadek1 = new crash(1,650, "Wypadek na drzodze krajowe w Warszawie.", 3);
$wypadek2 = new crash(2,1650, "Wypadek w Warszawie. Zniszczenie maski samochodu oraz mienia miasta.", 7);
$wypadek3 = new crash(3,9650, "Wypadek na ulicy Rzgowskiej, TOTALNA ROZWAłKA.",8);

$wypadki = array($wypadek1,$wypadek2,$wypadek3);
$cars = $bazaDanych;

?>

<!DOCTYPE html>
<html>

<?php include('header.php') ?>
<h4 class="center grey-text">Wypadki samochodów w wypożyczalni:</h4>

<div class="container">
    <div class="row">
        <?php foreach ($wypadki as $wypadek): ?>
            <div class="col s12 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6>Wycena wypadku: <?php echo $wypadek->getWycenaWypadku();?> Zł</h6>
                        <p>Opis wypadku: <?php echo $wypadek->getOpisWypadku();?></p>
                        <p>Samochód biorący udział w wypadku: <?php echo $cars->findCar($wypadek->getIdSamochoduWypadkowego()); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>
<!--    <section class="container grey-text">-->
<!--        <h4 class="center">Dodaj nowy wypadek</h4>-->
<!--        <form class="white" action="addCrash.php" method="POST">-->
<!--            <label>Wycena wypadku: </label>-->
<!--            <input type="text" name="wycenaWypadku">-->
<!--            <label>Opis wypadku: </label>-->
<!--            <input type="text" name="opisWypadku">-->
<!--            <label>ID samochodu biorącego udział w wypadku: </label>-->
<!--            <input type="text" name="idSamochoduWypadkowego">-->
<!--            <div class="container">-->
<!--                <input type="submit" name="DodajWypadek" value="Dodaj nowy wypadek" class="btn brand z-depth-0">-->
<!--            </div>-->
<!--        </form>-->
<!--    </section>-->

<?php include('footer.php') ?>

</html>

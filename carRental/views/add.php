<?php
session_start();
include('../src/DatabaseControllerMP.php');
include ('../src/Authorization.php');
//protect endpoint
$authorozation = new Authorization();
$authorozation->protect_endpoint(1);

 $conn = new DatabaseControllerMP();
 $marka = $liczbaDrzwi = $pojemnoscSilnika = $cena = '';
$errors = array('marka' => '', 'liczbaDrzwi' => '', 'pojemnoscSilnika' => '', 'cena' => '');


if (isset($_POST['Dodaj'])) {

//czy wszystko wpisane dobrze
if (empty($_POST['marka'])) {
    $errors['marka'] = "Podaj markę samochodu!<br />";
} else {
    $marka = $_POST['marka'];
}


if (empty($_POST['liczbaDrzwi'])) {
    $errors['liczbaDrzwi'] = "Podaj liczbę drzwi samochodu!<br />";
} else {
    $liczbaDrzwi = $_POST['liczbaDrzwi'];
    if (!filter_var($liczbaDrzwi, FILTER_VALIDATE_INT))
        $errors['liczbaDrzwi'] = 'Liczba drzwi musi być liczbą całkowitą<br />';
}


if (empty($_POST['pojemnoscSilnika'])) {
    $errors['pojemnoscSilnika'] = "Podaj pojemność silnika samochodu!<br />";
} else {
    $pojemnoscSilnika = $_POST['pojemnoscSilnika'];
    if (!filter_var($pojemnoscSilnika, FILTER_VALIDATE_FLOAT))
        $errors['pojemnoscSilnika'] = 'Pojemność silnika musi być liczbą zmiennoprzecinkową(z kropką)<br />';
}


if (empty($_POST['cena'])) {
    $errors[cena] = "Podaj cenę samochodu!<br />";
} else {
    $cena = $_POST['cena'];
    if (!filter_var($cena, FILTER_VALIDATE_INT))
        $errors[cena] = 'Cena musi być liczbą całkowitą<br />';
}

if (array_filter($errors)) {
    echo 'Błędny wpis! Nie dodano!';
} else {
    $conn->addCar($marka,$liczbaDrzwi,$pojemnoscSilnika,$cena);
}

}
?>

<!DOCTYPE html>
<html>

<?php include('header.php') ?>

<section class="container grey-text">
	<h4 class="center">Dodaj Samochód</h4>
	<form class="white" action="add.php" method="POST">
		<label>Marka samochodu:</label>
		<input type="text" name="marka">
		<label>Liczba drzwi samochodu:</label>
		<input type="text" name="liczbaDrzwi">
		<label>Pojemność silnika samochodu:</label>
		<input type="text" name="pojemnoscSilnika">
		<label>Cena samochodu:</label>
		<input type="text" name="cena">

		<div class="container">
			<input type="submit" name="Dodaj" value="Dodaj" class="btn brand z-depth-0">
		</div>
	</form>
</section>

<?php include('footer.php') ?>
<a href="../index.php" target="_self">Menu</a>
</html>
<?php
session_start();
include('../src/DatabaseControllerMP.php');
include ('../src/Authorization.php');
//protect endpoint
$authorozation = new Authorization();
$authorozation->protect_endpoint(1);

$bazaDanych= new DatabaseControllerMP();

if(isset($_GET['id'])){

$cars=$bazaDanych->getDetails();
}

if(isset($_POST['delete'])){

$bazaDanych->deleteCar();
}

if(isset($_POST['edit'])){
$bazaDanych->editCar();
}


?>

<!DOCTYPE html>
<html>
<?php include('header.php') ?>

	<div class="container center">
		<?php if($cars): ?>
			<h4><?php echo $cars['marka']; ?></h4>
			<h5>Liczba drzwi: <?php echo $cars['liczbaDrzwi']; ?></h5>
			<h5>Pojemność silnika: <?php echo $cars['pojemnoscSilnika']; ?> L</h5>
			<h5>Cena: <?php echo $cars['cena']; ?> Zł</h5>
				<?php if($cars['bezwypadkowe']==0){ ?>
				<p>WYPADKOWE</p>
				<?php } else { ?>
				<p>BEZWYPADKOWE</p>
				<?php } if($cars['dostepnoscSamochodu']==0){ ?>
				<p>Samochód obecnie wynajęty.</p>
				<?php } else{ ?>
				<p>Samochód dostępny.</p>

			<!-- usuwanko -->
			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $cars['idSamochodu'] ?>">
				<input type='submit' name='delete' value='USUŃ SAMOCHÓD' class='btn brand z-depth-0'>
                <input type="hidden" name="id_to_edit" value="<?php echo $cars['idSamochodu'] ?>">
                <input type='submit' name='edit' value='ZMIEŃ WYPADKOWOŚĆ' class='btn brand z-depth-0'>
			</form>
		<?php }else: ?>
			<h5>Nie istnieje taki samochód.</h5>
		<?php endif ?>
	</div>

<a href="../index.php" target="_self">Menu</a>

<?php include('footer.php') ?>
</html>
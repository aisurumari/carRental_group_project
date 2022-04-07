<?php
session_start();
include "../src/DatabaseControllerMP.php";
include ('../src/Authorization.php');
//protect endpoint
$authorozation = new Authorization();
$authorozation->protect_endpoint(1);

$ubezpieczyciel = new DatabaseControllerMP();
$insurancers = $ubezpieczyciel->allInsurancers();

if(isset($_POST['UsunUbezpieczyciela'])) {
 $ubezpieczyciel->deleteInsurancer();
}

?>


<html lang="pl">

<?php include('header.php') ?>

<div class="container">
    <div class="col s6 md3">
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            Kliknięcie przycisku "usuń" jest definitywne i ostateczne!
        </div>
    </div>
    <div class="row">
        <?php foreach ($insurancers as $insurancer){ ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($insurancer['nazwaUbezpieczyciela']);?></h6>
                        <div><?php echo 'siedziba firmy: '; echo htmlspecialchars($insurancer['siedzibaFirmy']); ?></div>
                        <form action="insurancer.php" method="POST">
                            <input type="hidden" name="id_to_delete" value="<?php echo $insurancer['idUbezpieczyciela'] ?>">
                            <input type='submit' name='UsunUbezpieczyciela' value='Usuń' class='btn brand z-depth-0'>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <a href="../index.php" target="_self">Menu</a>
</div>

<section class="container grey-text">
    <h4 class="center">Dodaj Ubezpieczyciela</h4>
    <form class="white" action="addInsurencer.php" method="POST">
        <label>Nazwa ubezpieczyciela: </label>
        <input type="text" name="nazwaUbezpieczyciela">
        <label>Ulica i numer ulicy oraz miasto siedziby firmy: </label>
        <input type="text" name="siedzibaFirmy">

        <div class="container">
            <input type="submit" name="DodajUbezpieczyciela" value="Dodaj Ubezpieczyciela" class="btn brand z-depth-0">
        </div>
    </form>
</section>



<?php include('footer.php') ?>

</html>
<?php


class crash
{
    protected $idWypadku;
    public $wycenaWypadku;
    public $opisWypadku;
    public $idSamochoduWypadkowego;

    /**
     * @return mixed
     */
    public function getIdSamochoduWypadkowego()
    {
        return $this->idSamochoduWypadkowego;
    }
    /**
     * @return mixed
     */
    public function getWycenaWypadku()
    {
        return $this->wycenaWypadku;
    }

    /**
     * @return mixed
     */
    public function getOpisWypadku()
    {
        return $this->opisWypadku;
    }


    /**
     * crash constructor.
     * @param $idWypadku
     * @param $wycenaWypadku
     * @param $opisWypadku
     */
    public function __construct($idWypadku, $wycenaWypadku, $opisWypadku, $idSamochoduWypadkowego)
    {
        $this->idWypadku = $idWypadku;
        $this->wycenaWypadku = $wycenaWypadku;
        $this->opisWypadku = $opisWypadku;
        $this->idSamochoduWypadkowego = $idSamochoduWypadkowego;
    }

//    public function findCar($id){
//
//        $idSamochoduWypadkowego = mysqli_real_escape_string($conn, $id);
//        $sql = "SELECT * FROM car WHERE idSamochodu = $idSamochoduWypadkowego";
//        $result = mysqli_query($conn, $sql);
//        $cars = mysqli_fetch_assoc($result);
//
//        mysqli_free_result($result);
//        mysqli_close($conn);
//
//        return $cars['marka'];
//    }


}
?>



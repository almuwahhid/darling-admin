<?php
class Helper{
  public function klasifikasiKomentar($jumlah_item, $total_nilai){
    switch ($jumlah_item) {
      case 2:
      if($total_nilai > 5){
        return "plus";
      } else {
        return "minus";
      }
      break;

      case 3:
      if($total_nilai > 7){
        return "plus";
      } else {
        return "minus";
      }
      break;

      case 4:
      if($total_nilai > 10){
        return "plus";
      } else {
        return "minus";
      }
      break;

      case 5:
      if($total_nilai > 12){
        return "plus";
      } else {
        return "minus";
      }
      break;

      case 6:
      if($total_nilai > 15){
        return "plus";
      } else {
        return "minus";
      }
      break;

      default:
      return "";
      break;
    }
  }

  public function getTypeScore($nilaiPertanyaanByAspek, $median){
    if($nilaiPertanyaanByAspek >= $median){
      return "t";
    } else {
      return "r";
    }
  }
}
?>

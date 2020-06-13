<?php 
include_once('idiorm.php');
include_once('connection.php');
include_once('paris.php');

  class Item extends Model{
    public static $item_table = 'item';
    

  public function Drag($position, $id){

    foreach($id as $k=>$v)
    {
      $drag = ORM::for_table('item')->use_id_column('Id')->find_one($v);
      $drag->itemPosition = $position;
      $drag->save();  
      $position++;
    }   
  }
  
}


?>
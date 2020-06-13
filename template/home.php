<html>
<?php 
$n=1;



?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=us-ascii" />
  <link rel="stylesheet" href="/Todo_slim/template/style.css" type="text/css" />
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <title></title>


 
</head>
    
<body>
  <div id="page-wrap">
    <div id="header">
      <h1><a href="">PHP Sample Test App</a></h1>
    </div>

    <div id="main">
      <noscript>This site just doesn't work, period, without JavaScript</noscript>
       <div id='response'></div>
    


    <?php if(!empty($items)): ?>
    <ul onload="ViewData()" id="list"  class="sortable listitems ui-sortable">

    <?php 
    
    foreach ($items as $item):
        {
         $n = $item->itemPosition;
         if(empty($n)){
          $n=1;
         }
        }
     
   
        $isDone="isdone";
        $isdone= $item->isdone;

        if($isdone==true){
          $isDone="isdone";
        } else if($isdone==false) {
          $isDone="";
        }
        


?>



 
          <li id="<?php echo $item->Id;?>" color="1" class="<?php echo $item->listColor ?>" data-position="<?php echo $item->itemPosition?>">
          <span id="7listitem" class="changed <?php echo $isDone ?>" title="Double-click to edit..."><?php echo $item->description; ?></span>

          <div class="draggertab tab"></div>

          <div id="color_tab" class="colortab tab"></div>
        <!--   <a class="delete" del-id="<?php echo $item->Id;?>" href="/Todo_slim/public/del?item=<?php echo $item->Id;?>">  -->
            <a class="delete" del-id="<?php echo $item->Id;?>">

         <div class="deletetab tab"></div>
          </a>
        <!--   <a class="done" done_id="<?php echo $item->Id; ?>" href="/Todo_slim/public/done?mark_id=<?php echo $item->Id; ?>">
 -->       <a class="done" done_id="<?php echo $item->Id; ?>">
          <div class="donetab tab"></div>
        </a>
        </li>

 
    <?php   $n=$n+1;  endforeach;
        ?>
    </ul>
    <?php else:?>
      <p>You Haven't added any items yet.</p>
    <?php  endif; ?>

   
   
      <form    id="add-new" method="post">
        <input type="text" id="new-list-item-text" position="<?php echo $n;?>" name="name" />
        <input type="submit" name="add" id="add-new-submit" value="Add" class="button" />
      </form>
      

      <div class="clear"></div>
    </div>
  </div>

 
<!-- <script>
  function ViewData(){
            $.ajax({
            type:"get",
            url:'/Todo_slim_paris/public/',
            
            success:function(data){
               $("ul").prepend(data);
            }
           
    });
  }
</script> 
 -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script  src="/Todo_slim_paris/template/function.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>
</html>
 
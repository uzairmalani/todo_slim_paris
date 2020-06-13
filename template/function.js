
$(document).ready(function(){
  //Color Changing
  $(".colortab").click(function()
  {
    $(this).parent('li').find('.changed').each(function(index)
    {
      var back = ["#73b8bf","#91bf4b",'#c15c5c'];
      var rand = back[Math.floor(Math.random() * back.length)];
      var color="";
      if(rand == "#73b8bf"){
      color="colorBlue";
     }else if(rand == "#91bf4b"){
       color="colorGreen";
     }else if(rand == "#c15c5c"){
       color="colorRed";
     }
      $(this).css("background" , rand);
      var ID = $(this).parent().attr("id");
      

      $.ajax(
      {
        method: 'POST',
        url: '/Todo_slim_paris/public/color',
        data: 
        {
          ajax: 1,
          Color: color,
          id : ID,
        },
        success: function(res)
        {
        console.log('Color', res)
        }
      });
    });
  });

//Delete
  $('.delete').click(function() 
  {
    $('.deletetab', this).addClass('deleted');
    setTimeout(function () 
  {
      $('.deletetab').removeClass('deleted');
  }, 1000);
    
    return false;

  }).dblclick(function() 
  { 
     $(this).parent().remove();

    var del_id=$(this).attr("del-id");
    
    // window.location = this.href;
       $.ajax(
      {
        method: 'POST',
        url:'/Todo_slim_paris/public/del',
        data:
        {
          delItem:del_id
        },

       success:function(data){


            },
        

              
      });
    

   

  });

//drag and drop
  $( ".sortable" ).sortable(
  {
    delay: 150,
    stop: function() 
    {
      var selectedData = new Array();
      $('.sortable>li').each(function()
      {
        selectedData.push($(this).attr("id"));
      });
      $.ajax(
      {
        method: 'POST',
        url:'/Todo_slim_paris/public/drag',
        data:
        {
          position:selectedData
        },
        success:function()
        {}
        
      });
    }
  });
//SORTING
 $(".listitems li").sort(sort_li).appendTo('.listitems');
  function sort_li(a, b) 
  {
    return ($(b).data('position')) < ($(a).data('position')) ? 1 : -1;
  }

  $('.done').click(function(){
    var done_id=$(this).attr("done_id");
    $(this).parent().find('span').addClass('isdone');
    $.ajax(
      {
        method: 'POST',
        url:'/Todo_slim_paris/public/done',
        data:
        {
          doneItem:done_id
        },
        success:function()
        {}
        
      });

  });


  $(document).on('submit' , '#add-new' ,function(event){
    event.preventDefault();

    if($("#new-list-item-text").val()==""){
      alert('Enter Task');
    }else{
      var description=$("#new-list-item-text").val();
      var pos = $("#new-list-item-text").attr("position");
      var posi = $('li').last().attr("data-position");
      var li_class="colorBlue";
      var ItemID=$(".delete").last().attr("del-id");
      ItemID++;
      posi++;


      
      if(isNaN(posi))
        posi=1;
      

      $('ul').append('<li id='+ItemID+' color="1" class="'+li_class+' ui-sortable-handle" data-position='+posi+'><span id="7listitem" class="changed " title="Double-click to edit...">'+description+
      '</span><div class="draggertab tab"></div><div id="color_tab" class="colortab tab"></div><a class="delete" del-id='+ItemID+
      ' href="#"><div class="deletetab tab"></div></a><a class="done" done_id='+ItemID+'><div class="donetab tab"></div></a></li>');
   
      pos++;
      $.ajax({
        url:'/Todo_slim_paris/public/add',
        method:"post",
        data:{
          desc:description,
          pos:posi
        },
        success:function(data){
          $('#new-list-item-text').val("");          


        }

      });
    }


  });



$("body").delegate(".colortab", "click", function(){
  $(this).parent('li').find('.changed').each(function(index)
    {
      var back = ["#73b8bf","#91bf4b",'#c15c5c'];
      var rand = back[Math.floor(Math.random() * back.length)];
      var color="";
      if(rand == "#73b8bf"){
      color="colorBlue";
     }else if(rand == "#91bf4b"){
       color="colorGreen";
     }else if(rand == "#c15c5c"){
       color="colorRed";
     }
      $(this).css("background" , rand);
      var ID = $(this).parent().attr("id");
      

      $.ajax(
      {
        method: 'POST',
        url: '/Todo_slim_paris/public/color',
        data: 
        {
          ajax: 1,
          Color: color,
          id : ID,
        },
        success: function(res)
        {
        console.log('Color', res)
        }
      });
    });
});


$("body").delegate(".done", "click", function(){
    var done_id=$(this).attr("done_id");
    $(this).parent().find('span').addClass('isdone');
    $.ajax(
      {
        method: 'POST',
        url:'/Todo_slim_paris/public/done',
        data:
        {
          doneItem:done_id
        },
        success:function()
        {}
        
      });

  });

$("body").delegate(".delete", "click", function(){
    $('.deletetab', this).addClass('deleted');
    setTimeout(function () 
  {
      $('.deletetab').removeClass('deleted');
  }, 1000);
    
    return false;

  });
$("body").delegate(".delete", "dblclick", function() { 
     $(this).parent().remove();

    var del_id=$(this).attr("del-id");
    
    // window.location = this.href;
       $.ajax(
      {
        method: 'POST',
        url:'/Todo_slim_paris/public/del',
        data:
        {
          delItem:del_id
        },

       success:function(data){


            },
        

              
      });
    

   

  });


  });

<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <style>
       * {
           box-sizing: border-box;
           margin: 0;
           padding: 0;
       }
       body {
           background: #20262E;
           padding: 20px;
           font-family: Helvetica;
       }
       .container {
           width: 600px;
           margin: 0 auto;
       }
       .btn {
           background: #0084ff;
           border: none;
           border-radius: 5px;
           padding: 8px 14px;
           font-size: 15px;
           color: #fff;
           width: 80px;
           float: right;
       }
       .todo-form input {
           padding: 8px 14px;
           width: 80%;
       }
       .todo-list {
           list-style-type: none;
           color: white;
       }
       .todo-list li {
           text-decoration: none;
           clear: both;
           padding-top: 20px;
       }
   </style>
</head>
<body>
<div class="container">
   <form action="" class="todo-form">
       <input type="text" name="title">
       <button type="button" class="btn btn-add">Add</button>
   </form>
   <ul class="todo-list"></ul>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
var form = $('.todo-form'),
    btnAdd = $('.btn-add');
  btnAdd.click(function(){
    $.ajax({
      url: '/todos',
      method: 'POST',
      data: form.serialize()
    }).done(function(data){
      loadTodos();
    })
  });  


  var todoList = $('.todo-list');
  
  function loadTodos() {
    $.ajax({
      url: '/todos'
    }).done(function(data){
	todoList.empty();
      data.forEach(function(item){
	todoList.append(renderItem(item));
});
    });
  }

  loadTodos();

todoList.on('click', '.btn-delete', function(e){
	var id = $(e.target).data('id');
    $.ajax({
      url: '/todo/' + id,
      method: 'DELETE'
    }).done(function(){
      loadTodos();
    });
  });

  function renderItem(item) {
       return'<li><span>'+item.title+'</span><button data-id="'+item.id+'" class="btn btn-delete">Delete</button></li>';
   }

</script>
</body>
</html>

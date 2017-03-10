<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/adminSelect.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <title> </title>
    </head>
    <body>
        <div class="form-group">
          <label for="sel1">Select list:</label>
          <select class="form-control" id="sel1">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
          </select>
          
        </div>
        <h1>Game Search</h1>
      <input id="game" type="text" /><button id="search">Search</button>
      <div id="myelement"></div>
     
    </body>
</html>

<?php

?>

<script>
    $("#city").autocomplete({
        
        source: function (request, response) {
        
        $.ajax({
        
        url: "http://api.giantbomb.com/search/?query=" + request.term + "&api_key=mykey&format=jsonp&json_callback=myCallback&field_list=name",
        
        dataType: "jsonp",
        
        jsonpCallback: 'myCallback',
        
        data: {
        
        maxRows: 12,
        
        name_startsWith: request.term
        
        },
        
        success: function myCallback (data) {
        
        response($.map(data.results, function (item) {
        
        return {
        
        label: item.name,
        
        value: item.name
        
        }
        
        }));
        
        }

});
</script>
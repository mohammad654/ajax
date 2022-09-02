<?php
include_once 'header.php';
include_once 'mainClass.php';
?>

<div class="container bg-secondary p-4">
   <span id="message"></span>
    <form id="dataForm" method="POST">
        <div class="form-group">
            <label>Artist </label>
            <input type="text" class="form-control" id="artist" placeholder="artist">
        </div>
        <div class="form-group mt-2">
            <label>Song</label>
            <input type="text" name="song" id="song" class="form-control"  placeholder="Song"/>
        </div>
        <button type="submit" class="btn btn-primary mt-2 form-control" id="add_artist" name="add_artist">Add Artist</button>
    </form>
</div>

<div class="container mt-5">

    <table class="table table-bordered table-striped">
        <h1 class="text-center">Database</h1>
        <thead>
        <tr>
            <th>ID</th>
            <th>Artist</th>
            <th>Song</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $database= new database();
        $database->index();
        foreach ( $database->index() as $row){
            ?>
            <tr class="">
                <td ><?=htmlspecialchars($row['id']); ?></td>
                <td><?=htmlspecialchars($row['artist']); ?></td>
                <td><?=htmlspecialchars($row['song']); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <table class="table table-bordered table-striped">
        <h1 class="text-center">AJAX</h1>
        <thead>
        <tr>
            <th>ID</th>
            <th>Artist</th>
            <th>Song</th>
        </tr>
        </thead>
        <tbody id="table">
        </tbody>
    </table>

</div>
<div id="test"></div>
<script>

var cb = function(){
            // window.document.location.href="index.php";
        }
$("#add_artist").on('click',function(e){
                e.preventDefault();

    var name=document.getElementById('song').value;
    var email=document.getElementById('artist').value;
                var formData = {
                    artist: $("#artist").val(),
                    song: $("#song").val()
                };
                if(formData.artist != '' && formData.song !=''){

                $.ajax({url: "mainClass.php?ajax",
                    type: 'POST',
                    data: formData,
                    complete: cb,
                    timeout: 4444,
                    // dataType: "text",
                    success: function(response)
                    {
                       console.log(formData.artist);
                      //  console.log(this);
                      console.log(response);

                       $('.table tr:last').after('<tr><td>#</td><td>' + formData.artist + '</td><td>' + formData.song + '</tr>');

                        document.getElementById('message').innerHTML=" <p class='alert alert-success'>Form submitted successfully</p>";
                    }
                });
                }else {
                    document.getElementById('message').innerHTML=" <p class='alert alert-danger '>Error: all fields are required</p>";
                }
   });

    </script>

<?php

include_once 'footer.php';
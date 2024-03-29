<?php session_start();

if(empty($_SESSION['username'])) header("Location: http://{$_SERVER['HTTP_HOST']}/kuba/login"); //ZMIEN
?>
<html>
<head>
    <title>test project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script>
       function ajax_func(){
			
            xmlhttp = new XMLHttpRequest();
            
            xmlhttp.onreadystatechange = function (){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById('ret_data').innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open('GET', 'process_ajax.php', true);
            xmlhttp.send();
        }
        
        // Inserting data to the database
        function submit_form(){
            
            var user_form = document.getElementById('user_form');
            
            var username = document.getElementById('username').value,
                email = document.getElementById('email').value,
                contactnumber = document.getElementById('contactnumber').value,
                notes = document.getElementById('notes').value;
            
                //Ajax Processing from here
                
                xmlhttp.onreadystatechange = function (){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                        document.getElementById('ret_data').innerHTML = xmlhttp.responseText;
                    }
                }
                
                xmlhttp.open('GET', 'process_ajax.php?submit_form=yes&name='+username+'&email='+email+'&contactnumber='+contactnumber+'&notes='+notes, true);
                xmlhttp.send();
                // Ajax Ending
                
                $('#add_new_person').modal('hide');
                
                user_form.reset();
                
                
            return false;
        }
        
        // Deleting data from the database
        
        function delete_func(del_id){
            
            xmlhttp.onreadystatechange = function (){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById("ret_data").innerHTML = xmlhttp.responseText;
                }
            }
            
            xmlhttp.open('GET', 'process_ajax.php?del_id='+del_id, true);
            xmlhttp.send();
        }
        
        // Edit Function
        
        function edit_form(edit_id){
        
            var edit_form = document.getElementById('edit_form'+edit_id);
            
            var edit_username = document.getElementById('edit_username'+edit_id).value,
                edit_email = document.getElementById('edit_email'+edit_id).value,
                edit_contactnumber = document.getElementById('edit_contactnumber'+edit_id).value,
                edit_notes = document.getElementById('edit_notes'+edit_id).value;
                
                
                xmlhttp.open('GET', 'process_ajax.php?edit_form=yes&edit_id='+edit_id+'&edit_username='+edit_username+'&edit_email='+edit_email+'&edit_contactnumber='+edit_contactnumber+'&edit_notes='+edit_notes, true);
                xmlhttp.send();
                
                
                $('#edit_person'+edit_id).modal('hide');
                
                edit_form.reset();
            return false;
        }
        
    </script>
</head>
<body onload="ajax_func();">
    <div class="container">
        <br><br>
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-backdrop="static" data-target="#add_new_person">Add New Person</button><br><br>
        
        <div class="modal fade" id="add_new_person">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4>Add New Person</h4>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="return submit_form();" id="user_form">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" id="contactnumber" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea class="form-control" id="notes"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info btn-block btn-lg">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="text-right">
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered text-center" >
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Notes</th>
                    <th>Edit / Delete</th>
                </tr>
            </thead>
            <tbody id="ret_data">
            
            </tbody>
        </table>
    </div>
</body>
</html>
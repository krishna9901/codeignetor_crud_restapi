<html>
<head>
    <title>CodeigniterCURD REST API PHP TASK </title>
 
	
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
 

 
</head>
<body>



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <h3 align="center">__ToDo List</h3>
</nav> 
    <div class="container">
        <br />
        <div class="row">
        <div class="col-md-8"> 
      
        <br />
        
            <div class="panel-body">
                <span id="success_message"></span>
           
        </div>
    </div>

  
<div class="col-md-4">
   

<form method="post" id="user_form"  style="margin-top: 17px;">
            <div class="modal-content">
                
                <div class="modal-body">
                <label class="required-field text-center">Title</label>
                    <input type="text" name="title" id="title" class="form-control " />
                    <span id="title_error" class="text-danger"></span>
                    <br/>
                    <label  class="required-field text-center ">Details</label>
                    
                    <textarea id="details" name="details" rows="4" cols="50" class="form-control"></textarea><br><br>
                    <span id="details_error" class="text-danger"></span>
                    <br />
                    
                    <label class="required-field text-center " for="date">Date:</label>
                    
                    <input type="datetime-local" name="datetime" id="datetime" class="form-control" />
</br>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" id="user_id" />
                    <input type="hidden" name="data_action" id="data_action" value="Insert" />
                    <input type="submit" name="action" id="action" class="btn btn-light btn-center" value="Submit" />
               </div>
            </div>
        </form>



</div>
  


</div>

	
	
</body>
</html>










<script type="text/javascript" language="javascript" >
$(document).ready(function(){
    
    function fetch_data()
    {
        $.ajax({
            url:"<?php echo base_url(); ?>test_api/action",
            method:"POST",
            data:{data_action:'fetch_all'},
            success:function(data)
            {
                $('.panel-body').html(data);
            }
        });
    }

    fetch_data();

    $('#add_button').click(function(){
        $('#user_form')[0].reset();
        $('.modal-title').text("Add User");
        $('#action').val('Add');
        $('#data_action').val("Insert");
        $('#userModal').modal('show');
    });

    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        $.ajax({
            url:"<?php echo base_url() . 'test_api/action' ?>",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            {
                if(data.success)
                {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    fetch_data();
                    if($('#data_action').val() == "Insert")
                    {
                        $('#success_message').html('<div class="alert alert-success alert-dismissible"> Data Inserted! <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                    }
                }

                if(data.error)
                {
                    $('#title_error').html(data.title_error);
                    $('#details_error').html(data.details_error);
                    $('#first_name_error').html(data.first_name_error);
                    $('#last_name_error').html(data.last_name_error);
                    $('#datetime_error').html(data.datetime);
                }
            }
        })
    });

    $(document).on('click', '.edit', function(){
        var user_id = $(this).attr('id');
        $.ajax({
            url:"<?php echo base_url(); ?>test_api/action",
            method:"POST",
            data:{user_id:user_id, data_action:'fetch_single'},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#title').val(data.title);
                $('#details').val(data.details);
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#datetime').val(data.datetime);
                $('.modal-title').text('Edit User');
                $('#user_id').val(user_id);
                $('#action').val('Edit');
                $('#data_action').val('Edit');
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var user_id = $(this).attr('id');
        if(confirm("Are you sure you want to delete this?"))
        {
            $.ajax({
                url:"<?php echo base_url(); ?>test_api/action",
                method:"POST",
                data:{user_id:user_id, data_action:'Delete'},
                dataType:"JSON",
                success:function(data)
                {
                    if(data.success)
                    {
                       $('#success_message').html('<div class="alert alert-danger alert-dismissible"> Data Deleted! <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                        fetch_data();
                    }
                }
            })
        }
    });
    
});


function updateDateTime() {
        // create a new `Date` object
        const now = new Date();

        // get the current date and time as a string
        const currentDateTime = now.toLocaleString();

        // update the `textContent` property of the `span` element with the `id` of `datetime`
        document.querySelector('#datetime').textContent = currentDateTime;
      }

      // call the `updateDateTime` function every second
      setInterval(updateDateTime, 1000);

</script>


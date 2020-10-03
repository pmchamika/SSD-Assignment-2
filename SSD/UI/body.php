<?php include "Select.php";?>
        <!-- Projects-->
        <section class="projects-section bg-light" id="post">
            <div class="container" id="dis">
                <!-- Featured Project Row-->
                
            </div>
                
        </section>
        
       

<script>
    
    $( document ).ready(function() {
        getPost();
    });

    function getPost(){
        $('#dis').html("<div align='center'><img src='assets/img/lo1.gif'/><div>");
        let val=$('#pagename').val();

        $.ajax({
                url: 'Controller/PostLoad.php',
                type: 'GET',
                data: {val:val},
                dataType: 'text',
                success: function(response)
                {	
                   
                    $('#dis').html(response);
                    
                	
                },
                error: function(response) {
						 console.log(response); 
				}
					
					
         });

    }

    function nextpost(type){
        $('#dis').html("<div align='center'><img src='assets/img/lo1.gif'/><div>");
        let val=$('#pagename').val();
        $.ajax({
                url: 'Controller/PostLoadNext.php',
                type: 'GET',
                data: {val:val,type:type},
                dataType: 'text',
                success: function(response)
                {	
                   
                    $('#dis').html(response);
                    
                	
                },
                error: function(response) {
						 console.log(response); 
				}
					
					
         });

    }
</script>
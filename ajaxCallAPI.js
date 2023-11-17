$(document).ready(function() 
    {
        // ************** SHOW ALL AVAILABLE SUBJECTS *********//
        
        
        function updateTable()
        {
            $.ajax({
                url:'API/showAll.php',
                method:'post',
                dataType:'JSON',
                success:function(data)
                {
                     console.log(data);
                     var tbody = $('#tbody');
                     
                    
                    var output = "";
                    console.log(data.length);

                    for (let i = 0; i < data.length; i++) 
                    {
                        output += '<tr><th scope="row">' + data[i].id + '</th><td>SUB00' + data[i].id + '</td><td>' + data[i].name + '</td></tr>';
                    }

                    tbody.html(output);
                },
                error:function(e)
                {
                    console.log(e);
                }
            })
        }
        
        updateTable();
        
        //<--- ADD NEW SUBJECT API CALL AJAX ----<<
        
        $('#subfrm').submit(function(e)  
        {
            e.preventDefault(); 

            // Get the form data
            var formData = $(this).serialize();

            $.ajax({
                url: 'API/addsubject.php',
                method: 'post',
                data: formData, 
                success: function(data) {
                    console.log(data);
                    updateTable();
                    
                },
                error: function(e) {
                    console.log(e);
                    console.log("error");
                }
            });
        });
        
        //*******************   LOGIN API CALL  *********************//
        
       //********************   LOGOUT API CALL ********************//
       
       
    });


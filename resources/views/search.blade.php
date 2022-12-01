<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>people data</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    
   
    <style>
        main{
            margin:10px;
        }
        h1 {
            text-align: center;
            color: blueviolet;
            margin: 20px;

        }

        .alert-success2 {
            background-color: rgb(181, 145, 214) !important;
            color: black !important;
        }
        .alert-warning2 {
            background-color: rgb(157, 217, 224) !important;
            color: black !important;
        }

     /* table td {
        background-color: rgb(10, 10, 235); 
     } */
     .thead-dark {
        background-color: rgb(81, 81, 109);
        color:white;
     }
       
    </style>
</head>
<body>
    <main>
        <h1>search People Data</h1>
        <label for="search">search :
            <input type="search" id="search">
        </label>
        
        <table class="table table-striped table-bordered" id="myTable">
           
            <thead class="thead-dark">
                <tr>
                    <th>User id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <th>Job Title</th>
                </tr>
            </thead>
         
        </table>
    </main>
   
<script>
    $(document).ready(function(){
    var searchTerm="";
 $('input').keyup(function() {
      searchTerm=$('#search').val();
    alert(searchTerm);
    var table =  $('#myTable').DataTable({
          processing: true,
          serverSide: true,
          "bDestroy": true,
          ajax: {
            url: '/search-term',
            data: function(d) {
                d.search = searchTerm
            }},
          columns: [
                   { data: 'User_Id', name: 'User_Id' },
                   { data: 'First_Name', name: 'First_Name' },
                   { data: 'Last_Name', name: 'Last_Name' },
                   { data: 'Sex', name: 'Sex' },
                   { data: 'Email', name: 'Email' },
                   { data: 'Phone', name: 'Phone' },
                   { data: 'Date_of_birth', name: 'Date_of_birth' },
                   { data: 'Job_Title', name: 'Job_Title' }
                ]
                
       });
    });
    });
</script>

</body>
</html>

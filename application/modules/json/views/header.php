<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
 <html lang="hu">
  <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Feladat :: Elme-Project Kft-től</title>
   <base href="<?php echo base_url(); ?>">
   <link rel="stylesheet" href="<?php echo base_url("/assets/node_modules/bootstrap/dist/css/bootstrap.css"); ?>">
   <script src="<?php echo base_url("/assets/node_modules/jquery/dist/jquery.min.js"); ?>"></script>
   <script src="<?php echo base_url("/assets/node_modules/popper.js/dist/popper.min.js"); ?>"></script>
   <script src="<?php echo base_url("/assets/node_modules/bootstrap/dist/js/bootstrap.js"); ?>"></script>
   <link rel="stylesheet" href="<?php echo base_url("/assets/node_modules/bootstrap/dist/css/bootstrap-grid.min.css"); ?>">
   <link rel="stylesheet" href="<?php echo base_url("/assets/node_modules/bootstrap/dist/css/bootstrap-reboot.min.css"); ?>">
   <script src="<?php echo base_url("/assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"); ?>"></script>
   <link rel="stylesheet" href="<?php echo base_url("/assets/css/SajatResponsestyle.css"); ?>">
   <link href="<?php echo base_url("/assets/node_modules/font-awesome/css/font-awesome.min.css"); ?>">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
   <link rel="stylesheet" type="text/css" href="//github.com/downloads/lafeber/world-flags-sprite/flags32.css"/>
   <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
   <meta name="robots" content="noindex, noimageindex, nofollow, nosnippet">
   <meta name="googlebot" content="noindex, noimageindex, nofollow, nosnippet">
    <script type="text/javascript">
    $(document).ready(function(){
      $('#myTable').DataTable({
        "ajax": '<?php echo site_url(); ?>/json/ajax/myData',
        "order": [[ 0, "asc" ]],
        "lengthMenu": [[10], [10]],
        "columnDefs": [
            {
                "targets": [ 0 ],
                "searchable": true
            },
            {
                "targets": [ 1 ],
                "searchable": false
            },
            {
                "targets": [ 2 ],
                "searchable": false
            },
            {
                "targets": [ 3 ],
                "searchable": false
            }
            ,
            {
                "targets": [ 4 ],
                "searchable": false
            }
        ],
        "columns": [
            { "data": "name" },
            { "data": "euro",
                render: function(data, type) {
                  if(data == '') {
                    return ''
                  }
                  else {
                    return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-value="'+data+'">'+data+'</button>'
                  }
                }
            },
            {
                className: 'f32', /* used by world-flags-sprite library */
                data: 'alpha2Code',
                render: function(data, type) {
 
                    return '<span class="flag ' + data.toLocaleLowerCase() + '"></span> '
                }
            },
            { "data": "capital" },
            { "data": "population" }
        ]
      });
    });
    $(document).ready(function(){
      $(document).on('click', '.btn', function() {
        $('#euro').val("1");
        var valutaName = "";
        var valutaName = $(this).data("value");
        $("#valutaRate").html(valutaName);
        $.ajax({url: "<?php echo site_url(); ?>/json/ajax/euro/"+valutaName, success: function(result){
//          $("#valutaValtas").data("arfolyam", result);
          $('#valutaValtas').attr('data-arfolyam', result);
          $('#valutaValtas').val(result);
          if(result == 'NULL') {
            $('#euro').val("");
            document.getElementById("euro").disabled = true;
          }
          else {
            document.getElementById("euro").disabled = false;
          }
        }});
      });
      $(document).on('keyup change', '#euro', function() {
        var arfolyam = $('#valutaValtas').data("arfolyam");
        var euro = $('#euro').val();
        var value = euro*arfolyam;
        $('#valutaValtas').val(value);
      });
    });
  </script>
</head>
 <body>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="table-responsive">
<table id="myTable" class="table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th width="(100/5)">Ország név</th>
            <th width="(100/5)">Euro átváltása</th>
            <th width="(100/5)">Zászló</th>
            <th width="(100/5)">Főváros</th>
            <th width="(100/5)">Népesség</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
         <tr>
            <th width="(100/5)">Ország név</th>
            <th width="(100/5)">Euro átváltása</th>
            <th width="(100/5)">Zászló</th>
            <th width="(100/5)">Főváros</th>
            <th width="(100/5)">Népesség</th>
        </tr>
    </tfoot>
</table>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Euro átváltása</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
         <form id="formValuta" action="">
		  <div class="form-group">
		    <label for="euro">Euro:</label>
		    <input type="number" min="1" value="1" step="any" class="form-control" id="euro">
		  </div>
		  <div class="form-group">
		    <label for="valutaValtas"><span id="valutaRate"></span>:</label>
		    <input type="number" min="1" value="1" step="any" class="form-control" id="valutaValtas" data-arfolyam="" disabled>
		  </div>
		</form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
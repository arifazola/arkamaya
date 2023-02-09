<?= $this->extend('templates/template');?>

<?= $this->section('content');?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="mt-5 mr-5">
                        <h3>Filter</h3>
                      </div>
                      <div class="form-group my-auto">
                        <label for="projectName">Project Name</label>
                        <input type="text" class="form-control" id="projectName">
                      </div>
                      <div class="form-group col-md-2 my-auto">
                        <label for="client">Client</label>
                        <select id="client" class="form-control">
                          <option selected value="">All Client</option>
                          <?php foreach($clients as $data): ?>
                            <option value="<?= $data['client_id'];?>"><?= $data['client_name'];?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                      <div class="form-group col-md-2 my-auto">
                        <label for="status">Status</label>
                        <select id="status" class="form-control">
                          <option selected value="">All Status</option>
                          <option value="OPEN">OPEN</option>
                          <option value="DOING">DOING</option>
                          <option value="DONE">DONE</option>
                        </select>
                      </div>
                      <div class="float-right mt-5 mb-3">
                        <button type="button" class="btn btn-primary" id="search">Search</button>
                        <button type="button" class="btn btn-danger" id="clear">Clear</button>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-primary" id="btn-new" data-toggle="modal" data-target="#addData">New</button>
                <button type="button" class="btn btn-danger" id="btn-delete" disabled>Delete</button>
                <table id="projectTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th width="30px">
                    <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="checkAll">
                        </div>
                    </div>
                    </th>
                    <th>Action</th>
                    <th>Project Name</th>
                    <th>Client</th>
                    <th>Project Start</th>
                    <th>Project End</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Add Data-->
  <div class="modal fade" id="addData" tabindex="-1" aria-labelledby="addDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addDataLabel">Add New Project</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="project_name_add">Project Name</label>
              <input type="text" class="form-control" id="project_name_add">
              <div id="validationProjectName" class="invalid-feedback">
              </div>
            </div>
            <div class="form-group">
              <label for="client_add">Client</label>
              <select id="client_add" class="form-control">
                <?php
                $i = 0;
                foreach($clients as $data): ?>
                  <option value="<?= $data['client_id'];?>" <?= $i == 0 ? "selected": ""?>><?= $data['client_name'];?></option>
                <?php 
                $i++;
              endforeach;?>
              </select>
              <div id="validationClient" class="invalid-feedback">
              </div>
            </div>
            <div class="form-group">
              <label for="status_add">Status</label>
              <select id="status_add" class="form-control">
                <option value="OPEN" selected>OPEN</option>
                <option value="DOING">DOING</option>
                <option value="DONE">DONE</option>
              </select>
              <div id="validationStatus" class="invalid-feedback">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-add-project">Add Project</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Modal Add Data -->

<!-- Modal Edit Data-->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editDataLabel">Edit Project</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <fieldset id="fieldset-edit" disabled>
              <div class="form-group">
                <label for="project_name_edit">Project Name</label>
                <input type="text" class="form-control" id="project_name_edit">
                <div id="validationProjectNameEdit" class="invalid-feedback">
                </div>
              </div>
              <div class="form-group">
                <label for="client_edit">Client</label>
                <select id="client_edit" class="form-control">
                  <?php
                  $i = 0;
                  foreach($clients as $data): ?>
                    <option value="<?= $data['client_id'];?>" <?= $i == 0 ? "selected": ""?>><?= $data['client_name'];?></option>
                  <?php 
                  $i++;
                endforeach;?>
                </select>
                <div id="validationClientEdit" class="invalid-feedback">
                </div>
              </div>
              <div class="form-group">
                <label for="status_edit">Status</label>
                <select id="status_edit" class="form-control">
                  <option value="OPEN" selected>OPEN</option>
                  <option value="DOING">DOING</option>
                  <option value="DONE">DONE</option>
                </select>
                <div id="validationStatusEdit" class="invalid-feedback">
                </div>
              </div>
              <input type="hidden" id="project_id_hid" value="">
            </fieldset>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-edit-project" disabled>Edit Project</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Modal Edit Data -->
  <!-- jQuery -->
<script src="<?= base_url();?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url();?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url();?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url();?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url();?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url();?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url();?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url();?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url();?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url();?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url();?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url();?>/dist/js/demo.js"></script>
<!-- Sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Page specific script -->
  
  <script>
    (function(){
          const getData = (function(projectName, client, status){
              $("#projectTable")
              .on('page.dt', function(){
                $("#btn-delete").attr("disabled", "disabled")
              })
              .DataTable({
                    processing: true,
                    serverSide: true,
                    order: [],
                    columns: [
                      {data: 'project_id', orderable: false},
                      {data: 'action'},
                      {data: 'project_name'},
                      {data: 'client_name'},
                      {data: 'project_start'},
                      {data: 'project_end'},
                      {data: 'project_status'},
                    ],
                    ajax: {
                        url: "<?php echo base_url(); ?>/dashboard/data",
                        dataType: "json",
                        type: "GET",
                        data: {
                          "project_name": projectName,
                          "client": client,
                          "status": status
                        }
                    },
                    pageLength: 5,
                    bStateSave: false,
                    bFilter: false,
                    fnStateSave: function(oSettings, oData) {
                        localStorage.setItem('offersDataTables', JSON.stringify(oData));
                    },
                    fnStateLoad: function(oSettings) {
                        return JSON.parse(localStorage.getItem('offersDataTables'));
                    },
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
            })
          })

      $("#search").on('click', function(){
        var projectName = $("#projectName").val() == "" ? null : $("#projectName").val()
        var client = $("#client").val() == "" ? null : $("#client").val()
        var status = $("#status").val() == "" ? null : $("#status").val()
        $("#projectTable").DataTable().destroy()
        getData(projectName, client, status)
      })

      $("#clear").on('click', function(){
        $("#projectName").val("")
        $("#client").val("").trigger('change')
        $("#status").val("").trigger('change')
        $("#projectTable").DataTable().destroy()
        getData(null,null,null)
      })

      $("#checkAll").on('change', function(){
        this.checked == true ? $("#btn-delete").removeAttr("disabled") : $("#btn-delete").attr("disabled", "disabled")
        $('.check-content').prop('checked', this.checked)
      })

      $(document).on('click', ".check-content", function(){
        if($("input:checkbox:checked").length > 0){
          $("#btn-delete").removeAttr("disabled")
        } else {
          $("#btn-delete").attr("disabled", "disabled")
        }
      })

      $("#btn-add-project").on('click', function(){
        var projectName = $("#project_name_add").val()
        var client = $("#client_add").val()
        var status = $("#status_add").val()

        $.ajax({
          url: "<?= base_url();?>/dashboard/data",
          method: "POST",
          dataType: "json",
          data: {
            "project_name": projectName,
            "client": client,
            "status": status
          },
          success: function(res){
            console.log(res)
            var key = Object.keys(res)

            if(key.includes('project_name')){
              $("#project_name_add").addClass("is-invalid")
              $("#validationProjectName").text(res['project_name'])
            } else {
              $("#project_name_add").removeClass("is-invalid")
              $("#validationProjectName").text()
            }

            if(key.includes('client')){
              $("#client_add").addClass("is-invalid")
              $("#validationClient").text(res['client'])
            } else {
              $("#client_add").removeClass("is-invalid")
              $("#validationClient").text()
            }

            if(key.includes('status')){
              $("#status_add").addClass("is-invalid")
              $("#validationStatus").text(res['status'])
            } else {
              $("#status_add").removeClass("is-invalid")
              $("#validationStatus").text()
            }

            if(res == true){
              swal({
                title: "Done!",
                text: "New Project Has Been Added",
                icon: "success",
                button: "Okay",
              }).then((value) => {
                $("#addData").modal('hide')
                $("#projectTable").DataTable().destroy()
                getData(null, null, null)
              });
            }
          }
        })
      })

      $("#btn-delete").on('click', function(){
        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var checked = []
            $(".check-content:checkbox:checked").each(function(){
              console.log($(this).attr('id'))
              checked.push($(this).attr('id'))
            })

            $.ajax({
              url: "<?= base_url();?>/dashboard/delete",
              method: "POST",
              dataType: "json",
              data: {
                "projects": checked
              },
              success: function(res){
                if(res == true){
                  $("#projectTable").DataTable().destroy()
                  getData(null, null, null)
                }
              }
            })
          }
        });
      })

      $(document).on('click', '.btn-edit', function(){
        var projectID = $(this).attr('id')
        $("#project_id_hid").val(projectID)
        $.ajax({
          url: "<?= base_url();?>/dashboard/singledata",
          method: "GET",
          dataType: "json",
          data: {
            "project_id": projectID
          },
          success: function(res){
            $("#project_name_edit").val(res['project_name'])
            $("#client_edit").val(res['client_id']).trigger('change')
            $("#status_edit").val(res['project_status']).trigger('change')
            $("#fieldset-edit").removeAttr("disabled")
            $("#btn-edit-project").removeAttr("disabled")
          }
        })
      })

      $("#btn-edit-project").on('click', function(){
        var projectID = $("#project_id_hid").val()
        var projectName = $("#project_name_edit").val()
        var clientID = $("#client_edit").val()
        var projectStatus = $("#status_edit").val()

        $.ajax({
          url: "<?= base_url();?>/dashboard/data",
          method: "PUT",
          dataType: "json",
          data: {
            "project_id": projectID,
            "project_name": projectName,
            "client": clientID,
            "status": projectStatus
          },
          success: function(res){
            var key = Object.keys(res)
            if(key.includes('project_name')){
              $("#project_name_edit").addClass("is-invalid")
              $("#validationProjectNameEdit").text(res['project_name'])
            } else {
              $("#project_name_edit").removeClass("is-invalid")
              $("#validationProjectNameEdit").text()
            }

            if(key.includes('client')){
              $("#client_edit").addClass("is-invalid")
              $("#validationClientEdit").text(res['client'])
            } else {
              $("#client_edit").removeClass("is-invalid")
              $("#validationClientEdit").text()
            }

            if(key.includes('status')){
              $("#status_edit").addClass("is-invalid")
              $("#validationStatusEdit").text(res['status'])
            } else {
              $("#status_edit").removeClass("is-invalid")
              $("#validationStatusEdit").text()
            }

            if(res == true){
              swal({
                title: "Done!",
                text: "Project Has Been Edited",
                icon: "success",
                button: "Okay",
              }).then((value) => {
                $("#editData").modal('hide')
                $("#projectTable").DataTable().destroy()
                getData(null, null, null)
              });
            }
          }
        })
      })

      getData(null, null, null)
    })()
  </script>
  <?= $this->endSection();?>
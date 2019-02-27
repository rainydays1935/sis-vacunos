<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Observaciones/Caracteristicas
                    <small>Vacunos</small>
                    <div class="float-right"><button class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Agregar caracteristica</button></div>
                </h1>
            </div>
             
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Caracteristica</th>
                        <th style="text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                     
                </tbody>
            </table>
        </div>
    </div>

     <!-- MODAL ADD -->
     <form>
            <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar caracteristica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Descripcion</label>
                            <div class="col-md-10">
                              <input type="text" name="descripcion" id="descripcion" class="form-control is-invalid" placeholder="Descripcion de la caracteristica">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" type="submit" id="btn_save" class="btn btn-primary">Guardar</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL ADD-->
        <!-- MODAL UPDATE -->
        <form>
                <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Caracteristica</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Nombre</label>
                                <div class="col-md-10">
                                <input type="text" name="descripcion_edit" id="descripcion_edit" class="form-control is-valid" placeholder="Descripcion de la caracteristica">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_observacion">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" type="submit" id="bnt_update" class="btn btn-primary">Actualizar</button>
                    </div>
                    </div>
                </div>
                </div>
        </form>
        <!--END MODAL UPDATE-->
            
</div>

<script>
    $(document).ready(function(){
        
        show();
        init_validators();

        function update_table(html) {
             
             $('#mydata').DataTable( {
                retrieve: true,
                "bJQueryUI":true,
                "bSort":true,
                "bPaginate":true,
                "sPaginationType":"full_numbers",
                "iDisplayLength": 6,
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                    'csv',
                    {   extend: 'pdf',                 
                        messageTop: 'Lista de observaciones'
                    }
                ]
            } );

    
        }
        
        
        function init_validators() {
            $('input[type="text"]').change(function() {
                if ($(this).val() != '') {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                }
                else {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                }
            });
            
        }


        // MOSTRAR CLIENTES

        function show() {
            console.log('entro');
                $.ajax({
                    type: 'ajax',
                    url: 'observaciones/observaciones',
                    method: 'GET',
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data.length);
                        var html = '';
                        var i = 0;
                        for (i = 0; i < data.length; i++) {
                            html+= '<tr>' +
                                    '<td>'+(i + 1)+'</td>'+
                                    '<td>'+data[i].descripcion+'</td>'+
                                    '<td style="text-align:right;">'+
                                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-id="'+data[i].id+'" data-descripcion="'+data[i].descripcion+'">Editar</a>'+
                                    '</td>'+
                                    '</tr>';
                        }
                        if ( $.fn.DataTable.isDataTable('#mydata') ) {
                            $('#mydata').DataTable().destroy();
                        }
                        $('#show_data').html(html);
                        update_table();
                    }
                });
        }

        // ACTUALIZAR OBSERVACION
        $('#show_data').on('click','.item_edit',function() {
            //Recuperar info
            var descripcion = $(this).data('descripcion');
            var id =  $(this).data('id');
            $('#id_observacion').val(id);
            $('#modal_update').modal('show');
            //Utilizar info
            $('#descripcion_edit').val(descripcion);
        });

        $('#bnt_update').on('click', function() {
            //Recuperar info
             
            var id = $('#id_observacion').val();
            console.log(id);
            var descripcion = $('#descripcion_edit').val();
            //Actualizar en la db
            if(descripcion) {
                $.ajax({
                url: 'observaciones/update',
                method: 'POST',
                dataType: 'json',
                data: { id: id, descripcion: descripcion},
                success: function (data) {
                    $('#descripcion_edit').val("");
                    $('#modal_update').modal('hide');
                    show();
                }

                });
            }

        });


        // NUEVO OBSERVACION
        $('#btn_save').on('click', function() {
            var descripcion = $('#descripcion').val();
            if(descripcion) {
                $.ajax({
                url: 'observaciones/create',
                method: 'POST',
                dataType: 'JSON',
                data: {descripcion: descripcion},
                success: function(data) {
                        $('#descripcion').val("");
                        $('#descripcion').removeClass('is-valid');
                        $('#descripcion').addClass('is-invalid');
                        $('#Modal_Add').modal('hide');
                        show();
                    }
                });
            }
        });
    });
            
</script>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Agenda
                    <small>Clientes</small>
                    <div class="float-right"><button class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Agregar cliente</button></div>
                </h1>
            </div>
             
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Celular</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="div-create">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nombre</label>
                            <div class="col-md-10">
                              <input type="text" name="nombre" id="nombre" class="form-control is-invalid" placeholder="Nombre del cliente">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Correo electronico</label>
                            <div class="col-md-10">
                              <input type="text" name="correo" id="correo" class="form-control is-invalid" placeholder="Correo electronico">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Celular</label>
                            <div class="col-md-10">
                              <input type="text" name="celular" id="celular" class="form-control is-invalid" placeholder="Celular">
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
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Nombre</label>
                                <div class="col-md-10">
                                <input type="text" name="nombre_edit" id="nombre_edit" class="form-control is-valid" placeholder="Nombre del cliente">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Correo electronico</label>
                                <div class="col-md-10">
                                <input type="text" name="correo_edit" id="correo_edit" class="form-control is-valid" placeholder="Correo electronico">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Celular</label>
                                <div class="col-md-10">
                                <input type="text" name="celular_edit" id="celular_edit" class="form-control is-valid" placeholder="Celular">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="client">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" type="submit" id="bnt_update" class="btn btn-primary">Actualizar</button>
                    </div>
                    </div>
                </div>
                </div>
        </form>
        <!--END MODAL UPDATE-->
        <!-- MODAL DELETE -->
        <form>
                <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Borrar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong>Estas seguro que deseas borrar el cliente?</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Aceptar</button>
                    </div>
                    </div>
                </div>
                </div>
                </form>
            <!--END MODAL DELETE-->                                                 
            
</div>
<script>
    $(document).ready(function(){
        show();
        
        init_validators();        

        function update_table() {
            $('#mydata').DataTable( {
                            destroy: true,
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
                                    messageTop: 'Lista de clientes'
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

        function destroy_state() {
            $('#div-create input[type="text"]').change(function() {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            });   
        }


        // MOSTRAR CLIENTES

        function show() {
                $.ajax({
                    type: 'ajax',
                    url: 'clients/clients',
                    method: 'GET',
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i = 0;
                        for (i = 0; i < data.length; i++) {
                            html+= '<tr>' +
                                    '<td>'+(i + 1)+'</td>'+
                                    '<td>'+data[i].nombre+'</td>'+
                                    '<td>'+data[i].correo+'</td>'+
                                    '<td>'+data[i].celular+'</td>'+
                                    '<td style="text-align:right;">'+
                                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-id_client="'+data[i].id+'" data-nombre="'+data[i].nombre+'"  data-correo="'+data[i].correo+'" data-celular="'+data[i].celular+'">Editar</a>'+
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

        // ACTUALIZAR CLIENTE
        $('#show_data').on('click','.item_edit',function() {
            //Recuperar info
            var nombre = $(this).data('nombre');
            var correo = $(this).data('correo');
            var celular = $(this).data('celular');
            var id = $(this).data('id_client');

            $('#modal_update').modal('show');
            //Utilizar info
            $('#nombre_edit').val(nombre);
            $('#correo_edit').val(correo);
            $('#celular_edit').val(celular);
            $('#client').val(id);
        });

        $('#bnt_update').on('click', function() {
            

            //Recuperar info
            var id = $('#client').val();
            console.log(id);
            var nombre = $('#nombre_edit').val();
            var correo = $('#correo_edit').val();
            var celular = $('#celular_edit').val();
            //Actualizar en la db
            if(nombre && correo && celular) {
                $.ajax({
                url: 'clients/update',
                method: 'POST',
                dataType: 'json',
                data: { id: id, nombre: nombre, correo: correo, celular: celular },
                success: function (data) {
                    $('#nombre_edit').val("");
                    $('#correo_edit').val("");
                    $('#celular_edit').val("");
                    $('#modal_update').modal('hide');
                    show();
                }

                });
            }

        });

        // BORRAR CLIENTE
        $('#show_data').on('click','.item_delete', function() {
            $('#modal_delete').modal('show');
        });

        $('#btn_delete').on('click', function() {
            var id_client = $('.item_delete').data('id_client');
            $.ajax({
                url: 'clients/delete',
                method: 'POST',
                dataType: 'JSON',
                data: { id: id_client },
                success: function(data) {
                    console.log('borro');
                    $('#modal_delete').modal('hide');
                    $('[name=correo]').val('');
                    show();
                }
            });
            return false;

        });


        // NUEVO CLIENTE
        $('#btn_save').on('click', function() {
            var nombre = $('#nombre').val();
            var correo = $('#correo').val();
            var celular = $('#celular').val();

            if(nombre && correo && celular) {
                $.ajax({
                url: 'clients/save',
                method: 'POST',
                dataType: 'JSON',
                data: {nombre: nombre, correo: correo, celular: celular},
                success: function(data) {
                        $('[name=nombre]').val("");
                        $('[name=correo]').val("");
                        $('[name=celular]').val("");
                        $('#Modal_Add').modal('hide');
                        destroy_state();
                        show();
                        
                    }
                });
            }

        });
    });
            
</script>
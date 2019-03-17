<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Mantenimiento
                    <small>Ventas</small>
                    <div class="float-right"><button class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Agregar Venta</button></div>
                </h1>
            </div>
             
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr class="text-center">
                        <th>id</th>
                        <th>Cliente</th>
                        <th>Vacuno</th>
                        <th>Fecha</th>
                        <th>Precio</th>
                        <th style="text-align: center;">Editar</th>
                        <th style="text-align: center;">Eliminar</th>
                    </tr>
                </thead>
                <tbody id="show_data" class="text-center">
                     
                </tbody>
            </table>

        </div>
        <div style="display:none" class="alert delete-success alert-success alert-dismissible fade show" role="alert">
            Venta eliminada con éxito.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

     <!-- MODAL ADD -->
     <form>
            <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar venta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="create_venta">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Cliente</label>
                            <select id="id_client" class="form-control is-valid col-md-10">
                                 <?php foreach ($clients as $ob):?>
                                    <option value="<?php echo $ob['id'];?>"><?php echo $ob['nombre'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nro de Arete/Vacuno</label>
                            <div class="col-md-10">
                              <input type="text" name="arete" id="arete" class="form-control is-invalid" placeholder="Ingrese numero de arete">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Fecha</label>
                            <div class="col-md-10">
                              <input type="date" name="fecha" id="fecha" class="form-control is-invalid">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Precio</label>
                            <div class="col-md-10">
                              <input type="text" name="precio" id="precio" class="form-control is-invalid" placeholder="Ingrese precio">
                            </div>
                        </div>
                        <div class="alert alert-danger" role="alert" style="display:none!important" id="create_error">
                            No existe un vacuno con ese numero de arete.
                        </div>
                        <div class="alert alert-warning" role="alert" style="display:none!important" id="create_exist">
                            El vacuno ya fue vendido.
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
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Venta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Precio</label>
                                <div class="col-md-10">
                            <input type="text" name="precio_edit" id="precio_edit" class="form-control is-valid" placeholder="Ingrese el precio">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Fecha</label>
                                <div class="col-md-10">
                            <input type="date" name="fecha_edit" id="fecha_edit" class="form-control is-valid">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_venta">
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
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Venta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Ingrese contraseña</label>
                                <div class="col-md-10">
                                    <input type="password" name="pass_delete" id="pass_delete" class="form-control is-valid" placeholder="Ingrese contraseña">
                                </div>
                            </div>
                            <div style="display:none" class="alert try-password alert-warning alert-dismissible fade show" role="alert">
                                Contraseña incorrecta.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_delete">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Eliminar</button>
                    </div>
                    </div>
                </div>
                </div>
        </form>
        <!--END MODAL DELETE-->
            
</div>

<script>
    $(document).ready(function(){
        // MOSTRAR VENTAS
        function update_table() {
             var table = $('#mydata').DataTable( {
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
                        messageTop: 'Lista de ventas'
                    }
                ],
                "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
                } ],        
                "order": [[ 1, 'asc' ]]

            } );

            table.on( 'order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i + 1;
                    table.cell(cell).invalidate('dom'); 
                } );
                } ).draw();
        }

        show();
        init_validators();

        
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
       

        function show() {
                $.ajax({
                    type: 'ajax',
                    url: 'ventas/ventas',
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
                                    '<td>'+data[i].arete+'</td>'+
                                    '<td>'+data[i].fecha+'</td>'+
                                    '<td>'+data[i].precio+'</td>'+
                                    '<td style="text-align:center;">'+
                                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-id="'+data[i].id+'" data-fecha="'+data[i].fecha+'" data-precio="'+data[i].precio+'">Editar</a>'+
                                    '</td>'+
                                    '<td style="text-align:center;">'+
                                        '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-delete="'+data[i].id+'" >Eliminar</a>'+
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

        // ACTUALIZAR VENTA MODAL
        $('#show_data').on('click','.item_edit',function() {
            //Recuperar info
            var fecha = $(this).data('fecha');
            var precio = $(this).data('precio');
            var id =  $(this).data('id');
            
            $('#id_venta').val(id);
            $('#modal_update').modal('show');
            
            //Utilizar info
            $('#fecha_edit').val(moment(fecha).format('YYYY-MM-DD'));
            $('#precio_edit').val(precio);
        });

        //ELIMINAR VENTA MODAL 
        // BORRAR CLIENTE
        $('#show_data').on('click','.item_delete', function() {
            $('#modal_delete').modal('show');
        });

      

        $('#btn_delete').on('click', function() {
            var id_venta = $('.item_delete').data('delete');
            var password = '';
            $.ajax({
                url: 'http://[::1]/vacunos/pass.txt',
                success: function(data) {
                    password = data;
                    var intento = $('#pass_delete').val();
                    if( password === intento ){
                        $.ajax({
                        url: 'ventas/delete',
                        method: 'POST',
                        dataType: 'JSON',
                        data: { id: id_venta },
                        success: function(data) {
                            if(data){
                                $('#modal_delete').modal('hide');
                                $('[name=pass_delete]').val('');
                                $('.delete-success').css('display','block');
                                show();
                            }
                        }
                    });
                    }
                    else {
                        $('.try-password').css('display','block');
                    }
                }
            })
            
            
        });

        $('#bnt_update').on('click', function() {
            //Recuperar info
            var id = $('#id_venta').val();

            var precio = $('#precio_edit').val();
            var fecha = $('#fecha_edit').val();
            //Actualizar en la db
            $.ajax({
                url: 'ventas/update',
                method: 'POST',
                dataType: 'json',
                data: { id: id, precio: precio, fecha: fecha},
                success: function (data) {
                    $('#precio_edit').val("");
                    $('#fecha_edit').val("");
                    $('#modal_update').modal('hide');
                    show();
                }

            });

        });


        // NUEVA VENTA
        $('#btn_save').on('click', function() {
            var id_client = $('#id_client').val();
            var arete = $('#arete').val();
            var fecha = $('#fecha').val();
            var precio = $('#precio').val();
            $.ajax({
                url: 'ventas/save',
                method: 'POST',
                dataType: 'JSON',
                data: {id_client: id_client, arete: arete, fecha: fecha, precio: precio},
                success: function(data) {
                    if(!data.err){
                        $('[name=id_client]').val("");
                        $('[name=arete]').val("");
                        $('[name=fecha]').val("");
                        $('[name=precio]').val("");
                        $('#Modal_Add').modal('hide');
                        $('#create_error').css('display','none');
                        show();
                    }
                    else {
                        if(data.err === 'Vendido'){
                            $('[name=arete]').removeClass('is-valid');
                            $('[name=arete]').addClass('is-invalid');
                            $('#create_error').css('display','none');
                            $('#create_exist').css('display','block');
                        }
                        else {
                            $('[name=arete]').removeClass('is-valid');
                            $('[name=arete]').addClass('is-invalid');
                            $('#create_exist').css('display','none');
                            $('#create_error').css('display','block');
                        }
                    }
                    
                },
                
            });
            return false;
        });
    });
            
</script>
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
                    <tr>
                        <th>id</th>
                        <th>Cliente</th>
                        <th>Vacuno</th>
                        <th>Fecha</th>
                        <th>Precio</th>
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
            
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
<script>
    $(document).ready(function(){
        // MOSTRAR VENTAS
        show();
        init_validators();
        $('#mydata').dataTable();
        
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
                                    '<td>'+data[i].id+'</td>'+
                                    '<td>'+data[i].id_client+'</td>'+
                                    '<td>'+data[i].id_product+'</td>'+
                                    '<td>'+data[i].fecha+'</td>'+
                                    '<td>'+data[i].precio+'</td>'+
                                    '<td style="text-align:right;">'+
                                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-id="'+data[i].id+'" data-fecha="'+data[i].fecha+'" data-precio="'+data[i].precio+'">Editar</a>'+
                                    '</td>'+
                                    '</tr>';
                        }
                        $('#show_data').html(html);
                    }
                });
        }

        // ACTUALIZAR VENTA
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

        $('#bnt_update').on('click', function() {
            //Recuperar info
            var id = $('#id_venta').val();
            console.log(id);
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
            console.log(fecha);
            $.ajax({
                url: 'ventas/save',
                method: 'POST',
                dataType: 'JSON',
                data: {id_client: id_client, arete: arete, fecha: fecha, precio: precio},
                success: function(data) {
                    console.log('entro');
                    $('[name=id_client]').val("");
                    $('[name=arete]').val("");
                    $('[name=fecha]').val("");
                    $('[name=precio]').val("");
                    $('#Modal_Add').modal('hide');
                    show();
                },
                
            });
            return false;
        });
    });
            
</script>
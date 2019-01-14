<div class="container">
    <div class="row mt-5">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Filtros
                    <small>Caracteristicas</small>
                </h1>
            </div>
            <div class="row" id="checks">
                <?php foreach($observaciones as $i):?>
                <div class="form-group form-check col-md-2">
                    <input type="checkbox" class="form-check-input" name="selected[]" id="<?php echo $i['id']?>">
                    <label class="form-check-label" for="exampleCheck1"><?php echo $i['descripcion']?></label>
                </div>
                <?php endforeach;?>
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Busqueda
                    <small>Vacunos</small>
                </h1>
            </div>
             
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>descripcion</th>
                        <th>Sexo</th>
                        <th>Estado</th>
                        <th>Edad</th>
                        <th style="text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                     
                </tbody>
            </table>
        </div>
    </div>

     <!-- MODAL MORE -->
     <form>
            <div class="modal fade" id="modal_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vacuno </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nro arete</label>
                            <div class="col-md-4">
                              <input type="text" name="arete" id="arete" class="form-control" disabled>
                            </div>
                            <label class="col-md-2 col-form-label">Color</label>
                            <div class="col-md-4">
                              <input type="text" name="color" id="color" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Sexo</label>
                            <div class="col-md-4">
                              <input type="text" name="sexo" id="sexo" class="form-control" disabled>
                            </div>
                            <label class="col-md-2 col-form-label">Edad</label>
                            <div class="col-md-4">
                              <input type="text" name="edad" id="edad" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Estado</label>
                            <div class="col-md-4">
                              <input type="text" name="estado" id="estado" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Observaciones</label>
                            <div class="col-md-10">
                              <input type="text" name="descripcion" id="descripcion" class="form-control" disabled>
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                      <input type="hidden" id="id-vacuno">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL MORE-->
      
            
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
        
        show();
        // MOSTRAR CLIENTES
        $('#mydata').dataTable();

        function show() {
                $.ajax({
                    type: 'ajax',
                    url: 'busqueda/vacunos',
                    method: 'GET',
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i = 0;
                        for (i = 0; i < data.length; i++) {
                            html+= '<tr>' +
                                    '<td>'+data[i].id+'</td>'+
                                    '<td>'+data[i].descripcion+'</td>'+
                                    '<td>'+data[i].sexo+'</td>'+
                                    '<td>'+data[i].estado+'</td>'+
                                    '<td>'+data[i].arete+'</td>'+
                                    '<td style="text-align:right;">'+
                                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_show" data-id="'+data[i].id+'" data-arete="'+data[i].arete+'" data-color="'+data[i].color+'" data-sexo="'+data[i].sexo+'" data-edad="'+data[i].edad+'" data-estado="'+data[i].estado+'" data-descripcion="'+data[i].descripcion+'" ">Ver</a>'+
                                    '</td>'+
                                    '</tr>';
                        }
                        $('#show_data').html(html);
                    }
                });
        }

        // ACTUALIZAR OBSERVACION
        $('#show_data').on('click','.item_show',function() {
            //Recuperar info
            var id =  $(this).data('id');

            $('#id-vacuno').val(id);
            
            $('#modal_show').modal('show');

            $('#arete').val($(this).data('arete'));
            $('#sexo').val(($(this).data('sexo')) === 'M'?'Macho':'Hembra');
            $('#color').val($(this).data('color'));
            $('#edad').val($(this).data('edad'));
            $('#estado').val(($(this).data('estado')) === 'E'?'Encontrado':'Vendido');
            $('#descripcion').val($(this).data('descripcion'));
            
        });

         $("input[name='selected[]']").change(function() {
            var values = [];
            $('#checks :checked').each(function() {
                values.push($(this).attr('id'));
            });
            if(values.length == 0){
                show();
            }
            else {
                $.ajax({
                    url: 'busqueda/filter',
                    method: 'post',
                    data: { selected: values },
                    success: function (data) {

                        $('#show_data').html("");
                        var data = JSON.parse(data);
                        var html = '';
                        var i = 0;
                        for(i = 0; i < data.length; i++) {
                            html+= '<tr>' +
                                    '<td>'+data[i].id+'</td>'+
                                    '<td>'+data[i].descripcion+'</td>'+
                                    '<td>'+data[i].sexo+'</td>'+
                                    '<td>'+data[i].estado+'</td>'+
                                    '<td>'+data[i].arete+'</td>'+
                                    '<td style="text-align:right;">'+
                                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_show" data-id="'+data[i].id+'" data-arete="'+data[i].arete+'" data-color="'+data[i].color+'" data-sexo="'+data[i].sexo+'" data-edad="'+data[i].edad+'" data-estado="'+data[i].estado+'" data-descripcion="'+data[i].descripcion+'" ">Ver</a>'+
                                    '</td>'+
                                    '</tr>';
                        }
                        $('#show_data').html(html);
                
                    }
                });
            }
            
        });


    });
            
</script>
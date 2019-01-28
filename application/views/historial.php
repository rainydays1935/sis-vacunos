<div class="container" id="container">
    <div id="err" style="display:none;" class="mb-5 row text-center">
        <div
            class="mt-4 alert alert-warning alert-dismissible fade show col-md-12"
            role="alert">
            <span>No existe el vacuno!!</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div id="edit" style="display:none;" class="mb-5 row text-center">
        <div
            class="mt-4 alert alert-warning alert-dismissible fade show col-md-12"
            role="alert">
            <span>Debes de seleccionar un vacuno para editar</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="form-row mt-5">
        <div class="form-group col-md-6">
            <label>Nro Arete</label>
            <input type="text" class="form-control is-invalid" name="arete" id="arete">
        </div>
        <div class="form-group col-md-6">
            <label>Color Arete</label>
            <input type="text" class="form-control is-invalid" name="color" id="color">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Edad</label>
            <input type="text" class="form-control is-invalid" name="edad" id="edad">
        </div>
        <div class="form-group col-md-6">
            <label>Estado</label>
            <input disabled type="text" class="form-control" name="estado" id="estado">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Descripcion</label>
            <input type="text" class="form-control is-invalid" name="descripcion" id="descripcion">
        </div>
        <div class="form-group col-md-6">
            <label>Sexo</label>
            <input type="text" class="form-control is-invalid" name="sexo" id="sexo">
        </div>
    </div>
    <label class="item-show" for="">Fechas recontadas</label>
    <div class="row ">
            <div class="col-md-6 item-show">
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                     
                </tbody>
            </table>
        </div>
        <div id="carouselExampleControls" class="ignorePDF carousel slide col-md-6" data-ride="carousel">
            <div class="carousel-item active text-center">
            <div class="carousel-inner"  style="display:none;" id="carousel">
                    <img id="active" class="d-block w-auto" style="height:250px!important;"  alt="First slide">
                </div>
                
                <a
                    class="carousel-control-prev"
                    href="#carouselExampleControls"
                    role="button"
                    data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a
                    class="carousel-control-next"
                    href="#carouselExampleControls"
                    role="button"
                    data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-12 text-center mt-5 mb-2 item-show">
            <input type="button" class="btn btn-success " value="Editar" id="btn_editar">
            <input type="button" class="btn btn-success " value="Reporte" id="btn_report">
        </div>
    </div>
</div>
<!-- MODAL UPDATE -->
<form>
        <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Vacuno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Color Arete</label>
                        <div class="col-md-10">
                        <input type="text" name="color_edit" id="color_edit" class="form-control is-valid" placeholder="Color del arete">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Edad</label>
                        <div class="col-md-10">
                        <input type="text" name="edad_edit" id="edad_edit" class="form-control is-valid" placeholder="Edad del vacuno">
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
    
</body>

<script src="<?php echo base_url(); ?>js/jspdf.min.js"></script>
    
<script>
    $(document).ready(function() {
             
        init_validators();

        function update_table(id) {
            $('#mydata').DataTable( {
                            destroy: true,
                            "bJQueryUI":true,
                            "bSort":false,
                            "bPaginate":true,
                            "sPaginationType":"full_numbers",
                            "iDisplayLength": 6,
                            dom: 'Bfrtip',
                            buttons: [
                                'excel',
                                'csv',
                                {   extend: 'pdf',                 
                                    messageTop: `Lista de fechas recontadas del vacuno con arete ${id}`
                                }
                            ]
                        } );
        }
       

        $('#btn_report').on('click', function () {
            $('.item-show').css('display','none');
            window.print();
            $('.item-show').css('display','block');
        })


        $('#btn_editar').on('click', function () {
            var css = $('#err').css("display"); 
            var arete = $('#arete').val();
            if(css === 'block' || !arete){
                $('#edit').css('display','block');
            }
            else {
                $('#modal_update').modal('show');
                var color = $('#color').val();
                var edad = $('#edad').val();
                var sexo = $('#sexo').val();

                $('#color_edit').val(color);
                $('#edad_edit').val(edad);
                $('#sexo_edit').val(sexo);
            }
        });

        $('#btn_report').on('click', function () {
            $('.item-show').each(function() {
                $(this).css('display','none');
            });
            $('#nav').css('display','none');
            window.print();
            $('.item-show').each(function() {
                $(this).css('display','block');
            });
            $('#nav').css('display','flex');

        })


        $('#bnt_update').on('click', function() {
            //Recuperar info
            var id = $('#arete').val();
            var color = $('#color_edit').val();
            var edad = $('#edad_edit').val();
            //Actualizar en la db
            if(color && edad && id) {
                $.ajax({
                url: 'historialC/update',
                method: 'POST',
                dataType: 'json',
                data: { id: id, color: color, edad:edad },
                success: function (data) {
                    $('#color_edit').val("");
                    $('#edad_edit').val("");
                    console.log('entro cerra');
                    $('#modal_update').modal('hide');
                }
                });
            }
        });

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


        var input_text = $('#arete');
        input_text.blur(function() {
            if(input_text.val() !== ''){
                $.ajax({
                    url: "historialC/get_vacuno",
                    data: {arete:input_text.val()},
                    type: 'POST',
                    success: function(res) {
                        console.log(res);
                        var data = JSON.parse(res);

                        if(data.err){
                            $('#err').css("display","block");
                            $('#color').val('');
                            $('#descripcion').val('');
                            $('#edad').val('');
                            $('#estado').val('');
                            $('#carousel').css("display","none");
                            $('#show_data').html('');
                        }
                        else {
                            $('#err').css("display","none");
                            $('#edit').css('display','none');
                            $('#color').val(data[0].color);
                            $('#estado').val(data[0].estado === 'E'?'Encontrado':'Vendido');
                            $('#descripcion').val(data[0].descripcion);
                            $('#edad').val(data[0].edad);
                            $('#sexo').val((data[0].sexo === 'H')?'Hembra':'Macho');

                            $('input[type="text"]').each(function() {
                                $(this).removeClass('is-invalid');
                                $(this).addClass('is-valid');
                            });

                            var html = '';
                            var fechas = data[1];
                            window.fechas = fechas;
                            var i = 0;
                            for (i = 0; i < fechas.length; i++) {
                                html+= '<tr>' +
                                        '<td>'+fechas[i].id_products+'</td>'+
                                        '<td>'+fechas[i].fecha+'</td>'+
                                        '</tr>';
                            }

                            if ( $.fn.DataTable.isDataTable('#mydata') ) {
                                $('#mydata').DataTable().destroy();
                            }

                            $('#show_data').html(html);
                            update_table(input_text.val());

                            //carousel
                            $('#carousel').css("display","block");

                            var pictures = '';
                            var imgs = data[2];
                            var i = 0;
                            window.pictures = data[2];

                            //First imagen
                            var directory = '/vacunos/uploads/';

                            $('#active').attr("src",directory+imgs[0].url+'.jpg');
                            if(imgs.length > 1){
                                for(i = 0; i < imgs; i++) {
                                    pictures += '<div class="carousel-item"><img class="d-block w-auto" src="'+directory+img[i].url+'.jpg" alt="Second slide"></div>';
                                }
                            }

                        }
                    },
                });
            }
            else {
                alert('Ingrese un numero de arete valido');
            }
        })
    });
</script>

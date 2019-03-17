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
            <input  disabled type="text" class="form-control is-invalid" name="color" id="color">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Edad</label>
            <input  disabled type="text" class="form-control is-invalid" name="edad" id="edad">
        </div>
        <div class="form-group col-md-6">
            <label>Observaciones</label>
            <input disabled type="text" class="form-control" name="observaciones" id="observaciones">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Descripcion</label>
            <input disabled type="text" class="form-control is-invalid" name="descripcion" id="descripcion">
        </div>
        <div class="form-group col-md-6">
            <label>Sexo</label>
            <input disabled type="text" class="form-control is-invalid" name="sexo" id="sexo">
        </div>
    </div>
    <label class="item-show" for="">Fechas recontadas</label>
    <div class="row ">
            <div class="col-md-6 item-show">
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>indice</th>
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
<?php echo form_open_multipart('historialC/update'); ?>
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
                        <input type="date" name="edad_edit" id="edad_edit" class="form-control is-valid" placeholder="Edad del vacuno">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Sexo</label>
                        <div class="col-md-10">
                        <input type="text" name="sexo_edit" id="sexo_edit" class="form-control is-valid" placeholder="Sexo del vacuno">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Observaciones</label>
                        <div class="col-md-10">
                        <input type="text" name="observacion_edit" id="observacion_edit" class="form-control is-valid" placeholder="Observaciones del vacuno">
                        </div>
                    </div>
                    <div class="form-group form-car" >
                        <label >Caracteristicas</label>
                        <select
                            class="custom-select multiple"
                            multiple="multiple"
                            id="myselect[]"
                            name="myselect[]">
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Foto</label>
                        <input id="image_edit" type="file" name="userfile" size="20" />
                    </div>
                    <input type="hidden" name="arete_edit" id="arete_edit">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button  type="submit" id="bnt_update" class="btn btn-primary">Actualizar</button>
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


        function getEdad(edad) {
            var a = moment();
            var b = moment(edad, ['YYYY-MM-DD'], true);

            var years = a.diff(b, 'year');
            b.add(years, 'years');

            var months = a.diff(b, 'months');
            b.add(months, 'months');
            return years+' Años, ' + months + " meses"            
        }



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
                var arete = $('#arete').val();
                var observaciones = $('#observaciones').val();

                $('#color_edit').val(color);
                $('#edad_edit').val(edad);
                $('#sexo_edit').val(sexo);
                $('#arete_edit').val(arete);
                $('#observacion_edit').val(observaciones);
            }
        });

        $('#btn_report').on('click', function () {
            $('.item-show').each(function() {
                $(this).css('display','none');
            });
            $('#nav').css('display','none');
            $('.item-show').each(function() {
                $(this).css('display','block');
            });
            $('#nav').css('display','flex');

        })


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
                        var data = JSON.parse(res);
                        console.log('data',data)
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
                            $('#observaciones').val(data[0].descr);
                            $('#descripcion').val(data[0].descripcion);
                            $('#edad').val(getEdad(data[0].edad));
                            $('#sexo').val((data[0].sexo === 'H')?'Hembra':'Macho');

                            $('input[type="text"]').each(function() {
                                $(this).removeClass('is-invalid');
                                $(this).addClass('is-valid');
                            });

                            var html = '';
                            var fechas = data[1];
                            var i = 0;
                            for (i = 0; i < fechas.length; i++) {
                                html+= '<tr>' +
                                        '<td>'+(i + 1 )+'</td>'+
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

                            //llenar opciones
                            var car = data[3];
                            var select = $('.multiple');
                            car.forEach(function(item) {
                                var option = $('<option/>');
                                option.attr({ 'value': item.id }).text(item.descripcion);
                                select.append(option);
                            })
                            console.log(select);

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

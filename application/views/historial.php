<div class="container">
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
    <label for="">Fechas recontadas</label>
    <div class="row">
            <div class="col-6">
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
        <div id="carouselExampleControls" class="carousel slide col-md-6" data-ride="carousel">
            <div class="carousel-inner"  style="display:none;" id="carousel">
                <div class="carousel-item active">
                    <img id="active" class="d-block w-100"  alt="First slide">
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
    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>

    
<script>
    $(document).ready(function() {

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


        var input_text = $('#arete');
        input_text.blur(function() {
            if(input_text.val() !== ''){
                $.ajax({
                    url: "historialC/get_vacuno",
                    data: {arete:input_text.val()},
                    type: 'POST',
                    success: function(res) {
                        
                        var data = JSON.parse(res);

                        if(data.err){
                            $('#err').css("display","block");
                            $('#color').val('');
                            $('#descripcion').val('');
                            $('#edad').val('');
                            $('#carousel').css("display","none");
                            $('#show_data').html('');
                        }
                        else {
                            $('#err').css("display","none");
                            $('#color').val(data[0].color);
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
                            $('#show_data').html(html);

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
                                    pictures += '<div class="carousel-item"><img class="d-block w-100" src="'+directory+img[i].url+'.jpg" alt="Second slide"></div>';
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

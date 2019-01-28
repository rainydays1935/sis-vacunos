<div class="container">
    <div id="success" style="display:none;" class="mb-5 row text-center">
        <div
            class="mt-4 alert alert-success alert-dismissible fade show col-md-12"
            role="alert">
            <span>Se registro el recuento con exito!!</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1 style="display:inline-block;">Recuento/Asistencia
                    <small>Fecha</small>
                </h1>
                <input type="date" id="fecha" disabled>
            </div>
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>Lista</th>
                        <th>Nro arete</th>
                        <th>Edad</th>
                        <th>Características</th>
                        <th>Sexo</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                     
                </tbody>
            </table>
            <div class="col-md-12">
                <button class="mt-3 mb-5 btn btn-primary" id="btn_save"> Registrar asistencia</button>
            </div>
            
        </div>
    </div>
</div>



<script>
    $(document).ready(function(){
        show();
        init_fecha();


        function init_fecha() {
            var date2 = moment().format('YYYY-MM-DD');
            $('#fecha').val(date2);
        }

        function show() {
                $.ajax({
                    type: 'ajax',
                    url: 'recuento/vacunos',
                    method: 'GET',
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i = 0;
                        for (i = 0; i < data.length; i++) {
                            html+= '<tr>' +
                                    '<td class="text-center"><input type="checkbox" name="recuento[]" id="'+data[i].id+'"></td>'+
                                    '<td>'+data[i].arete+'</td>'+
                                    '<td>'+data[i].edad+'</td>'+
                                    '<td>'+data[i].descripcion+'</td>'+
                                    '<td>'+data[i].sexo+'</td>'+
                                    '</tr>';
                        }
                        $('#show_data').html(html);
                        $('#mydata').dataTable();
                    }
                });
        }
        $('#btn_save').on('click', function(){
            var selected = [];
            var fecha = $('#fecha').val();
            console.log(fecha);
            $('#show_data :checked').each(function(){
                selected.push($(this).attr('id'));
            });
            $.ajax({
                url: 'recuento/save',
                method: 'post',
                data: {selected: selected, fecha:fecha},
                success: function (data) {
                    $('[name="recuento[]"]').each(function(){
                        $(this).val('false');
                    });
                    if(data) {
                        $('#success').css("display","block");
                    }
                }
            });
        });

       
    });
            
</script>
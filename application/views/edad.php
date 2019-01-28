<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Edades
                    <small>Vacunos</small>

                </h1>
                <div class="mb-4" style="color:#fff!important">
                    <a type="submit" data-edad="l" class="btn btn-primary" id="edad" >Menor que 2 </a>
                    <a type="submit" data-edad="m" class="btn btn-primary" id="edad" >Entre 2 -  5</a>
                    <a type="submit" data-edad="g" class="btn btn-primary" id="edad" >Mayor 5</a>
                </div>
                
            </div>
             
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>Indice</th>
                        <th>Nro arete</th>
                        <th>Color arete</th>
                        <th>Sexo</th>
                        <th>Edad</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                     
                </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function(){
        
        
        update_table();

        $('a').each(function() {
            $(this).on('click', function(){
                var edad = $(this).data('edad');
                show(edad);
            })
        });

        function update_table(edad) {
             var rango;
             if(edad === 'l'){
                 rango = 'Menores a 2';
             }
             if(edad === 'm') {
                 rango = 'Entre 2 a 5';
             }
             if(edad === 'g') {
                 rango = 'Mayores a 5';
             }

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
                        messageTop: 'Lista de vacunos por edad '+rango
                    }
                ]
            } );
        }

        $('#fecha').change(function() {
            show();
        })

        function show(edad) {
                $.ajax({
                    type: 'ajax',
                    url: 'get_edades',
                    method: 'POST',
                    async: true,
                    data: { edad: edad },
                    dataType: 'JSON',
                    success: function(data) {
                        console.log('edata');
                        console.log(data);
                        var html = '';
                        var i = 0;
                        for (i = 0; i < data.length; i++) {
                            html+= '<tr>' +
                                    '<td>'+(i+1)+'</td>'+
                                    '<td>'+data[i].arete+'</td>'+
                                    '<td>'+data[i].color+'</td>'+
                                    '<td>'+((data[i].sexo==='H')?'Hembra':'Macho')+'</td>'+
                                    '<td>'+data[i].edad+' anios </td>'+
                                    '<td>'+data[i].estado+'</td>'+
                                    '</tr>';
                        }
                        if ( $.fn.DataTable.isDataTable('#mydata') ) {
                            $('#mydata').DataTable().destroy();
                        }
                        $('#show_data').html(html);
                        update_table(edad);
                    }
                });
        }

    });
            
</script>
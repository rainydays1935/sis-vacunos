<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1 style="display:inline-block;">Vacunos
                    <small>Recontados</small>

                </h1>
                <input type="date" id="fecha">
            </div>
             
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>Indice</th>
                        <th>Nro arete</th>
                        <th>Color arete</th>
                        <th>Sexo</th>
                        <th>Edad</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                     
                </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function(){
        
        show();
        update_table();

        function update_table(html) {
            var fecha = $('#fecha').val();
             $('#mydata').DataTable( {
                retrieve: true,
                "bJQueryUI":true,
                "bSort":true,
                "colReorder": true,
                "bPaginate":true,
                "sPaginationType":"full_numbers",
                "iDisplayLength": 6,
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                    'csv',
                    {   extend: 'pdf',                 
                        messageTop: 'Lista de vacunos por fecha '+fecha
                    }
                ]
            } );
        }

        $('#fecha').change(function() {
            show();
        })

        function show() {
                var fecha = $('#fecha').val();
                $.ajax({
                    type: 'ajax',
                    url: 'get_fecha',
                    method: 'POST',
                    async: true,
                    data: { fecha: fecha },
                    dataType: 'JSON',
                    success: function(data) {
                        console.log('estadasfasf');
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
                                    '<td>'+data[i].descripcion+'</td>'+
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

    });
            
</script>
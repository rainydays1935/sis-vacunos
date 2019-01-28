<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1 style="display:inline-block;">Ventas
                    <small>Vacunos</small>

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
                        <th>Precio</th>
                        <th>Cliente</th>
                        <th>Telefono</th>
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
                console.log(fecha);
                $.ajax({
                    type: 'ajax',
                    url: 'get_vendidos',
                    method: 'POST',
                    async: true,
                    data: { fecha: fecha },
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
                                    '<td>'+data[i].precio+'</td>'+
                                    '<td>'+data[i].nombre+'</td>'+
                                    '<td>'+data[i].celular+'</td>'+
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
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Vacunos
                    <small>Faltantes</small>
                </h1>
            </div>
             
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>Nro arete</th>
                        <th>Color arete</th>
                        <th>Caracteristicas</th>
                        <th>Ult. Fecha</th>
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
                        messageTop: 'Lista de vacunos faltantes'
                    }
                ]
            } );

    
        }

        function show() {
            console.log('asdsad');
                $.ajax({
                    type: 'ajax',
                    url: 'getFaltantes',
                    method: 'GET',
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        console.log('edata');
                        console.log(data);
                        var html = '';
                        var i = 0;
                        for (i = 0; i < data.length; i++) {
                            if(moment().format('YYYY-MM-DD') !== data[i].fecha){
                                html+= '<tr>' +
                                    '<td>'+data[i].arete+'</td>'+
                                    '<td>'+data[i].color+'</td>'+
                                    '<td>'+data[i].descripcion+'</td>'+
                                    '<td>'+data[i].fecha+'</td>'+
                                    '</tr>';
                            }
                           
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
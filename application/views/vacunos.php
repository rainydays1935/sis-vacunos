<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1 style="display:inline-block;">Vacunos
                </h1>
            </div>
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>Lista</th>
                        <th>Nro arete</th>
                        <th>Color arete</th>
                        <th>Edad</th>
                        <th>Características</th>
                        <th>Sexo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                     
                </tbody>
            </table>
        </div>
    </div>
</div>



<script>
    $(document).ready(function(){
        show();

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
                        messageTop: 'Lista de observaciones'
                    }
                ]
            } );
        }

  
        function show() {
                $.ajax({
                    type: 'ajax',
                    url: 'get_vacunos',
                    method: 'GET',
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
                        var html = '';
                        var i = 0;
                        for (i = 0; i < data.length; i++) {
                            html+= '<tr>' +
                                    '<td>'+(i+1)+'</td>'+
                                    '<td>'+data[i].arete+'</td>'+
                                    '<td>'+data[i].color+'</td>'+
                                    '<td>'+data[i].edad+'</td>'+
                                    '<td>'+data[i].descripcion+'</td>'+
                                    '<td>'+((data[i].sexo ==='H')?'Hembra':'Macho')+'</td>'+
                                    '<td>'+((data[i].estado === 'E')?'Encontrado':'Vendido')+'</td>'+
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
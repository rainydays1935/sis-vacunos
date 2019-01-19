<div class="container">
    
    <?php echo form_open_multipart('inventory/create'); ?>
    <div class="form-row mt-5">
        <div class="form-group col-md-6">
            <label>Nro Arete</label>
            <input
                type="text"
                class="form-control is-invalid" value="<?php echo set_value('arete'); ?>"
                name="arete" id="arete"
                placeholder="Arete">
        </div>
        <div class="form-group col-md-6">
            <label>Color arete</label>
            <input type="text" class="form-control is-invalid" value="<?php echo set_value('color'); ?>" name="color" placeholder="Color arete" id="color"> 
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label >Sexo</label>
            <select name="sexo" class="form-control is-valid" value="<?php echo set_value('sexo'); ?> " id="sexo"> 
                <option value="M" selected="selected">Macho</option>
                <option value="H">Hembra</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label >Edad</label>
            <input
                type="text"
                name="edad" id="edad"
                class="form-control is-invalid" value="<?php echo set_value('edad'); ?>"
                placeholder="Ingrese la edad del vacuno">
        </div>

    </div>
    <div class="form-group">
        <label >Descripcion</label>
        <input
            type="text"
            class="form-control is-invalid" value="<?php echo set_value('descripcion'); ?>"
            name="descripcion"
            id="descripcion"
            placeholder="Ingrese descripcion">
    </div>
    
    <div class="form-group">
        <label >Foto</label>
        <input type="file" name="userfile" size="20" />
   </div>

    <div class="form-group">
        <label >Caracteristicas</label>
        <select
            class="custom-select"
            multiple="multiple"
            id="myselect[]"
            name="myselect[]">
            <?php foreach ($observaciones as $ob):?>
            <option value="<?php echo $ob['id'];?>"><?php echo $ob['descripcion'];?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="mb-3 form-row text-center">
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
    <?php if($exist):?>
        <div class="mt-4 alert alert-danger " role="alert">
            El numero de arete ya existe
        </div>
    <?php endif;?>

    <?php if($status):?>
        <div class="mt-4 alert alert-success" id="success" data-status="true" role="alert">
            Se registro con exito
        </div>
    <?php endif;?>
    <?php $head = '<div class="row text-center">
            <div class="mt-1 alert alert-danger alert-dismissible fade show col-md-4" role="alert">
                <span>'; ?>
    <?php $foot = '</span> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>' ?>
        
   <?php echo form_error('arete', $head, $foot); ?>
   <?php echo form_error('color', $head, $foot); ?>
   <?php echo form_error('sexo', $head, $foot); ?>
   <?php echo form_error('edad', $head, $foot); ?>
   <?php echo form_error('descripcion', $head, $foot); ?>
   <?php echo form_error('myselect[]', $head, $foot); ?>

</form>

</div>

<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/popper.min.js" ></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" ></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script
src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->

<script>
    $(document).ready(function () {
        var status = $('#success').data('status');
        if(status) {
            $('#arete').val("");
            $('#color').val("");
            $('#sexo').val("");
            $('#edad').val("");
            $('#descripcion').val("");
        }
    });

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

</script>
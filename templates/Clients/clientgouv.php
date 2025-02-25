

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>


<div class="panel-body">
    <table class="table table-bordered table-striped table-bottomless" style="width:90%" align="center">

        <thead>
            <tr bgcolor="#EFEFEF">
                <td width="10%" align="center" style="display:none">Code</td>
                <td width="10%" align="center">Code</td>
                <td width="20%" align="center">Client</td>
                <td width="10%" align="center">case a cocher</td>

            </tr>
        </thead>

        <tbody>

            <?php  //debug($clients);die;

            foreach ($clients as $k => $client) :
               // debug($client);die;
            ?>
                <tr>
                    <td align="left" style="display:none"> <?php echo $client->Code ?> </td>
                    <td align="left">




                        <?php echo $client->Code;
                        //echo $this->Form->input('client_id', array('value' => $client['Client']['id'], 'div' => 'form-group', 'label' => '', 'name' => 'data[lignec][' . $k . '][client_id]', 'table' => 'lignec', 'index' => $k, 'id' => 'client_id' . $k, 'champ' => 'client_id', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); 
                        ?>
                        <input type="hidden" index="<?php echo $k ?>" id="commercial_id<?php echo $k ?>" champ="commercial_id" name="data[lignec][<?php echo $k ?>][commercial_id]" table="lignec" id="commercial_id<?php echo $k ?>" value="<?php echo $client->commercial_id ?>">

                        <input type="hidden" index="<?php echo $k ?>" id="client_id<?php echo $k ?>" champ="client_id" name="data[lignec][<?php echo $k ?>][client_id]" table="lignec" id="client_id<?php echo $k ?>" value="<?php echo $client->id ?>">
                    </td>
                    <td align="left">




                        <?php echo $client->Raison_Sociale;
                        //echo $this->Form->input('client_id', array('value' => $client['Client']['id'], 'div' => 'form-group', 'label' => '', 'name' => 'data[lignec][' . $k . '][client_id]', 'table' => 'lignec', 'index' => $k, 'id' => 'client_id' . $k, 'champ' => 'client_id', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); 
                        ?>
                        <input type="hidden" index="<?php echo $k ?>" id="commercial_id<?php echo $k ?>" champ="commercial_id" name="data[lignec][<?php echo $k ?>][commercial_id]" table="lignec" id="commercial_id<?php echo $k ?>" value="<?php echo $client->commercial_id ?>">

                        <input type="hidden" index="<?php echo $k ?>" id="client_id<?php echo $k ?>" champ="client_id" name="data[lignec][<?php echo $k ?>][client_id]" table="lignec" id="client_id<?php echo $k ?>" value="<?php echo $client->id ?>">
                    </td>

                    <td align="center"> <input type="checkbox" index="<?php echo $k ?>" id="checkclient<?php echo $k ?>" name="data[lignec][<?php echo $k ?>][checkclient]" champ="checkclient" value="2" class="ch"></td>


                </tr>





            <?php endforeach;  ?>


        </tbody>
    </table>
    <input type="hidden" id="index" value="<?php echo $k ?>" />


</div>
<script>
    $(document).ready(function() {

        $('.ch').on('change', function() {
             //alert("aaaa")
            ind = $(this).attr('index');
            index = $('#index').val();
            t = 0;
            for (i = 0; i <= Number(index); i++) {
                $('#checkclient' + i).val(2);

                if ($('#checkclient' + i).is(':checked')) {
                    t = t + 1;
                    $('#checkclient' + i).val(1);
                } else {
                    $('#checkclient' + i).val(2);
                }
            }
            //alert(t) 


        });
    });
</script>
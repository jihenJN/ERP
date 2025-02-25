<?php

use Cake\Datasource\ConnectionManager; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->fetch('script'); ?>
<section class="content-header">
    <?php if ($type == 2) { ?>
        <h1>
            Ajout bon de réservation excel
            <small><?php echo __(''); ?></small>
        </h1>
    <?php } ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
    <br>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <?php echo $this->Form->create($bonlivraison, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <section class="content-header">
                                    <div class="row">
                                            <div class="col-xs-6">
                                                <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $mm, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                            </div>
                                            <div class="col-xs-6">
                                                <?php echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]) ?>
                                            </div>
                                     
                                        <div class="col-xs-6">
                                            <label class="control-label" for="depot-id">Clients</label>
                                            <select name="client_id" id="client" class="form-control select2 control-label ">
                                                <option value="" selected="selected">Veuillez choisir !!</option>
                                                <?php foreach ($clients as $id => $client) {
                                                ?>
                                                    <option value="<?php echo $client->id; ?>"><?php if($client->Tel!=null){ echo $client->Tel . ' -- '; } echo $client->Raison_Sociale ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-6" id="">
                                            <?php echo $this->Form->control('commercial_id', ['options' => $commercials, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Commercials', 'class' => 'form-control select2 control-label']); ?>
                                        </div>
                                        <div class="col-xs-6">
                                            <?php echo $this->Form->control('depot_id', ['options' => $depots, 'required' => 'off', 'label' => 'Dépots', 'class' => 'form-control select2 control-label', 'empty' => 'Veuillez choisir !!']); ?>
                                        </div>

                                        <div class="col-xs-6">
                                            <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
                                        </div>

                                        <input type="hidden" name="fodecclient" id="fodecclient" class="" style="margin-right: 20px">
                                        <input type="hidden" name="fodecclientexo" id="fodecclientexo" class="" style="margin-right: 20px">
                                        <input type="hidden" name="timbreclientexo" id="timbreclientexo" class="" style="margin-right: 20px">
                                        <input type="hidden" name="tvaclientexo" id="tvaclientexo" class="" style="margin-right: 20px">
                                        <input type="hidden" name="tpeclientexo" id="tpeclientexo" class="" style="margin-right: 20px">
                                        <input type="hidden" name="categclient" id="categclient" class="" style="margin-right: 20px">
                                        <input type="hidden" name="formule" id="formule" class="" style="margin-right: 20px">
                                        <input type="hidden" name="escompteSociete" id="escompteSociete" value="<?php echo $escompte ?>" style="margin-right: 20px">
                                        <div class="col-xs-12" id="blocclient" style="display: none;">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><?php echo __('Info de client'); ?></h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="col-xs-6">
                                                        <?php echo $this->Form->input('name', array('readonly' => 'readonly', 'label' => 'Raison Sociale', 'id' => 'name', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                        ?>
                                                    </div>
                                                    <div class="col-xs-3" style="flex-direction:row; display: flex;margin-top: 30px">
                                                        <label>Type Clients : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <div id="typecli"></div>
                                                    </div>
                                                    <div class="col-xs-3" style="display: flex;margin-top: 30px;">
                                                        <div id="BL"></div>
                                                    </div>
                                                    <div class="col-xs-2" style="flex-direction:row;display: flex;margin-top: 40px;width: 20% !important;">
                                                        <label>Remise : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                                                        <div id="remi"></div>
                                                    </div>
                                                    <div class="col-xs-4" style="width:15%;margin-top: 10px;">
                                                        <?php
                                                        echo $this->Form->input('remiseee', array('readonly' => 'readonly', 'id' => 'remise-val', 'label' => '',  'class' => 'form-control'));
                                                        ?>
                                                    </div>
                                                    <div class="col-xs-6" style="margin-top:-70px">
                                                        <?php
                                                        echo $this->Form->input('matriculefiscale', array('label' => 'Matricule Fiscale', 'id' => 'matriculefiscale', 'div' => 'form-group', 'readonly' => 'readonly', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                        ?>
                                                    </div>
                                                    <div class="col-xs-2" style="flex-direction:row;display: flex;margin-top: 25px;width: 20% !important;">
                                                        <label>Escompte : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <div id="com"></div>
                                                    </div>
                                                    <div class="col-xs-4" style="width:15%">
                                                        <?php
                                                        echo $this->Form->input('escomptee', array('readonly' => 'readonly', 'label' => '', 'id' => 'escompte-val', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                        ?>
                                                    </div>
                                                    <div class="col-xs-6" style="margin-top:-75px">
                                                        <?php
                                                        echo $this->Form->input('adresse', array('readonly' => 'readonly', 'label' => 'Adresse', 'id' => 'adresse', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                        ?>
                                                    </div>
                                                    <input type="hidden" id="cl_id" />
                                                    <input type="hidden" id="typeclient" />
                                                    <input type="hidden" id="typeclientidd" />
                                                    <input type="hidden" id="gouvernerat" />

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="col-xs-6">
                                                <h1 class="box-title"><?php echo __('Articles'); ?></h1>
                                            </div>
                                            <div class="col-xs-6">
                                                <br><br>
                                                <input type="file" id="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="content" style="width: 99%">
                                    <div class="row">
                                        <div class="box box-primary">
                                            <div class="panel-body">
                                                <div class="table-responsive ls-table">
                                                    <div id="excel-table-container">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <?php
                            $connection = ConnectionManager::get('default');
                            $articleid = $connection->execute("SELECT Dsignation  FROM articles ")->fetchAll('assoc');
                            $articleref = $connection->execute("SELECT refBureauEtude  FROM articles ")->fetchAll('assoc');
                    ///debug($articleref);
                            ?>

                            <div align="center">
                                <button type="submit" class="pull-right btn btn-success btn-sm verifqte Testqtestock chauff" id="boutonlivraison" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;display:none;">Enregistrer</button>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>
<script>
 


    $('.select2').select2()

</script>
<?php $this->end(); ?>
<script>
    $(function() {
        var filterFloat = function(value) {
            if (/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
                .test(value))
                return Number(value);
            return NaN;
        }
        $('#client').on('change', function() {
            // alert('hello');
            id = $('#client').val();
            $('#cl_id').val(id);
            date = $('#date').val();
            // alert(date)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getremise']) ?>",
                dataType: "json",
                data: {
                    idfam: id,
                    date: date,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    // alert(data.select);
                    // alert(data.ligne.Fodec);
                    //  $('#adresselivraison-id').html(data.select);
                    $('#com_id').html(data.select);
                    //alert(data.typeclient);
                    $('#formule').val(data.ligne.prix);
                    $('#form').val(data.ligne.prix);
                    verifprix = data.ligne.prix;
                    if (verifprix == 'PHT+Fodec') {
                        formul = 'PHT+Fod';
                    }
                    if (verifprix == 'PHT') {
                        formul = 'PHT';
                    }
                    if (verifprix == '(PHT-Remise)+Fodec') {
                        formul = '(PHT-R%)+Fod';
                    }
                    if (verifprix == '((PHT-Remise)-Escompte)+Fodec') {
                        formul = '((PHT-R%)-Esc%)+Fod';
                    }
                    $('#prixverif').html(formul);
                    $('#categclient').val(data.valeurcategorie);
                    $('#remise').val(data.ligne.remise);
                    $('#fodecclient').val(data.ligne.Fodec);
                    //typeclient
                    $('#typeclient').val(data.typeclient);
                    $('#typeclientidd').val(data.typeclientid);
                    $('#gouvernerat').val(data.govname);
                    //$client->localite->name.' '.$client->delegation->name.' '.$client->delegation->codepostale
                    $('#typeclientname').val(data.typeclientname);
                    nom = data.typeclientname
                    valnot = data.not;
                    //alert(data.typeclientname);
                    valgs = data.gs;
                    //alert("kkkkkk");
                    if (data.typeclient == false) {
                        if (valnot != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/promoarticles/notgrandsurface/' + valnot + '")\'>' + nom + '</a>'
                            $('#typecli').html(a);
                        } else {
                            a = '<div>aucun promo</div>'
                            $('#typecli').html(a);

                        }
                    } else if (data.typeclient == true) {
                        if (valgs != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/gspromoarticles/grandsurface/' + valgs + '")\'>' + nom + '</a>'
                            $('#typecli').html(a);
                        } else {
                            a = '<div>aucun promo</div>'
                            $('#typecli').html(a);
                        }
                    }
                    $('#nouv').val(data.ligne.nouveau_client);
                    valrem = Number(data.remcli);
                    valcom = Number(data.remes);
                    if (data.remise == true) {
                        $('#remise-val').val(data.ligne.remise);
                        if (valrem != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/remiseclients/consultation/' + valrem + '")\'>avec palier</a>'
                            $('#remi').html(a);
                        } else {
                            a = '<a>avec palier</a>'
                            $('#remi').html(a);
                        }
                    }
                    if (data.remise == false) {
                        $('#remise-val').val(data.ligne.remise);
                        div = '<div >sans palier</div>'
                        $('#remi').html(div);
                    }
                    if (data.escompte == true) {
                        $('#escompte-val').val(data.ligne.escompte);
                        if (valcom != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/remiseescomptes/consultation/' + valcom + '")\'>avec palier</a>'
                            $('#com').html(a);
                        } else {
                            a = '<a>avec palier</a>'
                            $('#com').html(a);
                        }
                    }
                    if (data.escompte == false) {
                        $('#escompte-val').val(data.ligne.escompte);
                        div = '<div >sans palier</div>'
                        $('#com').html(div);
                    }
                    bl = Number(data.typeclientbl);
                    if (data.typeclientbl == true) {
                        check = ' <label  > BL:</label> OUI <input  type="radio" name="bl" value="1" id="maryam" style="margin-right: 20px" checked> NON <input  type="radio" name="bl" value="0" id="mahdi" >'
                        $('#BL').html(check);
                    } else {
                        check = '<label style="" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label><input disabled type="hidden" name="che" value="0" id="mar" style="margin-right: 20px">  <input disabled type="hidden" name="che" value="1" id="mah"  checked>'
                        $('#BL').html(check);
                    }
                    $('#adresse').val(data.ligne.Adresse);
                    $('#matriculefiscale').val(data.ligne.Matricule_Fiscale);
                    $('#name').val(data.ligne.Code + " " + data.ligne.Raison_Sociale);
                    $('#telclient').val(data.tel);
                    $('#auto').val(data.autor);
                    $('#solde').val(data.solde);
                    $('#valreste').val(data.valreste);
                    //$('#typeclientid').val(data.typeclientid);
                    $('#blocclient').show();
                    page = $('#page').val() || 0;
                    //if(page=="factureclient"){
                    $('#typeclientid').parent().parent().html(data.select);
                    // uniform_select('typeclientid');
                    $('#fodecclientexo').val(data.exofodec);
                    $('#timbreclientexo').val(data.exotimbre);
                    $('#tvaclientexo').val(data.exotva);
                    $('#tpeclientexo').val(data.exotpe);
                    //   alert(data.exofodec);
                    if (data.exofodec == '' && data.exotva == '' && data.exotpe == '') {
                        $('#typeexenoration').val('Non exoneré');
                    } else {
                        $('#typeexenoration').val(data.exofodec + '/' + data.exotva + '/' + data.exotpe);
                    }
                }
            })
        });
    });
</script>

<script>
    var excelData;
     document.getElementById('file').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            var data = new Uint8Array(e.target.result);
            var workbook = XLSX.read(data, {
                type: 'array'
            });
            var worksheet = workbook.Sheets[workbook.SheetNames[0]];
            var jsonData = XLSX.utils.sheet_to_json(worksheet, {
                header: 1
            });
            excelData = jsonData;
            var isDesignationAvailable = true;
            var isrefAvailable = true;

            for (var i = 0; i < jsonData.length; i++) {
                if(i>9)
               {
                if(jsonData[i][2].indexOf('Chapeau')) {
                var designationValue = jsonData[i][2];
                var refValue = jsonData[i][8];
                //  alert(designationValue);
                // console.log(jsonData);
                // if (!isDesignationPresent(designationValue)) {
                //     isDesignationAvailable = false;
                //     break;
                // }
                if (!isRefbureauPresent(refValue)) {
                    isrefAvailable = false;
                    break;
                }
            }
            }
            }
            if (isrefAvailable) {
                document.getElementById('boutonlivraison').style.display = 'block';
            } else {
                document.getElementById('boutonlivraison').style.display = 'none';
                alert('Code non disponible');
            }
              document.getElementById('file').addEventListener('change', function(event) {
                for (var i = 1; i < jsonData.length; i++) {
                  //  var designationValue = jsonData[i][2];
                     var refValue = jsonData[i][9];
                   // alert(refValue)


                    if ( (!isRefbureauPresent(refValue)) ){
                        var row = document.getElementById('row-' + i);
                        row.style.color = 'red';
                    }
                }
            });
            // console.log(jsonData);
            var tableHtml = '<table class="table table-bordered table-striped table-bottomless">';
            for (var i = 0; i < jsonData.length; i++) {//alert();
               
               if(i==4 || i>9)
               {

                tableHtml += '<tr>';
                j=0;
                for (var j = 0; j < jsonData[i].length; j++) {//alert();
               
              //  console.log(jsonData[i][]);
                 
                columnName=jsonData[4][j];
                
                 
                    var inputName = 'data[ligneexcs][' + i + '][' + columnName + ']';
                    var inputValue = jsonData[i][j];
                    var inputId = columnName + i;
                    var champAttr = 'champ="' + columnName + '"';
                    var tableAttr = 'table="ligneexcs"';
                 /// alert(jsonData[i][2].indexOf('Chapeau'));
                     if(jsonData[i][2].indexOf('Chapeau'))
                   
                 {
                    if (inputValue==null){
                        inputValue='';
                    }

                    tableHtml += generateInputCell(i, inputValue, inputName, inputId, inputValue, champAttr, tableAttr, columnName);
                     }
                    }

                
                tableHtml += '</tr>';
                    }
            }
            tableHtml += '</table>';
            document.getElementById('excel-table-container').innerHTML = tableHtml;
        };
        reader.readAsArrayBuffer(file);
    });

    // function isDesignationPresent(designationValue) {
    //     <?php
    //     $designationValues = array_column($articleid, 'Dsignation');
    //     ?>
    //     var designationValues = <?php ///echo json_encode($designationValues); ?>;
    //     return designationValues.includes(designationValue);
    // }
    // var designationValues = <?php //echo json_encode($designationValues); ?>;

    function isRefbureauPresent(refbureauValue) {
        <?php
        $refValues = array_column($articleref, 'refBureauEtude');
        ?>
        var refValues = <?php echo json_encode($refValues); ?>;
        return refValues.includes(refbureauValue);
    }
    var refValues = <?php echo json_encode($refValues); ?>;

   // console.log(refValues);

    function generateInputCell(i, label, name, id, value, champAttr, tableAttr, columnName) {
       //console.log(value);
        var cellHtml = '';
        //var isDesignationPresent = designationValues.includes(value);
        var isrefPresent = refValues.includes(value);
      //  var color = isDesignationPresent ? 'black' : 'red';
        var color = isrefPresent ? 'black' : 'red';

        if (columnName == 'CODE' && label == 'CODE'){
            cellHtml += '<td>' + label + '</td>';
            cellHtml += '<td>';
            cellHtml += 'DISPONIBILITÉ';
            cellHtml += '</td>';
        } else
        if (columnName == 'CODE' && i != 0) {
            cellHtml += '<td>' + label + '</td>';
            cellHtml += '<td style="color: ' + color + ';">';
            cellHtml += isrefPresent ? 'disponible' : 'non disponible';
            cellHtml += '</td>';
        } else {
            cellHtml += '<td>' + label + '</td>';
        }
        cellHtml += '<td hidden>';
        cellHtml += '<input name="' + name + '" id="' + id + '" value="' + value + '" ' + champAttr + ' ' + tableAttr + ' columnName="' + columnName + '">';
        cellHtml += '</td>';
        return cellHtml;
    }
</script>


<script>

function isDateFormat(string) {
  var pattern = /^\d{2}\/\d{2}\/\d{4}$/;
  
  return pattern.test(string);
}
    $(document).ready(function() {
        function handleMouseOver() {
            var idClient = $('#client').val();
            var commercialId = $('#commercial-id').val();

            if (idClient === '') {
                alert('Champ obligatoire: client');
            }

            if (commercialId === '') {
                alert('Champ obligatoire: Commercial');
            }
        }

        $('#boutonlivraison').mouseover(handleMouseOver);
    });
    $("form").submit(function() {
            // alert("dsf");
            $('#boutonlivraison').attr('disabled', 'disabled');

        })
</script>
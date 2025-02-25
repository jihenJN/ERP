<?php $this->layout = 'AdminLTE.print'; ?>
<br>
<div style="display:flex">
    <div style="margin-left:1%">
    <?php 
      echo $this->Html->image('m.png', ['alt' => 'CakePHP','height'=>'100px','width'=>'200px']); ?>
    
    </div>
    <div style="margin-left:30%">
Société Laboratoires Grenat <br>
Route de Teboulbi km 5 <br>
Phone:20182836 <br>
Mail :contact@laboratoires-grenat.com <br>
    </div>
</div>
            <table width="100%">
                <tr>
                    <td width="45%" height="50px">
                       
                    </td>

                    <td width="55%">
                       
                    </td>

                </tr>
<tr><td colspan="2"><br><hr></td></tr>
<tr>
                    <td width="100%"  align="center">
                     <span style="font-weight: bold;">  </span>
                    </td>

                   

                </tr>
            </table>
<br>



















<div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
              </div>
<div class="box-body">
       <?php echo $this->Form->create($fournisseur, ['role' => 'form']);
       ?>
    <table>
        <tbody>
            <tr>
                <td style="width:50%"><?= __('Nom et prénom :') ?></td>
                <td align="center" style="width:50%"><?= h($fournisseur->name) ?></td>
            </tr>
            <tr>
                <td style="width:50%"><?= __('Mode paiement :') ?></td>
                <td align="center" style="width:50%"><?= h($fournisseur->paiement_id) ?></td>
            </tr> 
            <tr>
                <td style="width:50%"><?= __('Type localisation :') ?></td>
                <td style="width:50%" align="center"><?= $this->Number->format($fournisseur->typelocalisation_id) ?></td>
            </tr>         
            <tr>
                <td style="width:50%"><?= __('télèphone :') ?></td>
                <td style="width:50%" align="center"><?= $this->Number->format($fournisseur->tel) ?></td>
            </tr> 
             <tr>
                <td style="width:50%"><?= __('Compte comptable :') ?></td>
                <td style="width:50%" align="center"><?= h($fournisseur->compte_comptable) ?></td>
            </tr> 
             <tr>
                <td style="width:50%" ><?= __('Fax :') ?></td>
                <td style="width:50%" align="center"><?= $this->Number->format($fournisseur->fax) ?></td>
            </tr> 
              <tr>
                <td style="width:50%"><?= __('Email :') ?></td>
                <td style="width:50%" align="center"><?= h($fournisseur->mail) ?></td>
            </tr> 
            
    </tbody>    
    </table>
      <?php echo $this->Form->end(); ?>

        </div>
        </div>
      </div>
    </div>
  </div>
            











    
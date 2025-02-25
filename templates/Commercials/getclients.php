
<?php echo $this->Html->script('hechem'); ?>


<div id="clients<?php echo $ind ?>" 
>


                          <div class="table-responsive ls-table" >
                            <table style="width:70%" align="center" class="table table-bordered table-striped table-bottomless">
                              <thead>
                              </thead>
                              <tbody>
                              <?php 
                            
                                 foreach ($clients as $j  => $cl )   { 
                                ?>
                                <tr>
                                <td> 

                                  <input readonly value="<?php echo $cl->Code . ' ' . $cl->Raison_Sociale  ?>"  index="<?php echo $j ?>" table ="Client" champ="name" name="data[Gouvernorat][<?php echo $ind ?>][Client][<?php echo $j ?>][nom]"  id="client<?php echo $j ?>" class="form-control" >
                                  <input type="hidden" value="<?php echo $cl['id'] ?>"  index="<?php echo $j ?>" table ="Client" champ="id" name="data[Gouvernorat][<?php echo $ind ?>][Client][<?php echo $j ?>][client_id]  "  id="client<?php echo $j ?>" class="form-control" >
                               </td>
                               <td align="center"> <input checked  type="checkbox" index="<?php echo $j ?>" id="checkclient<?php echo $j ?>" name="data[Gouvernorat][<?php echo $ind ?>][Client][<?php echo $j ?>][checkclient]" champ="checkclient" value="1" ></td>
                               </td>
                                 
                                </tr>
                              </tbody>

                              <?php } ?>


                            </table>

                            <input type="hidden" value="" id="index">
   
                        </div>
                    </div>
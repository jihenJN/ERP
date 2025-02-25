<div>
                          <div class="table-responsive ls-table">
                            <table style="width:70%" align="center" class="table table-bordered table-striped table-bottomless">
                              
                              <tbody>
                              <?php 
                             // echo $ind ; 
                                 foreach ($deleg as $j  => $d )   { 
                                ?>
                                <tr>
                                <td> 

                                  <input readonly value="<?php echo $d['name'] ?>"  index="<?php echo $j ?>" table ="delegation" champ="name" name="data[Gouvernorat][<?php echo $ind ?>][Delegation][<?php echo $j ?>][nom]" table="delegation" id="deleg<?php echo $j ?>" class="form-control" >
                                  <input type="hidden" value="<?php echo $d['id'] ?>"  index="<?php echo $j ?>" table ="delegation" champ="name" name="data[Gouvernorat][<?php echo $ind ?>][Delegation][<?php echo $j ?>][deleg_id]  " table="delegation" id="deleg<?php echo $j ?>" class="form-control" >

                               </td>
                               <td align="center"> <input checked  type="checkbox" index="<?php echo $j ?>" id="checkdelegation<?php echo $j ?>" name="data[Gouvernorat][<?php echo $ind ?>][Delegation][<?php echo $j ?>][checkdelegation]" champ="checkdelegation" value="1" ></td>
                               </td>
                                 
                                </tr>
                              </tbody>

                              <?php } ?>


                            </table>

                            <input type="hidden" value="" id="index">
   
                        </div>
                    </div>
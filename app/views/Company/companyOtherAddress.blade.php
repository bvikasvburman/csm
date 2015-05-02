<table class="table table-stripped table-bordered commu_table1">
                                <thead>
                                    <tr>
                                        <th style="width: 10px"><input type="checkbox" id="checkallitem_t2"></th>
                                        <th style="text-align: center;">
                                            {{trans('company.type')}}
                                        </th>
                                        <th style="text-align: center;">
                                            {{trans('company.postal')}}
                                        </th>
                                        <th style="text-align: center;">
                                            
                                            {{trans('company.city')}}
                                        </th>
                                        <th style="text-align: center;">
                                            
                                            {{trans('company.country')}}
                                        </th>
                                        <th style="text-align: center;">
                                       
                                            {{trans('company.street')}}
                                        </th>
                                        <th style="text-align: center;">
                                            <a class="btn btn-xs btn-success add_address_d">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $addType = array('1'=>'Delivery','2'=>'Invoice');
                                        if(!($content->isEmpty()))
                                        foreach ($content as $other_add)
                                        {
                                    ?>
                                    <tr data-id='<?php echo $other_add->id; ?>'>
                                        <td><input name="selected[]" class="actionsid_t2 square-blue" value="<?php echo $other_add->id; ?>" type="checkbox"></td>
                                        <td>
                                            <select class="form-control" name="add_type_<?php echo $other_add->id; ?>" id="add_type_<?php echo $other_add->id; ?>">
                                                <option value="">{{trans('common.select')}}</option>
                                                <?php
                                                    foreach ($addType as $key => $type_r)
                                                    {
                                                        $sel = "";
                                                        if($other_add->addresstypeno == $key)
                                                            $sel="selected='selected'";
                                                ?>
                                                <option <?php echo $sel;?> value="<?php echo $key;?>"><?php echo $type_r;?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="add_postal_<?php echo $other_add->id; ?>" id="add_postal_<?php echo $other_add->id; ?>" value="<?php echo $other_add->postalcode;?>" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="add_city_<?php echo $other_add->id; ?>" id="add_city_<?php echo $other_add->id; ?>" value="<?php echo $other_add->city;?>" />
                                            
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="add_country_<?php echo $other_add->id; ?>" id="add_country_<?php echo $other_add->id; ?>" value="<?php echo $other_add->country;?>" />
                                            
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="add_street_<?php echo $other_add->id; ?>" id="add_street_<?php echo $other_add->id; ?>" value="<?php echo $other_add->street;?>" />
                                            
                                        </td>
                                        <td>
                                            <a class="btn btn-info save_other_add" data-id="<?php echo $other_add->id; ?>">Save</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                                
                                <tfooter>
                                    {{$content->links()}}
                                </tfooter>
                                </table>
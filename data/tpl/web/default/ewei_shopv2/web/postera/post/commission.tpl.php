<?php defined('IN_IA') or exit('Access Denied');?> 
 <div class="alert alert-info">
     只适用于推荐人是分销商的情况，才能发展下线
 </div>
                 <div class="form-group">
                     <label class="col-sm-2 control-label">开放权限</label>
                     <div class="col-sm-9 col-xs-12">
                         <?php if( ce('postera' ,$item) ) { ?>
                         <label class="radio-inline">
                             <input type="radio" name="isopen" value="1" <?php  if($item['isopen']==1) { ?>checked<?php  } ?> /> 允许
                         </label>
                         <label class="radio-inline">
                             <input type="radio" name="isopen" value="0" <?php  if(empty($item['isopen'])) { ?>checked<?php  } ?> /> 不允许
                         </label>
                         <span class='help-block'>是否允许非分销商生成自己的海报</span>
                         <?php  } else { ?>
                         <div class='form-control-static'><?php  if($item['bedown']==1) { ?>是<?php  } else { ?>否<?php  } ?></div>
                         <?php  } ?>

                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-sm-2 control-label">未开放时候的提示</label>
                     <div class="col-sm-9 col-xs-12">
                         <?php if( ce('postera' ,$item) ) { ?>
                         <input type="text" name="opentext" class="form-control" value="<?php  echo $item['opentext'];?>" />
                         <span class="help-block">例如：您还不是我们分销商，去努力成为分销商，拥有你的专属海报吧!</span>
                         <?php  } else { ?>
                         <div class='form-control-static'><?php  echo $item['opentext'];?></div>
                         <?php  } ?>
                     </div>
                 </div>

                 <div class="form-group">
                     <label class="col-sm-2 control-label">未开放时候的说明连接</label>
                     <div class="col-sm-9 col-xs-12">
                         <?php if( ce('postera' ,$item) ) { ?>
                         <input type="text" name="openurl" class="form-control" value="<?php  echo $item['openurl'];?>" />
                         <?php  } else { ?>
                         <div class='form-control-static'><?php  echo $item['openurl'];?></div>
                         <?php  } ?>
                     </div>
                 </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">扫码关注成为下线</label>
                    <div class="col-sm-9 col-xs-12">
                       <?php if( ce('postera' ,$item) ) { ?>
                        <label class="radio-inline">
                            <input type="radio" name="bedown" value="1" <?php  if($item['bedown']==1) { ?>checked<?php  } ?> /> 是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="bedown" value="0" <?php  if(empty($item['bedown'])) { ?>checked<?php  } ?> /> 否
                        </label>
                        <span class='help-block'>扫码关注直接成为推荐人的下线，不受分销【基础设置】的成为下线条件控制</span>
                      <?php  } else { ?>
                        <div class='form-control-static'><?php  if($item['bedown']==1) { ?>是<?php  } else { ?>否<?php  } ?></div>
                      <?php  } ?>
                      
                    </div> 
                </div>
              <div class="form-group">
                    <label class="col-sm-2 control-label">扫码关注成为分销商</label>
                    <div class="col-sm-9 col-xs-12">
                          <?php if( ce('postera' ,$item) ) { ?>
                        <label class="radio-inline">
                            <input type="radio" name="beagent" value="1" <?php  if($item['beagent']==1) { ?>checked<?php  } ?> /> 是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="beagent" value="0" <?php  if(empty($item['beagent'])) { ?>checked<?php  } ?> /> 否
                        </label>
                        <span class='help-block'>扫码关注直接成为推荐人的下线并成为分销商，不受分销【基础设置】的成为分销商下线条件控制（仅是否直接审核通过由基础设置控制）</span>
                       <?php  } else { ?>
                        <div class='form-control-static'><?php  if($item['beagent']==1) { ?>是<?php  } else { ?>否<?php  } ?></div>
                      <?php  } ?>
                    </div> 
                </div>
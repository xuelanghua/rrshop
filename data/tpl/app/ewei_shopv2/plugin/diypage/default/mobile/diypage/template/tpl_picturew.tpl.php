<?php defined('IN_IA') or exit('Access Denied');?><?php  if(!empty($diyitem['data'])) { ?>
    <?php  $diyitem['data'] = p('diypage')->toArray($diyitem['data'])?>
    <?php  if($diyitem['params']['row']==1) { ?>
        <div class="fui-cube" style="background: <?php  echo $diyitem['style']['background'];?>; <?php  if(count($diyitem['data'])==1) { ?>padding: <?php  echo $diyitem['style']['paddingtop'];?>px <?php  echo $diyitem['style']['paddingleft'];?>px;<?php  } ?>">
            <?php  if(count($diyitem['data'])==1) { ?>
                <a href="<?php  echo $diyitem['data'][0]['linkurl'];?>" data-nocache="true"><img data-lazy="<?php  echo tomedia($diyitem['data'][0]['imgurl'])?>" /></a>
            <?php  } else if(count($diyitem['data'])>1) { ?>
                <div class="fui-cube-left" style="padding: <?php  echo $diyitem['style']['paddingtop'];?>px <?php  echo $diyitem['style']['paddingleft'];?>px; padding-right: 0;">
                    <a href="<?php  echo $diyitem['data'][0]['linkurl'];?>" data-nocache="true"><img data-lazy="<?php  echo tomedia($diyitem['data'][0]['imgurl'])?>" /></a>
                </div>
                <div class="fui-cube-right" <?php  if(count($diyitem['data'])==2) { ?> style="padding: <?php  echo $diyitem['style']['paddingtop'];?>px <?php  echo $diyitem['style']['paddingleft'];?>px;"<?php  } ?>>
                    <?php  if(count($diyitem['data'])==2) { ?>
                        <a href="<?php  echo $diyitem['data'][1]['linkurl'];?>" data-nocache="true"><img data-lazy="<?php  echo tomedia($diyitem['data'][1]['imgurl'])?>" /></a>
                    <?php  } else if(count($diyitem['data'])>2) { ?>
                        <div class="fui-cube-right1" style="padding: <?php  echo $diyitem['style']['paddingtop'];?>px <?php  echo $diyitem['style']['paddingleft'];?>px; padding-bottom: 0;">
                            <a href="<?php  echo $diyitem['data'][1]['linkurl'];?>" data-nocache="true"><img data-lazy="<?php  echo tomedia($diyitem['data'][1]['imgurl'])?>" /></a>
                        </div>
                        <div class="fui-cube-right2" <?php  if(count($diyitem['data'])==3) { ?> style="padding: <?php  echo $diyitem['style']['paddingtop'];?>px <?php  echo $diyitem['style']['paddingleft'];?>px;"<?php  } ?>>
                            <?php  if(count($diyitem['data'])==3) { ?>
                                <a href="<?php  echo $diyitem['data'][2]['linkurl'];?>" data-nocache="true"><img data-lazy="<?php  echo tomedia($diyitem['data'][2]['imgurl'])?>" /></a>
                            <?php  } else if(count($diyitem['data'])>3) { ?>
                                <div class="left" style="padding: <?php  echo $diyitem['style']['paddingtop'];?>px <?php  echo $diyitem['style']['paddingleft'];?>px; padding-right: 0;">
                                    <a href="<?php  echo $diyitem['data'][2]['linkurl'];?>" data-nocache="true"><img data-lazy="<?php  echo tomedia($diyitem['data'][2]['imgurl'])?>" /></a>
                                </div>
                             <?php  } ?>
                             <?php  if(count($diyitem['data'])>=4) { ?>
                                <div class="right" style="padding: <?php  echo $diyitem['style']['paddingtop'];?>px <?php  echo $diyitem['style']['paddingleft'];?>px;">
                                    <a href="<?php  echo $diyitem['data'][3]['linkurl'];?>" data-nocache="true"><img data-lazy="<?php  echo tomedia($diyitem['data'][3]['imgurl'])?>" /></a>
                                </div>
                             <?php  } ?>
                        </div>
                    <?php  } ?>
                 </div>
            <?php  } ?>
        </div>
    <?php  } else if($diyitem['params']['row']>1) { ?>
        <?php  if(empty($diyitem['params']['showtype']) || count($diyitem['data'])<=intval($diyitem['style']['pagenum'])) { ?>
            <div class="fui-picturew row-<?php  echo $diyitem['params']['row'];?>" style="padding: <?php  echo $diyitem['style']['paddingtop'];?>px <?php  echo $diyitem['style']['paddingleft'];?>px; background: <?php  echo $diyitem['style']['background'];?>;">
                <?php  if(is_array($diyitem['data'])) { foreach($diyitem['data'] as $pictureitem) { ?>
                    <div class="item" style="padding: <?php  echo $diyitem['style']['paddingtop'];?>px <?php  echo $diyitem['style']['paddingleft'];?>px;">
                        <a href="<?php  echo $pictureitem['linkurl'];?>" data-nocache="true"><img data-lazy="<?php  echo tomedia($pictureitem['imgurl'])?>"></a>
                    </div>
                <?php  } } ?>
            </div>
        <?php  } else { ?>
            <div class="swiper swiper-<?php  echo $diyitemid;?>" data-element=".swiper-<?php  echo $diyitemid;?>" data-view="1" data-btn="true">
                <div class="swiper-container fui-picturew row-<?php  echo $diyitem['params']['row'];?>" style="padding: <?php  echo $diyitem['style']['paddingtop'];?>px <?php  echo $diyitem['style']['paddingleft'];?>px; background: <?php  echo $diyitem['style']['background'];?>;">
                    <div class="swiper-wrapper">
                        <?php  if(is_array($diyitem['data_temp'])) { foreach($diyitem['data_temp'] as $data_temp) { ?>
                            <div class="swiper-slide">
                                    <?php  if(is_array($data_temp)) { foreach($data_temp as $pictureitem) { ?>
                                    <div class="item" style="padding: <?php  echo $diyitem['style']['paddingtop'];?>px <?php  echo $diyitem['style']['paddingleft'];?>px;">
                                        <a href="<?php  echo $pictureitem['linkurl'];?>" data-nocache="true"><img src="<?php  echo tomedia($pictureitem['imgurl'])?>"></a>
                                    </div>
                                <?php  } } ?>
                            </div>
                        <?php  } } ?>
                    </div>
                    <?php  if(!empty($diyitem['style']['showdot'])) { ?>
                        <div class="swiper-pagination" style="position: absolute; bottom: 0;"></div>
                    <?php  } ?>
                    <?php  if(!empty($diyitem['style']['showbtn'])) { ?>
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    <?php  } ?>
                </div>
            </div>
        <?php  } ?>
    <?php  } ?>
<?php  } ?>
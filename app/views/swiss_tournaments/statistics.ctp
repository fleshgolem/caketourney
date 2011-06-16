<div class="tournaments view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php  echo ($tournament['SwissTournament']['name'].' Statistics');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>


<div class="PostBox">
<div class="ThreadTitleBox">
	
	
      <div class="bottomactionleft">
     	<?php 
		echo $this->Html->link('Rounds', array('action'=>'view',$tournament['SwissTournament']['id']));
		?>
     </div>
     <div class="bottomactionleft">
     	<?php 
		echo $this->Html->link('Score', array('action'=>'score',$tournament['SwissTournament']['id']));
		?>
     </div>
	<p style="clear: both;">  </p>  
</div>
</div>


<div class="PostBox"> 
	<div class="PostContent">
		
			<div class="PostContentBox">
				<div class="PostMainContentbox" margin-left: auto;  margin-right: auto>
					
                    <?php
					if($TvP_array[0]!=0){?>
                    <div class="PostChartPaddingBox">
                        <div class="PostChartContentBox">
                            <div class="PostMainContentbox">
                            	
                                <?php
                                    $dataTvP=array(array());
                                    $dataTvP[0]['label']='Wins';
                                    $dataTvP[1]['label']='Losses';
                                    $dataTvP[0]['count']=$TvP_array[1];
                                    $dataTvP[1]['count']=$TvP_array[2];
                                    echo $flashChart->begin();
                                    $flashChart->setBgColour('d3d4d5');
                                    $flashChart->setTitle('TvP Ratio','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
                                    $flashChart->setData($dataTvP,'{n}.count','{n}.label','TvP_data');
                                    echo $flashChart->pie(array('start_angle'=>90,'tooltip'=>'#val# of #total#<br>#percent# of 100%'),50,'TvP_data','TvP_plot'); 
                                    echo $flashChart->render(208,208,'TvP_plot');
                                ?>
                            </div>
                        </div>
                    </div> 
                    <?php
                    }
                    ?>
                    
                    
                    <?php
					if($PvZ_array[0]!=0){?>
                    <div class="PostChartPaddingBox">
                        <div class="PostChartContentBox">
                            <div class="PostMainContentbox">
                            	
                                <?php
                                    $dataPvZ=array(array());
                                    $dataPvZ[0]['label']='Wins';
                                    $dataPvZ[1]['label']='Losses';
                                    $dataPvZ[0]['count']=$PvZ_array[1];
                                    $dataPvZ[1]['count']=$PvZ_array[2];
                                    echo $flashChart->begin();
                                    $flashChart->setBgColour('d3d4d5');
                                    $flashChart->setTitle('PvZ Ratio','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
                                    $flashChart->setData($dataPvZ,'{n}.count','{n}.label','PvZ_data');
                                    echo $flashChart->pie(array('start_angle'=>90,'tooltip'=>'#val# of #total#<br>#percent# of 100%'),50,'PvZ_data','PvZ_plot'); 
                                    echo $flashChart->render(208,208,'PvZ_plot');
                                ?>
                            </div>
                        </div>
                    </div> 
                    <?php
                    }
                    ?>
                    
                     <?php
					if($ZvT_array[0]!=0){?>
                    <div class="PostChartPaddingBox">
                        <div class="PostChartContentBox">
                            <div class="PostMainContentbox">
                            	
                                <?php
                                    $dataZvT=array(array());
                                    $dataZvT[0]['label']='Wins';
                                    $dataZvT[1]['label']='Losses';
                                    $dataZvT[0]['count']=$ZvT_array[1];
                                    $dataZvT[1]['count']=$ZvT_array[2];
                                    echo $flashChart->begin();
                                    $flashChart->setBgColour('d3d4d5');
                                    $flashChart->setTitle('ZvT Ratio','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
                                    $flashChart->setData($dataZvT,'{n}.count','{n}.label','ZvT_data');
                                    echo $flashChart->pie(array('start_angle'=>90,'tooltip'=>'#val# of #total#<br>#percent# of 100%'),50,'ZvT_data','ZvT_plot'); 
                                    echo $flashChart->render(208,208,'ZvT_plot');
                                ?>
                            </div>
                        </div>
                    </div> 
                    <?php
                    }
                    ?>
                    
                    
                    <?php
					if($RvT_array[0]!=0){?>
                    <div class="PostChartPaddingBox">
                        <div class="PostChartContentBox">
                            <div class="PostMainContentbox">
                            	
                                <?php
                                    $dataRvT=array(array());
                                    $dataRvT[0]['label']='Wins';
                                    $dataRvT[1]['label']='Losses';
                                    $dataRvT[0]['count']=$RvT_array[1];
                                    $dataRvT[1]['count']=$RvT_array[2];
                                    echo $flashChart->begin();
                                    $flashChart->setBgColour('d3d4d5');
                                    $flashChart->setTitle('RvT Ratio','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
                                    $flashChart->setData($dataRvT,'{n}.count','{n}.label','RvT_data');
                                    echo $flashChart->pie(array('start_angle'=>90,'tooltip'=>'#val# of #total#<br>#percent# of 100%'),50,'RvT_data','RvT_plot'); 
                                    echo $flashChart->render(208,208,'RvT_plot');
                                ?>
                            </div>
                        </div>
                    </div> 
                    <?php
                    }
                    ?>
                    
                    
                    <?php
					if($RvP_array[0]!=0){?>
                    <div class="PostChartPaddingBox">
                        <div class="PostChartContentBox">
                            <div class="PostMainContentbox">
                            	
                                <?php
                                    $dataRvP=array(array());
                                    $dataRvP[0]['label']='Wins';
                                    $dataRvP[1]['label']='Losses';
                                    $dataRvP[0]['count']=$RvP_array[1];
                                    $dataRvP[1]['count']=$RvP_array[2];
                                    echo $flashChart->begin();
                                    $flashChart->setBgColour('d3d4d5');
                                    $flashChart->setTitle('RvP Ratio','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
                                    $flashChart->setData($dataRvP,'{n}.count','{n}.label','RvP_data');
                                    echo $flashChart->pie(array('start_angle'=>90,'tooltip'=>'#val# of #total#<br>#percent# of 100%'),50,'RvP_data','RvP_plot'); 
                                    echo $flashChart->render(208,208,'RvP_plot');
                                ?>
                            </div>
                        </div>
                    </div> 
                    <?php
                    }
                    ?>
                    
                     <?php
					if($RvZ_array[0]!=0){?>
                    <div class="PostChartPaddingBox">
                        <div class="PostChartContentBox">
                            <div class="PostMainContentbox">
                            	
                                <?php
                                    $dataRvZ=array(array());
                                    $dataRvZ[0]['label']='Wins';
                                    $dataRvZ[1]['label']='Losses';
                                    $dataRvZ[0]['count']=$RvZ_array[1];
                                    $dataRvZ[1]['count']=$RvZ_array[2];
                                    echo $flashChart->begin();
                                    $flashChart->setBgColour('d3d4d5');
                                    $flashChart->setTitle('RvZ Ratio','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
                                    $flashChart->setData($dataRvZ,'{n}.count','{n}.label','RvZ_data');
                                    echo $flashChart->pie(array('start_angle'=>90,'tooltip'=>'#val# of #total#<br>#percent# of 100%'),50,'RvZ_data','RvZ_plot'); 
                                    echo $flashChart->render(208,208,'RvZ_plot');
                                ?>
                            </div>
                        </div>
                    </div> 
                    <?php
                    }
                    ?>
                    
                   <p style="clear: both;">  </p>  
					
				</div>
			</div>
		
		
		
	</div>
                            
        <div class="PostFooter">
            
            <div class="bottomaction">
            
        	</div>
       
        	<p style="clear: both;">  </p>
	</div>
</div>

</div>

<div class="users view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h3><?php echo $user['User']['username']; ?>'s Statistics </h3>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="PostBox">
<div class="ThreadTitleBox">
	
	<div class="bottomactionleft"> <?php
		echo $this->Html->link(__('User Page', true), array('action' => 'view', $user['User']['id'])); 
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
					if($total!=0){?>
                    <div class="PostChartPaddingBox">
                        <div class="PostChartContentBox">
                            <div class="PostMainContentbox">
                            	
                                <?php
                                    $dataTotal=array(array());
                                    $dataTotal[0]['label']='Wins';
                                    $dataTotal[1]['label']='Losses';
                                    $dataTotal[0]['count']=$totalWin;
                                    $dataTotal[1]['count']=$total-$totalWin;
                                    echo $flashChart->begin();
                                    $flashChart->setBgColour('d3d4d5');
                                    $flashChart->setTitle('Overall Ratio','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
                                    $flashChart->setData($dataTotal,'{n}.count','{n}.label','Total_data');
                                    echo $flashChart->pie(array('start_angle'=>90,'tooltip'=>'#val# of #total#<br>#percent# of 100%'),50,'Total_data','Total_plot'); 
                                    echo $flashChart->render(208,208,'Total_plot');
                                ?>
                            </div>
                        </div>
                    </div> 
                    <?php
                    }
                    ?>
                     <?php
					if($totalXvT!=0){?>
                    <div class="PostChartPaddingBox">    
  					<div class="PostChartContentBox">
                        <div class="PostMainContentbox">
							<?php
							 	$dataXvT=array(array());
                                $dataXvT[0]['label']='Wins';
                                $dataXvT[1]['label']='Losses';
                                $dataXvT[0]['count']=$XvT;
                                $dataXvT[1]['count']=$totalXvT-$XvT;
                            	$flashChart->setTitle('Ratio vs Terran','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
                                $flashChart->setData($dataXvT,'{n}.count','{n}.label','XvT_data');
								echo $flashChart->pie(array('start_angle'=>90,'tooltip'=>'#val# of #total#<br>#percent# of 100%'),50,'XvT_data','XvT_plot'); 
                                echo $flashChart->render(208,208,'XvT_plot');
                            ?>
                        </div>
					</div>
                   	</div>
                    <?php
                    }
                    ?>
                     <?php
					if($totalXvP!=0){?>
                    <div class="PostChartPaddingBox"> 
                    <div class="PostChartContentBox">
                        <div class="PostMainContentbox">
							<?php
							 	$dataXvP=array(array());
                                $dataXvP[0]['label']='Wins';
                                $dataXvP[1]['label']='Losses';
                                $dataXvP[0]['count']=$XvP;
                                $dataXvP[1]['count']=$totalXvP-$XvP;
                            	$flashChart->setTitle('Ratio vs Protoss','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
                                $flashChart->setData($dataXvP,'{n}.count','{n}.label','XvP_data');
								echo $flashChart->pie(array('start_angle'=>90,'tooltip'=>'#val# of #total#<br>#percent# of 100%'),50,'XvP_data','XvP_plot'); 
                                echo $flashChart->render(208,208,'XvP_plot');
                            ?>
                        </div>
					</div>
                    </div>
                   <?php
                    }
                    ?>
                    <?php
					if($totalXvZ!=0){?>
                   <div class="PostChartPaddingBox">
                   <div class="PostChartContentBox">
                        <div class="PostMainContentbox">
							<?php
							 	$dataXvZ=array(array());
                                $dataXvZ[0]['label']='Wins';
                                $dataXvZ[1]['label']='Losses';
                                $dataXvZ[0]['count']=$XvZ;
                                $dataXvZ[1]['count']=$totalXvZ-$XvZ;
                            	$flashChart->setTitle('Ratio vs Zerg','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
                                $flashChart->setData($dataXvZ,'{n}.count','{n}.label','XvZ_data');
								echo $flashChart->pie(array('start_angle'=>90,'tooltip'=>'#val# of #total#<br>#percent# of 100%'),50,'XvZ_data','XvZ_plot'); 
                                echo $flashChart->render(208,208,'XvZ_plot');
                            ?>
                        </div>
					</div>
                    </div>
                     <?php
                    }
                    ?> 
                    <?php
					if($totalXvR!=0){?>
                    <div class="PostChartPaddingBox">
                    <div class="PostChartContentBox">
                        <div class="PostMainContentbox">
							<?php
							 	$dataXvR=array(array());
                                $dataXvR[0]['label']='Wins';
                                $dataXvR[1]['label']='Losses';
                                $dataXvR[0]['count']=$XvR;
                                $dataXvR[1]['count']=$totalXvR-$XvR;
                            	$flashChart->setTitle('Ratio vs Random','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
                                $flashChart->setData($dataXvR,'{n}.count','{n}.label','XvR_data');
								echo $flashChart->pie(array('start_angle'=>90,'tooltip'=>'#val# of #total#<br>#percent# of 100%'),50,'XvR_data','XvR_plot'); 
                                echo $flashChart->render(208,208,'XvR_plot');
                            ?>
                        </div>
					</div>
                    </div>
                    <?php
                    }
                    ?> 
                    
                    
                    <?php /*echo $winsVsProtossAs1 */?>
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
<?php
if(count($totalWin_array)!=0){?>

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h3><?php echo $user['User']['username']; ?>'s History </h3>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>


<div class="PostBox"> 
	<div class="PostContent">
		
			<div class="PostContentBox">
				<div class="PostMainContentbox" margin-left: auto;  margin-right: auto>
					
                    <div class="PostChartPaddingBox">
                    <div class="PostChartContentBox">
                        <div class="PostMainContentbox">
							<?php
								
									echo $flashChart->begin();
									$flashChart->setTitle('Overall History','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
									$flashChart->setData($totalWin_array,'{n}',false,'Total','Overall_Hist');
									/*$flashChart->axis('y',array('range' => array(0, count($totalWin_array), 1),'labels' => $tournament_names_array));*/
									//$flashChart->axis('y',array('range' => array(0, 1, 0.1)));
									//$flashChart->axis('x',array('labels'=>$tournament_names_array),array('vertical'=>true));
									$flashChart->axis('x',$tournament_names_array, 0, array(0,count($tournament_names_array)-1,1));
									$flashChart->axis('y',array(), 0, array(0,1,0.2));
									$flashChart->setLegend('x','Tournament','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
									$flashChart->setLegend('y','Winratio','{color:#333333;font-size:16px;padding:0 0 0px 0px;}' );
									echo $flashChart->chart('line',array('colour'=>'#3e76d1'),'Total','Overall_Hist','versus All', 'mid-slide', 1, 0, '#x_label#: #val#;');
									echo $flashChart->render(685,350,'Overall_Hist');
								
                            ?>
                     	</div>
					</div>
                    </div>
                    
                    
                    <div class="PostChartPaddingBox">
                    <div class="PostChartContentBox">
                        <div class="PostMainContentbox">
							<?php
								
                                echo $flashChart->begin();
								$flashChart->setTitle('Matchup History','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
								if(count($XvT_array)!=0){
                                	$flashChart->setData($XvT_array,'{n}',false,'XvT','Matchup_Hist');
								}
								if(count($XvP_array)!=0){
                                	$flashChart->setData($XvP_array,'{n}',false,'XvP','Matchup_Hist');
								}
								if(count($XvZ_array)!=0){
                               	 	$flashChart->setData($XvZ_array,'{n}',false,'XvZ','Matchup_Hist');
								}
								if(count($XvR_array)!=0){
                               		$flashChart->setData($XvR_array,'{n}',false,'XvR','Matchup_Hist');
								}
                                /*$flashChart->axis('y',array('range' => array(0, count($totalWin_array), 1),'labels' => $tournament_names_array));*/
								/*$flashChart->axis('y',array('range' => array(0, 1, 0.1)));
                                $flashChart->axis('x',array('labels'=>$tournament_names_array));*/
								$flashChart->axis('x',$tournament_names_array, 0, array(0,count($tournament_names_array)-1,1));
								$flashChart->axis('y',array(), 0, array(0,1,0.2));
                                $flashChart->setLegend('x','Tournament','{color:#333333;font-size:16px;padding:0 0 0px 0px;}');
                                $flashChart->setLegend('y','Winratio','{color:#333333;font-size:16px;padding:0 0 0px 0px;}' );
								if(count($XvT_array)!=0){
                                	echo $flashChart->chart('line',array('colour'=>'#bc1b23'),'XvT','Matchup_Hist','versus Terran', 'mid-slide', 1, 0, '#x_label#: #val#;');
								}
								if(count($XvP_array)!=0){
                                	echo $flashChart->chart('line',array('colour'=>'#ca970d'),'XvP','Matchup_Hist','versus Protoss', 'mid-slide', 1, 0, '#x_label#: #val#;');
								}
								if(count($XvZ_array)!=0){
                                	echo $flashChart->chart('line',array('colour'=>'#7a278f'),'XvZ','Matchup_Hist','versus Zerg', 'mid-slide', 1, 0, '#x_label#: #val#;');
								}
								if(count($XvR_array)!=0){
                                	echo $flashChart->chart('line',array('colour'=>'#3498e2'),'XvR','Matchup_Hist','versus Random', 'mid-slide', 1, 0, '#x_label#: #val#;');
								}
                                echo $flashChart->render(685,350,'Matchup_Hist');
                            ?>
                     	</div>
					</div>
                    </div>
                 	
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

<?php
                    }
                    ?>

</div>


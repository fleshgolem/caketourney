<div class="users view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h3><?php echo $user['User']['username']; ?>'s Statistics </h3>
	</div> 
	<div class="bottomaction"> <?php
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


<div class="PostBox"> 
	<div class="PostContent">
		
			<div class="PostContentBox">
				<div class="PostMainContentbox" margin-left: auto;  margin-right: auto>
					
                    <div class="PostChartPaddingBox">
                    <div class="PostChartContentBox">
                        <div class="PostMainContentbox">
							<?php
								$test = array();
								for ($i = 0; $i < count($totalWin_array); $i++) {
									$test[$i]['label']=$tournament_names_array[$i];
									$test[$i]['count']=$XvT_array[$i];
									echo $tournament_names_array[$i];
								
								}
                                echo $flashChart->begin();
                                $flashChart->setTitle('Overall History');
                                $flashChart->setData($totalWin_array,'{n}',false,'Total','Overall_Hist');
                                /*$flashChart->axis('y',array('range' => array(0, count($totalWin_array), 1),'labels' => $tournament_names_array));*/
								$flashChart->axis('y',array('range' => array(0, 1, 0.1)));
                                $flashChart->axis('x',array('labels'=>$tournament_names_array),array('vertical'=>true));
                                $flashChart->setLegend('x','Tournament');
                                $flashChart->setLegend('y','Winratio' );
                                echo $flashChart->chart('line',array('colour'=>'#3e76d1'),'Total','Overall_Hist','versus All', 'mid-slide', 1, 0, '#x_label#: #val#;');
                                echo $flashChart->render(685,400,'Overall_Hist');
                            ?>
                     	</div>
					</div>
                    </div>
                    
                    
                    <div class="PostChartPaddingBox">
                    <div class="PostChartContentBox">
                        <div class="PostMainContentbox">
							<?php
								
                                echo $flashChart->begin();
                                $flashChart->setTitle('Matchup History');
                                $flashChart->setData($XvT_array,'{n}',false,'XvT','Matchup_Hist');
                                $flashChart->setData($XvP_array,'{n}',false,'XvP','Matchup_Hist');
                                $flashChart->setData($XvZ_array,'{n}',false,'XvZ','Matchup_Hist');
                                $flashChart->setData($XvR_array,'{n}',false,'XvR','Matchup_Hist');
                                /*$flashChart->axis('y',array('range' => array(0, count($totalWin_array), 1),'labels' => $tournament_names_array));*/
								/*$flashChart->axis('y',array('range' => array(0, 1, 0.1)));
                                $flashChart->axis('x',array('labels'=>$tournament_names_array));*/
								$flashChart->axis('x',$tournament_names_array);
                                $flashChart->setLegend('x','Tournament');
                                $flashChart->setLegend('y','Winratio' );
                                echo $flashChart->chart('line',array('colour'=>'#bc1b23'),'XvT','Matchup_Hist','versus Terran', 'mid-slide', 1, 0, '#x_label#: #val#;');
                                echo $flashChart->chart('line',array('colour'=>'#f4d153'),'XvP','Matchup_Hist','versus Protoss', 'mid-slide', 1, 0, '#x_label#: #val#;');
                                echo $flashChart->chart('line',array('colour'=>'#7a278f'),'XvZ','Matchup_Hist','versus Zerg', 'mid-slide', 1, 0, '#x_label#: #val#;');
                                echo $flashChart->chart('line',array('colour'=>'#3498e2'),'XvR','Matchup_Hist','versus Random', 'mid-slide', 1, 0, '#x_label#: #val#;');
                                echo $flashChart->render(685,400,'Matchup_Hist');
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


<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h3><?php echo $user['User']['username']; ?>'s Recent Matches </h3>
	</div> 

	<p style="clear: both;">  </p>  
</div>
</div>


<div class="PostBox"> 
	<div class="PostContent">
		
			<div class="PostContentBox">
				
					<table cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Player 1</th>
                        <th>Player 2</th>
                        <th>Score</th>
                        <th>Tournament</th>
                    </tr>
                    
                    <?php foreach ($matches as $match){?>
                    
                    <tr>
                        <td>
                        <?php
                        if ($match['Player1']!=null)
                            {
                                echo $this->Race->small_img($match['Player1']['race']);
								echo $this->Html->link(($match['Player1']['username']),array('controller' => 'users', 'action' => 'view', $match['Player1']['id']));
                            }?>
                        </td>
                        <td>
                        <?php
                        if ($match['Player2']!=null)
                            {
                                echo $this->Race->small_img($match['Player2']['race']);
                                echo $this->Html->link(($match['Player2']['username']),array('controller' => 'users', 'action' => 'view', $match['Player2']['id']));
                            }?>
                        </td>
                        <td>
                        	
                        	<?php
								$scorelink = '';
								$scorelink .=($match['Match']['player1_score']);
								$scorelink .= ' : ' ;
								$scorelink .=($match['Match']['player2_score']);
								
							 echo $this->Html->link(($scorelink),array('controller' => 'matches', 'action' => 'view',$match['Match']['id']))?>
                           
                        </td>
                        <td>
                           <?php echo $this->Html->link(($match['Round']['Tournament']['name']),array('controller' => 'tournaments', 'action' => 'view',$match['Round']['Tournament']['id']))?>
                        </td>
                    </tr>
                    <?}?>
                </table>
				
			</div>
		
		
		
	</div>
                            
        <div class="PostFooter">
            
            <div class="bottomaction">
            
        </div>
       
        <p style="clear: both;">  </p>
	</div>
</div>


</div>


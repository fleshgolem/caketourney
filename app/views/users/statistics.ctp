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
					<?php 
					$XvT = 0;
					$XvP = 0;
					$XvZ = 0;
					$XvR = 0;
					$totalXvT = 0;
					$totalXvP = 0;
					$totalXvZ = 0;
					$totalXvR = 0;
					$total = 0;
					$totalWin = 0;
					
					foreach ($matches as $match){?>
                    
                        <?php
                        if ($match['Player2']['username']!=null && $match['Player1']['username']==$user['User']['username'])
                            {
								$total+=1;
								if($match['Player2']['race']==0){
									$totalXvT+=1;
									if($match['Match']['player1_score']>$match['Match']['player2_score']){
										$XvT+=1;
									}
								}
								if($match['Player2']['race']==1){
									$totalXvP+=1;
									if($match['Match']['player1_score']>$match['Match']['player2_score']){
										$XvP+=1;
									}
								}
								if($match['Player2']['race']==2){
									$totalXvZ+=1;
									if($match['Match']['player1_score']>$match['Match']['player2_score']){
										$XvZ+=1;
									}
								}
								if($match['Player2']['race']==3){
									$totalXvR+=1;
									if($match['Match']['player1_score']>$match['Match']['player2_score']){
										$XvR+=1;
									}
								}
								if($match['Match']['player1_score']>$match['Match']['player2_score']){
									$totalWin+=1;
								}
                            }?>
                       
                        <?php
                        if ($match['Player1']['username']!=null && $match['Player2']['username']==$user['User']['username'])
                            {
                                $total+=1;
								if($match['Player1']['race']==0){
									$totalXvT+=1;
									if($match['Match']['player2_score']>$match['Match']['player1_score']){
										$XvT+=1;
									}
								}
								if($match['Player1']['race']==1){
									$totalXvP+=1;
									if($match['Match']['player2_score']>$match['Match']['player1_score']){
										$XvP+=1;
									}
								}
								if($match['Player1']['race']==2){
									$totalXvZ+=1;
									if($match['Match']['player2_score']>$match['Match']['player1_score']){
										$XvZ+=1;
									}
								}
								if($match['Player1']['race']==3){
									$totalXvR+=1;
									if($match['Match']['player2_score']>$match['Match']['player1_score']){
										$XvR+=1;
									}
								}
								if($match['Match']['player2_score']>$match['Match']['player1_score']){
									$totalWin+=1;
								}
                            }
							?>
                      
                        	
                        	
                    <? }
					
					?>
                    
                    
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


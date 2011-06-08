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
                    <?php echo 'total win: '; echo $totalWin; echo ' out of: '; echo $total; ?> <br>
                    <?php echo 'total win vs T: '; echo $XvT; echo ' out of: '; echo $totalXvT; ?> <br>
                    <?php echo 'total win vs P: '; echo $XvP; echo ' out of: '; echo $totalXvP; ?> <br>
                    <?php echo 'total win vs Z: '; echo $XvZ; echo ' out of: '; echo $totalXvZ; ?> <br>
                    <?php echo 'total win vs R: '; echo $XvR; echo ' out of: '; echo $totalXvR; ?> <br>
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
								echo $flashChart->pie(array(),'Total_data','Total_plot'); 
                                echo $flashChart->render(200,200,'Total_plot');
                            ?>
                    	</div>
					</div>
                          
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
								echo $flashChart->pie(array(),'XvT_data','XvT_plot'); 
                                echo $flashChart->render(200,200,'XvT_plot');
                            ?>
                        </div>
					</div>
                   
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
								echo $flashChart->pie(array(),'XvP_data','XvP_plot'); 
                                echo $flashChart->render(200,200,'XvP_plot');
                            ?>
                        </div>
					</div>
                   
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
								echo $flashChart->pie(array(),'XvZ_data','XvZ_plot'); 
                                echo $flashChart->render(200,200,'XvZ_plot');
                            ?>
                        </div>
					</div>
                    
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
								echo $flashChart->pie(array(),'XvR_data','XvR_plot'); 
                                echo $flashChart->render(200,200,'XvR_plot');
                            ?>
                        </div>
					</div>
                   
					
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


<?php
use yii\widgets\Pjax;
use kartik\tabs\TabsX;
?>
            <div class="panel panel-default">
                    	 <div class="panel-heading"><h3 >งาน</h3></div>
                          <div class="panel-body ">
                                    <?php Pjax::begin(); ?> 
                                   
                                       		 <?php 
                                                       
                                                          echo TabsX::widget([
                                                              'position' => TabsX::POS_ABOVE,
                                                              'align' => TabsX::ALIGN_LEFT,
                                                              'items' => [
                                                                  [
                                                                      'label' => 'ตารางงาน',
                                                                      'content' =>  \talma\widgets\FullCalendar::widget([
                                                                          'googleCalendar' => true,  // If the plugin displays a Google Calendar. Default false
                                                                          'loading' => 'Carregando...', // Text for loading alert. Default 'Loading...'
                                                                          'config' => [
                                                                              // put your options and callbacks here
                                                                              // see http://arshaw.com/fullcalendar/docs/
                                                                              'lang' => 'th', // optional, if empty get app language
                                                                              
                                                                          ],
                                                                            ]) ,
                                                                      'active' => true
                                                                  ],
                                                                  [
                                                                      'label' => 'Joins',
                                                                      'content' => 'การร่วมงาน',
                                                                      'headerOptions' => ['style'=>'font-weight:bold'],
                                                                      'options' => ['id' => 'myveryownID'],
                                                                  ],    
                                                            
                                                  ],] );?>
                                       
                                    <?php Pjax::end(); ?>
                        </div>
                  
            </div>
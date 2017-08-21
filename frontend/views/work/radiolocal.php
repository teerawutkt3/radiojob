<?php
use yii\widgets\Pjax;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use common\models\Work;


  ?>
  
  <?php

                      //Testing  event calendar
                      $events = array();
                   /*    $Event = new \yii2fullcalendar\models\Event();
                      $Event->id = 1;
                      $Event->title = 'โรงพยาบาลพะเยา';
                      $Event->editable=TRUE;
                      $Event->start = date('Y-m-d\TH:i:s\Z');
                   
                      $events[] = $Event; */
                      
                      $Event = new \yii2fullcalendar\models\Event();
                      $Event->id = 2;
                      $Event->title = 'โรงพยาบาลพะเยา';
                      $Event->start = date('Y-m-d\TH:i:s\Z',strtotime('monday 6am'));
                      $Event->end = date('Y-m-d\TH:i:s\Z',strtotime('monday 10am'));
                      $events[] = $Event;
                      //Testing  event calendar
                 
                                                                      
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
                                                                      'content' => /*  \talma\widgets\FullCalendar::widget([
                                                                          'googleCalendar' => true,  // If the plugin displays a Google Calendar. Default false
                                                                          'loading' => 'Carregando...', // Text for loading alert. Default 'Loading...'
                                                                         // 'type' => 'week',
                                                                          'config' => [
                                                                              // put your options and callbacks here
                                                                              // see http://arshaw.com/fullcalendar/docs/
                                                                              'lang' => 'th', // optional, if empty get app language
                                                                              
                                                                          ],
                                                                            ]) , */
                                                                      
                                                                      //calendatr  work------------------------------------------------------
                                                                   
            
                                                                           \yii2fullcalendar\yii2fullcalendar::widget(array(
                                                                              'events'=> $events,
                                                                               'options' => [
                                                                                   'lang' => 'th',
                                                                                   //... more options to be defined here!
                                                                               ],
                                                                      //         'ajaxEvents' => Url::to(['/timetrack/default/jsoncalendar'])
                                                                          )),
                                                                      
                                                                      
                                                                      
                                                                       /*  yii2fullcalendar\yii2fullcalendar::widget([
                                                                            'events'=> $events,
                                                                          'options' => [
                                                                              'lang' => 'th',
                                                                              //... more options to be defined here!
                                                                          ],
                                                                          'ajaxEvents' => Url::to(['/timetrack/default/jsoncalendar'])
                                                                      ]),  */
                                                                  //    calendatr  work------------------------------------------------------
                                                                     
                                                                      'active' => true
                                                                  ],
                                                                  [
                                                                      'label' => 'การติดต่อ',
                                                                      'content' => 'การติดต่อ', 
                                                                      'headerOptions' => ['style'=>'font-weight:bold'],
                                                                     // 'options' => ['id' => 'myveryownID'],
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
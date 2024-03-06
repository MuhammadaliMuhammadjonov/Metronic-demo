<?php

use app\modules\manuals\models\References;
use app\modules\warehouse\models\ItemBalance;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\bootstrap\Collapse;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\data\SqlDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\warehouse\models\ItemBalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Item Balances');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="card card-custom">
        <br><br>
        <div class="card-title">
            <?php
            $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => [
                    'data-pjax' => 1
                ],

            ]); ?>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <p style="color: black; font-weight: bold;font-size:15px"><?=Yii::t('app', 'Search window');?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php
                            echo "<label for='reg_date' class='reg_date'><span class='reg-date-label'>" . Yii::t('app', 'Regstration date') . "</span></label>";
                            echo DateTimePicker::widget([
                                 'name' =>'reg_date',
                                'attribute' => 'datetime_2',
                                'options' => [
                                        'placeholder' => 'Enter event time ...',
                                    'required' => true,
                                    'readonly' =>true,
                                ],
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format'=>'yyyy-m-dd HH:i:ss',
                                    'todayBtn' => true
                                ]
                            ]); ?>
                            <br>
                            <?php
                            echo "<label for='department_area_id' class='department_area_id'><span class='department_area_id'>" . Yii::t('app', 'Regstration date') . "</span></label>";
                            echo Select2::widget([
                                'name' => 'department_area_id',
                                'options' => [
                                    'placeholder' => 'Select states ...',
                                    'class' => 'form-control',
                                    'id' => 'department_area_id'
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group"
                        <br>
                        <?php
                        echo "<label for='department_area_id' class='department_area_id'><span class='department_area_id'>" . Yii::t('app', 'Department') . "</span></label>";
                        echo Select2::widget([
                            'name' => 'department_id',
                            'size' => Select2::SMALL,
                            'data' => ItemBalance::getDepartmentList(),
                            'options' => [
                                'placeholder' => 'Select states ...',
                                'class' => 'form-control',
                                'id' => 'department_id'
                            ]
                        ]);
                        ?>
                        <br>
                        <?php
                        echo "<label for='item_id' class='item_id'><span class='item_id'>" . Yii::t('app', 'Item') . "</span></label>";
                        echo Select2::widget([
                            'name' => 'item_id',
                            'size' => Select2::SMALL,
                            'data' => ItemBalance::getItemList(),
                            'options' => [
                                'multiple' => true,
                                'placeholder' => 'Select states ...',
                                'class' => 'form-control',
                                'id' => 'item_id'
                            ]
                        ]);
                        ?> <br>
                        <p class="text-right">
                            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn  btn-outline-primary search_btn']) ?>
                            <?= Html::a(Yii::t('app', 'Cancel search'), ['item-balance/index'], [
                                'class' => 'btn btn-sm btn-outline-danger',
                            ]); ?>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <div class="card-body">
        <div class="report-ip-title">
            <h3 class="text-center" style="padding-bottom: 25px;">
                <span class="department"></span>
            </h3>
        </div>

        <div class="div container">
            <div class="row">
                <div class="col-sm-12 text-right">
                    <p>
                    <div class="checkbox-single">
                        <label class="checkbox">
                            <input type="checkbox" name="stock_limit"
                                   class="checkbox_stock" value="1"><?= Yii::t('app', 'Stock limit'); ?>
                            <span></span>
                        </label>
                    </div>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">

                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark"
                               style="background-color: #1E94D0; color: white;border: 1px solid black ">
                        <tr>
                            <td><p>№</p></td>
                            <td><p><?= Yii::t('app', 'Item') ?></p></td>
                            <td><p><?= Yii::t('app', 'Inventory') ?></p></td>
                            <td><p><?= Yii::t('app', 'Department area') ?></p></td>
                            <td><p><?= Yii::t('app', 'Price') ?></td>
                            <td><p><?= Yii::t('app', 'Price currency') ?></p></td>
                        </tr>
                        </thead>
                        <tbody style="color: #101010" class="new_table">
                            <tr>
                                <td></td>
                                <td colspan="4" align="center">
                                   <p style="color: red" class="not_info">
                                    <?=Yii::t('app', 'Not  found information');?>
                                   </p>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot class="thead-dark">
                        <tr>
                            <td colspan="4"><p
                                        style="font-weight: bold; line-height:normal"><?= Yii::t('app', 'Jami:'); ?></p>
                            </td>
                            <td>
                                <p style="font-weight: bold; line-height:normal" class="price"></p></td>
                            <td>
                                <p style="font-weight: bold; line-height:normal" class="currency"></p></td>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>

    </div>
    </div>
<?php
$header = Yii::t('app', ' information');
$not = Yii::t('app', ' The data is incomplete');
$info = Yii::t('app', 'List of information in the ');
$info1 = Yii::t('app', ' department');
$main = Yii::t('app', 'You have not information');
$url = \yii\helpers\Url::to(['item-balance/department-area']);
$url1 = \yii\helpers\Url::to(['item-balance/tbody']);
$js = <<<JS
     
     $('body').delegate('#department_id','change' , function() {
             let id= $(this).val();
             
             $.ajax({
                    url:'$url',
                    data:{q:id},
                    type:'GET',
                                success: function(response){ 
                                    if(response.status){                             
                                        $('#department_area_id').html('');
                                               let option = response.data.map(function(item,index){
                                                return ('<option value=\"'+item.id+'\">'+item.name+'</option>');
                                                });
                                        let newOption = option.join('');
                                        $('#department_area_id').html('<option>'+" "+'</option>'+newOption);
                                    }else{
                                        $('#department_area_id').html().empty(); 
                                        $('#department_area_id').html().val('');  
                                         
                                    }              
                                }
             });
        });
JS;
$this->registerJS($js);


$js = <<<JS
    $(document).ready(function() {
        
         $('.search_btn').on('click', function(e) {
         e.preventDefault();
                 let  reg  = $('#w1').val();
                 let  area = $('#department_area_id').val();
                 let  dep = $('#department_id').val();
                 let  item = $('#item_id').val();
                 let tbody = "";
                 if (reg !='' && area != '' && dep != ''){
                      $('.reg-date-label').css({'color':'black'}); 
                      $('.department_area_id').css({'color':'black'});
                      $('.department_id').css({'color':'red'});
                     $.ajax({
                    url:'$url1',
                    data:{reg:reg,area:area,dep:dep,item:item},
                    type:'GET',
                        success: function(response){ //begin response                         
                          if (response.count > 0){
                                           if(response.status){     //begin status
                                                let nomer = 1;
                                                            let sum_price = 0 ;
                                                            let sum_currency = 0 ;
                                                             response.data.map(function(item) {
                                                                         department = item.dep_name;
                                                                         if (item.inventory <= item.stock_limit){
                                                                             rang = "#EB3941";
                                                                             color ="white";
                                                                         }else{
                                                                             rang = "white";
                                                                             color= "black";
                                                                            
                                                                         }
                                                                         sum_currency +=item.price_currency*1;
                                                                         sum_price +=item.price*1;
                                                                         tbody +=
                                                                         '<tr style = "background-color:'+rang+'; color:'+color+'">' +
                                                                                        '<td>'+(nomer++)+'</td>' +
                                                                                        '<td>'+item.item+'</td>' +
                                                                                        '<td>'+item.inventory+'</td>' + 
                                                                                        '<td>'+item.department_area+'</td>' +
                                                                                        '<td>'+item.price+'</td>' +
                                                                                        '<td>'+item.price_currency+'</td>' +
                                                                                         
                                                                         '</tr>'   
                                                             });                                                     
                                                                          $('.department').text('{$info}'+department+'{$info1}');
                                                                          $('.price').text(sum_price.toFixed(4));
                                                                          $('.currency').text(sum_currency.toFixed(4));
                                                                          
                                        }  //status end
                          }else{
                              tbody =
                                                 '<tr>' +
                                                                '<td>'+' '+'</td>' +
                                                                 '<td colspan='+4+' align="center">'+'<p style="color=red">{$main}</p>'+'</td>'+
                                                                '<td>'+' '+'</td>' +
                                                                 
                                                 '</tr>' 
                                                 $('.price').text('');
                                                 $('.currency').text('');
                          }
                          $('.new_table').html(tbody);
                          
                        } //response end
                               
                     });
                 } else {
                     if (reg ==''){
                         $('.reg-date-label').css({'color':'red'}); 
                     }
                     if (dep ==''){
                         $('.department_area_id').css({'color':'red'});
                     }
                     if (area ==''){
                         $('.department_id').css({'color':'red'});
                     }
                     alert('{$not}');
                 }
             
      });
    });
     
JS;
$this->registerJS($js);
$js1 = <<<JS
    $(document).ready(function() {
        
         $('.checkbox_stock').on('click', function(e) {
             let chek = $(this).val();
             if ($(this).val() == '1'){
                 let  reg  = $('#w1').val();
                 let  area = $('#department_area_id').val();
                 let  dep = $('#department_id').val();
                 let  item = $('#item_id').val();
                 let tbody = "";
                 if (reg !='' && area != '' && dep != ''){
                      $('.reg-date-label').css({'color':'black'}); 
                      $('.department_area_id').css({'color':'black'});
                      $('.department_id').css({'color':'red'});
                     $.ajax({
                    url:'$url1',
                    data:{reg:reg,area:area,dep:dep,item:item},
                    type:'GET',
                        success: function(response){ //begin response                         
                          if (response.count > 0){
                                           if(response.status){     //begin status
                                                let nomer = 1;
                                                            let sum_price = 0 ;
                                                            let sum_currency = 0 ;
                                                             response.data.map(function(item) {
                                                                         department = item.dep_name;
                                                                         if (item.inventory <= item.stock_limit){
                                                                             rang = "#EB3941";
                                                                             color ="white";
                                                                             sum_currency +=item.price_currency*1;
                                                                             sum_price +=item.price*1;
                                                                             tbody +=
                                                                             '<tr style = "background-color:'+rang+'; color:'+color+'">' +
                                                                                            '<td>'+(nomer++)+'</td>' +
                                                                                            '<td>'+item.item+'</td>' +
                                                                                            '<td>'+item.inventory+'</td>' + 
                                                                                            '<td>'+item.department_area+'</td>' +
                                                                                            '<td>'+item.price+'</td>' +
                                                                                            '<td>'+item.price_currency+'</td>' +
                                                                                             
                                                                             '</tr>'   
                                                                         } else {
                                                                              tbody =
                                                                                     '<tr>' +
                                                                                                    '<td>'+' '+'</td>' +
                                                                                                     '<td colspan='+4+' align="center">'+'<p style="color:red">{$main}</p>'+'</td>'+
                                                                                                    '<td>'+' '+'</td>' +
                                                                                                     
                                                                                     '</tr>' 
                                                                                     $('.price').text('');
                                                                                     $('.currency').text('');
                                                                         }
                                                                         
                                                             });                                                     
                                                                          $('.department').text('{$info}'+department+'{$info1}');
                                                                          $('.price').text(sum_price.toFixed(4));
                                                                          $('.currency').text(sum_currency.toFixed(4));
                                                                          
                                        }  //status end
                          }else{
                              tbody =
                                                 '<tr>' +
                                                                '<td>'+' '+'</td>' +
                                                                 '<td colspan='+4+' align="center">'+'<p style="color=red">{$main}</p>'+'</td>'+
                                                                '<td>'+' '+'</td>' +
                                                                 
                                                 '</tr>' 
                                                 $('.price').text('');
                                                 $('.currency').text('');
                          }
                          $('.new_table').html(tbody);
                          
                        } //response end
                               
                     });
                 } else{
                     if (reg ==''){
                         $('.reg-date-label').css({'color':'red'}); 
                     }
                     if (dep ==''){
                         $('.department_area_id').css({'color':'red'});
                     }
                     if (area ==''){
                         $('.department_id').css({'color':'red'});
                     }
                     alert('{$not}');
                 }
                $(this).val('0'); 
             } 
             else {
                 
                 let  reg  = $('#w1').val();
                 let  area = $('#department_area_id').val();
                 let  dep = $('#department_id').val();
                 let  item = $('#item_id').val();
                 let tbody = "";
                 if (reg !='' && area != '' && dep != ''){
                      $('.reg-date-label').css({'color':'black'}); 
                      $('.department_area_id').css({'color':'black'});
                      $('.department_id').css({'color':'red'});
                     $.ajax({
                    url:'$url1',
                    data:{reg:reg,area:area,dep:dep,item:item},
                    type:'GET',
                        success: function(response){ //begin response                         
                          if (response.count > 0){
                                           if(response.status){     //begin status
                                                let nomer = 1;
                                                            let sum_price = 0 ;
                                                            let sum_currency = 0 ;
                                                             response.data.map(function(item) {
                                                                         department = item.dep_name;
                                                                         if (item.inventory<item.stock_limit){
                                                                             rang = "#EB3941";
                                                                             color ="white";
                                                                         }else{
                                                                             rang = "white";
                                                                             color= "black";
                                                                            
                                                                         }
                                                                         sum_currency +=item.price_currency*1;
                                                                         sum_price +=item.price*1;
                                                                         tbody +=
                                                                         '<tr style = "background-color:'+rang+'; color:'+color+'">' +
                                                                                        '<td>'+(nomer++)+'</td>' +
                                                                                        '<td>'+item.item+'</td>' +
                                                                                        '<td>'+item.inventory+'</td>' + 
                                                                                        '<td>'+item.department_area+'</td>' +
                                                                                        '<td>'+item.price+'</td>' +
                                                                                        '<td>'+item.price_currency+'</td>' +
                                                                                         
                                                                         '</tr>'   
                                                             });                                                     
                                                                          $('.department').text('{$info}'+department+'{$info1}');
                                                                          $('.price').text(sum_price.toFixed(4));
                                                                          $('.currency').text(sum_currency.toFixed(4));
                                                                          
                                        }  //status end
                          }else{
                              tbody =
                                                 '<tr>' +
                                                                '<td>'+' '+'</td>' +
                                                                 '<td colspan='+4+' align="center">'+'<p style="color=red">{$main}</p>'+'</td>'+
                                                                '<td>'+' '+'</td>' +
                                                                 
                                                 '</tr>' 
                                                 $('.price').text('');
                                                 $('.currency').text('');
                          }
                          $('.new_table').html(tbody);
                          
                        } //response end
                               
                     });
                 } else{
                     if (reg ==''){
                         $('.reg-date-label').css({'color':'red'}); 
                     }
                     if (dep ==''){
                         $('.department_area_id').css({'color':'red'});
                     }
                     if (area ==''){
                         $('.department_id').css({'color':'red'});
                     }
                     alert('{$not}');
                 }
                 $(this).val('1');
             }
             
                 
             
      });
    });
     
JS;


$this->registerJS($js1);
<?php

use backend\models\AccountantReport;
use backend\models\TicketTransaction;
use yii\helpers\Html;
//ini_set('memory_limit','2048M');
?>

<div id="invoice-sec">
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12 text-center">
                <?php
                echo Html::img('images/logo-zanzibar.jpg',
                    ['width' => '70px', 'height' => '70px', 'class' => 'img-square']);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h6 class="page-header text-center">
                    SERIKALI YA MAPINDUZI ZANZIBAR<br/>
                   MAKUSANYO YA MAEGESHO YA MAGARI<br/>
                </h6>
            </div>
        </div>
        <?php
        $dateObj   = DateTime::createFromFormat('m', date('m'));
        $monthName = $dateObj->format('F'); // March
        if($tickets != null) {
            foreach ($tickets as $mp) {
                ?>
                <p class="text-center"> Makusanyo yamaegesho ya magari kwa mwezi <?= $monthName ?>
                    , <?= date('Y'); ?></p>

                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">

                        <address>
                            MKOA: <?= $mp->region0->name; ?><br/>
                            BANK PAY SLIP: <?= $mp->car_no; ?><br/>
                        </address>
                    </div>
                    <div class="break"></div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">

                    </div>
                    <!-- /.col -->
                    <!-- /.col -->
                </div>
                <div class="row" style="page-break-after: always">
                    <div class="col-sm-12">
                        <?php
                        $id=$mp->id;
                        $date = AccountantReport::find()->select(['date(collected_date)'])->where(['id' =>$id])->one();
                        $items = TicketTransaction::find()->where(['date(create_at)'=>$date])->all();
                       // $items = \backend\models\TicketTransaction::find()->where(['date(create_at)'=>'2019-05-28'])->all();
                        if($items != null){
                            ?>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>GARI NAMBA</th>
                                    <th>ENEO</th>
                                    <th>KIASI</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $formatter = \Yii::$app->formatter;
                                $i = 1;
                                $total = 0.00;
                                foreach ($items as $wz) {
                                    echo '<tr>
                            <td>'.$i.'</td>
                            <td>'.$wz->car_no. '</td>';
                                    if($wz->id != null){

                                        echo '<td>'.$wz->workArea->name.'</td>';
                                    }else{
                                        echo '<td>&nbsp;&nbsp;</td>';
                                    }
                                    ?>
                                    <?php
                                    echo '<td>'.$wz->amount.'</td>
                            <td></td>
                            </tr>';
                                    $i++;
                                    $total =$total + $wz->amount;

                                }


                                ?>
                                <tr>
                                    <td colspan="3" class="text-right">
                                        <strong>Jumla</strong>
                                    </td>
                                    <td ><strong><?= $formatter->asDecimal($total,2);?></strong></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- /.row -->
                <?php
            }

        }

        ?>

        <!-- /.row -->

    </section>
</div>
<?php

use backend\models\AccountantReport;
use backend\models\TicketTransaction;
use yii\helpers\Html;
ini_set('memory_limit','2048M');
?>

<div id="invoice-sec">
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12 text-center">
                <?php
                echo Html::img('images/smz.png',
                    ['width' => '140px', 'height' => '140px', 'class' => 'img-square']);
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
            foreach ($tickets as $mp  ) {

                ?>
                <p class="text-center"> Makusanyo yamaegesho ya magari kwa mwezi <?= $monthName ?>
                    , <?= date('Y'); ?></p>

                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">

                        <address>
                            <?php $date = AccountantReport::find()->select(['receipt_no'])->where(['report_no' =>$mp->report_no])->one(); ?>
                            <strong> MKOA: </strong> <?= $mp->region0->name; ?><br/>
                            <strong>  BANK PAY SLIP:  </strong> <?= $date['receipt_no']; ?><br/>
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
                        $items = TicketTransaction::find()->where(['report_no'=>$mp->report_no])->all();
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
                            <p style="clear: both;page-break-after: always">
                            <table>
                                <tr>
                                    <th>Items</th>
                                    <th style="padding-left: 100px">Prepared By</th>
                                    <th style="padding-left: 100px">Authorized by</th>
                                    <th style="padding-left: 100px">Approved by </th>
                                </tr>
                                <tr>
                                    <td style="padding-top: 20px">Jina:</td>
                                    <td style="padding-left: 100px">..................................</td>
                                    <td style="padding-left: 100px">..................................</td>
                                    <td style="padding-left: 100px">..................................</td>

                                </tr>
                                <tr>
                                    <td style="padding-top: 20px">Cheo:</td>
                                    <td style="padding-left: 100px">..................................</td>
                                    <td style="padding-left: 100px">.................................</td>
                                    <td style="padding-left: 100px">..................................</td>

                                </tr>
                                <tr>
                                    <td style="padding-top: 20px">Sahihi:</td>
                                    <td style="padding-left: 100px">..................................</td>
                                    <td style="padding-left: 100px">..................................</td>
                                    <td style="padding-left: 100px">.................................</td>
                                </tr>
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

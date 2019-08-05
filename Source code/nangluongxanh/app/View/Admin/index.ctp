<div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary" style="border: 1px solid #3C85C4;">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-mobile fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php 
                                            if($countsl!=null){
                                                echo $countsl[0][0]['items'];
                                            }
                                            ?>
                                        </div>
                                        <div>Nhắc Nhở Nhập Hàng!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="../admin/nhacnhonhaphang">
                                <div class="panel-footer">
                                    <span class="pull-left">Chi Tiết</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green" style="background: #5CB85C;border: 1px solid #5CB85C;">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php 
                                            if($count_chua_duyet!=null){
                                                echo $count_chua_duyet[0][0]['dem'];
                                            }
                                            ?>
                                        </div>
                                        <div>Đơn Hàng Chưa Xử Lý!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="../admin/orderchuaduyet" style="color: #5CB85C;">
                                <div class="panel-footer">
                                    <span class="pull-left">Chi Tiết</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-red" style="background: #D9534F;border: 1px solid #D9534F;">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-mail-forward fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php 
                                            if($count_contact!=null){
                                                echo $count_contact[0][0]['dem'];
                                            }
                                            ?>
                                        </div>
                                        <div>Khách Hàng Liên Hệ!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="../admin/managecontact" style="color: #D9534F;">
                                <div class="panel-footer">
                                    <span class="pull-left">Chi Tiết</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
               

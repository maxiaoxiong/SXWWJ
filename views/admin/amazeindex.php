<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 15-9-14
 * Time: 下午11:23
 */
use app\assets\AdminAsset;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
    <html lang="zh-cn">
    <head>
        <meta charset="UTF-8">
        <?php $this->head(); ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <header class="am-topbar">
        <h1 class="am-topbar-brand">
            <strong>SXWWJ</strong>
            <small>后台管理系统</small>
        </h1>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
                data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span
                class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
            <ul class="am-nav am-nav-pills am-topbar-nav">
                <li class="am-active"><a href="#">首页</a></li>
                <li><a href="#">项目</a></li>
            </ul>


            <div class="am-topbar-right">
                <div class="am-dropdown" data-am-dropdown="{boundary: '.am-topbar'}">
                    <button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm am-dropdown-toggle"
                            data-am-dropdown-toggle>其他 <span class="am-icon-caret-down"></span></button>
                    <ul class="am-dropdown-content">
                        <li><a href="#">注销</a></li>
                    </ul>
                </div>
            </div>

            <div class="am-topbar-right">
                <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm">登录</button>
            </div>
        </div>
    </header>
    <div class="admin">
        <div class="am-g container">
            <div class="admin-sidebar am-u-md-3">
                <ul class="am-list admin-sidebar-list">
                    <li><a href="admin-index.html"><span class="am-icon-home"></span> 首页</a></li>
                    <li class="admin-parent">
                        <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 项目管理<span
                                class="am-icon-angle-right am-fr am-margin-right"></span></a>
                        <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-nav">
                            <li><a href="admin-user.html" class="am-cf"><span class="am-icon-check"></span> 项目添加<span
                                        class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
                            <li><a href="admin-help.html"><span class="am-icon-puzzle-piece"></span> 项目修改</a></li>
                        </ul>
                    </li>
                    <li><a class="am-cf" data-am-collapse="{target: '#collapse-nav1'}"><span
                                class="am-icon-table"></span> 人员管理<span
                                class="am-icon-angle-right am-fr am-margin-right"></span></a>
                        <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-nav1">
                            <li><a href="admin-user.html" class="am-cf"><span class="am-icon-check"></span> 注册用户管理<span
                                        class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
                            <li><a href="admin-help.html"><span class="am-icon-puzzle-piece"></span> 管理员管理</a></li>
                        </ul>
                    </li>
                    <li><a class="am-cf" data-am-collapse="{target: '#collapse-nav2'}"><span
                                class="am-icon-pencil-square-o"></span> 系统设置<span
                                class="am-icon-angle-right am-fr am-margin-right"></span></a>
                        <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-nav2">
                            <li><a href="admin-user.html" class="am-cf"><span class="am-icon-check"></span> 系统信息<span
                                        class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
                            <li><a href="admin-help.html"><span class="am-icon-puzzle-piece"></span> 修改密码</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span class="am-icon-sign-out"></span> 注销</a></li>
                </ul>
            </div>
            <div class="admin-content am-u-md-9">
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf">
                        <strong class="am-text-primary am-text-lg">项目管理</strong>
                        /
                        <small>项目基本信息</small>
                    </div>
                    </div>                    <div class="am-panel am-panel-default">
                    <div class="am-panel-hd">
                        <h3 class="am-panel-title">项目信息</h3>
                    </div>
                    <div class="am-panel-bd">
                        <p>显示项目基本信息</p>
                    </div>
                    <table class="am-table am-table-bd am-table-striped">
                        <tr>
                            <th>项目id</th>
                            <th>项目编号</th>
                            <th>项目名称</th>
                            <th>项目位置</th>
                            <th>操作</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>s123</td>
                            <td>晋国古都</td>
                            <td>山西侯马</td>
                            <td>
                                <div class="am-dropdown" data-am-dropdown>
                                    <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
                                    <ul class="am-dropdown-content">
                                        <li><a href="#" id="doc-prompt-toggle-edit">1. 编辑</a>
                                            <div class="am-modal am-modal-prompt" tabindex="-1" id="my-prompt">
                                                <div class="am-modal-dialog">
                                                    <div class="am-modal-hd">Amaze UI</div>
                                                    <div class="am-modal-bd">
                                                        来来来，吐槽点啥吧
                                                        <input type="text" class="am-modal-prompt-input">
                                                    </div>
                                                    <div class="am-modal-footer">
                                                        <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                                                        <span class="am-modal-btn" data-am-modal-confirm>提交</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li><a href="#"  id="doc-confirm-toggle">2. 删除</a>
                                            <div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
                                                <div class="am-modal-dialog">
                                                    <div class="am-modal-hd">Amaze UI</div>
                                                    <div class="am-modal-bd">
                                                        你，确定要删除这条记录吗？
                                                    </div>
                                                    <div class="am-modal-footer">
                                                        <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                                                        <span class="am-modal-btn" data-am-modal-confirm>确定</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="am-panel-footer">页脚</div>
                </div>

                </div>
            </div>
        </div>
    </div>

    <footer>
        <img src="<?php echo \Yii::$app->request->baseUrl ?>/image/index_bottum.gif" alt="" class="foot">
    </footer>
    <?php $this->endBody() ?>

    </body>
    </html>
<?php $this->endPage() ?>
<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\widgets\LayoutMenu;
use backend\components\common\MenuHelper;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]>
<html lang="<?= Yii::$app->language ?>" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="<?= Yii::$app->language ?>" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?= Yii::$app->language ?>" class="no-js">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <!--        <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
        <meta http-equiv="X-UA-Compatible" content="IE=11; IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title); ?> | MEGASUN SMARTX</title>
        <?php $this->head() ?>
        <link rel="shortcut icon" href="favicon.ico"/>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
    <!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
    <!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
    <!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
    <!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
    <!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
    <!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
    <!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
    <!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
    <!--<body class="page-md page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo fix-banner">-->
    <body class="page-md page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo">
        <?php $this->beginBody() ?>
        <!-- BEGIN HEADER -->
        <!--div class="page-header md-shadow-z-1-i navbar navbar-fixed-top"-->
        <div class="page-header md-shadow-z-1-i navbar">
            <!-- BEGIN HEADER INNER -->
            <a href="javascript:void(0);" class="icon-refresh-fix"><img src="/images/refresh_icon.jpg" width="48"/></a>
            <?php $alarms = \Yii::$app->session->get('module_alarm', null); ?>
            <?php $alarmConfig = Yii::$app->params['module-alarm']; ?>
            <!-- BEGIN HEADER INNER -->
            <?php //if (in_array($_SERVER['REQUEST_URI'], ['/', '/?reload=true', '/modules/index']) && !Yii::$app->mobileDetect->isMobile()) { ?>
            <?php if (!Yii::$app->mobileDetect->isMobile()) { ?>
                <div class="header" id="banner-home">
                    <div class="header-left">
                        <a href="/" class="logo"><img src="/images/logo.png"/></a>
                    </div>
                    <div class="banner">
                        <div class="banner-image">
                            <img src="/images/banner.png" alt=""/>
                        </div>
                        <div class="banner-menu">
                            <div class="content-menu">                                
                                <?php foreach ($alarmConfig as $alarm => $item) { ?>                                
                                    <?php $url = ($alarms) && $alarms[$item['key']]['status'] ? '?alarm=' . $alarm : ''; ?>
                                    <a href="/modules/index<?php echo $url; ?>" <?php echo ($alarms) && $alarms[$item['key']]['status'] ? 'class="active"' : '' ?>>
                                        <?php echo Yii::t('backend', $item['value']); ?><?php echo ($alarms) && $alarms[$item['key']]['count'] ? '(' . $alarms[$item['key']]['count'] . ')' : '' ?>
                                    </a>
                                <?php } ?>                                                              
                            </div> 
                            <div class="flag-banner">
                                <a href="javascript:void(0);" id="flag-language">
                                    <img height="33px" width="44px" style="overflow: hidden;" src="<?php echo (\Yii::$app->language == 'en') ? '/images/en.png' : '/images/vi.png'; ?>"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="page-header-inner">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo" style="padding-right: 0;">
                        <a href="/">
                            <img src="/images/logo.png" alt="logo" class="logo-default"/>
                        </a>
                        <div class="page-sidebar sidebar-toggler-container">
                            <div class="sidebar-toggler">
                            </div>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                    </div>                
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <div class="bottom-menu">
                    <ul>
                        <?php foreach ($alarmConfig as $alarm => $item) { ?>     
                            <li>
                                <?php $url = ($alarms) && $alarms[$item['key']]['status'] ? '?alarm=' . $alarm : ''; ?>
                                <a href="/modules/index<?php echo $url; ?>" <?php echo ($alarms) && $alarms[$item['key']]['status'] ? 'class="active"' : '' ?>>
                                    <?php echo Yii::t('backend', $item['value']); ?><?php echo ($alarms) && $alarms[$item['key']]['count'] ? '(' . $alarms[$item['key']]['count'] . ')' : '' ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="flag">
                    <a href="javascript:void(0);" id="flag-language">
                        <img height="33px" width="44px" style="overflow: hidden;" src="<?php echo (\Yii::$app->language == 'en') ? '/images/en.png' : '/images/vi.png'; ?>"/>
                    </a>
                </div>
                <!-- END HEADER INNER -->
            <?php } ?>
        </div>
        <!-- END HEADER -->
        <div class="clearfix"></div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN LEFT MENU -->
            <div class="page-sidebar-wrapper">
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <!--                    <li class="sidebar-toggler-wrapper">-->
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <!--                        <div class="sidebar-toggler">-->
                        <!--                        </div>-->
                        <!-- END SIDEBAR TOGGLER BUTTON -->
                        <!--                    </li>-->
                        <?php
                        if (!Yii::$app->user->isGuest) {
                            $callback = function ($menu) {
                                if ($menu['route'])
                                    return [
                                        'label' => (\Yii::$app->language == 'vi') ? $menu['name_vi'] : $menu['name'],
                                        'url' => [$menu['route']],
                                        'items' => $menu['children'],
                                        'visible' => $menu['is_active'],
                                        'icon' => $menu['icon'],
                                        'parent' => $menu['parent']
                                    ];
                                return [
                                    'label' => (\Yii::$app->language == 'vi') ? $menu['name_vi'] : $menu['name'],
                                    'items' => $menu['children'],
                                    'visible' => $menu['is_active'],
                                    'icon' => $menu['icon'],
                                    'parent' => $menu['parent']
                                ];
                            };
                            $items = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback);
                            echo LayoutMenu::widget([
                                'items' => $items,
                            ]);
                        }
                        ?>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </div>
            <!-- END LEFT MENU -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <?php if (Yii::$app->session->has('success')) { ?>
                        <div id="w0-success-0" class="alert-success alert fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo Yii::$app->session->getFlash('success'); ?>
                            <?php Yii::$app->session->removeAllFlashes(); ?>
                        </div>
                    <?php } ?>
                    <?php if (Yii::$app->session->has('error')) { ?>
                        <div id="w0-danger-0" class="alert-danger alert fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo Yii::$app->session->getFlash('error'); ?>
                            <?php Yii::$app->session->removeAllFlashes(); ?>
                        </div>
                    <?php } ?>
                    <?php if (Yii::$app->session->has('info')) { ?>
                        <div id="w0-info-0" class="alert-info alert fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo Yii::$app->session->getFlash('info'); ?>
                            <?php Yii::$app->session->removeAllFlashes(); ?>
                        </div>
                    <?php } ?>
                    <?= $content ?>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->

        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner">
                2016 &copy; Suppertheme by Megasun.
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <?php $this->endBody() ?>
        <script>
            var MANUAL_B1 = '<?php echo MANUAL_B1; ?>';
            var MANUAL_B2 = '<?php echo MANUAL_B2; ?>';
            var MANUAL_B12 = '<?php echo MANUAL_B12; ?>';
            var AUTO_B1 = '<?php echo AUTO_B1; ?>';
            var AUTO_B2 = '<?php echo AUTO_B2; ?>';
            jQuery(document).ready(function () {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </body>
</html>
<?php $this->endPage() ?>

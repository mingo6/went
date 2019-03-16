<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page my-qrcode">
    <header class="bar bar-nav">
        <a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
        <h1 class="title">公司</h1>
    </header>

    <div class="content">
        <?php  echo $config['company'];?>
    </div>
</div>

    <script type="text/javascript">

    </script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
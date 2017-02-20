<?php
/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/31
 * Time: 9:56
 */
use common\Yii02;

?>
<footer class="blog-footer">
    <div class="container">
        <div class="row">
            <div class="footer_link">
                <small>本博客是博主使用yii2框架开发而成，但由于能力有限，仍存在许多不足，博主正在不断地学习和进步中。</small>

            </div>
            <div class="footer_link">
                <ul class="list-inline text-center">
                    <li><b>友情链接:</b></li>
                    <li><a href="">怼码人生</a></li>
                    <li><a href="">Yii中文网</a></li>
                    <li><a href="">码云</a></li>
                </ul>
                <ul class="list-inline text-center">
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['page/index', 'name' => 'about']) ?>">关于我们</a>
                    </li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['page/index', 'name' => 'guide']) ?>">使用指南</a>
                    </li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['page/index', 'name' => 'policy']) ?>">隐私措施</a>
                    </li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['page/index', 'name' => 'statement']) ?>">负责声明</a>
                    </li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['page/index', 'name' => 'advice']) ?>">建议反馈</a>
                    </li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['page/index', 'name' => 'contact']) ?>">联系我们</a>
                    </li>
                    <!--<li>
                        <script type="text/javascript">
                            var cnzz_protocol = (("https:" == document.location.protocol) ? "https://" : "http://");
                            document.write(unescape("%3Cspan id='cnzz_stat_icon_1254563052'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/stat.php%3Fid%3D1254563052' type='text/javascript'%3E%3C/script%3E"));
                        </script>
                    </li>-->
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="clearfix"></div>


            <small>CopyRight © <?php date('Y'); ?> www.phpzhi.com All Rights Reserved | 桂ICP备16007331号</small>
        </div>
    </div>
</footer>

<?php $this->beginContent('@app/views/layouts/modal.php');?>
<?php $this->endContent();?>

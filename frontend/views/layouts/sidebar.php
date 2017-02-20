<?php
use common\Yii02;

?>
<?php
$num = Yii02::getReplayNum();
$css = <<<SB
.msgnum:after{
  content: "{$num}";
  color: #fff;
  position: absolute;
  bottom: 12px;
  padding: 3px;
  z-index: 9999999;
  background: #d9534f;
  border-radius: 50%;
  font-size: 12px;
}
SB;
$this->registerCss($css);

?>
<?php  
	if(!defined("LOGIN")) die;  
?>
<div>
<?php isset($_GET['op'])? $nav=$_GET['op']:$nav = 'poster';//������� �� ���������?>
	<ul>
		<li id="nav-header">�������� ���������</li>
		<a href="index.php?op=poster"><li id="<?php echo ($nav == poster ? 'nav_btn_selected' : 'nav_btn');?>">����������</li></a>
		<a href="index.php?op=activity"><li id="<?php echo ($nav == activity ? 'nav_btn_selected' : 'nav_btn'); ?>">�����������</li></a>
		<a href="index.php?op=main"><li id="<?php echo ($nav == main ? 'nav_btn_selected' : 'nav_btn'); ?>">������� ������-������</li></a>
		<a href="index.php?op=newcomer"><li id="<?php echo ($nav == newcomer ? 'nav_btn_selected' : 'nav_btn'); ?>">����� �������������</li></a>
		<a href="index.php?op=faq"><li id="<?php echo ($nav == faq ? 'nav_btn_selected' : 'nav_btn'); ?>">������� � ���������</li></a>
		<a href="index.php?op=library"><li id="<?php echo ($nav == library ? 'nav_btn_selected' : 'nav_btn'); ?>">����������</li></a>
		<a href="index.php?op=gallery"><li id="<?php echo ($nav == gallery ? 'nav_btn_selected' : 'nav_btn'); ?>">�����������</li></a>
		<a href="index.php?op=video"><li id="<?php echo ($nav == video ? 'nav_btn_selected' : 'nav_btn'); ?>">������������</li></a>
		<a href="index.php?op=team"><li id="<?php echo ($nav == team ? 'nav_btn_selected' : 'nav_btn'); ?>">���� �������</li></a>
		<a href="index.php?op=info"><li id="<?php echo ($nav == info ? 'nav_btn_selected' : 'nav_btn'); ?>">� ����</li></a>
<?php
// �������������� ���� ��� ��������������
  if ($_SESSION['permit'] == 1){
  echo "<a href='index.php?op=list'><li id='nav_btn'>������ �������������</li></a>";
  }

?>

	</ul>
	
	<div id="nav-add">
	
		<!--Place here addition data!!!-->
	</div>
</div>
<?php
?>

<footer class="footer" style="padding-top: 15px;">
	<div class="footer__content">
		<?= $this->render('in/footer-sitemap.php');?>
		<img src="/images/svg/compony-logo.svg" alt="" class="footer__logo">
		<p class="footer__text footer__text_dark">Официальный дилер автомобилей марки ISUZU</p>
		<?= $this->render('in/footer-socials.php');?>
		<p class="footer__policy"><a class="footer__link" href="/policy/">Политика конфиденциальности</a></p>
		<p class="footer__textarea">©<?php echo date ( 'Y' ) ; ?> г. Официальный дилер «ISUZU» ©<?php echo date ( 'Y' ) ; ?> г. «ISUZU». Все права защищены. <span class="footer__disclamer">Вся представленная на сайте информация, касающаяся характеристик и стоимости носит информационный характер и ни при каких условиях не является публичной офертой, определяемой положениями Статьи 437(2) Гражданского кодекса </span></p>
		<p class="footer__textarea footer__textarea_dark">Разработка сайта — <a class="footer__supportix" href="http://domen.com/" target="_blank">componyWebDev</a></p>
	</div>
</footer>

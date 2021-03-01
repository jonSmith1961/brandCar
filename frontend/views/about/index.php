<?php

/**
 * @var \yii\web\View $this
 */


use backend\models\DealerCenter;
use common\helpers\ContentBlockHelper;
use frontend\helpers\ImageHelper;

$this->title = 'О нас';
/** @var DealerCenter $dealerCenter */
//$dealerCenter = CurrentCity::dealerCenters()[0]


$this->registerJsFile('/js/swiper.min.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);

$this->registerJsFile('/js/about.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);


$this->registerCssFile('/css/swiper.css');

?>
<h1 class="center-red">О нас</h1>

<div class="wrapper">
	<div class="clear"></div>
	<div id="page_content">
		<ul class="breadcrumb-navigation">
			<li>
				<a href="/" title="Главная">Главная</a>
			</li>
			<li>
				<span>&nbsp;&gt;&nbsp;</span>
			</li>
			<li>
				<a href="/about/" title="О компании">О компании</a>
			</li>
		</ul>
		<div id="right-content">
		</div>
	</div>
</div>
<div class="company-menu-container">
	<div class="wrapper">
		<div class="company-menu__wrap">
			<img class="company-menu__toggle" src="/images/down-arrow.png" alt="">
		</div>

</div>
</div>
<!-- <img src="/images/banner_text.jpg" alt="" class="about__banner"> -->
<div class="top-logo">
	<div class="top-logo__container">
		<div class="top-logo__list">
			<div class="top-logo__item item-logo">
				<div class="item-logo__container">
					<div class="item-logo__container-left">
						<div class="container-left-list">
							<span class="container-left-line"></span>
							<span class="container-left-line"></span>
							<span class="container-left-line"></span>
						</div>
					</div>
					<div class="item-logo__container-right">
						<!-- <p class="item-logo__text">Компания</p> -->
						<img src="/images/about-company.png" alt="">
					</div>
				</div>
			</div>
			<div class="top-logo__item item-text">
				<div class="item-text__container">
					<div class="item-text__container-left">
						<?php ContentBlockHelper::ShowContentBlocksByCity('kontent-blok') ?>
					</div>
					<div class="item-text__container-right">
						<div class="container-right-list">
							<span class="container-right-line"></span>
							<span class="container-right-line"></span>
							<span class="container-right-line"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="wrapper">
	<div id="page_content">
		<div class="about">
			<div class="about__activity">
				<div class="about__house">
					<h2 class="about__subtitle">Isuzu Motors Limited</h2>
					<p class="about__text">Японская автомобильная компания, один из крупнейших в мире производителей грузовиков,
						автобусов и дизельных двигателей.</p>
					<p class="about__text">Эксклюзивным поставщиком автомобилей и машинокомплектов ISUZU на территорию России и
						других стран СНГ является торговый дом Sojits Corp.</p>
					<div class="about__house-images">
						<img src="//images/Isuzu_logo.png" alt="" class="about__house-img">
						<img src="/images/og_image.png" alt="" class="about__house-img">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="about__world">
	<div class="wrapper">
		<div id="page_content">
			<div class="about">
				<p class="about__world-title">Грузовики ISUZU известны во всём мире и пользуются заслуженной популярностью.</p>
				<p class="about__text">Главное их достоинство – долговечность, надежность и выносливость в сочетании с
					доступностью и простотой в эксплуатации. Кроме того высокая производительность и отличная топливная
					экономичность, компания Isuzu – пионер новых технологий в области производства дизельных двигателей. Все это
					делает автомобили ISUZU востребованными во всех регионах России.</p>
			</div>
		</div>
	</div>
</div>
<div class="wrapper">
	<div id="page_content">
		<div id="right-content">
			<div class="about">
				<div class="factories">
					<div class="factories__power">
						<img src="/images/ulobl.png" alt="" class="factories__img">
						<p class="factories__description">Производственные мощности АО «ИСУЗУ РУС» расположены в г. Ульяновск.</p>
					</div>
					<div class="factories__count">
						<p class="factories__text">В <span>2019</span> году на заводе в Ульяновске было собрано <span>3728</span>
							автомобилей. </p>
						<p class="factories__text">Модельный ряд насчитывает
							<!-- <span>180</span> версий, модификаций и комплектаций -->
							<span>12</span> базовых моделей.</p>
					</div>
				</div>
				<div class="gallery">
					<div class="gallery-container swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<img class="gallery__img" src="/images/170519.jpg" alt="">
							</div>
							<div class="swiper-slide">
								<img class="gallery__img" src="/images/IMG_4060.jpg" alt="">
							</div>
							<div class="swiper-slide">
								<img class="gallery__img" src="/images/11AV1744.jpg" alt="">
							</div>
							<div class="swiper-slide">
								<img class="gallery__img" src="/images/11AV1669.jpg" alt="">
							</div>
							<div class="swiper-slide">
								<img class="gallery__img" src="/images/IMG_5111.jpg" alt="">
							</div>
						</div>
						<!-- Add Pagination -->
						<div class="swiper-pagination gallery-pagination swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
						<!-- Add Arrows -->
						<div class="swiper-button-next gallery-button-next">
							<?= ImageHelper::show_svg('icon-arrow', 'icon icon-arrow') ?>
						</div>
						<div class="swiper-button-prev gallery-button-prev">
							<?= ImageHelper::show_svg('icon-arrow', 'icon icon-arrow') ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="about__brand">
	<div class="wrapper">
		<div id="page_content">
			<div class="about">
				<div class="about__brand-description">
					<div class="about__years">
						<p class="about__russia"><span>14</span> лет</p>
						<p class="about__russia">в России</p>
					</div>
					<div class="about__appear">
						<p class="about__appear-title">В России бренд официально представлен с 2006 года. </p>
						<p class="about__text">На протяжении более 14 лет команда ISUZU в России стремится приложить максимум
							усилий, чтобы предложить не только качественный продукт, но и своевременно и оперативно отвечать на
							запросы клиентов в сфере обслуживания, взаимодействия и сотрудничества. </p>
						<p class="about__text">Самым главным нашим активом являются люди – исполнительные сотрудники, надежные
							партнеры и поставщики. Все те, кто своим отношением к делу ежедневно помогают компании идти намеченным
							курсом, строить далеко идущие планы и занимать ведущие позиции в отрасли. Сегодня мы добились отличных
							результатов, но не планируем на этом останавливаться. Мы будем и дальше работать и развиваться.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="wrapper">
	<div id="page_content">
		<div id="right-content">
			<div class="about">
				<div class="about-tabs">
					<ul class="about-tabs__caption">
						<li class="">
							<svg class="about__svg about__svg_earth">
								<use xlink:href="#icon-earth"></use>
							</svg>
							<p>История бренда ISUZU</p>
						</li>
						<li class="active">
							<svg class="about__svg about__svg_russia">
								<use xlink:href="#icon-russia"></use>
							</svg>
							<p>История развития ISUZU в России</p>
						</li>
					</ul>
					<div class="about-tabs__content about-tabs__content_world">
						<div class="history">
							<div class="history__preview">
								<svg class="about__svg about__svg_growrth">
									<use xlink:href="#icon-growth"></use>
								</svg>
								<p class="history__text">Корпоративная миссия Isuzu заключается в том, чтобы каждым своим шагом, делом,
									достижением оправдывать доверие потребителей. Мы стремимся стать надежным партнером для наших
									Клиентов, символом благополучия и успешной жизни.</p>
							</div>
							<p class="about__text"><b><i>Марка ISUZU имеет богатую историю, насчитывающую уже более 100 лет. За это
										время накоплен неоценимый опыт в производстве надежных грузовиков, отвечающих всем мировым
										стандартам.</i></b></p>
							<p class="about__text">На протяжении всей истории ISUZU создает автомобили, которые раздвигают привычные
								рамки восприятия, утверждают новые жизненные приоритеты и предоставляют своим владельцам практически
								неограниченные возможности. Результатом этой работы стало мировое признание ISUZU как одного из лидеров
								в области создания и производства современных, безопасных и экономичных грузовых автомобилей и дизельных
								двигателей.</p>
						</div>
						<div class="history__hundred">
							<p class="history__hundred-text">История, насчитывающая <span>более 100 лет</span></p>
						</div>
						<div class="history-nav">
							<ul class="history-nav__list">
								<li class="history-nav__item history-nav__item_active">1916</li>
								<li class="history-nav__item">1920</li>
								<li class="history-nav__item">1930</li>
								<li class="history-nav__item">1940</li>
								<li class="history-nav__item">1950</li>
								<li class="history-nav__item">1960</li>
								<li class="history-nav__item">1970</li>
								<li class="history-nav__item">1980</li>
								<li class="history-nav__item">1990</li>
								<li class="history-nav__item">2000</li>
								<li class="history-nav__item">2010</li>
								<!-- <li class="history-nav__item">2018</li> -->
							</ul>
						</div>
						<div class="history-content">
							<div class="history-content__block history-content__block_active">
								<div class="history-item">
									<div class="history-item__wrapper">
										<a href="/images/1916.jpg" class="history-item__img image-popup-no-margins">
											<img src="/images/1916.jpg" alt="">
											<svg class="history-item__svg">
												<use xlink:href="#icon-loop"></use>
											</svg>
										</a>
										<div class="history-item__info">
											<p class="history-item__date"><span><span>1916</span> год</span></p>
											<p class="history-item__text">Автомобилей в Японии было всего несколько тысяч, и те заграничного
												производства. Но после вступления Японии в Первую мировую войну японцы поняли, что без
												автотранспорта победы не одержать. Именно война стала той причиной, что заставила
												судостроительное предприятие Tokyo Ishikawajima Shipbuilding &amp; Engineering Co. объединиться c
												энергетической компанией Tokyo Gas and Electric Industrial Сo. и совместно построить
												автомобильный завод.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<a href="/images/1920.jpg" class="history-item__img image-popup-no-margins">
											<img src="/images/1920.jpg" alt="">
											<svg class="history-item__svg">
												<use xlink:href="#icon-loop"></use>
											</svg>
										</a>
										<div class="history-item__info">
											<p class="history-item__date"><span><span>1920</span> год</span></p>
											<p class="history-item__text">Началась сборка лицензионных английских грузовиков Wolseley СР. В
												сентябре 1923 года страна пережила мощнейшее землетрясение, и простой, неприхотливый, надежный
												грузовичок оказался в числе рабочих лошадок, поднявших города из руин. За что решением
												Министерства экономики, торговли и промышленности был удостоен почетного титула «Наследие
												модернизации промышленности».</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<a href="/images/1934.jpg" class="history-item__img image-popup-no-margins">
											<img src="/images/1934.jpg" alt="">
											<svg class="history-item__svg">
												<use xlink:href="#icon-loop"></use>
											</svg>
										</a>
										<div class="history-item__info">
											<p class="history-item__date"><span><span>1933/34</span> год</span></p>
											<p class="history-item__text">Tokyo Ishikawajima Shipbuilding &amp; Engineering Co. совместно с DAT
												(предшественницей Datsun) создали компанию Automobile Industries Co., Ltd. На следующий год
												компания запускает производство 1,5-тонного капотного грузовика Type 94 (М2594) с удлинённой до
												3900 мм базой, предлагавшегося с 40 видами кузовов и надстроек, а также в бескапотном исполнении
												и с колесной формулой 4x4. По решению Министерства торговли и промышленности Японии в июле 1934
												г именно этим автомобилям и присвоили марку ISUZU по названию реки Исузу, что протекает около
												одного из самых почитаемых и древнейших святилищ Японии – Великий храм Исэ. </p>
										</div>
									</div>
								</div>
								<div class="history-item">
									<div class="history-item__wrapper">
										<a href="/images/1936.png" class="history-item__img image-popup-no-margins">
											<img src="/images/1936.png" alt="">
											<svg class="history-item__svg">
												<use xlink:href="#icon-loop"></use>
											</svg>
										</a>
										<div class="history-item__info">
											<p class="history-item__date"><span><span>1936</span> год</span></p>
											<p class="history-item__text">Компания строит первый в стране дизельный двигатель с воздушным
												охлаждением - DA6. Это стало крупным прорывом в истории развития дизельных двигателей в Японии.
												А через пять лет становится единственным предприятием, получившим от японского правительства
												разрешение на выпуск дизельных автомобилей. </p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<a href="/images/1949.jpg" class="history-item__img image-popup-no-margins">
											<img src="/images/1949.jpg" alt="">
											<svg class="history-item__svg">
												<use xlink:href="#icon-loop"></use>
											</svg>
										</a>
										<div class="history-item__info">
											<p class="history-item__date"><span><span>1949</span> год</span></p>
											<p class="history-item__text">Isuzu Motors получила свое нынешнее название. Для этого ей пришлось
												не только пережить Вторую мировую войну. Предстояло еще выстоять, оставшись без оборонных
												заказов, и полностью реорганизовать производство для выпуска гражданской продукции. Пережитое
												было столь велико и значимо, что руководством было принято решение о переименовании
												компании.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<a href="/images/1959.jpg" class="history-item__img image-popup-no-margins">
											<img src="/images/1959.jpg" alt="">
											<svg class="history-item__svg">
												<use xlink:href="#icon-loop"></use>
											</svg>
										</a>
										<div class="history-item__info">
											<p class="history-item__date"><span><span>1959</span> год</span></p>
											<p class="history-item__text">Выпущен переднеприводный грузовичок КА20, который получился
												компактным и мог похвастать очень низкой погрузочной высотой. Он оказался незаменимым на
												внутригородских перевозках и стал основоположником многочисленного и крайне успешного семейства
												малотоннажных автомобилей ELF (N-Series).</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<a href="/images/1965.jpg" class="history-item__img image-popup-no-margins">
											<img src="/images/1965.jpg" alt="">
											<svg class="history-item__svg">
												<use xlink:href="#icon-loop"></use>
											</svg>
										</a>
										<div class="history-item__info">
											<p class="history-item__date"><span><span>1965</span> год</span></p>
											<p class="history-item__text">На организованной в московском парке «Сокольники» японской
												национальной выставке были представлены легковые автомобили ISUZU Bellel.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<a href="/images/1970.jpg" class="history-item__img image-popup-no-margins">
											<img src="/images/1970.jpg" alt="">
											<svg class="history-item__svg">
												<use xlink:href="#icon-loop"></use>
											</svg>
										</a>
										<div class="history-item__info">
											<p class="history-item__date"><span>Апрель <span>1970</span> год</span></p>
											<p class="history-item__text">Состоялась премьера четырехтонного грузового автомобиля TR нового
												семейства FORWARD. Через три года в модельной линейке, получившей индекс F, было уже шесть машин
												массой от 9 до 25 т и два седельных тягача.</p>
											<p class="history-item__text"><i>Семейство F включает несколько десятков модификаций и версий
													двухосных автомобилей.</i></p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<a href="/images/1988.jpg" class="history-item__img image-popup-no-margins">
											<img src="/images/1988.jpg" alt="">
											<svg class="history-item__svg">
												<use xlink:href="#icon-loop"></use>
											</svg>
										</a>
										<div class="history-item__info">
											<p class="history-item__date"><span><span>1988</span> год</span></p>
											<p class="history-item__text">Isuzu Motors Ltd. построила грузовиков больше, чем какое-либо другое
												предприятие в мире, а по выпуску среднетоннажных автомобилей стала мировым лидером второй год
												подряд.
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<a href="/images/1994.jpg" class="history-item__img image-popup-no-margins">
											<img src="/images/1994.jpg" alt="">
											<svg class="history-item__svg">
												<use xlink:href="#icon-loop"></use>
											</svg>
										</a>
										<div class="history-item__info">
											<p class="history-item__date"><span><span>1994</span> год</span></p>
											<p class="history-item__text">Началась история семейства тяжёлых автомобилей GIGA. Первоначально
												семейство состояло всего из двух серий F и C полной массой 15,1– 25,8 т, выпускавшихся в 58
												комплектациях и вариантах с колесными формулами 4х2, 6х2, 6х4 и 8х4. </p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<a href="/images/2006.jpg" class="history-item__img image-popup-no-margins">
											<img src="/images/2006.jpg" alt="">
											<svg class="history-item__svg">
												<use xlink:href="#icon-loop"></use>
											</svg>
										</a>
										<div class="history-item__info">
											<p class="history-item__date"><span>1 сентября <span>2006</span> год</span></p>
											<p class="history-item__text">В России стартовали продажи ISUZU российской сборки. Это была модель
												NQR71P, которая стоила 868 000 рублей.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<a href="/images/2017.jpg" class="history-item__img image-popup-no-margins">
											<img src="/images/2017.jpg" alt="">
											<svg class="history-item__svg">
												<use xlink:href="#icon-loop"></use>
											</svg>
										</a>
										<div class="history-item__info">
											<p class="history-item__date"><span><span>2017</span> год</span></p>
											<p class="history-item__text">Заводы фирмы, в том числе российский завод, построили более 886 000
												дизельных моторов и 670 000 коммерческих автомобилей. Автомобили ISUZU поставляется более чем в
												130 стран мира, а дизельные двигатели – на конвейеры многих ведущих мировых
												автопроизводителей.</p>
										</div>
									</div>
								</div>

							</div>
							<div class="history-bottom-nav">
								<button class="history-bottom-nav__btn history-bottom-nav__btn_prev history-bottom-nav__btn_hidden" data-number="0">
									<span class="history-bottom-nav__text">1916</span>
									<div class="history-bottom-nav__icon">
										<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 59.414 59.414" xml:space="preserve">
                      <g>
						  <polygon points="43.854,59.414 14.146,29.707 43.854,0 45.268,1.414 16.975,29.707 45.268,58 	"></polygon>
					  </g>
                    </svg>
									</div>
								</button>
								<button class="history-bottom-nav__btn history-bottom-nav__btn_next" data-number="2">
									<span class="history-bottom-nav__text">1920-e</span>
									<div class="history-bottom-nav__icon">
										<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 59.414 59.414" xml:space="preserve">
                      <g>
						  <polygon points="15.561,59.414 14.146,58 42.439,29.707 14.146,1.414 15.561,0 45.268,29.707 	"></polygon>
					  </g>
                    </svg>
									</div>
								</button>
							</div>
						</div>
					</div>
					<div class="about-tabs__content active">
						<div class="history-nav">
							<ul class="history-nav__list">
								<li class="history-nav__item">2006</li>
								<li class="history-nav__item">2007</li>
								<!-- <li class="history-nav__item">2008</li> -->
								<!-- <li class="history-nav__item">2012</li> -->
								<li class="history-nav__item">2013</li>
								<li class="history-nav__item">2014</li>
								<li class="history-nav__item">2016</li>
								<li class="history-nav__item">2017</li>
								<li class="history-nav__item">2018</li>
								<li class="history-nav__item history-nav__item_active">2019</li>
							</ul>
						</div>
						<div class="history-content">
							<div class="history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<div class="history-item__info history-item__info_russia">
											<p class="history-item__date"><span><span>2006</span> год</span></p>
											<p class="history-item__text">Запуск проекта на территории России (подписание соглашения с
												компанией СОЛЛЕРС, бывш. Северстальсталь)</p>
											<p class="history-item__text">Старт крупноузловой сборки малотоннажных автомобилей ELF (N-серия)
												на территории Ульяновского завода, г. Ульяновск</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<div class="history-item__info history-item__info_russia">
											<p class="history-item__date"><span><span>2007</span> год</span></p>
											<p class="history-item__text">Старт импорта из Японии тяжелых грузовиков GIGA (C&amp;E- серия)</p>
											<p class="history-item__text">Организовано совместное предприятие на территории России (ЗАО
												«Северсталь-Исузу)</p>
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="history-content__block history-content__block">
						<div class="history-item">
						  <div class="history-item__wrapper">
							<div class="history-item__info history-item__info_russia">
							  <p class="history-item__date"><span><span>2008</span> год</span></p>
							  <p class="history-item__text">Перенос производства в г. Елабуга (особая экономическая зона Алабуга) </p>
							</div>
						  </div>
						</div>
					  </div> -->
							<!-- <div class="history-content__block history-content__block">
						<div class="history-item">
						  <div class="history-item__wrapper">
							<div class="history-item__info history-item__info_russia">
							  <p class="history-item__date"><span><span>2012</span> год</span></p>
							  <p class="history-item__text">Возвращение производства на территорию Ульяновского завода, г. Ульяновск</p>
							</div>
						  </div>
						</div>
					  </div> -->
							<div class="history-content__block history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<div class="history-item__info history-item__info_russia">
											<p class="history-item__date"><span><span>2013</span> год</span></p>
											<p class="history-item__text">Старт импорта из Японии среднетоннажных автомобилей FORWARD
												(F-серия)</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<div class="history-item__info history-item__info_russia">
											<p class="history-item__date"><span><span>2014</span> год</span></p>
											<p class="history-item__text">Старт крупноузловой сборки среднетоннажных автомобилей FORWARD
												(F-серия) на территории Ульяновского завода, г. Ульяновск</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<div class="history-item__info history-item__info_russia">
											<p class="history-item__date"><span><span>2016</span> год</span></p>
											<p class="history-item__text">Официальный старт продаж пикапов ISUZU D-Max </p>
											<p class="history-item__text">Открытие регионального филиала ИСУЗУ РУС на Дальнем Востоке</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<div class="history-item__info history-item__info_russia">
											<p class="history-item__date"><span><span>2017</span> год</span></p>
											<p class="history-item__text">Производство тяжелых грузовых автомобилей ISUZU GIGA (С&amp;Е серия)
												экологического класса двигателя Евро-5 на территории Ульяновского завода, г. Ульяновск</p>
											<p class="history-item__text">Подписание Правительством Ульяновской области, АО «ИСУЗУ РУС» и ООО
												«СИМАЗ» меморандума о намерениях по производству автобусов малого класса на шасси ISUZU ELF
												9.5. </p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block history-content__block">
								<div class="history-item">
									<div class="history-item__wrapper">
										<div class="history-item__info history-item__info_russia">
											<p class="history-item__date"><span><span>2018</span> год</span></p>
											<p class="history-item__text">Осуществлен полный переход автомобилей серии N/F на экологический
												стандарт двигателей Евро-5</p>
											<p class="history-item__text">Совместное предприятие «Исузу Соллерс» заключило специнвестконтракт
												по проекту технологического партнерства в России (создание нового совместного продукта в
												сегменте среднетоннажных грузовиков и экспорт через дистрибьюторскую сеть ISUZU по всему
												миру)</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-content__block history-content__block history-content__block_active">
								<div class="history-item">
									<div class="history-item__wrapper">
										<div class="history-item__info history-item__info_russia">
											<p class="history-item__date"><span><span>2019</span> год</span></p>
											<p class="history-item__text">
												Выход на российский рынок обновленного пикапа ISUZU D-Max 2019 модельного года
											</p>
											<p class="history-item__text">
												Старт продаж малотоннажных грузовиков ISUZU ELF (N-серия) c роботизированной коробкой передач
											</p>
											<p class="history-item__text">
												Старт продаж модели ISUZU ELF 7.5 (NPR82) CNG c двигателем, работающем на компримированном природном газе (метане)
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="history-bottom-nav">
								<button class="history-bottom-nav__btn history-bottom-nav__btn_prev" data-number="0">
									<span class="history-bottom-nav__text">2018</span>
									<div class="history-bottom-nav__icon">
										<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 59.414 59.414" xml:space="preserve">
                      <g>
						  <polygon points="43.854,59.414 14.146,29.707 43.854,0 45.268,1.414 16.975,29.707 45.268,58 	"></polygon>
					  </g>
                    </svg>
									</div>
								</button>
								<button class="history-bottom-nav__btn history-bottom-nav__btn_next history-bottom-nav__btn_hidden" data-number="2">
									<span class="history-bottom-nav__text"></span>
									<div class="history-bottom-nav__icon">
										<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 59.414 59.414" xml:space="preserve">
                      <g>
						  <polygon points="15.561,59.414 14.146,58 42.439,29.707 14.146,1.414 15.561,0 45.268,29.707 	"></polygon>
					  </g>
                    </svg>
									</div>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="ajax-content"></div>
			<!-- </div> -->

			<!-- </div> -->
		</div>
	</div>
</div>

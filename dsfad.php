<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
if ($_COOKIE['lang'] == 'ru') {
    $APPLICATION->SetTitle("Корзина");
} else {
    $APPLICATION->SetTitle("Bascket");
} ?><?


var_dump($_COOKIE['BASKET']);


function telegram($message) {
	$token='939863193:AAEI8dil3uZAEH5y3Ns6Lq7apvQ2_XNDR-I';


	$query = [
        'chat_id' => -353429105,
        'parse_mode' => 'HTML',
        'text' => $message
        ];


//    file_get_contents(sprintf('https://api.telegram.org/bot%s/sendMessage?%s', $token, http_build_query($query)));
							}
?> <? if (!CModule::IncludeModule("iblock")) return; ?>
<div class="catalogWrapper ourProductionWrapper clearfix">
	<div class="resize">
		<div class="container-fluid">
			 <?

// КОРИЗИНА - $_COOKIE['BASKET']


            $product = [];
            if ($_POST['remoove'] == 'all') {
                $PROP = [];
                foreach ($_SESSION['basket'] as $elementID) {
                    $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_price");
                    $arFilter = Array("IBLOCK_ID" => 1, "ID" => $elementID, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 500), $arSelect);
                    while ($ob = $res->GetNextElement()) {
                        $arFields = $ob->GetFields();
                        $summ += $arFields[PROPERTY_PRICE_VALUE];
                    }
                    $PROP['UP_PRODUCT_ID'][] = $arFields["ID"] ;
                    $PROP['UP_PRODUCT_NAME'][] = $arFields["NAME"];
                    array_push($product, [$arFields["NAME"], $arFields[PROPERTY_PRICE_VALUE]]);
                }

				$seng_string = "Имя заказчика: ".$_POST["name"]."<br />E-mail: ".$_POST["mail"]."<br />Номер телефона: ".$_POST["phone"]."<br />ИНН: ".$_POST["inn"]."<br />Промо-код: ".$_POST["promoCode"]."<br /><br />Предмет заказ:<br />";
                foreach ($product as $item){
					$seng_string .= ' '.$item[0].' цена: '.$item[1].' руб.<br />';
                }

                $PROP['UP_CLIENT_PHONE_NUMBER'][] = $_POST["phone"] ;
                $PROP['UP_CLIENT_NAME'][] = $_POST["name"];
                $PROP['UP_CLIENT_MAIL'][] = $_POST["mail"];




                $el = new CIBlockElement;
                $arLoadProductArray = Array(
                    'MODIFIED_BY' => 1,
                    'IBLOCK_SECTION_ID' => false,
                    'IBLOCK_ID' => 10,
                    'PROPERTY_VALUES' => $PROP,
                    'NAME' => $_POST["name"],
                    'ACTIVE' => 'Y',
                );
                if($REQUEST_ID = $el->Add($arLoadProductArray)){
                    echo 'ok';
                } else {
                    echo 'Error: '.$el->LAST_ERROR;
                }

                //для админа
$seng_string.="<br /><br />Сумма: $summ руб.";
$seng_thema=iconv("UTF-8","Windows-1251","Заказ с сайта Genesis.center");
$seng_string=iconv("UTF-8","Windows-1251",$seng_string);
mail('hd@genesis.center', $seng_thema, $seng_string,
"From: genesis.center <mail@genesis.center>\n".
"Content-Transfer-Encoding: 8bit\n".
"Content-Type: text/html; charset=\"windows-1251\"; format=\"flowed\""
);
//mail('stasrj84@list.ru', 'Заказ', $seng_string);
//mail('hd@genesis.center', 'Заказ', $seng_string.' .Сумма '.$summ);
                // для клиента
				//$mes_tele="Заказ с сайта Genesis.Center. ".$seng_string."; Сумма: ".$summ." руб;";
$mes_tele="Заказ с сайта Genesis.Center.";
				//$mes_tele=iconv("UTF-8","Windows-1251", $mes_tele);
telegram($mes_tele);

				// mail($_POST["mail"],'Заказ', 'Ваш заказ на сумму: '.$summ.' принят! Список товаров: '. $seng_string);
mail($_POST["mail"], $seng_thema, $seng_string,
"From: genesis.center <mail@genesis.center>\n".
"Content-Transfer-Encoding: 8bit\n".
"Content-Type: text/html; charset=\"windows-1251\"; format=\"flowed\""
);


unset($_COOKIE['BASKET']);

                header("Location: /catalog/?order=done", 200);
            }

            if(!empty($_POST['delete'])){
//                unset($_SESSION['basket'][array_search($_POST['delete'], $_SESSION['basket'])]);
            }

            if (!empty($_COOKIE['BASKET'])) {
            ?> <?
$bsk_array=json_decode($_COOKIE["BASKET"], true);
//var_dump($bsk_array);
?>
			<div id="empty-basket-container" style="display: none">
				<h1 class="empty-basket">Ваша корзина пуста</h1>
				<h1 class="empty-basket"><i class="fas fa-shopping-basket"></i> </h1>
			</div>
			<h1 class="sliced sliced-left">Корзина</h1>
			<div class="basket-box__header">
				<div class="basket-box__header_img">
					 Фото
				</div>
				<div class="basket-box__header_name">
					 Наименование
				</div>
				<div class="basket-box__header_amount">
					 Количество
				</div>
				<div class="basket-box__header_price">
					 Цена
				</div>
				<div class="basket-box__header_delete">
					 Очистить корзину
				</div>
			</div>
			<div class="basket-box__body">
				 <? $ziklInc=0; foreach ($bsk_array as $elementID) {

++$ziklInc;

//$resDecode = htmlspecialchars(json_encode($elementID), ENT_QUOTES, 'UTF-8');
$resDecode=json_encode($elementID);
//print "$resDecode";


                    $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_price");
                    $arFilter = Array("IBLOCK_ID" => 1, "ID" => $elementID['id'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 500), $arSelect);
                    while ($ob = $res->GetNextElement()) {
                        $arFields = $ob->GetFields();
                        $summ += $arFields[PROPERTY_PRICE_VALUE];
                    }
                    ?> <?//////////////// получаем dop_array
$data_dop_arr=json_decode($elementID['arr'], true);
if (sizeof($data_dop_arr) > 0){
$dop_array="";
$dopZenaThis="0";
foreach ($data_dop_arr as $keyDop) {
		    $arSelect2 = Array("NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_sizes");
	            $arFilter2 = Array("ID" => $keyDop);
                    $resDop = CIBlockElement::GetList(Array(), $arFilter2, false, Array("nPageSize" => 500), $arSelect2);
        if ($ob2 = $resDop->GetNextElement()) {
            $arFields2 = $ob2->GetFields();
            $arProps = $ob2->GetProperties();
	    $dop_array.="<div><p>".$arFields2[NAME]."</p><p>".$arProps['first_test']['VALUE']." <span>&nbsp;руб.</span></p></div>";
	$dopZenaThis+=$arProps['first_test']['VALUE'];
                                          } 

                                    }
			} else { $dop_array=""; }
?> <?
if (!empty($dopZenaThis))
{ $dopZenaOb+=$dopZenaThis; }
?>
				<div class="basket-box__body_item">
 <a href="<span id=" title="Код php: <? $arfields[detail_page_url] ] ?>" class="bxhtmled-surrogate"><?= $arFields[DETAIL_PAGE_URL] ?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>"&gt;<img src="<span id=" title="Код php: <? cfile::getpath($arfields[&quot;preview_picture&quot;]) ) ?>" class="bxhtmled-surrogate"><?= CFile::GetPath($arFields["PREVIEW_PICTURE"]) ?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>" alt="good image"&gt;</a> <a href="<span id=" title="Код php: <? $arfields[detail_page_url] ] ?>" class="bxhtmled-surrogate"><?= $arFields[DETAIL_PAGE_URL] ?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>"&gt;
					<div>
						<?= $arFields[NAME] ?>
					</div>
					<?= $dop_array ?></a>
					<div>
						<div class="num-minus">
							-
						</div>
						<input class="num-button" type="number" value="<span id=" title="Код php: <? $elementid['num'] ] ?>"><?= $elementID['num'] ?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>"&gt;
						<div class="num-plus">
							+
						</div>
					</div>
					<div>
						<p>
							<?= $arFields[PROPERTY_PRICE_VALUE]+$dopZenaThis ?>
						</p>
						 &nbsp;руб.
					</div>
					<div class="delete-basket" data-del="<span id=" title="Код php: <? $ziklinc c ?>
						"><?= $ziklInc ?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>"&gt;X
					</div>
				</div>
				 <? } ?>
			</div>
		</div>
		<div class="bascket-summ">
			<div class="summ">
				Сумма заказа: <?= $summ+$dopZenaOb ?> рублей
			</div>
			<div class="buy-button">
 <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-lg detail-btn">
				Оформить заказ </button>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Окно оформления заказа</h5>
 <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">?</span> </button>
							</div>
							<div class="modal-body">
								<p>
									 Для оформления заказа, заполните форму обратной связи.
								</p>
								<form id="bascket-form" action="/basket/" method="POST">
									<div class="form-group">
 <span for="exampleInputEmail1">Имя</span> <input type="text" class="form-control" aria-describedby="emailHelp" name="name">
									</div>
									<div class="form-group">
 <span for="exampleInputPassword1">Email</span> <input id="basket-email" type="email" name="mail" class="form-control">
									</div>
									<div class="form-group">
 <span for="exampleInputPassword1">Телефон</span> <input id="basket-phone" type="text" name="phone" class="form-control">
									</div>
									<div class="form-group">
 <span for="exampleInputPassword1">ИНН</span> <input id="basket-phone" type="text" name="inn" class="form-control">
									</div>
									<div class="form-group">
 <span for="exampleInputPassword1">Промо-код</span> <input id="basket-phone" type="text" name="promoCode" class="form-control">
									</div>
 <br>
									<div class="buy-button">
 <input type="hidden" name="remoove" value="all"> <input class="btn btn-success" type="submit" value="Подтвердить">
									</div>
								</form>
 <br>
							</div>
							<div class="modal-footer">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		 <? } else { ?>
		<div id="empty-basket-container">
			<h1 class="empty-basket">Ваша корзина пуста</h1>
			<h1 class="empty-basket"><i class="fas fa-shopping-basket"></i> </h1>
		</div>
		 <? } ?>
	</div>
</div>
 <style>
    .bascket-summ {
        display: inline-block;
        float: right;
        padding: 25px;
    }

    .buy-button {
        display: inline-block;
        float: right;
    }

    .summ {
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 20px;
    }

    .detail-btn {
        border: black solid 1px;
        float: right;
        background: #f5f5f5;
    }

    .detail-btn:hover {
        background: rgba(239, 64, 53, 0.9);
    }
    div#empty-basket-container {
        text-align: center;
    }

    h1.empty-basket {
        font-size: 70px;
    }
</style> <!-- <? print_r($arFields[DETAIL_PAGE_URL]); ?> --> <!-- <? print_r($ar_res2[PREVIEW_PICTURE]); ?> --> <!-- <? print_r(CFile::GetPath($arFields["PREVIEW_PICTURE"])); ?> --> <br>
<script>
$(document).ready(function(){

//функции
function buscetCount() {  //Пересчёт корзины из кукисов
    var BASKET = $.cookie('BASKET');  
    var BASKET = BASKET ? eval(BASKET) : [];
    var bascetNum = BASKET.reduce((basketCount, el) => {
	return basketCount + el['num'];
    }, 0);
    setTimeout(()=> {
	$('.mini-basket').attr('data-count', bascetNum);
     },999);
};

function removeAllBasket() {
    $.removeCookie('BASKET', { expires: 7, path:'/' });
    $('.basket-box__body').hide();
    $('.sliced.sliced-left').hide();
    $('.basket-box__header').hide();
    $('.bascket-summ').hide();
    $('#empty-basket-container').css('display', 'block');
};

function recauntSumm() {
    var summ = 0;
    Array.from(document.querySelectorAll('.basket-box__body > div > p:nth-child(5)')).map((el) => {
	var cost = el.innerText;
	var amount = el.parentNode.children[2].children[1].value;
	var amountCost = amount * cost;
	summ += amountCost;
	
	$('.summ').text('Сумма заказа: ' + summ + ' рублей');
    });
};
recauntSumm();

function rewriteCookie(e) {
    var BASKET = $.cookie('BASKET');  
    var BASKET = eval(BASKET);
    var elIndex = $(e.target).parent().parent().children()[4].getAttribute('data-del');
console.log($(e.target).parent().parent().children())
    var elAmount = $(e.target).parent().children()[1].value;
    BASKET[elIndex-1]['num'] = +elAmount;
    BASKET = JSON.stringify(BASKET);
    $.cookie('BASKET', BASKET, { expires: 7, path:'/' });
    var BASKET = $.cookie('BASKET');  
    var BASKET = eval(BASKET);
    console.log(BASKET);
}


//события
$('.basket-box__header_delete').on('click', (e) => { 
    removeAllBasket(); //удалить все товары
});

$('.basket-box__body_item .delete-basket').on('click', (e) => {
    var BASKET = $.cookie('BASKET'); // получаем сохраненные ранее настройки   
    var BASKET = eval(BASKET);//конвертируем строку в массив 

    BASKET.splice(+$(e.target).attr('data-del')-1, 1);//удаляем выбранный элемент из маccива

    if(!BASKET[0]) { //удаляем всю корзину если нет товаров
	removeAllBasket()
    }

    BASKET = JSON.stringify(BASKET);
    $.cookie('BASKET', BASKET, { expires: 7, path:'/' }); //возвращаем изменённый масив в куки

    $(e.target).parent().remove();//удаляем элемент из дом

    //заново индекируем кнопки удаления
    Array.from(document.querySelectorAll('.basket-box__body_item .delete-basket')).map((el, i) => {
	el.setAttribute('data-del', i+1);
    });

    recauntSumm();
    buscetCount();
});

$('.num-plus').on('click', (e) => {
    $(e.target).parent().children()[1].value++;
    recauntSumm();
    rewriteCookie(e);
    buscetCount();
});
$('.num-minus').on('click', (e) => {
    if($(e.target).parent().children()[1].value > 1) {
        $(e.target).parent().children()[1].value--;
	rewriteCookie(e)
	recauntSumm();
	buscetCount();
    }
});
$('.num-button').change((e) => {
    if($(e.target).parent().children()[1].value < 1) {
	$(e.target).parent().children()[1].value = 1;
    }
    rewriteCookie(e)
    recauntSumm();
    buscetCount();
});

$.ajax({
   type: "GET",  //метод передачи
   url: "//genesis.center/AJAXch-basket.php", //скрипт, которому передаем
   success: function(msg){  //что делать,када все хорошо)))
     $(".mini-basket").attr('data-count', msg); //заливаем в див с айди ареа ответ от рнр скрипта
   }
});

});
</script><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
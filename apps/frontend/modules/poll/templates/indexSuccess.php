<div id="quizModule">
	<div class="clear" style="height: 1px"></div>
	<?php echo $quizzCollectionForm->renderFormTag(null, array('id' => 'quizForm'));?>
	<?php echo $quizzCollectionForm['_csrf_token']->render();?>
	<?php $i = 0; ?>
            <ul>
                <?php foreach($quizzCollectionForm as $quizzForm){ ?>
                    <?php if(get_class($quizzForm) === 'sfFormFieldSchema'){ ?>
                        <li class="<?php echo $i ?> <?php if($i === 0) echo 'active'; ?>"  iterate="<?php echo $i; ?>" style="<?php if($i !== 0) echo 'display:none'; ?>">
                            <div class="question"> <?php echo $quizzForm['question']->getValue()?> </div>
                            <div class="answers">
                                <?php echo $quizzForm['answers']->render();?>
                            </div>					
                            <div class="clear"></div>
                        </li>
                    <?php $i++; }?>
                <?php }?>
            </ul>
        <?php echo $poll['type'] ?>
            <input type="hidden" name="signed_request" value="<?php echo sfContext::getInstance()->getUser()->getAttribute('signed_request', null, 'signed_request') ?>" />
	</form>
	<div class="quizzPrevQuestion right"></div>
	<div class="quizzNextQuestion right"></div>
        <div id="results"></div>
</div>
<script type="text/javascript">

var app = {};
app.functions = {};

<?php if ($poll['type'] == 'points'){ ?>
    $('.checkbox_list li').prepend(
    '<select><option value="0">0</option>'+
        '<option value="1">1</option>'+
        '<option value="2">2</option>'+
        '<option value="3">3</option>'+
        '<option value="4">4</option>'+
        '<option value="5">5</option>'+
        '<option value="6">6</option>'+
        '<option value="7">7</option>'+
        '<option value="8">8</option>'+
        '<option value="9">9</option>'+
        '<option value="10">10</option>'+
    '</select>');

    $('.checkbox_list li input').hide();
    $("select").change(function () {
                $(this).parent() .children('input').val($(this).parent() .children('input').val()+'___'+$(this).val());
    }).trigger('change');
    
    $(":input").each(function() {
	this.checked = true;
    });
<?php } ?>

app.functions.showHidePrevButton = function()
{
	var i = $('ul li.active').attr('iterate');
	if(i == 0)
		$('.quizzPrevQuestion').hide();
	else if(i > 0)
		$('.quizzPrevQuestion').show();
};
app.functions.showHidePrevButton();
//app.functions.prepareCheckboxes();

$('.quizzPrevQuestion').live('click', function(){
	var i = $('ul li.active').attr('iterate');
	var next = parseInt(i)-1;
	$("ul li.active").hide().removeClass('active');
	$("ul li."+next+"").show().addClass('active');
	//$("#quizModule .active ul li input:checked").parent().find('img').click();
	app.functions.showHidePrevButton();
});

$('.quizzNextQuestion').live('click', function(){
	if($('ul li.active ul li input:checked').length > 0){
		if($('ul li.active').hasClass('<?php echo count($questions)-1 ?>'))
		{
			$('form#quizForm').submit();
		}
		if((parseInt($('ul li.active').attr('iterate'))+1) < 4)
		{
			var i = $('ul li.active').attr('iterate');
			var next = parseInt(i)+1;
			var questionNumber = next+1;
			$("ul li.active").hide().removeClass('active');
			$("ul li."+next+"").show().addClass('active');
			//$("#quizModule .active ul li input:checked").parent().find('img').click();
			app.functions.showHidePrevButton();
		}
	}
	else
	{
		alert('Wybierz odpowiedź');
	}
});
jQuery.preLoadImages(
		'/images/aa.png' 
		
);
</script>
// Set global vars
var cc = $('.code-container').clone().removeClass('none'),
	code_container = function(){ return cc.clone()};



// Build event handlers
$('.redeem').on('click', getBlacklisted);
$('.splash').on('click', function(){$(this).hide()})
.children().on('click', function(){return false;})

function splash(cl){
	$('.' + (cl ? cl : 'splash') ).show().height($(document).height());
}

function getBlacklisted () {
	$('.code-table').html('');

	if($.trim($('.code-entry').val()) === ''){
		alert("Please type in a code!");
		return;
	}

	$.ajax({
		url : 'lib/getblacklisted.php',
		success : function (data) {
			data = $.parseJSON(data);
			splash();
			
			for(var i = 0; i < data.length; i++){
				var c = code_container()
					c.find('.code').text(data[i].code);
				$('.code-table').append(c);
			}
		}
	});
	return false;
}
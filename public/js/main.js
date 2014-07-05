// Set global vars
var cc = $('.code-container').clone().removeClass('none'),
	code_container = function(){ return cc.clone()};



// Build event handlers
$('.blacklisted').on('click', getBlacklisted);

function splash(cl){
	$('.' + (cl ? cl : 'splash') ).show().height($(document).height()).on('click', function(){$(this).hide()});
}

function getBlacklisted () {
	splash();
	$('.code-table').html('');
	$.ajax({
		url : 'lib/getblacklisted.php',
		success : function (data) {
			data = $.parseJSON(data);
			for(var i = 0; i < data.length; i++){
				var c = code_container()
					c.find('.code').text(data[i].code);
				$('.code-table').append(c);
			}
		}
	});
	return false;
}
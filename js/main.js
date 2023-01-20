$('.plantButton').click(function() {
	var treeType = $(this).attr('data-treeType');
	
	var currentTreeAmount = parseInt($('#numberOf' + treeType + 'Trees').find('.value').text());
	currentTreeAmount++;
	$('#numberOf' + treeType + 'Trees').find('.value').text(currentTreeAmount);
	
	var currentFertilizerAmount = parseInt($('#fertilizerAmount').find('.value').text());
	currentFertilizerAmount--;
	$('#fertilizerAmount').find('.value').text(currentFertilizerAmount);
	
	if (currentFertilizerAmount > 0) {
		$.ajax({
			type: "POST",
			url: "handlers/plantTheTree.php",
			data: "treeType=" + treeType + '&' + 'currentTreeAmount=' + currentTreeAmount + '&' + 'currentFertilizerAmount=' + currentFertilizerAmount,
			success: function(data) {
				var thisTree = 
				"<div class=tree data-treeType=" + treeType + " data-state=harvested data-id=" + data + ">" + 
					"<div class=treeImage></div>" + 
					"<div class='" + treeType + "sImage fruits' style='display: none;'></div>" + 
				"</div>";
				$(thisTree).appendTo('#garden').fadeIn();
			}
		});
	}
});


$('body').on('click', '.tree', function() {
	if ($(this).attr('data-state') == 'ripe') {
		$(this).attr('data-state', 'harvested');
		$(this).find('.fruits').fadeOut(0);
		
		var thisTreeId = $(this).attr('data-id');
		var thisTreeType = $(this).attr('data-treeType');
		
		if (thisTreeType == 'Apple') {
			var numberOfHarvestedFruits = 40 + Math.floor(Math.random() * 11);
		}
		if (thisTreeType == 'Pear') {
			var numberOfHarvestedFruits = Math.floor(Math.random() * 21);
		}
		
		var currentNumberOfFruits = parseInt($('#numberOf' + thisTreeType + 's').find('.value').text());
		var newNumberOfFruits = currentNumberOfFruits + numberOfHarvestedFruits;
		$('#numberOf' + thisTreeType + 's').find('.value').text(newNumberOfFruits);

		$.ajax({
			type: "POST",
			url: "handlers/harvest.php",
			data: 'treeId=' + thisTreeId + '&' + 'treeType=' + thisTreeType + '&' + 'numberOfFruits=' + newNumberOfFruits,
			success: function(data) {
				//alert(data);
			}
		});
	}
});


$('#sellFruitsButton').click(function() {
	var numberOfApples = parseInt($('#numberOfApples').find('.value').text());
	var numberOfPears = parseInt($('#numberOfPears').find('.value').text());
	
	var applesWeight = 0;
	for (var i = 0; i < numberOfApples; i++) {
		var thisAppleWeight = (Math.floor(Math.random()*4) + 15) / 100;
		applesWeight += thisAppleWeight;
	}
	applesWeight = applesWeight.toFixed(2);
	var applesCost = applesWeight * 70;
	
	var pearsWeight = 0;
	for (var i = 0; i < numberOfPears; i++) {
		var thisPearWeight = (Math.floor(Math.random()*5) + 13) / 100;
		pearsWeight += thisPearWeight;
	}
	pearsWeight = pearsWeight.toFixed(2);
	var pearsCost = pearsWeight * 150;
	
	var currentMoney = parseInt($('#money').find('.value').text());
	var money = Math.floor(applesCost + pearsCost);
	
	var newMoney = currentMoney + money;
	$('#money').find('.value').text(newMoney);
	
	
	$('#numberOfApples').find('.value').text(0);
	$('#numberOfPears').find('.value').text(0);
	
	var sellInfo = 'Было продано ' + pearsWeight + ' кг груш и ' + applesWeight + ' кг яблок.';
	$(this).parent().find('#sellInfo').text(sellInfo);
	
	$.ajax({
		type: "POST",
		url: "handlers/sell.php",
		data: 'money=' + money,
		success: function(data) {
			//alert(data);
		}
	});
});


function checkIfRipe() {
	$.ajax({
		type: "POST",
		url: "handlers/areTreesRipe.php",
		success: function(data) {
			var ripeTreeNumbers = data.split("_");
			for (var i = 0; i < ripeTreeNumbers.length; i++) {
				$('#garden').find('div').each(function() {
					if ($(this).attr('data-id') == ripeTreeNumbers[i]) {
						$(this).attr('data-state', 'ripe').find('div').each(function() {
							$(this).fadeIn(0);
						});
					}
				});
			};
			//alert(data);
		}
	});
}

checkIfRipe();
setInterval(function () {
	checkIfRipe();
}, 5000);
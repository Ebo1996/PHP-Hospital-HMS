'use strict';
var UIButtons = function() {

	var laddaHandler = function() {
		
		Ladda.bind('div:not(.progress-demo) .ladda-button', {
			timeout: 2000
		});

		
		Ladda.bind('.progress-demo .ladda-button', {
			callback: function(instance) {
				var progress = 0;
				var interval = setInterval(function() {
					progress = Math.min(progress + Math.random() * 0.1, 1);
					instance.setProgress(progress);

					if(progress === 1) {
						instance.stop();
						clearInterval(interval);
					}
				}, 200);
			}
		});

		
	};
	return {
		init: function() {
			laddaHandler();
		}
	};
}();

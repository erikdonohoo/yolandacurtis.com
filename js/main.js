var app = angular.module('yolanda', ['angularFileUpload']);

var Ctrl = ['$scope', '$http', function($scope, $http){
	$scope.onFileSelect = function($files) {
		//$files: an array of files selected, each file has name, size, and type.
		for (var i = 0; i < $files.length; i++) {
			var $file = $files[i];
			$http.uploadFile({
				url: 'php/upload.php', //upload.php script, node.js route, or servlet upload url
				// headers: {'optional', 'value'}
				data: {file: $scope.myModel},
				file: $file
			}).progress(function(evt) {
				console.log('percent: ' + parseInt(100.0 * evt.loaded / evt.total));
			}).then(function(data, status, headers, config) {
				// file is uploaded successfully
				console.log(data);
			}); 
		}
	}
}]
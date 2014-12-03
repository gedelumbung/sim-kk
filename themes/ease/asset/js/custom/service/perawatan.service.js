app.service('perawatanService', ['$http',
	function($http) {
		'use strict';

		this.getEntity = function(id, queryStr) {
			return $http({
				method: 'GET',
				url: baseUrl+'/perawatan/get_detail/' + id + '?' + queryStr
			})
				.success(function(data) {
					return data;
				})
				.error(function(data) {
					return data;
				});
		};

		return this;
	}
]);
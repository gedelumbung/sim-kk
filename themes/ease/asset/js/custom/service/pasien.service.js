app.service('pasienService', ['$http',
	function($http) {
		'use strict';

		this.getEntity = function(id, member) {
			return $http({
				method: 'GET',
				url: baseUrl+'/pasien/get_detail/' + id
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
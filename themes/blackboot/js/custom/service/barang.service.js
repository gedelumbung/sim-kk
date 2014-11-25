app.service('barangService', ['$http',
	function($http) {
		'use strict';

		this.getEntity = function(id, amenity) {
			return $http({
				method: 'GET',
				url: baseUrl+'/barang/get_detail/' + id
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
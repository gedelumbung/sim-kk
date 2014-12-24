app.service('barangDalamService', ['$http',
	function($http) {
		'use strict';

		this.getEntity = function(id, amenity) {
			return $http({
				method: 'GET',
				url: baseUrl+'/barang_dalam/get_detail/' + id
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
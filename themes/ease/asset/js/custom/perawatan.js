app.controller('PerawatanCtrl', ['$scope','barangDalamService',
    function($scope,$barangDalamService) {
        $scope.obatCollection = arr_obat;

        $scope.addRowObat = function(){
            $scope.obatCollection.push({
                id_obat : '',
                harga : '',
                diskon : '',
                jumlah : 1
            });
        };

        $scope.deleteRowObat = function(index){
            $scope.obatCollection.splice(index,1);
        };

        $scope.updateObat = function(index,id_obat,jumlah){
            $scope.entityObat = '';
            $barangDalamService.getEntity(id_obat).then(function(response) {
                $scope.entityObat = response.data;
                $scope.obatCollection[index] = {
                    id_obat : $scope.entityObat.id_barang_dalam,
                    harga : $scope.entityObat.harga_jual,
                    diskon : $scope.entityObat.diskon+'%',
                    jumlah : jumlah
                };
            });
        };
    }
]);

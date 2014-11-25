app.controller('TransasksiCtrl', ['$scope','$http','barangService',
    function($scope,$http,$barangService) {
        $scope.dokterCollection = [];
        $scope.perawatCollection = [];
        $scope.obatCollection = [];

        $scope.totalBiaya = 0;
        $scope.totalBayar = 0;
        $scope.totalHutang = 0;
        $scope.biaya = 0;

        $scope.statusPembayaran = 'Belum Lunas';


        $scope.countTotalBiayaObat = function(){
            $scope.totalBiayaObat = 0;
            for(var i=0; i<$scope.obatCollection.length; i++){
                $scope.totalBiayaObat = parseInt(parseInt($scope.totalBiayaObat)+(parseInt($scope.obatCollection[i]['harga']) * parseInt($scope.obatCollection[i]['jumlah'])));
            };
        };

        $scope.addRowDokter = function(){
            $scope.dokterCollection.push({
                id_dokter : ''
            });
        };

        $scope.deleteRowDokter = function(index){
            $scope.dokterCollection.splice(index,1);
        };

        $scope.updateDokter = function(index,id_dokter){
            $scope.dokterCollection[index] = {
                id_dokter : id_dokter
            };
        };

        $scope.addRowPerawat = function(){
            $scope.perawatCollection.push({
                id_perawat : ''
            });
        };

        $scope.deleteRowPerawat = function(index){
            $scope.perawatCollection.splice(index,1);
        };

        $scope.updatePerawat = function(index,id_perawat){
            $scope.perawatCollection[index] = {
                id_perawat : id_perawat
            };
        };

        $scope.addRowObat = function(){
            $scope.obatCollection.push({
                id_obat : '',
                harga : '',
                jumlah : 1
            });
        };

        $scope.deleteRowObat = function(index){
            $scope.obatCollection.splice(index,1);
            $scope.countTotalBiayaObat();
            $scope.countTotal();
            $scope.countHutang();
        };

        $scope.updateObat = function(index,id_obat,jumlah){
            $scope.entityObat = '';
            $barangService.getEntity(id_obat).then(function(response) {
                $scope.entityObat = response.data;
                $scope.obatCollection[index] = {
                    id_obat : $scope.entityObat.id_barang,
                    harga : $scope.entityObat.harga_jual,
                    jumlah : jumlah
                };
                $scope.countTotalBiayaObat();
                $scope.countTotal();
            });
        };

        $scope.countTotal = function(){
            $scope.totalBiaya = parseInt($scope.totalBiayaObat)+parseInt($scope.biaya);
            $scope.countHutang();
        };

        $scope.countHutang = function(){
            $scope.totalHutang = parseInt($scope.totalBiaya)-parseInt($scope.totalBayar);
            if($scope.totalHutang < 0){
                $scope.totalHutang = 0;
                $scope.statusPembayaran = 'Lunas';
            }
            else{
                $scope.statusPembayaran = 'Belum Lunas';
            }
        };
    }
]);

app.controller('TransasksiEditCtrl', ['$scope','$http','barangService',
    function($scope,$http,$barangService) {
        $scope.dokterCollection = arr_dokter;
        $scope.perawatCollection = arr_perawat;
        $scope.obatCollection = arr_obat;

        $scope.model_detail = m_array;

        $scope.biaya = $scope.model_detail.biaya;
        $scope.totalHutang = $scope.model_detail.hutang;

        $scope.totalBiaya = 0;
        $scope.totalBayar = 0;

        $scope.statusPembayaran = 'Belum Lunas';


        $scope.countTotalBiayaObat = function(){
            $scope.totalBiayaObat = 0;
            for(var i=0; i<$scope.obatCollection.length; i++){
                $scope.totalBiayaObat = parseInt(parseInt($scope.totalBiayaObat)+(parseInt($scope.obatCollection[i]['harga']) * parseInt($scope.obatCollection[i]['jumlah'])));
            };
        };

        $scope.addRowDokter = function(){
            $scope.dokterCollection.push({
                id_dokter : ''
            });
        };

        $scope.deleteRowDokter = function(index){
            $scope.dokterCollection.splice(index,1);
        };

        $scope.updateDokter = function(index,id_dokter){
            $scope.dokterCollection[index] = {
                id_dokter : id_dokter
            };
        };

        $scope.addRowPerawat = function(){
            $scope.perawatCollection.push({
                id_perawat : ''
            });
        };

        $scope.deleteRowPerawat = function(index){
            $scope.perawatCollection.splice(index,1);
        };

        $scope.updatePerawat = function(index,id_perawat){
            $scope.perawatCollection[index] = {
                id_perawat : id_perawat
            };
        };

        $scope.addRowObat = function(){
            $scope.obatCollection.push({
                id_obat : '',
                harga : '',
                jumlah : 1
            });
        };

        $scope.deleteRowObat = function(index){
            $scope.obatCollection.splice(index,1);
            $scope.countTotalBiayaObat();
            $scope.countTotal();
            $scope.countHutang();
        };

        $scope.updateObat = function(index,id_obat,jumlah){
            $scope.entityObat = '';
            $barangService.getEntity(id_obat).then(function(response) {
                $scope.entityObat = response.data;
                $scope.obatCollection[index] = {
                    id_obat : $scope.entityObat.id_barang,
                    harga : $scope.entityObat.harga_jual,
                    jumlah : jumlah
                };
                $scope.countTotalBiayaObat();
                $scope.countTotal();
            });
        };

        $scope.countTotal = function(){
            $scope.totalBiaya = parseInt($scope.totalBiayaObat)+parseInt($scope.biaya);
            $scope.countHutang();
        };

        $scope.countHutang = function(){
            $scope.totalHutang = parseInt($scope.totalBiaya)-parseInt($scope.totalBayar);
            if($scope.totalHutang < 0){
                $scope.totalHutang = 0;
                $scope.statusPembayaran = 'Lunas';
            }
            else{
                $scope.statusPembayaran = 'Belum Lunas';
            }
        };

        $scope.countTotalBiayaObat();
        $scope.countTotal();
    }
]);

app.controller('TransasksiCtrl', ['$scope','$http','barangService','perawatanService','pasienService','barangDalamService',
    function($scope,$http,$barangService,$perawatanService,$pasienService,$barangDalamService) {
        $scope.dokterCollection = [];
        $scope.perawatCollection = [];
        $scope.obatCollection = [];
        $scope.perawatanCollection = [];

        $scope.totalBiaya = 0;
        $scope.totalBayar = 0;
        $scope.totalHutang = 0;
        $scope.totalKembalian = 0;
        $scope.pasien = '';
        $scope.queryStrPasien = '';
        $scope.showPerawatan = false;
        $scope.perawatan = '';

        $scope.statusPembayaran = 'Belum Lunas';

        $scope.totalBiayaObatPerawatan = 0;


        $scope.countTotalBiayaObat = function(){
            $scope.totalBiayaObat = 0;
            for(var i=0; i<$scope.obatCollection.length; i++){
                $scope.totalBiayaObat = parseInt(parseInt($scope.totalBiayaObat)+(parseInt($scope.obatCollection[i].harga) * parseInt($scope.obatCollection[i].jumlah)));
            }
        };

        $scope.countTotalBiayaObatPerawatan = function(){
            $scope.totalBiayaObatPerawatan = 0;
            for(var i=0; i<$scope.perawatanCollection.length; i++){
                $scope.totalBiayaObatPerawatan = parseInt(parseInt($scope.totalBiayaObatPerawatan)+parseInt($scope.perawatanCollection[i].harga));
                /*for(var j=0; j<$scope.perawatanCollection[i].obat.length; j++){
                    $scope.totalBiayaObatPerawatan = parseInt(parseInt($scope.totalBiayaObatPerawatan)-parseInt($scope.perawatanCollection[i].obat[j].harga));
                }*/
            }
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
                    diskon : $scope.entityObat.diskon+'%',
                    jumlah : jumlah
                };
                $scope.countTotalBiayaObat();
                $scope.countTotal();
            });
        };

        $scope.updateObatPerawatan = function(indexPerawatan,index,id_obat,jumlah){
            $scope.entityObatPerawatan = '';
            $barangDalamService.getEntity(id_obat).then(function(response) {
                $scope.entityObatPerawatan = response.data;
                $scope.perawatanCollection[indexPerawatan].obat[index] = response.data.obat;
                $scope.countTotalBiayaObat();
                $scope.countTotalBiayaObatPerawatan();
                $scope.countTotal();
            });
        };

        $scope.addRowPerawatan = function(){
            $scope.perawatanCollection.push({
                harga : 0,
                diskon : 0,
                komisi_dokter : 0,
                komisi_perawat : 0,
                obat : []
            });
            $scope.countTotalBiayaObat();
            $scope.countTotalBiayaObatPerawatan();
            $scope.countTotal();
        };

        $scope.addRowObatPerawatan = function(index){
            $scope.perawatanCollection[index].obat.push({
                id_obat : '',
                harga : 0,
                jumlah : 1,
            });
            $scope.countTotalBiayaObat();
            $scope.countTotalBiayaObatPerawatan();
            $scope.countTotal();
        };

        $scope.updatePerawatan = function(id_perawatan, member, index){
            $perawatanService.getEntity(id_perawatan, $scope.queryStrPasien).then(function(response) {
                $scope.perawatanCollection[index] = response.data;
                $scope.perawatanCollection[index].obat = response.data.obat;
                $scope.countTotalBiayaObat();
                $scope.countTotalBiayaObatPerawatan();
                $scope.countTotal();
            });
        };

        $scope.deleteRowPerawatan = function(index){
            $scope.perawatanCollection.splice(index,1);
            $scope.countTotalBiayaObat();
            $scope.countTotalBiayaObatPerawatan();
            $scope.countTotal();
        };

        $scope.deleteRowObatPerawatan = function(indexPerawatan, indexObat){
            $scope.perawatanCollection[indexPerawatan].obat.splice(indexObat,1);
            $scope.countTotalBiayaObat();
            $scope.countTotalBiayaObatPerawatan();
            $scope.countTotal();
        };

        $scope.updatePasien = function(id_pasien){
            $pasienService.getEntity(id_pasien).then(function(response) {
                $scope.pasien = response.data;
                $scope.queryStrPasien = 'member='+$scope.pasien.member;
            });
        };

        $scope.countTotal = function(){
            $scope.totalBiaya = parseInt($scope.totalBiayaObat)+parseInt($scope.totalBiayaObatPerawatan);
            $scope.countHutang();
        };

        $scope.countHutang = function(){
            $scope.totalHutang = parseInt($scope.totalBiaya)-parseInt($scope.totalBayar);

            var kembalian = parseInt($scope.totalBayar)-parseInt($scope.totalBiaya);
            if(kembalian > 0){
                $scope.totalKembalian = Math.abs(parseInt($scope.totalBayar)-parseInt($scope.totalBiaya));
            }
            else{
                $scope.totalKembalian = 0;
            }

            if($scope.totalHutang <= 0){
                $scope.totalHutang = 0;
                $scope.statusPembayaran = 'Lunas';
            }
            else{
                $scope.statusPembayaran = 'Belum Lunas';
            }
        };
    }
]);

app.controller('TransasksiEditCtrl', ['$scope','$http','barangService','perawatanService','pasienService','barangDalamService',
    function($scope,$http,$barangService,$perawatanService,$pasienService,$barangDalamService) {
        $scope.dokterCollection = arr_dokter;
        $scope.perawatCollection = arr_perawat;
        $scope.obatCollection = arr_obat;

        $scope.model_detail = m_array;

        $scope.biaya = $scope.model_detail.biaya;
        $scope.totalHutang = $scope.model_detail.hutang;

        $scope.totalBiaya = $scope.model_detail.total;
        $scope.totalBayar = $scope.model_detail.total_bayar;

        $scope.statusPembayaran = 'Belum Lunas';
        $scope.pasien = '';
        $scope.queryStrPasien = '';
        $scope.showPerawatan = true;
        $scope.perawatan = {
            id : m_array.id_perawatan
        };

        $scope.perawatanCollection = arr_perawatan;
        $scope.perawatan = '';

        $scope.totalBiayaObatPerawatan = 0;


        $scope.countTotalBiayaObat = function(){
            $scope.totalBiayaObat = 0;
            for(var i=0; i<$scope.obatCollection.length; i++){
                $scope.totalBiayaObat = parseInt(parseInt($scope.totalBiayaObat)+(parseInt($scope.obatCollection[i].harga) * parseInt($scope.obatCollection[i].jumlah)));
            }
        };

        $scope.countTotalBiayaObatPerawatan = function(){
            $scope.totalBiayaObatPerawatan = 0;
            for(var i=0; i<$scope.perawatanCollection.length; i++){
                $scope.totalBiayaObatPerawatan = parseInt(parseInt($scope.totalBiayaObatPerawatan)+parseInt($scope.perawatanCollection[i].harga));
                /*for(var j=0; j<$scope.perawatanCollection[i].obat.length; j++){
                    $scope.totalBiayaObatPerawatan = parseInt(parseInt($scope.totalBiayaObatPerawatan)+parseInt($scope.perawatanCollection[i].obat[j].harga));
                }*/
            }
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
                    diskon : $scope.entityObat.diskon+'%',
                    jumlah : jumlah
                };
                $scope.countTotalBiayaObat();
                $scope.countTotal();
            });
        };

        $scope.updateObatPerawatan = function(indexPerawatan,index,id_obat,jumlah){
            $scope.entityObatPerawatan = '';
            $barangDalamService.getEntity(id_obat).then(function(response) {
                $scope.entityObatPerawatan = response.data;
                $scope.perawatanCollection[indexPerawatan].obat[index] = {
                    id_obat : $scope.entityObatPerawatan.id_barang_dalam,
                    harga : $scope.entityObatPerawatan.harga_jual*jumlah,
                    jumlah : jumlah
                };
                $scope.countTotalBiayaObat();
                $scope.countTotalBiayaObatPerawatan();
                $scope.countTotal();
            });
        };

        $scope.addRowPerawatan = function(){
            $scope.perawatanCollection.push({
                harga : 0,
                diskon : 0,
                komisi_dokter : 0,
                komisi_perawat : 0,
                obat : [{
                    id_obat : '',
                    harga : 0,
                    jumlah : 1,
                }]
            });
            $scope.countTotalBiayaObat();
            $scope.countTotalBiayaObatPerawatan();
            $scope.countTotal();
        };

        $scope.addRowObatPerawatan = function(index){
            $scope.perawatanCollection[index].obat.push({
                id_obat : '',
                harga : 0,
                jumlah : 1,
            });
            $scope.countTotalBiayaObat();
            $scope.countTotalBiayaObatPerawatan();
            $scope.countTotal();
        };

        $scope.updatePerawatan = function(id_perawatan, member, index){
            $perawatanService.getEntity(id_perawatan, $scope.queryStrPasien).then(function(response) {
                $scope.perawatanCollection[index] = response.data;
                $scope.perawatanCollection[index].obat = response.data.obat;
                $scope.countTotalBiayaObat();
                $scope.countTotalBiayaObatPerawatan();
                $scope.countTotal();
            });
        };

        $scope.deleteRowPerawatan = function(index){
            $scope.perawatanCollection.splice(index,1);
            $scope.countTotalBiayaObat();
            $scope.countTotalBiayaObatPerawatan();
            $scope.countTotal();
        };

        $scope.deleteRowObatPerawatan = function(indexPerawatan, indexObat){
            $scope.perawatanCollection[indexPerawatan].obat.splice(indexObat,1);
            $scope.countTotalBiayaObat();
            $scope.countTotalBiayaObatPerawatan();
            $scope.countTotal();
        };

        $scope.updatePasien = function(id_pasien){
            $pasienService.getEntity(id_pasien).then(function(response) {
                $scope.pasien = response.data;
                $scope.queryStrPasien = 'member='+$scope.pasien.member;
            });
        };

        $scope.countTotal = function(){
            $scope.totalBiaya = parseInt($scope.totalBiayaObat)+parseInt($scope.totalBiayaObatPerawatan);
            $scope.countHutang();
        };

        $scope.countHutang = function(){
            $scope.totalHutang = parseInt($scope.totalBiaya)-parseInt($scope.totalBayar);

            var kembalian = parseInt($scope.totalBayar)-parseInt($scope.totalBiaya);
            if(kembalian > 0){
                $scope.totalKembalian = Math.abs(parseInt($scope.totalBayar)-parseInt($scope.totalBiaya));
            }
            else{
                $scope.totalKembalian = 0;
            }

            if($scope.totalHutang <= 0){
                $scope.totalHutang = 0;
                $scope.statusPembayaran = 'Lunas';
            }
            else{
                $scope.statusPembayaran = 'Belum Lunas';
            }
        };

        $scope.id_pasien = m_array.id_pasien;

        $scope.countTotalBiayaObat();
        $scope.countTotalBiayaObatPerawatan();
        $scope.countTotal();
        $scope.updatePasien(m_array.id_pasien);
    }
]);

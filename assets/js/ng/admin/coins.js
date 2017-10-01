angular.module("MyApp", []).controller("MyController", function($scope,$http) {
    $scope.add_coins = function()
    {
        var success_cb = function(data)
        {
            $scope.released_coins=0;
            if(!$scope.$$phase) $scope.$apply();
            alert_box(data.message);
        }
        var request_data = {};
        request_data['released_coins'] = $scope.released_coins;
        SSK.site_call("AJAX",window._site_url+"admin_coin/add_coins",request_data,success_cb);
    }

    $scope.delete_coin = function(coin_id)
    {
        if(confirm("Do you want to delete ?"))
        {
            var success_cb = function(data)
            {
                if(data.status == "success")
                {
                    $('#row-id-'+coin_id).remove();
                }
            }
            var request_data = {};
            request_data['coin_id'] = coin_id;
            SSK.site_call("AJAX",window._site_url+"admin_coin/delete_coin",request_data,success_cb);
        }
    }

    $scope.add_coin_price = function()
    {
        var success_cb = function(data)
        {
            $scope.new_price=0;
            if(!$scope.$$phase) $scope.$apply();
            alert_box(data.message);
        }
        var request_data = {};
        request_data['new_price'] = $scope.new_price;
        SSK.site_call("AJAX",window._site_url+"admin_coin/add_coin_price",request_data,success_cb);
    }

    $scope.delete_coin_price = function(coin_price_id)
    {
        if(confirm("Do you want to delete ?"))
        {
            var success_cb = function(data)
            {
                if(data.status == "success")
                {
                    $('#row-id-'+coin_price_id).remove();
                }
            }
            var request_data = {};
            request_data['coin_price_id'] = coin_price_id;
            SSK.site_call("AJAX",window._site_url+"admin_coin/delete_coin_price",request_data,success_cb);
        }
    }
});
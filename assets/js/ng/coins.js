angular.module("MyApp", []).controller("MyController", function($scope,$http) {

    $scope.buy_coin_modal = function()
    {
        $('#buy_coins_modal').modal('show');
        $scope.get_coin_price();
        if(!$scope.$$phase) $scope.$apply();
    }

    $scope.sell_coin_modal = function()
    {
        $('#sell_coins_modal').modal('show');
        $scope.get_coin_price();
        if(!$scope.$$phase) $scope.$apply();
    }

    $scope.buy_coins = function()
    {
        var amount = $scope.amount || 0;
        var payment_details = $scope.payment_details || '';
        var payment_type = $scope.payment_type || '';
        var coins  = $scope.number_of_coins || 0;
        if(confirm("Do you want to buy "+coins+" coins ?"))
        {
            var success_cb = function(data)
            {
                alert_box(coins + ' coins purchased successfully..!!');
                $("#buy_coins_modal").modal('hide');
                window.location.href=window._site_url+'coins';
            }
            var request_data = {};
            request_data['amount'] = amount;
            request_data['payment_details'] = payment_details;
            request_data['payment_type'] = payment_type;
            SSK.site_call("AJAX",window._site_url+"coins/buy_coins",request_data,success_cb);    
        }   
    }

    $scope.sell_coins = function()
    {
        var amount = $scope.amount || 0;
        var payment_details = $scope.payment_details || '';
        var payment_type = $scope.payment_type || '';
        var coins  = $scope.number_of_coins || 0;
        if(confirm("Do you want to sell "+coins+" coins ?"))
        {
            var success_cb = function(data)
            {
                alert_box(coins + ' coins sell successfully..!!');
                $("#sell_coins_modal").modal('hide');
                window.location.href=window._site_url+'coins';
            }
            var request_data = {};
            request_data['coins'] = coins;
            request_data['payment_details'] = payment_details;
            request_data['payment_type'] = payment_type;
            SSK.site_call("AJAX",window._site_url+"coins/sell_coins",request_data,success_cb);    
        }   
    }

    $scope.get_coin_price = function()
    {
        var success_cb = function(data)
        {
            $scope.current_price = data.message.coin_price;
            $scope.calculate_coins();
            if(!$scope.$$phase) $scope.$apply();
        }
        var request_data = {};
        SSK.site_call("AJAX",window._site_url+"coins/get_coin_price",request_data,success_cb);
    }

    $scope.calculate_amount = function()
    {
        $scope.amount = $scope.number_of_coins*$scope.current_price;
        if(!$scope.$$phase) $scope.$apply();
    }

    $scope.calculate_coins = function()
    {
        $scope.number_of_coins = $scope.amount/$scope.current_price;
        if(!$scope.$$phase) $scope.$apply();
    }
});
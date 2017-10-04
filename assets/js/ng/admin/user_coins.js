angular.module("MyApp", []).controller("MyController", function($scope,$http) {
    $scope.deleteUserCoinsRequest = function(user_coins_id)
    {
        if(confirm("Do you want to delete this User Coins Request?"))
        {
            var success_cb = function(data)
            {
                if(data.status == "success")
                {
                    $('#row-id-'+user_coins_id).remove();
                }
            }
            SSK.site_call("AJAX",window._site_url+"admin_user_coins/deleteUserCoinsRequest",{"user_coins_id":user_coins_id}, success_cb);
        }
    }


    $scope.userCoinsRequestAction = function(user_coins_id,userid,status)
    {
        if(confirm("Do you want to accept this User Coins Request?"))
        {
            var success_cb = function(data)
            {
                if(data.status == "success")
                {
                    $('#row-id-'+user_coins_id).remove();
                }
            }
            SSK.site_call("AJAX",window._site_url+"admin_user_coins/userCoinsRequestAction",{"user_coins_id":user_coins_id,"status":status,"userid":userid}, success_cb);
        }
    }

    $scope.get_coin_price = function()
    {
        var success_cb = function(data)
        {
            $scope.current_price = data.message.coin_price;
            if(!$scope.$$phase) $scope.$apply();
        }
        var request_data = {};
        SSK.site_call("AJAX",window._site_url+"coins/get_coin_price",request_data,success_cb);
    }

    $scope.sell_coins_modal = function(request_id)
    {
        $('#sell_coins_modal').modal('show');
        $scope.get_coin_price();
        $scope.number_of_coins_to_sell = $("#row-id-"+request_id).children().attr("coins-row-id-"+request_id);
        $scope.payment_details = $("#row-id-"+request_id).children().attr("payment_details-row-id-"+request_id);
        $scope.payment_type = $("#row-id-"+request_id).children().attr("payment_type-row-id-"+request_id);
        $scope.request_id = request_id;
        if(!$scope.$$phase) $scope.$apply();
    }

    $scope.sell_request_for_roi_purchased_coins = function()
    {
        var success_cb = function(data)
        {
            if(data.status == "success")
            {
                $('#row-id-'+$scope.request_id).remove();
                $('#sell_coins_modal').modal('hide');
            }
        }

        var request_data = {};
        request_data["user_coins_id"] = $scope.request_id;
        request_data["description"] = $scope.description;
        request_data["coins"] = $scope.number_of_coins_to_sell;
        SSK.site_call("AJAX",window._site_url+"admin_user_coins/sell_request_for_roi_purchased_coins",request_data, success_cb);
    }

    $scope.sell_request_referral_coins = function()
    {
        var success_cb = function(data)
        {
            if(data.status == "success")
            {
                $('#row-id-'+$scope.request_id).remove();
                $('#sell_coins_modal').modal('hide');
            }
        }

        var request_data = {};
        request_data["referral_income_id"] = $scope.request_id;
        request_data["description"] = $scope.description;
        request_data["coins"] = $scope.number_of_coins_to_sell;
        SSK.site_call("AJAX",window._site_url+"admin_user_coins/sell_request_referral_coins",request_data, success_cb);
    }
});
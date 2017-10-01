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
});
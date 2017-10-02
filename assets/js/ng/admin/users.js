angular.module("MyApp", []).controller("MyController", function($scope,$http) {
    
    $scope.give_bonus_modal = function(userid)
    {
        $('#give_bonus_modal').modal('show');
        $scope.bonus_userid = userid;
    }

    $scope.give_bonus = function()
    {
        var success_cb = function(data)
        {
            if(data.status == "success")
            {
                alert("Successfully Saved");
                window.location.reload();
            }
        }

        var userid = $scope.bonus_userid || 0;
        var coins = $scope.coins || 0;
        var desc = $scope.desc || '';
        request_data = {};
        request_data['userid'] = userid;
        request_data['coins'] = coins;
        request_data['desc'] = desc;
        SSK.site_call("AJAX",window._site_url+"admin_users/give_bonus",request_data, success_cb);
    }

    $scope.delete_user = function(userid)
    {
        if(confirm("Do you want to delete this User?"))
        {
            delete_user_success_cb = function(data)
            {
                if(data.status == "success")
                {
                    alert_box("Successfully deleted");
                    $("#user-id-"+userid).remove();
                }
            }

            request_data = {};
            request_data['userid'] = userid;
            SSK.site_call("AJAX",window._site_url+"admin_users/delete_user",request_data, delete_user_success_cb);            
        }

    }
});
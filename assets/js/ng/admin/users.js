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

    $scope.fetch_user_data = function(userid)
    {
        fetch_user_data_success_cb = function(data)
        {
            $scope.user_info = {}
            if(data.status == 'success')
            {
                $scope['user_info']['userid']= data.message.userid;
                $scope['user_info']['username']= data.message.username;
                $scope['user_info']['firstname']=data.message.firstname;
                $scope['user_info']['middlename']=data.message.middlename;
                $scope['user_info']['lastname']=data.message.lastname;
                $scope['user_info']['email']=data.message.email;
                $scope['user_info']['profile_image']=data.message.profile_image;
                $scope['user_info']['address']=data.message.address;
                $scope['user_info']['city']=data.message.city;
                $scope['user_info']['state']=data.message.state;
                $scope['user_info']['country']=data.message.country;
                $scope['user_info']['pincode']=data.message.pincode;
                $scope['user_info']['dateofbirth']=data.message.dateofbirth;
                $scope['user_info']['mobile']=data.message.mobile;
                $scope['user_info']['gender']=data.message.gender;
                $scope['user_info']['pancard']=data.message.pancard;
                $scope['user_info']['pancard_image']=data.message.pancard_image;
                $scope['user_info']['aadhaar_card']=data.message.aadhaar_card;
                $scope['user_info']['aadhaar_card_image']=data.message.aadhaar_card_image;
                $scope['user_info']['bank_account_holder_name']=data.message.bank_account_holder_name;
                $scope['user_info']['bank_name']=data.message.bank_name;
                $scope['user_info']['branch']=data.message.branch;
                $scope['user_info']['account_number']=data.message.account_number;
                $scope['user_info']['ifsc_code']=data.message.ifsc_code;
                $scope.placement=data.message.user_alignment;
                if(!$scope.$$phase) $scope.$apply();
            }
            //console.log($scope.user_info);
        }
        request_data = {};
        request_data['userid'] = userid;
        SSK.site_call("AJAX",window._site_url+"admin_users/get_user_info",request_data, fetch_user_data_success_cb);
    }

    $scope.show_image = function(image_path,image_type)
    {
        path = 'uploads/';
        if(image_type == 'profile' && image_path == '')
        {
            path = path+'person.png';
        }else if(image_type == 'documents' && image_path == '')
        {
            path = path+'download.png';
        }else if(image_type == 'packages' && image_path == '')
        {
            path = path+'package.jpg';
        }
        return window._site_url+path;
    }

    $scope.default_profile = 'person.png';
    $scope.default_documents = 'download.png';
    $scope.default_package = 'package.png';
});
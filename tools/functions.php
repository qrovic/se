<?php
    
    function validate_field($field){
        $field = htmlentities($field);
        if(strlen(trim($field))<1){
            return false;
        }else{
            return true;
        }
    }

    function validate_email($email){
        if (isset($email)) {
            $email = trim($email);
         
            if (empty($email)) {
                return 'Email is required';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
               
                return 'Email is invalid format';
            } else {
                return 'success';
            }
        } else {
            return 'Email is required'; 
        }
    }    
       

    function validate_password($password) {
        $password = htmlentities($password);
        
        if (strlen(trim($password)) < 1) {
            return "Password cannot be empty";
        } elseif (strlen($password) < 8) {
            return "Password must be at least 8 characters long";
        } else {
            return "success";
        }
    }    

    function validate_cpw($password, $cpassword){
        $pw = htmlentities($password);
        $cpw = htmlentities($cpassword);
        if(strcmp($pw, $cpw) == 0){
            return true;
        }else{
            return false;
        }
    }

?>
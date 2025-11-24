<?php
    function insert_taikhoan($full_name,$username,$password,$email,$address,$phone){
        $sql = "INSERT INTO `user` (full_name,username,password,email,address,phone) 
        values('$full_name','$username','$password','$email','$address','$phone')";
        pdo_execute($sql);
    }
    function checkuser($username,$password){
        $sql = "SELECT * FROM user where username ='".$username."' AND password ='".$password."'";
        $sp = pdo_query_one($sql);
        return $sp;
    }
    function checkemail($email){
        $sql = "SELECT *FROM user where  email ='".$email."'";
        $sp=pdo_query_one($sql);
        return $sp;
    }
    function checktrung($username){
        $sql = "SELECT *FROM user where username ='".$username."'";
        $sp=pdo_query_one($sql);
        return $sp;
    }
    function get_user_by_id($id) {
        $sql =  "SELECT *FROM user where id ='".$id."'";
        $sp = pdo_query_one($sql);
        return $sp;
    }
    function loadall_taikhoan(){
        $sql = "SELECT * FROM user order by id desc";
        $listtaikhoan = pdo_query($sql);
        return $listtaikhoan;
    }
    function delete_taikhoan($id){
        $sql = "UPDATE user SET isActive = 0 WHERE id = ".$id;
        pdo_execute($sql);
    }
    function enable_taikhoan($id){
        $sql = "UPDATE user SET isActive = 1 WHERE id = ".$id;
        pdo_execute($sql);
    }
    function loadone_taikhoan($id){
        $sql = "SELECT * FROM user where id=".$id;
        $tk=pdo_query_one($sql);
        return $tk;
    }
    function update_taikhoan_home($full_name, $username, $password, $email,$address, $phone, $id){
        $sql = "UPDATE `user` SET `full_name` = '$full_name ', `username` = '$username', `password` = '$password', `email` = '$email', `address` = '$address', `phone` = '$phone', WHERE `id` = $id";
          pdo_execute($sql);
        
    }
    function update_taikhoan($id, $full_name, $username, $password, $email,$address, $phone, $role){
        $sql = "UPDATE user SET full_name= '" . $full_name . "' ,  username= '" . $username . "' ,password='" . $password . "',address='" . $address . "', email= '" . $email . "' , phone= '" . $phone . "',role = '" . $role . "'  where id=" . $id;
            pdo_execute($sql);
    }
    // function select_user_by_id(){
    //     $sql = "select * from user where id = 1 ";
        
    //      return  pdo_query_one($sql);
        
        
    // }
  